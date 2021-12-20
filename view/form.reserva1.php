<?php
require_once "../services/connection.php";
session_start();
if ($_SESSION['email']=="") {
    header("location:login.php");
}else {
        $_SESSION['id_s'] = $_GET['id_s'];
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
                <form action="form.reserva2.php" method="post" id="form1">
                    <div class="form-group">
                        <label for="nombre_r">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="nombre_r" id="nombre_r" placeholder="Introduce tu nombre"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido_r">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="apellido_r" id="apellido_r" placeholder="Introduce tu apellido"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono_r">Nº telefono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="tel" class="form-control" name="telefono_r" id="telefono_r" placeholder="Introduce tu nº telefono"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_personas_r">Num personas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="num_personas_r" id="num_personas_r"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha_r">Fecha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" name="fecha_r" id="fecha_r"/>
                            </div>
                    </div>
                    <button type="submit">ENVIAR</button> <!-- ENVIAR NUEVO (BOOTSTRAP) -->   
                </form>
			</div><!--main-center"-->
		</div><!--main-->
	</div><!--container-->
    <!--Validar formulario-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/form1.js"></script>
</body>
</html>
<?php
}
?>