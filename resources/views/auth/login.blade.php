@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<main class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <section class="card shadow-sm w-100" style="max-width: 460px">
        <div class="card-body p-4 p-md-5">
            <h1 class="h3 mb-2">Registro de estudiantes</h1>
            <p class="text-secondary mb-4">Inicia sesión para continuar.</p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="post" action="{{ route('login.entrar') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="email">Correo</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label" for="password">Contraseña</label>
                    <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                </div>
                <button class="btn btn-dark w-100" type="submit">Entrar</button>
            </form>
        </div>
    </section>
</main>
@endsection
