<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Crater\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create(['name' => 'pza', 'company_id' => 1]);
        Unit::create(['name' => 'cm', 'company_id' => 1]);
        Unit::create(['name' => 'lt', 'company_id' => 1]);
        Unit::create(['name' => 'gr', 'company_id' => 1]);
        Unit::create(['name' => 'kg', 'company_id' => 1]);
    }
}
