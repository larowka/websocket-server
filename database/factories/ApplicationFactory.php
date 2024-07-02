<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(strlen(mt_getrandmax()) - 1, true),
            'key' => $this->faker->unique()->uuid(),
            'secret' => $this->faker->unique()->uuid(),
            'ping_interval' => 60,
            'allowed_origins' => ['*'],
            'max_message_size' => 10_000,
            'options' => [
                'host' => 'localhost',
                'port' => 80,
                'scheme' => 'http',
                'useTLS' => false,
            ],
            'is_active' => false,
        ];
    }
}
