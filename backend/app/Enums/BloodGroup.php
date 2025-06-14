<?php

namespace App\Enums;

enum BloodGroup: string {

    case A_POSITIVE = 'A+';
    case A_NEGATIVE = 'A-';
    case B_POSITIVE = 'B+';
    case B_NEGATIVE = 'B-';
    case AB_POSITIVE = 'AB+';
    case AB_NEGATIVE = 'AB-';
    case O_POSITIVE = 'O+';
    case O_NEGATIVE = 'O-';

    public static function allGroups(): array
    {
        return array_map(fn(self $group) => $group->value, self::cases());
    }

    public static function mappedBloodGroup(): array
    {
        $map = [];
        foreach (self::cases() as $case) {
            $value = $case->value;
            $newKey = str_replace(['+', '-'], ['ve', 'neg'], $value);
            $map[$newKey] = $value;
        }
        return $map;
    }

}
