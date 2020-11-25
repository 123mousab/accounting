<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Country;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AreaCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory(10)->create()->each(function ($country) {
            $country->areas()->save(Area::factory()->make());
        });
    }
}
