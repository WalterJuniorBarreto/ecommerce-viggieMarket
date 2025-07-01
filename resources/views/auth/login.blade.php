@extends('layouts.app')

@section('title','Iniciar Sesión')

@section('content')
<section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2 class="mb-2">Iniciar Sesión</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Iniciar Sesión</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="log-in-section background-image-2 section-b-space">
    <div class="container-fluid-lg w-100">
        <div class="row">
            <!-- Imagen decorativa -->
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('assets/images/inner-page/log-in.png') }}" class="img-fluid" alt="Inicio de sesión en ViggieMarket eCommerce">
                </div>
            </div>

            <!-- Formulario de inicio de sesión -->
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h3>Bienvenido a ViggieMarket eCommerce</h3>
                        <h4>Inicia sesión en tu cuenta</h4>
                    </div>

                    <!-- Pestañas para seleccionar tipo de login -->
                    <ul class="nav nav-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-login" type="button">Usuario</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-login" type="button">Administrador</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="loginTabsContent">
                        <!-- Login normal de usuario -->
                        <div class="tab-pane fade show active" id="user-login" role="tabpanel">
                            <div class="input-box mt-3">
                                <form class="row g-4" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="hidden" name="is_admin" value="0">

                                    <!-- Campo Email -->
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required autofocus>
                                            <label for="email">Correo Electrónico</label>
                                            @error('email')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Campo Contraseña -->
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Contraseña" required>
                                            <label for="password">Contraseña</label>
                                            @error('password')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Recordar sesión y Recuperar contraseña -->
                                    <div class="col-12">
                                        <div class="forgot-box">
                                            <div class="form-check ps-0 m-0 remember-box">
                                                <input class="checkbox_animated check-box" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Recordarme</label>
                                            </div>
                                            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>

                                    <!-- Botón de inicio de sesión -->
                                    <div class="col-12">
                                        <button class="btn btn-animation w-100 justify-content-center" type="submit">
                                            Iniciar Sesión
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

<!-- Login de administrador -->
<div class="tab-pane fade" id="admin-login" role="tabpanel">
    <div class="input-box mt-3">
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <!-- Campo Email -->
            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="admin_email" 
                           name="email" 
                           placeholder="Correo Electrónico Admin" 
                           required 
                           autofocus>
                    <label for="admin_email">Correo Electrónico Admin</label>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Contraseña -->
            <div class="col-12">
                <div class="form-floating theme-form-floating log-in-form">
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="admin_password" 
                           name="password" 
                           placeholder="Contraseña Admin" 
                           required>
                    <label for="admin_password">Contraseña Admin</label>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Campo Clave Secreta (si está activada en el .env) -->
  @if(config('admin.require_secret_key'))
<div class="col-12">
    <div class="form-floating theme-form-floating log-in-form">
        <input type="text" 
               class="form-control @error('secret_key') is-invalid @enderror" 
               id="admin_secret" 
               name="secret_key" 
               placeholder="Clave Secreta" 
               value="{{ old('secret_key') }}" 
               required>
        <label for="admin_secret">Clave Secreta</label>
        <small class="form-text text-muted">Solo para acceso de administrador</small>
        
        @error('secret_key')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@endif


            <!-- Botón de inicio de sesión -->
            <div class="col-12">
                <button class="btn btn-animation w-100 justify-content-center bg-dark text-white" type="submit">
                    Acceso Administrador
                </button>
            </div>
        </form>
    </div>
</div>


                    <!-- Separador -->
                    <div class="other-log-in">
                        <h6>o</h6>
                    </div>

                    <!-- Registro -->
                    <div class="sign-up-box">
                        <h4>¿Aún no tienes una cuenta?</h4>
                        <a href="{{ route('register') }}">Regístrate aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        color: #495057;
        padding: 0.5rem 1rem;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .nav-tabs .nav-link:hover {
        border-color: #e9ecef #e9ecef #dee2e6;
    }
</style>
@endsection