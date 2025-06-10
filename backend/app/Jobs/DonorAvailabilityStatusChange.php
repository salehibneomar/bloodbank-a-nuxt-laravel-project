<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Enums\UserRole;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DonorAvailabilityStatusChange implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        DB::table('donor_information')
            ->join('users', 'donor_information.user_id', '=', 'users.id')
            ->where('users.role', UserRole::Donor->value)
            ->where('users.is_active', true)
            ->whereNotNull('donor_information.last_donation_date')
            ->where('donor_information.last_donation_date', '<=', $threeMonthsAgo)
            ->where('donor_information.is_available', '!=', true)
            ->update(['donor_information.is_available' => true]);
      // we are doing a raw query here to bulk update the availability status of donors who have not donated in the last 3 months at a single go, this is a one-setup query process.
    }
}
