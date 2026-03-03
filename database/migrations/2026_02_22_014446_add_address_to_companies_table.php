<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('state')->nullable();
            $table->string('municipality')->nullable();
            $table->string('colony')->nullable();
            $table->string('street')->nullable();
            $table->string('exterior_number')->nullable();
            $table->string('interior_number')->nullable();
            $table->string('zip_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'state',
                'municipality',
                'colony',
                'street',
                'exterior_number',
                'interior_number',
                'zip_code'
            ]);
        });
    }
};
