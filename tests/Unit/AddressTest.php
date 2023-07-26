<?php

use App\Actions\CreateAddress;
use App\Actions\EditAddress;
use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Validation\ValidationException;
use function Pest\Laravel\seed;

uses(Tests\TestCase::class, LazilyRefreshDatabase::class);

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

    $this->expect(fn () => (new CreateAddress())->handle($address))->toThrow(ValidationException::class);
    $this->assertDatabaseMissing('addresses', $address);
});

it('allows user to edit address with valid data', function () {
    seed(CountrySeeder::class);

    $addressData = [
        'country_id' => 4,
        'administrative_area' => 'śląskie',
        'city' => 'Katowice',
        'zip' => '40-000',
        'street' => 'ul. Testowa 1',
    ];

    $address = (new CreateAddress())->handle($addressData);

    $this->assertDatabaseHas('addresses', $addressData);

    $addressData['country_id'] = 8;

    (new EditAddress())->handle($address, $addressData);

    $this->assertDatabaseHas('addresses', $addressData);
});

it('doesn\'t allow user to edit address with invalid data', function () {
    seed(CountrySeeder::class);

    $addressData = [
        'country_id' => 4,
        'administrative_area' => 'śląskie',
        'city' => 'Katowice',
        'zip' => '40-000',
        'street' => 'ul. Testowa 1',
    ];

    $address = (new CreateAddress())->handle($addressData);

    $this->assertDatabaseHas('addresses', $addressData);

    $addressData['country_id'] = -1;

    $this->expect(fn () => (new EditAddress())->handle($address, $addressData))->toThrow(ValidationException::class);

    $this->assertDatabaseMissing('addresses', $addressData);
    $addressData['country_id'] = 4;
    $this->assertDatabaseHas('addresses', $addressData);
});
