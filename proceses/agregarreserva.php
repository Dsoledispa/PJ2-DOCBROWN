<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $id_u=$_SESSION['id_u'];
    $nombre_r=$_POST["nombre_r"];
    $apellido_r=$_POST["apellido_r"];
    $telefono_r=$_POST["telefono_r"];
    $fecha_r=$_POST["fecha_r"];
    $num_personas_r=$_POST["num_personas_r"];
    $hora_inicio_r=$_POST["hora_inicio_r"];
    $id_s=$_POST["id_s"];
    $reserva=$pdo->prepare("INSERT INTO tbl_reserva (nombre_r, apellido_r, telefono_r, fecha_r, num_personas_r, hora_inicio_r, id_u) VALUES
    ('{$nombre_r}', '{$apellido_r}', {$telefono_r}, '{$fecha_r}', {$num_personas_r}, '{$hora_inicio_r}', {$id_u});");
    try {
        $pdo->beginTransaction();
        $reserva->execute();
        if (empty($reserva)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header("location:../view/select.mesa.php?id_s={$id_s}");
        }
        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
}