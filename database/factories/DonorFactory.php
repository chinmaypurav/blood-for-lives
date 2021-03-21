<?php

namespace Database\Factories;

use App\Models\Donor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blood_group' => $this->faker->randomElement([
                                'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'HH'
                            ]),
            'contact' => mt_rand(7000000000, 9999999999),
            'postal' => $this->faker->postcode,
            'date_of_birth' => $this->faker->dateTimeBetween('-30 years', $endDate = '-18 years'),
            'donor_card_no' => $this->faker->postcode,
            'safe_donate_at' => now(),
        ];
    }
}
