@extends('layouts.manage')

@include('manage.partials.nav-sidebar')

@section('content')
<h2>Edit {{ ucfirst($table) }}</h2>
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
          <a class="btn btn-warning btn-sm" href="/manage/{{$table}}">&larr;&nbsp;Back</a>
        </div>
    <div class="card-body">
    {!! Form::model($model, ['route' => ['manage.update', $table, $id]]) !!}
        {{ csrf_field() }}
        <input type="hidden" value="PATCH" name="_method">
         <div class="row">

            @foreach($columnInfos as $key => $value)
            @if(strpos($key, '_id') !== false)

            <?php
                $modelName = ucfirst(substr($key, 0, -3));
                $nameField = ucfirst(substr($key, 0, -3)).'Name';
                $string = '\\App\\'.ucfirst(substr($key, 0, -3)).'::pluck(ucfirst(substr($key, 0, -3))."Name", "id")';
                ${'items'.$loop->index} = eval("return $string;");
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{convertColumnNameToString($key)}}:</strong>
                    {!! Form::select($key, ${'items'.$loop->index}, null,['class' => 'form-control', 'placeholder' => 'select'] ) !!}
                </div>
            </div>

            @else

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{convertColumnNameToString($key)}}:</strong>
                    {!! Form::text($key, null,['class' => 'form-control', 'placeholder' => ''] ) !!}
                </div>
            </div>

            @endif
        @endforeach
            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection