<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function show()
    {
        abort_unless(feature_enabled('TWO_FACTOR_ENABLED', true), 404);
        return view('auth.2fa');
    }

    public function enable(Request $request, Google2FA $google2fa)
    {
        abort_unless(feature_enabled('TWO_FACTOR_ENABLED', true), 404);
        $user = $request->user();
        $secret = $google2fa->generateSecretKey();
        $user->two_factor_secret = $secret;
        $user->two_factor_enabled = false;
        $user->save();
        $qrUrl = $google2fa->getQRCodeUrl(config('app.name'), $user->email, $secret);
        return response()->json(['secret' => $secret, 'qr' => $qrUrl]);
    }

    public function confirm(Request $request, Google2FA $google2fa)
    {
        abort_unless(feature_enabled('TWO_FACTOR_ENABLED', true), 404);
        $data = $request->validate(['otp' => ['required','string']]);
        $user = $request->user();
        if (! $user->two_factor_secret) {
            return response()->json(['message' => 'No pending 2FA setup'], 422);
        }
        $valid = $google2fa->verifyKey($user->two_factor_secret, $data['otp']);
        if (! $valid) {
            return response()->json(['message' => 'Invalid code'], 422);
        }
        $user->two_factor_enabled = true;
        $user->save();
        return response()->json(['message' => '2FA enabled']);
    }

    public function disable(Request $request)
    {
        abort_unless(feature_enabled('TWO_FACTOR_ENABLED', true), 404);
        $user = $request->user();
        $user->two_factor_enabled = false;
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->save();
        return response()->json(['message' => '2FA disabled']);
    }
}

