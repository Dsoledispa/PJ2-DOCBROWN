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
        <title>Salas</title>
    </head>
    <body>
        <div class="row">
        <?php
        require_once '../services/connection.php';
        $stmt=$pdo->prepare("SELECT * FROM tbl_sala");
        try{
            $pdo->beginTransaction();
            $stmt->execute();
            foreach ($stmt as $row) {
                echo "<div class='three-column'>";
                echo "<a href='../proceses/elegirsala.php?id_s={$row['id_s']}'>";
                echo "<img src='{$row['img_s']}'alt='Fallo en la carga de base de datos'>";
                echo "</a>";
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