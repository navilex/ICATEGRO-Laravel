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
        Schema::table('students', function (Blueprint $table) {
            $table->string('state')->default('GUERRERO'); // Or just string
            $table->string('municipality');
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
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
