<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \Artisan::call('migrate:fresh');
//        $this->call(CountriesTableSeeder::class);
//        $this->call(CitiesTableSeeder::class);
        $this->call(SiteSettingsTableSeeder::class);

//        $this->call(BasicTablesSeeder::class);
    }
}
