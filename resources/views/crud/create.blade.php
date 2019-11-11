@extends(session('selectedFunc').'.layout')

@section('content')
<h2>Add New {{ ucfirst($table) }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <a class="btn btn-warning btn-sm" href="/crud/{{$table}}">&larr;&nbsp;Back</a>
    </div>
    <div class="card-body">
      <form action="/crud/{{$table}}/store" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            @foreach($columnInfos as $key => $value)
            @if(strpos($key, '_id') !== false)

            <?php
            $modelName = ucfirst(substr($key, 0, -3));
            $nameField = ucfirst(substr($key, 0, -3)).'Name';
            $string = '\\App\\'.ucfirst(substr($key, 0, -3)).'::pluck(ucfirst(substr($key, 0, -3))."Name", "id")';
            ${'items'.$loop->index} = eval("return $string;");
            ?>
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>{{convertColumnNameToString($key)}}:</strong>
                    {!! Form::select($key, ${'items'.$loop->index}, null,['class' => 'form-control', 'placeholder' => 'select..', 'data-live-search' => 'true'] ) !!}
                </div>
            </div>

            @elseif(strpos($key, 'Image') !== false)
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>{{convertColumnNameToString($key)}}:</strong>
                    <input type="file" name="{{$key}}" accept=".gif,.jpg,.jpeg,.png" id="imgInp">
                    <div class="pt-2">
                        <img class="d-none" id="blah" src="#" alt="your image" style="max-height: 150px;" />
                    </div>
                </div>
            </div>
            <script>
                function readURL(input) {
                  if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                      $('#blah').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                  }
                }

                $("#imgInp").change(function() {
                  $('#blah').removeClass('d-none');
                  readURL(this);
                });
            </script>
            @else

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>{{convertColumnNameToString($key)}}:</strong>
                    <input @if(strpos($key, 'Password') !== false) type="password" @else type="text" @endif name="{{$key}}" class="form-control" placeholder="">
                </div>
            </div>

            @endif
            @endforeach

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
  </div>
</div>
@endsection