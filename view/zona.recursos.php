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
    <title>Zona para gestionar recursos</title>
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
    <?php print_r ($_SESSION); ?>
    <button type="submit"><a type='button' href='zona.sala.php'>Volver a salas</a></button>
    <button type="submit"><a type='button' href='zona.reserva.php'>Reservas</a></button>
    <button type="submit"><a type='button' href='zona.usuarios.php'>Usuarios</a></button>
    <button type="submit"><a type='button' href='form.recursos.php'>Crear mesas</a></button>
    <?php
    $recursos=$pdo->prepare("SELECT m.*, s.* FROM tbl_mesa m
    INNER JOIN tbl_sala s on m.id_s=s.id_s");
    try{
        $pdo->beginTransaction();
        $recursos->execute();
        echo  "<div>";
        echo  "<table>";
        echo  "<tr>";
        echo  "<th class='blue'>Sala</th>";
        echo  "<th class='blue'>ID mesa</th>";
        echo  "<th class='blue'>Numero sillas</th>";
        echo  "<th class='blue'>Disponibilidad</th>";
        echo  "</tr>";
        foreach ($recursos as $recurso) {
            //Ponemos primero la localización
            echo  "<tr>";
                echo "<td class='gris'>{$recurso['nombre_s']}</td>";
                echo "<td class='gris'>{$recurso['id_m']}</td>";
                echo "<td class='gris'>{$recurso['silla_m']}</td>";
                if ($recurso['disponibilidad_m']=="si") {
                    echo "<td class='gris'><i class='fas fa-check green'></i></td>";
                }else{
                    echo "<td class='gris'><i class='fas fa-times red'></i></td>";
                }
                echo "<td><button type='submit'><a type='button' href='mod.recursos.php?id_m={$recurso['id_m']}'>Modificar recurso</a></button></td>";
                echo "<td><button type='submit'><a type='button' href='../proceses/eliminarrecurso.php?id_m={$recurso['id_m']}'>Eliminar recurso</a></button></td>";
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