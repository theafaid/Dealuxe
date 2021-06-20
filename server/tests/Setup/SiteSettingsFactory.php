<?php

namespace Tests\Setup;

use App\Models\SiteSetting;

class SiteSettingsFactory
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create($data = [])
    {
        return factory(SiteSetting::class)->create($data);
    }
}
