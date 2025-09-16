<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		// Default settings
		$defaults = [
			['key' => 'email_verification_enabled', 'value' => 'true'],
			['key' => 'two_factor_enabled', 'value' => 'true'],
			['key' => 'recaptcha_enabled', 'value' => 'false'],
			['key' => 'app_name', 'value' => 'AdminPortal'],
			['key' => 'sidebar_theme', 'value' => 'light'],
		];
		foreach ($defaults as $row) {
			Setting::updateOrCreate(['key' => $row['key']], ['value' => $row['value']]);
		}

		// Admin user
		User::firstOrCreate(
			['email' => 'admin@example.com'],
			[
				'name' => 'Super Admin',
				'username' => 'superadmin',
				'password' => Hash::make('password'),
			]
		);
	}
}