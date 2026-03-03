<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ICATEGRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-logos {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="w-full">
        <img src="{{ asset('images/ICATEGRO BANNER.png') }}" alt="ICATEGRO Banner" class="w-full h-auto object-cover">
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-[#c49a6c] p-4 flex items-center justify-center space-x-4">
                <img src="{{ asset('images/login usuario.png') }}" alt="Login Icon" class="h-16 w-auto">
                <h2 class="text-white text-3xl font-bold uppercase tracking-wider drop-shadow-md">LOGIN</h2>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Error:</strong>
                            <span class="block sm:inline">{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="username" class="block text-red-700 text-sm font-bold mb-2">Usuario</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500"
                            placeholder="Ingrese su usuario" required autofocus>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-red-700 text-sm font-bold mb-2">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-red-500"
                            placeholder="Ingrese su contraseña" required>
                    </div>

                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-8 rounded focus:outline-none focus:shadow-outline w-full transition duration-300">
                            INICIAR SESIÓN
                        </button>
                    </div>
                </form>
            </div>
    </main>

    <!-- Footer -->
    <footer class="bg-red-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Instituto de Capacitación para el Trabajo del Estado de Guerrero
                (ICATEGRO). Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>