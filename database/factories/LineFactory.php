<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LineAccountType;
use App\Models\User;

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
        $userId = User::all()->random(1)[0]->id;
        $lineAccountTypeId = LineAccountType::all()->random(1)[0]->id;

        return [
            'account_id' => fake()->uuid(),
            'display_name' => fake()->name(),
            'user_id' => $userId,
            'line_account_type_id' => $lineAccountTypeId,
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
