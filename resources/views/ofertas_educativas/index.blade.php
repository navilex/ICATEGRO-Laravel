@extends('layouts.app')

@section('title', 'Ofertas Educativas - ICATEGRO')

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
    <div class="max-w-7xl mx-auto space-y-8 mt-8">

        <!-- Registration Form Container -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-[#d4b996] p-4 text-center">
                <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                    <span
                        class="bg-gray-800 text-white rounded w-8 h-8 flex items-center justify-center text-xl mr-2">+</span>
                    ALTA DE OFERTA EDUCATIVA
                </h1>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ofertas-educativas.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Nombre -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-red-800 font-bold mb-1">Nombre de la Oferta
                                Educativa</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                                placeholder="Nombre de la Oferta Educativa" required>
                        </div>

                        <!-- Fecha Inicio -->
                        <div>
                            <label for="start_date" class="block text-red-800 font-bold mb-1">Fecha de inicio</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                                required>
                        </div>

                        <!-- Fecha Termino -->
                        <div>
                            <label for="end_date" class="block text-red-800 font-bold mb-1">Fecha de termino</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                                required>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="flex justify-end bg-[#e6fcf5] -mx-8 -mb-8 p-4 border-t border-gray-200 rounded-b-lg shadow-inner mt-8">
                        <button type="submit"
                            class="bg-[#1f2937] hover:bg-black text-white px-5 py-2 rounded-md shadow flex items-center transition focus:outline-none font-medium">
                            Guardar <i class="fas fa-lock ml-2 text-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- List Container -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8">
            <!-- Header -->
            <div class="bg-[#d4b996] p-6 text-center shadow-sm">
                <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                    <span
                        class="bg-gray-800 text-white text-xl w-8 h-8 rounded-md flex items-center justify-center mr-3 shadow">
                        <i class="fas fa-list-ul text-sm"></i>
                    </span>
                    LISTADO DE OFERTAS EDUCATIVAS
                </h1>
            </div>

            <!-- Table Container -->
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table id="ofertasTable" class="w-full text-sm text-left text-gray-600 stripe hover">
                        <thead class="text-xs text-gray-800 font-bold bg-white border-b-2 border-gray-300">
                            <tr>
                                <th class="px-2 py-3">Nombre</th>
                                <th class="px-2 py-3">Fecha Inicio</th>
                                <th class="px-2 py-3">Fecha Termino</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ofertas as $oferta)
                                <tr class="border-b transition duration-150 hover:bg-gray-50">
                                    <td class="px-2 py-4 font-medium text-gray-800 uppercase">{{ $oferta->name }}</td>
                                    <td class="px-2 py-4 uppercase">
                                        {{ \Carbon\Carbon::parse($oferta->start_date)->format('d-m-Y') }}</td>
                                    <td class="px-2 py-4 uppercase">
                                        {{ \Carbon\Carbon::parse($oferta->end_date)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
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
            $('#ofertasTable').DataTable({
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
                order: [[1, "desc"]], // Sort by date descending initially as an example, but users can sort as they want.
            });
        });
    </script>
@endpush