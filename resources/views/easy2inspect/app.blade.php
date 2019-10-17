@php

$currentUrl = Request::url();
$explodeUrl = explode('/',$currentUrl);

@endphp

@if($currentUrl==url(''))
	@include('easy2inspect.include.header')
@else
	@include('easy2inspect.include.innerHeader')
@endif


@yield('content')

@include('easy2inspect.include.footer')