@extends('layouts.app')

@section('title', 'Cursos - ICATEGRO')

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
                    ALTA DE CURSO
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

                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf

                    <!-- Oferta Educativa -->
                    <div class="mb-6">
                        <label for="oferta_educativa_id" class="block text-red-800 font-bold mb-1">* Oferta
                            Educativa</label>
                        <select name="oferta_educativa_id" id="oferta_educativa_id"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA LA OFERTA EDUCATIVA</option>
                            @foreach($ofertas as $oferta)
                                <!-- We only use this for UI, it's not strictly saved in the cursos table (we save especialidad) -->
                                <option value="{{ $oferta->id }}">
                                    {{ $oferta->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo de Formacion Profesional -->
                    <div class="mb-6">
                        <label for="campo_formacion_id" class="block text-red-800 font-bold mb-1">* Campo de Formación
                            Profesional</label>
                        <select name="campo_formacion_id" id="campo_formacion_id"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required disabled>
                            <option value="">» SELECCIONA EL CAMPO DE FORMACION PROFESIONAL</option>
                        </select>
                        <p id="campo-loading" class="text-xs text-gray-500 mt-1 hidden">Cargando campos...</p>
                    </div>

                    <!-- Especialidad Ocupacional -->
                    <div class="mb-6">
                        <label for="especialidad_ocupacional_id" class="block text-red-800 font-bold mb-1">* Especialidad
                            Ocupacional</label>
                        <select name="especialidad_ocupacional_id" id="especialidad_ocupacional_id"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required disabled>
                            <option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>
                        </select>
                        <p id="especialidad-loading" class="text-xs text-gray-500 mt-1 hidden">Cargando especialidades...
                        </p>
                    </div>

                    <!-- Nombre del curso -->
                    <div class="mb-6">
                        <label for="name" class="block text-red-800 font-bold mb-1">* Nombre del curso</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="Nombre del curso" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Modalidad -->
                        <div>
                            <label for="modalidad" class="block text-red-800 font-bold mb-1">* Modalidad</label>
                            <select name="modalidad" id="modalidad"
                                class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                                required>
                                <option value="">» SELECCIONA LA MODALIDAD</option>
                                <option value="PRESENCIAL" {{ old('modalidad') == 'PRESENCIAL' ? 'selected' : '' }}>PRESENCIAL
                                </option>
                                <option value="EN LINEA" {{ old('modalidad') == 'EN LINEA' ? 'selected' : '' }}>EN LINEA
                                </option>
                                <option value="MIXTA" {{ old('modalidad') == 'MIXTA' ? 'selected' : '' }}>MIXTA</option>
                            </select>
                        </div>

                        <!-- Clave -->
                        <div>
                            <label for="clave" class="block text-red-800 font-bold mb-1">* Clave</label>
                            <input type="text" name="clave" id="clave" value="{{ old('clave') }}"
                                class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                                placeholder="Clave del curso" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="duracion_horas" class="block text-red-800 font-bold mb-1">* Duración del curso
                            (horas)</label>
                        <input type="number" name="duracion_horas" id="duracion_horas" value="{{ old('duracion_horas') }}"
                            class="w-full md:w-1/2 border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="Duracion en horas" required min="1">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Cursos de prerrequisito -->
                        <div>
                            <label for="cursos_prerrequisito" class="block text-red-800 font-bold mb-1">Cursos de
                                prerrequisito</label>
                            <textarea name="cursos_prerrequisito" id="cursos_prerrequisito" rows="2" maxlength="200"
                                class="w-full border-2 border-gray-400 rounded-xl p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none">{{ old('cursos_prerrequisito') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                        </div>

                        <!-- Estrategias de aprendizaje -->
                        <div>
                            <label for="estrategias_aprendizaje" class="block text-red-800 font-bold mb-1">Estrategias de
                                aprendizaje</label>
                            <textarea name="estrategias_aprendizaje" id="estrategias_aprendizaje" rows="2" maxlength="200"
                                class="w-full border-2 border-gray-400 rounded-xl p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none">{{ old('estrategias_aprendizaje') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                        </div>

                        <!-- Estrategias de evaluación -->
                        <div>
                            <label for="estrategias_evaluacion" class="block text-red-800 font-bold mb-1">Estrategias de
                                evaluación</label>
                            <textarea name="estrategias_evaluacion" id="estrategias_evaluacion" rows="2" maxlength="200"
                                class="w-full border-2 border-gray-400 rounded-xl p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none">{{ old('estrategias_evaluacion') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                        </div>

                        <!-- Certificación académica -->
                        <div>
                            <label for="certificacion_academica" class="block text-red-800 font-bold mb-1">Certificación
                                académica</label>
                            <textarea name="certificacion_academica" id="certificacion_academica" rows="2" maxlength="200"
                                class="w-full border-2 border-gray-400 rounded-xl p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none">{{ old('certificacion_academica') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                        </div>

                        <!-- Documentos de apoyo -->
                        <div class="md:col-span-1">
                            <label for="documentos_apoyo" class="block text-red-800 font-bold mb-1">Documentos de
                                apoyo</label>
                            <textarea name="documentos_apoyo" id="documentos_apoyo" rows="2" maxlength="200"
                                class="w-full border-2 border-gray-400 rounded-xl p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none">{{ old('documentos_apoyo') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
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
                    CURSOS
                </h1>
            </div>

            <!-- Table Container -->
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table id="cursosTable" class="w-full text-sm text-left text-gray-600 stripe hover">
                        <thead class="text-xs text-gray-800 font-bold bg-white border-b-2 border-gray-300">
                            <tr>
                                <th class="px-2 py-3">No.</th>
                                <th class="px-2 py-3">Curso</th>
                                <th class="px-2 py-3">Clave</th>
                                <th class="px-2 py-3 text-center">Modalidad</th>
                                <th class="px-2 py-3 text-center">Duración horas</th>
                                <th class="px-2 py-3 text-center">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursos as $curso)
                                <tr class="border-b transition duration-150 hover:bg-gray-50">
                                    <td class="px-2 py-4 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-4 text-gray-800 font-semibold uppercase">{{ $curso->name }}</td>
                                    <td class="px-2 py-4 uppercase">{{ $curso->clave }}</td>
                                    <td class="px-2 py-4 uppercase text-center">{{ $curso->modalidad }}</td>
                                    <td class="px-2 py-4 uppercase text-center">{{ $curso->duracion_horas }}</td>
                                    <td class="px-2 py-4 text-center">
                                        @if($curso->status)
                                            <i class="fas fa-check-circle text-gray-800 text-lg"></i>
                                        @else
                                            <i class="fas fa-times-circle text-red-600 text-lg"></i>
                                        @endif
                                    </td>
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
            // DataTable initialization
            $('#cursosTable').DataTable({
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
                    },
                    "aria": {
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                responsive: true,
                order: [[0, "asc"]], // Sort by No. ascending initially
                columnDefs: [
                    { orderable: false, targets: [5] } // Disable sorting on estatus column
                ]
            });

            // AJAX for dependent dropdown (Oferta Educativa -> Campo Formacion)
            $('#oferta_educativa_id').on('change', function () {
                var ofertaId = $(this).val();
                var campoDropdown = $('#campo_formacion_id');
                var loadingText = $('#campo-loading');
                var especialidadDropdown = $('#especialidad_ocupacional_id');

                campoDropdown.empty();
                campoDropdown.append('<option value="">» SELECCIONA EL CAMPO DE FORMACION PROFESIONAL</option>');
                campoDropdown.prop('disabled', true);

                especialidadDropdown.empty();
                especialidadDropdown.append('<option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>');
                especialidadDropdown.prop('disabled', true);

                if (ofertaId) {
                    loadingText.removeClass('hidden');

                    $.ajax({
                        url: '/api/campos-by-oferta/' + ofertaId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            loadingText.addClass('hidden');
                            campoDropdown.prop('disabled', false);

                            if (data.length > 0) {
                                $.each(data, function (key, value) {
                                    campoDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            } else {
                                campoDropdown.append('<option value="" disabled>No hay campos disponibles</option>');
                            }
                        },
                        error: function () {
                            loadingText.addClass('hidden');
                            alert('Hubo un error al cargar los campos de formación.');
                        }
                    });
                }
            });

            // AJAX for dependent dropdown (Campo Formacion -> Especialidad Ocupacional)
            $('#campo_formacion_id').on('change', function () {
                var campoId = $(this).val();
                var especialidadDropdown = $('#especialidad_ocupacional_id');
                var loadingText = $('#especialidad-loading');

                especialidadDropdown.empty();
                especialidadDropdown.append('<option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>');
                especialidadDropdown.prop('disabled', true);

                if (campoId) {
                    loadingText.removeClass('hidden');

                    $.ajax({
                        url: '/api/especialidades-by-campo/' + campoId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            loadingText.addClass('hidden');
                            especialidadDropdown.prop('disabled', false);

                            if (data.length > 0) {
                                $.each(data, function (key, value) {
                                    especialidadDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            } else {
                                especialidadDropdown.append('<option value="" disabled>No hay especialidades disponibles</option>');
                            }
                        },
                        error: function () {
                            loadingText.addClass('hidden');
                            alert('Hubo un error al cargar las especialidades ocupacionales.');
                        }
                    });
                }
            });

            // Handling old values in case of validation errors
            var oldEspecialidadId = "{{ old('especialidad_ocupacional_id') }}";
            // In a real scenario with old inputs we would need to fetch the whole chain or use javascript to trigger it.
            // For simplicity in this demo, it's just a general structure.
        });
    </script>
@endpush