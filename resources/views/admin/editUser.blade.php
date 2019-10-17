
@extends('admin.admin')
@section('content')

<style>
.updateProfile{

}  
</style>
  <div class="container-fluid">

    <!-- Breadcrumbs-->
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('updateAdminProfile') }}">Update Profile </a>
      </li>
    </ol>


    <div class="col-md-6 offset-md-3 AdminProfile">
      <form action="" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">First Name:</label>
          <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter first name" name="first_name" value="{{ $user->first_name }}" required="required">
          @error('first_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="name">Last Name:</label>
          <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter last name" name="last_name" value="{{ $user->last_name }}" required="required">
          @error('last_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>


        <div class="form-group">
          <label for="name">Phone Number:</label>
          <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Enter phone number" maxlength="10" name="phone_number" value="{{ $user->phone_number }}" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
          @error('phone_number')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>



        <div class="form-group">
          <label for="name">Email:</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ $user->email }}" required="required">
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

      