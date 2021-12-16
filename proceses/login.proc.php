<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    session_start();
    require_once '../services/connection.php';
    $email=$_POST['email'];
    $password=$_POST['password'];
    $usuario = $pdo->prepare("SELECT * FROM tbl_usuario WHERE correo_u='{$email}' AND contraseña_u=MD5('{$password}') AND disponibilidad_u='si';");
    try {
        $pdo->beginTransaction();
        $usuario->execute();
        $comprobacion=$usuario->fetchAll(PDO::FETCH_ASSOC);
        if (empty($comprobacion)) {
            header("location: ../view/login.php?error=1");
        }else {
            foreach ($comprobacion as $row) {
                $_SESSION['nombre']=$row['nombre_u'];
                $_SESSION['id_u']=$row['id_u'];
                if($row['tipo_u']=='administrador'){
                    $_SESSION['tipo_u']=$row['tipo_u'];
                }
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
    header("location: ../view/login.php");
}