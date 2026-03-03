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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidad_ocupacional_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('modalidad');
            $table->string('clave');
            $table->integer('duracion_horas');
            $table->string('cursos_prerrequisito')->nullable();
            $table->string('estrategias_aprendizaje')->nullable();
            $table->string('estrategias_evaluacion')->nullable();
            $table->string('certificacion_academica')->nullable();
            $table->string('documentos_apoyo')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
