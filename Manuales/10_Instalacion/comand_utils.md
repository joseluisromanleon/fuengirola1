# Limpieza de caches:
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Reset de tablas y seeders
php artisan migrate:fresh --seed

# crear mmigration y seeder
php artisan make:migration nombre_de_la_migration
php artisan make:seeder nombre_del_seeder

