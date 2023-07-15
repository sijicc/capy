<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->paragraph(),
            'should_notify' => $this->faker->boolean(),
            'should_email' => $this->faker->boolean(),
            'publish_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'published_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
