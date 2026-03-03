@extends('layouts.app')

@section('title', 'Registrar Convenio - ICATEGRO')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden pb-8 max-w-5xl mx-auto mt-8">
        <!-- Header -->
        <div class="bg-[#d4b996] p-6 text-center shadow-sm">
            <h1 class="text-3xl font-bold text-gray-800 uppercase flex items-center justify-center">
                <span
                    class="bg-gray-800 text-white text-xl w-8 h-8 rounded-md flex items-center justify-center mr-3 shadow">+</span>
                ALTA DE CONVENIO
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

        <form action="{{ route('convenios.store') }}" method="POST" enctype="multipart/form-data" class="px-8 mt-12">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">
                <!-- Tipo de convenio -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Tipo de
                        convenio</label>
                    <div class="relative">
                        <select name="type" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none uppercase transition">
                            <option value="" selected disabled>» SELECCIONE</option>
                            <option value="GENERAL" {{ old('type') == 'GENERAL' ? 'selected' : '' }}>GENERAL</option>
                            <option value="ESPECÍFICO" {{ old('type') == 'ESPECÍFICO' ? 'selected' : '' }}>ESPECÍFICO</option>
                            <option value="COLABORACIÓN" {{ old('type') == 'COLABORACIÓN' ? 'selected' : '' }}>COLABORACIÓN
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Número de convenio -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Número de
                        convenio</label>
                    <input type="text" name="number" value="{{ old('number') }}" placeholder="Ej: 23/GRO/0005" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition placeholder-blue-50">
                </div>

                <!-- Nombre del convenio -->
                <div class="md:col-span-2">
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Nombre del
                        convenio</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] uppercase transition">
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Fecha de
                        inicio</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" required
                        class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <!-- Fecha de término -->
                    <div>
                        <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span> Fecha de
                            término</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition">
                    </div>

                    <!-- Monto -->
                    <div>
                        <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                            Monto</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount', '0.0') }}" required
                            class="w-full border-2 border-gray-500 rounded-full px-5 py-2 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition">
                    </div>
                </div>

                <!-- Objeto -->
                <div class="md:col-span-2">
                    <label class="block text-[#9b2242] font-bold mb-1 ml-2"><span class="text-red-600">*</span>
                        Objeto</label>
                    <textarea name="object" rows="4" required maxlength="200"
                        class="w-full border-2 border-gray-500 rounded-lg px-5 py-3 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition">{{ old('object') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
                </div>
            </div>

            <!-- Disponible para Section -->
            <div class="mt-16 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Disponible para
                </div>
            </div>

            <div class="px-8 mt-10">
                @if($errors->has('planteles'))
                    <div class="text-red-600 font-bold mb-4 text-center bg-red-100 p-2 rounded shadow-sm border border-red-300">
                        {{ $errors->first('planteles') }}
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($planteles as $plantel)
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" name="planteles[]" value="{{ $plantel->id }}" class="sr-only peer" {{ (is_array(old('planteles')) && in_array($plantel->id, old('planteles'))) ? 'checked' : '' }}>
                                <div
                                    class="w-10 h-5 bg-gray-200 border-2 border-gray-300 rounded-full peer peer-checked:bg-green-500 peer-checked:border-green-600 transition-colors shadow-inner">
                                </div>
                                <div
                                    class="absolute inset-y-0 left-0 w-5 h-5 bg-white border border-gray-300 rounded-full shadow transition-transform transform peer-checked:translate-x-full peer-checked:border-green-600">
                                </div>
                            </div>
                            <div
                                class="ml-3 text-gray-700 font-semibold uppercase text-xs tracking-wide group-hover:text-gray-900 transition-colors">
                                {{ $plantel->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Población a atender Section -->
            <div class="mt-16 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Población a atender
                </div>
            </div>

            <div class="px-8 mt-10">
                @if($errors->has('poblaciones'))
                    <div class="text-red-600 font-bold mb-4 text-center bg-red-100 p-2 rounded shadow-sm border border-red-300">
                        {{ $errors->first('poblaciones') }}
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($poblaciones as $poblacion)
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" name="poblaciones[]" value="{{ $poblacion->id }}" class="sr-only peer" {{ (is_array(old('poblaciones')) && in_array($poblacion->id, old('poblaciones'))) ? 'checked' : '' }}>
                                <div
                                    class="w-10 h-5 bg-gray-200 border-2 border-gray-300 rounded-full peer peer-checked:bg-green-500 peer-checked:border-green-600 transition-colors shadow-inner">
                                </div>
                                <div
                                    class="absolute inset-y-0 left-0 w-5 h-5 bg-white border border-gray-300 rounded-full shadow transition-transform transform peer-checked:translate-x-full peer-checked:border-green-600">
                                </div>
                            </div>
                            <div
                                class="ml-3 text-gray-700 font-semibold uppercase text-xs tracking-wide group-hover:text-gray-900 transition-colors leading-tight">
                                {{ $poblacion->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Archivo de convenio Section -->
            <div class="mt-16 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Archivo de convenio
                </div>
            </div>

            <div class="px-8 mt-10">
                <label class="block text-[#9b2242] font-bold mb-2 ml-2"><span class="text-red-600">*</span> Archivo de
                    convenio</label>

                <!-- Initial Upload Button State -->
                <div id="upload-container">
                    <button type="button" onclick="document.getElementById('pdf_document').click()"
                        class="bg-[#c29b62] hover:bg-[#a68250] text-gray-900 font-bold py-2 px-4 rounded shadow-md transition flex items-center text-sm">
                        <i class="fas fa-file-upload mr-2"></i> Agrega archivo
                    </button>
                    <input type="file" id="pdf_document" name="pdf_document" accept=".pdf" class="hidden"
                        onchange="handleFileUpload(this)">
                </div>

                <!-- Preview State (Hidden initially) -->
                <div id="file-preview-container" class="hidden mt-4 items-start space-x-6">
                    <button type="button" onclick="removeFile()"
                        class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded shadow transition flex items-center text-sm">
                        <i class="fas fa-trash-alt mr-2"></i> Eliminar
                    </button>
                    <div class="flex-1 max-w-sm">
                        <div id="file-name" class="text-sm text-gray-700 font-medium mb-1 truncate">nombre_de_archivo.pdf
                        </div>
                        <div id="file-size" class="text-xs text-gray-500 font-bold mb-3">1.5 KB</div>
                        <div class="w-full h-3 bg-[#e8dcb8] rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Empresas / Instituciones Section -->
            <div class="mt-16 relative flex items-center justify-center">
                <div class="absolute w-full z-0 px-8">
                    <div class="border-t-2 border-gray-400"></div>
                </div>
                <div
                    class="bg-gradient-to-b from-gray-500 to-gray-700 text-white px-6 py-1.5 rounded-full font-bold z-10 shadow border-2 border-white shadow-gray-400">
                    Empresas / Instituciones
                </div>
            </div>

            <div class="px-8 mt-10 mb-10">
                <button type="button" onclick="openCompanyModal()"
                    class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded shadow transition flex items-center text-sm mb-4">
                    <i class="fas fa-plus mr-2"></i> Agregar
                </button>
                <div class="flex pb-2 border-b border-gray-200">
                    <div class="w-1/3 font-bold text-gray-800 text-sm">Opción</div>
                    <div class="w-1/3 font-bold text-gray-800 text-sm">Tipo</div>
                    <div class="w-1/3 font-bold text-gray-800 text-sm">Nombre</div>
                </div>
                <!-- Contenedor dinámico de filas -->
                <div id="companies-table-body" class="mb-4">
                    <!-- Las empresas se agregarán aquí por JS -->
                </div>
                <!-- Inputs hidden array para enviar en el POST -->
                <div id="hidden-companies-inputs"></div>
            </div>

            <!-- Observaciones Section -->
            <div class="px-8 mt-16 mb-4">
                <label class="block text-[#9b2242] font-bold mb-2 ml-2 text-lg">Observaciones</label>
                <textarea name="observations" rows="4" maxlength="200"
                    class="w-full border-2 border-gray-600 rounded-lg px-5 py-3 text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition shadow-sm">{{ old('observations') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Máximo 200 caracteres</p>
            </div>

            <!-- Submit Button Section -->
            <div class="mt-16 bg-cyan-50 -mx-8 py-4 px-8 border-t border-gray-200 flex justify-end">
                <button type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-6 rounded-md shadow outline-none transition flex items-center">
                    Guardar <i class="fas fa-save ml-2"></i>
                </button>
            </div>
        </form>
        </form>
    </div>

    <!-- Modal de Empresas -->
    <div id="company-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 flex flex-col">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-base font-bold text-gray-800 flex items-center tracking-wide">
                    <i class="fas fa-building text-blue-400 mr-2 text-xl drop-shadow-sm"></i> EMPRESAS / INSTITUCIONES
                </h3>
                <button type="button" onclick="closeCompanyModal()"
                    class="text-pink-500 hover:text-pink-700 transition transform hover:scale-110">
                    <i class="fas fa-times-circle text-2xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <!-- Tipo -->
                <div class="mb-4 text-center">
                    <label class="block text-[#9b2242] font-bold mb-1 text-sm"><span class="text-red-600">*</span>
                        Tipo</label>
                    <div class="relative w-3/4 mx-auto">
                        <select id="modal-company-type"
                            class="w-full border-2 border-gray-400 rounded-full px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none transition">
                            <option value="">» VER TODO</option>
                            <option value="EMPRESA">EMPRESA</option>
                            <option value="INSTITUCIÓN">INSTITUCIÓN</option>
                            <option value="ASOCIACIÓN">ASOCIACIÓN</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500"><i
                                class="fas fa-chevron-down text-xs"></i></div>
                    </div>
                </div>
                <!-- Nombre -->
                <div class="mb-4 text-center">
                    <label class="block text-[#9b2242] font-bold mb-1 text-sm"><span class="text-red-600">*</span>
                        Nombre</label>
                    <input type="text" id="modal-company-name"
                        class="w-3/4 mx-auto border-2 border-gray-400 rounded-full px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] transition shadow-inner">
                </div>
                <!-- Botón Buscar -->
                <div class="text-center mb-6 mt-6">
                    <button type="button" onclick="searchCompany()"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded shadow transition text-sm flex items-center justify-center mx-auto hover:shadow-lg">
                        <i class="fas fa-search mr-2"></i> Buscar
                    </button>
                </div>
                <!-- Resultados -->
                <div class="mb-2 text-center border-t border-gray-200 pt-6">
                    <label class="block text-[#9b2242] font-bold mb-2 text-sm"><span class="text-red-600">*</span> Empresa /
                        institución</label>
                    <div class="relative w-full">
                        <select id="modal-company-result"
                            class="w-full border-2 border-gray-400 rounded-full px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:border-[#9b2242] appearance-none transition">
                            <option value="" disabled selected>» SELECCIONA LA EMPRESA / INSTITUCION</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500"><i
                                class="fas fa-chevron-down text-xs"></i></div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 flex justify-end gap-3 border-t border-gray-200">
                <button type="button" onclick="closeCompanyModal()"
                    class="bg-[#ef4444] hover:bg-red-600 text-white font-bold py-2 px-5 rounded flex items-center text-sm shadow transition hover:shadow-md">
                    <i class="fas fa-times-circle mr-2"></i> Cerrar
                </button>
                <button type="button" onclick="addCompanyToTable()"
                    class="bg-[#10b981] hover:bg-green-600 text-white font-bold py-2 px-5 rounded flex items-center text-sm shadow transition hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i> Agregar
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Companies JS Logic
        const allCompanies = @json($companies ?? []);
        let selectedCompanies = {};

        document.addEventListener('DOMContentLoaded', function () {
            @if(session('duplicate_error'))
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    html: 'El número de convenio {{ session('duplicate_error')['number'] }} ya se encuentra guardado con el registro No.<strong>{{ session('duplicate_error')['id'] }}</strong> de nombre <strong>{{ session('duplicate_error')['name'] }}</strong>',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Cerrar'
                });
            @endif
            @if($errors->has('pdf_document'))
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: '{{ $errors->first('pdf_document') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Cerrar'
                });
            @endif
            });

        function handleFileUpload(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate PDF type
                if (file.type !== 'application/pdf') {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'El archivo debe ser un documento PDF válido.' });
                    input.value = '';
                    return;
                }

                // Validate Size (8MB = 8388608 bytes)
                if (file.size > 8388608) {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'El archivo de convenio no debe pesar más de 8MB.' });
                    input.value = '';
                    return;
                }

                // Calculate display size
                let sizeText = '';
                if (file.size < 1024 * 1024) {
                    sizeText = (file.size / 1024).toFixed(1) + ' KB';
                } else {
                    sizeText = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                }

                // Update UI Texts
                document.getElementById('file-name').textContent = file.name;
                document.getElementById('file-size').textContent = sizeText;

                // Toggle visibility
                document.getElementById('upload-container').classList.add('hidden');
                document.getElementById('file-preview-container').classList.remove('hidden');
                document.getElementById('file-preview-container').classList.add('flex');
            }
        }

        function removeFile() {
            const input = document.getElementById('pdf_document');
            input.value = ''; // Clear the file

            // Toggle visibility
            document.getElementById('file-preview-container').classList.add('hidden');
            document.getElementById('file-preview-container').classList.remove('flex');
            document.getElementById('upload-container').classList.remove('hidden');
        }

        // Modal Functions
        function openCompanyModal() {
            document.getElementById('company-modal').classList.remove('hidden');
            document.getElementById('modal-company-type').value = '';
            document.getElementById('modal-company-name').value = '';
            searchCompany(); // populate initial empty
        }

        function closeCompanyModal() {
            document.getElementById('company-modal').classList.add('hidden');
        }

        function removeAccents(str) {
            return str ? str.normalize("NFD").replace(/[\u0300-\u036f]/g, "") : "";
        }

        function searchCompany() {
            const rawTypeFilter = document.getElementById('modal-company-type').value;
            const typeFilter = removeAccents(rawTypeFilter).toLowerCase();
            const nameFilter = removeAccents(document.getElementById('modal-company-name').value).toLowerCase();

            const resultSelect = document.getElementById('modal-company-result');
            resultSelect.innerHTML = '<option value="" disabled selected>» SELECCIONA LA EMPRESA / INSTITUCION</option>';

            const filtered = allCompanies.filter(comp => {
                const compType = removeAccents(comp.type).toLowerCase();
                const compName = removeAccents(comp.name).toLowerCase();

                // If typeFilter is not empty, it must strictly match. 
                // Since modal-company-type contains accent (e.g. INSTITUCIÓN), removeAccents handles it smoothly.
                const matchType = typeFilter === '' || compType === typeFilter;
                const matchName = nameFilter === '' || compName.includes(nameFilter);
                return matchType && matchName;
            });

            filtered.forEach(comp => {
                const opt = document.createElement('option');
                opt.value = comp.id;
                opt.text = `[${comp.type || 'S/T'}] ${comp.name || 'Sin nombre'}`;
                opt.dataset.type = comp.type || '';
                opt.dataset.name = comp.name || '';
                resultSelect.appendChild(opt);
            });
        }

        function addCompanyToTable() {
            const resultSelect = document.getElementById('modal-company-result');
            if (!resultSelect.value) {
                Swal.fire({ icon: 'warning', title: 'Atención', text: 'Seleccione una empresa de la lista.' });
                return;
            }

            const compId = resultSelect.value;

            if (selectedCompanies[compId]) {
                Swal.fire({ icon: 'warning', title: 'Atención', text: 'Esta empresa ya ha sido agregada.' });
                return;
            }

            const selectedOption = resultSelect.options[resultSelect.selectedIndex];
            const compType = selectedOption.dataset.type;
            const compName = selectedOption.dataset.name;

            selectedCompanies[compId] = true;

            // Build Row
            const tbody = document.getElementById('companies-table-body');
            const row = document.createElement('div');
            row.id = `company-row-${compId}`;
            row.className = "flex py-3 border-b border-gray-100 items-center bg-gray-50 hover:bg-gray-100 transition";
            row.innerHTML = `
                    <div class="w-1/3 pl-2 text-center md:text-left">
                        <button type="button" onclick="removeCompanyFromTable(${compId})" class="text-[#9b2242] hover:text-red-800 transition transform hover:scale-110">
                            <i class="fas fa-trash-alt text-lg"></i>
                        </button>
                    </div>
                    <div class="w-1/3 text-sm text-gray-700 uppercase">${compType}</div>
                    <div class="w-1/3 text-sm text-gray-700 uppercase">${compName}</div>
                `;
            tbody.appendChild(row);

            // Add hidden input
            const hiddenInputs = document.getElementById('hidden-companies-inputs');
            const hiddenInp = document.createElement('input');
            hiddenInp.type = "hidden";
            hiddenInp.name = "companies[]";
            hiddenInp.value = compId;
            hiddenInp.id = `company-input-${compId}`;
            hiddenInputs.appendChild(hiddenInp);

            closeCompanyModal();
        }

        function removeCompanyFromTable(compId) {
            delete selectedCompanies[compId];
            const row = document.getElementById(`company-row-${compId}`);
            if (row) row.remove();
            const inp = document.getElementById(`company-input-${compId}`);
            if (inp) inp.remove();
        }
    </script>
@endpush