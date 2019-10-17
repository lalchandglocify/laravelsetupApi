<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Easy2Inspect Admin - {{ $title['title'] }}</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}"> 

  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">


  <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/admin/css/sb-admin.css') }}" rel="stylesheet">

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head> 

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand mr-1" href="{{url('userList')}}">Easy2Inspect Admin Dashboard</a>

 
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <!-- <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div> -->
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ url('updateAdminProfile') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp; Update Profile</a>
          <a class="dropdown-item" href="{{ url('updateAdminPassword') }}"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp; Change Password </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Logout</a>
        </div>
      </li>
    </ul> 

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="{{ url('adminDashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li> --> 
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('userList') }}">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('contactList') }}">
          <i class="fas fa-id-badge"></i>
          &nbsp;<span>Contacts</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('term') }}">
          <i class="fas fa-sticky-note"></i>
          &nbsp;<span>Terms</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('privacyPolicy') }}">
          <i class="fas fa-user-secret"></i>
          &nbsp;<span>Privacy Policy</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i>
          &nbsp;<span>Logout</span>
        </a>
      </li>
     <!--  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->
    </ul>

    <div id="content-wrapper">