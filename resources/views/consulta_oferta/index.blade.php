@extends('layouts.app')

@section('title', 'Consultar Oferta Educativa - ICATEGRO')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
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
    <div class="max-w-[95%] mx-auto space-y-8 mt-8">

        <!-- List Container -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8">
            <!-- Header -->
            <div class="bg-[#d4b996] p-6 text-center shadow-sm">
                <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                    <span
                        class="bg-gray-800 text-white text-xl w-8 h-8 rounded-md flex items-center justify-center mr-3 shadow">
                        <i class="fas fa-list-ul text-sm"></i>
                    </span>
                    CONSULTAR OFERTA EDUCATIVA
                </h1>
            </div>

            <!-- Filter Controls -->
            <div class="p-8 pb-0">
                <div class="mb-6 w-full md:w-1/2">
                    <label for="oferta_educativa_id" class="block text-red-800 font-bold mb-1 text-lg">Selecciona la Oferta
                        Educativa</label>
                    <select name="oferta_educativa_id" id="oferta_educativa_id"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white shadow-sm uppercase">
                        <option value="">» SELECCIONA LA OFERTA EDUCATIVA</option>
                        @foreach($ofertas as $oferta)
                            <option value="{{ $oferta->id }}">{{ $oferta->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Table Container -->
            <div class="px-8 pb-8">
                <div class="overflow-x-auto">
                    <table id="consultaOfertaTable" class="w-full text-sm text-left text-gray-600 stripe hover">
                        <thead class="text-xs text-gray-800 font-bold bg-white border-b-2 border-gray-300">
                            <tr>
                                <th class="px-2 py-3 align-top">No.</th>
                                <th class="px-2 py-3 align-top">Oferta Educativa</th>
                                <th class="px-2 py-3 align-top">Campo de Formación Profesional</th>
                                <th class="px-2 py-3 align-top">Especialidad Ocupacional</th>
                                <th class="px-2 py-3 align-top">Clave Especialidad Ocupacional</th>
                                <th class="px-2 py-3 align-top text-center">Modalidad Especialidad Ocupacional</th>
                                <th class="px-2 py-3 align-top">Curso Oferta - ICATEGRO</th>
                                <th class="px-2 py-3 align-top text-center">Modalidad Curso</th>
                                <th class="px-2 py-3 align-top text-center">Duración Curso Oferta - ICATEGRO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data populated by DataTables via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable with empty data initially
            var table = $('#consultaOfertaTable').DataTable({
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en la tabla",
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
                    }
                },
                responsive: true,
                pageLength: 25,
                columns: [
                    { data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
                    { data: null, render: function () { return $('#oferta_educativa_id option:selected').text(); }, className: 'uppercase' },
                    { data: 'campo_formacion', className: 'uppercase' },
                    { data: 'especialidad_ocupacional', className: 'uppercase' },
                    { data: 'clave_especialidad', className: 'uppercase' },
                    { data: 'modalidad_especialidad', className: 'text-center uppercase' },
                    { data: 'curso_oferta', className: 'uppercase font-semibold' },
                    { data: 'modalidad_curso', className: 'text-center uppercase' },
                    { data: 'duracion', className: 'text-center uppercase' }
                ]
            });

            // Handle dropdown change event
            $('#oferta_educativa_id').on('change', function () {
                var ofertaId = $(this).val();

                if (ofertaId) {
                    // Update table using AJAX
                    table.ajax.url('/api/consulta-oferta/' + ofertaId).load();
                } else {
                    // Clear table if no offer is selected
                    table.clear().draw();
                }
            });
        });
    </script>
@endpush