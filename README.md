# Registro de estudiantes en Laravel

Migración del sistema PHP que está en `../Miproyecto`. Conserva documento, nombre, apellido, edad, código, programa, semestre, correo, teléfono y dirección. No requiere inicio de sesión; no copia cuentas ni estudiantes de la aplicación anterior.

## Requisitos de esta instalación

- PHP 8.2 o superior compatible con Laravel 12.
- Composer.
- XAMPP con MySQL activo.

La guía del curso menciona Laravel 13 y PHP 8.3. Esta computadora tiene Laravel 12.70.2 y PHP 8.2.12, así que este proyecto conserva la instalación que ya funciona. Si el docente exige Laravel 13, habrá que actualizar PHP antes de cambiar la versión del framework.

## Preparar y ejecutar

Para ensayar desde un clon limpio:

```cmd
git clone https://github.com/lauraalfonsoochoa-pixel/registro-laravel.git registro-defensa
cd registro-defensa
```

Desde la carpeta del proyecto:

```cmd
composer install
copy .env.example .env
php artisan key:generate
```

El `.env.example` ya configura MySQL de XAMPP con la base `webii_laravel`. `.env` está excluido de Git. Si vas a usar SQLite en vez de MySQL, cambia `DB_CONNECTION=sqlite` y crea el archivo con `if not exist database\database.sqlite type nul > database\database.sqlite`.

Antes de migrar, inicia MySQL desde XAMPP y crea la base vacía:

```cmd
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS webii_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Después ejecuta:

```cmd
composer dump-autoload
composer check-platform-reqs
php artisan config:clear
php artisan migrate
php artisan route:list
php artisan serve
```

Abre `http://127.0.0.1:8000`; la aplicación carga directamente el registro de estudiantes.

## Comprobaciones manuales

1. Visita `/estudiantes`; debe abrir directamente sin pedir usuario ni contraseña.
2. Registra un estudiante válido y comprueba que aparece en la tabla.
3. Intenta repetir un documento o correo, ingresar edad 15, una edad no entera o un programa inventado; deben volver errores y no guardarse.
4. Busca por nombre, apellido o correo y filtra por programa.
5. Edita un registro. Abre la confirmación de borrado y cancélala; luego confirma el borrado.

## Resultados obtenidos en este equipo

Comprobación manual realizada el 17/11/2026 con PHP 8.2.12, Laravel 12.70.2 y MySQL de XAMPP:

| Hito | Resultado |
|---|---|
| Entorno | `composer check-platform-reqs` pasó. El clon limpio instaló dependencias y migró una base de ensayo separada. |
| Acceso | `/estudiantes` abre directamente sin solicitar usuario ni contraseña. |
| Registro y reglas | Alta válida, rechazo de documento y correo repetidos, edad 15/no entera, programa inventado y semestre no entero. |
| CRUD | Búsqueda con resultados y búsqueda vacía, edición conservando el correo propio, ID inexistente (404), cancelar confirmación y borrar solo la fila elegida. |
| Persistencia | En el clon limpio, MySQL conservó un registro ficticio tras reiniciar el servidor. Después se eliminó y la base de ensayo quedó vacía. |
| Git | Rama `main`, remoto configurado y `.env` ignorado. La copia limpia quedó sin cambios Git tras preparar su entorno local. |

La aplicación PHP disponible en `Miproyecto` usa fecha de nacimiento. La versión Laravel usa `edad`, como pide la prueba del curso, y no importa estudiantes ni cuentas anteriores. La migración protege cualquier instalación antigua de Laravel y se detiene si encuentra filas que requerirían conversión manual.

## Git

Revisa antes de confirmar cambios:

```cmd
git status
git check-ignore .env
git add .
git diff --cached
git commit -m "Migra el registro académico a Laravel"
git log --oneline
git push
```

No agregues `.env`, `vendor`, `node_modules` ni datos reales. El remoto de este proyecto es [registro-laravel](https://github.com/lauraalfonsoochoa-pixel/registro-laravel). Como es privado, agrega al docente como colaborador antes de entregar el enlace.

Consulta [registro-pruebas.md](registro-pruebas.md), [entrega-final.md](entrega-final.md) y [guion-defensa.md](guion-defensa.md) para el registro de evidencias y el recorrido oral.
