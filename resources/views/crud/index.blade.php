@extends('layouts.manage')
 
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <h1 class="h2 mb-2 text-gray-800">Manage {{ ucfirst($table) }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a class="btn btn-success btn-sm" href="/crud/{{$table}}/create"> Create New {{ ucfirst($table) }}</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="{{$table}}_table">
                <thead>
                    <th>No</th>
                    @foreach($columnInfos as $key => $value)
                    <th>{{ convertColumnNameToString($key) }}</th>
                    @endforeach
                    <th style="width: 180px !important;">Action</th>
                </thead>

                <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
   
      
@endsection

@section('js')
    <script>
    $(function() {
        $columns_arr = [];
        var columnObj = <?php echo json_encode($columnInfos); ?>;
        const keys = Object.keys(columnObj);
        var columnConfig=[{ data: 'id', name: 'id' }];
        for(const key of keys){
            columnConfig.push({data: key, name: key});
        }
        columnConfig.push({data: 'actions', name: 'actions'});

        $('#{{$table}}_table').DataTable({
            "processing": true,
            "serverSide": true,
            "method": 'get',
            "paging": true,
            "pageLength": 10,
            "ajax": '{!! route('crud.data', $table) !!}',
            "columns": columnConfig
        });
    });
    </script>
@endsection