<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Facades\Tests\Setup\SiteSettingsFactory;

class SiteSettingsTest extends TestCase
{
    /** @test */
    function it_save_site_settings_in_cache_after_created()
    {
        SiteSettingsFactory::create();

        $this->assertTrue(cache()->has('site_settings_test'));
    }
}
