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
    <?php $id_s=$_GET['id_s']; ?>
    <div class="container">
		<div class="main">
			<div class="main-center">
			<h5>Introduce tus datos para inscribirte en el evento</h5>
                <form action="../proceses/agregarreserva.php" method="post">
                    <div class="form-group">
                        <label for="nombre_r">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="nombre_r"  placeholder="Introduce tu nombre"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido_r">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="apellido_r" placeholder="Introduce tu apellido"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono_r">Nº telefono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="tel" class="form-control" name="telefono_r" placeholder="Introduce tu nº telefono"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha_r">Fecha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" name="fecha_r"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="num_personas_r">Num personas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="num_personas_r"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio_r">Hora</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="time" min="12:00" max="24:00" class="form-control" name="hora_inicio_r"/>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="id_m">Seleccionar mesas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select multiple name="id_m[]" class="form-control form-control-lg">
                                <?php
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
                            </div>
                    </div>
                    <?php
                        echo "<input type='hidden' name='id_s' value=$id_s>";
                    ?>
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