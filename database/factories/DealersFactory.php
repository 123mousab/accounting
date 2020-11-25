<?php

namespace Database\Factories;

use App\Models\Dealers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DealersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dealers::class;

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
            'mobile' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->email,
            'status' => $this->faker->boolean
        ];
    }
}
