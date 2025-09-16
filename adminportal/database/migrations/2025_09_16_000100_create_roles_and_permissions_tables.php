<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->id();
			$table->string('name')->unique();
			$table->string('guard_name')->default('web');
			$table->timestamps();
		});

		Schema::create('permissions', function (Blueprint $table) {
			$table->id();
			$table->string('name')->unique();
			$table->string('guard_name')->default('web');
			$table->timestamps();
		});

		Schema::create('role_user', function (Blueprint $table) {
			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('user_id');
			$table->primary(['role_id','user_id']);
		});

		Schema::create('permission_role', function (Blueprint $table) {
			$table->unsignedBigInteger('permission_id');
			$table->unsignedBigInteger('role_id');
			$table->primary(['permission_id','role_id']);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('permission_role');
		Schema::dropIfExists('role_user');
		Schema::dropIfExists('permissions');
		Schema::dropIfExists('roles');
	}
};