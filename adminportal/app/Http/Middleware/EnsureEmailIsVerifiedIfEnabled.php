<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedIfEnabled
{
	public function handle(Request $request, Closure $next): Response
	{
		$enabled = filter_var(Setting::where('key','email_verification_enabled')->value('value'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		if ($enabled !== false && $request->user() && is_null($request->user()->email_verified_at)) {
			if ($request->expectsJson()) {
				return response()->json(['message' => 'Email verification required'], 423);
			}
			return redirect()->route('verification.notice');
		}
		return $next($request);
	}
}