<?php

namespace Database\Factories;

use App\Models\BranchSection;
use App\Models\Category;
use App\Models\Color;
use App\Models\CompanyManufacture;
use App\Models\Currency;
use App\Models\Dealers;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Size;
use App\Models\Store;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'name' => ['en' => $name, 'ar' => $name],
            'slug' => Str::slug($name),
            'barcode' => $this->faker->unique()->words(2,2),
            'description' => $this->faker->paragraph,
            'image' => 'product' . $this->faker->numberBetween(1, 10) .'.png',
            'product_type_id' => ProductType::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'branch_section_id' => BranchSection::inRandomOrder()->first()->id,
            'company_manufacture_id' => CompanyManufacture::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
            'unit_id' => Unit::inRandomOrder()->first()->id,
            'size_id' => Size::inRandomOrder()->first()->id,
            'color_id' => Color::inRandomOrder()->first()->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
            'dealer_id' => Dealers::inRandomOrder()->first()->id,
            'expire_date' => $this->faker->boolean,
            'sale_price1' => $this->faker->randomFloat(1,50, 30),
            'multiply_factor' => $this->faker->randomFloat(1,50, 30),
            'number_of_small_unit' => $this->faker->numberBetween(1, 100),
            'contain_child_from_parent' => $this->faker->numberBetween(1, 100),
            'total_quantity' => $this->faker->numberBetween(1, 100),
            'has_parent' => 0,
            'favorite' => $this->faker->boolean,
            'related_store' => $this->faker->boolean,
            'related_tax' => $this->faker->boolean,
            'status' => $this->faker->boolean
        ];
    }
}
