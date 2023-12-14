<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LineAccountType;
use App\Models\LineAccountStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Line>
 */
class LineFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lineAccountStatus = LineAccountStatus::all()->random(1)[0];

        return [
            'account_id' => fake()->uuid(),
            'display_name' => fake()->name(),
            'line_account_type_id' => $lineAccountStatus->line_account_type_id,
            'line_account_status_id' => $lineAccountStatus->id
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
