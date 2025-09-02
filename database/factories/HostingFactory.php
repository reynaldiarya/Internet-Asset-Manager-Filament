<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hosting>
 */
class HostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_name' => $this->faker->word().' Hosting',
            'main_domain' => $this->faker->domainName(),
            'provider_id' => Provider::factory(), // sesuaikan jika ada seeder providers
            'purchase_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'renewal_cost' => $this->faker->randomFloat(2, 5, 200),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
