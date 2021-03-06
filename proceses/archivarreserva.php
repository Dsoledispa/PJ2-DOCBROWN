<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $id_r=$_GET['id_r'];
    $hora_cierre_reserva=$pdo->prepare("UPDATE tbl_reserva SET hora_cierre_r=curtime() WHERE id_r={$id_r} and isnull(hora_cierre_r)");
    $desactivarreserva=$pdo->prepare("UPDATE tbl_reserva SET activa_r = 'no' WHERE id_r = {$id_r};");
    $idmesas=$pdo->prepare("SELECT * FROM `tbl_mesa/reserva` WHERE id_reserva={$id_r};");
    $disponibilidad=$pdo->prepare("UPDATE tbl_mesa SET disponibilidad_m='si' WHERE id_m=?;");
    try {
        $hora_cierre_reserva->execute();
        $desactivarreserva->execute();
        $idmesas->execute();
        foreach ($idmesas as $id_mesa) {
            $disponibilidad->bindParam(1, $id_mesa['id_mesa']);
            $disponibilidad->execute();
        }
        if (empty($hora_cierre_reserva) && empty($desactivarreserva) && empty($idmesas) && empty($disponibilidad)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.reserva.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}