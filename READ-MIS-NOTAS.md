
Build Status Total Downloads Latest Stable Version License

LeaveMS
LeaveMS es un sistema de gestión de permisos basado en la web y basado 
en el framework Laravel (v8) donde podemos rastrear las solicitudes de permisos
de los empleados. En este sistema, los empleados pueden solicitar un permiso y 
el gerentes de línea procesará la solicitud. Cuando se hace una nueva solicitud de permiso,
los gerentes de línea serán notificados por un push y una notificación 
por correo electrónico. De manera similar, si la solicitud es aprobada, 
tanto el aplicador como los gerentes de nóminas recibirán una notificación 
por correo y push. Y si la solicitud es rechazada, 
solo el solicitante recibirá la notificación.

Framework
Laravel (version 8)
Install
git clone https://github.com/sheikhRakib/LeaveMS.git
cd LeaveMS

*** ACCIONES POR CONSOLA ***

composer update
************************************
// instalo el paquete para roles
composer require spatie/laravel-permission  
// Publicar el archivo de configuración: 
// Esto genera el archivo de configuración permission.php en la carpeta config 
// de tu proyecto, lo cual te permite personalizar algunos aspectos.
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
// arrancar docker desctop y verificar 
docker info
// Arrancar Servidor de correo
docker-compose up -d mailhog
// 
************************************
bash
Copiar código
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
php artisan queue:work

*** Note ***
Only Line manaagers and Admins can process an application. 
Payroll managers will only notified if any application is approved.
To get full functionality, a mailer service needs to be set-up.


*** Default and demo users ***
email	            password
admin@mail.com	    12345
payroll@mail.com	12345
line@mail.com	    12345
user@mail.com	    12345

*** License *** 
The Laravel framework is open-sourced software licensed under the MIT license.
