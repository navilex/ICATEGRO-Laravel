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
            $table->string('banco_tipo')->nullable()->after('archivo_constancias_cursos');
            $table->string('banco_nombre')->nullable()->after('banco_tipo');
            $table->string('clabe')->nullable()->after('banco_nombre');
            $table->string('numero_cuenta')->nullable()->after('clabe');
            $table->string('numero_tarjeta')->nullable()->after('numero_cuenta');
            $table->string('archivo_estado_cuenta')->nullable()->after('numero_tarjeta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'banco_tipo',
                'banco_nombre',
                'clabe',
                'numero_cuenta',
                'numero_tarjeta',
                'archivo_estado_cuenta'
            ]);
        });
    }
};
