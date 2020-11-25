<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->country;

        return [
            'name' => ['en' => $name, 'ar' => $name],
            'image' => 'pic.png',
            'slug' => Str::slug($name),
            'status' => $this->faker->boolean,
        ];
    }
}