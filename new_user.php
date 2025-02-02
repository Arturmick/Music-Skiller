<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "music_skiller_bd";
$id = 0;

header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm_pass = $_POST['confirm_pass'];
    $instrumento = $_POST['instrumento'];

    if (empty($nick) || empty($email) || empty($pass) || empty($instrumento)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "El correo electrónico no es válido."]);
    } else if ($pass !== $confirm_pass) {
        echo json_encode(["status" => "error", "message" => "Las contraseñas no coinciden."]);
    } else {
        $link = mysqli_connect($hostname, $username, $password, $database);

        if (!$link) {
            echo json_encode(["status" => "error", "message" => "No se pudo conectar a MySQL."]);
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

            $query = "INSERT INTO usuario (id, nick, email, password, instrumento) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "issss", $id, $nick, $email, $pass, $instrumento);
                if (mysqli_stmt_execute($stmt)) {
                    echo json_encode(["status" => "success", "message" => "Nuevo usuario registrado con éxito."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error en el registro: " . mysqli_stmt_error($stmt)]);
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