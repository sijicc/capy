<?php

namespace App\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class AddressData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public ?int $country_id,
        public ?string $administrative_area,
        public ?string $city,
        public ?string $zip,
        public ?string $street,
    ) {
    }

    public static function rules(): array
    {
        return [
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'administrative_area' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
        ];
    }
}
