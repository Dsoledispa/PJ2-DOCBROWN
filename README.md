# DOC-BROWN21
## Conexión a base de datos
### Necesitas crear el archivo connection.php y añadir las sentencias de la siguiente manera como demostraré a continuación.
```
<?php
// ESTILO POR PROCEDIMIENTOS

$host = "conexion";
$user = "usuario";
$pass = "contraseña";
$db = "nombre base de datos";

// Crear la conexión
$conn = mysqli_connect($host, $user, $pass, $db);

// Checkear la conexión
if (!$conn) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP_EOL;
    exit;
} else {
	mysqli_set_charset($conn, "utf8");
}
```