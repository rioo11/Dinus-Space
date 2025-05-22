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

    public static function isConflict($roomId, $date, $startTime, $endTime, $ignoreId = null)
    {
        return self::where('room_id', $roomId)
            ->where('date', $date)
            ->whereIn('status', ['approved', 'pending']) // Cek konflik dengan yang sedang menunggu & disetujui
            ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
    }
}
