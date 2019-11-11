
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HEV</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="">

  <!-- Navbar -->
  <nav class="main-headers navbar navbar-expand navbar-white navbar-dark bg-primary py-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link d-flex font-weight-bold" style="align-items: center; color: #fff;">
            <img src="/img/hallalogo.png" style="max-height: 40px;"> 
            <span style="font-size: 24px;">&nbsp;Halla Electronics Vina</span>
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link text-white" data-toggle="dropdown" href="#">
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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px; background: #f8fafc;">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pt-5">
        <!-- Small boxes (Stat box) -->
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left: 0px;">
    <div class="container-fluid">    
        <strong>Copyright &copy; 2019 <a href="http://adminlte.io">HEV</a>.</strong>
        All rights reserved.
    </div>    
  </footer>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="/js/app.js"></script>
</body>
</html>
