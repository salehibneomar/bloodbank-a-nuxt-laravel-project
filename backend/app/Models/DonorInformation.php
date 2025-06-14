<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonorInformation extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'donor_information';

    protected $fillable = [
        'address',
        'blood_group',
        'is_available',
        'last_donation_date',
        'profession',
        'religion',
        'age',
        'medical_conditions',
        'user_id'
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $casts = [
        'last_donation_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
