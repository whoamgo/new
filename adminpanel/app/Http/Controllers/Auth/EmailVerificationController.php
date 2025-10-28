<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        if (! feature_enabled('EMAIL_VERIFICATION_ENABLED', true)) {
            return redirect()->route('dashboard');
        }
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if (! feature_enabled('EMAIL_VERIFICATION_ENABLED', true)) {
            return redirect()->route('dashboard');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('dashboard');
    }

    public function send(Request $request)
    {
        if (! feature_enabled('EMAIL_VERIFICATION_ENABLED', true)) {
            return response()->json(['message' => 'Disabled'], 403);
        }
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified']);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent']);
    }
}

