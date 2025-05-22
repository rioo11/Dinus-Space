<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('room_schedules', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('schedule_type');
            $table->text('rejection_reason')->nullable()->after('status');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_schedules', function (Blueprint $table) {
            //
        });
    }
};
