<!-- Side Navbar -->
<nav class="side-navbar" style="min-height: 100vh;">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4">{{ Auth::user()->name }}</h1>
      <p>Admin</p>
    </div>
  </div>
  <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
  <ul class="list-unstyled">
    <li class="active"> <a href="#"><i class="icon-home"></i>Dashboard</a></li>
    <li class="active"> <a href="#"><i class="icon-user"></i>Officers</a></li>
    <li class="active"> <a href="#"><i class="icon-line-chart"></i>Reports</a></li>
  </ul><span class="heading">License</span>
  <ul class="list-unstyled">
    <li class="active"> <a href="#"><i class="glyphicon glyphicon-upload"></i>Update</a></li>
  </ul>
</nav>