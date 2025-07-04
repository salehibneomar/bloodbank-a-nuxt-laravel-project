<?php

namespace App\Enums;

enum DonorCache: string
{
    case LIST_TAG = 'donors';

    public static function invalidateTime () : int {
        return 21600;
    }

}
