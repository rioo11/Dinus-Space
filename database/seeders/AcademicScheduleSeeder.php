<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomSchedule;
use Illuminate\Support\Facades\DB;

class AcademicScheduleSeeder extends Seeder
{
    public function run()
    {
        // Ambil dulu ID ruangan yang sudah di-seed
        $roomA21 = DB::table('rooms')->where('room_number', 'A2.1')->first();
        $roomD11 = DB::table('rooms')->where('room_number', 'D1.1')->first();

        $data = [
            [
                'room_id' => $roomA21->id,
                'activity_name' => 'Kuliah Matematika',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Senin',
                'start_time' => '07:00:00',
                'end_time' => '09:00:00',
                'lecturer' => 'Dr. Budi',
                'class_name' => 'TI-1A',
            ],
            [
                'room_id' => $roomA21->id,
                'activity_name' => 'Kuliah Fisika',
                'schedule_type' => 'academic',
                'semester' => 'ganjil',
                'day_of_week' => 'Rabu',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'lecturer' => 'Dr. Sari',
                'class_name' => 'TI-1B',
            ],
            [
                'room_id' => $roomD11->id,
                'activity_name' => 'Kuliah Kimia',
                'schedule_type' => 'academic',
                'semester' => 'genap',
                'day_of_week' => 'Selasa',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'lecturer' => 'Dr. Ani',
                'class_name' => 'TI-2A',
            ],
        ];

        foreach ($data as $schedule) {
            RoomSchedule::create($schedule);
        }
    }
}
