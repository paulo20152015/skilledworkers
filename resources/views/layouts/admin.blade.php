<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PESO</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('fontawesome/css/font-awesome.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id='app'>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    
        <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
   
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">  
          <form action="/admin/logout" method="POST">
              @csrf
              <button type="submit" class="btn btn-navbar"><i
                class="fa fa-sign-out"></i> logout</button>
          </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/img/peso.png" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PESO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fa fa-user-circle-o fa-2x  img-circle elevation-2" style="color:white"></i>
        </div>
        <div class="info">
          
          <a href="#" class="d-block">{{auth()->user()->username}}</a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Admin Dashboard
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('authorizeAdmin', App\Admin::class)
              <li class="nav-item @yield('admin-active-triangle')">
                <a href='/admin/Admins' class="nav-link @yield('admin-active')">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Admins</p>
                </a>
              </li>
              @endcan
              <li class="nav-item @yield('companies-active-triangle')">
                <a href="/admin/companies" class="nav-link @yield('companies-active')">
                  <i class="fa fa-building nav-icon"></i>
                  <p>Companies</p>
                </a>
              </li>
              <li class="nav-item @yield('applicants-active-triangle')">
                <a href="/admin/applicants" class="nav-link @yield('applicants-active')">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Applicants/Employee</p>
                </a>
              </li>
              <li class="nav-item @yield('archive-active-triangle')">
                <a href="/admin/archive" class="nav-link @yield('archive-active')">
                  <i class="fa fa-archive nav-icon"></i>
                  <p>Archive</p>
                </a>
              </li>
              <li class="nav-item @yield('jobcategories-active-triangle')">
                <a href="/admin/job-post-cat" class="nav-link @yield('jobcategories-active')">
                  <i class="fa fa-archive nav-icon"></i>
                  <p>Job Post Categories</p>
                </a>
              </li>
              <li class="nav-item @yield('account-active-triangle')">
                <a href="/admin/account" class="nav-link @yield('account-active')">
                  <i class="fa fa-cogs nav-icon"></i>
                  <p>Account Settings</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @yield('aside')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer" style="padding: 10px;">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
       Skilled Workers Pool System for PESO Tarlac City
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;</strong> All rights reserved 2019-2020.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer>
    </script>
</body>
</html>
