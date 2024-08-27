<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table='persons';

    public $fillable = [
        'ci',
        'surname',
        'name',
        'birthdate',
        'gender'
    ];

    public function user(){
        return $this->hasOne(User::class,'person_id','id');
    }

    public function getActiveAttribute()
    {
        $user = $this->hasOne(User::class, 'person_id', 'id')->first();
        return $user ? $user->active : null;
    }

    public function getRoleAttribute(){
        $user = $this->hasOne(User::class, 'person_id', 'id')->first();
        return $user ? $user->role->display() : null;
    }

}
