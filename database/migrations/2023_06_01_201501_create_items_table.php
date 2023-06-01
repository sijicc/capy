<?php

use App\Models\Invoice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Invoice::class);
            $table->string('name');
            $table->string('unit');
            $table->decimal('quantity', 10, 5);

            $table->bigInteger('net_unit');
            $table->bigInteger('net_total');

            $table->bigInteger('tax_unit');
            $table->integer('tax_rate')->default(23);
            $table->bigInteger('tax_total');

            $table->bigInteger('gross_unit');
            $table->bigInteger('gross_total');

            $table->bigInteger('discount_total')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
