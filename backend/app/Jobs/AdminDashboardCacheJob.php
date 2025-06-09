<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Enums\AdminCache;

class AdminDashboardCacheJob implements ShouldQueue
{
    use Queueable;

    protected $cacheKey;
    protected $data;
    protected $invalidateCache;

    public function __construct($cacheKey, $data, ?int $invalidateCache = null)
    {
        $this->cacheKey = $cacheKey;
        $this->data = $data;
        $this->invalidateCache = $invalidateCache ?? AdminCache::invalidateTime();
    }

    public function handle(): void
    {
        $commonTag = AdminCache::DASHBOARD_TAG->value;
        cache()->tags([$commonTag])->put($this->cacheKey, $this->data, $this->invalidateCache);
    }
}
