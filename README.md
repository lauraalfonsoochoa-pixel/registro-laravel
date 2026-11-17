# Registro de estudiantes en Laravel

Migración del sistema PHP que está en `../Miproyecto`. Conserva documento, nombre, apellido, fecha de nacimiento, código, programa, semestre, correo, teléfono y dirección. El acceso usa la tabla `users` estándar de Laravel; no copia cuentas ni estudiantes de la aplicación anterior.

## Requisitos de esta instalación

- PHP 8.2 o superior compatible con Laravel 12.
- Composer.
- XAMPP con MySQL activo.

La guía del curso menciona Laravel 13 y PHP 8.3. Esta computadora tiene Laravel 12.70.2 y PHP 8.2.12, así que este proyecto conserva la instalación que ya funciona. Si el docente exige Laravel 13, habrá que actualizar PHP antes de cambiar la versión del framework.

## Preparar y ejecutar

Desde esta carpeta:

```cmd
composer install
copy .env.example .env
php artisan key:generate
```

El `.env.example` ya configura MySQL de XAMPP con la base `webii_laravel`. Edita `.env` y configura `DOCENTE_EMAIL` y `DOCENTE_CLAVE` con credenciales solo locales. `.env` está excluido de Git. Si vas a usar SQLite en vez de MySQL, cambia `DB_CONNECTION=sqlite` y crea el archivo con `if not exist database\database.sqlite type nul > database\database.sqlite`.

Antes de migrar, inicia MySQL desde XAMPP y crea la base vacía:

```cmd
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS webii_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Después ejecuta:

```cmd
composer dump-autoload
php artisan config:clear
php artisan migrate
php artisan db:seed --class=DocenteSeeder
php artisan route:list
php artisan serve
```

Abre `http://127.0.0.1:8000`. La ruta raíz lleva al inicio de sesión. El seeder crea el usuario docente si no existe; no sobrescribe su contraseña si la cuenta ya existe.

## Comprobaciones manuales

1. Sin iniciar sesión, visita `/estudiantes`; debe pedir acceso.
2. Inicia sesión con `DOCENTE_EMAIL` y `DOCENTE_CLAVE`.
3. Registra un estudiante válido y comprueba que aparece en la tabla.
4. Intenta registrar un documento duplicado y una fecha futura; deben volver errores y no guardarse.
5. Busca por nombre, apellido o correo y filtra por programa.
6. Edita un registro. Abre la confirmación de borrado y cancélala; luego confirma el borrado.
7. Cierra sesión y comprueba que `/estudiantes` vuelve a pedir acceso.

## Resultados obtenidos en este equipo

Comprobación manual realizada el 17/11/2026 con PHP 8.2.12, Laravel 12.70.2 y MySQL de XAMPP:

| Hito | Resultado |
|---|---|
| Entorno | `composer check-platform-reqs` pasó. Las migraciones de Laravel y `estudiantes` se aplicaron en `webii_laravel`; `DocenteSeeder` creó la cuenta configurada en `.env`. |
| Acceso | Sin sesión, `/estudiantes` muestra el inicio de sesión. Login y cierre de sesión funcionaron. |
| Registro y reglas | El alta válida funcionó. Fecha futura, semestre fuera de rango, correo inválido y documento duplicado fueron rechazados. |
| CRUD | Búsqueda y filtro por programa, edición, cancelación de la confirmación y eliminación confirmada funcionaron. |
| Limpieza | Se borraron los registros temporales de comprobación; `webii_laravel.estudiantes` quedó vacío. |
| Git | Rama `main`, dos commits locales, `.env` ignorado y árbol de trabajo limpio. Falta vincular el remoto de este proyecto Laravel. |

La tabla anterior corresponde al proyecto disponible en `Miproyecto`, que usa documento, apellido y fecha de nacimiento, entre otros campos. La guía del Encuentro 15 menciona un modelo más corto con edad. No se importaron los cinco registros locales de `Miproyecto`.

## Git

Revisa antes de confirmar cambios:

```cmd
git status
git check-ignore .env
git add .
git diff --cached
git commit -m "Migra el registro académico a Laravel"
git log --oneline
```

No agregues `.env`, `vendor`, `node_modules` ni datos reales. Para enviar a un remoto, crea un repositorio vacío en el proveedor indicado por el docente, configura `origin` con su URL real y luego usa `git push -u origin main`.
