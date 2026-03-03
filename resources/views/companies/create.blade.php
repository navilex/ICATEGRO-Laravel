@extends('layouts.app')

@section('title', 'Registrar Empresa - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8 max-w-5xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-6 text-center shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <span
                    class="bg-gray-800 text-white text-xl w-8 h-8 rounded-md flex items-center justify-center mr-3 shadow">+</span>
                ALTA DE EMPRESA / INSTITUCIÓN / ASOCIACIÓN
            </h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-8">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-8 relative flex items-center justify-center">
            <div class="absolute w-full z-0 px-8">
                <div class="border-t-2 border-gray-400"></div>
            </div>
            <div
                class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                Datos generales
            </div>
        </div>

        <form action="{{ route('companies.store') }}" method="POST" class="px-8 mt-12">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">
                <!-- Tipo -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Tipo</label>
                    <div class="relative">
                        <select name="type" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-sm font-semibold text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none uppercase transition">
                            <option value="" selected disabled>» SELECCIONA EL TIPO</option>
                            <option value="EMPRESA" {{ old('type') == 'EMPRESA' ? 'selected' : '' }}>EMPRESA</option>
                            <option value="INSTITUCIÓN" {{ old('type') == 'INSTITUCIÓN' ? 'selected' : '' }}>INSTITUCIÓN
                            </option>
                            <option value="ASOCIACIÓN" {{ old('type') == 'ASOCIACIÓN' ? 'selected' : '' }}>ASOCIACIÓN</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white placeholder-blue-100 focus:outline-none focus:border-[#9b2242] uppercase transition">
                </div>
            </div>

            <div class="mt-12 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Domicilio
                </div>
            </div>

            <div class="px-8 mt-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">
                <!-- Estado -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Estado</label>
                    <div class="relative">
                        <select name="state" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-sm font-semibold text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none uppercase transition">
                            <option value="GUERRERO" {{ old('state', 'GUERRERO') == 'GUERRERO' ? 'selected' : '' }}>GUERRERO
                            </option>
                            <!-- Other states could be added here -->
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Municipio -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Municipio</label>
                    <div class="relative">
                        <select name="municipality" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-sm font-semibold text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none uppercase transition">
                            <option value="CHILPANCINGO DE LOS BRAVO" {{ old('municipality', 'CHILPANCINGO DE LOS BRAVO') == 'CHILPANCINGO DE LOS BRAVO' ? 'selected' : '' }}>CHILPANCINGO DE LOS BRAVO</option>
                            <!-- Other municipalities could be added here -->
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Colonia -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Colonia</label>
                    <input type="text" name="colony" value="{{ old('colony') }}" placeholder="Nombre de la colonia" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-gray-200">
                </div>

                <!-- Calle -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Calle</label>
                    <input type="text" name="street" value="{{ old('street') }}" placeholder="Nombre de la calle" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-gray-200">
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-8">
                    <!-- Número exterior -->
                    <div>
                        <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Número
                            exterior</label>
                        <input type="text" name="exterior_number" value="{{ old('exterior_number') }}"
                            placeholder="Número exterior" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-gray-200">
                    </div>

                    <!-- Número interior -->
                    <div>
                        <label class="block text-[#9b2242] font-bold mb-1 ml-2">Número interior</label>
                        <input type="text" name="interior_number" value="{{ old('interior_number') }}"
                            placeholder="Número interior"
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-gray-200">
                    </div>

                    <!-- Código postal -->
                    <div>
                        <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Código
                            postal</label>
                        <input type="text" name="zip_code" value="{{ old('zip_code') }}" placeholder="Código postal"
                            required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-gray-200">
                    </div>
                </div>
            </div>

            <div class="mt-12 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Datos de contacto
                </div>
            </div>

            <div class="px-8 mt-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">
                <!-- Teléfono 1 -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Teléfono 1 <i
                            class="fas fa-phone-alt ml-1 text-sm text-gray-800"></i></label>
                    <input type="text" name="phone1" value="{{ old('phone1') }}" placeholder="Teléfono"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50">
                </div>

                <!-- Teléfono 2 -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Teléfono 2 <i
                            class="fas fa-phone-alt ml-1 text-sm text-gray-800"></i></label>
                    <input type="text" name="phone2" value="{{ old('phone2') }}" placeholder=""
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50">
                </div>

                <!-- Email 1 -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Email 1 <i
                            class="fas fa-envelope ml-1 text-sm text-gray-800"></i></label>
                    <input type="email" name="email1" value="{{ old('email1') }}" placeholder="algo@ejemplo.com"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>

                <!-- Email 2 -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Email 2 <i
                            class="fas fa-envelope ml-1 text-sm text-gray-800"></i></label>
                    <input type="email" name="email2" value="{{ old('email2') }}" placeholder="algo@ejemplo.com"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>

                <!-- Web -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Web <i
                            class="fas fa-link ml-1 text-sm text-gray-800"></i></label>
                    <input type="url" name="web" value="{{ old('web') }}" placeholder="https://ejemplo.com"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Instagram <i
                            class="fab fa-instagram ml-1 text-sm text-gray-800"></i></label>
                    <input type="text" name="instagram" value="{{ old('instagram') }}" placeholder="@ejemplo_insta"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>

                <!-- Facebook -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Facebook <i
                            class="fab fa-facebook ml-1 text-sm text-gray-800"></i></label>
                    <input type="url" name="facebook" value="{{ old('facebook') }}" placeholder="https://facebook.com"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>

                <!-- Twitter -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2">Twitter <i
                            class="fab fa-twitter ml-1 text-sm text-gray-800"></i></label>
                    <input type="text" name="twitter" value="{{ old('twitter') }}" placeholder="@ejemplo_twitter"
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition placeholder-blue-50 lowercase">
                </div>
            </div>

            <!-- Submit Button Section -->
            <div class="mt-16 bg-cyan-50 -mx-8 py-4 px-8 border-t border-gray-200 flex justify-end">
                <button type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-6 rounded-md shadow outline-none transition flex items-center">
                    Guardar <i class="fas fa-save ml-2"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('duplicate_error'))
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    html: 'El nombre de <strong>{{ session('duplicate_error')['name'] }}</strong> ya se encuentra guardado con el registro No.<strong>{{ session('duplicate_error')['id'] }}</strong>{{ session('duplicate_error')['location'] }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Cerrar'
                });
            @endif
                });
    </script>
@endpush