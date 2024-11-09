<?php

namespace App\Enums;

enum Day:int
{
    case LUNES = 1;
    case MARTES = 2;
    case MIERCOLES = 3;
    case JUEVES = 4;
    case VIERNES = 5;
    case SABADO = 6;
    case DOMINGO = 0;

    public function display(){
        return match($this){
            self::LUNES => 'Lunes',
            self::MARTES => 'martes',
            self::MIERCOLES => 'miercoles',
            self::JUEVES => 'jueves',
            self::VIERNES => 'viernes',
            self::SABADO => 'sabado',
            self::DOMINGO => 'domingo'
        };
    }
}
