<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function surname(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper($value),
            get: fn($value) => ucfirst($value)
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper($value),
            get: fn($value) => ucfirst($value)
        );
    }

}
