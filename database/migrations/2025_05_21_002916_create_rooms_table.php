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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('building'); // Gedung (A, B, C, D, E)
            $table->integer('floor');  // Lantai (1, 2, dst)
            $table->string('room_number'); // Nomor ruangan (1.1, 2.1, dst)
            $table->string('room_type'); // Jenis ruangan (kelas, lab, ruang rapat)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
