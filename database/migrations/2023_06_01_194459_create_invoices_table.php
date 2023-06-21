<?php

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\InvoiceNumberTemplate;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('number')->unique();
            $table->foreignIdFor(InvoiceNumberTemplate::class);
            $table->string('type')->default(InvoiceType::INVOICE->value);
            $table->string('status')->default(InvoiceStatus::DRAFT->value);

            $table->bigInteger('net_total');
            $table->bigInteger('tax_total');
            $table->bigInteger('gross_total');
            $table->string('currency');
            $table->bigInteger('exchange_rate')->default(100);

            $table->bigInteger('advance_total')->nullable();
            $table->foreignIdFor(Invoice::class, 'final_id')->nullable();

            $table->datetime('issue_date');
            $table->datetime('sale_date');
            $table->datetime('due_date');
            $table->datetime('payment_date')->nullable();

            $table->nullableMorphs('customerable');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_zip');
            $table->string('customer_city');
            $table->foreignIdFor(Country::class, 'customer_country_id');
            $table->string('customer_nip');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();

            $table->nullableMorphs('receiverable');
            $table->string('receiver_name');
            $table->string('receiver_address');
            $table->string('receiver_zip');
            $table->string('receiver_city');
            $table->foreignIdFor(Country::class, 'receiver_country_id');
            $table->string('receiver_nip');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone')->nullable();

            $table->nullableMorphs('vendorable');
            $table->string('vendor_name');
            $table->string('vendor_address');
            $table->string('vendor_zip');
            $table->string('vendor_city');
            $table->foreignIdFor(Country::class, 'vendor_country_id');
            $table->string('vendor_nip');
            $table->string('vendor_email')->nullable();
            $table->string('vendor_phone')->nullable();

            $table->text('notes')->nullable();
            $table->foreignIdFor(User::class);
            $table->string('url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
