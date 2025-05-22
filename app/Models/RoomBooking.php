<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomBooking extends Model
{
        use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'activity_name',
        'date',
        'start_time',
        'end_time',
        'status',
        'rejection_reason',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function isConflict($roomId, $date, $startTime, $endTime, $ignoreId = null)
    {
        // Cek konflik dengan jadwal akademik
        $academicConflict = \App\Models\RoomSchedule::where('room_id', $roomId)
            ->where('date', $date)
            ->where('schedule_type', 'academic')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                              ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        // Cek konflik dengan booking lain yang disetujui atau menunggu persetujuan
        $bookingConflict = self::where('room_id', $roomId)
            ->where('date', $date)
            ->whereIn('status', ['pending', 'approved'])
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                              ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        return $academicConflict || $bookingConflict;
    }
}
