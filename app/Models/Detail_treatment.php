<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_treatment extends Model
{
    use HasFactory;
    // protected $table = 'detail_treatments';
    public $timestamps = false;
    public $fillable = [
        'treatment_id',
        'observation_id'
    ];
}
