<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
	public function edit()
	{
		return view('profile.edit');
	}

	public function update(Request $request)
	{
		$user = $request->user();
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'username' => 'required|string|max:255|unique:users,username,'.$user->id,
			'email' => 'required|email|max:255|unique:users,email,'.$user->id,
		]);
		$user->update($data);
		return response()->json(['message' => 'Profile updated']);
	}

	public function avatar(Request $request)
	{
		$user = $request->user();
		$request->validate([
			'avatar' => 'required|image|max:2048',
		]);
		$path = $request->file('avatar')->store('public/avatars');
		$user->avatar_path = $path;
		$user->save();
		return response()->json(['message' => 'Avatar updated']);
	}
}