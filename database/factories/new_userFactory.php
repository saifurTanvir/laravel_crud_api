<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\new_user;

class new_userFactory extends Factory
{
    protected $model = new_user::class;

    public function definition()
    {
        return [
            'user_firstname' => $this->faker->name(),
            'user_lastname' => $this->faker->name(),
            'user_condition' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
