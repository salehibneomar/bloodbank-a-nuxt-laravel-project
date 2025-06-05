<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\UserRole;

class Donor extends User
{
    protected $table = 'users';

    protected static function booted(): void
    {
        static::addGlobalScope('donor', function (Builder $builder) {
            $builder->where('role', UserRole::Donor->value);
        });
    }
}
