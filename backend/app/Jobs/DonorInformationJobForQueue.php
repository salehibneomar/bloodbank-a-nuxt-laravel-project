<?php

namespace App\Jobs;

use App\Models\DonorInformation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;

class DonorInformationJobForQueue implements ShouldQueue
{
    use Queueable;

    protected $updatedInformation;
    protected $donor;

    public function __construct(array $updatedInformation, User | null $donor = null)
    {
        $this->updatedInformation = $updatedInformation;
        $this->donor = $donor;
    }

    public function handle()
    {
        $donorData = Arr::only($this->updatedInformation, (new DonorInformation)->getFillable());

        if ($this->donor) {
            DonorInformation::update(
                ['user_id' => $this->donor->id],
                $donorData
            );
        } else {
            DonorInformation::create($donorData);
        }
    }
}
