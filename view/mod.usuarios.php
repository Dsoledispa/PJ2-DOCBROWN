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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="../css/form.css" rel="stylesheet">
    <title>Formulario usuarios</title>
</head>
<body>
    <?php
        $id_u=$_GET['id_u'];
        $stmt=$pdo->prepare("SELECT * FROM tbl_usuario WHERE id_u=$id_u");
        try{
            $pdo->beginTransaction();
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $nombre_u=$row['nombre_u'];
            $apellido_u=$row['apellido_u'];
            $correo_u=$row['correo_u'];
            $tipo_u=$row['tipo_u'];
            $disponibilidad_u=$row['disponibilidad_u'];
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    ?>
    <div class="container">
		<div class="main">
			<div class="main-center">
			<h5>Introduce los datos para modificar el usuario</h5>
                <form action="../proceses/modificarusuario.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="nombre_u">Nombre del usuario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <?php echo "<input type='text' class='form-control' name='nombre_u' placeholder='$nombre_u'>";?>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="apellido_u">Apellido del usuario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <?php echo "<input type='text' class='form-control' name='apellido_u' placeholder='$apellido_u'>";?>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="correo_u">Correo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <?php echo "<input type='email' class='form-control' name='correo_u' placeholder='$correo_u'>";?>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="contraseña_u">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <?php echo "<input type='password' class='form-control' name='contraseña_u' placeholder='********'>";?>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="tipo_u">Tipo de usuario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select name="tipo_u" class="form-control form-control-lg">
                                <?php echo "<option value='' default>{$tipo_u}</option>";?>
                                    <option value="camarero">Camarero</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="disponibilidad_u">Disponibilidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select name="disponibilidad_u" class="form-control form-control-lg">
                                    <?php echo "<option value='' default>{$disponibilidad_u}</option>";?>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                    </div>
                    <?php echo "<input type='hidden' name='id_u' value=$id_u>";?>
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