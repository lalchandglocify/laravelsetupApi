@extends('easy2inspect.user')

@section('content')
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ url('dashboard')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

      </div>
@endsection
