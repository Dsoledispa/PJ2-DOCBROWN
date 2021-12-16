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
        <link rel="stylesheet" type="text/css" href="../css/sala.css">
        <title>Salas</title>
    </head>
    <body>
        <ul class="padding-lat">
            <li><a><?php echo $_SESSION["nombre"];?></a></li>
            <li class="right">
                <a href="../proceses/logout.proc.php">Logout</a>
            </li>
        </ul>
        <form action="../proceses/asignarmesas.php" method="post">
        <label for="id_m">Mesas</label>
            <select multiple name="id_m[]">
            <?php
                $id_s=$_GET['id_s'];
                // Mostrar todas las localizaciones que existen
                $option=$pdo->prepare("SELECT * FROM tbl_mesa WHERE id_s='{$id_s}'");
                try{
                    $pdo->beginTransaction();
                    $option->execute();
                    foreach ($option as $row) {
                        echo "<option value='{$row['id_m']}'>{$row['id_m']} mesa de {$row['silla_m']} sillas</option>";
                    }
                    $pdo->commit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    echo "Fallo: " . $e->getMessage();
                }
            ?>
            </select>
            <button type="submit">ENVIAR</button> <!-- ENVIAR NUEVO (BOOTSTRAP) -->  
        </form>
    </body>
    </html>
<?php
}
?>