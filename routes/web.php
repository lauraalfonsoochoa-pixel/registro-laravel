<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/estudiantes');
Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
Route::get('/estudiantes/{estudiante}/editar', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
Route::get('/estudiantes/{estudiante}/eliminar', [EstudianteController::class, 'confirmar'])->name('estudiantes.confirmar');
Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
