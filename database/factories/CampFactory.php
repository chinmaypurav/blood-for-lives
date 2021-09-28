<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\BloodComponent;
use App\Models\Camp;
use App\Models\Donation;
use App\Models\User;
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
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Camp $camp) {
            //
        })->afterCreating(function (Camp $camp) {
            User::factory(mt_rand(0, 10))
                ->hasAttached($camp->bank, [
                    'bank_id' => $camp->bank->id,
                    'camp_id' => $camp->id,
                    'blood_component' => array_rand(config('project.blood_component')),
                    'donated_at' => $this->faker->datetimeBetween('-1 year', '+1 year'),
                    // 'expiry_at' => $this->faker->datetimeBetween('+1 year', '+2 year'),
                    'status' => $this->faker->randomElement([
                        'raw', 'stored', 'transfused'
                    ]),
                ], 'banks')
                ->create();
            // Donation::factory()->create()
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
            'name' => 'Camp ' . mt_rand(1, 100),
            'bank_id' => mt_rand(1, 2),
            'address' => $this->faker->address(),
            'postal' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'camp_at' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
        ];
    }
}
