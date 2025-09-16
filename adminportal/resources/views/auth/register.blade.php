@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Register</div>
			<div class="card-body">
				<form method="POST" action="{{ route('register.post') }}" data-ajax="true">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input type="email" name="email" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Confirm Password</label>
						<input type="password" name="password_confirmation" class="form-control" required>
					</div>
					<div class="mb-3">
						<div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
					</div>
					<button class="btn btn-primary" type="submit">Create Account</button>
				</form>
				<div class="mt-3">
					<a href="{{ route('login.show') }}">Already have an account?</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection