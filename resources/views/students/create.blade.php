@extends('layouts.app')

@section('title', 'Alta de Alumno - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden min-h-[500px] max-w-5xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <span class="bg-gray-800 text-white rounded w-8 h-8 flex items-center justify-center text-xl mr-2">+</span>
                ALTA DE ALUMNO
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

            <form method="POST" action="{{ route('students.store') }}">
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
                        <label for="curp" class="block text-red-800 font-bold mb-1">* CURP <span
                                class="bg-white text-white rounded-full w-5 h-5 inline-flex items-center justify-center text-xs ml-1"></span></label>
                        <input type="text" name="curp" id="curp"
                            class="w-full border-2 border-gray-400 rounded p-2 focus:outline-none focus:border-red-500 uppercase"
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
                        <label for="name" class="block text-red-800 font-bold mb-1">* Nombre <span
                                class="bg-white text-white rounded-full w-5 h-5 inline-flex items-center justify-center text-xs ml-1"></span></label>
                        <input type="text" name="name" id="name"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Nombre" required value="{{ old('name') }}">
                    </div>
                </div>

                <!-- Row 2: Apellidos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Apellido 1 -->
                    <div>
                        <label for="lastname1" class="block text-red-800 font-bold mb-1">* Apellido 1 <span
                                class="bg-white text-white rounded-full w-5 h-5 inline-flex items-center justify-center text-xs ml-1"></span></label>
                        <input type="text" name="lastname1" id="lastname1"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Apellido 1" required value="{{ old('lastname1') }}">
                    </div>

                    <!-- Apellido 2 -->
                    <div>
                        <label for="lastname2" class="block text-red-800 font-bold mb-1">* Apellido 2</label>
                        <input type="text" name="lastname2" id="lastname2"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50"
                            placeholder="Apellido 2 (o 'X')" value="{{ old('lastname2') }}">
                    </div>
                </div>

                <!-- Row 3: Selects -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Tipo de sangre -->
                    <div>
                        <label for="blood_type" class="block text-red-800 font-bold mb-1">* Tipo de sangre</label>
                        <select name="blood_type" id="blood_type"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                            <option value="">» SELECCIONA</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                    <!-- Estado civil -->
                    <div>
                        <label for="civil_status" class="block text-red-800 font-bold mb-1">* Estado civil</label>
                        <select name="civil_status" id="civil_status"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                            <option value="">» SELECCIONA</option>
                            <option value="Soltero/a">Soltero/a</option>
                            <option value="Casado/a">Casado/a</option>
                            <option value="Divorciado/a">Divorciado/a</option>
                            <option value="Viudo/a">Viudo/a</option>
                        </select>
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
                    <label for="state" class="block text-red-800 font-bold mb-1">* Estado</label>
                    <select name="state" id="state"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="GUERRERO" selected>GUERRERO</option>
                    </select>
                </div>

                <!-- Municipio -->
                <div class="mb-6">
                    <label for="municipality" class="block text-red-800 font-bold mb-1">* Municipio</label>
                    <select name="municipality" id="municipality"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="CHILPANCINGO DE LOS BRAVO" selected>CHILPANCINGO DE LOS BRAVO</option>
                    </select>
                </div>

                <!-- Localidad -->
                <div class="mb-6">
                    <label for="locality" class="block text-red-800 font-bold mb-1">* Localidad</label>
                    <select name="locality" id="locality"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-white">
                        <option value="">» SELECCIONA LA LOCALIDAD</option>
                        <option value="CHILPANCINGO">CHILPANCINGO</option>
                        <option value="PETAQUILLAS">PETAQUILLAS</option>
                        <option value="MAZATLAN">MAZATLAN</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Colonia -->
                    <div>
                        <label for="colony" class="block text-red-800 font-bold mb-1">* Colonia</label>
                        <input type="text" name="colony" id="colony"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Nombre de la colonia" required value="{{ old('colony') }}">
                    </div>
                    <!-- Calle -->
                    <div>
                        <label for="street" class="block text-red-800 font-bold mb-1">* Calle</label>
                        <input type="text" name="street" id="street"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Nombre de la calle" required value="{{ old('street') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- No. Ext -->
                    <div>
                        <label for="exterior_number" class="block text-red-800 font-bold mb-1">* Número
                            exterior</label>
                        <input type="text" name="exterior_number" id="exterior_number"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Número exterior" required value="{{ old('exterior_number') }}">
                    </div>
                    <!-- No. Int -->
                    <div>
                        <label for="interior_number" class="block text-red-800 font-bold mb-1">Número
                            interior</label>
                        <input type="text" name="interior_number" id="interior_number"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Número interior" value="{{ old('interior_number') }}">
                    </div>
                    <!-- CP -->
                    <div>
                        <label for="zip_code" class="block text-red-800 font-bold mb-1">* Código postal</label>
                        <input type="text" name="zip_code" id="zip_code"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Código postal" required value="{{ old('zip_code') }}">
                    </div>
                </div>

                <!-- Section Title: Datos de contacto -->
                <div class="relative mb-8 text-center mt-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-gray-600 text-white rounded-full text-lg shadow-md">Datos de
                            contacto</span>
                    </div>
                </div>

                <!-- Row: Telefono 1 and Telefono 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Telefono 1 -->
                    <div>
                        <label for="phone1" class="block text-red-800 font-bold mb-1">* Teléfono 1</label>
                        <input type="text" name="phone1" id="phone1"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Teléfono" required value="{{ old('phone1') }}">
                    </div>

                    <!-- Telefono 2 -->
                    <div>
                        <label for="phone2" class="block text-red-800 font-bold mb-1">Teléfono 2</label>
                        <input type="text" name="phone2" id="phone2"
                            class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                            placeholder="Teléfono" value="{{ old('phone2') }}">
                    </div>
                </div>

                <!-- Row: Email -->
                <div class="mb-6">
                    <label for="email" class="block text-red-800 font-bold mb-1">* Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full border-2 border-gray-400 rounded-full p-2 px-4 focus:outline-none focus:border-red-500 bg-gray-50 placeholder-gray-300"
                        placeholder="Email" required value="{{ old('email') }}">
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded shadow transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-6 rounded shadow transition">
                        Guardar Alumno
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('curp').addEventListener('blur', function () {
            const curp = this.value.toUpperCase();
            if (curp.length > 0) {
                // Use Blade to generate the URL with a placeholder, then replace it in JS
                const url = "{{ route('students.check-curp', ':curp') }}".replace(':curp', curp);
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            if (data.type === 'student') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Alumno registrado',
                                    text: 'Este alumno ya se encuentra registrado en el sistema.',
                                    confirmButtonColor: '#991b1b'
                                });
                                document.getElementById('curp').value = ''; // Clear duplicate
                            } else if (data.type === 'user') {
                                document.getElementById('name').value = data.data.name;
                                document.getElementById('lastname1').value = data.data.lastname1;
                                // Suggest lastname2 if available or empty
                            }
                        }
                    })
                    .catch(error => console.error('Error fetching CURP data:', error));
            }
        });

        // Search for success message in session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#991b1b'
            });
        @endif

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