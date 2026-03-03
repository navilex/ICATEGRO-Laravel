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
            $table->string('tipo_instructor')->nullable()->after('registro_stps');
            $table->decimal('experiencia_laboral', 5, 1)->default(0.0)->after('tipo_instructor');
            $table->decimal('experiencia_docente', 5, 1)->default(0.0)->after('experiencia_laboral');
            $table->decimal('experiencia_sector_productivo', 5, 1)->default(0.0)->after('experiencia_docente');

            $table->string('rfc')->nullable()->after('experiencia_sector_productivo');
            $table->string('archivo_rfc')->nullable()->after('rfc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'tipo_instructor',
                'experiencia_laboral',
                'experiencia_docente',
                'experiencia_sector_productivo',
                'rfc',
                'archivo_rfc'
            ]);
        });
    }
};
