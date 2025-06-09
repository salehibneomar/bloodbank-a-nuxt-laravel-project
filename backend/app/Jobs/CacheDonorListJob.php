<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Enums\DonorCache;

class CacheDonorListJob implements ShouldQueue
{
    use Queueable;

    protected $cacheKey;
    protected $totalKey;
    protected $data;
    protected $total;
    protected $invalidateCache;

    public function __construct(string $cacheKey, string $totalKey, array $data = [], int $total = 0, ?int $invalidateCache = null)
    {
        $this->cacheKey = $cacheKey;
        $this->totalKey = $totalKey;
        $this->data = $data;
        $this->total = $total;
        $this->invalidateCache = $invalidateCache ?? DonorCache::invalidateTime();
    }

    public function handle()
    {
        $commonTag = DonorCache::LIST_TAG->value;
        cache()->tags([$commonTag])->put($this->cacheKey, $this->data, $this->invalidateCache);
        cache()->tags([$commonTag])->put($this->totalKey, $this->total, $this->invalidateCache);
    }

}
