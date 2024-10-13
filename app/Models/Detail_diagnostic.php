<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_diagnostic extends Model
{
    use HasFactory;

    public $fillable = [
        'diagnostic_id',
        'treatment_id',
        'price',
        'quantity',
        'by_day'
    ];

    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }

    public function histories(){
        return $this->hasMany(History::class,'detail_diagnostic_id','id');
    }
}
