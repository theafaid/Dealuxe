<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'  => 'fixed2019',
            'type'  => 'fixed',
            'value' => '5000' // $50
        ]);

        Coupon::create([
            'code' => 'percent2019',
            'type' => 'percent',
            'value'=> '50' // 50%
        ]);
    }
}
