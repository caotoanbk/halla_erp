@extends('layouts.app')

@section('content')
<body id="page-top">

  <div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('approval') }}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">APPROVAL</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Request everything!</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-check-square fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('material') }}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">MATERIAL</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">BOM, MATERIAL IN/OUT</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dolly fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('product')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">PRODUCT</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Quantity</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-pallet fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('line-patrol')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">LINE PATROL</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Factory issues</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-camera fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('spare-part')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">SPARE PART</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Control spare part</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-boxes fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('qa-alert')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">QA ALERT</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Push QA issues alert</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-bullhorn fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('document')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">DOCUMENT</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">BOM, ISO, PFMEA</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-folder-open fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('employee')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">EMPLOYEE</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Information</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{url('admin')}}">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">ADMIN</div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin System</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-cogs fa-3x" style="color:#D2322D;"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
      </div>
      </div>

    </div>

  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a href="{{ route('logout') }}" class="btn btn-danger" 
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>
        </div>
      </div>
    </div>
  </div>

    <!-- Scripts -->
  @yield('js')
</body>
@endsection
