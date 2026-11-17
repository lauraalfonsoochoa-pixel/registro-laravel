# Registro de pruebas · Encuentro 16

**Fecha:** 17/11/2026

**Versión de código probada:** `ba26ab5` (Laravel 12.70.2, PHP 8.2.12)

**Base:** MySQL local `webii_laravel`; copia limpia probada con `webii_laravel_defensa`.
**Datos:** se usaron datos ficticios de ensayo y se eliminaron al finalizar.

| Caso | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|
| Alta válida con correo nuevo | Aparece una sola fila y vuelve al listado. | La fila ficticia apareció en el listado. | Correcto |
| Correo ya registrado | Error de validación; no crea otra fila. | Rechazado con el mensaje de correo duplicado. Se añadió validación y un índice único en MySQL. | Correcto |
| Edad 15 | Rechazo; no guarda el registro. | Rechazada por la regla `between:16,100`. | Correcto |
| Edad no entera | Rechazo; no guarda. | Rechazada por la regla `integer`. | Correcto |
| Semestre no entero | Rechazo; no guarda. | El valor no entero fue rechazado por la validación del controlador. | Correcto |
| Programa inventado | Error de validación. | El valor fuera del catálogo fue rechazado. | Correcto |
| Editar conservando el propio correo | Guarda la fila sin marcar su correo como duplicado. | Se editó el registro conservando su correo. | Correcto |
| ID inexistente | No altera otra fila; responde 404. | La ruta de edición para un ID ausente respondió 404. | Correcto |
| Búsqueda sin coincidencias | Muestra un resultado vacío comprensible. | Apareció “No hay estudiantes que coincidan con la búsqueda”. | Correcto |
| Cancelar confirmación de eliminación | La fila permanece. | Abrir la confirmación no borró la fila. | Correcto |
| Confirmar borrado de fila ficticia | Desaparece solo esa fila. | Se eliminó la fila de prueba y las tablas de ensayo quedaron sin estudiantes. | Correcto |
| Ruta sin sesión / después de salir | Solicita acceso. | `/estudiantes` llevó al login sin sesión y tras cerrar sesión. | Correcto |
| Persistencia en MySQL al reabrir | La fila permanece tras reiniciar el servidor. | En una copia limpia se reinició `artisan serve`; el registro ficticio seguía ahí. Luego se borró. | Correcto |
| Instalación limpia | Composer, configuración, migraciones, seeder y rutas funcionan. | `git clone`, `composer install`, `key:generate`, `migrate`, `DocenteSeeder` y `route:list` finalizaron correctamente en la base independiente. | Correcto |

## Límites que deben explicarse

- La versión Laravel usa `edad`; la versión PHP anterior conserva `fecha_nacimiento`.
- El enunciado menciona Laravel 13/PHP 8.3; este equipo ejecuta Laravel 12.70.2/PHP 8.2.12.
- La prueba de copia limpia usa el mismo runtime instalado en este equipo. No demuestra compatibilidad con todas las versiones de PHP.
