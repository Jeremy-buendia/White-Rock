<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'user_id' => \App\Models\User::factory(),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'payload' => $this->faker->text(),
            'last_activity' => $this->faker->unixTime(),
        ];
    }
}
