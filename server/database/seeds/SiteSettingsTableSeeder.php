<?php

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SiteSetting::create([
            'site_name' => 'Sky End Scope',
            'site_slogan' => 'Sky End Scope Slogan',
            'site_keywords' => 'sky, telescope, end scope',
            'site_description' => 'Buy Your Telescope now',
            'site_icon' => 'design/admin/img/default_icon.jpg',
            'site_logo' => 'design/admin/img/default_logo.png',
            'open' => true,
            'social_links' => json_encode([
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com'
            ]),
        ]);
    }
}
