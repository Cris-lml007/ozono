<?php

namespace App\Models;

use App\Enums\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'price'
    ];

    public function contrains()
    {
        return $this->belongsToMany(Observation::class, 'detail_treatments', 'treatment_id', 'observation_id')
                    ->where('observations.type', Type::CONTRAIN);
    }

    public function effects()
    {
        return $this->belongsToMany(Observation::class, 'detail_treatments', 'treatment_id', 'observation_id')
                    ->where('observations.type', Type::EFFECT);
    }

    public function observations()
    {
        return $this->belongsToMany(Observation::class, 'detail_treatments', 'treatment_id', 'observation_id');
    }
}
