@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Application Settings</div>
			<div class="card-body">
				<form id="settingsForm" data-ajax="true" method="POST" action="{{ route('admin.settings.index') }}">
					<div class="mb-3">
						<label class="form-label">Application Name</label>
						<input type="text" name="app_name" class="form-control" value="{{ config('app.name') }}">
					</div>
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" type="checkbox" name="email_verification_enabled" id="email_verification_enabled" checked>
						<label class="form-check-label" for="email_verification_enabled">Email Verification Enabled</label>
					</div>
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" type="checkbox" name="two_factor_enabled" id="two_factor_enabled" checked>
						<label class="form-check-label" for="two_factor_enabled">Two-Factor Authentication Enabled</label>
					</div>
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" type="checkbox" name="recaptcha_enabled" id="recaptcha_enabled">
						<label class="form-check-label" for="recaptcha_enabled">Google reCAPTCHA Enabled</label>
					</div>
					<div class="mb-3">
						<label class="form-label">Sidebar Theme</label>
						<select name="sidebar_theme" class="form-select">
							<option value="light">Light</option>
							<option value="dark">Dark</option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Application Logo</label>
						<input type="file" name="logo" class="form-control">
					</div>
					<button type="submit" class="btn btn-primary">Save Settings</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection