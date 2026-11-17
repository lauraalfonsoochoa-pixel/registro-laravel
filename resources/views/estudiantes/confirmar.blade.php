@extends('layouts.app')

@section('title', 'Confirmar eliminación')

@section('content')
<main class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <section class="card shadow-sm w-100" style="max-width: 620px">
        <div class="card-body p-4 p-md-5">
            <h1 class="h3">Confirmar eliminación</h1>
            <p>¿Deseas eliminar a <strong>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</strong> (documento {{ $estudiante->id }})?</p>
            <p class="text-secondary">El registro solo se eliminará después de confirmar.</p>
            <form method="post" action="{{ route('estudiantes.destroy', $estudiante) }}" class="d-flex gap-2">
                @csrf @method('DELETE')
                <button class="btn btn-danger" type="submit">Sí, eliminar</button>
                <a class="btn btn-outline-secondary" href="{{ route('estudiantes.index') }}">Cancelar</a>
            </form>
        </div>
    </section>
</main>
@endsection
