<?php

namespace App\Enums;

enum Type:int
{
    case CONTRAIN=0;
    case EFFECT=1;

    public function display()
    {
        return match($this) {
            self::CONTRAIN => 'Contraindicacion',
            self::EFFECT => 'Efecto Secundario',
        };
    }

}
