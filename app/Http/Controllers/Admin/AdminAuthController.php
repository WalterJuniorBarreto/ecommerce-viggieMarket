<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request); // ✅ redirección segura
        }

        $this->incrementLoginAttempts($request);

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->withInput($request->only('email'));
    }

    // Maneja la respuesta tras login exitoso
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return redirect()->route('admin.dashboard'); // ✅ Redirección fija
    }

    // Valida los datos del formulario
    protected function validateLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        // Solo valida el campo si viene incluido en el request
        if (config('admin.require_secret_key') && $request->has('secret_key')) {
            $rules['secret_key'] = 'string';
        }

        $request->validate($rules);
    }

    // Intenta autenticar al usuario
    protected function attemptLogin(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user || !$user->is_admin) {
            return false;
        }

        // Validar clave secreta si se requiere y viene en el request
        if (config('admin.require_secret_key') && $request->has('secret_key')) {
            if ($request->secret_key !== config('admin.secret_key')) {
                return false;
            }
        }

        return Auth::attempt($request->only('email', 'password'), $request->filled('remember'));
    }

    // Verifica si se excedieron los intentos
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request),
            config('admin.max_login_attempts', 5)
        );
    }

    // Incrementa contador de intentos fallidos
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request));
    }

    // Limpia los intentos tras login exitoso
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    // Muestra mensaje de bloqueo si hay demasiados intentos fallidos
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return back()->withErrors([
            'email' => "Demasiados intentos fallidos. Intente en $seconds segundos.",
        ]);
    }

    // Clave única para la limitación de intentos
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }
}
