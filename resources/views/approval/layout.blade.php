
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INTERNAL APPROVAL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/approval.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-dark" style="justify-content: space-between; margin-left: 0px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-flex mr-1" style="align-items: center;">
        <img src="/img/hallalogo.png" style="max-height: 30px;">
      </li>
      <li class="nav-item d-none d-sm-inline-block mr-1">
        <a href="/" class="nav-link"><i class="fas fa-home"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          select function&nbsp;&nbsp;<i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{url('approval')}}" class="dropdown-item">
            <i class="fas fa-check-square mr-2 red"></i>&nbsp;APPROVAL
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('material')}}" class="dropdown-item">
            <i class="fas fa-dolly blue mr-2"></i>&nbsp;MATERIAL
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin')}}" class="dropdown-item">
            <i class="fas fa-cogs green mr-2"></i>&nbsp;ADMIN
          </a>
        </div>
      </li>
    </ul>
    <h2 class="m-0 text-white">INTERNAL APPROVAL</h2>
    <!-- Right navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-plus-circle"></i>&nbsp;New
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="/approval/purchase/create" class="dropdown-item">
            구매 요청/ Purchase Request
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            세금 요청/ Tax Request
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            기타 요청/ Other request
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            지불 계획/ Payment Plan
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link"><i class="fas fa-question-circle"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ auth()->user()->UserName }}&nbsp;&nbsp;<i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-id-badge green mr-2"></i>&nbsp;Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt red mr-2"></i>&nbsp;Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px; background: #fff;">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid" style="background: #fff;" id="approval_app">
      <div class="row">
        <vue-progress-bar></vue-progress-bar>
        @yield('content')
      </div>
    </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
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

<script src="/js/app.js"></script>
@yield('js')
<script>
  $('.alert.alert-success').delay(2000).slideUp();
</script>
</body>
</html>
