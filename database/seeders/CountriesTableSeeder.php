<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $countries = array(
            array('id' => 142, 'code' => 'MX', 'name' => "Mexico", 'phonecode' => 52),
        );
        DB::table('countries')->insert($countries);
    }
}
