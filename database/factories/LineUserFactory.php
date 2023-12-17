<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Line;
use App\Models\Prefecture;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineUserFactory>
 */
class LineUserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefecture = Prefecture::all()->random(1)[0];

        return [
            'line_id' => Line::factory(),
            'application_id' => fake()->word(),
            'mail' => fake()->email(),
            'tel_number' => fake()->phoneNumber(),
            'fax_number' => fake()->phoneNumber(),
            'post' => fake()->postcode(),
            'prefecture_id' => $prefecture->id,
            'municipalitie' => fake()->streetName(),
            'house_number' => fake()->buildingNumber(),
            'building' => fake()->streetAddress()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
        ]);
    }
}
