@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card mb-3">
			<div class="card-header">Profile</div>
			<div class="card-body">
				<form method="POST" action="{{ route('profile.update') }}" data-ajax="true">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
					</div>
					<button class="btn btn-primary" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Avatar</div>
			<div class="card-body">
				<form method="POST" action="{{ route('profile.avatar') }}" data-ajax="true" enctype="multipart/form-data">
					<div class="mb-3">
						<input type="file" class="form-control" name="avatar" accept="image/*" required>
					</div>
					<button class="btn btn-outline-primary" type="submit">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection