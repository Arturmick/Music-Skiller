<?php
$hostname = "mysql.freehostia.com";  // IP del servidor MySQL
$username = "artmiq_music_skiller_db";  // Usuario de la base de datos
$password = "Vp9CL31re(";  // Contraseña de la base de datos
$database = "artmiq_music_skiller_db";  // Nombre de la base de datos

// Intenta conectar
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
	die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa a MySQL";

echo "Conexión a la base de datos <b>$database</b> realizada con éxito.<br>";

$query = "SELECT * FROM usuario";
$result = mysqli_query($conn, $query);

if ($result) {
	$filas_afectadas = mysqli_num_rows($result);
	echo "Número de filas afectadas: $filas_afectadas<br>";
	
	$articulos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($articulos as $articulo) {
		print_r($articulo);
		echo "<br>";
	}
	
} else {
	echo "Error al realizar la consulta: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>
