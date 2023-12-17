<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Line;
use App\Models\LineNoticeType;
use App\Models\LineMessage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineNotice>
 */
class LineNoticeFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $line = Line::all()->random(1)[0];
        $lineNoticeType = LineNoticeType::all()->random(1)[0];
        $lineNoticeTypeId = $lineNoticeType->id;

        $address = fake()->address();

        return [
            'notice_date_time' => fake()->dateTimeBetween($startDate = '-2 week', $endDate = 'now'),
            'line_notice_type_id' => $lineNoticeType->id,
            'line_id' => $line->id,
            'line_message_id' => function() use ($lineNoticeTypeId)
            {
                if ($lineNoticeTypeId == \LineNoticeType::MESSAGE)
                {
                    return LineMessage::factory()->hasLineMessageText()->create();
                }
                else
                {
                    return null;
                }
            },
            'content' => $lineNoticeType->content,
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
