<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_schedule extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'schedule_id'
    ];
}
