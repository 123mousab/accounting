<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

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
            'image' => 'unit' . $this->faker->numberBetween(1,10) . '.png',
            'status' => $this->faker->boolean,
        ];
    }
}
