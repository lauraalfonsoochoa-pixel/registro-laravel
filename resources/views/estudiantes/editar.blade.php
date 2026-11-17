@extends('layouts.app')

@section('title', 'Editar estudiante')

@section('content')
<main class="container py-4 py-md-5">
    <section class="card shadow-sm mx-auto" style="max-width: 850px">
        <div class="card-body p-4 p-md-5">
            <h1 class="h2 mb-1">Editar estudiante</h1>
            <p class="text-secondary mb-4">Documento: {{ $estudiante->id }}</p>
            @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <form method="post" action="{{ route('estudiantes.update', $estudiante) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="nombre">Nombre</label><input class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $estudiante->nombre) }}" required minlength="2" maxlength="60"></div>
                    <div class="col-md-6"><label class="form-label" for="apellido">Apellido</label><input class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $estudiante->apellido) }}" required minlength="2" maxlength="60"></div>
                    <div class="col-md-6"><label class="form-label" for="edad">Edad</label><input class="form-control" id="edad" name="edad" type="number" value="{{ old('edad', $estudiante->edad) }}" min="16" max="100" step="1" required></div>
                    <div class="col-md-6"><label class="form-label" for="codigo">Código estudiantil</label><input class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $estudiante->codigo) }}" required minlength="4" maxlength="20"></div>
                    <div class="col-md-6"><label class="form-label" for="programa">Programa</label><select class="form-select" id="programa" name="programa" required>@foreach ($programas as $opcion)<option value="{{ $opcion }}" @selected(old('programa', $estudiante->programa) === $opcion)>{{ $opcion }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label" for="semestre">Semestre</label><select class="form-select" id="semestre" name="semestre" required>@foreach ($semestres as $n)<option value="{{ $n }}" @selected((string) old('semestre', $estudiante->semestre) === (string) $n)>{{ $n }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label" for="correo">Correo</label><input class="form-control" id="correo" name="correo" type="email" value="{{ old('correo', $estudiante->correo) }}" required maxlength="100"></div>
                    <div class="col-md-6"><label class="form-label" for="telefono">Teléfono</label><input class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $estudiante->telefono) }}" required maxlength="15"></div>
                    <div class="col-12"><label class="form-label" for="direccion">Dirección</label><input class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $estudiante->direccion) }}" required minlength="5" maxlength="150"></div>
                </div>
                <div class="d-flex gap-2 mt-4"><button class="btn btn-primary" type="submit">Guardar cambios</button><a class="btn btn-outline-secondary" href="{{ route('estudiantes.index') }}">Cancelar</a></div>
            </form>
        </div>
    </section>
</main>
@endsection
