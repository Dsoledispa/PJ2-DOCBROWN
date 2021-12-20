# Reserva-Mesa-Restaurante-DOC-BROWN

Página web que sirve para reservar mesas de un restaurante y tener un registro de estos

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._


### Pre-requisitos 📋

Antes de nada hay que descargar e instalar los programas Xampp y Visual Studio Code. Respecto a Xampp hay que descargarse la version que coincida con el sistema operativo que tienes.
Links en Construido con 🛠️ 

### Instalación 🔧

Una vez hecho el paso anterior hay que crear una carpeta llamada www (simplemente por tenerlo organizado) dentro de /xampp/htdocs/ .
Se descomprime el archivo y se copia en la carpeta del proyecto a este ultimo directorio.
Ejecutamos XAMPP control panel e iniciamos los modulos de apache (servidor web) y MYSQL (gestion de base de datos).
Dentro del navegador web preferido escribimos en la barra de direccion web localhost, si ejecutamos el proyecto desde la propia maquina o la direccion ip del servidor web que tengas.
Una vez dentro de la pagina web, arriba a la derecha clicamos a phpMyAdmin para acceder a este servicio de Xampp, donde pondremos la base de datos del proyecto.
Ahora procederemos a importar la base de datos, desde el menu importar ubicado en la barra superior derecha. Seleccionamos el archivo .sql ubicado en la carpeta db dentro del proyecto, le damos a continuar y se guardara. La base de datos esta lista.

A continuacion usaremos el programa Visual Studio Code para abrir el proyecto donde crearemos un archivo llamado config.php (importante escribirlo exactamente), dentro de la carpeta services, y copiaremos las lineas de codigo a continuación.

```
define("SERVIDOR","conexion");
define("USUARIO","usuario");
define("PASSWORD","contraseña");
define("BD","nombre base de datos");
```

Ahora, dentro de las lineas que empieza con define, substituimos los datos de "conexion", "usuario", "contraseña" y "nombre base de datos" por los propios. Si la base de datos esta instalada en el mismo equipo en donde esta el proyecto, la "conexion" sera "localhost", el "usuario" sera "root", no tendra "contraseña" y la base de datos sera "2122_diegosoledispa".

El proyecto ya esta listo. Se accede desde la barra de direccion web escribiendo lo siguiente (localhost/www/DOC-BROWN21) donde accederemos al login del programa. Usaremos los usuarios que estan en la base de datos (concretamente dentro de tbl_usuario).
Se recomienta tener acceso a internet en todo momento para poder visualizar correctamente el proyecto.


## Despliegue 📦

Si se desea usar un servicio de hosting, a continuacion de dejamos un ejemplo con el servicio gratuito 000webhost.
Links en Construido con 🛠️ 
Creamos una cuenta con la direccion de correo que queramos y y confirmamos el correo. Ahora seguimos las instrucciones del hosting (queremos subir nuestra pagina web).
Dentro de la zona files subimos el proyecto, haciendo un copia y pega directamente los archivos y carpetas del proyecto, no el proyecto en si dentro de public.html.
Volvemos al inicio del hosting, y vamos a manage website. Accedemos a tools y a database manager. Creamos la base de datos, y una vez creada con el phpmyadmin del hosting pegamos las tablas de nuestra base de datos. Ahora accedemos a file manager otra vez, dentro de public, services, abrimos connection.php. Cambiamos los datos de la base de datos por los del hosting (los datos estan en el database manager.) La pagina web estara lista para ser usada.

## Construido con 🛠️

* [Xampp](https://www.apachefriends.org/) - El paquete de software usado
* [Visual Studio Code](https://code.visualstudio.com/) - Editor de codigo

## Contribuyendo 🖇️

Por favor lee el [CONTRIBUTING.md](https://gist.github.com/villanuevand/xxxxxx) para detalles de nuestro código de conducta, y el proceso para enviarnos pull requests.

## Wiki 📖

Puedes encontrar mucho más de cómo utilizar este proyecto en nuestra [Wiki](https://github.com/tu/proyecto/wiki)

## Versionado 📌

Para todas las versiones disponibles, mira la siguiente pagina(https://github.com/Dsoledispa/PJ2-DOCBROWN/tags).

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Xavier Gómez**  - [Xavier Gómez](https://https://github.com/xaviermireia1)
* **Diego Soledispa** - [Diego Soledispa](https://github.com/Dsoledispa)


También puedes mirar la lista de todos los [contribuyentes](https://github.com/Dsoledispa/PJ2-DOCBROWN/contributors) quíenes han participado en este proyecto. 
## Licencia 📄

Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo [LICENSE.md](LICENSE.md) para detalles

## Expresiones de Gratitud 🎁

* Invita una cerveza 🍺 o un café ☕ a alguien del equipo si te ha sido util este proyecto. 
* Gracias por su atencion 🤓.
