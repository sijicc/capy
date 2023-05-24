<?php

use App\Models\Address;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('nip', 10);
            $table->string('regon', 14);
            $table->string('krs', 10)->nullable();

            $table->foreignIdFor(Address::class, 'address_id');
            $table->foreignIdFor(Address::class, 'correspondence_address_id');
            $table->string('website')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
