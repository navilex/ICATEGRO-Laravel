@extends('layouts.app')

@section('title', 'Listado de Usuarios - ICATEGRO')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Custom tweaks for DataTables to match the style somewhat */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
        }

        table.dataTable thead th {
            border-bottom: 2px solid #e5e7eb !important;
            padding: 10px 18px;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e5e7eb !important;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8 max-w-7xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-6 text-center shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <span
                    class="bg-gray-800 text-white text-xl w-8 h-8 rounded-md flex items-center justify-center mr-3 shadow">
                    <i class="fas fa-list-ul text-sm"></i>
                </span>
                LISTADO DE USUARIOS
            </h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-8">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="p-8">
            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full text-sm text-left text-gray-600 stripe hover">
                    <thead class="text-xs text-gray-800 font-bold bg-white border-b-2 border-gray-300">
                        <tr>
                            <th class="px-2 py-3">No.</th>
                            <th class="px-2 py-3">Tipo plantel</th>
                            <th class="px-2 py-3">Plantel/Dirección/Acción móvil</th>
                            <th class="px-2 py-3">Nombre</th>
                            <th class="px-2 py-3">Apellido1</th>
                            <th class="px-2 py-3">Apellido2</th>
                            <th class="px-2 py-3">Nivel de acceso</th>
                            <th class="px-2 py-3">Usuario</th>
                            <th class="px-2 py-3 text-center">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                $roleClean = strtolower(str_replace('USUARIO', '', $user->role));
                                $roleClean = trim($roleClean) === '' ? 'usuario' : trim($roleClean);

                                $plantelType = 'PLANTEL';
                                if (str_contains($user->adscription, 'MOVIL')) {
                                    $plantelType = 'ACCION MOVIL';
                                } elseif (str_contains($user->adscription, 'DIRECCION GENERAL') || $user->adscription == 'DG') {
                                    $plantelType = 'DIRECCION GENERAL';
                                }

                                $plantelDesc = $user->adscription;
                                if (str_contains($user->adscription, 'UNIDAD CAPACITACION')) {
                                    $plantelDesc = str_replace('UNIDAD CAPACITACION', '', $user->adscription);
                                } else if (str_contains($user->adscription, 'UNIDAD DE CAPACITACION')) {
                                    $plantelDesc = str_replace('UNIDAD DE CAPACITACION', '', $user->adscription);
                                }
                                $plantelDesc = trim($plantelDesc);
                            @endphp
                            <tr class="border-b transition duration-150 hover:bg-gray-50">
                                <td class="px-2 py-4 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-2 py-4 uppercase font-semibold text-gray-700">{{ $plantelType }}</td>
                                <td class="px-2 py-4 uppercase text-gray-700">{{ $plantelDesc }}</td>
                                <td class="px-2 py-4 uppercase">{{ $user->name }}</td>
                                <td class="px-2 py-4 uppercase">{{ $user->lastname }}</td>
                                <td class="px-2 py-4 uppercase">{{ $user->lastname2 ?? '' }}</td>
                                <td class="px-2 py-4 lowercase">{{ $roleClean }}</td>
                                <td class="px-2 py-4 lowercase">{{ $user->username }}</td>
                                <td class="px-2 py-4 text-center">
                                    <i class="fas fa-check-circle text-gray-800 text-lg"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                responsive: true,
                order: [[0, "asc"]], // Order by No.
                columnDefs: [
                    { orderable: false, targets: [8] } // Disable sorting on estatus column
                ]
            });
        });
    </script>
@endpush