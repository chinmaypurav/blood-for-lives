<?php

namespace Database\Factories;

use App\Models\BankDonation;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankDonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankDonation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_id' => mt_rand(1, 2),
            'donation_id' => mt_rand(1, 1000),
        ];
    }
}
