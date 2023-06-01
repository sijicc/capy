<?php

namespace App\Rules;

use Attribute;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class NipRule implements ValidationRule
{
    public function getRules(): array
    {
        return [$this];
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $value = (string) $value;
            if (! preg_match('/^[0-9]{10}$/', $value)) {
                $fail('NIP must be 10 digits long.');
            }

            if (in_array($value, [
                '0000000000',
                '1111111111',
                '2222222222',
                '3333333333',
                '4444444444',
                '5555555555',
                '6666666666',
                '7777777777',
                '8888888888',
                '9999999999',
            ])) {
                $fail('NIP is invalid.');
            }

            $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

            $sum = 0;

            for ($i = 0; $i < 9; $i++) {
                $sum += $value[$i] * $weights[$i];
            }

            $controlNumber = $sum % 11;

            if ($controlNumber === 10) {
                $controlNumber = 0;
            }

            if ($controlNumber !== (int) $value[9]) {
                $fail('NIP is invalid.');
            }
        } catch (\Throwable $e) {
            $fail('NIP is invalid.');
        }
    }
}
