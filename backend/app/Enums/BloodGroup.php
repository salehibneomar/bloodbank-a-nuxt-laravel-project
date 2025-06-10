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
    case A1_POSITIVE = 'A1+';
    case A1_NEGATIVE = 'A1-';
    case A2_POSITIVE = 'A2+';
    case A2_NEGATIVE = 'A2-';
    case A1B_POSITIVE = 'A1B+';
    case A1B_NEGATIVE = 'A1B-';
    case A2B_POSITIVE = 'A2B+';
    case A2B_NEGATIVE = 'A2B-';

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
