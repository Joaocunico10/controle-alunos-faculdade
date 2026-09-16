<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case COORDENADOR = 'coordenador';
    case PROFESSOR = 'professor';
}
