<?php
define("SERVIDOR","localhost");
define("USUARIO","root");
define("PASSWORD","");
define("BD","db_docbrown");
$servidor = "mysql: host=".SERVIDOR."; dbname=".BD;
try{
    $pdo= new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
    //echo "<script>alert('Conexion establecida')</script>";
}catch(PDOException $e){
    //Exception coge todos los errores pero PDOException para errores de PDO
    echo $e->getMessage();
}