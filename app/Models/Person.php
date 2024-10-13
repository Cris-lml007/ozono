<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    use HasFactory;
    protected $table='persons';

    public $fillable = [
        'ci',
        'surname',
        'name',
        'birthdate',
        'gender',
        'pathological',
        'surgeries',
        'allergies'
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
            get: fn($value) =>  ucwords(strtolower($value))
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper($value),
            get: fn($value) =>  ucwords(strtolower($value))
        );
    }

    public function history(){
        return $this->hasMany(History::class);
    }

    public function diagnostics(){
        return DB::select("select d.* from diagnostics d join histories h on d.history_id = h.id join persons p on h.person_id = p.id where p.ci = $this->ci");
    }

}
