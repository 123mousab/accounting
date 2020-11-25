<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

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
            'status' => $this->faker->boolean,
            'country_id' => Country::inRandomOrder()->first()->id
        ];
    }
}
