<?php

namespace App\Livewire\User\Booking;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Room;
use App\Models\RoomSchedule;
use App\Models\RoomBooking;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.user-layout')]
class Index extends Component
{
    public $bookings;
    public $rooms;

    // Form input
    public $room_id, $date, $start_time, $end_time, $activity_name;
    public $successMessage;

    public function mount()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Ambil semua ruangan untuk form pemesanan
        $this->rooms = Room::all();

        // Ambil daftar booking milik user
        $this->bookings = RoomBooking::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('start_time')
            ->get();
    }

    protected function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'activity_name' => 'required|string|max:255',
        ];
    }

    public function submit()
    {
        $this->validate();

        // Cek apakah waktu bentrok dengan jadwal akademik / booking lain
        $conflict = RoomSchedule::where('room_id', $this->room_id)
            ->whereDate('date', $this->date)
            ->where(function ($q) {
                $q->where(function ($q2) {
                    $q2->where('start_time', '<', $this->end_time)
                       ->where('end_time', '>', $this->start_time);
                });
            })
            ->exists();

        if ($conflict) {
            $this->addError('start_time', 'Waktu yang dipilih bentrok dengan jadwal lain.');
            return;
        }

        RoomBooking::create([
            'user_id' => Auth::id(),
            'room_id' => $this->room_id,
            'activity_name' => $this->activity_name,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => 'pending',
        ]);

        // Reset form dan tampilkan pesan sukses
        $this->reset(['room_id', 'date', 'start_time', 'end_time', 'activity_name']);
        $this->successMessage = "Pemesanan berhasil diajukan dan menunggu persetujuan.";

        // Refresh daftar booking
        $this->mount();
    }

    public function render()
    {
        return view('livewire.user.booking.index');
    }
}
