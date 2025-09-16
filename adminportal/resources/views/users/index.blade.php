@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<span>Users</span>
		<a href="#" class="btn btn-sm btn-primary" id="btnCreateUser">Create</a>
	</div>
	<div class="card-body">
		<table id="usersTable" class="table table-striped table-bordered w-100">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Verified</th>
					<th>Roles</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script>
$(function(){
	$('#usersTable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ route('admin.users.index') }}',
		columns: [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'username', name: 'username'},
			{data: 'email', name: 'email'},
			{data: 'email_verified_at', name: 'email_verified_at'},
			{data: 'roles', name: 'roles', orderable: false, searchable: false},
			{data: 'actions', name: 'actions', orderable: false, searchable: false},
		]
	});
});
</script>
@endsection