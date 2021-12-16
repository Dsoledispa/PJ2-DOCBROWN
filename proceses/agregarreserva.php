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
    $id_m=$_POST['id_m'];
    $reserva=$pdo->prepare("INSERT INTO tbl_reserva (nombre_r, apellido_r, telefono_r, fecha_r, num_personas_r, hora_inicio_r, id_u) VALUES
    ('{$nombre_r}', '{$apellido_r}', {$telefono_r}, '{$fecha_r}', {$num_personas_r}, '{$hora_inicio_r}', {$id_u});");
    $asignarmesa=$pdo->prepare("INSERT INTO `tbl_mesa/reserva` (id_mesa, id_reserva) VALUES (?, ?);");
    $disponibilidad=$pdo->prepare("UPDATE tbl_mesa SET disponibilidad_m = 'no' WHERE id_m = ?;");
    try {
        $pdo->beginTransaction();
        $reserva->execute();
        $id_reserva = $pdo->lastInsertId();
        $asignarmesa->bindParam(2, $id_reserva);
        foreach ($id_m as $id_mesa) {
            $asignarmesa->bindParam(1, $id_mesa);
            $asignarmesa->execute();
            $disponibilidad->bindParam(1, $id_mesa);
            $disponibilidad->execute();
        }
        if (empty($reserva ) && empty($asignarmesa)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header("location:../view/zona.reserva.php");
        }
        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
}