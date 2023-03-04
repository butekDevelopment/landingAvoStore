<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        {{ $username }} &nbsp; <i class="fas fa-cog fa-lg"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right py-0">
        <a href="{{ url('/admin/profile') }}" class="dropdown-item py-2">
          <i class="fas fa-user fa-sm" style="col"></i> &nbsp; Profile
        </a>
        <div class="dropdown-divider my-0"></div>
        <a href="{{ url('/admin/profile/changePassword') }}" class="dropdown-item  py-2">
          <i class="fas fa-key fa-sm"></i> &nbsp; Ganti Password
        </a>
        <div class="dropdown-divider my-0"></div>
        <a href="{{ url('/admin/logOut') }}" class="dropdown-item  py-2">
          <i class="fas fa-power-off fa-sm"></i> &nbsp; Log Out
        </a>
      </div>
    </li>
  </ul>
</nav>