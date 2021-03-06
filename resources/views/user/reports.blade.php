@extends('easy2inspect.user')

@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
	  <li class="breadcrumb-item">
	    <a href="{{ url('reports')}}">{{ $title['title'] }}</a><a href=""
	  </li>
	</ol>
</div>

<div class="card mb-3">
  	<div class="card-header">
        <i class="fas fa-table"></i>
        {{ $title['title'] }}
       	<a href="{{url('addReport')}}" class="btn btn-primary " id="addEditButton">Add Report</a>
    </div>
	  	<div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>S.NO</th>
	            <th>Title</th>
	            <th>Document</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @php $i=1; @endphp	
	        @foreach($reports as $report)	
	          <tr>
	            <td>{{ $i }}</td>
	            <td>{{ucwords($report->first_name)}}</td>
	            <td>{{ $report->last_name }}</td>
	            
	            <td>
            		<a href="{{ url('editReport/'.base64_encode($report->id))}}"  ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;

            		<a href="{{ url('deleteReport/'.base64_encode($report->id))}}" onclick="return confirm('Are you sure you want to delete this user?');" ><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
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
