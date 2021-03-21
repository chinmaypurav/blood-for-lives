<?php

namespace Database\Factories;

use App\Models\Bank;
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
            $user = User::factory()->create([
                'email' => $bank->manager_email,
                'bank_id' => $bank->id
            ]);
            $user->assignRole(2);

            $user = User::factory()->count(3)->create([
                'bank_id' => $bank->id
            ])->each(function(User $user){
                $user->assignRole(3);
            });
            // $user->assignRole(3);
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
            'name' => $this->faker->company,
            'manager_email' => $this->faker->unique()->safeEmail,
            'bank_code' => $this->faker->unique()->numerify('BB###'),
            'address' => $this->faker->address,
            'address' => $this->faker->address,
            'postal' => $this->faker->postcode,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
