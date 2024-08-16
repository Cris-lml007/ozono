<?php

namespace App\Models;

use App\Enums\Type;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'type'
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value==Type::CONTRAIN->value ? 'Contraindicacion' : 'Efecto Secundario',
            set: fn(Type $value) => $value//=='Contraindicacion' ? Type::CONTRAIN : Type::EFFECT
        );
    }


    // protected function casts(): array
    // {
    //     return [
    //         'type' => Type::class
    //     ];
    // }

}
