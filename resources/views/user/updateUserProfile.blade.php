
@extends('easy2inspect.user')
@section('content')

<style>
.updateProfile{

}  
</style>
  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('updateUserProfile') }}">{{ $title['title'] }} </a>
      </li>
    </ol>


    <div class="col-md-6 offset-md-3 AdminProfile">
      <form action="" method="POST">
        @csrf
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter first_name" name="first_name" value="{{ $userDetails->first_name }}">
          @error('first_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="last_name">Last Name:</label>
          <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter last_name" name="last_name" value="{{ $userDetails->last_name }}">
          @error('last_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ $userDetails->email }}">
          @error('email')
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
      <!-- /.container-fluid -->

      