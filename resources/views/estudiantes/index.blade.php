@extends('layouts.app')

@section('title', 'Estudiantes registrados')

@section('content')
<main class="container-fluid container-xl py-4 py-md-5">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Estudiantes registrados</h1>
            <p class="text-secondary mb-0">Registro académico</p>
        </div>
    </div>

    @if (session('aviso'))<div class="alert alert-success" role="status">{{ session('aviso') }}</div>@endif

    <div class="row g-4">
        <div class="col-lg-4">
            <section class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h4 mb-3">Registrar estudiante</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger"><strong>Revisa estos datos:</strong><ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif
                    <form method="post" action="{{ route('estudiantes.store') }}">
                        @csrf
                        <div class="mb-3"><label class="form-label" for="id">Documento</label><input class="form-control" id="id" name="id" value="{{ old('id') }}" required minlength="6" maxlength="15" pattern="[0-9]{6,15}"></div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label" for="nombre">Nombre</label><input class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required minlength="2" maxlength="60"></div>
                            <div class="col-md-6"><label class="form-label" for="apellido">Apellido</label><input class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" required minlength="2" maxlength="60"></div>
                        </div>
                        <div class="mb-3 mt-3"><label class="form-label" for="edad">Edad</label><input class="form-control" id="edad" name="edad" type="number" value="{{ old('edad') }}" min="16" max="100" step="1" required></div>
                        <div class="mb-3"><label class="form-label" for="codigo">Código estudiantil</label><input class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" required minlength="4" maxlength="20"></div>
                        <div class="mb-3"><label class="form-label" for="programa">Programa</label><select class="form-select" id="programa" name="programa" required><option value="">Selecciona un programa</option>@foreach ($programas as $opcion)<option value="{{ $opcion }}" @selected(old('programa') === $opcion)>{{ $opcion }}</option>@endforeach</select></div>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label" for="semestre">Semestre</label><select class="form-select" id="semestre" name="semestre" required><option value="">—</option>@foreach (range(1, 10) as $n)<option value="{{ $n }}" @selected((string) old('semestre') === (string) $n)>{{ $n }}</option>@endforeach</select></div>
                            <div class="col-md-8"><label class="form-label" for="correo">Correo</label><input class="form-control" id="correo" name="correo" type="email" value="{{ old('correo') }}" required maxlength="100"></div>
                        </div>
                        <div class="mb-3 mt-3"><label class="form-label" for="telefono">Teléfono</label><input class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required maxlength="15"></div>
                        <div class="mb-3"><label class="form-label" for="direccion">Dirección</label><input class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required minlength="5" maxlength="150"></div>
                        <button class="btn btn-danger w-100" type="submit">Guardar estudiante</button>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-lg-8">
            <section class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h4 mb-3">Listado</h2>
                    <form method="get" action="{{ route('estudiantes.index') }}" class="row g-2 mb-3">
                        <div class="col-md-6"><label class="visually-hidden" for="buscar">Buscar</label><input class="form-control" id="buscar" name="buscar" type="search" placeholder="Nombre, apellido o correo" value="{{ $buscar }}"></div>
                        <div class="col-md-4"><label class="visually-hidden" for="filtro-programa">Programa</label><select class="form-select" id="filtro-programa" name="programa"><option value="">Todos los programas</option>@foreach ($programas as $opcion)<option value="{{ $opcion }}" @selected($programa === $opcion)>{{ $opcion }}</option>@endforeach</select></div>
                        <div class="col-md-2 d-flex gap-2"><button class="btn btn-dark flex-grow-1" type="submit">Buscar</button><a class="btn btn-outline-secondary" href="{{ route('estudiantes.index') }}" aria-label="Limpiar filtros">×</a></div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead><tr><th>Documento</th><th>Estudiante</th><th>Edad</th><th>Programa</th><th>Correo</th><th>Acciones</th></tr></thead>
                            <tbody>
                            @forelse ($filas as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->id }}</td><td>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</td><td>{{ $estudiante->edad }}</td><td>{{ $estudiante->programa }}<div class="small text-secondary">Semestre {{ $estudiante->semestre }}</div></td><td>{{ $estudiante->correo }}</td>
                                    <td class="text-nowrap"><a class="btn btn-sm btn-outline-primary" href="{{ route('estudiantes.edit', $estudiante) }}">Editar</a> <a class="btn btn-sm btn-outline-danger" href="{{ route('estudiantes.confirmar', $estudiante) }}">Eliminar</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-secondary py-4">No hay estudiantes que coincidan con la búsqueda.</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $filas->links() }}
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
