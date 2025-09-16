<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

if (! function_exists('current_user')) {
    function current_user(): ?\App\Models\User
    {
        return Auth::user();
    }
}

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        static $cache = [];
        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }
        $record = Setting::where('key', $key)->first();
        return $cache[$key] = $record?->value ?? $default;
    }
}

if (! function_exists('feature_enabled')) {
    function feature_enabled(string $key, bool $fallback = true): bool
    {
        $value = setting($key);
        if (is_null($value)) {
            return $fallback;
        }
        if (is_array($value) && isset($value['enabled'])) {
            return (bool) $value['enabled'];
        }
        return filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE) ?? $fallback;
    }
}

