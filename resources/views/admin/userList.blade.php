@extends('admin.admin')
@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ url('userList')}}">{{ $title['title'] }}</a>
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
	            <th>First Name</th>
	            <th>Last Name</th>
	            <th>Email</th>
	            <th>Last Login</th>
	            <th>User Status</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @php $i=1; @endphp	
	        @foreach($users as $user)	
	          <tr>
	            <td>{{ $i }}</td>
	            <td>{{ucwords($user->first_name)}}</td>
	            <td>{{ucwords($user->last_name)}}</td>
	            <td>{{strtolower($user->email)}}</td>
	            <td>{{date('F d,Y h:i A',strtotime($user->login_time))}}</td>
	            <td>
	            	@if($user->status == '1')
						<a href="{{ url('blockUser/'.base64_encode($user->id))}}" class="btn btn-success" onclick="return confirm('Are you sure you want to block this user?');">Active</a>
            		@else
            			<a href="{{ url('unblockUser/'.base64_encode($user->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to unblock this user?');">Blocked</a>
            		@endif
	            </td>
	            <td>
            		<a href="{{ url('editUser/'.base64_encode($user->id))}}"  ><i class="fas fa-edit"></i></a>&nbsp;&nbsp;

            		<a href="{{ url('deleteUser/'.base64_encode($user->id))}}" onclick="return confirm('Are you sure you want to delete this user?');" ><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
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

      