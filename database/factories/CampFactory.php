<?php

namespace Database\Factories;

use App\Models\Camp;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Camp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Camp '. mt_rand(1, 100),
            'bank_id' => mt_rand(1, 10),
            'address' => $this->faker->address(),
            'postal' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'camp_at' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
        ];
    }
}
