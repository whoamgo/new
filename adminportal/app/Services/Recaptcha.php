<?php

namespace App\Services;

class Recaptcha
{
	public static function verify(?string $token): bool
	{
		$secret = env('NOCAPTCHA_SECRET');
		if (!$secret) return false;
		if (!$token) return false;
		$payload = http_build_query([
			'secret' => $secret,
			'response' => $token,
		]);
		$opts = [
			'http' => [
				'method' => 'POST',
				'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
				'content' => $payload,
				'timeout' => 5,
			],
		];
		$context = stream_context_create($opts);
		$result = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
		if ($result === false) return false;
		$data = json_decode($result, true);
		return (bool)($data['success'] ?? false);
	}
}