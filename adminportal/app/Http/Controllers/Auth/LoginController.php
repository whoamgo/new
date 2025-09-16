<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
	public function showLogin()
	{
		return view('auth.login');
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
			'login' => ['required', 'string'],
			'password' => ['required', 'string'],
			'remember' => ['nullable', 'boolean'],
		]);

		$loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$user = User::where($loginField, $credentials['login'])->first();
		if (!$user || !Hash::check($credentials['password'], $user->password)) {
			return response()->json(['message' => 'Invalid credentials'], 422);
		}

		$emailVerificationEnabled = filter_var(Setting::where('key','email_verification_enabled')->value('value'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		if ($emailVerificationEnabled !== false && is_null($user->email_verified_at)) {
			return response()->json(['message' => 'Please verify your email address'], 423);
		}

		Auth::login($user, (bool)($credentials['remember'] ?? false));
		return response()->json(['redirect' => route('admin.dashboard')]);
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}