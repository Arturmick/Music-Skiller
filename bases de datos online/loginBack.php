<?php
session_start();

$hostname = "mysql.freehostia.com";
$username = "artmiq_music_skiller_db";
$password = "Vp9CL31re(";
$database = "artmiq_music_skiller_db";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $pass = $_POST['pass'];

    if (empty($nick) || empty($pass)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
    } else {
        $link = mysqli_connect($hostname, $username, $password, $database);

        if (!$link) {
            echo json_encode(["status" => "error", "message" => "No se pudo conectar a MySQL."]);
        } else {
            $query = "SELECT email, instrumento, nombre, telefono, direccion FROM usuario WHERE nick = ? AND password = ?";
            $stmt = mysqli_prepare($link, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $nick, $pass);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt,$email,$instrumento,$nombre, $telefono, $direccion);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_fetch($stmt);
                    $_SESSION['nick'] = $nick;
                    $_SESSION['email'] = $email;
                    $_SESSION['instrumento'] = $instrumento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['telefono'] = $telefono;
                    $_SESSION['direccion'] = $direccion;
                    echo json_encode(["status" => "success", "message" => "Acceso concedido."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Usuario o contraseña incorrectos."]);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . mysqli_error($link)]);
            }

            mysqli_close($link);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método de solicitud no válido."]);
}
?>