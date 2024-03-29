<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'country_id' => Country::inRandomOrder()->first()?->id,
            'administrative_area' => $this->faker->word(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
