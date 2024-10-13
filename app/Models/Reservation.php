<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'staff_schedule_id',
        'date'
    ];

    public function person(){
        return $this->belongsTo(Person::class,'person_id','id');
    }

    public function staffSchedule(){
        return $this->belongsTo(Staff_schedule::class,'staff_schedule_id','id');
    }

    public function history(){
        return $this->hasOne(History::class,'reservation_id','id');
    }
}
