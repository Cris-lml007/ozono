<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $fillable = [
        'medic_id',
        'nurse_id',
        'person_id',
        'reservation_id',
        'Detail_diagnostic',
        'description',
        'presure',
        'temperature',
        'heart_rate',
        'respiratory_rate',
        'weight',
        'height',
        'canceled'
    ];

    public function medic(){
        return $this->belongsTo(Person::class,'medic_id','id');
    }

    public function nurse(){
        return $this->belongsTo(Person::class,'nurse_id','id');
    }

    public function person(){
        return $this->belongsTo(Person::class,'person_id','id');
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function diagnostic(){
        return $this->hasOne(Diagnostic::class);
    }

    public function detailDiagnostic(){
        return $this->belongsTo(Detail_diagnostic::class,'detail_diagnostic_id','id');
    }
}
