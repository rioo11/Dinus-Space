<?php

namespace App\Livewire\Admin\Schedule;

use Livewire\Component;
use App\Models\RoomSchedule;
use App\Models\Room;

class Index extends Component
{
    public $room_id, $activity_name, $date, $start_time, $end_time, $booked_by;
    public $schedule_type = 'booking';
    public $semester, $day_of_week, $lecturer, $class_name;
    public $schedule_id = null;
    public $schedules = [];

    public function mount()
    {
        $this->room_id = Room::first()?->id;
        $this->loadSchedules();
    }

    public function updatedRoomId()
    {
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        if ($this->room_id) {
            $this->schedules = RoomSchedule::where('room_id', $this->room_id)
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
        } else {
            $this->schedules = [];
        }
    }

    public function store()
    {
        $this->validateFields();

        // Cek bentrok
        $conflict = $this->checkConflict();

        if ($conflict) {
            $this->addError('start_time', 'Ruangan sudah digunakan pada waktu tersebut.');
            return;
        }

        RoomSchedule::create($this->getScheduleData());

        $this->resetForm();
        $this->loadSchedules();
        session()->flash('message', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = RoomSchedule::findOrFail($id);
        $this->schedule_id   = $schedule->id;
        $this->room_id       = $schedule->room_id;
        $this->activity_name = $schedule->activity_name;
        $this->date          = $schedule->date;
        $this->start_time    = $schedule->start_time;
        $this->end_time      = $schedule->end_time;
        $this->booked_by     = $schedule->booked_by;
        $this->schedule_type = $schedule->schedule_type ?? 'booking';
        $this->semester      = $schedule->semester;
        $this->day_of_week   = $schedule->day_of_week;
        $this->lecturer      = $schedule->lecturer;
        $this->class_name    = $schedule->class_name;
    }

    public function update()
    {
        $this->validateFields();

        $schedule = RoomSchedule::findOrFail($this->schedule_id);

        $conflict = RoomSchedule::where('room_id', $this->room_id)
            ->where('date', $this->date)
            ->where('id', '!=', $this->schedule_id)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                    ->orWhere(function ($q) {
                        $q->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                    });
            })
            ->exists();

        if ($conflict) {
            $this->addError('start_time', 'Ruangan sudah digunakan pada waktu tersebut.');
            return;
        }

        $schedule->update($this->getScheduleData());

        $this->resetForm();
        $this->loadSchedules();
        session()->flash('message', 'Jadwal berhasil diperbarui.');
    }

    public function delete($id)
    {
        RoomSchedule::destroy($id);
        $this->resetForm();
        $this->loadSchedules();
        session()->flash('message', 'Jadwal berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->reset([
            'schedule_id', 'activity_name', 'date', 'start_time', 'end_time', 'booked_by',
            'semester', 'day_of_week', 'lecturer', 'class_name', 'schedule_type'
        ]);
    }

    protected function validateFields()
    {
        $rules = [
            'room_id'       => 'required|exists:rooms,id',
            'activity_name' => 'required|string',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',
            'schedule_type' => 'required|in:academic,booking',
        ];

        if ($this->schedule_type === 'academic') {
            $rules = array_merge($rules, [
                'semester'    => 'required',
                'day_of_week' => 'required',
                'lecturer'    => 'required|string',
                'class_name'  => 'required|string',
            ]);
        } else {
            $rules = array_merge($rules, [
                'date'      => 'required|date',
                'booked_by' => 'required|string',
            ]);
        }

        $this->validate($rules);
    }

    protected function getScheduleData()
    {
        return [
            'room_id'       => $this->room_id,
            'activity_name' => $this->activity_name,
            'date'          => $this->date,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'booked_by'     => $this->booked_by,
            'schedule_type' => $this->schedule_type,
            'semester'      => $this->semester,
            'day_of_week'   => $this->day_of_week,
            'lecturer'      => $this->lecturer,
            'class_name'    => $this->class_name,
        ];
    }

    public function render()
    {
        return view('livewire.admin.schedule.index', [
            'rooms' => Room::all(),
        ]);
    }
}
