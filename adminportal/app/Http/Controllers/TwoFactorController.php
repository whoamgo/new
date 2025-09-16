<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class TwoFactorController extends Controller
{
	public function show()
	{
		$user = auth()->user();
		$secret = $user->two_factor_secret ? Crypt::decryptString($user->two_factor_secret) : strtoupper(Str::random(32));
		$otpauth = 'otpauth://totp/'.urlencode(config('app.name').' ('.$user->email.')').'?secret='.$secret.'&issuer='.urlencode(config('app.name'));
		return view('auth.2fa', compact('secret', 'otpauth'));
	}

	public function enable(Request $request)
	{
		$request->validate(['secret' => 'required|string']);
		$user = $request->user();
		$user->two_factor_secret = Crypt::encryptString($request->input('secret'));
		$user->two_factor_enabled = true;
		$user->save();
		return response()->json(['message' => 'Two-factor enabled']);
	}

	public function disable(Request $request)
	{
		$user = $request->user();
		$user->two_factor_secret = null;
		$user->two_factor_enabled = false;
		$user->save();
		return response()->json(['message' => 'Two-factor disabled']);
	}
}