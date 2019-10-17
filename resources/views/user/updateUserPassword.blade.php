
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
        <a href="{{ url('updateUserPassword') }}">{{ $title['title'] }} </a>
      </li>
    </ol>


    <div class="col-md-6 offset-md-3 AdminProfile">
      <form action="" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Old Password:</label>
          <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="name" placeholder="Enter old password" name="old_password" value="">
          @error('old_password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        

        <div class="form-group">
          <label for="email">New Password:</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="email" placeholder="Enter password" name="password" >
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>



        <div class="form-group">
          <label for="email">Confirm Password:</label>
          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password" placeholder="Re-type password" name="password_confirmation" value="">
          @error('password_confirmation')
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

      