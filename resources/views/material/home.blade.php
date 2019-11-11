@extends('material.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Overview</h1>
    </div>
    <div class="row">
      <ul class="list-group w-100">
        <li class="list-group-item list-group-item-action">Total suppliers:<div class="float-right text-danger">{{ count(\App\Supplier::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total materialtypes:<div class="float-right text-danger">{{ count(\App\Materialtype::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total materials:<div class="float-right text-danger">{{ count(\App\Materialtype::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total areas:<div class="float-right text-danger">{{ count(\App\Area::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total storages:<div class="float-right text-danger">{{ count(\App\Storage::all()) }}</div></li>
      </ul>
    </div>
@endsection