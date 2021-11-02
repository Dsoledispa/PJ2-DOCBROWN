<?php
// 1. Conexión con la base de datos	
include '../services/connection.php';

$email=$_REQUEST['email'];
$psswd=$_REQUEST['password'];

$email=mysqli_real_escape_string($conn,$email);

$user = mysqli_query($conn,"SELECT * FROM tbl_usuario WHERE email='$email' and contraseña=MD5('{$psswd}')");

if (mysqli_num_rows($user) == 1) {
    // coincidencia de credenciales
    session_start();
    $_SESSION['email']=$email;
    if (!empty($user) && mysqli_num_rows($user) > 0) {
            while ($row = mysqli_fetch_array($user)) {
            $_SESSION['name']=$row['Name'];
            }
        }
    header("location: ../view/zona.admin.php");
} else {
    // usuario o contraseña erróneos
    header("location: ../view/login.html");
}

mysqli_free_result($user);
