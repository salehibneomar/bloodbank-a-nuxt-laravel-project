<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Donor = 'donor';
    case Visitor = 'visitor';

    public static function allRoles(): array
    {
        return array_map(fn(self $role) => $role->value, self::cases());
    }

}



