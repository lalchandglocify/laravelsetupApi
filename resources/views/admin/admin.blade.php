@php 

$currentUrl = Request::url();
$explodeUrl = explode('/',$currentUrl);

@endphp

@if( end($explodeUrl)=='admin' || in_array('reset',$explodeUrl))
	@include('admin.include.innerHeader')
@else
	@include('admin.include.header')
@endif

@yield('content')

@include('admin.include.footer')