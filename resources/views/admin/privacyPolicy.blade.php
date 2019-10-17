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
        @if($privacy->count()==0)
        <a href="{{url('addPrivacyPolicy')}}" class="btn btn-primary " id="addEditButton">Add Privacy Policy</a>
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
	        @foreach($privacy as $privacies)	
	          <tr>
	            <td>{{ $i }}</td>
	            <td>{{ucwords($privacies->title)}}</td>
	            <td>
            		<a href="{{ url('editPrivacyPolicy/'.base64_encode($privacies->id))}}"  ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;

            		<a href="{{ url('deletePrivacyPolicy/'.base64_encode($privacies->id))}}" onclick="return confirm('Are you sure you want to delete this term of service?');" ><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
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

