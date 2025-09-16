<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Services\Recaptcha;
use App\Services\ActivityLogger;

class RegisterController extends Controller
{
	public function showRegister()
	{
		return view('auth.register');
	}

	public function register(Request $request)
	{
		$data = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'max:255', 'unique:users,username'],
			'email' => ['required', 'email', 'max:255', 'unique:users,email'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'g-recaptcha-response' => ['nullable', 'string']
		]);

		$recaptchaEnabled = filter_var(Setting::where('key','recaptcha_enabled')->value('value'), FILTER_VALIDATE_BOOLEAN);
		if ($recaptchaEnabled && !Recaptcha::verify($data['g-recaptcha-response'] ?? null)) {
			return response()->json(['message' => 'reCAPTCHA verification failed'], 422);
		}

		$user = User::create([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);

		$emailVerificationEnabled = filter_var(Setting::where('key','email_verification_enabled')->value('value'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		if ($emailVerificationEnabled === false) {
			$user->forceFill(['email_verified_at' => now()])->save();
		}

		Auth::login($user);
		ActivityLogger::log('auth.register', 'User registered', ['user_id' => $user->id]);
		return response()->json(['redirect' => route('admin.dashboard')]);
	}
}