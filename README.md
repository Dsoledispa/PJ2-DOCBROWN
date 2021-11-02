# DOC-BROWN21
## Conexión a base de datos
### Necesitas crear el archivo connection.php y añadir las sentencias de la siguiente manera como demostraré a continuación.
```
<?php
define("SERVIDOR","conexion");
define("USUARIO","usuario");
define("PASSWORD","contraseña");
define("BD","nombre bd");
$servidor = "mysql: host=".SERVIDOR."; dbname=".BD;
try{
    $pdo= new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
    //echo "<script>alert('Conexion establecida')</script>";
}catch(PDOException $e){
    //Exception coge todos los errores pero PDOException para errores de PDO
    echo $e->getMessage();
}
```