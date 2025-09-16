<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
	public function index()
	{
		return view('backups.index');
	}

	public function run(Request $request)
	{
		$action = $request->input('action');
		// Placeholder: would dispatch artisan commands like backup:run or backup:run --only-db
		return response()->json(['message' => 'Backup started: '.$action]);
	}
}