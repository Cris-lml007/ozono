<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    public $fillable = [
        'description',
        'history_id',
        'body_pain'
    ];

    public function history(){
        return $this->belongsTo(History::class);
    }

    public function detail_diagnostics(){
        return $this->hasMany(Detail_diagnostic::class,'diagnostic_id','id');
    }
}
