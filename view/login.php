<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="text-center" id="portada">
        <main class="form-signin">
            <form action="../proceses/login.proc.php" method="post" id="formulario">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@docbrown.com">
                    <label for="floatingInput">Correo electrónico</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <button class="w-100 btn btn-lg btn-secondary" type="submit">Iniciar sesión</button>
            </form>
        </main>
    </div>
    <?php
    if (!empty($_GET['error'])){
        if ($_GET['error']==1){
            echo "<div id='error'></div>";
        }
    }
    ?>
    <!--Validar login-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>