@extends(session('selectedFunc').'.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Overview</h1>
    </div>
    <div class="row">
      <ul class="list-group w-100">
        <li class="list-group-item list-group-item-action">Total companies:<div class="float-right text-danger">{{ count(\App\Company::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total divisions:<div class="float-right text-danger">{{ count(\App\Division::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total teams:<div class="float-right text-danger">{{ count(\App\Team::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total parts:<div class="float-right text-danger">{{ count(\App\Part::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total sections:<div class="float-right text-danger">{{ count(\App\Section::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total employees:<div class="float-right text-danger">{{ count(\App\Employee::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total subpages:<div class="float-right text-danger">{{ count(\App\Subpage::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total accesstexts:<div class="float-right text-danger">{{ count(\App\Accesstext::all()) }}</div></li>
        <li class="list-group-item list-group-item-action">Total accesslists:<div class="float-right text-danger">{{ count(\App\Accesslist::all()) }}</div></li>
      </ul>
    </div>
@endsection