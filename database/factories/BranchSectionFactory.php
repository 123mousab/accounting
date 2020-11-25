<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\BranchSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BranchSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BranchSection::class;

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
            'branch_id' => Branch::inRandomOrder()->first()->id,
            'status' => $this->faker->boolean
        ];
    }
}
