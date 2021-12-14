<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $silla_m=$_POST["silla_m"];
    $disponibilidad_m=$_POST["disponibilidad_m"];
    $id_s=$_POST["id_s"];
    $id_m=$_POST["id_m"];
    $data = array();
    if (!empty($silla_m)){
        $data[]="silla_m = '{$silla_m}'";
    }
    if (!empty($disponibilidad_m)){
        $data[]="disponibilidad_m = '{$disponibilidad_m}'";
    }
    if (!empty($id_s)){
        $data[]="id_s = '{$id_s}'";
    }
    $anadir= implode(',',$data);
    $modificarmesa=$pdo->prepare("UPDATE tbl_mesa SET {$anadir} WHERE id_m = {$id_m};");
    try {
        $pdo->beginTransaction();
        $modificarmesa->execute();
        if (empty($modificarmesa)) {
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