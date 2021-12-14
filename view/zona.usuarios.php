<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Zona para usuarios</title>
</head>
<body>
    <!--Header-->
        <ul class="padding-lat">
            <li><a><?php echo $_SESSION["nombre"];?></a></li>
            <li class="right">
                <a href="../proceses/logout.proc.php">Logout</a>
            </li>
        </ul>
    <!--Header-->
    <br><br><br><br>
    <button type="submit"><a type='button' href='zona.sala.php'>Volver a salas</a></button>
    <button type="submit"><a type='button' href='zona.reserva.php'>Reservas</a></button>
    <button type="submit"><a type='button' href='zona.recursos.php'>Recursos</a></button>
    <button type="submit"><a type='button' href='form.usuarios.php'>Crear usuario</a></button>
    <?php
    $usuarios=$pdo->prepare("SELECT * FROM tbl_usuario");
    try{
        $pdo->beginTransaction();
        $usuarios->execute();
        echo  "<div>";
        echo  "<table>";
        echo  "<tr>";
        echo  "<th class='blue'>Nombre</th>";
        echo  "<th class='blue'>Apellido</th>";
        echo  "<th class='blue'>Correo</th>";
        echo  "<th class='blue'>Tipo</th>";
        echo  "<th class='blue'>Disponibilidad</th>";
        echo  "</tr>";
        foreach ($usuarios as $usuario) {
            //Ponemos primero la localización
            echo  "<tr>";
                echo "<td class='gris'>{$usuario['nombre_u']}</td>";
                echo "<td class='gris'>{$usuario['apellido_u']}</td>";
                echo "<td class='gris'>{$usuario['correo_u']}</td>";
                echo "<td class='gris'>{$usuario['tipo_u']}</td>";
                if ($usuario['disponibilidad_u']=="si") {
                    echo "<td class='gris'><i class='fas fa-check green'></i></td>";
                }else{
                    echo "<td class='gris'><i class='fas fa-times red'></i></td>";
                }
                echo "<td><button type='submit'><a type='button' href='mod.usuarios.php?id_u={$usuario['id_u']}'>Modificar usuario</a></button></td>";
                echo "<td><button type='submit'><a type='button' href='../proceses/eliminarusuario.php?id_u={$usuario['id_u']}'>Eliminar usuario</a></button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Fallo: " . $e->getMessage();
    }
    ?>
</body>
</html>
<?php
}
?>