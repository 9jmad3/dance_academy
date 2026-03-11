# Dance Academy Base

## Instalación

1. Crear proyecto Laravel nuevo.
2. Instalar Jetstream Livewire.

```bash
composer require laravel/jetstream
php artisan jetstream:install livewire
npm install && npm run build
```

3. Copiar el contenido de este paquete dentro del proyecto Laravel.
4. Configurar PostgreSQL en `.env`.
5. Ejecutar migraciones.

```bash
php artisan migrate
```

6. Ejecutar seeders.

```bash
php artisan db:seed
```

7. Levantar la app.

```bash
php artisan serve
```

## Flujo recomendado

1. Login
2. Dashboard admin
3. Configurar academia
4. Crear estilos
5. Crear profesores
6. Crear horarios
7. Ver datos reflejados en la web pública

## Rutas públicas

- /
- /horarios
- /estilos
- /profesores
- /contacto

## Rutas admin

- /admin
- /admin/academia
- /admin/estilos
- /admin/profesores
- /admin/horarios
