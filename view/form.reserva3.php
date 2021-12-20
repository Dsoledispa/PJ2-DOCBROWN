<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
    foreach ($_POST as $clave => $valor) {
        $_SESSION['sesionform2'][$clave] = $valor;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="../css/form.css" rel="stylesheet">
    <title>Formulario reservas</title>
</head>
<body>
    <div class="container">
		<div class="main">
			<div class="main-center">
			<h5>Introduce tus datos para inscribirte en el evento</h5>
            <?php echo "<h5>Numero de personas: {$_SESSION['sesionform1']['num_personas_r']}</h5>"?>
                <form action="../proceses/agregarreserva.php" method="post" id="form3">
                    <div class="form-group">
                    <label for="id_m">Seleccionar mesas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select multiple name="id_m[]" id="id_m" class="form-control form-control-lg">
                                <?php
                                    // Mostrar todas las localizaciones que existen
                                    $option=$pdo->prepare("SELECT * FROM tbl_mesa WHERE id_s='{$_SESSION['id_s']}' AND disponibilidad_m='si'");
                                    try{
                                        $pdo->beginTransaction();
                                        $option->execute();
                                        foreach ($option as $row) {
                                            echo "<option value='{$row['id_m']}'>{$row['id_m']}: mesa de {$row['silla_m']} sillas</option>";
                                        }
                                        $pdo->commit();
                                    } catch (Exception $e) {
                                        $pdo->rollBack();
                                        echo "Fallo: " . $e->getMessage();
                                    }
                                ?>
                                </select>
                            </div>
                    </div>
                    <button type="submit">ENVIAR</button> <!-- ENVIAR NUEVO (BOOTSTRAP) -->   
                </form>
			</div><!--main-center"-->
		</div><!--main-->
	</div><!--container-->
</body>
</html>
<?php
}
?>