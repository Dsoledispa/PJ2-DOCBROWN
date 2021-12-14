<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $id_u=$_GET['id_u'];
    $eliminarusuario=$pdo->prepare("DELETE FROM tbl_usuario WHERE id_u = {$id_u}");
    try{
        $pdo->beginTransaction();
        $eliminarusuario->execute();
        if (empty($eliminarusuario)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.usuarios.php');
        }
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Fallo: " . $e->getMessage();
    }
}