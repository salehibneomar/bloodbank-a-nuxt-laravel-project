<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Enums\DonorCache;
class InvalidateDonorCacheJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        cache()->tags([DonorCache::LIST_TAG->value])->flush();
    }
}
