
@extends('admin.admin')
@section('content')

<style>
.updateProfile{

}  
</style>
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
          <label for="name">Name:</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" name="name" value="{{ $adminDetails->name }}">
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ $adminDetails->email }}">
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

      