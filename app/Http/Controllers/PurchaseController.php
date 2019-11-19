<?php

namespace App\Http\Controllers;

use App\Linepurchase;
use App\Purchasefile;
use App\Purchaseitem;
use Illuminate\Http\Request;
use App\Purchaserequest;
use App\User;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function upload_file($encoded_string, $id, $ext){
        $target_dir = public_path().'\attachments'.'\\approval\\purchase\\'; // add the specific path to save the file
        $decoded_file = base64_decode($encoded_string); // decode the file
        $file_dir = $target_dir . $id .'.'.$ext;

        try {
            file_put_contents($file_dir, $decoded_file); // save
            // database_saving($file);
            // header('Content-Type: application/json');
            // echo json_encode("File Uploaded Successfully");
        } catch (Exception $e) {
            return false;
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store purchase request
        $purchase = Purchaserequest::create($request->all());
        //store purchase item
        $items = $request->get('items');
        foreach ($items as $key => $item) {
            $purchaseItem = new Purchaseitem();
            $purchaseItem->purchaserequest_id = $purchase->id;
            $purchaseItem->MaterialName = $item['MaterialName'];
            $purchaseItem->unit = $item['unit'];
            $purchaseItem->quantity = $item['quantity'];
            $purchaseItem->unp = $item['unp'];
            $purchaseItem->amount = $item['amount'];
            $purchaseItem->save();
        }

        //store line approval
        /* NORMAL LINE */
        $lines = $request->get('normalLines');
        foreach ($lines as $key => $line) {
            if($line['user_id']){
                $lp = new Linepurchase();
                $lp->purchaserequest_id = $purchase->id;
                $lp->user_id = $line['user_id'];
                $lp->status = 0;
                $lp->comment = '';
                $lp->save();
            }
        }
        /* FORCED LINES */
        $forcedUser = User::where('forced_line', 1)->orderBy('sortIndex', 'asc')->get();
        foreach ($forcedUser as $user) {
            Linepurchase::create([
                'purchaserequest_id' => $purchase->id,
                'user_id' => $user->id,
                'type' => 1,
                'status' => 0,
                'comment' => ''
                ]);
        }

        // store attached files
        $attachments = $request->get('attachments');
        foreach ($attachments as $file) {
            $purchaseFile =  Purchasefile::create([
                'purchaserequest_id' => $purchase->id,
                'filename' => $file['filename'],
                'size' => $file['size']
            ]);

            $array = explode(".", $file['filename']);
            end($array);         
            $filetype = current($array);

            $encoded_string = explode('base64,', $file['data'])[1];
            $this->upload_file($encoded_string, $purchaseFile->id, $filetype);

        }

        return Purchaserequest::where('id', $purchase->id)->with('items')->with('lines')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchaserequest::find($id);
        $purchase->update($request->all());

        //update items
        /* REMOVE ALL ITEM RELATED WITH PURCHASE REQUEST */
        $purchase->items()->delete();
        $items = $request->get('items');
        foreach ($items as $key => $item) {
            $purchaseItem = new Purchaseitem();
            $purchaseItem->purchaserequest_id = $purchase->id;
            $purchaseItem->MaterialName = $item['MaterialName'];
            $purchaseItem->unit = $item['unit'];
            $purchaseItem->quantity = $item['quantity'];
            $purchaseItem->unp = $item['unp'];
            $purchaseItem->amount = $item['amount'];
            $purchaseItem->save();
        }

        //update lines
        /* REMOVE ALL NORMAL LINES */
        $purchase->lines()->delete();
        /* UPDATE NORMAL LINE */
        $lines = $request->get('normalLines');

        foreach ($lines as $key => $line) {
            if($line['user_id']){
                $lp = new Linepurchase();
                $lp->purchaserequest_id = $purchase->id;
                $lp->user_id = $line['user_id'];
                $lp->status = 0;
                $lp->comment = '';
                $lp->save();
            }
        }
        /* UPDATE FORCED LINES */
        $forcedUser = User::where('forced_line', 1)->orderBy('sortIndex', 'asc')->get();
        foreach ($forcedUser as $user) {
            Linepurchase::create([
                'purchaserequest_id' => $purchase->id,
                'user_id' => $user->id,
                'type' => 1,
                'status' => 0,
                'comment' => ''
                ]);
        }

        // update attached files
        //REMOVE ALL OLD FILE
        $attachments = $request->get('attachments');
        if($attachments && array_key_exists('data', $attachments[0])){
            $this->deleteFiles($purchase);
            foreach ($attachments as $file) {
                $purchaseFile =  Purchasefile::create([
                    'purchaserequest_id' => $purchase->id,
                    'filename' => $file['filename'],
                    'size' => $file['size']
                ]);
    
                $array = explode(".", $file['filename']);
                end($array);         
                $filetype = current($array);
    
                $encoded_string = explode('base64,', $file['data'])[1];
                $this->upload_file($encoded_string, $purchaseFile->id, $filetype);
    
            }
        } else if(!$attachments){
            $this->deleteFiles($purchase);
        } else {
            $fileIds = array_column($attachments, 'id');
            $removeFiles = $purchase->files()->whereNotIn('id', $fileIds)->pluck('id');
            $this->removeFiles($removeFiles);
            $purchase->files()->whereNotIn('id', $fileIds)->delete();
        }
        return Purchaserequest::where('id', $id)->with('items')->with('lines')->get();
    }
    public function removeFiles($arrIds)
    {
        foreach ($arrIds as $id) {
            $file = Purchasefile::find($id);
            $array = explode(".", $file->filename);
            end($array);         
            $filetype = current($array);

            $f = public_path('attachments\approval\purchase\\').$file->id.'.'.$filetype;

            if(file_exists($f)){
                @unlink($f);
            }
        }
    }
    public function deleteFiles($purchase){
        foreach ($purchase->files()->get() as $file) {
            $array = explode(".", $file->filename);
            end($array);         
            $filetype = current($array);

            $f = public_path('attachments\approval\purchase\\').$file->id.'.'.$filetype;

            if(file_exists($f)){
                @unlink($f);
            }

            // $file->delete();
        }
        $purchase->files()->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
