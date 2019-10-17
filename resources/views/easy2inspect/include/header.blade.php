<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- WebSite Title -->
<title> Easy 2 Inspect |
	@php

    $currentUrl = Request::url();

    @endphp

    @if( $currentUrl == url(''))
      Home
    @else
      {{$title['title']}}
    @endif

</title>
</head>
<body>

<!-- Top Head Part Start -->
	<header class="TopHead">
	
	</header>
<!-- Top Head Part End -->
