<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialAuthController extends Controller
{
	public function redirect(string $provider)
	{
		return redirect('/login'); // Placeholder without Socialite runtime
	}

	public function callback(string $provider)
	{
		// Placeholder: In real runtime, fetch provider user and login or create
		return redirect()->route('admin.dashboard');
	}
}