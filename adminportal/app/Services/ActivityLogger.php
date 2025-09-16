<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
	public static function log(string $event, ?string $description = null, array $properties = []): void
	{
		Activity::create([
			'user_id' => optional(Auth::user())->id,
			'event' => $event,
			'description' => $description,
			'properties' => $properties,
		]);
	}
}