@extends('admin.admin')
@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('term')}}">{{ $title['title'] }}</a>
      </li>
    </ol>

</div>


<div class="card mb-3">
  	<div class="card-header">
        <i class="fas fa-table"></i>
        {{ $title['title'] }}
        @if($terms->count()==0)
        <a href="{{url('addTerms')}}" class="btn btn-primary " id="addEditButton">Add Terms of Service</a>
        @endif
    </div>

	  	<div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>S.NO</th>
	            <th>Title</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @php $i=1; @endphp	
	        @foreach($terms as $term)	
	          <tr>
	            <td>{{ $i }}</td>
	            <td>{{ucwords($term->title)}}</td>
	            <td>
            		<a href="{{ url('editTerm/'.base64_encode($term->id))}}"  ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;

            		<a href="{{ url('deleteTerm/'.base64_encode($term->id))}}" onclick="return confirm('Are you sure you want to delete this term of service?');" ><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
            	</td>
	          </tr>
	        @php $i++;  @endphp  
	        @endforeach  
	        </tbody>
	      </table>
	    </div>
  	</div>
  
</div>


@endsection
      <!-- /.container-fluid -->

