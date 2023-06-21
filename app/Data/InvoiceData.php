<?php

namespace App\Data;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Models\Company;
use Carbon\Carbon;
use Cknow\Money\Money;
use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class InvoiceData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public string        $number,
        public int           $invoice_number_template_id,
        public InvoiceType   $type,
        public InvoiceStatus $status,

        public Money         $net_total,
        public Money         $tax_total,
        public Money         $gross_total,
        public string        $currency,
        public int           $exchange_rate,

        public Carbon        $issue_date,
        public Carbon        $sale_date,
        public Carbon        $due_date,
        public ?Carbon       $payment_date = null,

        public ?int          $customerable_id = null,
        public ?string       $customerable_type = Company::class,
        public ?CompanyData  $customer = null,

        public ?int          $receiverable_id = null,
        public ?string       $receiverable_type = Company::class,
        public ?CompanyData  $receiver = null,

        public ?int          $vendorable_id = null,
        public ?string       $vendorable_type = Company::class,
        public ?CompanyData  $vendor = null,

        public ?Money        $advance_total = null,
        public ?int          $final_id = null,
    )
    {
    }
}
