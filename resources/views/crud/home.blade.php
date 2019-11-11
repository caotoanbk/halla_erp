@extends(session('selectedFunc').'.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quick overview</h1>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/company')}}">Total Company</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Company::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/division')}}">Total Division</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Division::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/team')}}">Total Team</a></div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ count(\App\Team::all()) }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/part')}}">Total Part</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Part::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/section')}}">Total Section</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Section::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/employee')}}">Total Employee</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Employee::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/subpage')}}">Total Subpage</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Subpage::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/accesstext')}}">Total Accesstext</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Accesstext::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/accesslist')}}">Total Accesslist</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Accesslist::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
@endsection