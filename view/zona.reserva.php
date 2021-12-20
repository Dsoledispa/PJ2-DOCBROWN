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
        <div class="row padding-top padding-lat">
            <div class="fondo">
            <button type="submit"><a type='button' href='zona.sala.php'>Volver a salas</a></button>
            <?php
            if (!isset($_SESSION['tipo_u']) || $_SESSION['tipo_u']=="") {
            }else {
                echo "<button type='submit'><a type='button' href='zona.usuarios.php'>Usuarios</a></button>";
            }
            ?>
            <button type="submit"><a type='button' href='zona.recursos.php'>Recursos</a></button>
            <button type="submit"><a type='button' href='zona.historial.php'>Historial Reservas</a></button>
                <form action="zona.reserva.php" method="post">
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
                        <label for="numpersonas">Numero personas</label><br>
                        <input type="number" name="numpersonas" class="casilla">
                    </div>
                    <div class="column-2">
                        <label for="camarero">Camarero</label><br>
                        <input type="text" name="camarero" class="casilla">
                    </div>
                    <div class="column-2">
                        <label for="fecha">Fecha</label><br>
                        <input type="date" min="<?php echo date("Y-m-d"); ?>" name="fecha" class="casilla">
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
            $sala=$_POST['sala'];
            $numpersonas=$_POST['numpersonas'];
            $camarero=$_POST['camarero'];
            $fecha=$_POST['fecha'];
            $data = array();
            if (!empty($sala)){
                $data[]="nombre_s = '{$sala}'";
            }
            if (!empty($numpersonas)){
                $data[]="num_personas_r = {$numpersonas}";
            }
            if (!empty($camarero)){
                $data[]="nombre_u = '{$camarero}'";
            }
            if (!empty($fecha)){
                $data[]="fecha_r = '{$fecha}'";
            }
            $anadir= implode(' AND ',$data);
            if (!empty($data)){
                $filtro=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                LEFT JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_reserva
                LEFT JOIN tbl_mesa m on mr.id_mesa=m.id_m
                LEFT JOIN tbl_usuario u on r.id_u=u.id_u
                LEFT JOIN tbl_sala s on m.id_s=s.id_s
                WHERE r.activa_r='si' and {$anadir}
                ORDER BY fecha_r DESC , franja_horaria_r DESC");
            }else{
                $filtro=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                LEFT JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_reserva
                LEFT JOIN tbl_mesa m on mr.id_mesa=m.id_m
                LEFT JOIN tbl_usuario u on r.id_u=u.id_u
                LEFT JOIN tbl_sala s on m.id_s=s.id_s
                ORDER BY fecha_r DESC , franja_horaria_r DESC");
            }
            try{
                $pdo->beginTransaction();
                $filtro->execute();
                echo  "<div class='row padding-top-less padding-lat'>";
                echo  "<table>";
                echo  "<tr>";
                echo  "<th class='blue'>Nº Reserva</th>";
                echo  "<th class='blue'>Sala</th>";
                echo  "<th class='blue'>Nombre</th>";
                echo  "<th class='blue'>Apellido</th>";
                echo  "<th class='blue'>Telefono</th>";
                echo  "<th class='blue'>Num Personas</th>";
                echo  "<th class='blue'>Fecha</th>";
                echo  "<th class='blue'>Franja Horaria</th>";
                echo  "<th class='blue'>Camarero</th>";
                echo  "</tr>";   
                foreach ($filtro as $row) {
                    echo  "<tr>";
                    echo "<td class='gris'>{$row['id_r']}</td>";
                    echo "<td class='gris'>{$row['nombre_s']}</td>";
                    echo "<td class='gris'>{$row['nombre_r']}</td>";
                    echo "<td class='gris'>{$row['apellido_r']}</td>";
                    echo "<td class='gris'>{$row['telefono_r']}</td>";
                    echo "<td class='gris'>{$row['num_personas_r']}</td>";
                    echo "<td class='gris'>{$row['fecha_r']}</td>";
                    for ($i = 1,$y=12,$z=14; $i <= 6; $i++,$y+=2,$z+=2) {
                        if ($row['franja_horaria_r']==$i){
                            echo "<td class='gris'>{$y}:00-{$z}:00</td>";
                        }
                    }
                    echo "<td class='gris'>{$row['nombre_u']}</td>";
                    echo "<td><button type='submit'><a type='button' href='../proceses/archivarreserva.php?id_r={$row['id_r']}'>Archivar reserva</a></button></td>";
                    echo  "</tr>";
                }
                echo "</table>";
                echo "</div>";
                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Fallo: " . $e->getMessage();
            }
        }else {
            //Sin filtro
            $historial=$pdo->prepare("SELECT distinct r.*, m.*, u.*, s.* FROM  tbl_reserva r
            LEFT JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_reserva
            LEFT JOIN tbl_mesa m on mr.id_mesa=m.id_m
            LEFT JOIN tbl_usuario u on r.id_u=u.id_u
            LEFT JOIN tbl_sala s on m.id_s=s.id_s
            WHERE r.activa_r='si'
            ORDER BY fecha_r DESC , franja_horaria_r DESC");
            try{
                $pdo->beginTransaction();
                $historial->execute();
                echo  "<div class='row padding-top-less padding-lat'>";
                echo  "<table>";
                echo  "<tr>";
                echo  "<th class='blue'>Nº Reserva</th>";
                echo  "<th class='blue'>Sala</th>";
                echo  "<th class='blue'>Nombre</th>";
                echo  "<th class='blue'>Apellido</th>";
                echo  "<th class='blue'>Telefono</th>";
                echo  "<th class='blue'>Num Personas</th>";
                echo  "<th class='blue'>Fecha</th>";
                echo  "<th class='blue'>Franja Horaria</th>";
                echo  "<th class='blue'>Camarero</th>";
                echo  "</tr>";   
                foreach ($historial as $row) {
                    echo  "<tr>";
                    echo "<td class='gris'>{$row['id_r']}</td>";
                    echo "<td class='gris'>{$row['nombre_s']}</td>";
                    echo "<td class='gris'>{$row['nombre_r']}</td>";
                    echo "<td class='gris'>{$row['apellido_r']}</td>";
                    echo "<td class='gris'>{$row['telefono_r']}</td>";
                    echo "<td class='gris'>{$row['num_personas_r']}</td>";
                    echo "<td class='gris'>{$row['fecha_r']}</td>";
                    for ($i = 1,$y=12,$z=14; $i <= 6; $i++,$y+=2,$z+=2) {
                        if ($row['franja_horaria_r']==$i){
                            echo "<td class='gris'>{$y}:00-{$z}:00</td>";
                        }
                    }
                    echo "<td class='gris'>{$row['nombre_u']}</td>";
                    echo "<td><button type='submit'><a type='button' href='../proceses/archivarreserva.php?id_r={$row['id_r']}'>Archivar reserva</a></button></td>";
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
}
?>