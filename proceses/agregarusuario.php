<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.html");
}else {
    $nombre_u=$_POST["nombre_u"];
    $apellido_u=$_POST["apellido_u"];
    $correo_u=$_POST["correo_u"];
    $contraseña_u=$_POST["contraseña_u"];
    $tipo_u=$_POST["tipo_u"];
    $disponibilidad_u=$_POST["disponibilidad_u"];
    $voluntarioevento=$pdo->prepare("INSERT INTO tbl_evento_voluntario (id_evento, id_voluntario) VALUES ({$id_evento}, ?);");
    try {
        $pdo->beginTransaction();
        $agregarvoluntario->execute();
        if (empty($agregarvoluntario)) {
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