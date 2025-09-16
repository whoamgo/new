<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        abort_unless(in_array($provider, ['google','twitter','facebook']), 404);
        if (! feature_enabled(strtoupper($provider).'_ENABLED', true)) {
            abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $account = SocialAccount::firstOrNew([
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId(),
        ]);

        if (! $account->exists) {
            $user = User::firstOrCreate([
                'email' => $socialUser->getEmail() ?? Str::uuid().'@example.local',
            ], [
                'name' => $socialUser->getName() ?: ($socialUser->getNickname() ?: 'User'),
                'username' => Str::slug($socialUser->getNickname() ?: $socialUser->getName() ?: 'user').'-'.Str::random(5),
                'password' => bcrypt(Str::random(32)),
                'email_verified_at' => now(),
            ]);
            $user->assignRole('Users');
            $account->fill([
                'user_id' => $user->id,
                'provider_user_email' => $socialUser->getEmail(),
                'data' => $socialUser,
            ])->save();
        }

        Auth::login($account->user);
        return redirect()->route('dashboard');
    }
}

