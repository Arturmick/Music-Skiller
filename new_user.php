<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "music_skiller_bd";
$id = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $instrumento = $_POST['instrumento'];

    if (empty($nick) || empty($email) || empty($instrumento)) {
        echo "Error: Todos los campos son obligatorios.";
    } else {
        $link = mysqli_connect($hostname, $username, $password, $database);

        if (!$link) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        } else {

            // Generar un ID único de nueve cifras aleatorias
            do {
                $id = rand(100000000, 999999999);
                $query = "SELECT id FROM usuario WHERE id = ?";
                $stmt = mysqli_prepare($link, $query);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $id_exists = mysqli_stmt_num_rows($stmt) > 0;
                mysqli_stmt_close($stmt);
            } while ($id_exists);

            $query = "INSERT INTO usuario ( id, nick, email, instrumento) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "isss", $id, $nick, $email, $instrumento);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Nuevo usuario registrado con éxito.<br>1 fila insertada.<br>";
                } else {
                    echo "Error en el registro: " . mysqli_stmt_error($stmt) . "<br>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error al preparar la consulta: " . mysqli_error($link) . "<br>";
            }

            mysqli_close($link);
        }
    }
} else {
    echo "Método de solicitud no válido.";
}
?>