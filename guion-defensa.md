# Guion breve para la defensa

La guía indica que no hacen falta diapositivas. Abre la aplicación, el editor y el repositorio. Usa datos ficticios y no muestres `.env` ni la contraseña del operador.

## Recorrido de demostración

1. **Objetivo:** “Este sistema permite registrar y consultar estudiantes; la versión conserva los campos del proyecto PHP anterior”.
2. **Acceso:** inicia sesión con el operador local. Explica que el operador es distinto del estudiante que se registra.
3. **Alta:** crea un caso ficticio, por ejemplo Ana Demo, con correo nuevo y documento inventado. Explica `POST /estudiantes` en `routes/web.php`, el método `store`, la validación en `EstudianteController` y `Estudiante::create`.
4. **Persistencia:** muestra la fila en el listado y explica que el modelo `Estudiante` escribe en la tabla MySQL `estudiantes`; la estructura está en la migración.
5. **Búsqueda y edición:** busca “Ana”, abre editar y cambia el semestre. Señala que la ruta contiene el ID de la misma fila y que `update` ignora el correo de esa propia fila al revisar duplicados.
6. **Regla:** intenta registrar edad 15 y luego una edad no entera. Laravel devuelve errores y no inserta esos datos. También puedes intentar repetir el correo en otro registro.
7. **Eliminación:** abre la confirmación y cancela para mostrar que la fila permanece. Vuelve a abrirla y confirma el borrado de Ana únicamente.
8. **Cierre:** cierra sesión y vuelve a `/estudiantes`; el middleware `auth` exige el acceso otra vez.

## Archivos que pueden pedirte

- `routes/web.php`: URL, verbo HTTP y middleware.
- `app/Http/Controllers/EstudianteController.php`: consulta, validación y CRUD.
- `app/Http/Controllers/SesionController.php`: inicio/cierre de sesión y ciclo de la sesión.
- `app/Models/Estudiante.php`: tabla, clave primaria y campos asignables.
- `database/migrations/*estudiantes*`: columnas e índice único del correo.
- `resources/views/estudiantes/*.blade.php`: formulario, listado, edición y confirmación.
- `.gitignore`, `.env.example` y `README.md`: qué se comparte y cómo se prepara una copia nueva.

## Diferencias que conviene decir con claridad

La guía menciona cuatro campos, Laravel 13 y PHP 8.3. La versión disponible conserva diez campos, ya usa `edad`, y se ejecuta en Laravel 12/PHP 8.2. Si preguntan por la diferencia, explica que se migró el sistema disponible y se añadió la validación de edad solicitada.
