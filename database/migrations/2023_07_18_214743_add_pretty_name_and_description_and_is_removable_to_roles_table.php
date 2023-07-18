<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('pretty_name')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_removable')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('pretty_name');
            $table->dropColumn('description');
            $table->dropColumn('is_removable');
        });
    }
};
