<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
    $id_m=$_POST['id_m'];
    print_r($id_m);
}