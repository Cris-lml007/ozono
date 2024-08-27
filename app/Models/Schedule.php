<?php

namespace App\Models;

use App\Enums\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = [
        'day',
        'start',
        'end'
    ];

    public function casts(): array
    {
        return [
            'day' => Day::class
        ];
    }
}
