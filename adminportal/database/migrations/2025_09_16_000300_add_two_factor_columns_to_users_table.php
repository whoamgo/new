<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->boolean('two_factor_enabled')->default(false)->after('two_factor_recovery_codes');
		});
	}

	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('two_factor_enabled');
		});
	}
};