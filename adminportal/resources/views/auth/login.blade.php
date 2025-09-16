@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Login</div>
			<div class="card-body">
				<form method="POST" action="{{ route('login.post') }}" data-ajax="true">
					<div class="mb-3">
						<label class="form-label">Email or Username</label>
						<input type="text" name="login" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-check mb-3">
						<input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
						<label class="form-check-label" for="remember">Remember me</label>
					</div>
					<button class="btn btn-primary" type="submit">Login</button>
				</form>
				<div class="mt-3">
					<a href="{{ route('register.show') }}">Create an account</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection