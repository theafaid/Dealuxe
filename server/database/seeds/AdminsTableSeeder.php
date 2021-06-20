<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'Abdulrahman',
            'email' => 'abdulrahman_faid@outlook.com',
            'password' => bcrypt('hguhf lk hgkj1088'),
            'email_verified_at' => now(),
        ]);
    }
}
