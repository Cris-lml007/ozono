<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_schedule extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'schedule_id'
    ];

    public function staff(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class,'schedule_id','id');
    }

}
