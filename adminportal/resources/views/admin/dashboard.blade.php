@extends('layouts.app')

@section('content')
<div class="row g-3">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">Registration History</div>
			<div class="card-body">
				<canvas id="registrationsChart" height="120"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Quick Actions</div>
			<div class="card-body d-grid gap-2">
				<a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">Manage Users</a>
				<a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">Settings</a>
				<a href="{{ route('admin.backups.index') }}" class="btn btn-outline-dark">Backups</a>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const ctx = document.getElementById('registrationsChart');
		if (!ctx) return;
		fetch('{{ route('admin.dashboard.registrations') }}')
			.then(r => r.json())
			.then(({labels, data}) => {
				new Chart(ctx, {
					type: 'line',
					data: { labels, datasets: [{ label: 'Registrations', data, borderColor: '#0d6efd', fill: false }]},
					options: { responsive: true, scales: { y: { beginAtZero: true }}}
				});
			});
	});
</script>
@endsection