<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Camp;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Bank $bank) {
            //
        })->afterCreating(function (Bank $bank) {
            User::factory()->for($bank)->managerAdmin()->create();
            User::factory(mt_rand(0,5))->for($bank)->manager()->create();
            Camp::factory(mt_rand(0,5))->for($bank)->create();
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
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'bank_code' => $this->faker->unique()->numerify('BB###'),
            'address' => $this->faker->address(),
            'postal' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
