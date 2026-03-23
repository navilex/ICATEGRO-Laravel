@extends('layouts.app')

@section('title', 'Edición de Grupo - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden min-h-[500px] max-w-5xl mx-auto mt-8 relative">
        <!-- Header -->
        <div class="bg-[#d4b996] p-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <i class="fas fa-edit mr-3 text-gray-800"></i>
                EDICIÓN DE GRUPO
            </h1>
        </div>

        <div class="p-8">
            <!-- Section 1: Registro -->
            <div class="relative mb-8 text-center mt-2">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-400"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-6 py-1 bg-gray-600 text-white rounded-full text-lg shadow-md border-2 border-gray-500">Registro</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 items-end">
                <div class="col-span-1 border-b border-gray-300 pb-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Registrado por</div>
                    <div class="bg-white border-2 border-gray-400 rounded-full px-4 py-2 text-sm font-bold text-gray-800 uppercase">
                        {{ $grupo->plantel && $grupo->plantel->user ? $grupo->plantel->user->name . ' ' . $grupo->plantel->user->last_name : 'ADMINISTRADOR' }}
                    </div>
                </div>
                <div class="col-span-1 border-b border-gray-300 pb-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Fecha captura</div>
                    <div class="bg-white border-2 border-gray-400 rounded-full px-4 py-2 text-sm font-bold text-gray-800">
                        {{ $grupo->created_at->format('d/m/Y \a \l\a\s H:i:s') }}
                    </div>
                </div>
                <div class="col-span-1 border-b border-gray-300 pb-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Estatus</div>
                    <div class="bg-gray-50 border-2 border-gray-300 rounded-full px-4 py-2 text-sm font-bold text-gray-800 flex items-center shadow-inner">
                        <span class="w-4 h-4 rounded-full mr-3 shadow-sm 
                            @if($grupo->estatus == 'PENDIENTE') bg-yellow-500 
                            @elseif($grupo->estatus == 'AUTORIZADO') bg-green-600 
                            @elseif($grupo->estatus == 'PROCESS') bg-blue-500 
                            @elseif($grupo->estatus == 'CONCLUIDO') bg-purple-700 
                            @elseif($grupo->estatus == 'RECHAZADO') bg-red-600 
                            @else bg-gray-500 @endif
                        "></span>
                        {{ strtoupper($grupo->estatus) }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="col-span-3 border-b border-gray-300 pb-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Plantel</div>
                    <div class="bg-white border-2 border-gray-400 rounded-full px-4 py-2 text-sm font-bold text-gray-800 uppercase">
                        {{ $grupo->plantel->name ?? 'NO ASIGNADO' }}
                    </div>
                </div>
                <div class="col-span-1 border-b border-gray-300 pb-2 mt-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Estatus Director/encargado</div>
                    <div class="bg-white border-2 border-gray-400 rounded-full px-4 py-2 text-sm font-bold text-gray-800 uppercase">
                        {{ $grupo->plantel && $grupo->plantel->user ? $grupo->plantel->user->role : 'DIRECTOR' }}
                    </div>
                </div>
                <div class="col-span-2 border-b border-gray-300 pb-2 mt-2">
                    <div class="text-[#a02142] font-bold text-sm mb-1">Director/encargado</div>
                    <div class="bg-white border-2 border-gray-400 rounded-full px-4 py-2 text-sm font-bold text-gray-800 uppercase">
                        {{ $grupo->plantel && $grupo->plantel->user ? $grupo->plantel->user->name . ' ' . $grupo->plantel->user->last_name : 'ADMINISTRADOR' }}
                    </div>
                </div>
            </div>

            <!-- Form starts -->
            <form method="POST" action="{{ route('grupos.update', $grupo->id) }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Section 2: Datos generales -->
                <div class="relative mb-8 text-center mt-12">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-400"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-6 py-1 bg-gray-600 text-white rounded-full text-lg shadow-md border-2 border-gray-500">Datos generales</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[#a02142] font-bold mb-1">ID del grupo</label>
                        <input type="text" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 bg-gray-100 font-bold text-gray-700 cursor-not-allowed" value="{{ $grupo->id }}" disabled>
                    </div>
                    <div>
                        <label class="block text-[#a02142] font-bold mb-1">Número de grupo</label>
                        <input type="text" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 bg-gray-100 font-bold text-gray-700 cursor-not-allowed" value="NO ASIGNADO" disabled>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="tipo_servicio" class="block text-[#a02142] font-bold mb-1">* Tipo de servicio</label>
                        <select name="tipo_servicio" id="tipo_servicio" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                            <option value="">» SELECCIONE</option>
                            <option value="Extensión" {{ old('tipo_servicio', $grupo->tipo_servicio) == 'Extensión' ? 'selected' : '' }}>Extensión</option>
                            <option value="CAE" {{ old('tipo_servicio', $grupo->tipo_servicio) == 'CAE' ? 'selected' : '' }}>CAE</option>
                        </select>
                    </div>

                    <div>
                        <label for="modalidad_ce" class="block text-[#a02142] font-bold mb-1">* Modalidad C.E.</label>
                        <select name="modalidad_ce" id="modalidad_ce" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white disabled:bg-gray-200" {{ old('tipo_servicio', $grupo->tipo_servicio) == 'CAE' ? '' : 'disabled' }}>
                            <option value="">» SELECCIONE</option>
                            <option value="Regular" {{ old('modalidad_ce', $grupo->modalidad_ce) == 'Regular' ? 'selected' : '' }}>Regular</option>
                            <option value="Asesoría" {{ old('modalidad_ce', $grupo->modalidad_ce) == 'Asesoría' ? 'selected' : '' }}>Asesoría</option>
                        </select>
                    </div>

                    <div>
                        <label for="modalidad" class="block text-[#a02142] font-bold mb-1">* Modalidad</label>
                        <select name="modalidad" id="modalidad" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                            <option value="">» SELECCIONE</option>
                            <option value="Curso" {{ old('modalidad', $grupo->modalidad) == 'Curso' ? 'selected' : '' }}>Curso</option>
                            <option value="Curso en línea" {{ old('modalidad', $grupo->modalidad) == 'Curso en línea' ? 'selected' : '' }}>Curso en línea</option>
                            <option value="Taller" {{ old('modalidad', $grupo->modalidad) == 'Taller' ? 'selected' : '' }}>Taller</option>
                            <option value="Seminario" {{ old('modalidad', $grupo->modalidad) == 'Seminario' ? 'selected' : '' }}>Seminario</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="oferta_educativa_id" class="block text-[#a02142] font-bold mb-1">* Oferta Educativa</label>
                    <select name="oferta_educativa_id" id="oferta_educativa_id" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        <option value="">» SELECCIONA LA OFERTA EDUCATIVA</option>
                        @foreach($ofertas as $oferta)
                            <option value="{{ $oferta->id }}" {{ old('oferta_educativa_id', $grupo->oferta_educativa_id) == $oferta->id ? 'selected' : '' }}>
                                {{ $oferta->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="campo_formacion_id" class="block text-[#a02142] font-bold mb-1">* Campo de Formación Profesional</label>
                    <select name="campo_formacion_id" id="campo_formacion_id" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        @if($grupo->campoFormacion)
                            <option value="{{ $grupo->campoFormacion->id }}" selected>{{ $grupo->campoFormacion->name }}</option>
                        @else
                            <option value="">» SELECCIONA EL CAMPO DE FORMACION PROFESIONAL</option>
                        @endif
                    </select>
                    <p id="campo-loading" class="text-xs text-gray-500 mt-1 hidden">Cargando campos...</p>
                </div>

                <div class="mb-6">
                    <label for="especialidad_ocupacional_id" class="block text-[#a02142] font-bold mb-1">* Especialidad Ocupacional</label>
                    <select name="especialidad_ocupacional_id" id="especialidad_ocupacional_id" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        @if($grupo->especialidadOcupacional)
                            <option value="{{ $grupo->especialidadOcupacional->id }}" selected>{{ $grupo->especialidadOcupacional->name }}</option>
                        @else
                            <option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>
                        @endif
                    </select>
                    <p id="especialidad-loading" class="text-xs text-gray-500 mt-1 hidden">Cargando especialidades...</p>
                </div>

                <div class="mb-6">
                    <label for="curso_select" class="block text-[#a02142] font-bold mb-1">* Curso</label>
                    <select id="curso_select" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        @if($grupo->curso)
                            <option value="{{ $grupo->curso->id }}" selected>{{ $grupo->curso->name }}</option>
                        @elseif($grupo->cursoIcategro)
                            <option value="{{ $grupo->cursoIcategro->id }}" selected>{{ $grupo->cursoIcategro->name }}</option>
                        @else
                            <option value="">» SELECCIONA EL CURSO</option>
                        @endif
                    </select>
                    <p id="curso-loading" class="text-xs text-gray-500 mt-1 hidden">Cargando cursos...</p>
                    <input type="hidden" name="curso_id" id="curso_id" value="{{ $grupo->curso_id }}">
                    <input type="hidden" name="curso_icategro_id" id="curso_icategro_id" value="{{ $grupo->curso_icategro_id }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="alumnos_inician" class="block text-[#a02142] font-bold mb-1">* Alumnos inician</label>
                        <input type="number" name="alumnos_inician" id="alumnos_inician" min="0" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('alumnos_inician', $grupo->alumnos_inician) }}">
                    </div>
                    <div>
                        <label for="capacidad_maxima" class="block text-[#a02142] font-bold mb-1">* Capacidad máxima</label>
                        <input type="number" name="capacidad_maxima" id="capacidad_maxima" min="1" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('capacidad_maxima', $grupo->capacidad_maxima) }}">
                    </div>
                </div>

                <!-- Section 3: Fechas, horario y duración del grupo -->
                <div class="relative mb-8 mt-12 text-center">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-400"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-6 py-1 bg-gray-600 text-white rounded-full text-lg shadow-md border-2 border-gray-500">Fechas, horario y duración del grupo</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div>
                        <label for="fecha_inicio" class="block text-[#a02142] font-bold mb-1">* Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required value="{{ old('fecha_inicio', $grupo->fecha_inicio) }}">
                    </div>
                    <div>
                        <label for="fecha_termino" class="block text-[#a02142] font-bold mb-1">* Fecha de término</label>
                        <input type="date" name="fecha_termino" id="fecha_termino" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required value="{{ old('fecha_termino', $grupo->fecha_termino) }}">
                    </div>
                    <div>
                        <label for="duracion_dias" class="block text-[#a02142] font-bold mb-1">* Duración días</label>
                        <input type="number" name="duracion_dias" id="duracion_dias" min="1" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('duracion_dias', $grupo->duracion_dias) }}">
                    </div>
                    <div>
                        <label for="duracion_horas" class="block text-[#a02142] font-bold mb-1">* Duración horas</label>
                        <input type="number" name="duracion_horas" id="duracion_horas" min="1" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('duracion_horas', $grupo->duracion_horas) }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="flex flex-col gap-6">
                        <div>
                            <label for="numero_semanas" class="block text-[#a02142] font-bold mb-1">* Número de semanas del curso</label>
                            <input type="number" name="numero_semanas" id="numero_semanas" min="1" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('numero_semanas', $grupo->numero_semanas) }}">
                        </div>
                        <div>
                            <label for="numero_horas_semana" class="block text-[#a02142] font-bold mb-1">* Número de horas por semana</label>
                            <input type="number" name="numero_horas_semana" id="numero_horas_semana" min="0" step="0.1" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" placeholder="0" required value="{{ old('numero_horas_semana', $grupo->numero_horas_semana) }}">
                        </div>
                    </div>
                    <div>
                        <label for="horario" class="block text-[#a02142] font-bold mb-1">* Horario</label>
                        <textarea name="horario" id="horario" rows="4" class="w-full border-2 border-gray-400 rounded-lg p-2 px-4 focus:outline-none focus:border-red-500 bg-white resize-none" required>{{ old('horario', $grupo->horario) }}</textarea>
                    </div>
                </div>

                <!-- Section 4: Calendario -->
                <div class="relative mb-8 mt-12 text-center">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-400"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-6 py-1 bg-gray-600 text-white rounded-full text-lg shadow-md border-2 border-gray-500">Calendario</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-[#a02142] font-bold mb-4">* La información se deberá especificar por semana.</p>
                    <button type="button" id="btn_abrir_modal" class="bg-[#1b6b47] hover:bg-[#155a3a] text-white font-bold py-2 px-6 rounded shadow transition flex items-center">
                        <i class="fas fa-plus mr-2 text-sm"></i> Agregar
                    </button>
                </div>

                <input type="hidden" name="calendario_data" id="calendario_data" value="[]">

                <div class="overflow-x-auto bg-gray-50 border border-gray-200 rounded-lg p-4 mb-8">
                    <table class="w-full text-sm text-center">
                        <thead class="bg-gray-100 text-gray-700 font-bold border-b border-gray-300">
                            <tr>
                                <th class="py-2 px-2">Tipo</th>
                                <th class="py-2 px-2">Fecha inicial</th>
                                <th class="py-2 px-2">Fecha final</th>
                                <th class="py-2 px-2">Hora inicial</th>
                                <th class="py-2 px-2">Hora final</th>
                                <th class="py-2 px-2">Total días</th>
                                <th class="py-2 px-2">Total horas</th>
                                <th class="py-2 px-2 text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="calendario_tbody">
                            <tr id="empty_row">
                                <td colspan="8" class="py-4 text-gray-500 bg-gray-50 border-b">No hay datos disponibles en la tabla</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Section 5: Ubicacion del grupo -->
                <div class="relative mb-8 mt-12 text-center">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-400"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-6 py-1 bg-gray-600 text-white rounded-full text-lg shadow-md border-2 border-gray-500">Ubicación del grupo</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="plantel_id" class="block text-[#a02142] font-bold mb-1">* Sede del grupo</label>
                        <select name="plantel_id" id="plantel_id" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                            <option value="">» SELECCIONE LA SEDE</option>
                            @foreach($sedes as $sede)
                                <option value="{{ $sede->id }}" {{ old('plantel_id', $grupo->plantel_id) == $sede->id ? 'selected' : '' }}>
                                    {{ $sede->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="estado" class="block text-[#a02142] font-bold mb-1">* Estado</label>
                        <select name="estado" id="estado" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                            <option value="{{ $grupo->estado }}" selected>{{ $grupo->estado }}</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="municipio" class="block text-[#a02142] font-bold mb-1">* Municipio</label>
                    <select name="municipio" id="municipio" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        <option value="{{ $grupo->municipio }}" selected>{{ $grupo->municipio }}</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="localidad" class="block text-[#a02142] font-bold mb-1">* Localidad</label>
                    <select name="localidad" id="localidad" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white" required>
                        <option value="">» SELECCIONA LA LOCALIDAD</option>
                        <option value="CHILPANCINGO" {{ old('localidad', $grupo->localidad) == 'CHILPANCINGO' ? 'selected' : '' }}>CHILPANCINGO</option>
                        <option value="PETAQUILLAS" {{ old('localidad', $grupo->localidad) == 'PETAQUILLAS' ? 'selected' : '' }}>PETAQUILLAS</option>
                        <option value="MAZATLAN" {{ old('localidad', $grupo->localidad) == 'MAZATLAN' ? 'selected' : '' }}>MAZATLAN</option>
                        <option value="AMOJILECA" {{ old('localidad', $grupo->localidad) == 'AMOJILECA' ? 'selected' : '' }}>AMOJILECA</option>
                    </select>
                </div>

                <div class="mb-10">
                    <label for="nombre_espacio" class="block text-[#a02142] font-bold mb-1">* Nombre del espacio</label>
                    <input type="text" name="nombre_espacio" id="nombre_espacio" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white uppercase" placeholder="Nombre del espacio" required value="{{ old('nombre_espacio', $grupo->nombre_espacio) }}">
                </div>

                <!-- Modales and forms -->
                <div class="text-right pb-6 border-t border-gray-300 pt-6 mt-12">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded shadow text-lg flex items-center inline-flex">
                        <i class="fas fa-save mr-2"></i> GUARDAR CAMBIOS
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Calendar -->
    <div id="calendario_modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden relative">
            <div class="bg-white p-4 border-b border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-gray-700 font-bold text-lg">
                    <i class="fas fa-calendar-alt text-[#a02142] mr-2 text-2xl"></i>
                    CALENDARIO
                </div>
                <button type="button" id="btn_cerrar_modal_x" class="text-red-500 hover:text-red-700 focus:outline-none">
                    <i class="fas fa-times-circle text-2xl"></i>
                </button>
            </div>

            <div class="p-6">
                <!-- Select for TIPO -->
                <div class="mb-4 text-center">
                    <label for="modal_tipo_fecha" class="block text-[#a02142] font-bold mb-1">* Tipo</label>
                    <select id="modal_tipo_fecha" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="DÍA" selected>DÍA</option>
                        <option value="SEMANA">SEMANA</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="text-center">
                        <label for="modal_fecha_inicial" class="block text-[#a02142] font-bold mb-1">* Fecha inicial</label>
                        <input type="date" id="modal_fecha_inicial" class="w-full border-2 border-yellow-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white shadow-[0_0_10px_rgba(250,204,21,0.5)]">
                    </div>
                    <div class="text-center">
                        <label for="modal_fecha_final" class="block text-[#a02142] font-bold mb-1">* Fecha final</label>
                        <input type="date" id="modal_fecha_final" disabled class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none bg-gray-300 cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center">
                        <label for="modal_hora_inicial" class="block text-[#a02142] font-bold mb-1">* Hora inicial</label>
                        <input type="time" id="modal_hora_inicial" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white text-center">
                    </div>
                    <div class="text-center">
                        <label for="modal_hora_final" class="block text-[#a02142] font-bold mb-1">* Hora final</label>
                        <input type="time" id="modal_hora_final" class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white text-center">
                    </div>
                </div>

                <div class="text-center mb-6">
                    <button type="button" id="btn_resetear_relojes" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow text-sm">
                        <i class="fas fa-history mr-1"></i> Resetear relojes
                    </button>
                </div>

                <div class="flex justify-between items-center bg-gray-50 -m-6 p-4 mt-6 border-t border-gray-200">
                    <button type="button" id="btn_cerrar_modal" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded shadow flex items-center">
                        <i class="fas fa-times-circle mr-2"></i> Cerrar
                    </button>
                    <button type="button" id="btn_agregar_fecha" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 rounded shadow flex items-center">
                        <i class="fas fa-plus mr-2"></i> Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const tipoServicio = document.getElementById('tipo_servicio');
            const modalidadCe = document.getElementById('modalidad_ce');
            const cursoSelect = document.getElementById('curso_select');
            const cursoIdInput = document.getElementById('curso_id');
            const cursoIcategroIdInput = document.getElementById('curso_icategro_id');

            // Toggle Modalidad C.E. disable state
            $(tipoServicio).on('change', function () {
                if ($(this).val() === 'CAE') {
                    $(modalidadCe).prop('disabled', false).removeClass('bg-gray-200 cursor-not-allowed');
                } else {
                    $(modalidadCe).prop('disabled', true).addClass('bg-gray-200 cursor-not-allowed').val('');
                }
            });

            // AJAX for dependent dropdown (Oferta -> Campo Formacion)
            $('#oferta_educativa_id').on('change', function () {
                var ofertaId = $(this).val();
                var campoDropdown = $('#campo_formacion_id');
                var especialidadDropdown = $('#especialidad_ocupacional_id');
                var cursoDropdown = $('#curso_select');
                var loadingText = $('#campo-loading');

                campoDropdown.empty().append('<option value="">» SELECCIONA EL CAMPO DE FORMACION PROFESIONAL</option>');
                especialidadDropdown.empty().append('<option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>');
                cursoDropdown.empty().append('<option value="">» SELECCIONA EL CURSO</option>');

                if (ofertaId) {
                    loadingText.removeClass('hidden');
                    $.ajax({
                        url: '/api/campos-by-oferta/' + ofertaId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            loadingText.addClass('hidden');
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
                            console.error('Error al cargar campos.');
                        }
                    });
                }
            });

            // AJAX for dependent dropdown (Campo Formacion -> Especialidad Ocupacional)
            $('#campo_formacion_id').on('change', function () {
                var campoId = $(this).val();
                var especialidadDropdown = $('#especialidad_ocupacional_id');
                var cursoDropdown = $('#curso_select');
                var loadingText = $('#especialidad-loading');

                especialidadDropdown.empty().append('<option value="">» SELECCIONA LA ESPECIALIDAD OCUPACIONAL</option>');
                cursoDropdown.empty().append('<option value="">» SELECCIONA EL CURSO</option>');

                if (campoId) {
                    loadingText.removeClass('hidden');
                    $.ajax({
                        url: '/api/especialidades-by-campo/' + campoId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            loadingText.addClass('hidden');
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
                            console.error('Error al cargar especialidades.');
                        }
                    });
                }
            });

            // Populate Cursos based on Especialidad and Tipo de Servicio
            $('#especialidad_ocupacional_id').on('change', function () {
                var especialidadId = $(this).val();
                var tipoDesc = $('#tipo_servicio').val();
                loadCursos(especialidadId, tipoDesc);
            });

            function loadCursos(especialidadId, tipoDesc) {
                var cursoDropdown = $('#curso_select');
                var loadingText = $('#curso-loading');

                cursoDropdown.empty().append('<option value="">» SELECCIONA EL CURSO</option>');

                if (!especialidadId || !tipoDesc) return;

                const tipo = tipoDesc === 'CAE' ? 'cae' : 'icategro';
                loadingText.removeClass('hidden');

                $.ajax({
                    url: '/api/grupos/cursos/' + especialidadId + '/' + tipo,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        loadingText.addClass('hidden');
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                cursoDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            cursoDropdown.append('<option value="" disabled>No hay cursos disponibles</option>');
                        }
                    },
                    error: function () {
                        loadingText.addClass('hidden');
                        console.error('Error al cargar cursos.');
                    }
                });
            }

            // Handles which hidden input gets the value
            cursoSelect.addEventListener('change', function () {
                const id = this.value;
                const tipoDesc = tipoServicio.value;
                if (tipoDesc === 'CAE') {
                    cursoIdInput.value = id;
                    cursoIcategroIdInput.value = '';
                } else if (tipoDesc === 'Extensión') {
                    cursoIcategroIdInput.value = id;
                    cursoIdInput.value = '';
                }
            });

            // Calendario Logic
            let calendarioData = @json($grupo->calendarios);
            
            // Fix formatting of time from DB (it appends :00) and keys depending on existing structure
            calendarioData = calendarioData.map(item => {
                return {
                    tipo_fecha: item.tipo_fecha || item.tipo || "DÍA",
                    fecha_inicial: item.fecha_inicial,
                    fecha_final: item.fecha_final || '',
                    hora_inicial: item.hora_inicial.substring(0,5),
                    hora_final: item.hora_final.substring(0,5),
                    total_dias: item.total_dias || 1,
                    total_horas: item.total_horas
                };
            });

            const btnAbrirModal = document.getElementById('btn_abrir_modal');
            const modal = document.getElementById('calendario_modal');
            const btnCerrarModal = document.getElementById('btn_cerrar_modal');
            const btnCerrarModalX = document.getElementById('btn_cerrar_modal_x');
            const btnAgregarFecha = document.getElementById('btn_agregar_fecha');
            const btnResetearRelojes = document.getElementById('btn_resetear_relojes');

            const tipoFecha = document.getElementById('modal_tipo_fecha');
            const modFechaInicial = document.getElementById('modal_fecha_inicial');
            const modFechaFinal = document.getElementById('modal_fecha_final');
            const modHoraInicial = document.getElementById('modal_hora_inicial');
            const modHoraFinal = document.getElementById('modal_hora_final');

            const tbody = document.getElementById('calendario_tbody');
            const inputData = document.getElementById('calendario_data');
            
            function openModal() { modal.classList.remove('hidden'); }
            function closeModal() {
                modal.classList.add('hidden');
                tipoFecha.value = 'DÍA';
                tipoFecha.dispatchEvent(new Event('change'));
                modFechaInicial.value = '';
                modFechaFinal.value = '';
                resetRelojes();
            }
            function resetRelojes() {
                modHoraInicial.value = '';
                modHoraFinal.value = '';
            }

            btnAbrirModal.addEventListener('click', openModal);
            btnCerrarModal.addEventListener('click', closeModal);
            btnCerrarModalX.addEventListener('click', closeModal);
            btnResetearRelojes.addEventListener('click', resetRelojes);

            tipoFecha.addEventListener('change', function () {
                if (this.value === 'DÍA') {
                    modFechaFinal.disabled = true; modFechaFinal.value = '';
                    modFechaFinal.classList.add('bg-gray-300', 'cursor-not-allowed');
                    modFechaFinal.classList.remove('border-yellow-400', 'shadow-[0_0_10px_rgba(250,204,21,0.5)]');
                    modFechaInicial.classList.add('border-yellow-400', 'shadow-[0_0_10px_rgba(250,204,21,0.5)]');
                } else {
                    modFechaFinal.disabled = false;
                    modFechaFinal.classList.remove('bg-gray-300', 'cursor-not-allowed');
                    modFechaFinal.classList.add('border-yellow-400', 'shadow-[0_0_10px_rgba(250,204,21,0.5)]');
                }
            });

            modFechaInicial.addEventListener('change', function () {
                if (tipoFecha.value === 'SEMANA' && this.value) {
                    modFechaFinal.min = this.value;
                    if (modFechaFinal.value && modFechaFinal.value < this.value) {
                        modFechaFinal.value = this.value;
                    }
                }
            });

            modHoraFinal.addEventListener('change', function () {
                if (modHoraInicial.value && this.value <= modHoraInicial.value) {
                    alert('La hora final debe ser mayor que la hora inicial.');
                    this.value = '';
                }
            });

            function formatearFecha(fechaStr) {
                if (!fechaStr) return '';
                const parts = fechaStr.split('-');
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }

            function calcularDiferenciaHoras(hInit, hEnd) {
                const init = new Date(`2000-01-01T${hInit}:00`);
                const end = new Date(`2000-01-01T${hEnd}:00`);
                return (end - init) / (1000 * 60 * 60);
            }

            function renderTable() {
                tbody.innerHTML = '';
                if (calendarioData.length === 0) {
                    tbody.innerHTML = '<tr id="empty_row"><td colspan="8" class="py-4 text-gray-500 bg-gray-50 border-b">No hay datos disponibles en la tabla</td></tr>';
                    inputData.value = '[]';
                    return;
                }

                calendarioData.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.className = index % 2 === 0 ? 'bg-white border-b' : 'bg-gray-50 border-b';

                    const actionTd = document.createElement('td');
                    actionTd.className = 'py-3 px-2 flex justify-center items-center h-full';
                    actionTd.innerHTML = `
                        <button type="button" class="text-red-500 hover:text-red-700 mx-1 btn_eliminar_cal" data-index="${index}" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <i class="fas fa-calendar-alt text-blue-500 mx-1"></i>
                    `;

                    tr.appendChild(actionTd);
                    tr.innerHTML += `<td class="py-3 px-2">${item.tipo_fecha || item.tipo}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2">${formatearFecha(item.fecha_inicial)}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2">${formatearFecha(item.fecha_final) || '-'}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2 text-red-600 font-bold">${item.hora_inicial}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2 text-red-600 font-bold">${item.hora_final}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2">${item.total_dias}</td>`;
                    tr.innerHTML += `<td class="py-3 px-2">${item.total_horas}</td>`;

                    tbody.appendChild(tr);
                });

                inputData.value = JSON.stringify(calendarioData);
            }

            // Bind delete globally for dynamic elements
            $(document).on('click', '.btn_eliminar_cal', function () {
                const index = $(this).data('index');
                calendarioData.splice(index, 1);
                renderTable();
            });

            btnAgregarFecha.addEventListener('click', function () {
                const tipo = tipoFecha.value;
                const fInit = modFechaInicial.value;
                const fEnd = modFechaFinal.value;
                const hInit = modHoraInicial.value;
                const hEnd = modHoraFinal.value;

                if (!fInit || !hInit || !hEnd) {
                    alert('Debe completar la fecha inicial, hora inicial y hora final.');
                    return;
                }
                if (tipo === 'SEMANA' && !fEnd) {
                    alert('En tipo SEMANA debe capturar fecha final.');
                    return;
                }

                if (hEnd <= hInit) {
                    alert('La hora final debe ser mayor que la hora inicial.');
                    return;
                }

                let totalDias = 1;
                if (tipo === 'SEMANA') {
                    const diffTime = Math.abs(new Date(fEnd) - new Date(fInit));
                    totalDias = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                }

                const horasPorDia = calcularDiferenciaHoras(hInit, hEnd);
                const totalHoras = totalDias * Math.ceil(horasPorDia);

                calendarioData.push({
                    tipo_fecha: tipo,
                    fecha_inicial: fInit,
                    fecha_final: tipo === 'SEMANA' ? fEnd : '',
                    hora_inicial: hInit,
                    hora_final: hEnd,
                    total_dias: totalDias,
                    total_horas: totalHoras
                });

                renderTable();
                closeModal();
            });

            // Re-render initial table data
            renderTable();
        });
    </script>
@endpush
