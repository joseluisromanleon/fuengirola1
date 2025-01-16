Los Roles no se trataran con spatie/laravel-permision
al usar Jetstream  estos se tratan de forma diferente en el archivo de providers:
JetstreamServiceProvider.php

dejando la programacion mas limpia y sin la tabla Roles sino con una columna role en la tabla pivote:
team_user

