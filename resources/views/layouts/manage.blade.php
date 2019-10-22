<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="/img/halla.png" />
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Halla Electronics Vina</title>

    <!-- Scripts -->
  <script src="https://kit.fontawesome.com/b56ae09687.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <div id="wrapper">

    @include('_includes.'.session('selectedFunc').'.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        @include('_includes.admin.top_nav')

      <div class="container-fluid">
        @yield('content')
      </div>
      
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Halla Electronics Vina 2019</span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
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
          <a href="{{ route('logout') }}" class="btn btn-primary" 
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $('.alert-success').delay(2000).slideUp();
  </script>
  @yield('js')
</body>

</html>
