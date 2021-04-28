<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Crater\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [

            [
                'name' => 'Mexican Peso',
                'code' => 'MXN',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.'
            ],

        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
