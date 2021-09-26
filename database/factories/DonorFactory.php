<?php

namespace Database\Factories;

use App\Models\BloodGroup;
use App\Models\User;
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
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Donor $donor) {
            //
        })->afterCreating(function (Donor $donor) {
            $donor->user->assignRole(4);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'blood_group_id' => \mt_rand(1, 9),
            'contact' => mt_rand(7000000000, 9999999999),
            'postal' => $this->faker->postcode(),
            'date_of_birth' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'donor_card_no' => $this->faker->postcode(),
            'safe_donate_at' => now(),
        ];
    }
}