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
        Schema::table('planteles', function (Blueprint $table) {
            $table->string('clasificacion')->nullable();
            $table->string('tipo')->nullable();
            $table->string('clave_cct')->unique()->nullable();
            $table->string('estado')->nullable();
            $table->string('municipio')->nullable();
            $table->string('colonia')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero_exterior')->nullable();
            $table->string('numero_interior')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('tipo_asignacion')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planteles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'clasificacion',
                'tipo',
                'clave_cct',
                'estado',
                'municipio',
                'colonia',
                'calle',
                'numero_exterior',
                'numero_interior',
                'codigo_postal',
                'tipo_asignacion',
                'user_id'
            ]);
        });
    }
};
