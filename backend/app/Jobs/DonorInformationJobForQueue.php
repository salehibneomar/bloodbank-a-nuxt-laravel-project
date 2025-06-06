<?php

namespace App\Jobs;

use App\Models\DonorInformation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonorInformationJobForQueue implements ShouldQueue
{
    use Queueable;

    protected $donorInformation;

    public function __construct(array $donorInformation)
    {
        $this->donorInformation = $donorInformation;
    }

    public function handle()
    {
        extract($this->donorInformation);
        $donorInformation = new DonorInformation();
        $donorInformation->user_id = $user_id;
        $donorInformation->blood_group = $blood_group;

        $donorInformation->save();

    }
}
