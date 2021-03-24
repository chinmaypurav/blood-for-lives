<?php

namespace Database\Factories;

use App\Models\Demand;
use App\Services\CompatibilityService;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $recipientGroup = $this->faker->randomElement([
            'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'HH'
        ]);
        $recipientComponent = $this->faker->randomElement([
            'whole', 'plasma', 'wbc'
        ]);
        $compatibleGroup = CompatibilityService::recipient($recipientComponent, $recipientGroup);
        return [
            'bank_id' => mt_rand(1, 10),
            'guardian_name' => $this->faker->name,
            'guardian_contact' => $this->faker->name,
            'recipient_name' => $this->faker->name,
            'recipient_group' => $recipientGroup,
            'recipient_component' => $recipientComponent,
            'compatible_group' => $compatibleGroup,
            'buffer_time' => mt_rand(1,5),
            'required_at' => $this->faker->dateTimeBetween('+1 day', '+15 days'),
            'required_units'  => mt_rand(1,3),
            // 'status' => ,
        ];
    }
}
