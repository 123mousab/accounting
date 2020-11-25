<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ColorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->colorName;
        return [
            'name' => ['en' => $name, 'ar' => $name],
            'slug' => Str::slug($name),
            'color' => $name,
            'status' => $this->faker->boolean,
        ];
    }
}
