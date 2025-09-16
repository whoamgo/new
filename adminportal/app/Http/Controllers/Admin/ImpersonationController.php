<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImpersonationController extends Controller
{
	public function start(Request $request, User $user)
	{
		if (!$request->user()) {
			abort(401);
		}
		$request->session()->put('impersonated_by', $request->user()->id);
		Auth::login($user);
		return redirect()->route('admin.dashboard');
	}

	public function stop(Request $request)
	{
		$originalId = $request->session()->pull('impersonated_by');
		if ($originalId) {
			Auth::loginUsingId($originalId);
		}
		return redirect()->route('admin.users.index');
	}
}