# Entrega final · Encuentro 16

- **Repositorio privado:** https://github.com/lauraalfonsoochoa-pixel/registro-laravel
- **Rama:** `main`
- **Commit de la aplicación probado:** `ba26ab5` — valida correos únicos y se probó el CRUD con MySQL.
- **Entorno local:** Laravel 12.70.2, PHP 8.2.12, Composer 2.10.3 y MySQL de XAMPP.
- **Base usada por la aplicación:** `webii_laravel`; no se importaron registros personales del PHP anterior.
- **Estado de pruebas:** ver [registro-pruebas.md](registro-pruebas.md). La instalación desde clon limpio también se comprobó.

## Integrantes y aportes

- **Responsable que aparece en la identidad Git local:** Laura Natalia Alfonso Ochoa. Confirmar con el docente si la entrega es individual o agregar aquí a los demás integrantes.
- **Proyecto de partida:** el repositorio PHP anterior contiene el formulario y CRUD nativo.
- **Migración Laravel:** se trabajaron rutas, controladores, modelo Eloquent, vistas Blade, migraciones, autenticación y validación con ayuda de un asistente de IA. La estudiante debe revisar el código y explicar su recorrido en la defensa.

## Cierre reflexivo para personalizar

**Dificultad resuelta:** al inicio el alta no impedía correos repetidos. Se añadieron la regla `unique` en el controlador y un índice único en MySQL. La prueba de alta duplicada confirmó el rechazo.

**Decisión:** no copiar las cuentas ni los registros de la aplicación PHP anterior. La versión Laravel usa una base separada y el acceso se comprueba mediante `auth`.

**Mejora futura:** alinear el proyecto con el modelo exacto del curso (incluido el campo `edad`) y con Laravel 13/PHP 8.3 si el docente lo exige.

**Reflexión personal — completar con tus palabras:** ¿qué parte comprendes mejor ahora?, ¿qué aprendiste al seguir el dato desde el formulario hasta MySQL?, ¿qué aporte hiciste tú y qué corregirías después?

## Pendiente antes de entregar

Como el repositorio es privado, confirma que el docente tenga acceso. Invítalo como colaborador usando el usuario o correo que indique. No envíes `.env`, contraseñas, capturas de credenciales ni exportaciones de la base con datos personales.
