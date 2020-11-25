<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Branch;
use App\Models\BranchSection;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\CompanyManufacture;
use App\Models\Contactor;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Dealers;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\Store;
use App\Models\Unit;
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
        // \App\Models\User::factory(10)->create();
//         Category::factory(10)->create();
//         Country::factory(10)->create();
//        $this->call(AreaCountrySeeder::class);
//         City::factory(10)->create();
//         Branch::factory(10)->create();
//         BranchSection::factory(10)->create();
//         Contactor::factory(10)->create();
//         Currency::factory(5)->create();
//         Color::factory(5)->create();
//         Store::factory(10)->create();
//         Unit::factory(10)->create();
//        Dealers::factory(10)->create();
//        Size::factory(10)->create();
//        ProductType::factory(10)->create();
//        CompanyManufacture::factory(10)->create();
        Product::factory(20)->create();
    }
}
