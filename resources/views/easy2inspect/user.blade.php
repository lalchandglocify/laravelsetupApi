@php 

$currentUrl = Request::url();
$explodeUrl = explode('/',$currentUrl);

@endphp

@if(end($explodeUrl)=='reset' || end($explodeUrl)=='admin')
	@include('easy2inspect.includeUserLogin.innerheader')
@else
	@include('easy2inspect.includeUserLogin.header')
@endif

@yield('content')

@include('easy2inspect.includeUserLogin.footer')