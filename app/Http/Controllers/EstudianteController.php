<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstudianteController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('buscar', ''));
        $programa = (string) $request->query('programa', '');

        $filas = Estudiante::query()
            ->when($q !== '', function ($query) use ($q): void {
                $query->where(function ($query) use ($q): void {
                    $query->where('nombre', 'like', "%{$q}%")
                        ->orWhere('apellido', 'like', "%{$q}%")
                        ->orWhere('correo', 'like', "%{$q}%");
                });
            })
            ->when(in_array($programa, config('programas'), true), fn ($query) => $query->where('programa', $programa))
            ->orderBy('nombre')
            ->orderBy('apellido')
            ->paginate(10)
            ->withQueryString();

        return view('estudiantes.index', [
            'filas' => $filas,
            'buscar' => $q,
            'programa' => $programa,
            'programas' => config('programas'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Estudiante::create($this->datos($request, true));

        return redirect()->route('estudiantes.index')->with('aviso', 'Estudiante registrado correctamente.');
    }

    public function edit(Estudiante $estudiante): View
    {
        return view('estudiantes.editar', [
            'estudiante' => $estudiante,
            'programas' => config('programas'),
            'semestres' => range(1, 10),
        ]);
    }

    public function update(Request $request, Estudiante $estudiante): RedirectResponse
    {
        $estudiante->update($this->datos($request, false, $estudiante));

        return redirect()->route('estudiantes.index')->with('aviso', 'Estudiante actualizado correctamente.');
    }

    public function confirmar(Estudiante $estudiante): View
    {
        return view('estudiantes.confirmar', compact('estudiante'));
    }

    public function destroy(Estudiante $estudiante): RedirectResponse
    {
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('aviso', 'Estudiante eliminado correctamente.');
    }

    private function datos(Request $request, bool $incluyeId, ?Estudiante $estudiante = null): array
    {
        $correoUnico = Rule::unique('estudiantes', 'correo');

        if ($estudiante !== null) {
            $correoUnico->ignore($estudiante->getKey(), 'id');
        }

        $reglas = [
            'nombre' => ['required', 'string', 'min:2', 'max:60', 'regex:/^[\pL ]+$/u'],
            'apellido' => ['required', 'string', 'min:2', 'max:60', 'regex:/^[\pL ]+$/u'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:today'],
            'codigo' => ['required', 'string', 'regex:/^[A-Za-z0-9-]{4,20}$/'],
            'programa' => ['required', 'string', Rule::in(config('programas'))],
            'semestre' => ['required', 'integer', 'between:1,10'],
            'correo' => ['required', 'email', 'max:100', $correoUnico],
            'telefono' => ['required', 'string', 'regex:/^[0-9+() -]{7,15}$/'],
            'direccion' => ['required', 'string', 'min:5', 'max:150'],
        ];

        if ($incluyeId) {
            $reglas['id'] = ['required', 'string', 'regex:/^[0-9]{6,15}$/', Rule::unique('estudiantes', 'id')];
        }

        return $request->validate($reglas, [
            'id.unique' => 'Ese documento ya está registrado.',
            'id.regex' => 'El documento debe tener entre 6 y 15 números.',
            'programa.in' => 'Selecciona un programa válido.',
            'correo.unique' => 'Ese correo ya está registrado.',
        ]);
    }
}
