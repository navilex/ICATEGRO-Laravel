<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\CustomLogger;

class AuthController extends Controller
{
    /**
     * Show the login view.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Strict case sensitivity check for username if needed.
        // Laravel's Auth::attempt is generally case-insensitive for username in MySQL depending on collation.
        // To enforce strictness as requested:
        $user = User::where('username', $credentials['username'])->first();

        if (
            $user &&
            $user->username === $credentials['username'] && // PHP string comparison is case-sensitive
            Auth::attempt($credentials, $request->boolean('remember'))
        ) {

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // Log the failed attempt using CustomLogger
        CustomLogger::logError(
            'Inicio de sesión fallido',
            'AUTH_ERR_001',
            "Intento fallido para usuario: {$request->username} desde IP: {$request->ip()}"
        );

        return back()->withErrors([
            'username' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
