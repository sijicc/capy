<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->char('alpha2', 2);
            $table->char('alpha3', 3);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
