@extends('layouts.app')

@section('title', 'Dashboard - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 min-h-[400px]">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2 bg-amber-100 text-center rounded p-2">Avisos
            y Notificaciones</h1>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Bienvenido al nuevo Sistema de Control Escolar del ICATEGRO.
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <!-- Notifications -->
            <div class="p-4 border rounded hover:bg-gray-50 transition flex justify-between items-center shadow-sm">
                <span class="font-medium text-gray-700">FASE BETA DEL PROGRAMA REPORTAR FALLAS AL ADMINISTRADOR</span>
                <span class="bg-gray-900 text-white text-xs font-bold px-3 py-1 rounded-full">05-04-2026</span>
            </div>

            <div class="p-4 border rounded hover:bg-gray-50 transition flex justify-between items-center shadow-sm">
                <span class="font-medium text-gray-700">Próximamente modulo de impresiones</span>
                <span class="bg-gray-900 text-white text-xs font-bold px-3 py-1 rounded-full">05-04-2026</span>
            </div>

            <div class="p-4 border rounded hover:bg-gray-50 transition flex justify-between items-center shadow-sm">
                <span class="font-medium text-gray-700">Próximamente modulo de reportes</span>
                <span class="bg-gray-900 text-white text-xs font-bold px-3 py-1 rounded-full">05-04-2026</span>
            </div>
        </div>
    </div>
@endsection