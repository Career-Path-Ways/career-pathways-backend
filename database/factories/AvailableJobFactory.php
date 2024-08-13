<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AvailableJob>
 */
class AvailableJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle,
            'logo' => $this->generatePicsumLogo(),
            'description' => fake()->sentence,
            'about' => fake()->paragraph,
            'website' => fake()->url,
            'email' => fake()->unique()->safeEmail,
            'location' => fake()->city,
            'phone' => fake()->phoneNumber,
            'site' => fake()->domainName,
            'duration' => fake()->randomElement(['Full-time', 'Part-time', 'Contract']),
            'amount' => fake()->randomFloat(2, 1000, 10000), // Generates a random amount with 2 decimal places
            'created_at' => now(),
            'updated_at' => now(),
            'company_id' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }

    private function generatePicsumLogo()
    {
        $seed = fake()->uuid; // Generates a unique seed for each logo
        $width = 200;
        $height = 200;

        return "https://picsum.photos/seed/{$seed}/{$width}/{$height}";
    }
}
