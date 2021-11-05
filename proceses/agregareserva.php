<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.html");
}else {
    $id_mesa=$_GET['id'];
    $agregar=$pdo->prepare("INSERT INTO tbl_historial (id_mesa,dia_historial,inicio_historial) VALUES ({$id_mesa},curdate(),curtime())");
    $disponibilidad=$pdo->prepare("UPDATE tbl_mesa SET disponibilidad='no' WHERE id_mesa={$id_mesa}");
    try {
        $agregar->execute();
        $disponibilidad->execute();
        if (empty($agregar) && empty($disponibilidad)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.admin.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}