@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Two-Factor Authentication</div>
			<div class="card-body">
				<p>Secret: <code>{{ $secret }}</code></p>
				<p>
					QR (use authenticator app):
					<a href="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($otpauth) }}" target="_blank">Open QR</a>
				</p>
				<form method="POST" action="{{ route('2fa.enable') }}" data-ajax="true">
					<input type="hidden" name="secret" value="{{ $secret }}">
					<button class="btn btn-primary" type="submit">Enable 2FA</button>
				</form>
				<form class="mt-2" method="POST" action="{{ route('2fa.disable') }}" data-ajax="true">
					<button class="btn btn-outline-danger" type="submit">Disable 2FA</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection