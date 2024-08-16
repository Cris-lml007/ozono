<?php

namespace App\Enums;

enum Role:int
{
    case ADMIN=0;
    case MEDIC=1;
    case NURSE=2;
    case PATIENT=3;
}
