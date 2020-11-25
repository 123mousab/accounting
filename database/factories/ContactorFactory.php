<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\City;
use App\Models\Contactor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contactor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'mobile' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->email,
            'area_id' => Area::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'status' => $this->faker->boolean
        ];
    }
}
