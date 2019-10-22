<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN SYS</div>
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
        Admin System
      </div>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/company') active @endif">
          <a class="nav-link" href="/crud/company" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Company</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/division') active @endif">
          <a class="nav-link" href="/crud/division" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Division</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/team') active @endif">
          <a class="nav-link" href="/crud/team" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Team</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/part') active @endif">
          <a class="nav-link" href="/crud/part" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Part</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/section') active @endif">
          <a class="nav-link" href="/crud/section" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Section</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/employee') active @endif">
          <a class="nav-link" href="/crud/employee" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Employee</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/subpage') active @endif">
          <a class="nav-link" href="/crud/subpage" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Subpage</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/accesstext') active @endif">
          <a class="nav-link" href="/crud/accesstext" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Accesstext</span></a>
      </li>

      <li class="nav-item @if(\URL::current() == \URL::to('/').'/crud/accesslist') active @endif">
          <a class="nav-link" href="/crud/accesslist" style="Padding:5px 16px;color:white;">
          <i class="fas fa-fw fa-angle-right"></i>
          <span>Accesslist</span></a>
      </li>

      <br>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>