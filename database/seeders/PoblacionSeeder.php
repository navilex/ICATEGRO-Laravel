<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoblacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poblaciones = [
            'ADOLESCENTES',
            'ADULTOS MAYORES',
            'MINORÍAS RELIGIOSAS',
            'MUJERES JEFAS DE FAMILIA',
            'PERSONAS AFRODESCENDIENTES',
            'PERSONAS CON DISCAPACIDAD',
            'PERSONAS DE LA DIVERSIDAD SEXUAL',
            'PERSONAS DESEMPLEADAS',
            'PERSONAS EN SITUACIÓN DE CALLE',
            'PERSONAS INDÍGENAS O PERTENECIENTES A ALGUNA ETNIA',
            'PERSONAS JÓVENES',
            'PERSONAS MIGRANTES, REFUGIADOS Y SOLICITANTES DE ASILO',
            'PERSONAS PRIVADAS DE LA LIBERTAD',
            'PERSONAS RESIDENTES EN INSTITUCIONES DE ASISTENCIA SOCIAL',
            'POBLACIONES MARGINADAS'
        ];

        foreach ($poblaciones as $poblacion) {
            \App\Models\Poblacion::create(['name' => $poblacion]);
        }
    }
}
