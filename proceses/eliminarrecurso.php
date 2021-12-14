<?php
session_start();
require_once '../services/connection.php';
if ($_SESSION['email']=="") {
    header("location:../view/login.php");
}else {
    $id_m=$_GET['id_m'];
    $eliminarmesa=$pdo->prepare("DELETE FROM tbl_mesa WHERE id_m = {$id_m}");
    try{
        $pdo->beginTransaction();
        $eliminarmesa->execute();
        if (empty($eliminarmesa)) {
            echo "No se ha ejecutado bien la sentencia";
        }else {
            header('location:../view/zona.recursos.php');
        }
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Fallo: " . $e->getMessage();
    }
}