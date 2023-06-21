<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'nip' => $this->faker->numberBetween(1000000000, 9999999999),
            'krs' => $this->faker->numberBetween(1000000000, 9999999999),
            'regon' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'address_id' => Address::factory(),
            'correspondence_address_id' => Address::factory(),
        ];
    }
}
