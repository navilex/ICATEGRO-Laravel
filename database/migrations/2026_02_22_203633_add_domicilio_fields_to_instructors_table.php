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
        Schema::table('instructors', function (Blueprint $table) {
            $table->string('estado')->nullable()->after('archivo_acta_nacimiento');
            $table->string('municipio')->nullable()->after('estado');
            $table->string('localidad')->nullable()->after('municipio');
            $table->string('colonia')->nullable()->after('localidad');
            $table->string('calle')->nullable()->after('colonia');
            $table->string('numero_exterior')->nullable()->after('calle');
            $table->string('numero_interior')->nullable()->after('numero_exterior');
            $table->string('codigo_postal')->nullable()->after('numero_interior');
            $table->string('archivo_comprobante_domicilio')->nullable()->after('codigo_postal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'estado',
                'municipio',
                'localidad',
                'colonia',
                'calle',
                'numero_exterior',
                'numero_interior',
                'codigo_postal',
                'archivo_comprobante_domicilio',
            ]);
        });
    }
};
