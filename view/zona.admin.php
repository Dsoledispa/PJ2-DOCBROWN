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
            <li><a>Hola</a></li>
            <li class="right">
                <a href="../proceses/logout.proc.php">Logout</a>
            </li>
        </ul>
        <div class="row padding-top padding-lat">
            <div>
                <button type="submit"><a type='button' href='vistahistorial.php'>Ver historial</a></button>
            </div>
            <div>
                <form action="zona.admin.php" method="post">
                    <label for="Localizacion">Localizacion</label>
                    <select name="localizacion">
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
                    <label for="mesa">¿Cuantas mesas?</label>
                    <input type="number" placeholder="Introduce cantidad mesas..." name="mesa">´
                    <label for="silla">¿Cuantas personas?</label>
                    <input type="number" placeholder="Introduce cantidad de personas..." name="silla">
                    <label for="disponibilidad">¿Mesa disponible?</label>
                    <select name="disponibilidad">
                        <option value="si" default>Si</option>
                        <option value="no">No</option>
                    </select>
                    <input type="submit" value="filtrar" name="filtrar">
                </form>
            </div>
        </div>
       <?php
       //Con filtro
       if (isset($_POST['filtrar'])) {
           $localizacion=$_POST['localizacion'];
           $mesa=$_POST['mesa'];
           $personas=$_POST['silla'];
           $disponibilidad=$_POST['disponibilidad'];
           $filtro=$pdo->prepare("SELECT tbl_localizacion.nombre_localizacion,tbl_mesa.mesa,tbl_mesa.silla,tbl_mesa.disponibilidad 
           FROM tbl_mesa 
           INNER JOIN tbl_localizacion ON tbl_mesa.id_localizacion=tbl_localizacion.id_localizacion
           WHERE tbl_localizacion.nombre_localizacion like '%{$localizacion}%' and tbl_mesa.mesa like '%{$mesa}%' and tbl_mesa.silla like '%{$personas}%' and tbl_mesa.disponibilidad like '%{$disponibilidad}%'");
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
                //Ponemos primero la localización
                echo  "<div class='row padding-top-less padding-lat'>";
                echo  "<div>";
                echo  "<h1>{$row['nombre_localizacion']}</h1>";
                echo  "<table>";
                echo  "<tr>";
                echo  "<th>nº Mesas</th>";
                echo  "<th>nº Personas</th>";
                echo  "<th>Disponibilidad</th>";
                echo  "</tr>";
                echo   "<tr>";
                    echo "<td>{$row['mesa']}</td>";
                    echo "<td>{$row['silla']}</td>";
                    if ($row['disponibilidad']=="si") {
                        echo "<td>Disponible</td>";
                        echo "<td><button type='submit'><a type='button' href='añadir.php'>Añadir reserva</a></button></td>";
                    }else{
                        echo "<td>No disponible</td>";
                        echo "<td><button type='submit'><a type='button' href='borrar.php'>Quitar reserva</a></button></td>";
                    }            
                echo "</tr>";
                echo "</table>";
                echo "</div>";
                echo "</div>";
            }
           }
        //Sin filtro
       }else {
                //Cogemos las mesas y sitios con las localizaciones correspondientes
                $sentencia=$pdo->prepare("SELECT tbl_localizacion.nombre_localizacion,tbl_mesa.mesa,tbl_mesa.silla,tbl_mesa.disponibilidad 
                FROM tbl_mesa 
                INNER JOIN tbl_localizacion ON tbl_mesa.id_localizacion=tbl_localizacion.id_localizacion;");
                $sentencia->execute();
                foreach ($sentencia as $localizacion) {
                    //Ponemos primero la localización
                    echo  "<div class='row padding-top-less padding-lat'>";
                    echo  "<div>";
                    echo  "<h1>{$localizacion['nombre_localizacion']}</h1>";
                    echo  "<table>";
                    echo  "<tr>";
                    echo  "<th>nº Mesas</th>";
                    echo  "<th>nº Personas</th>";
                    echo  "<th>Disponibilidad</th>";
                    echo  "</tr>";
                    echo   "<tr>";
                        echo "<td>{$localizacion['mesa']}</td>";
                        echo "<td>{$localizacion['silla']}</td>";
                        if ($localizacion['disponibilidad']=="si") {
                            echo "<td>Disponible</td>";
                            echo "<td><button type='submit'><a type='button' href='añadir.php'>Añadir reserva</a></button></td>";
                        }else{
                            echo "<td>No disponible</td>";
                            echo "<td><button type='submit'><a type='button' href='borrar.php'>Quitar reserva</a></button></td>";
                        }            
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                }
       }
       ?> 
    </body>
    </html>
<?php
}