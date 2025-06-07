<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvalidateDonorCacheJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $redis = cache()->getRedis();
        $prefix = config('cache.prefix', 'laravel_cache');
        $pageKeys = $redis->keys("{$prefix}donors:view:page:*");
        if (!empty($pageKeys)) {
            $redis->del($pageKeys);
        }
        $redis->del("{$prefix}donors:view:total");
    }
}
