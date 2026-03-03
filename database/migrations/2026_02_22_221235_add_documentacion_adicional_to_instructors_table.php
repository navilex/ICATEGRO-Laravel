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
            $table->string('archivo_cv')->nullable()->after('archivo_estado_cuenta');
            $table->string('archivo_solicitud_empleo')->nullable()->after('archivo_cv');
            $table->string('observaciones')->nullable()->after('archivo_solicitud_empleo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'archivo_cv',
                'archivo_solicitud_empleo',
                'observaciones'
            ]);
        });
    }
};
