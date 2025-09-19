<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_campaign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('camp_code', 100)->unique()->nullable();
            $table->string('title');
            $table->string('objective', 50)->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('age_group', 50)->nullable();
            $table->string('gender', 45)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('ads_place_type', 45)->nullable();
            $table->string('ads_position', 45)->nullable();
            $table->string('budget_type', 45)->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['1','0'])->default('0');
            $table->enum('camp_status', ['0','1','2','3','4'])->default('0');
            $table->text('reason')->nullable();
            $table->enum('step', ['1','2','3','4','5','6'])->default('1');
            $table->string('ads_file', 255)->nullable();
            $table->string('action_url', 255)->nullable();
            $table->timestamps();
            $table->index('client_id', 'clientCampID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_campaign');
    }
};

