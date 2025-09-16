<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	public function index()
	{
		return view('settings.index');
	}

	public function save(Request $request)
	{
		$data = $request->validate([
			'app_name' => 'nullable|string|max:255',
			'email_verification_enabled' => 'nullable|boolean',
			'two_factor_enabled' => 'nullable|boolean',
			'recaptcha_enabled' => 'nullable|boolean',
			'sidebar_theme' => 'nullable|in:light,dark',
		]);

		$map = [
			'app_name', 'email_verification_enabled', 'two_factor_enabled', 'recaptcha_enabled', 'sidebar_theme'
		];
		foreach ($map as $key) {
			$value = $data[$key] ?? ($request->boolean($key) ? 'true' : 'false');
			Setting::updateOrCreate(['key' => $key], ['value' => (string)$value]);
		}

		return response()->json(['message' => 'Settings saved']);
	}
}