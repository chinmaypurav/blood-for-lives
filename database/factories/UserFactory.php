<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) {
            $user->assignRole('donor');
            $user->assignRole('recipient');
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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'blood_group' => $this->faker->randomElement([
                'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'HH'
            ]),
            'phone' => mt_rand(7000000000, 9999999999),
            'postcode' => $this->faker->postcode(),
            'date_of_birth' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'donor_card_no' => $this->faker->postcode(),
            'safe_donate_at' => now(),
        ];
    }

    /**
     * Define the model's super admin state.
     *
     * @return array
     */
    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Super Admin',
                'email' => 'admin@bloodforlives.org',

            ];
        })->afterCreating(function (User $user) {
            $user->assignRole('super-admin');
            $user->assignRole('admin');
        });
    }

    /**
     * Define the model's manager state.
     *
     * @return array
     */
    public function manager()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
        })->afterCreating(function (User $user) {
            $user->assignRole('manager');
        });
    }

    /**
     * Define the model's manager admin state.
     *
     * @return array
     */
    public function managerAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
        })->afterCreating(function (User $user) {
            $user->assignRole('manager');
            $user->assignRole('manager-admin');
        });
    }
}
