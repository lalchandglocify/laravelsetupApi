<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- WebSite Title -->
<title> Easy 2 Inspect |
	@php

    $currentUrl = Request::url();
    $explodeUrl = explode('/',$currentUrl);

    @endphp

    @if(end($explodeUrl)=='login')
      Login
    @elseif(end($explodeUrl)=='register')
      Register
    @elseif(end($explodeUrl)=='verify')
      Email Verify
    @elseif(end($explodeUrl)=='reset')
      Forgot Password
    @else
      {{$title['title']}}
    @endif
</title>
</head>
<body>

<!-- Top Head Part Start -->
	<header class="TopHead  Register ">
		<div class="container">
			<div class="row">
				<nav class="navbar navbar-expand-md navbar-dark TopNavigation" data-sidebarClass="navbar-dark bg-dark">
			        <a class="navbar-brand" href="{{ url('')}}">
			        	<img src="{{ asset('assets/images/logo02.png') }}" alt="" class="img-fluid"  />
			        </a>
			        <button class="navbar-toggler leftNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
			            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			            <span class="navbar-toggler-icon"></span>
			        </button>
			        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			            <ul class="nav navbar-nav nav-flex-icons ml-auto MenuList">
			                <li class="nav-item">
			                    <a class="nav-link cus_hover" href="#">Solutions</a>
			                    <div class="MenuHoverList">
			                    	<ul class="DropDownList">
			                    		<li>
			                    			<a>What is Easy2Inspect?</a>
			                    			<ul class="sub-nav-list">
			                    				<li><a href="{{ url('howItWorks')}}">How it works</a></li>
			                    				<li><a href="{{ url('inspectionSoftware')}}">Inspection Software</a></li>
			                    				<li><a href="{{ url('mobileApp')}}">Mobile Inspection App</a></li>
			                    			</ul>
			                    		</li>
			                    		<li>
			                    			<a>Customizations</a>
			                    			<ul class="sub-nav-list">
			                    				<li><a href="{{url('sampleReports')}}">Sample Report</a></li>
			                    			</ul>
			                    		</li>
			                    		<li>
			                    			<a>Resources</a>
			                    			<ul class="sub-nav-list">
			                    				<li><a href="{{ url('contact') }}">Easy2Inspect Support</a></li>
			                    				<li><a href="{{ url('contact') }}">Contact Us</a></li>
			                    			</ul>
			                    		</li>
			                    	</ul>
			                    </div>
			                </li>

 			                <li class="nav-item">
			                    <a class="nav-link cus_hover" href="{{ url('mobileApp')}}">Mobile App</a>

			                </li>


			                <li class="nav-item dropdown">
			                    <a class="nav-link" href="{{url('whyUs')}}">Why Us?</a>
			                </li>
			                <li class="nav-item dropdown">
			                	@if(isset($userDetails) && $userDetails->user_type=='user')
			                		<a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
			                	@elseif(isset($userDetails) && $userDetails->user_type=='admin')
			                		<a class="nav-link" href="{{ url('adminDashboard') }}">Dashboard</a>
			                	@else
			                     	<a class="nav-link" href="{{ url('login') }}">Login</a>
			                    @endif
			                </li>
			                <li class="nav-item dropdown">
		                     	@if(isset($userDetails) && $userDetails->user_type=='user')
			                		<form method="POST" action = "{{ url('userLogout') }}">
		                			@csrf
			                		<button class="nav-link " id="frontLogout" type="submit">Logout</button>
			                		</form>

			                	@elseif(isset($userDetails) && $userDetails->user_type=='admin')
			                		<form method="POST" action = "{{ url('adminLogout') }}">
		                			@csrf
			                		<button class="nav-link " id="frontLogout" type="submit" >Logout</button>
			                		</form>
			                	@else
			                     	<a class="nav-link" href="{{ url('register') }}">Demo</a>
			                    @endif
			                </li>
			            </ul>
			        </div>
			    </nav>
			</div>
		</div>
	</header>





<!-- Top Head Part End -->


