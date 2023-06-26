<?php

namespace App\Actions;

use App\Models\Item;
use Validator;

readonly class CreateItem
{
    public function handle(array $item): Item
    {
        $validated = $this->validate($item);

        return Item::create($validated);
    }

    protected function validate(array $item): array
    {
        return Validator::make($item, [
            // TODO: add validation rules
        ])->validate();
    }
}
