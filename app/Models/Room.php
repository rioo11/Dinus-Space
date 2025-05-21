<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'building',
        'floor',
        'room_number',
        'room_type',
    ];
}
