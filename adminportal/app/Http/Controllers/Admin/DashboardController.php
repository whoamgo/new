<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	public function index()
	{
		return view('admin.dashboard');
	}

	public function registrations(): JsonResponse
	{
		$days = 14;
		$start = Carbon::today()->subDays($days - 1);
		$rows = User::select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(*) as c'))
			->whereDate('created_at', '>=', $start->toDateString())
			->groupBy('d')
			->orderBy('d')
			->get()
			->keyBy('d');

		$labels = [];
		$data = [];
		for ($i = 0; $i < $days; $i++) {
			$day = $start->copy()->addDays($i)->toDateString();
			$labels[] = Carbon::parse($day)->format('M d');
			$data[] = (int)($rows[$day]->c ?? 0);
		}
		return response()->json(compact('labels', 'data'));
	}
}