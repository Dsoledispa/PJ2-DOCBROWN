<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Historial</title>
    </head>
    <body>
        <ul class="padding-lat">
            <li><a><?php echo $_SESSION["nombre"];?></a></li>
            <li class="right">
                <a href="../proceses/logout.proc.php">Logout</a>
            </li>
        </ul>
        <?php
            $historial=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
            LEFT JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_reserva
            LEFT JOIN tbl_mesa m on mr.id_mesa=m.id_m
            LEFT JOIN tbl_usuario u on r.id_u=u.id_u
            LEFT JOIN tbl_sala s on m.id_s=s.id_s
            ORDER BY fecha_r DESC , hora_inicio_r DESC");
                    try{
                        $pdo->beginTransaction();
                        $historial->execute(); 
                        echo  "<div class='row padding-top-less padding-lat'>";
                        echo  "<table>";
                        echo  "<tr>";
                        echo  "<th class='blue'>Nº Reserva</th>";
                        echo  "<th class='blue'>Cantidad mesas</th>";
                        echo  "<th class='blue'>Sala</th>";
                        echo  "<th class='blue'>Nombre</th>";
                        echo  "<th class='blue'>Apellido</th>";
                        echo  "<th class='blue'>Telefono</th>";
                        echo  "<th class='blue'>Num Personas</th>";
                        echo  "<th class='blue'>Fecha</th>";
                        echo  "<th class='blue'>Hora inicio de reserva</th>";
                        echo  "<th class='blue'>Hora final de reserva</th>";
                        echo  "<th class='blue'>Camarero</th>";
                        echo  "</tr>";   
                        foreach ($historial as $row) {
                            echo  "<tr>";
                            echo "<td class='gris'>{$row['id_r']}</td>";
                            echo "<td class='gris'>ahora nada</td>";
                            echo "<td class='gris'>{$row['nombre_s']}</td>";
                            echo "<td class='gris'>{$row['nombre_r']}</td>";
                            echo "<td class='gris'>{$row['apellido_r']}</td>";
                            echo "<td class='gris'>{$row['telefono_r']}</td>";
                            echo "<td class='gris'>{$row['num_personas_r']}</td>";
                            echo "<td class='gris'>{$row['fecha_r']}</td>";
                            echo "<td class='gris'>{$row['hora_inicio_r']}</td>";
                            echo "<td class='gris'>{$row['hora_final_r']}</td>";
                            echo "<td class='gris'>{$row['nombre_u']}</td>";
                            echo "<td><button type='submit'><a type='button'>Asignar mesas</a></button></td>";
                            echo  "</tr>";
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