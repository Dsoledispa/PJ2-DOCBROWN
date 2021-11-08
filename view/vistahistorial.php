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
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>Document</title>
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
            <button type="submit"><a type='button' href='zona.admin.php'>Ver mesas</a></button>
                <form action="vistahistorial.php" method="post">
                    <div class="column-4">
                        <label for="localizacion">Ubicacion</label>    
                        <select name="localizacion" id="localizacion">
                        <option value="" default>Todas las localizaciones</option>
                                <?php
                                // Mostrar todas las localizaciones que existen
                                    $option=$pdo->prepare("SELECT * FROM tbl_localizacion");
                                    $option->execute();
                                    $listaoption=$option->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($listaoption as $row) {
                                        echo "<option value='{$row['nombre_localizacion']}'>{$row['nombre_localizacion']}</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="column-4">
                        <label for="mesa">Nº de mesa</label>
                        <input type="number" name="mesa" id="mesa">
                    </div>
                    <!--
                    <div class="column-4">
                        <label for="fate">Fecha</label>
                        <input type="date" name="date" id="date">
                    </div>-->
                    <div class="column-1">
                        <input type="submit" value="filtrar" name="filtrar">
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['filtrar'])) {
            $localizacion=$_POST['localizacion'];
            $mesa=$_POST['mesa'];
            /*$date=$_POST['date'];
            $date=date("d/m/Y",strtotime($date));*/
            $filtro=$pdo->prepare("SELECT tbl_historial.id_historial,tbl_mesa.id_mesa,tbl_localizacion.nombre_localizacion,DATE_FORMAT(tbl_historial.dia_historial,'%d/%m/%Y') as 'fecha',tbl_historial.inicio_historial,tbl_historial.fin_historial,tbl_historial.nombre
            FROM tbl_historial INNER JOIN tbl_mesa ON tbl_historial.id_mesa=tbl_mesa.id_mesa
            INNER JOIN tbl_localizacion ON tbl_mesa.id_localizacion=tbl_localizacion.id_localizacion 
            WHERE tbl_localizacion.nombre_localizacion like '%{$localizacion}%' and tbl_mesa.id_mesa like '%{$mesa}' ORDER BY `fecha` and tbl_historial.inicio_historial DESC");
            $filtro->execute();
            $filtrar=$filtro->fetchAll(PDO::FETCH_ASSOC);
            if (empty($filtrar)) {
                echo "<div class='row padding-top-less padding-lat'>";
                echo "<div>";
                echo "<h1>No se han encontrado elementos....</h1>";
                echo "</div>";
                echo "</div>";
               }else {
                foreach ($filtrar as $row) {
                    echo  "<div class='row padding-top-less padding-lat'>";
                        echo  "<div>";
                        echo  "<table>";
                        echo  "<tr>";
                        echo  "<th>Nº Reserva</th>";
                        echo  "<th>Localizacion</th>";
                        echo  "<th>Nº de Mesa</th>";
                        echo  "<th>Fecha</th>";
                        echo  "<th>Hora inicio de reserva</th>";
                        echo  "<th>Hora final de reserva</th>";
                        echo  "<th>Camarero</th>";
                        echo  "</tr>";
                        echo   "<tr>";
                        echo "<td>{$row['id_historial']}</td>";
                        echo "<td>{$row['nombre_localizacion']}</td>";
                        echo "<td>{$row['id_mesa']}</td>";
                        echo "<td>{$row['fecha']}</td>";
                        echo "<td>{$row['inicio_historial']}</td>";
                        echo "<td>{$row['fin_historial']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo  "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                }
               }
        }else {
            $historial=$pdo->prepare("SELECT tbl_historial.id_historial,tbl_mesa.id_mesa,tbl_localizacion.nombre_localizacion,DATE_FORMAT(tbl_historial.dia_historial,'%d/%m/%Y') as `fecha`,tbl_historial.inicio_historial,tbl_historial.fin_historial,tbl_historial.nombre
            FROM tbl_historial INNER JOIN tbl_mesa ON tbl_historial.id_mesa=tbl_mesa.id_mesa
            INNER JOIN tbl_localizacion ON tbl_mesa.id_localizacion=tbl_localizacion.id_localizacion
            ORDER BY `fecha` and tbl_historial.inicio_historial DESC");
            $historial->execute();  
            foreach ($historial as $row) {
                echo  "<div class='row padding-top-less padding-lat'>";
                        echo  "<div>";
                        echo  "<table>";
                        echo  "<tr>";
                        echo  "<th>Nº Reserva</th>";
                        echo  "<th>Localizacion</th>";
                        echo  "<th>nº Mesa</th>";
                        echo  "<th>Fecha</th>";
                        echo  "<th>Hora inicio de reserva</th>";
                        echo  "<th>Hora final de reserva</th>";
                        echo  "<th>Camarero</th>";
                        echo  "</tr>";
                        echo  "<tr>";
                        echo "<td>{$row['id_historial']}</td>";
                        echo "<td>{$row['nombre_localizacion']}</td>";
                        echo "<td>{$row['id_mesa']}</td>";
                        echo "<td>{$row['fecha']}</td>";
                        echo "<td>{$row['inicio_historial']}</td>";
                        echo "<td>{$row['fin_historial']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo  "</tr>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
        }
        ?> 
        </body>
        </html>
    <?php
    }
}