<?php

namespace App\Enums;

enum AdminCache: string
{
    case DASHBOARD_TAG = 'donors';
    case META_TAG = 'meta';

    public static function invalidateTime () : int {
        return 21600;
    }
}
