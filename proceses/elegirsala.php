<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.html");
}else {
    $_SESSION['id_s']=$_GET['id_s'];
    header("location:../view/zona.mesa.php");
}
?>