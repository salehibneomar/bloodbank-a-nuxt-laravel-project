<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// This is the scheduler to run a job asynchronously every day at 6:00 AM
// The job checks for donors who have not donated in the last 3 months and updates their availability status to true because they are now eligible to donate again.
Schedule::job(new \App\Jobs\DonorAvailabilityStatusChange())
        ->dailyAt('06:00')
        ->withoutOverlapping();
//For local dev. env. use the command php artisan schedule:run but make sure you have php artisan queue:work redis running in another terminal to process the queued jobs.
// But when users inputs their last_donation_date manually the system will check that and make the status to false if it is less than 3 months from current date, for reference see the DonorService.php -> update function.
