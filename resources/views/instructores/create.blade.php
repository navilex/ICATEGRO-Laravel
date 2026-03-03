@extends('layouts.app')

@section('title', 'Alta de Instructor - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden min-h-[500px] max-w-5xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <span class="bg-gray-800 text-white rounded w-8 h-8 flex items-center justify-center text-xl mr-2">+</span>
                ALTA DE INSTRUCTOR
            </h1>
        </div>

        <!-- Form -->
        <div class="p-8">
            <!-- Section Title -->
            <div class="relative mb-8 text-center">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Datos generales</span>
                </div>
            </div>

            <form method="POST" action="{{ route('instructores.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Row 1: CURP and Nombre -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
                    <!-- CURP -->
                    <div class="md:col-span-4">
                        <label for="curp" class="block text-red-800 font-bold mb-1">* CURP</label>
                        <input type="text" name="curp" id="curp"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 uppercase"
                            placeholder="CURP" required value="{{ old('curp') }}">
                    </div>

                    <!-- Help Icon -->
                    <div class="md:col-span-1 flex items-end justify-center pb-3">
                        <a href="https://www.gob.mx/curp/" target="_blank"
                            class="bg-green-600 text-white rounded p-1 shadow hover:bg-green-700 transition"
                            title="Consultar CURP">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </div>

                    <!-- Nombre -->
                    <div class="md:col-span-7">
                        <label for="nombre" class="block text-red-800 font-bold mb-1">* Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Nombre" required value="{{ old('nombre') }}">
                    </div>
                </div>

                <!-- Row 2: Apellidos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Apellido 1 -->
                    <div>
                        <label for="apellido_1" class="block text-red-800 font-bold mb-1">* Apellido 1</label>
                        <input type="text" name="apellido_1" id="apellido_1"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Apellido 1" required value="{{ old('apellido_1') }}">
                    </div>

                    <!-- Apellido 2 -->
                    <div>
                        <label for="apellido_2" class="block text-red-800 font-bold mb-1">* Apellido 2</label>
                        <input type="text" name="apellido_2" id="apellido_2"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Apellido 2 (o 'X')" value="{{ old('apellido_2') }}">
                    </div>
                </div>

                <!-- Row 3: Selects -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Tipo de sangre -->
                    <div>
                        <label for="tipo_sangre" class="block text-red-800 font-bold mb-1">* Tipo de sangre</label>
                        <select name="tipo_sangre" id="tipo_sangre"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="A+" {{ old('tipo_sangre') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('tipo_sangre') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('tipo_sangre') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('tipo_sangre') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="O+" {{ old('tipo_sangre') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('tipo_sangre') == 'O-' ? 'selected' : '' }}>O-</option>
                            <option value="AB+" {{ old('tipo_sangre') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('tipo_sangre') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        </select>
                    </div>

                    <!-- Estado civil -->
                    <div>
                        <label for="estado_civil" class="block text-red-800 font-bold mb-1">* Estado civil</label>
                        <select name="estado_civil" id="estado_civil"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="Soltero/a" {{ old('estado_civil') == 'Soltero/a' ? 'selected' : '' }}>Soltero/a
                            </option>
                            <option value="Casado/a" {{ old('estado_civil') == 'Casado/a' ? 'selected' : '' }}>Casado/a
                            </option>
                            <option value="Divorciado/a" {{ old('estado_civil') == 'Divorciado/a' ? 'selected' : '' }}>
                                Divorciado/a</option>
                            <option value="Viudo/a" {{ old('estado_civil') == 'Viudo/a' ? 'selected' : '' }}>Viudo/a</option>
                        </select>
                    </div>

                    <!-- Plantel -->
                    <div>
                        <label for="plantel_id" class="block text-red-800 font-bold mb-1">* Plantel</label>
                        <select name="plantel_id" id="plantel_id"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            @foreach ($planteles as $plantel)
                                <option value="{{ $plantel->id }}" {{ old('plantel_id') == $plantel->id ? 'selected' : '' }}>
                                    {{ $plantel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Archivos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Identificación -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-red-800 font-bold mb-1">* Archivo de Identificación oficial</label>
                        <div id="container_identificacion">
                            <label for="archivo_identificacion"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_identificacion" id="archivo_identificacion"
                                class="hidden file-input" accept=".pdf" data-target="identificacion">
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF. Tamaño máximo: 8MB.</p>
                        </div>
                        <div id="preview_identificacion" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('identificacion')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_identificacion" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_identificacion" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CURP -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Archivo de CURP</label>
                        <div id="container_curp">
                            <label for="archivo_curp"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_curp" id="archivo_curp" class="hidden file-input" accept=".pdf"
                                data-target="curp">
                        </div>
                        <div id="preview_curp" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('curp')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_curp" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_curp" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Acta de Nacimiento -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Archivo de Acta de nacimiento</label>
                        <div id="container_acta">
                            <label for="archivo_acta"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_acta_nacimiento" id="archivo_acta" class="hidden file-input"
                                accept=".pdf" data-target="acta">
                        </div>
                        <div id="preview_acta" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('acta')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_acta" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_acta" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Title: Domicilio -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Domicilio</span>
                    </div>
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <label for="estado" class="block text-red-800 font-bold mb-1">* Estado</label>
                    <select name="estado" id="estado"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="{{ Auth::user()->state ?? 'GUERRERO' }}" selected>
                            {{ Auth::user()->state ?? 'GUERRERO' }}
                        </option>
                    </select>
                </div>

                <!-- Municipio -->
                <div class="mb-6">
                    <label for="municipio" class="block text-red-800 font-bold mb-1">* Municipio</label>
                    <select name="municipio" id="municipio"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="{{ Auth::user()->municipality ?? 'CHILPANCINGO DE LOS BRAVO' }}" selected>
                            {{ Auth::user()->municipality ?? 'CHILPANCINGO DE LOS BRAVO' }}
                        </option>
                    </select>
                </div>

                <!-- Localidad -->
                <div class="mb-6">
                    <label for="localidad" class="block text-red-800 font-bold mb-1">* Localidad</label>
                    <select name="localidad" id="localidad"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                        required>
                        <option value="">» SELECCIONA LA LOCALIDAD</option>
                        <option value="CHILPANCINGO" {{ old('localidad') == 'CHILPANCINGO' ? 'selected' : '' }}>CHILPANCINGO
                        </option>
                        <option value="PETAQUILLAS" {{ old('localidad') == 'PETAQUILLAS' ? 'selected' : '' }}>PETAQUILLAS
                        </option>
                        <option value="MAZATLAN" {{ old('localidad') == 'MAZATLAN' ? 'selected' : '' }}>MAZATLAN</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Colonia -->
                    <div>
                        <label for="colonia" class="block text-red-800 font-bold mb-1">* Colonia</label>
                        <input type="text" name="colonia" id="colonia"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Nombre de la colonia" required value="{{ old('colonia') }}">
                    </div>
                    <!-- Calle -->
                    <div>
                        <label for="calle" class="block text-red-800 font-bold mb-1">* Calle</label>
                        <input type="text" name="calle" id="calle"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Nombre de la calle" required value="{{ old('calle') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- No. Ext -->
                    <div>
                        <label for="numero_exterior" class="block text-red-800 font-bold mb-1">* Número
                            exterior</label>
                        <input type="text" name="numero_exterior" id="numero_exterior"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Número exterior" required value="{{ old('numero_exterior') }}">
                    </div>
                    <!-- No. Int -->
                    <div>
                        <label for="numero_interior" class="block text-red-800 font-bold mb-1">Número
                            interior</label>
                        <input type="text" name="numero_interior" id="numero_interior"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Número interior" value="{{ old('numero_interior') }}">
                    </div>
                    <!-- CP -->
                    <div>
                        <label for="codigo_postal" class="block text-red-800 font-bold mb-1">* Código postal</label>
                        <input type="text" name="codigo_postal" id="codigo_postal"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Código postal" required value="{{ old('codigo_postal') }}">
                    </div>
                </div>

                <!-- Archivo Comprobante de Domicilio -->
                <div class="mb-6">
                    <label class="block text-red-800 font-bold mb-1">* Archivo de Comprobante de domicilio</label>
                    <div id="container_comprobante">
                        <label for="archivo_comprobante"
                            class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                            <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                        </label>
                        <input type="file" name="archivo_comprobante_domicilio" id="archivo_comprobante"
                            class="hidden file-input" accept=".pdf" data-target="comprobante" required>
                    </div>
                    <div id="preview_comprobante" class="hidden mt-4 max-w-sm items-start">
                        <div class="mr-6">
                            <button type="button" onclick="removeFile('comprobante')"
                                class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                            </button>
                        </div>
                        <div class="flex flex-col flex-grow">
                            <span id="name_comprobante" class="text-sm text-gray-700 mb-4"></span>
                            <span id="size_comprobante" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                            <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                        </div>
                    </div>
                </div>

                <!-- Section Title: Datos de contacto -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Datos de contacto</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Teléfono 1 -->
                    <div>
                        <label for="telefono_1" class="block text-red-800 font-bold mb-1">* Teléfono 1</label>
                        <input type="text" name="telefono_1" id="telefono_1"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="Teléfono" required value="{{ old('telefono_1') }}">
                    </div>
                    <!-- Teléfono 2 -->
                    <div>
                        <label for="telefono_2" class="block text-red-800 font-bold mb-1">Teléfono 2</label>
                        <input type="text" name="telefono_2" id="telefono_2"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="" value="{{ old('telefono_2') }}">
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-red-800 font-bold mb-1">* Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="Email" required value="{{ old('email') }}">
                    </div>
                    <!-- Email trabajo -->
                    <div>
                        <label for="email_trabajo" class="block text-red-800 font-bold mb-1">Email trabajo</label>
                        <input type="email" name="email_trabajo" id="email_trabajo"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            placeholder="email_trabajo" value="{{ old('email_trabajo') }}">
                    </div>
                </div>

                <!-- Section Title: Servicio médico -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Servicio médico</span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-6 mb-8">
                    <div class="flex items-center space-x-3 w-full md:w-1/3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="cuenta_servicio_medico" id="cuenta_servicio_medico"
                                class="sr-only peer" {{ old('cuenta_servicio_medico') ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700">¿Cuenta con servicio médico?</span>
                        </label>
                    </div>
                    <div class="w-full md:w-2/3">
                        <label for="nombre_servicio_medico" class="block text-red-800 font-bold mb-1">Nombre del servicio
                            médico</label>
                        <input type="text" name="nombre_servicio_medico" id="nombre_servicio_medico"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 disabled:bg-gray-300 disabled:cursor-not-allowed"
                            value="{{ old('nombre_servicio_medico') }}" disabled>
                    </div>
                </div>

                <!-- Section Title: Escolaridad -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Escolaridad</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Escolaridad -->
                    <div>
                        <label for="escolaridad" class="block text-red-800 font-bold mb-1">* Escolaridad</label>
                        <select name="escolaridad" id="escolaridad"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="Primaria" {{ old('escolaridad') == 'Primaria' ? 'selected' : '' }}>Primaria
                            </option>
                            <option value="Secundaria" {{ old('escolaridad') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                            </option>
                            <option value="Bachillerato" {{ old('escolaridad') == 'Bachillerato' ? 'selected' : '' }}>
                                Bachillerato / Preparatoria</option>
                            <option value="Licenciatura" {{ old('escolaridad') == 'Licenciatura' ? 'selected' : '' }}>
                                Licenciatura</option>
                            <option value="Maestría" {{ old('escolaridad') == 'Maestría' ? 'selected' : '' }}>Maestría
                            </option>
                            <option value="Doctorado" {{ old('escolaridad') == 'Doctorado' ? 'selected' : '' }}>Doctorado
                            </option>
                        </select>
                    </div>
                    <!-- Condición escolar -->
                    <div>
                        <label for="condicion_escolar" class="block text-red-800 font-bold mb-1">* Condición escolar</label>
                        <select name="condicion_escolar" id="condicion_escolar"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONE</option>
                            <option value="Titulado" {{ old('condicion_escolar') == 'Titulado' ? 'selected' : '' }}>Titulado
                            </option>
                            <option value="Pasante" {{ old('condicion_escolar') == 'Pasante' ? 'selected' : '' }}>Pasante
                            </option>
                            <option value="Trunco" {{ old('condicion_escolar') == 'Trunco' ? 'selected' : '' }}>Trunco
                            </option>
                            <option value="Cursando" {{ old('condicion_escolar') == 'Cursando' ? 'selected' : '' }}>Cursando
                            </option>
                        </select>
                    </div>
                    <!-- Nombre de la escuela -->
                    <div>
                        <label for="nombre_escuela" class="block text-red-800 font-bold mb-1">Nombre de la escuela</label>
                        <input type="text" name="nombre_escuela" id="nombre_escuela"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-300"
                            value="{{ old('nombre_escuela') }}">
                    </div>
                    <!-- Cédula profesional -->
                    <div>
                        <label for="cedula_profesional" class="block text-red-800 font-bold mb-1">Cédula profesional</label>
                        <input type="text" name="cedula_profesional" id="cedula_profesional"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-300"
                            value="{{ old('cedula_profesional') }}">
                    </div>
                </div>

                <!-- Archivo Comprobante de Estudios -->
                <div class="mb-6">
                    <label class="block text-red-800 font-bold mb-1">* Archivo de Comprobante de estudios</label>
                    <div id="container_estudios">
                        <label for="archivo_estudios"
                            class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                            <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                        </label>
                        <input type="file" name="archivo_comprobante_estudios" id="archivo_estudios"
                            class="hidden file-input" accept=".pdf" data-target="estudios" required>
                    </div>
                    <div id="preview_estudios" class="hidden mt-4 max-w-sm items-start">
                        <div class="mr-6">
                            <button type="button" onclick="removeFile('estudios')"
                                class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                            </button>
                        </div>
                        <div class="flex flex-col flex-grow">
                            <span id="name_estudios" class="text-sm text-gray-700 mb-4"></span>
                            <span id="size_estudios" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                            <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                        </div>
                    </div>
                </div>

                <!-- STPS -->
                <div class="flex flex-col md:flex-row items-center gap-6 mb-8 mt-6">
                    <div class="flex items-center space-x-3 w-full md:w-1/3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="tiene_registro_stps" id="tiene_registro_stps" class="sr-only peer"
                                {{ old('tiene_registro_stps') ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-700">¿Tiene registro STPS?</span>
                        </label>
                    </div>
                    <div class="w-full md:w-2/3">
                        <label for="registro_stps" class="block text-red-800 font-bold mb-1">Registro STPS</label>
                        <input type="text" name="registro_stps" id="registro_stps"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 disabled:bg-gray-300 disabled:cursor-not-allowed"
                            value="{{ old('registro_stps') }}" disabled>
                    </div>
                </div>

                <!-- Section Title: Experiencia y tipo de instructor -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Experiencia y tipo de
                            instructor</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tipo de instructor -->
                    <div>
                        <label for="tipo_instructor" class="block text-red-800 font-bold mb-1">* Tipo de instructor</label>
                        <select name="tipo_instructor" id="tipo_instructor"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="Interno" {{ old('tipo_instructor') == 'Interno' ? 'selected' : '' }}>Interno
                            </option>
                            <option value="Externo" {{ old('tipo_instructor') == 'Externo' ? 'selected' : '' }}>Externo
                            </option>
                        </select>
                    </div>
                    <!-- Experiencia laboral -->
                    <div>
                        <label for="experiencia_laboral" class="block text-red-800 font-bold mb-1">* Experiencia laboral
                            (Años)</label>
                        <input type="number" step="0.1" min="0" name="experiencia_laboral" id="experiencia_laboral"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required value="{{ old('experiencia_laboral', '0.0') }}">
                    </div>
                    <!-- Experiencia docente -->
                    <div>
                        <label for="experiencia_docente" class="block text-red-800 font-bold mb-1">* Experiencia docente
                            (Años)</label>
                        <input type="number" step="0.1" min="0" name="experiencia_docente" id="experiencia_docente"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required value="{{ old('experiencia_docente', '0.0') }}">
                    </div>
                    <!-- Experiencia en el sector productivo -->
                    <div>
                        <label for="experiencia_sector_productivo" class="block text-red-800 font-bold mb-1">* Experiencia
                            en el sector productivo (Años)</label>
                        <input type="number" step="0.1" min="0" name="experiencia_sector_productivo"
                            id="experiencia_sector_productivo"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required value="{{ old('experiencia_sector_productivo', '0.0') }}">
                    </div>
                </div>

                <!-- Section Title: Datos fiscales -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Datos fiscales</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- RFC -->
                    <div>
                        <label for="rfc" class="block text-red-800 font-bold mb-1">* RFC</label>
                        <input type="text" name="rfc" id="rfc"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white uppercase"
                            placeholder="RFC" required value="{{ old('rfc') }}" maxlength="13"
                            oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <!-- Archivo RFC -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Archivo RFC</label>
                        <div id="container_rfc">
                            <label for="archivo_rfc_input"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_rfc" id="archivo_rfc_input" class="hidden file-input"
                                accept=".pdf" data-target="rfc" required>
                        </div>
                        <div id="preview_rfc" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('rfc')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_rfc" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_rfc" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Title: Idiomas -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Idiomas</span>
                    </div>
                </div>

                <input type="hidden" name="idiomas" id="idiomas_input" value="[]">

                <div class="mb-6">
                    <button type="button" onclick="openIdiomaModal()"
                        class="bg-[#198754] hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition text-sm flex items-center">
                        <i class="fas fa-plus mr-2"></i> Agregar idioma
                    </button>

                    <div class="overflow-x-auto mt-4 rounded shadow">
                        <table class="min-w-full bg-white text-sm" id="tabla_idiomas">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left font-bold border-b">Opción</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Idioma</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">¿Estudió en el extranjero?</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Lugar de estudio</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Institución</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">% de conocimiento</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Estatus del estudio</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_idiomas" class="text-gray-600">
                                <!-- Filas dinámicas -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section Title: Habilidades -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Habilidades</span>
                    </div>
                </div>

                <input type="hidden" name="habilidades" id="habilidades_input" value="[]">

                <div class="mb-6">
                    <button type="button" onclick="openHabilidadModal()"
                        class="bg-[#198754] hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition text-sm flex items-center">
                        <i class="fas fa-plus mr-2"></i> Agregar habilidad
                    </button>

                    <div class="overflow-x-auto mt-4 rounded shadow">
                        <table class="min-w-full bg-white text-sm" id="tabla_habilidades">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left font-bold border-b w-24">Opción</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Habilidad</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_habilidades" class="text-gray-600">
                                <!-- Filas dinámicas -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section Title: Cursos impartidos -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Cursos impartidos</span>
                    </div>
                </div>

                <input type="hidden" name="cursos" id="cursos_input" value="[]">

                <div class="mb-6">
                    <button type="button" onclick="openCursoModal()"
                        class="bg-[#198754] hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition text-sm flex items-center">
                        <i class="fas fa-plus mr-2"></i> Agregar curso impartido
                    </button>

                    <div class="overflow-x-auto mt-4 rounded shadow">
                        <table class="min-w-full bg-white text-sm" id="tabla_cursos">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="py-2 px-4 text-left font-bold border-b w-24">Opción</th>
                                    <th class="py-2 px-4 text-left font-bold border-b">Curso impartido</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_cursos" class="text-gray-600">
                                <!-- Filas dinámicas -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Archivo de constancias_cursos -->
                    <div class="mt-6 mb-4">
                        <label class="block text-red-800 font-bold mb-1">* Archivo de Constancias de cursos</label>
                        <div id="container_constancias">
                            <label for="archivo_constancias_cursos_input"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_constancias_cursos" id="archivo_constancias_cursos_input"
                                class="hidden file-input" accept=".pdf" data-target="constancias" required>
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF. Tamaño máximo: 8MB.</p>
                        </div>
                        <div id="preview_constancias" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('constancias')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_constancias" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_constancias" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Title: Datos financieros -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Datos financieros</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tipo de Banco -->
                    <div>
                        <label for="banco_tipo" class="block text-red-800 font-bold mb-1">* Tipo</label>
                        <select name="banco_tipo" id="banco_tipo"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="Clabe" {{ old('banco_tipo') == 'Clabe' ? 'selected' : '' }}>Clabe interbancaria
                            </option>
                            <option value="Cuenta" {{ old('banco_tipo') == 'Cuenta' ? 'selected' : '' }}>Número de cuenta
                            </option>
                            <option value="Tarjeta" {{ old('banco_tipo') == 'Tarjeta' ? 'selected' : '' }}>Número de tarjeta
                            </option>
                        </select>
                    </div>

                    <!-- Banco Nombre -->
                    <div>
                        <label for="banco_nombre" class="block text-red-800 font-bold mb-1">* Banco</label>
                        <select name="banco_nombre" id="banco_nombre"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="BBVA" {{ old('banco_nombre') == 'BBVA' ? 'selected' : '' }}>BBVA</option>
                            <option value="Banamex" {{ old('banco_nombre') == 'Banamex' ? 'selected' : '' }}>Citibanamex
                            </option>
                            <option value="Banorte" {{ old('banco_nombre') == 'Banorte' ? 'selected' : '' }}>Banorte</option>
                            <option value="Santander" {{ old('banco_nombre') == 'Santander' ? 'selected' : '' }}>Santander
                            </option>
                            <option value="HSBC" {{ old('banco_nombre') == 'HSBC' ? 'selected' : '' }}>HSBC</option>
                            <option value="Scotiabank" {{ old('banco_nombre') == 'Scotiabank' ? 'selected' : '' }}>Scotiabank
                            </option>
                            <option value="Inbursa" {{ old('banco_nombre') == 'Inbursa' ? 'selected' : '' }}>Inbursa</option>
                            <option value="Banco Azteca" {{ old('banco_nombre') == 'Banco Azteca' ? 'selected' : '' }}>Banco
                                Azteca</option>
                            <option value="BanCoppel" {{ old('banco_nombre') == 'BanCoppel' ? 'selected' : '' }}>BanCoppel
                            </option>
                        </select>
                    </div>

                    <!-- Clabe -->
                    <div>
                        <label for="clabe" class="block text-red-800 font-bold mb-1">* Clabe interbancaria</label>
                        <input type="text" name="clabe" id="clabe"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-300 disabled:cursor-not-allowed"
                            placeholder="Clabe a 18 dígitos" value="{{ old('clabe') }}" maxlength="18" disabled>
                    </div>

                    <!-- Número de cuenta -->
                    <div>
                        <label for="numero_cuenta" class="block text-red-800 font-bold mb-1">* Número de cuenta</label>
                        <input type="text" name="numero_cuenta" id="numero_cuenta"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-300 disabled:cursor-not-allowed"
                            placeholder="Número de cuenta" value="{{ old('numero_cuenta') }}" maxlength="20" disabled>
                    </div>

                    <!-- Número de tarjeta -->
                    <div>
                        <label for="numero_tarjeta" class="block text-red-800 font-bold mb-1">* Número de tarjeta</label>
                        <input type="text" name="numero_tarjeta" id="numero_tarjeta"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-300 disabled:cursor-not-allowed"
                            placeholder="16 dígitos de la tarjeta" value="{{ old('numero_tarjeta') }}" maxlength="16"
                            disabled>
                    </div>

                    <!-- Archivo de estado de cuenta -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Archivo Estado de cuenta o tarjeta</label>
                        <div id="container_estado_cuenta">
                            <label for="archivo_estado_cuenta_input"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_estado_cuenta" id="archivo_estado_cuenta_input"
                                class="hidden file-input" accept=".pdf" data-target="estado_cuenta" required>
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF. Tamaño máximo: 8MB.</p>
                        </div>
                        <div id="preview_estado_cuenta" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('estado_cuenta')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_estado_cuenta" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_estado_cuenta" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Title: Documentación adicional -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Documentación
                            adicional</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Archivo CV -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Curriculum VITAE actualizado</label>
                        <div id="container_cv">
                            <label for="archivo_cv_input"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_cv" id="archivo_cv_input" class="hidden file-input"
                                accept=".pdf" data-target="cv" required>
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF. Tamaño máximo: 8MB.</p>
                        </div>
                        <div id="preview_cv" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('cv')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_cv" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_cv" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Archivo Solicitud de empleo -->
                    <div>
                        <label class="block text-red-800 font-bold mb-1">* Solicitud de empleo con fotografía
                            vigente</label>
                        <div id="container_solicitud">
                            <label for="archivo_solicitud_empleo_input"
                                class="cursor-pointer bg-[#d4b996] text-gray-800 py-2 px-4 rounded shadow hover:bg-[#c4a986] transition text-sm inline-flex items-center font-bold">
                                <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                            </label>
                            <input type="file" name="archivo_solicitud_empleo" id="archivo_solicitud_empleo_input"
                                class="hidden file-input" accept=".pdf" data-target="solicitud" required>
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF. Tamaño máximo: 8MB.</p>
                        </div>
                        <div id="preview_solicitud" class="hidden mt-4 max-w-sm items-start">
                            <div class="mr-6">
                                <button type="button" onclick="removeFile('solicitud')"
                                    class="bg-[#990000] hover:bg-red-900 text-white py-1.5 px-3 rounded shadow text-sm flex items-center shadow-md">
                                    <i class="far fa-trash-alt mr-2 text-gray-300"></i> Eliminar
                                </button>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span id="name_solicitud" class="text-sm text-gray-700 mb-4"></span>
                                <span id="size_solicitud" class="text-sm font-bold text-gray-800 mb-3 block"></span>
                                <div class="w-full h-2.5 bg-[#d4b996] rounded-full opacity-80"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="mb-6">
                    <label for="observaciones" class="block text-red-800 font-bold mb-1">* Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="4" maxlength="200"
                        class="w-full border-2 border-gray-400 rounded-lg p-3 hover:border-gray-500 focus:outline-none focus:border-red-500 bg-white shadow-sm"
                        placeholder="Escriba aquí sus observaciones..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4 mt-8 bg-teal-50/50 p-4 border-t border-gray-200">
                    <a href="{{ route('dashboard') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-[#1D2B36] hover:bg-[#2c3e50] text-white font-bold py-2.5 px-6 rounded shadow transition flex items-center shadow-md">
                        Guardar <i class="fas fa-save ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Idioma -->
    <div id="modal_idioma" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 overflow-hidden">
            <div class="flex justify-between items-center bg-gray-100 px-4 py-3 border-b">
                <div class="flex items-center text-blue-700 font-bold">
                    <i class="fas fa-language mr-2"></i> IDIOMA
                </div>
                <button type="button" onclick="closeIdiomaModal()" class="text-gray-500 hover:text-red-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6 h-96 overflow-y-auto">
                <form id="form_idioma">
                    <!-- Nombre idioma -->
                    <div class="mb-4 text-center">
                        <label for="modal_idioma_nombre" class="block text-red-800 font-bold mb-1">* Nombre idioma</label>
                        <select id="modal_idioma_nombre"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="INGLÉS">INGLÉS</option>
                            <option value="FRANCÉS">FRANCÉS</option>
                            <option value="ALEMÁN">ALEMÁN</option>
                            <option value="ITALIANO">ITALIANO</option>
                            <option value="CHINO MANDARÍN">CHINO MANDARÍN</option>
                            <option value="PORTUGUÉS">PORTUGUÉS</option>
                            <option value="OTRO">OTRO</option>
                        </select>
                    </div>

                    <!-- Lugar estudios -->
                    <div class="mb-4 text-center">
                        <label class="block text-red-800 font-bold mb-2">* Lugar estudios</label>
                        <div class="flex items-center justify-center space-x-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="modal_estudio_extranjero" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800">
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Estudios realizados en el extranjero</span>
                            </label>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="mb-4 text-center" id="div_modal_estado">
                        <label for="modal_estado" class="block text-red-800 font-bold mb-1">* Estado</label>
                        <select id="modal_estado"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="CHIHUAHUA">CHIHUAHUA</option>
                            <option value="GUERRERO" selected>GUERRERO</option>
                            <option value="CDMX">CDMX</option>
                        </select>
                    </div>

                    <!-- Municipio -->
                    <div class="mb-4 text-center" id="div_modal_municipio">
                        <label for="modal_municipio" class="block text-red-800 font-bold mb-1">* Municipio</label>
                        <select id="modal_municipio"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="CHIHUAHUA">CHIHUAHUA</option>
                            <option value="CHILPANCINGO DE LOS BRAVO" selected>CHILPANCINGO DE LOS BRAVO</option>
                            <option value="ACAPULCO">ACAPULCO</option>
                        </select>
                    </div>

                    <!-- Institución -->
                    <div class="mb-4 text-center">
                        <label for="modal_institucion" class="block text-red-800 font-bold mb-1">* Institución</label>
                        <input type="text" id="modal_institucion"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white uppercase"
                            required>
                    </div>

                    <!-- Porcentaje de conocimiento -->
                    <div class="mb-4 text-center">
                        <label for="modal_porcentaje" class="block text-red-800 font-bold mb-1">* Porcentaje de conocimiento
                            %</label>
                        <input type="number" id="modal_porcentaje"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            min="0" max="100" value="0" required>
                    </div>

                    <!-- Estatus estudios -->
                    <div class="mb-4 text-center">
                        <label for="modal_estatus" class="block text-red-800 font-bold mb-1">* Estatus estudios</label>
                        <select id="modal_estatus"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white"
                            required>
                            <option value="">» SELECCIONA</option>
                            <option value="CONSTANCIA">CONSTANCIA</option>
                            <option value="CERTIFICADO">CERTIFICADO</option>
                            <option value="DOCUMENTO ACREDITATIVO">DOCUMENTO ACREDITATIVO</option>
                            <option value="EN CURSO">EN CURSO</option>
                        </select>
                    </div>

                    <!-- Acciones Modal -->
                    <div class="flex justify-end space-x-3 border-t pt-4 mt-6">
                        <button type="button" onclick="closeIdiomaModal()"
                            class="bg-[#d9534f] hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-times-circle mr-1"></i> Cerrar
                        </button>
                        <button type="submit"
                            class="bg-[#198754] hover:bg-green-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-plus mr-1"></i> Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Habilidad -->
    <div id="modal_habilidad" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm mx-4 overflow-hidden">
            <div class="flex justify-between items-center bg-gray-100 px-4 py-3 border-b">
                <div class="flex items-center font-bold" style="color: #6366f1;">
                    <i class="fas fa-brain mr-2" style="color: #fbbf24;"></i> HABILIDAD
                </div>
                <button type="button" onclick="closeHabilidadModal()" class="text-gray-500 hover:text-red-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <form id="form_habilidad">
                    <!-- Nombre habilidad -->
                    <div class="mb-4 text-center">
                        <label for="modal_nombre_habilidad" class="block text-red-800 font-bold mb-2">* Nombre
                            habilidad</label>
                        <input type="text" id="modal_nombre_habilidad"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white uppercase"
                            placeholder="Habilidad con la que cuent..." required>
                    </div>

                    <!-- Acciones Modal -->
                    <div class="flex justify-end space-x-3 border-t pt-4 mt-6">
                        <button type="button" onclick="closeHabilidadModal()"
                            class="bg-[#d9534f] hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-times-circle mr-1"></i> Cerrar
                        </button>
                        <button type="submit"
                            class="bg-[#198754] hover:bg-green-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-plus mr-1"></i> Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Curso Impartido -->
    <div id="modal_curso" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm mx-4 overflow-hidden">
            <div class="flex justify-between items-center bg-gray-100 px-4 py-3 border-b">
                <div class="flex items-center font-bold text-gray-700">
                    <i class="fas fa-chalkboard-teacher mr-2 text-teal-500"></i> CURSO IMPARTIDO
                </div>
                <button type="button" onclick="closeCursoModal()" class="text-gray-500 hover:text-red-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <form id="form_curso">
                    <!-- Nombre curso -->
                    <div class="mb-4 text-center">
                        <label for="modal_nombre_curso" class="block text-red-800 font-bold mb-2">* Nombre del curso
                            impartido</label>
                        <input type="text" id="modal_nombre_curso"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white uppercase"
                            placeholder="Curso impartido" required>
                    </div>

                    <!-- Acciones Modal -->
                    <div class="flex justify-end space-x-3 border-t pt-4 mt-6">
                        <button type="button" onclick="closeCursoModal()"
                            class="bg-[#d9534f] hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-times-circle mr-1"></i> Cerrar
                        </button>
                        <button type="submit"
                            class="bg-[#198754] hover:bg-green-700 text-white font-bold py-1.5 px-4 rounded shadow flex items-center">
                            <i class="fas fa-plus mr-1"></i> Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // CURP Validation
        document.getElementById('curp').addEventListener('blur', function () {
            const curp = this.value.toUpperCase();
            this.value = curp;
            if (curp.length > 0) {
                const url = "{{ route('instructores.check-curp', ':curp') }}".replace(':curp', curp);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            if (data.type === 'instructor') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR',
                                    text: data.message,
                                    confirmButtonColor: '#991b1b',
                                });
                                document.getElementById('curp').value = '';
                                document.getElementById('nombre').value = '';
                                document.getElementById('apellido_1').value = '';
                                document.getElementById('apellido_2').value = '';
                            } else {
                                // Auto-fill data for student or user
                                document.getElementById('nombre').value = data.data.nombre || '';
                                document.getElementById('apellido_1').value = data.data.apellido_1 || '';
                                document.getElementById('apellido_2').value = data.data.apellido_2 || '';
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Datos encontrados',
                                    text: 'Se han autocompletado los datos generales.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        }
                    })
                    .catch(error => console.error('Error fetching CURP data:', error));
            }
        });

        // File Inputs Logic
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function () {
                const target = this.getAttribute('data-target');
                const file = this.files[0];

                if (file) {
                    // Check file type
                    if (file.type !== 'application/pdf') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Solo se permiten archivos en formato PDF.',
                            confirmButtonColor: '#991b1b'
                        });
                        this.value = '';
                        return;
                    }

                    // Check file size (8MB = 8 * 1024 * 1024 bytes)
                    if (file.size > 8388608) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El archivo no debe superar los 8MB.',
                            confirmButtonColor: '#991b1b'
                        });
                        this.value = '';
                        return;
                    }

                    // Show temporary loading simulation
                    Swal.fire({
                        title: 'Cargando archivo...',
                        html: 'Por favor, espere.',
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            document.getElementById('container_' + target).classList.add('hidden');
                            document.getElementById('name_' + target).textContent = file.name;

                            let sizeText = '';
                            if (file.size < 1024 * 1024) {
                                sizeText = (file.size / 1024).toFixed(1) + ' KB';
                            } else {
                                sizeText = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                            }
                            document.getElementById('size_' + target).textContent = sizeText;

                            document.getElementById('preview_' + target).classList.remove('hidden');
                            document.getElementById('preview_' + target).classList.add('flex');
                        }
                    });
                }
            });
        });

        function removeFile(target) {
            let inputId = target;
            if (target === 'acta') inputId = 'archivo_acta';
            else if (target === 'comprobante') inputId = 'archivo_comprobante';
            else if (target === 'estudios') inputId = 'archivo_estudios';
            else if (target === 'rfc') inputId = 'archivo_rfc_input';
            else if (target === 'constancias') inputId = 'archivo_constancias_cursos_input';
            else if (target === 'estado_cuenta') inputId = 'archivo_estado_cuenta_input';
            else if (target === 'cv') inputId = 'archivo_cv_input';
            else if (target === 'solicitud') inputId = 'archivo_solicitud_empleo_input';
            else inputId = 'archivo_' + target;

            document.getElementById(inputId).value = '';
            document.getElementById('preview_' + target).classList.add('hidden');
            document.getElementById('preview_' + target).classList.remove('flex');
            document.getElementById('container_' + target).classList.remove('hidden');
        }

        // Toggles for medical service and STPS
        const toggleServicioMedico = document.getElementById('cuenta_servicio_medico');
        const inputServicioMedico = document.getElementById('nombre_servicio_medico');

        toggleServicioMedico.addEventListener('change', function () {
            if (this.checked) {
                inputServicioMedico.disabled = false;
                inputServicioMedico.classList.remove('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
                inputServicioMedico.required = true;
                inputServicioMedico.focus();
            } else {
                inputServicioMedico.disabled = true;
                inputServicioMedico.classList.add('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
                inputServicioMedico.required = false;
                inputServicioMedico.value = '';
            }
        });

        const toggleSTPS = document.getElementById('tiene_registro_stps');
        const inputSTPS = document.getElementById('registro_stps');

        toggleSTPS.addEventListener('change', function () {
            if (this.checked) {
                inputSTPS.disabled = false;
                inputSTPS.classList.remove('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
                inputSTPS.required = true;
                inputSTPS.focus();
            } else {
                inputSTPS.disabled = true;
                inputSTPS.classList.add('disabled:bg-gray-300', 'disabled:cursor-not-allowed');
                inputSTPS.required = false;
                inputSTPS.value = '';
            }
        });


        // ==========================================
        // DATOS FINANCIEROS LOGIC
        // ==========================================
        const selectBancoTipo = document.getElementById('banco_tipo');
        const inputClabe = document.getElementById('clabe');
        const inputCuenta = document.getElementById('numero_cuenta');
        const inputTarjeta = document.getElementById('numero_tarjeta');

        function toggleFinancialInputs() {
            // Reset all
            [inputClabe, inputCuenta, inputTarjeta].forEach(input => {
                input.disabled = true;
                input.classList.add('bg-gray-300', 'disabled:cursor-not-allowed');
                input.classList.remove('bg-gray-50');
                input.required = false;
                input.value = ''; // Clean previous values
            });

            const selectedTipo = selectBancoTipo.value;

            if (selectedTipo === 'Clabe') {
                inputClabe.disabled = false;
                inputClabe.classList.remove('bg-gray-300', 'disabled:cursor-not-allowed');
                inputClabe.classList.add('bg-gray-50');
                inputClabe.required = true;
            } else if (selectedTipo === 'Cuenta') {
                inputCuenta.disabled = false;
                inputCuenta.classList.remove('bg-gray-300', 'disabled:cursor-not-allowed');
                inputCuenta.classList.add('bg-gray-50');
                inputCuenta.required = true;
            } else if (selectedTipo === 'Tarjeta') {
                inputTarjeta.disabled = false;
                inputTarjeta.classList.remove('bg-gray-300', 'disabled:cursor-not-allowed');
                inputTarjeta.classList.add('bg-gray-50');
                inputTarjeta.required = true;
            }
        }

        selectBancoTipo.addEventListener('change', toggleFinancialInputs);
        // Trigger on load for old() data support
        toggleFinancialInputs();

        // ==========================================
        // IDIOMAS LOGIC
        // ==========================================
        let idiomas = [];

        function openIdiomaModal() {
            document.getElementById('modal_idioma').classList.remove('hidden');
            document.getElementById('form_idioma').reset();
            toggleLugarEstudios(); // Reset toggles based on default switch state
        }

        function closeIdiomaModal() {
            document.getElementById('modal_idioma').classList.add('hidden');
        }

        const modalEstudioExtranjero = document.getElementById('modal_estudio_extranjero');
        const modalEstado = document.getElementById('modal_estado');
        const modalMunicipio = document.getElementById('modal_municipio');
        const divModalEstado = document.getElementById('div_modal_estado');
        const divModalMunicipio = document.getElementById('div_modal_municipio');

        modalEstudioExtranjero.addEventListener('change', toggleLugarEstudios);

        function toggleLugarEstudios() {
            if (modalEstudioExtranjero.checked) {
                divModalEstado.classList.add('hidden');
                divModalMunicipio.classList.add('hidden');
                modalEstado.required = false;
                modalMunicipio.required = false;
            } else {
                divModalEstado.classList.remove('hidden');
                divModalMunicipio.classList.remove('hidden');
                modalEstado.required = true;
                modalMunicipio.required = true;
            }
        }

        document.getElementById('form_idioma').addEventListener('submit', function (e) {
            e.preventDefault();

            const idioma = document.getElementById('modal_idioma_nombre').value;
            const extranjero = modalEstudioExtranjero.checked;
            const estado = modalEstado.value;
            const municipio = modalMunicipio.value;
            const institucion = document.getElementById('modal_institucion').value.toUpperCase();
            const porcentaje = document.getElementById('modal_porcentaje').value;
            const estatus = document.getElementById('modal_estatus').value;

            idiomas.push({
                idioma: idioma,
                estudio_extranjero: extranjero,
                estado: extranjero ? null : estado,
                municipio: extranjero ? null : municipio,
                institucion: institucion,
                porcentaje_conocimiento: porcentaje,
                estatus_estudios: estatus
            });

            renderTablaIdiomas();
            updateIdiomasInput();
            closeIdiomaModal();
        });

        function removeIdioma(index) {
            idiomas.splice(index, 1);
            renderTablaIdiomas();
            updateIdiomasInput();
        }

        function updateIdiomasInput() {
            document.getElementById('idiomas_input').value = JSON.stringify(idiomas);
        }

        function renderTablaIdiomas() {
            const tbody = document.getElementById('tbody_idiomas');
            tbody.innerHTML = '';

            if (idiomas.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-gray-400">Sin idiomas agregados.</td></tr>';
                return;
            }

            idiomas.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-white';

                let lugar = item.estudio_extranjero ? 'EXTRANJERO' : `${item.estado}, ${item.municipio}`;

                tr.innerHTML = `
                                                                <td class="py-2 px-4 border-b">
                                                                    <button type="button" onclick="removeIdioma(${index})" class="text-red-500 hover:text-red-700">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </td>
                                                                <td class="py-2 px-4 border-b uppercase">${item.idioma}</td>
                                                                <td class="py-2 px-4 border-b">${item.estudio_extranjero ? 'SÍ' : 'NO'}</td>
                                                                <td class="py-2 px-4 border-b uppercase">${lugar}</td>
                                                                <td class="py-2 px-4 border-b uppercase">${item.institucion}</td>
                                                                <td class="py-2 px-4 border-b">${item.porcentaje_conocimiento}%</td>
                                                                <td class="py-2 px-4 border-b uppercase">${item.estatus_estudios}</td>
                                                            `;
                tbody.appendChild(tr);
            });
        }

        // Initialize table
        renderTablaIdiomas();

        // ==========================================
        // HABILIDADES LOGIC
        // ==========================================
        let habilidades = [];

        function openHabilidadModal() {
            document.getElementById('modal_habilidad').classList.remove('hidden');
            document.getElementById('form_habilidad').reset();
            document.getElementById('modal_nombre_habilidad').focus();
        }

        function closeHabilidadModal() {
            document.getElementById('modal_habilidad').classList.add('hidden');
        }

        document.getElementById('form_habilidad').addEventListener('submit', function (e) {
            e.preventDefault();

            const nombreHabilidad = document.getElementById('modal_nombre_habilidad').value.toUpperCase();

            habilidades.push({
                habilidad: nombreHabilidad
            });

            renderTablaHabilidades();
            updateHabilidadesInput();
            closeHabilidadModal();
        });

        function removeHabilidad(index) {
            habilidades.splice(index, 1);
            renderTablaHabilidades();
            updateHabilidadesInput();
        }

        function updateHabilidadesInput() {
            document.getElementById('habilidades_input').value = JSON.stringify(habilidades);
        }

        function renderTablaHabilidades() {
            const tbody = document.getElementById('tbody_habilidades');
            tbody.innerHTML = '';

            if (habilidades.length === 0) {
                tbody.innerHTML = '<tr><td colspan="2" class="text-center py-4 text-gray-400">Sin habilidades agregadas.</td></tr>';
                return;
            }

            habilidades.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-white';

                tr.innerHTML = `
                                                    <td class="py-2 px-4 border-b">
                                                        <button type="button" onclick="removeHabilidad(${index})" class="text-red-500 hover:text-red-700">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                    <td class="py-2 px-4 border-b font-semibold uppercase text-gray-700">${item.habilidad}</td>
                                                `;
                tbody.appendChild(tr);
            });
        }

        // Initialize table
        renderTablaHabilidades();

        // ==========================================
        // CURSOS IMPARTIDOS LOGIC
        // ==========================================
        let cursos = [];

        function openCursoModal() {
            document.getElementById('modal_curso').classList.remove('hidden');
            document.getElementById('form_curso').reset();
            document.getElementById('modal_nombre_curso').focus();
        }

        function closeCursoModal() {
            document.getElementById('modal_curso').classList.add('hidden');
        }

        document.getElementById('form_curso').addEventListener('submit', function (e) {
            e.preventDefault();

            const nombreCurso = document.getElementById('modal_nombre_curso').value.toUpperCase();

            cursos.push({
                curso: nombreCurso
            });

            renderTablaCursos();
            updateCursosInput();
            closeCursoModal();
        });

        function removeCurso(index) {
            cursos.splice(index, 1);
            renderTablaCursos();
            updateCursosInput();
        }

        function updateCursosInput() {
            document.getElementById('cursos_input').value = JSON.stringify(cursos);
        }

        function renderTablaCursos() {
            const tbody = document.getElementById('tbody_cursos');
            tbody.innerHTML = '';

            if (cursos.length === 0) {
                tbody.innerHTML = '<tr><td colspan="2" class="text-center py-4 text-gray-400">Sin cursos impartidos agregados.</td></tr>';
                return;
            }

            cursos.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.className = index % 2 === 0 ? 'bg-gray-50' : 'bg-white';

                tr.innerHTML = `
                                                    <td class="py-2 px-4 border-b">
                                                        <button type="button" onclick="removeCurso(${index})" class="text-red-500 hover:text-red-700">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                    <td class="py-2 px-4 border-b uppercase text-gray-700">${item.curso}</td>
                                                `;
                tbody.appendChild(tr);
            });
        }

        // Initialize table
        renderTablaCursos();

        // Search for validation errors
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, verifica los campos marcados en rojo.',
                confirmButtonColor: '#991b1b'
            });
        @endif
    </script>
@endpush