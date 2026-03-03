@extends('layouts.app')

@section('title', 'Lista de Convenios - ICATEGRO')

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        /* Modern DataTables Styling */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
            margin: 0 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #e2e8f0 !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            color: #334155 !important;
        }

        table.dataTable.stripe>tbody>tr.odd>*,
        table.dataTable.display>tbody>tr.odd>* {
            box-shadow: inset 0 0 0 9999px rgba(0, 0, 0, 0.02);
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8 max-w-7xl mx-auto mt-8">

        <!-- Header -->
        <div class="bg-[#d4b996] p-4 text-center shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center tracking-wide">
                <i class="fas fa-list-alt text-gray-800 mr-3 text-3xl"></i> LISTADO DE CONVENIOS
            </h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-6 shadow-sm">
                <span class="block sm:inline font-bold"><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
            </div>
        @endif

        <div class="p-6 overflow-x-auto">
            <table id="conveniosTable"
                class="w-full text-sm text-left text-gray-600 border-collapse display responsive nowrap" style="width:100%">
                <thead>
                    <tr class="border-b-2 border-gray-300 text-gray-800 font-bold bg-white">
                        <th class="px-4 py-3 uppercase tracking-wider text-center">No.</th>
                        <th class="px-4 py-3 uppercase tracking-wider text-center">ID convenio</th>
                        <th class="px-4 py-3 uppercase tracking-wider">Número de convenio</th>
                        <th class="px-4 py-3 uppercase tracking-wider">Nombre del convenio</th>
                        <th class="px-4 py-3 uppercase tracking-wider">Fecha inicia</th>
                        <th class="px-4 py-3 uppercase tracking-wider">Fecha termina</th>
                        <th class="px-4 py-3 uppercase tracking-wider w-1/4">Objeto</th>
                        <th class="px-4 py-3 uppercase tracking-wider text-center">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($convenios as $index => $convenio)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-center font-semibold text-gray-900">{{ $convenio->id }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $convenio->number }}</td>
                            <td class="px-4 py-3 uppercase">{{ $convenio->name }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($convenio->start_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($convenio->end_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-xs leading-tight uppercase">{{ Str::limit($convenio->object, 80) }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($convenio->pdf_document)
                                    <a href="{{ Storage::url($convenio->pdf_document) }}" target="_blank"
                                        title="Ver Archivo de Convenio"
                                        class="text-blue-500 hover:text-blue-700 transition transform hover:scale-110 inline-block">
                                        <i class="fas fa-file-pdf text-2xl drop-shadow-sm"></i>
                                    </a>
                                @else
                                    <span class="text-gray-300" title="Sin archivo"><i class="fas fa-file-pdf text-xl"></i></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#conveniosTable').DataTable({
                responsive: true,
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
                columnDefs: [
                    { orderable: false, targets: [7] }, // Disable sorting on PDF column
                    { className: "text-center", targets: [0, 1, 7] }
                ],
                order: [[1, 'asc']] // Sort by ID initially
            });
        });
    </script>
@endpush