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
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->default('GUERRERO');
            $table->string('municipality')->default('CHILPANCINGO DE LOS BRAVO');
            $table->string('locality');
            $table->string('colony');
            $table->string('street');
            $table->string('exterior_number');
            $table->string('interior_number')->nullable();
            $table->string('zip_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'state',
                'municipality',
                'locality',
                'colony',
                'street',
                'exterior_number',
                'interior_number',
                'zip_code'
            ]);
        });
    }
};
