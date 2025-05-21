<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomSchedule extends Model
{
   use HasFactory;

    protected $fillable = [
        'room_id',
        'activity_name',
        'schedule_type',
        'semester',
        'day_of_week',
        'date',
        'start_time',
        'end_time',
        'booked_by',
        'lecturer',
        'class_name',
    ];

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Scope untuk jadwal akademik
    public function scopeAcademic($query)
    {
        return $query->where('schedule_type', 'academic');
    }

    // Scope untuk jadwal booking
    public function scopeBooking($query)
    {
        return $query->where('schedule_type', 'booking');
    }
}
