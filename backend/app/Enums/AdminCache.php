<?php

namespace App\Enums;

enum AdminCache: string
{
    case DASHBOARD_TAG = 'donors';

    public static function invalidateTime () : int {
        return 21600;
    }
}
