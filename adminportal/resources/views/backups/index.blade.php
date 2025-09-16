@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">Backups</div>
	<div class="card-body d-grid gap-2">
		<form data-ajax="true" method="POST" action="{{ route('admin.backups.index') }}">
			<input type="hidden" name="action" value="db">
			<button type="submit" class="btn btn-outline-primary">Backup Database</button>
		</form>
		<form data-ajax="true" method="POST" action="{{ route('admin.backups.index') }}">
			<input type="hidden" name="action" value="files">
			<button type="submit" class="btn btn-outline-dark">Backup Files</button>
		</form>
	</div>
</div>
@endsection