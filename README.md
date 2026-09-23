## Comandos básicos de CodeIgniter 4

# Generar piezas


php spark make:migration CreateProductos

php spark make:seeder ProductosSeeder

php spark make:model ProductoModel

php spark make:controller Productos


# Base de datos


php spark migrate           # ejecuta todas las migraciones pendientes

php spark migrate:refresh   # baja y vuelve a subir todo (útil en prácticas)

php spark db:seed ProductosSeeder

Servidor de desarrollo



# Servidor de desarrollo  
php spark serve