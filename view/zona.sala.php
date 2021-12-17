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
        <button type="submit"><a type='button' href='zona.reserva.php'>Administracion</a></button>
        <div class="row">
        <?php
        require_once '../services/connection.php';
        $stmt=$pdo->prepare("SELECT * FROM tbl_sala");
        try{
            $pdo->beginTransaction();
            $stmt->execute();
            foreach ($stmt as $row) {
                echo "<div class='three-column'>";
                echo "<a href='form.reserva1.php?id_s={$row['id_s']}'>";
                echo "<img src='{$row['img_s']}'alt='Fallo en la carga de base de datos'>";
                echo "</a><br>";
                echo "<h2>{$row['nombre_s']}</h2><br>";
                echo "<p>{$row['descripcion_s']}</p>";
                echo "</div>";
            }
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
        ?>
        </div>
    </body>
    </html>
<?php
}
?>