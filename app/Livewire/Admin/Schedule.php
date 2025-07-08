<?php

namespace App\Livewire\Admin;

use App\Models\Room;
use App\Models\RoomSchedule;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Schedule extends Component
{
    public $rooms;
    public $room_id;

    public $schedule_id;
    public $activity_name;
    public $schedule_type = 'Booking';

    // Booking
    public $date;
    public $booked_by;

    // Academic
    public $day_of_week;
    public $lecturer;
    public $class_name;

    // Common
    public $start_time;
    public $end_time;

    public $schedules = [];
    public $scheduleIdToDelete;

    public function mount()
    {
        $this->rooms = Room::all();
        $this->loadSchedules();
    }

    public function updatedRoomId()
    {
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
    $this->schedules = RoomSchedule::join('rooms', 'room_schedules.room_id', '=', 'rooms.id') // Melakukan join dengan tabel rooms
        ->select('room_schedules.*', 'rooms.room_number') // Pilih kolom dari room_schedules dan room_number dari rooms
        ->orderBy('rooms.room_number') // Urutkan berdasarkan room_number
        ->orderBy('room_schedules.start_time') // Urutkan berdasarkan waktu mulai
        ->get();
    }

    public function rules()
    {
        $base = [
            'room_id' => 'required|exists:rooms,id',
            'activity_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'schedule_type' => ['required', Rule::in(['Booking', 'Academic'])],
        ];

        if ($this->schedule_type === 'Booking') {
            $base['date'] = 'required|date';
            $base['booked_by'] = 'required|string|max:255';
        } else {
            $base['day_of_week'] = 'required|string|max:20';
            $base['lecturer'] = 'required|string|max:255';
            $base['class_name'] = 'required|string|max:100';
        }

        return $base;
    }

    public function resetForm()
    {
        $this->reset([
            'schedule_id',
            'activity_name',
            'schedule_type',
            'date',
            'booked_by',
            'day_of_week',
            'lecturer',
            'class_name',
            'start_time',
            'end_time',
        ]);
        $this->schedule_type = 'Booking';
    }

    public function openModal()
    {
        $this->resetForm();
        $this->modal('schedule-form')->show();
    }

    public function edit($id)
    {
        $schedule = RoomSchedule::findOrFail($id);
        $this->schedule_id = $schedule->id;
        $this->room_id = $schedule->room_id;
        $this->activity_name = $schedule->activity_name;
        $this->schedule_type = $schedule->schedule_type;
        $this->start_time = $schedule->start_time;
        $this->end_time = $schedule->end_time;

        if ($schedule->schedule_type === 'Booking') {
            $this->date = $schedule->date;
            $this->booked_by = $schedule->booked_by;
        } else {
            $this->day_of_week = $schedule->day_of_week;
            $this->lecturer = $schedule->lecturer;
            $this->class_name = $schedule->class_name;
        }

        $this->modal('schedule-form')->show();
    }

    public function store()
    {
        $validated = $this->validate();

        RoomSchedule::create([
            'room_id' => $this->room_id,
            'activity_name' => $this->activity_name,
            'schedule_type' => $this->schedule_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'date' => $this->schedule_type === 'Booking' ? $this->date : null,
            'booked_by' => $this->schedule_type === 'Booking' ? $this->booked_by : null,
            'day_of_week' => $this->schedule_type === 'Academic' ? $this->day_of_week : null,
            'lecturer' => $this->schedule_type === 'Academic' ? $this->lecturer : null,
            'class_name' => $this->schedule_type === 'Academic' ? $this->class_name : null,
        ]);

        $this->modal('schedule-form')->close();
        $this->loadSchedules();
        $this->resetForm();

        session()->flash('message', 'Jadwal berhasil ditambahkan.');
    }

    public function update()
    {
        $validated = $this->validate();

        $schedule = RoomSchedule::findOrFail($this->schedule_id);

        $schedule->update([
            'room_id' => $this->room_id,
            'activity_name' => $this->activity_name,
            'schedule_type' => $this->schedule_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'date' => $this->schedule_type === 'Booking' ? $this->date : null,
            'booked_by' => $this->schedule_type === 'Booking' ? $this->booked_by : null,
            'day_of_week' => $this->schedule_type === 'Academic' ? $this->day_of_week : null,
            'lecturer' => $this->schedule_type === 'Academic' ? $this->lecturer : null,
            'class_name' => $this->schedule_type === 'Academic' ? $this->class_name : null,
        ]);

        $this->modal('schedule-form')->close();
        $this->loadSchedules();
        $this->resetForm();

        session()->flash('message', 'Jadwal berhasil diperbarui.');
    }

    public function cancel()
    {
        $this->modal('schedule-form')->close();
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->scheduleIdToDelete = $id;
        $this->modal('confirm-delete')->show();
    }

    public function deleteSchedule()
    {
        RoomSchedule::destroy($this->scheduleIdToDelete);
        $this->scheduleIdToDelete = null;
        $this->loadSchedules();
        $this->modal('confirm-delete')->close();

        session()->flash('message', 'Jadwal berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.schedule.schedule');
    }
}
