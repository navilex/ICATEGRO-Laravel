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
        Schema::create('curso_icategros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidad_ocupacional_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('modalidad');
            $table->integer('duracion_horas');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_icategros');
    }
};
