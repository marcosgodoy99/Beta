BETA

sistema de gestion de alumnos y asistencias

## Requisitos del Sistema

- PHP >= 8.0
- MySQL o MariaDB
- Composer

## Instalación

1. Clona el repositorio: **git clone https://github.com/marcosgodoy99/beta.git**
2. Instala las dependencias: **composer install**
3. Copia el archivo de configuración: **cp .env.example .env**
4. Genera la clave de la aplicación: **php artisan key:generate**
5. Configura la base de datos en el archivo: **.env**
6. Ejecuta las migraciones: **php artisan migrate**

Para ejecutar el servidor de desarrollo:
**php artisan serve**
