
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="justify-content: space-between; margin-left: 170px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
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
    <h3 class="m-0 purple">MATERIALS</h3>
    <!-- Right navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>&nbsp;&nbsp;Hi, {{ auth()->user()->UserName }}&nbsp;&nbsp;<i class="fas fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-cog mr-2 blue"></i>&nbsp;Settings
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

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="width: 170px;">

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item pb-3 text-center">
            <img src="/img/hallalogo.png" style="max-height: 40px;">
          </li>
          <li class="nav-item">
            <a class="nav-link  @if(strpos(\URL::current(),"/crud/supplier") !== false) hoatdong @endif" href="/crud/supplier" style="Padding:5px 16px;color:white;">
            <i class="fas fa-long-arrow-alt-right"></i>
            <span>Supplier</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(strpos(\URL::current(),"/crud/materialtype") !== false) hoatdong @endif" href="/crud/materialtype" style="Padding:5px 16px;color:white;">
            <i class="fas fa-long-arrow-alt-right"></i>
            <span>Materialtype</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(strpos(\URL::current(),"/crud/material/") !== false) hoatdong @endif" href="/crud/material/" style="Padding:5px 16px;color:white;">
            <i class="fas fa-long-arrow-alt-right"></i>
            <span>Material</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(strpos(\URL::current(),"/crud/area") !== false) hoatdong @endif" href="/crud/area" style="Padding:5px 16px;color:white;">
            <i class="fas fa-long-arrow-alt-right"></i>
            <span>Area</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link @if(strpos(\URL::current(),"/crud/storage") !== false) hoatdong @endif" href="/crud/storage" style="Padding:5px 16px;color:white;">
            <i class="fas fa-long-arrow-alt-right"></i>
            <span>Storage</span></a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 170px;">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pt-4">
        <!-- Small boxes (Stat box) -->
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left:170px;">
    <strong>Copyright &copy; 2019 <a href="/">HEV</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
