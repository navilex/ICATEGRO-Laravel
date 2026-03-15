<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'curp' => 'ROSI900201HDFLRS06',
            'name' => 'Administrador',
            'lastname' => 'Sistema',
            'lastname2' => 'X',
            'state' => 'Guerrero',
            'municipality' => 'Chilpancingo',
            'locality' => 'Chilpancingo',
            'colony' => 'Centro',
            'street' => 'Av. Principal',
            'exterior_number' => 'S/N',
            'zip_code' => '39000',
            'phone' => '7400000000',
            'adscription' => 'Dirección General',
            'email' => 'admin@icategro.edu.mx',
            'username' => 'Admin',
            'password' => Hash::make('ICATEGRO2026'),
            'role' => 'ADMINISTRADOR',
            'permissions' => '["*"]',
        ]);
    }
}
