<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Gender;
use App\Models\LineUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineUserIndividual>
 */
class LineUserIndividualFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = Gender::all()->random(1)[0];
        $name = fake()->name();

        return [
            'line_user_id' => LineUser::factory()->state(['name' => $name, 'personality_id' => \Personality::INDIVIDUAL]),
            'gender_id' => $gender->id,
            'birth_date' => fake()->dateTimeBetween($startDate = '-100 year', $endDate = '-20 year'),
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
