<?php

use App\Actions\CreateAddress;
use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use function Pest\Laravel\seed;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('allows user to create filled address', function () {
    seed(CountrySeeder::class);

    $address = [
        'country_id' => 4,
        'administrative_area' => 'śląskie',
        'city' => 'Katowice',
        'zip' => '40-000',
        'street' => 'ul. Testowa 1',
    ];

    (new CreateAddress())->handle($address);

    $this->assertDatabaseHas('addresses', $address);
});

it('allows user to create empty address', function () {
    seed(CountrySeeder::class);

    $address = [
        'country_id' => null,
        'administrative_area' => null,
        'city' => null,
        'zip' => null,
        'street' => null,
    ];

    (new CreateAddress())->handle($address);

    $this->assertDatabaseHas('addresses', $address);
});

it('doesn\'t allow user to create address with invalid country', function () {
    $address = [
        'country_id' => -1,
        'administrative_area' => 'śląskie',
        'city' => 'Katowice',
        'zip' => '40-000',
        'street' => 'ul. Testowa 1',
    ];

    $this->expect(fn() => (new CreateAddress())->handle($address))->toThrow(ValidationException::class);
    $this->assertDatabaseMissing('addresses', $address);
});
