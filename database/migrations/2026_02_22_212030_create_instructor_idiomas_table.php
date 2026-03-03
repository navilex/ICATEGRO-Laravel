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
        Schema::create('instructor_idiomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->string('idioma');
            $table->boolean('estudio_extranjero')->default(false);
            $table->string('estado')->nullable();
            $table->string('municipio')->nullable();
            $table->string('institucion');
            $table->integer('porcentaje_conocimiento');
            $table->string('estatus_estudios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_idiomas');
    }
};
