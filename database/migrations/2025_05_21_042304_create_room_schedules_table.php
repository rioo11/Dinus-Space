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
         Schema::create('room_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('activity_name');
            $table->enum('schedule_type', ['Academic', 'Booking']);
            $table->enum('day_of_week', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'])->nullable();
            $table->date('date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('booked_by')->nullable();
            $table->string('lecturer')->nullable();
            $table->string('class_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_schedules');
    }
};
