<?php

namespace App\Enums;

enum Role: int
{
    case ADMIN = 0;
    case MEDIC = 1;
    case NURSE = 2;
    case PATIENT = 3;

    public function display(){
        return match($this){
            self::ADMIN => 'Administrador',
            self::MEDIC => 'Medico',
            self::NURSE => 'Enfermera',
            self::PATIENT => 'Paciente'
        };
    }
}
