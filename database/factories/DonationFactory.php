<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,200),
            'bank_id' => mt_rand(1,20),
            'blood_component' => $this->faker->randomElement(config('project.blood_components')),
            'donated_at' => $this->faker->datetimeBetween('-1 year', '+1 year'),
            'status' => $this->faker->randomElement([
                'raw', 'stored', 'transfused'
            ]),
        ];
    }
}
