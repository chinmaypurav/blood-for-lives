<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Manager::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->manager()->create(),
            'bank_id' => Bank::factory()->create(),
        ];
    }

    /**
     * Define the manager with bank state.
     *
     * @return array
     */
    public function bank()
    {
        return [
            'user_id' => User::factory()->create(),
            'bank_id' => Bank::factory()->create(),
        ];
    }

    /**
     * Define the manager One with bank state.
     *
     * @return array
     */
    public function managerOne()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory()->manager()->create([
                    'name' => 'Manager One',
                    'email' => 'managerone@gmail.com',
                ]),
                'bank_id' => Bank::factory()->create([
                    'name' => 'Bank One'
                ]),
            ];
        });
    }
}