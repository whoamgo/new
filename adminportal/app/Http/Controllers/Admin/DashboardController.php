<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
	public function index()
	{
		return view('admin.dashboard');
	}

	public function registrations(): JsonResponse
	{
		$days = 14;
		$labels = [];
		$data = [];
		for ($i = $days - 1; $i >= 0; $i--) {
			$day = Carbon::today()->subDays($i);
			$labels[] = $day->format('M d');
			$data[] = User::whereDate('created_at', $day)->count();
		}
		return response()->json(compact('labels', 'data'));
	}
}