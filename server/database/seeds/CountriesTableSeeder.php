<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {

        $countries = [
            [
                'name' => 'Egypt',
                'code' => 'EG',
            ],
        ];

        \DB::table('countries')->delete();
        \DB::table('countries')->insert($countries);
    }
}
