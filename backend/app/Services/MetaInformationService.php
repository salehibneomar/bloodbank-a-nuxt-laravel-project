<?php

namespace App\Services;
use App\Enums\BloodGroup;
use App\Enums\UserRole;
use App\Enums\AdminCache;

class MetaInformationService
{
    public function getMetaInformation(): array
    {
        $cacheKey = 'meta:information';
        $cacheTag = AdminCache::META_TAG->value;

        $data = cache()->tags($cacheTag)->get($cacheKey);

        if ($data === null) {
            $data = [
                'blood_groups' => BloodGroup::mappedBloodGroup(),
                'user_roles' => UserRole::allRoles(),
            ];
            dispatch(function () use ($cacheTag, $cacheKey, $data) {
                cache()->tags($cacheTag)->put($cacheKey, $data, AdminCache::invalidateTime());
            });
        }

        return $data;
    }
}
