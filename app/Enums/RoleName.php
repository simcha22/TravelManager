<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case USER = 'user';
    case SUPERUSER = 'superuser';
    case CLIENT= 'client';
    case TRAVELING = 'traveling';
}
