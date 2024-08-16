<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'logo' => $this->generatePicsumLogo(),
            'location' => fake()->city,
            'phone' => fake()->phoneNumber,
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
