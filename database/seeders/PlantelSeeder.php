<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planteles = [
            ['name' => 'DIRECCION GENERAL - DIRECCION GENERAL', 'tipo' => 'DIRECCION', 'clasificacion' => 'DIRECCION GENERAL'],
            ['name' => 'PLANTEL - AYUTLA', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - CHILPANCINGO', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - OLINALA', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - OMETEPEC', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - PUNGARABATO', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - TAXCO', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - TELOLOAPAN', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - TLAPA DE COMONFORT', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'PLANTEL - ZIHUATANEJO', 'tipo' => 'PLANTEL', 'clasificacion' => 'PLANTEL'],
            ['name' => 'ACCION MOVIL - ACAPULCO', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION MOVIL - CHILAPA', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION MOVIL - COYUCA DE BENITEZ', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION MOVIL - IGUALA', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION MOVIL - SAN MARCOS', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION MOVIL - TECPAN', 'tipo' => 'ACCION MOVIL', 'clasificacion' => 'ACCION MOVIL'],
            ['name' => 'ACCION EXTRAMUROS - TLAPEHUALA', 'tipo' => 'ACCION EXTRAMUROS', 'clasificacion' => 'ACCION EXTRAMUROS'],
        ];

        foreach ($planteles as $plantel) {
            \App\Models\Plantel::create($plantel);
        }
    }
}
