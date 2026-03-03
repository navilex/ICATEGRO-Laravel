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
        Schema::create('especialidad_ocupacionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campo_formacion_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('modalidad');
            $table->string('clave');
            $table->string('objetivo')->nullable();
            $table->string('enfoque_educativo')->nullable();
            $table->string('cursos')->nullable();
            $table->string('sitios_insercion')->nullable();
            $table->string('certificacion_academica')->nullable();
            $table->string('certificacion_laboral')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialidad_ocupacionals');
    }
};
