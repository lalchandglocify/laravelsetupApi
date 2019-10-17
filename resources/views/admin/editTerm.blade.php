
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
          <label for="title">Title:</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter title" name="title" value="{{ $term->title }}" required="required">
          @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        

        <div class="form-group">
          <label for="email">Description:</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description" name="description" required="required" value="{{$term->description}}"></textarea>
          @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('#description').summernote('code','{!! $term->description !!}');
    });

  </script>>

@endsection
      <!-- /.container-fluid -->

      