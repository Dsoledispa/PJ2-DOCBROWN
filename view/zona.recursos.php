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
        <div class="row padding-top padding-lat">
            <div class="fondo">
            <button type="submit"><a type='button' href='zona.sala.php'>Volver a salas</a></button>
            <button type="submit"><a type='button' href='zona.reserva.php'>Reservas</a></button>
            <?php
            if (!isset($_SESSION['tipo_u']) || $_SESSION['tipo_u']=="") {
            }else {
                echo "<button type='submit'><a type='button' href='zona.usuarios.php'>Usuarios</a></button>";
            }
            ?>
            <button type="submit"><a type='button' href='zona.historial.php'>Historial Reservas</a></button>
            <button type="submit"><a type='button' href='form.recursos.php'>Crear mesas</a></button>
                <form action="zona.recursos.php" method="post">
                    <div class="column-2">
                        <label for="sala">Salas</label><br>   
                        <select name="sala" class="casilla">
                        <option value="" default>Todas las salas</option>
                                <?php
                                // Mostrar todas las localizaciones que existen
                                    $option=$pdo->prepare("SELECT * FROM tbl_sala");
                                    try{
                                        $pdo->beginTransaction();
                                        $option->execute();
                                        foreach ($option as $row) {
                                            echo "<option value='{$row['nombre_s']}'>{$row['nombre_s']}</option>";
                                        }
                                        $pdo->commit();
                                    } catch (Exception $e) {
                                        $pdo->rollBack();
                                        echo "Fallo: " . $e->getMessage();
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="column-2">
                        <label for="numsilla">Num sillas</label><br>
                        <input type="text" placeholder="Introduce el num silla" name="numsilla" class="casilla">
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
    <?php
    //Con filtro
    if (isset($_POST['filtrar'])) {
        $nombre_s=$_POST['sala'];
        $silla_m=$_POST['numsilla'];
        $disponibilidad_m=$_POST['disponibilidad'];
        $data = array();
        if (!empty($nombre_s)){
            $data[]="nombre_s = '{$nombre_s}'";
        }
        if (!empty($silla_m)){
            $data[]="silla_m = {$silla_m}";
        }
        if (!empty($disponibilidad_m)){
            $data[]="disponibilidad_m = '{$disponibilidad_m}'";
        }
        $anadir= implode(' AND ',$data);
        if (!empty($data)){
            $recursos=$pdo->prepare("SELECT m.*, s.*,r.activa_r FROM tbl_mesa m
            LEFT JOIN tbl_sala s on m.id_s=s.id_s
            LEFT JOIN `tbl_mesa/reserva` mr on m.id_m=mr.id_mesa
            LEFT JOIN tbl_reserva r on mr.id_reserva=r.id_r
            WHERE {$anadir};");
        }else{
            $recursos=$pdo->prepare("SELECT m.*, s.*,r.activa_r FROM tbl_mesa m
            LEFT JOIN tbl_sala s on m.id_s=s.id_s
            LEFT JOIN `tbl_mesa/reserva` mr on m.id_m=mr.id_mesa
            LEFT JOIN tbl_reserva r on mr.id_reserva=r.id_r;");
        }
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
                    if ($recurso['activa_r']=="no" || $recurso['activa_r']==null) {
                        echo "<td><button type='submit'><a type='button' href='mod.recursos.php?id_m={$recurso['id_m']}'>Modificar recurso</a></button></td>";
                        echo "<td><button type='submit'><a type='button' href='../proceses/eliminarrecurso.php?id_m={$recurso['id_m']}'>Eliminar recurso</a></button></td>";
                    }else{
                        echo "<td><button type='submit' class='red'>Hay una reserva activa</button></td>";
                    }
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }else{
        //Sin filtro
        $recursos=$pdo->prepare("SELECT m.*, s.*,r.activa_r FROM tbl_mesa m
        LEFT JOIN tbl_sala s on m.id_s=s.id_s
        LEFT JOIN `tbl_mesa/reserva` mr on m.id_m=mr.id_mesa
        LEFT JOIN tbl_reserva r on mr.id_reserva=r.id_r;");
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
                    if ($recurso['activa_r']=="no" || $recurso['activa_r']==null) {
                        echo "<td><button type='submit'><a type='button' href='mod.recursos.php?id_m={$recurso['id_m']}'>Modificar recurso</a></button></td>";
                        echo "<td><button type='submit'><a type='button' href='../proceses/eliminarrecurso.php?id_m={$recurso['id_m']}'>Eliminar recurso</a></button></td>";
                    }else{
                        echo "<td><button type='submit' class='red'>Hay una reserva activa</button></td>";
                    }
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
<?php
}
?>