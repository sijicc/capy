<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_number_templates', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('template');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Company::class);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_number_templates');
    }
};
