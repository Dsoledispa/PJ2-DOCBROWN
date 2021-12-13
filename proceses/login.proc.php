<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    session_start();
    require_once '../services/connection.php';
    $email=$_POST['email'];
    $password=$_POST['password'];
    $usuario = $pdo->prepare("SELECT * FROM tbl_usuario WHERE correo_u='{$email}' and contraseña_u=MD5('{$password}')");
    try {
        $pdo->beginTransaction();
        $usuario->execute();
        $comprobacion=$usuario->fetchAll(PDO::FETCH_ASSOC);
        if (empty($comprobacion)) {
            header("location: ../view/login.html");
        }else {
            foreach ($comprobacion as $row) {
                $_SESSION['nombre']=$row['nombre_u'];
             }   
            $_SESSION['email']=$email;
            header("location:../view/zona.sala.php");
        }
        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
}else{
    header("location: ../view/login.html");
}