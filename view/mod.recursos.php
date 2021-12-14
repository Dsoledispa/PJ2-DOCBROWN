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
    <title>Modificar recursos</title>
</head>
<body>
    <?php
        $id_m=$_GET['id_m'];
        $stmt=$pdo->prepare("SELECT * FROM tbl_mesa WHERE id_m=$id_m");
        try{
            $pdo->beginTransaction();
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $silla_m=$row['silla_m'];
            $disponibilidad_m=$row['disponibilidad_m'];
            $id_s=$row['id_s'];
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Fallo: " . $e->getMessage();
        }
    ?>
    <div class="container">
		<div class="main">
			<div class="main-center">
			<h5>Introduce los datos para modificar el recurso</h5>
                <form action="../proceses/modificarrecurso.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="silla_m">Numero sillas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <?php echo "<input type='number' class='form-control' name='silla_m' placeholder='$silla_m'>";?>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="disponibilidad_m">Disponibilidad mesa</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select name="disponibilidad_m" class="form-control form-control-lg">
                                <?php echo "<option value='' default>{$disponibilidad_m}</option>";?>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="id_s">Sala</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <select name="id_s" class="form-control form-control-lg">
                                <?php
                                    // Mostrar todas las localizaciones que existen
                                    $option=$pdo->prepare("SELECT * FROM tbl_sala");
                                    try{
                                        $pdo->beginTransaction();
                                        $option->execute();
                                        foreach ($option as $row) {
                                            if ($id_s==$row['id_s']){
                                                echo "<option value='{$row['id_s']}' selected>{$row['nombre_s']}</option>";
                                            }else{
                                                echo "<option value='{$row['id_s']}'>{$row['nombre_s']}</option>";
                                            }
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
                    <?php echo "<input type='hidden' name='id_m' value=$id_m>";?>
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