<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.html");
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
        <title>Administracion</title>
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
        <!--nav-->
        <div class="row padding-top padding-lat">
            <div class="fondo">
                <button type="submit"><a type='button' href='zona.sala.php'>Salas</a></button>
                <button type="submit"><a type='button' href='zona.reserva.php'>Reservas</a></button>
                <button type="submit"><a type='button' href='zona.usuarios.php'>Usuarios</a></button>
                <button type="submit"><a type='button' href='zona.recursos.php'>Recursos</a></button>
                <form action="zona.mesa.php" method="post">
                    <div class="column-2">
                        <label for="silla">Personas</label><br>
                        <input type="number" placeholder="Introduce cantidad de personas..." name="silla" class="casilla">
                    </div>
                    <div class="column-2">
                        <label for="disponibilidad">Disponible</label><br>
                        <select name="disponibilidad" class="casilla">
                            <option value="" default>Si/No</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="column-1">
                        <input type="submit" value="FILTRAR" name="filtrar" class="filtrar">
                    </div>
                </form>
            </div>
        </div><br>
        <!--nav-->
        <?php
            //Con filtro
            if (isset($_POST['filtrar'])) {
                $personas=$_POST['silla'];
                $disponibilidad=$_POST['disponibilidad'];
                $data = array();
                if (!empty($personas)){
                    $data[]="silla_m = '{$personas}'";
                }
                if (!empty($disponibilidad)){
                    $data[]="disponibilidad_m = '{$disponibilidad}'";
                }
                $anadir= implode(',',$data);
                $filtro=$pdo->prepare("SELECT * FROM tbl_mesa WHERE id_s='{$_SESSION['id_s']}' AND {$anadir};");
                try {
                    $pdo->beginTransaction();
                    $filtro->execute();
                    echo  "<div class='row padding-top-less padding-lat'>";
                    echo  "<table>";
                    echo  "<tr>";
                    echo  "<th class='blue'>Nº de Mesa</th>";
                    echo  "<th class='blue'>nº Personas</th>";
                    echo  "<th class='blue'>Disponibilidad</th>";
                    echo  "</tr>";
                    foreach ($filtro as $mesa) {
                        //Ponemos primero la localización
                        echo  "<tr>";
                            echo "<td class='gris'>{$mesa['id_m']}</td>";
                            echo "<td class='gris'>{$mesa['silla_m']}</td>";
                            if ($mesa['disponibilidad_m']=="si") {
                                echo "<td class='gris'><i class='fas fa-check green'></i></td>";
                                echo "<td><button type='submit'><a type='button' href='../proceses/agregareserva.php?id_m={$mesa['id_m']}'>Añadir reserva</a></button></td>";
                            }else{
                                echo "<td class='gris'><i class='fas fa-times red'></i></td>";
                                echo "<td><button type='submit'><a type='button' href='../proceses/eliminareserva.php?id_m={$mesa['id_m']}'>Quitar reserva</a></button></td>";
                            }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                    $pdo->commit();
                } catch(PDOException $e) {
                    $pdo->rollback();
                    print "Error!: " . $e->getMessage() . "</br>";
                }
                //Sin filtro
            }else {
                //Cogemos las mesas y sitios con las localizaciones correspondientes
                $mesas=$pdo->prepare("SELECT * FROM tbl_mesa WHERE id_s='{$_SESSION['id_s']}';");
                try {
                    $pdo->beginTransaction();
                    $mesas->execute();
                    echo  "<div class='row padding-top-less padding-lat'>";
                    echo  "<table>";
                    echo  "<tr>";
                    echo  "<th class='blue'>Nº de Mesa</th>";
                    echo  "<th class='blue'>nº Personas</th>";
                    echo  "<th class='blue'>Disponibilidad</th>";
                    echo  "</tr>";
                    foreach ($mesas as $mesa) {
                        //Ponemos primero la localización
                        echo  "<tr>";
                            echo "<td class='gris'>{$mesa['id_m']}</td>";
                            echo "<td class='gris'>{$mesa['silla_m']}</td>";
                            if ($mesa['disponibilidad_m']=="si") {
                                echo "<td class='gris'><i class='fas fa-check green'></i></td>";
                                echo "<td><button type='submit'><a type='button' href='../proceses/agregareserva.php?id_m={$mesa['id_m']}'>Añadir reserva</a></button></td>";
                            }else{
                                echo "<td class='gris'><i class='fas fa-times red'></i></td>";
                                echo "<td><button type='submit'><a type='button' href='../proceses/eliminareserva.php?id_m={$mesa['id_m']}'>Quitar reserva</a></button></td>";
                            }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                    $pdo->commit();
                } catch(PDOException $e) {
                    $pdo->rollback();
                    print "Error!: " . $e->getMessage() . "</br>";
                }
            }
        ?>
    </body>
    </html>
<?php
}
?>