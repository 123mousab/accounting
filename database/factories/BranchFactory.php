<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

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
            'fax' => $this->faker->unique()->e164PhoneNumber,
            'branch_manger' => $this->faker->userName,
            'branch_phone' => $this->faker->phoneNumber,
            'area_id' => Area::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'status' => $this->faker->boolean
        ];
    }
}
