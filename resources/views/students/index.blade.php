@extends('layouts.app')

@section('title', 'Lista de Alumnos - ICATEGRO')

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
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e5e7eb !important;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-7xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <i class="fas fa-list-alt mr-3"></i> LISTADO DE ALUMNOS
            </h1>
        </div>

        <!-- Table Container -->
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="studentsTable" class="w-full text-sm text-left text-gray-500 stripe hover">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3 text-center">Opciones</th>
                            <th class="px-4 py-3">Matricula</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Apellido1</th>
                            <th class="px-4 py-3">Apellido2</th>
                            <th class="px-4 py-3">CURP</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $student->id }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="openModal(this)" data-student='@json($student)'
                                        class="text-blue-500 hover:text-blue-700 mx-1 border-2 border-slate-400 rounded-full w-8 h-8 flex items-center justify-center hover:bg-blue-50 transition"
                                        title="Opciones">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                </td>
                                <td class="px-4 py-3 font-semibold">{{ $student->matricula }}</td>
                                <td class="px-4 py-3">{{ $student->name }}</td>
                                <td class="px-4 py-3">{{ $student->lastname1 }}</td>
                                <td class="px-4 py-3">{{ $student->lastname2 }}</td>
                                <td class="px-4 py-3">{{ $student->curp }}</td>
                                <td class="px-4 py-3">{{ $student->email }}</td>
                                <td class="px-4 py-3">{{ $student->phone1 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Student Options Modal -->
    <div id="studentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
            <div
                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-4xl sm:w-full">

                <!-- Modal Header -->
                <div class="bg-gray-100 px-4 py-3 border-b flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-bold text-gray-800 flex items-center uppercase" id="modal-title">
                        <i class="fas fa-cogs text-blue-500 mr-2 text-2xl"></i> Opciones del alumno
                    </h3>
                    <button type="button" onclick="closeModal()"
                        class="text-pink-500 hover:text-pink-700 focus:outline-none">
                        <i class="fas fa-times-circle text-3xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-4 pt-5 pb-4 sm:p-6 bg-white">

                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center mb-8">
                        <div>
                            <p class="text-pink-700 font-bold text-lg">ID</p>
                            <p class="text-gray-600 font-semibold" id="modal-id">--</p>
                        </div>
                        <div>
                            <p class="text-pink-700 font-bold text-lg">CURP</p>
                            <p class="text-gray-600 font-semibold" id="modal-curp">--</p>
                        </div>
                        <div>
                            <p class="text-pink-700 font-bold text-lg">Matrícula</p>
                            <p class="text-gray-600 font-semibold" id="modal-matricula">--</p>
                        </div>
                        <div>
                            <p class="text-pink-700 font-bold text-lg">Nombre</p>
                            <p class="text-gray-600 font-semibold uppercase" id="modal-name">--</p>
                        </div>
                        <div>
                            <p class="text-pink-700 font-bold text-lg">Apellido 1</p>
                            <p class="text-gray-600 font-semibold uppercase" id="modal-lastname1">--</p>
                        </div>
                        <div>
                            <p class="text-pink-700 font-bold text-lg">Apellido 2</p>
                            <p class="text-gray-600 font-semibold uppercase" id="modal-lastname2">--</p>
                        </div>
                    </div>

                    <!-- Actions Section -->
                    <div class="text-center mt-8">
                        <div class="relative inline-block mb-6">
                            <span
                                class="bg-[#d4b996] text-white px-8 py-2 rounded-full font-bold shadow-lg border-2 border-[#bfa07a] uppercase tracking-wide text-lg"
                                style="text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">
                                Acciones del alumno
                            </span>
                        </div>

                        <div class="flex justify-center mt-4">
                            <a href="#" id="view-student-data-btn"
                                class="flex flex-col items-center group cursor-pointer hover:scale-105 transition-transform duration-200">
                                <div
                                    class="bg-blue-100 rounded-full p-4 border-4 border-gray-400 shadow-inner mb-2 w-24 h-24 flex items-center justify-center relative">
                                    <i class="fas fa-file-alt text-4xl text-blue-500 opacity-80"></i>
                                    <i
                                        class="fas fa-search text-xl text-blue-700 absolute bottom-5 right-5 bg-white rounded-full p-1"></i>
                                </div>
                                <span class="font-bold text-gray-800 text-sm uppercase">Ver datos del alumno</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t">
                    <button type="button" onclick="closeModal()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
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
            $('#studentsTable').DataTable({
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
                responsive: true,
                order: [[0, "asc"]] // Order by ID by default
            });
        });

        function openModal(button) {
            const student = JSON.parse(button.getAttribute('data-student'));

            document.getElementById('modal-id').innerText = student.id;
            document.getElementById('modal-curp').innerText = student.curp;
            document.getElementById('modal-matricula').innerText = student.matricula;
            document.getElementById('modal-name').innerText = student.name;
            document.getElementById('modal-lastname1').innerText = student.lastname1;
            document.getElementById('modal-lastname2').innerText = student.lastname2;

            // Set the href for the "Ver datos del alumno" button dynamically
            document.getElementById('view-student-data-btn').href = '/students/' + student.id;

            document.getElementById('studentModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('studentModal').classList.add('hidden');
        }
    </script>
@endpush