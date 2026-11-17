<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        $email = (string) config('docente.email');
        $password = (string) config('docente.clave');

        if ($email === '' || $password === '') {
            throw new \RuntimeException('Configura DOCENTE_EMAIL y DOCENTE_CLAVE en .env antes de ejecutar el seeder.');
        }

        User::firstOrCreate(
            ['email' => $email],
            ['name' => 'Docente', 'password' => $password],
        );
    }
}
