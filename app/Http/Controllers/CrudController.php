<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CrudController extends Controller
{
        public function __construct(){
        $this->middleware('auth');
    }

    public function datatable($table){
        $str = '\\App\\'.ucfirst($table).'::query()';
        $values = eval("return $str;");

        $datatables = Datatables::of($values);

        $rawColumnsConfig = ['actions'];

        $columnInfos = $this->getColumnInfos($table);
        foreach ($columnInfos as $key => $value) {
            if(strpos($key, '_id') !== false){
                $modelName = ucfirst(substr($key, 0, -3));

                $command = '$datatables->editColumn("'.$key.'", function($m) { return \\App\\'.$modelName.'::findOrFail($m->'.$key.')->'.$modelName.'Name;});';
                // dd($command);

                $datatables = eval("return $command;");
            }

            if(strpos($key, 'Image') !== false){

                $rawColumnsConfig[] = $key; 

                $strEval = '$m->'.$key;

                $datatables = $datatables->editColumn($key, function($m) use ($strEval) {
                    $temp = eval("return $strEval;");
                    return '<img src="'.asset("images/employees/$temp").'" class="img-thumbnail" style="max-height: 35px;" />';
                });
            }
        }
        return $datatables->addColumn('actions', function ($value) use ($table) {
                return '<form action="/crud/'.$table.'/destroy/'.$value->id.'" method="POST">
   
                <a class="btn btn-info btn-sm" href="/crud/'.$table.'/show/'.$value->id.'">Show</a>

                <a class="btn btn-primary btn-sm" href="/crud/'.$table.'/edit/'.$value->id.'">Edit</a>'.csrf_field().'<input type="hidden" name="_method" value="delete" />

                <button type="submit" class="btn btn-danger btn-sm">Delete</button></form>';})->rawColumns($rawColumnsConfig)->make(true);
    }

    public function getColumnInfos($table)
    {
        $table_plural = str_plural($table);
        $tableInfos = \DB::select(\DB::raw('SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = \''.$table_plural.'\''));
        $columnInfos = [];
        foreach ($tableInfos as $key => $value) {
            if($value->COLUMN_NAME == 'id' || $value->COLUMN_NAME == 'created_at' || $value->COLUMN_NAME == 'updated_at' || $value->COLUMN_NAME == 'remember_token')
                continue;
            $columnInfos[$value->COLUMN_NAME] = $value->DATA_TYPE;
        }

        return $columnInfos;
    }

    public function home(){
        return view('manage.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($table)
    {
        $columnInfos = $this->getColumnInfos($table);
        // ${$table_plural} = \DB::select(\DB::raw('SELECT * FROM '.$table_plural));
        $values = \DB::select(\DB::raw('SELECT * FROM '.str_plural($table)));
        // dd($columnInfos, $values);

        return view('crud.index', compact('values', 'columnInfos', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($table)
    {
        $columnInfos = $this->getColumnInfos($table);
        return view('crud.create', compact('columnInfos', 'table'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($table, Request $request)
    {
        // $this->validate($request, [
        //     'CompanyName' => 'required',
        //     'CompanyInfo' => 'required'
        // ]);

        // Company::create($request->all());
        $columnInfos = $this->getColumnInfos($table);
        $arrValidateConfig = [];

        foreach ($columnInfos as $key => $value) {
            if(strpos($key, 'Name') !== false){
                $arrValidateConfig[$key] = 'required';
            }
            if(strpos($key, '_id') !== false){
                $arrValidateConfig[$key] = 'required';
            }
            if(strpos($key, 'Image') !== false){
                $arrValidateConfig[$key] = 'required|image|max:1024';
            }
        }

        $request->validate($arrValidateConfig);

        $str = '\\App\\'.ucfirst($table).'::create($request->all())';
        $model = eval("return $str;");

        if($request->hasFile(ucfirst($table).'Image')){        
            $image = $request->file(ucfirst($table).'Image');

            $new_name = $model->id . '.' . $image->getClientOriginalExtension();

            $evalStr = '$model->'.ucfirst($table).'Image = $new_name';
            eval("return $evalStr;");

            $model->save();
            $image->move(public_path('images/employees'), $new_name);
        }

        return redirect('/crud/'.$table)->with('success', ucfirst($table).' created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($table, $id)
    {
        $columnInfos = $this->getColumnInfos($table);
        $str = '\\App\\'.ucfirst($table).'::find('.$id.')';
        $model = eval("return $str;");

        return view('crud.show', compact('columnInfos', 'model', 'table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($table, $id)
    {
        $columnInfos = $this->getColumnInfos($table);
        $str = '\\App\\'.ucfirst($table).'::findOrFail('.$id.')';
        $model = eval("return $str;");
        return view('crud.edit', compact('columnInfos', 'table', 'model', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $table, $id)
    {
        $str = '\\App\\'.ucfirst($table).'::find('.$id.')';
        $model = eval("return $str;");

        $model->update($request->all());

        return redirect()->route('crud.index', $table)->with('success', ucfirst($table).' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($table, $id)
    {
        $str = '\\App\\'.ucfirst($table).'::find('.$id.')';
        $model = eval("return $str;");

        $model->delete();

        return redirect()->route('crud.index', $table)->with('success', ucfirst($table).' deleted successfully');
    }
}
