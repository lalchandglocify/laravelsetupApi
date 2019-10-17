@extends('easy2inspect.user')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('updateAdminProfile') }}">{{ $title['title'] }} </a>
      </li>
    </ol>


    <div class="col-md-6 offset-md-3 AdminProfile">
      <form action="" method="POST">
        @csrf
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title" name="title" value="{{ old('title') }}" required="required">
          @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        	
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

@endsection
