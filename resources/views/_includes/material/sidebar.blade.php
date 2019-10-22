<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/material') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MATERIALs</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Materials
      </div>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/supplier') active @endif">
          <a class="nav-link" href="/crud/supplier" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Supplier</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/materialtype') active @endif">
          <a class="nav-link" href="/crud/materialtype" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Materialtype</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/material') active @endif">
          <a class="nav-link" href="/crud/material" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Material</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/area') active @endif">
          <a class="nav-link" href="/crud/area" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Area</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/storage') active @endif">
          <a class="nav-link" href="/crud/storage" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Storage</span></a>
      </li>

      <br>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>