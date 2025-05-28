<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\RoomBooking;
use App\Models\RoomSchedule;

class bookings extends Component
{
        public $bookings;

    public function mount()
    {
        $this->bookings = RoomBooking::with('room', 'user')
            ->orderBy('date', 'desc')
            ->orderBy('start_time')
            ->get();
    }

    public function approve($bookingId)
    {
        $booking = RoomBooking::findOrFail($bookingId);

        if ($booking->status !== 'pending') return;

        $booking->status = 'approved';
        $booking->save();

        // Masukkan ke room_schedules
        RoomSchedule::create([
            'room_id' => $booking->room_id,
            'activity_name' => $booking->activity_name,
            'schedule_type' => 'booking',
            'date' => $booking->date,
            'start_time' => $booking->start_time,
            'end_time' => $booking->end_time,
            'booked_by' => $booking->user->name,
        ]);

        $this->mount(); // refresh data
    }

    public function reject($bookingId)
    {
        $booking = RoomBooking::findOrFail($bookingId);

        if ($booking->status !== 'pending') return;

        $booking->status = 'rejected';
        $booking->save();

        $this->mount(); // refresh data
    }
    public function render()
    {
        return view('livewire.admin.bookings.index');
    }
}
