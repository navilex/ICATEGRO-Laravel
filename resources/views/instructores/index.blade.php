@extends('layouts.app')

@section('title', 'Lista de Instructores - ICATEGRO')

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        /* Ajustes visuales para emparejar con el diseño de referencia */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 2px;
            background-color: transparent;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 2px 5px;
            margin-left: 3px;
        }

        table.dataTable thead th {
            border-bottom: 2px solid #ddd;
            font-size: 0.85rem;
            color: #333;
            text-transform: uppercase;
        }

        table.dataTable tbody td {
            font-size: 0.85rem;
            color: #555;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }

        /* Gear button style */
        .btn-opciones {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ccc;
            background-color: #f8f9fa;
            color: #007bff;
            transition: all 0.2s ease;
        }

        .btn-opciones:hover {
            border-color: #007bff;
            background-color: #e9ecef;
            color: #0056b3;
        }

        /* Modal specific styles */
        .modal-separator-capsule {
            background: linear-gradient(180deg, #d3a152 0%, #b3853d 100%);
            border: 2px solid #4a3818;
            border-radius: 9999px;
            color: white;
            padding: 10px 40px;
            font-size: 1.15rem;
            text-transform: uppercase;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
            display: inline-block;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
        }

        .btn-icon-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid #e2e8f0;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), inset 0 0 10px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
            transition: all 0.2s ease;
        }

        .btn-icon-circle:hover {
            transform: scale(1.05);
            background-color: #f1f5f9;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            border-color: #cbd5e1;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden min-h-[500px] max-w-7xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-6 text-center border-b-4 border-[#bca380]">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center tracking-wide">
                <i class="fas fa-list-alt mr-3"></i> LISTADO DE INSTRUCTORES
            </h1>
        </div>

        <!-- Content -->
        <div class="p-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <table id="instructores_table" class="display responsive nowrap w-full" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center w-12">ID</th>
                        <th class="text-center w-20">Opciones</th>
                        <th class="text-left">Nombre</th>
                        <th class="text-left">Apellido1</th>
                        <th class="text-left">Apellido2</th>
                        <th class="text-left">CURP</th>
                        <th class="text-left">Email</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-left">Plantel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructores as $instructor)
                        <tr>
                            <td class="text-center font-bold text-gray-600">{{ $instructor->id }}</td>
                            <td class="text-center">
                                <button type="button" class="btn-opciones shadow-sm btn-open-modal"
                                    title="Opciones de instructor" data-id="{{ $instructor->id }}"
                                    data-curp="{{ $instructor->curp }}" data-nombre="{{ $instructor->nombre }}"
                                    data-apellido1="{{ $instructor->apellido_1 }}"
                                    data-apellido2="{{ $instructor->apellido_2 }}">
                                    <i class="fas fa-cog text-xl"></i>
                                </button>
                            </td>
                            <td class="font-semibold uppercase text-gray-700">{{ $instructor->nombre }}</td>
                            <td class="uppercase text-gray-700">{{ $instructor->apellido_1 }}</td>
                            <td class="uppercase text-gray-700">{{ $instructor->apellido_2 }}</td>
                            <td class="uppercase text-gray-700">{{ $instructor->curp }}</td>
                            <td class="text-gray-600">{{ $instructor->email ?? 'N/A' }}</td>
                            <td class="text-center text-gray-600">{{ $instructor->telefono_1 ?? 'N/A' }}</td>
                            <td class="text-xs uppercase font-semibold text-gray-600">
                                {{ $instructor->plantel ? $instructor->plantel->name : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Opciones Instructor -->
    <div id="modal_opciones_instructor"
        class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 transition-opacity">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl mx-4 overflow-hidden border border-gray-300 transform scale-95 opacity-0 transition-transform duration-300"
            id="modal_opciones_content">
            <!-- Modal Header -->
            <div class="bg-gray-50 flex items-center justify-between p-4 border-b border-gray-200 shadow-sm relative z-10">
                <div class="flex items-center text-gray-800 font-bold text-xl tracking-wide uppercase">
                    <i class="fas fa-cog text-blue-500 text-3xl mr-3" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);"></i>
                    OPCIONES DEL INSTRUCTOR
                </div>
                <!-- Pink Close button -->
                <button type="button" onclick="closeModalOpciones()"
                    class="text-pink-600 hover:text-pink-800 transition rounded-full hover:bg-pink-100 p-1">
                    <i class="fas fa-times-circle text-4xl drop-shadow-md"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8 pb-12 relative bg-white z-0">
                <!-- Info Grid -->
                <!-- First Row: ID and CURP -->
                <div class="grid grid-cols-2 gap-6 text-center mb-6">
                    <!-- ID -->
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[#b91c1c] font-bold text-xl mb-2">ID</span>
                        <span id="modal_id" class="text-gray-700 text-lg">--</span>
                    </div>
                    <!-- CURP -->
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[#b91c1c] font-bold text-xl mb-2">CURP</span>
                        <span id="modal_curp" class="text-gray-700 text-lg tracking-wide">--</span>
                    </div>
                </div>

                <!-- Second Row: Nombre, Apellido1, Apellido2 -->
                <div class="grid grid-cols-3 gap-6 text-center mb-10">
                    <!-- Nombre -->
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[#b91c1c] font-bold text-xl mb-2">Nombre</span>
                        <span id="modal_nombre" class="text-gray-700 text-lg uppercase">--</span>
                    </div>
                    <!-- Apellido 1 -->
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[#b91c1c] font-bold text-xl mb-2">Apellido 1</span>
                        <span id="modal_apellido1" class="text-gray-700 text-lg uppercase">--</span>
                    </div>
                    <!-- Apellido 2 -->
                    <div class="flex flex-col items-center justify-center">
                        <span class="text-[#b91c1c] font-bold text-xl mb-2">Apellido 2</span>
                        <span id="modal_apellido2" class="text-gray-700 text-lg uppercase">--</span>
                    </div>
                </div>

                <!-- Separator Capsule -->
                <div class="flex justify-center mb-8 relative">
                    <div class="relative flex justify-center z-10">
                        <div class="modal-separator-capsule">
                            Acciones del Instructor
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Area -->
                <div class="flex justify-center mt-6">
                    <!-- Ver Datos -->
                    <a id="btn_ver_datos" href="#"
                        class="flex flex-col items-center group cursor-pointer focus:outline-none">
                        <!-- Icon Circle -->
                        <div class="btn-icon-circle relative group-hover:border-gray-400">
                            <!-- SVG Document Icon with Search -->
                            <div class="relative flex justify-center items-center h-full w-full">
                                <i class="fas fa-file-alt text-blue-200 text-5xl"></i>
                                <i class="fas fa-search text-blue-600 text-2xl absolute drop-shadow"
                                    style="bottom: 15px; right: 15px;"></i>
                            </div>
                        </div>
                        <span class="mt-4 font-bold text-sm text-gray-900 uppercase tracking-widest transition">Ver datos
                            del instructor</span>
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-white border-t border-gray-200 p-4 flex justify-end">
                <button type="button" onclick="closeModalOpciones()"
                    class="bg-[#dc3545] hover:bg-red-700 text-white font-semibold py-2 px-8 rounded opacity-90 hover:opacity-100 shadow-sm transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#instructores_table').DataTable({
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
                    { orderable: false, targets: 1 } // Deshabilitar orden en la columna de opciones
                ],
                order: [[0, 'asc']] // Ordenar por ID ascendente por defecto
            });

            // Delegate click event to the DataTable wrapper to handle dynamically drawn rows
            $('#instructores_table').on('click', '.btn-open-modal', function (e) {
                e.preventDefault();

                // Get data from data-* attributes
                const btn = $(this);
                const id = btn.data('id');
                const curp = btn.data('curp');
                const nombre = btn.data('nombre');
                const apellido1 = btn.data('apellido1');
                const apellido2 = btn.data('apellido2');

                // Populate Modal Data
                $('#modal_id').text(id);
                $('#modal_curp').text(curp || '--');
                $('#modal_nombre').text(nombre || '--');
                $('#modal_apellido1').text(apellido1 || '--');
                $('#modal_apellido2').text(apellido2 || '--');

                // Construct the link (Assumes there will be a route for this later, for now we can just use '#' or dynamically build a path if it existed)
                $('#btn_ver_datos').attr('href', '/instructores/' + id);

                // Show Modal Layout
                openModalOpciones();
            });
        });

        function openModalOpciones() {
            const modal = document.getElementById('modal_opciones_instructor');
            const content = document.getElementById('modal_opciones_content');

            modal.classList.remove('hidden');
            // Slight delay to allow display block to apply before animating opacity/transform
            setTimeout(() => {
                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeModalOpciones() {
            const modal = document.getElementById('modal_opciones_instructor');
            const content = document.getElementById('modal_opciones_content');

            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Wait for transition to finish
        }

        // Close when clicking outside modal body
        document.getElementById('modal_opciones_instructor').addEventListener('click', function (e) {
            if (e.target === this) {
                closeModalOpciones();
            }
        });
    </script>
@endpush