<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Muestra el formulario de login para administradores
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Usa la vista de login con pestañas
    }

    /**
     * Maneja el intento de autenticación
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Verificación de intentos fallidos
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Valida los datos del login
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'secret_key' => $this->secretKeyRequired() ? 'required|string' : 'nullable'
        ]);
    }

    /**
     * Intenta autenticar al usuario
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Verificar clave secreta si está configurada
        if ($this->secretKeyRequired() && !$this->validateSecretKey($request->input('secret_key'))) {
            return false;
        }

        // Verificar que el usuario exista y sea admin
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !$user->is_admin) {
            return false;
        }

        return Auth::attempt($credentials, $remember);
    }

    /**
     * Verifica si se requiere clave secreta
     */
    protected function secretKeyRequired(): bool
    {
        return config('admin.require_secret_key', false);
    }

    /**
     * Valida la clave secreta
     */
    protected function validateSecretKey(?string $key): bool
    {
        return $key === config('admin.secret_key');
    }

    /**
     * Respuesta exitosa
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Respuesta fallida
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Maneja el logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Protección contra fuerza bruta
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request),
            config('admin.max_login_attempts', 5)
        );
    }

    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request));
    }

    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }
}