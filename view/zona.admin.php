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

        <title>Document</title>
    </head>
    <body>
        <ul class="padding-lat">
            <li><a>Hola</a></li>
            <li class="right">
                <a href="../proceses/logout.proc.php">Logout</a>
            </li>
        </ul>
        <div class="row padding-top padding-lat">
            <div>
                <form action="zona.admin.php" method="post">
                    <input type="submit" value="añadir reserva">
                </form>
            </div>
            <div>
                <form action="zona.admin.php" method="post">
                    <input type="text" placeholder="filtra por lugar..." name="lugar">
                    <input type="submit" value="filtrar" name="filtro">
                </form>
            </div>
        </div>
        <div class="row padding-top-less padding-lat">
            <div>
                <table>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Autor</th>
                    </tr>
                </table>
            </div>
        </div>
    </body>
    </html>
<?php
}