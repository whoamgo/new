<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
	public function index(Request $request)
	{
		if ($request->wantsJson()) {
			$query = User::query();
			return response()->json([
				'data' => $query->limit(200)->get()->map(function ($u) {
					return [
						'id' => $u->id,
						'name' => $u->name,
						'username' => $u->username,
						'email' => $u->email,
						'email_verified_at' => $u->email_verified_at ? 'Yes' : 'No',
						'roles' => $u->roles()->pluck('name')->implode(', '),
						'actions' => '<a href="/admin/users/'.$u->id.'/impersonate" class="btn btn-sm btn-outline-secondary">Impersonate</a>'
					];
				})
			]);
		}
		return view('users.index');
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'username' => 'required|string|max:255|unique:users,username',
			'email' => 'required|email|max:255|unique:users,email',
			'password' => 'required|string|min:8',
			'roles' => 'array'
		]);
		$user = User::create([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);
		if (!empty($data['roles'])) {
			$roleIds = Role::whereIn('name', $data['roles'])->pluck('id');
			$user->roles()->sync($roleIds);
		}
		return response()->json(['message' => 'User created']);
	}
}