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
            $table->string('telefono_1')->nullable()->after('archivo_comprobante_domicilio');
            $table->string('telefono_2')->nullable()->after('telefono_1');
            $table->string('email')->nullable()->after('telefono_2');
            $table->string('email_trabajo')->nullable()->after('email');

            $table->boolean('cuenta_servicio_medico')->default(false)->after('email_trabajo');
            $table->string('nombre_servicio_medico')->nullable()->after('cuenta_servicio_medico');

            $table->string('escolaridad')->nullable()->after('nombre_servicio_medico');
            $table->string('condicion_escolar')->nullable()->after('escolaridad');
            $table->string('nombre_escuela')->nullable()->after('condicion_escolar');
            $table->string('cedula_profesional')->nullable()->after('nombre_escuela');
            $table->string('archivo_comprobante_estudios')->nullable()->after('cedula_profesional');

            $table->boolean('tiene_registro_stps')->default(false)->after('archivo_comprobante_estudios');
            $table->string('registro_stps')->nullable()->after('tiene_registro_stps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'telefono_1',
                'telefono_2',
                'email',
                'email_trabajo',
                'cuenta_servicio_medico',
                'nombre_servicio_medico',
                'escolaridad',
                'condicion_escolar',
                'nombre_escuela',
                'cedula_profesional',
                'archivo_comprobante_estudios',
                'tiene_registro_stps',
                'registro_stps'
            ]);
        });
    }
};
