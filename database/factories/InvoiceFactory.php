<?php

namespace Database\Factories;

use App\Actions\GenerateInvoiceNumberFromTemplate;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Models\Company;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\InvoiceNumberTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Str;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $template = InvoiceNumberTemplate::factory()->create();
        $customer = Company::factory()->create();
        $receiver = Company::factory()->create();
        $vendor = Company::factory()->create();

        return [
            //            'number' => (new GenerateInvoiceNumberFromTemplate())->handle(
            //                invoiceNumberTemplate: $template,
            //                type: InvoiceType::INVOICE,
            //            ),
            'number' => Str::random(16),
            'invoice_number_template_id' => $template->id,
            'type' => InvoiceType::INVOICE,
            'status' => InvoiceStatus::DRAFT,
            'net_total' => 1000,
            'tax_total' => 230,
            'gross_total' => 1230,
            'currency' => 'PLN',
            'exchange_rate' => 1,
            'advance_total' => null,
            'issue_date' => Carbon::now(),
            'sale_date' => Carbon::now(),
            'due_date' => Carbon::now(),
            'payment_date' => Carbon::now(),

            'customerable_id' => $customer->id,
            'customerable_type' => Company::class,
            'customer_name' => $customer->name,
            'customer_country_id' => Country::inRandomOrder()->first(),
            'customer_address' => $customer->address->street.' '.$customer->address->building_number,
            'customer_zip' => $customer->address->zip,
            'customer_city' => $customer->address->city,
            'customer_nip' => $customer->nip,
            'customer_email' => $this->faker->unique()->safeEmail(),
            'customer_phone' => $this->faker->phoneNumber(),

            'receiverable_id' => $receiver->id,
            'receiverable_type' => Company::class,
            'receiver_name' => $receiver->name,
            'receiver_country_id' => Country::inRandomOrder()->first(),
            'receiver_address' => $receiver->address->street.' '.$receiver->address->building_number,
            'receiver_zip' => $receiver->address->zip,
            'receiver_city' => $receiver->address->city,
            'receiver_nip' => $receiver->nip,
            'receiver_email' => $this->faker->unique()->safeEmail(),
            'receiver_phone' => $this->faker->phoneNumber(),

            'vendorable_id' => $vendor->id,
            'vendorable_type' => Company::class,
            'vendor_name' => $vendor->name,
            'vendor_country_id' => Country::inRandomOrder()->first(),
            'vendor_address' => $vendor->address->street.' '.$vendor->address->building_number,
            'vendor_zip' => $vendor->address->zip,
            'vendor_city' => $vendor->address->city,
            'vendor_nip' => $vendor->nip,
            'vendor_email' => $this->faker->unique()->safeEmail(),
            'vendor_phone' => $this->faker->phoneNumber(),

            'notes' => $this->faker->word(),
            'url' => $this->faker->url(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'final_id' => null,
            'user_id' => User::factory(),
        ];
    }
}
