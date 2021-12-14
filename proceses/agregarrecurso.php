<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
    $silla_m=$_POST["silla_m"];
    $disponibilidad_m=$_POST["disponibilidad_m"];
    $id_s=$_POST["id_s"];
    $mesas=$pdo->prepare("INSERT INTO tbl_mesa (silla_m, disponibilidad_m, id_s) VALUES
    ('{$silla_m}','{$disponibilidad_m}',{$id_s});");
    try {
        $pdo->beginTransaction();
        $mesas->execute();
        if (empty($mesas)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.recursos.php');
        }
        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
}