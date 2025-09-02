<?php

namespace Database\Factories;

use App\Models\Registrar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domain>
 */
class DomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->domainName(),
            'registrar_id' => Registrar::factory(), // sesuaikan jika ada seeder registrars
            'hosting' => $this->faker->randomElement([
                '-', 'Shared Hosting', 'Cloud Hosting',
                'WordPress Hosting', 'Unlimited Hosting',
                'VPS', 'Dedicated Server',
            ]),
            'registration_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'renewal_cost' => $this->faker->randomFloat(2, 5, 100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
