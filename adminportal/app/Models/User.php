<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;

	protected $fillable = [
		'name', 'username', 'email', 'password', 'two_factor_secret', 'two_factor_recovery_codes', 'avatar_path'
	];

	protected $hidden = [
		'password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'
	];
}