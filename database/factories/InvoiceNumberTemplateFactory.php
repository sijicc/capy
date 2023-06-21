<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\InvoiceNumberTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvoiceNumberTemplateFactory extends Factory
{
    protected $model = InvoiceNumberTemplate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'template' => InvoiceNumberTemplate::INVOICE_TYPE
                .'/'.InvoiceNumberTemplate::CURRENT_YEAR
                .'/'.InvoiceNumberTemplate::NEXT_NUMBER_WITH_LEADING_ZEROS,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
