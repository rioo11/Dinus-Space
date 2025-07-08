<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
      * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan ruang kelas di Gedung A Lantai 2 (5 ruang kelas)
        DB::table('rooms')->insert([
            ['building' => 'A', 'floor' => 2, 'room_number' => 'A2.1', 'room_type' => 'Kelas'],
            ['building' => 'A', 'floor' => 2, 'room_number' => 'A2.2', 'room_type' => 'Kelas'],
            ['building' => 'A', 'floor' => 2, 'room_number' => 'A2.3', 'room_type' => 'Kelas'],
            ['building' => 'A', 'floor' => 2, 'room_number' => 'A2.4', 'room_type' => 'Kelas'],
            ['building' => 'A', 'floor' => 2, 'room_number' => 'A2.5', 'room_type' => 'Kelas'],
        ]);

        // Menambahkan ruang kelas di Gedung D Lantai 1 (4 ruang kelas)
        DB::table('rooms')->insert([
            ['building' => 'D', 'floor' => 1, 'room_number' => 'D1.1', 'room_type' => 'Kelas'],
            ['building' => 'D', 'floor' => 1, 'room_number' => 'D1.2', 'room_type' => 'Kelas'],
            ['building' => 'D', 'floor' => 1, 'room_number' => 'D1.3', 'room_type' => 'Kelas'],
            ['building' => 'D', 'floor' => 1, 'room_number' => 'D1.4', 'room_type' => 'Kelas'],
        ]);

         DB::table('rooms')->insert([
            ['building' => 'B', 'floor' => 1, 'room_number' => 'B1.1', 'room_type' => 'Aula'],

        ]);
        DB::table('rooms')->insert([
            ['building' => 'C', 'floor' => 1, 'room_number' => 'C1.1', 'room_type' => 'Lab DKV'],
           ['building' => 'C', 'floor' => 2, 'room_number' => 'C2.2', 'room_type' => 'Lab Komputer'],
           ['building' => 'C', 'floor' => 2, 'room_number' => 'C2.3', 'room_type' => 'Lab Foto'],
        ]);
        DB::table('rooms')->insert([
            ['building' => 'E', 'floor' => 2, 'room_number' => 'E2.1', 'room_type' => 'Lab Komputer'],
           ['building' => 'E', 'floor' => 2, 'room_number' => 'E2.2', 'room_type' => 'Lab Komputer'],
        ]);
    }
}
