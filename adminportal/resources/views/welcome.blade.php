@extends('layouts.app')

@section('content')
<div class="text-center py-5">
	<h1 class="mb-3">Welcome to {{ config('app.name', 'AdminPortal') }}</h1>
	<p class="lead">Secure, modern admin portal with roles, 2FA, social login, and more.</p>
	<a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Go to Dashboard</a>
</div>
@endsection