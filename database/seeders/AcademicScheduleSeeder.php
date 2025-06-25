<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomSchedule;
use Illuminate\Support\Facades\DB;

class AcademicScheduleSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID ruangan yang sudah di-seed
        $roomA21 = DB::table('rooms')->where('room_number', 'A2.1')->first();
        $roomA22 = DB::table('rooms')->where('room_number', 'A2.2')->first();
        $roomD11 = DB::table('rooms')->where('room_number', 'D1.1')->first();
        $roomD12 = DB::table('rooms')->where('room_number', 'D1.2')->first();
        $roomB11 = DB::table('rooms')->where('room_number', 'B1.1')->first();
        $roomC11 = DB::table('rooms')->where('room_number', 'C1.1')->first();
        $roomC12 = DB::table('rooms')->where('room_number', 'C1.2')->first();
        $roomC13 = DB::table('rooms')->where('room_number', 'C1.3')->first();
        $roomE11 = DB::table('rooms')->where('room_number', 'E1.1')->first();
        $roomE12 = DB::table('rooms')->where('room_number', 'E1.2')->first();

        // Data jadwal terstruktur
        $data = [
            // Teknik Informatika (TI)
            [
                'room_id' => $roomA21->id,
                'activity_name' => 'Kuliah Pemrograman Dasar',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Senin',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
                'lecturer' => 'Dr. Budi',
                'class_name' => 'Teknik Informatika',
            ],
            [
                'room_id' => $roomA22->id,
                'activity_name' => 'Kuliah Algoritma',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Senin',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'lecturer' => 'Dr. Siti',
                'class_name' => 'Teknik Informatika',
            ],
            // Sistem Informasi (SI)
            [
                'room_id' => $roomD11->id,
                'activity_name' => 'Kuliah Basis Data',
                'schedule_type' => 'academic',
                'semester' => 'genap',
                'day_of_week' => 'Senin',
                'start_time' => '11:00:00',
                'end_time' => '13:00:00',
                'lecturer' => 'Dr. Ahmad',
                'class_name' => 'Sistem Informasi',
            ],
            [
                'room_id' => $roomD12->id,
                'activity_name' => 'Kuliah Sistem Informasi Manajemen',
                'schedule_type' => 'academic',
                'semester' => 'genap',
                'day_of_week' => 'Senin',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'lecturer' => 'Dr. Maya',
                'class_name' => 'Sistem Informasi',
            ],
            // Manajemen
            [
                'room_id' => $roomB11->id,
                'activity_name' => 'Kuliah Manajemen Keuangan',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Selasa',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
                'lecturer' => 'Dr. Alif',
                'class_name' => 'Manajemen',
            ],
            [
                'room_id' => $roomB11->id,
                'activity_name' => 'Kuliah Manajemen Pemasaran',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Selasa',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'lecturer' => 'Dr. Rani',
                'class_name' => 'Manajemen',
            ],
            // DKV (Desain Komunikasi Visual)
            [
                'room_id' => $roomC11->id,
                'activity_name' => 'Kuliah Desain Grafis',
                'schedule_type' => 'academic',
                'semester' => 'genap',
                'day_of_week' => 'Rabu',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
                'lecturer' => 'Dr. Ivan',
                'class_name' => 'DKV',
            ],
            [
                'room_id' => $roomC12->id,
                'activity_name' => 'Kuliah Fotografi',
                'schedule_type' => 'academic',
                'semester' => 'genap',
                'day_of_week' => 'Rabu',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'lecturer' => 'Dr. Sari',
                'class_name' => 'DKV',
            ],
            // Lab Komputer untuk Semua Prodi
            [
                'room_id' => $roomE11->id,
                'activity_name' => 'Praktikum Komputer',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Jumat',
                'start_time' => '18:00:00',
                'end_time' => '20:00:00',
                'lecturer' => 'Dr. Widya',
                'class_name' => 'Semua Prodi',
            ],
            [
                'room_id' => $roomE12->id,
                'activity_name' => 'Praktikum Web Development',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Jumat',
                'start_time' => '20:00:00',
                'end_time' => '22:00:00',
                'lecturer' => 'Dr. Dodi',
                'class_name' => 'Semua Prodi',
            ],
        ];

        // Menyimpan data ke dalam tabel RoomSchedule
        foreach ($data as $schedule) {
            RoomSchedule::create($schedule);
        }
    }
}
