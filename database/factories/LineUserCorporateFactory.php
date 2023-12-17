<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LineUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineUserCorporate>
 */
class LineUserCorporateFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = fake()->company();

        return [
            'line_user_id' => LineUser::factory()->state(['name' => $company, 'personality_id' => \Personality::CORPORATE]),
            'manager' => fake()->name()
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
