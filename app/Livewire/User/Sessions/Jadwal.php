<?php

namespace App\Livewire\User\Sessions;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\RoomSchedule;  // Pastikan model sudah diimport

#[Layout('components.layouts.user-layout')]
class Jadwal extends Component
{
    
    public function render()
    {
        // Ambil semua data jadwal dari tabel room_schedules
        $jadwal = RoomSchedule::all();

        // Mengirim data ke tampilan
        return view('livewire.user.sessions.jadwal', compact('jadwal'));
    }
}

