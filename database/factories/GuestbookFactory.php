<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guestbook>
 */
class GuestbookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'comment' => $this->faker->realText(120)
        ];
    }

    public function withGuestRole()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::where('role', User::ROLE_GUEST)->inRandomOrder()->first()->id,
            ];
        });
    }
}
