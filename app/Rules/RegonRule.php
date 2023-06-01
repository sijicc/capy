<?php

namespace App\Rules;

use Attribute;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RegonRule implements ValidationRule
{
    public function getRules(): array
    {
        return [$this];
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            if (! preg_match('/^[0-9]{9,14}$/', $value)) {
                $fail('REGON must be 9 or 14 digits long.');
            }

            if (in_array($value, [
                '00000000000000',
                '11111111111111',
                '22222222222222',
                '33333333333333',
                '44444444444444',
                '55555555555555',
                '66666666666666',
                '77777777777777',
                '88888888888888',
                '99999999999999',
            ])) {
                $fail('REGON is invalid.');
            }

            $weightsForLength9 = [8, 9, 2, 3, 4, 5, 6, 7];
            $weightsForLength14 = [2, 4, 8, 5, 0, 9, 7, 3, 6, 1, 2, 4, 8];

            $sum = 0;

            if (strlen($value) === 9) {
                for ($i = 0; $i < 8; $i++) {
                    $sum += $value[$i] * $weightsForLength9[$i];
                }
            } else {
                for ($i = 0; $i < 13; $i++) {
                    $sum += $value[$i] * $weightsForLength14[$i];
                }
            }

            $controlNumber = $sum % 11;

            if ($controlNumber === 10) {
                $controlNumber = 0;
            }

            if ($controlNumber !== (int) $value[strlen($value) - 1]) {
                $fail('REGON is invalid.');
            }
        } catch (\Throwable $e) {
            $fail('REGON is invalid.');
        }
    }
}
