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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('curp')->unique();
            $table->string('nombre');
            $table->string('apellido_1');
            $table->string('apellido_2')->nullable();
            $table->string('tipo_sangre');
            $table->string('estado_civil');
            $table->string('archivo_identificacion')->nullable();
            $table->string('archivo_curp')->nullable();
            $table->string('archivo_acta_nacimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
