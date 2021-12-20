<?php
require_once "../services/connection.php";
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email']=="" && !isset($_SESSION['tipo_u']) || $_SESSION['tipo_u']=="") {
    header("location:login.php");
}else {
    $id_usuario=$_SESSION['id_u'];
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
        <div class="row padding-top padding-lat">
            <div class="fondo">
            <button type="submit"><a type='button' href='zona.sala.php'>Volver a salas</a></button>
            <button type="submit"><a type='button' href='zona.reserva.php'>Reservas</a></button>
            <button type="submit"><a type='button' href='zona.recursos.php'>Recursos</a></button>
            <button type="submit"><a type='button' href='zona.historial.php'>Historial Reservas</a></button>
            <button type="submit"><a type='button' href='form.usuarios.php'>Crear usuario</a></button>
                <form action="zona.usuarios.php" method="post">
                    <div class="column-2">
                        <label for="nombre">Nombre</label><br>
                        <input type="text" placeholder="Introduce el nombre" name="nombre" class="casilla">
                    </div>
                    <div class="column-2">
                        <label for="apellido">Apellido</label><br>
                        <input type="text" placeholder="Introduce el apellido" name="apellido" class="casilla">
                    </div>
                    <div class="column-2">
                        <label for="tipo">Tipo</label><br>   
                        <select name="tipo" class="casilla">
                            <option value="" default>Camarero/Administrador</option>
                            <option value="camarero">Camarero</option>
                            <option value="administrador">Administrador</option>
                        </select>
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
        $nombre_u=$_POST['nombre'];
        $apellido_u=$_POST['apellido'];
        $tipo_u=$_POST['tipo'];
        $disponibilidad_u=$_POST['disponibilidad'];
        $data = array();
        if (!empty($nombre_u)){
            $data[]="nombre_u = '{$nombre_u}'";
        }
        if (!empty($apellido_u)){
            $data[]="apellido_u = '{$apellido_u}'";
        }
        if (!empty($tipo_u)){
            $data[]="tipo_u = '{$tipo_u}'";
        }
        if (!empty($disponibilidad_u)){
            $data[]="disponibilidad_u = '{$disponibilidad_u}'";
        }
        $anadir= implode(' AND ',$data);
        if (!empty($data)){
            $usuarios=$pdo->prepare("SELECT * FROM tbl_usuario WHERE {$anadir}");
        }else{
            $usuarios=$pdo->prepare("SELECT * FROM tbl_usuario");
        }
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
                    if ($usuario['id_u']==$id_usuario) {
                        echo "<td><button type='submit' class='red'>Cambia de cuenta para modificar esta</button></td>";
                        echo "<td><button type='submit' class='red'>Cambia de cuenta para eliminar esta</button></td>";
                    }else{
                        echo "<td><button type='submit'><a type='button' href='mod.usuarios.php?id_u={$usuario['id_u']}'>Modificar usuario</a></button></td>";
                        echo "<td><button type='submit'><a type='button' href='../proceses/eliminarusuario.php?id_u={$usuario['id_u']}'>Eliminar usuario</a></button></td>";
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
                    if ($usuario['id_u']==$id_usuario) {
                        echo "<td><button type='submit' class='red'>Cambia de cuenta para modificar esta</button></td>";
                        echo "<td><button type='submit' class='red'>Cambia de cuenta para eliminar esta</button></td>";
                    }else{
                        echo "<td><button type='submit'><a type='button' href='mod.usuarios.php?id_u={$usuario['id_u']}'>Modificar usuario</a></button></td>";
                        echo "<td><button type='submit'><a type='button' href='../proceses/eliminarusuario.php?id_u={$usuario['id_u']}'>Eliminar usuario</a></button></td>";
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