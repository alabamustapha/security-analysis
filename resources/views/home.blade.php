@extends('layouts.app')

@section('content')
  <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">

          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big hidden-lg-down"><span>Admin</span><strong>Dashboard</strong></div>
                  <div class="brand-text brand-small"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                
                <!-- Logout    -->
                <li class="nav-item"><a href="{{ route('logout')}}" class="nav-link logout"
                        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                                            Logout>Logout<i class="fa fa-sign-out"></i>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></a></li>

              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        @include('layouts.partials.side-nav')
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
       
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>{{ config('app.name') }} &copy; 2017-2019</p>
                </div>
                
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
@endsection
