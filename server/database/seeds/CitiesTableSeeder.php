<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
       $cities = [
           [
               'name' => 'Cairo',
               'district' => 'Kairo',
           ],
           [
               'name' => 'Alexandria',
               'district' => 'Aleksandria',
           ],
           [
               'name' => 'Giza',
               'district' => 'Giza',
           ],
           [
               'name' => 'Shubra al-Khayma',
               'district' => 'al-Qalyubiya',
           ],
           [
           ],
           [
               'name' => 'Suez',
               'district' => 'Suez',
           ],
           [
               'name' => 'al-Mahallat al-Kubra',
               'district' => 'al-Gharbiya',
           ],
           [
               'name' => 'Tanta',
               'district' => 'al-Gharbiya',
           ],
           [
               'name' => 'al-Mansura',
               'district' => 'al-Daqahliya',
           ],
           [
               'name' => 'Luxor',
               'district' => 'Luxor',
           ],
           [
               'name' => 'Asyut',
               'district' => 'Asyut',
           ],
           [
               'name' => 'Bahtim',
               'district' => 'al-Qalyubiya',
           ],
           [
               'name' => 'Zagazig',
               'district' => 'al-Sharqiya',
           ],
           [
               'name' => 'al-Faiyum',
               'district' => 'al-Faiyum',
           ],
           [
               'name' => 'Ismailia',
               'district' => 'Ismailia',
           ],
           [
               'name' => 'Kafr al-Dawwar',
               'district' => 'al-Buhayra',
           ],
           [
               'name' => 'Assuan',
               'district' => 'Assuan',
           ],
           [
               'name' => 'Damanhur',
               'district' => 'al-Buhayra',
           ],
           [
               'name' => 'al-Minya',
               'district' => 'al-Minya',
           ],
           [
               'name' => 'Bani Suwayf',
               'district' => 'Bani Suwayf',
           ],
           [
               'name' => 'Qina',
               'district' => 'Qina',
           ],
           [
               'name' => 'Sawhaj',
               'district' => 'Sawhaj',
           ],
           [
               'name' => 'Shibin al-Kawm',
               'district' => 'al-Minufiya',
           ],
           [
               'name' => 'Bulaq al-Dakrur',
               'district' => 'Giza',
           ],
           [
               'name' => 'Banha',
               'district' => 'al-Qalyubiya',
           ],
           [
               'name' => 'Warraq al-Arab',
               'district' => 'Giza',
           ],
           [
               'name' => 'Kafr al-Shaykh',
               'district' => 'Kafr al-Shaykh',
           ],
           [
               'name' => 'Mallawi',
               'district' => 'al-Minya',
           ],
           [
               'name' => 'Bilbays',
               'district' => 'al-Sharqiya',
           ],
           [
               'name' => 'Mit Ghamr',
               'district' => 'al-Daqahliya',
           ],
           [
               'name' => 'al-Arish',
               'district' => 'Shamal Sina',
           ],
           [
               'name' => 'Talkha',
               'district' => 'al-Daqahliya',
           ],
           [
               'name' => 'Qalyub',
               'district' => 'al-Qalyubiya',
           ],
           [
               'name' => 'Jirja',
               'district' => 'Sawhaj',
           ],
           [
               'name' => 'Idfu',
               'district' => 'Qina',
           ],
           [
               'district' => 'Giza',
           ],
           [
               'name' => 'Disuq',
               'district' => 'Kafr al-Shaykh',
           ],
       ];

       $countryId = \App\Models\Country::whereCode('eg')->first()->id;

       foreach($cities as $city){
           $city['country_id'] = $countryId;
           \DB::table('cities')->insert($city);
       }
    }
}
