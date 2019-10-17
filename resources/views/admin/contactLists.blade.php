@extends('admin.admin')
@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('contactList')}}">{{ $title['title'] }}</a>
      </li>
    </ol>

</div>


<div class="card mb-3">
  	<div class="card-header">
            <i class="fas fa-table"></i>
            {{ $title['title'] }}</div>
	  	<div class="card-body">
	    <div class="table-responsive">
	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>S.NO</th>
	            <th>Name</th>
	            <th>Email</th>
	            <th>Phone Number</th>
	            <th>Subject</th>
	            <th>Message</th>
	            <th>Created Date</th>
	          </tr>
	        </thead>
	        <tbody>
	        @php $i=1; @endphp	
	        @foreach($contactLists as $contactList)	
	          <tr>
	            <td>{{ $i }}</td>
	            <td>{{ucwords($contactList->name)}}</td>
	            <td>{{strtolower($contactList->email)}}</td>
	            <td>{{$contactList->phone_number}}</td>
	            <td>{{ucwords($contactList->subject)}}</td>
	            <td>{{ucwords($contactList->message)}}</td>
	            <td>{{date('F d,Y h:i:A',strtotime($contactList->created_at))}}</td>
	            
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

      