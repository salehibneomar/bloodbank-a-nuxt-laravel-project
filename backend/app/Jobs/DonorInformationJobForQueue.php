<?php

namespace App\Jobs;

use App\Models\DonorInformation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () {
            $donorInformation = $this->donor ? DonorInformation::where('user_id', $this->donor->id)->first() : new DonorInformation();
            $data = Arr::only($this->updatedInformation, $donorInformation->getFillable());
            $donorInformation->fill($data);
            $donorInformation->save();
        });
    }
}
