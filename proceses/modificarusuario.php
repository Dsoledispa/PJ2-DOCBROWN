<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $nombre_u=$_POST["nombre_u"];
    $apellido_u=$_POST["apellido_u"];
    $correo_u=$_POST["correo_u"];
    $password_u=$_POST["contraseña_u"];
    if (!empty($password_u)){
        $contraseña_u=md5($_POST["contraseña_u"]);
    }
    $tipo_u=$_POST["tipo_u"];
    $disponibilidad_u=$_POST["disponibilidad_u"];
    $id_u=$_POST["id_u"];
    $data = array();
    if (!empty($nombre_u)){
        $data[]="nombre_u = '{$nombre_u}'";
    }
    if (!empty($apellido_u)){
        $data[]="apellido_u = '{$apellido_u}'";
    }
    if (!empty($correo_u)){
        $data[]="correo_u = '{$correo_u}'";
    }
    if (!empty($contraseña_u)){
        $data[]="contraseña_u = '{$contraseña_u}'";
    }
    if (!empty($tipo_u)){
        $data[]="tipo_u = '{$tipo_u}'";
    }
    if (!empty($disponibilidad_u)){
        $data[]="disponibilidad_u = '{$disponibilidad_u}'";
    }
    $anadir= implode(',',$data);
    $modificarusuario=$pdo->prepare("UPDATE tbl_usuario SET {$anadir} WHERE id_u = {$id_u};");
    try {
        $pdo->beginTransaction();
        $modificarusuario->execute();
        if (empty($modificarusuario)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.usuarios.php');
        }
        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
}