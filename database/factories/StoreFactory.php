<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Branch;
use App\Models\City;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

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
            'store_manager' => $this->faker->userName,
            'store_mobile' => $this->faker->phoneNumber,
            'branch_id' => Branch::inRandomOrder()->first()->id,
            'status' => $this->faker->boolean
        ];
    }
}
