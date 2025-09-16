<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
	public function index(Request $request)
	{
		if ($request->wantsJson()) {
			$activities = Activity::with('user')->orderByDesc('id')->limit(500)->get()->map(function ($a) {
				return [
					'id' => $a->id,
					'user' => optional($a->user)->email ?? '-',
					'event' => $a->event,
					'description' => $a->description,
					'created_at' => $a->created_at->toDateTimeString(),
				];
			});
			return response()->json(['data' => $activities]);
		}
		return view('activity.index');
	}
}