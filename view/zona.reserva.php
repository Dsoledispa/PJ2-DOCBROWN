<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
    if ($_SESSION['tipo_u']==""){
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
                    <form action="zona.reserva.php" method="post">
                        <div class="column-4">
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
                        <div class="column-4">
                            <label for="numpersonas">Numero personas</label><br>
                            <input type="number" name="numpersonas" class="casilla">
                        </div>
                        <div class="column-4">
                            <label for="camarero">Camarero</label><br>
                            <input type="text" name="camarero" class="casilla">
                        </div>
                        <!--
                        <div class="column-4">
                            <label for="fate">Fecha</label>
                            <input type="date" name="date" id="date">
                        </div>-->
                        <div class="column-1">
                            <br><br><input type="submit" value="FILTRAR" name="filtrar" class="filtrar">
                        </div>
                    </form>
                </div>
            </div><br>
            <?php
            if (isset($_POST['filtrar'])) {
                $sala=$_POST['sala'];
                $numpersonas=$_POST['numpersonas'];
                $camarero=$_POST['camarero'];
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
                $anadir= implode(',',$data);
                $filtro=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                INNER JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_r
                INNER JOIN tbl_mesa m on mr.id_m=m.id_m
                INNER JOIN tbl_usuario u on r.id_u=u.id_u
                INNER JOIN tbl_sala s on m.id_s=s.id_s
                WHERE {$anadir}
                ORDER BY fecha_r DESC , hora_inicio_r DESC");
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
                            echo  "<th class='blue'>Hora inicio de reserva</th>";
                            echo  "<th class='blue'>Hora final de reserva</th>";
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
                                echo "<td class='gris'>{$row['hora_inicio_r']}</td>";
                                echo "<td class='gris'>{$row['hora_final_r']}</td>";
                                echo "<td class='gris'>{$row['nombre_u']}</td>";
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
                $historial=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                INNER JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_r
                INNER JOIN tbl_mesa m on mr.id_m=m.id_m
                INNER JOIN tbl_usuario u on r.id_u=u.id_u
                INNER JOIN tbl_sala s on m.id_s=s.id_s
                ORDER BY fecha_r DESC , hora_inicio_r DESC");
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
                            echo  "<th class='blue'>Hora inicio de reserva</th>";
                            echo  "<th class='blue'>Hora final de reserva</th>";
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
                                echo "<td class='gris'>{$row['hora_inicio_r']}</td>";
                                echo "<td class='gris'>{$row['hora_final_r']}</td>";
                                echo "<td class='gris'>{$row['nombre_u']}</td>";
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
                <button type="submit"><a type='button' href='zona.usuarios.php'>Usuarios</a></button>
                <button type="submit"><a type='button' href='zona.recursos.php'>Recursos</a></button>
                    <form action="zona.reserva.php" method="post">
                        <div class="column-4">
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
                        <div class="column-4">
                            <label for="numpersonas">Numero personas</label><br>
                            <input type="number" name="numpersonas" class="casilla">
                        </div>
                        <div class="column-4">
                            <label for="camarero">Camarero</label><br>
                            <input type="text" name="camarero" class="casilla">
                        </div>
                        <!--
                        <div class="column-4">
                            <label for="fate">Fecha</label>
                            <input type="date" name="date" id="date">
                        </div>-->
                        <div class="column-1">
                            <br><br><input type="submit" value="FILTRAR" name="filtrar" class="filtrar">
                        </div>
                    </form>
                </div>
            </div><br>
            <?php
            if (isset($_POST['filtrar'])) {
                $sala=$_POST['sala'];
                $numpersonas=$_POST['numpersonas'];
                $camarero=$_POST['camarero'];
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
                $anadir= implode(',',$data);
                $filtro=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                INNER JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_r
                INNER JOIN tbl_mesa m on mr.id_m=m.id_m
                INNER JOIN tbl_usuario u on r.id_u=u.id_u
                INNER JOIN tbl_sala s on m.id_s=s.id_s
                WHERE {$anadir}
                ORDER BY fecha_r DESC , hora_inicio_r DESC");
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
                            echo  "<th class='blue'>Hora inicio de reserva</th>";
                            echo  "<th class='blue'>Hora final de reserva</th>";
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
                                echo "<td class='gris'>{$row['hora_inicio_r']}</td>";
                                echo "<td class='gris'>{$row['hora_final_r']}</td>";
                                echo "<td class='gris'>{$row['nombre_u']}</td>";
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
                $historial=$pdo->prepare("SELECT r.*, mr.*, m.*, u.*, s.* FROM  tbl_reserva r
                INNER JOIN `tbl_mesa/reserva` mr on r.id_r=mr.id_r
                INNER JOIN tbl_mesa m on mr.id_m=m.id_m
                INNER JOIN tbl_usuario u on r.id_u=u.id_u
                INNER JOIN tbl_sala s on m.id_s=s.id_s
                ORDER BY fecha_r DESC , hora_inicio_r DESC");
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
                            echo  "<th class='blue'>Hora inicio de reserva</th>";
                            echo  "<th class='blue'>Hora final de reserva</th>";
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
                                echo "<td class='gris'>{$row['hora_inicio_r']}</td>";
                                echo "<td class='gris'>{$row['hora_final_r']}</td>";
                                echo "<td class='gris'>{$row['nombre_u']}</td>";
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
}