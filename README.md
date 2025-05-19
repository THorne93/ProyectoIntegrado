# ProyectoIntegrado

# <img src="https://flagcdn.com/w40/es.png" width="30" alt="Spain flag"> 

Para que la aplicación funcione correctamente, deben estar instalados los siguientes servicios:

<ul>
    <li>Php</li>
    <li>Composer</li>
    <li>Python (with Tesseract - https://github.com/tesseract-ocr/tesseract)</li>
</ul>

Para que la base de datos se cree correctamente, necesitas editar el archivo .env y asegurarte de que los puertos están dirigidos a tu servidor de base de datos. Asegúrate también de añadir un usuario y una contraseña.

Una vez instalado, todo lo demás que se necesita se proporciona dentro de la carpeta del proyecto. El siguiente paso es ejecutar los siguientes comandos a través del terminal (dentro de la carpeta de proyectos):

<ul>
<li>“composer install”</li>
<li>“npm i && npm build”</li>
<li>'pip install -r requirements.txt'  </li>
<li>‘php artisan migrate’</li>
<li>‘php artisan db:seed’</li>
<li>‘composer run dev’</li>
</ul>

Con estos comandos, la aplicación ya estará funcionando. Habrá un número de usuarios generado aleatoriamente, y también una cuenta de administrador con la que se puede acceder usando admin@admin.com con la contraseña '1234'. Se recomienda encarecidamente cambiar las contraseñas cuando o si se ejecuta esta aplicación en vivo.

#  <img src="https://flagcdn.com/w40/gb.png" width="30" alt="UK flag">

For the application to fully run correctly, the following services must be installed.:

<ul>
    <li>Php</li>
    <li>Composer</li>
    <li>Python (with Tesseract - https://github.com/tesseract-ocr/tesseract)</li>
</ul>

Once installed, everything else that is needed is provided within the project folder. The next step is to run the following commands via the terminal (inside the projects folder):

<ul>
<li>“composer install”</li>
<li>“npm i && npm build”</li>
<li>'pip install -r requirements.txt'  </li>
<li>‘php artisan migrate’</li>
<li>‘php artisan db:seed’</li>
<li>‘composer run dev’</li>
</ul>

With these commands, the application will now be running. There will be a number of users generated at random, and also an admin account with which you can login in using admin@admin.com with the password ‘1234’. It is strongly recommended to change passwords when or if running this application live. 

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
