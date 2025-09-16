@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">Activity Log</div>
	<div class="card-body">
		<table id="activityTable" class="table table-striped w-100">
			<thead>
				<tr>
					<th>ID</th>
					<th>User</th>
					<th>Event</th>
					<th>Description</th>
					<th>Created</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script>
$(function(){
	$('#activityTable').DataTable({
		processing: true,
		serverSide: false,
		ajax: '{{ route('admin.activity.index') }}',
		columns: [
			{data: 'id'},
			{data: 'user'},
			{data: 'event'},
			{data: 'description'},
			{data: 'created_at'}
		]
	});
});
</script>
@endsection