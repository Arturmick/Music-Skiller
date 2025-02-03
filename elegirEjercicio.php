<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "music_skiller_bd";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos desde JSON
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    // Extraer datos
    $nivel = isset($data['nivel']) ? $data['nivel'] : null;
    $ejercicio = isset($data['ejercicio']) ? $data['ejercicio'] : null;

    // Validar que los datos no estén vacíos
    if (empty($nivel) || empty($ejercicio)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Conectar a la base de datos
    $link = mysqli_connect($hostname, $username, $password, $database);

    if (!$link) {
        echo json_encode(["status" => "error", "message" => "No se pudo conectar a MySQL: " . mysqli_connect_error()]);
        exit;
    }

    // Preparar la consulta
    $query = "SELECT imagenPequena, imagenGrande FROM ejercicios WHERE nivel = ? AND ejercicio = ?";
    $stmt = mysqli_prepare($link, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nivel, $ejercicio);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $imagenPequena, $imagenGrande);
            $results = [];

            while (mysqli_stmt_fetch($stmt)) {
				$results[] = ["imagenPequena" => $imagenPequena, "imagenGrande" => $imagenGrande];
			}

            echo json_encode([
                "status" => "success",
                "message" => "Ejercicio encontrado.",
                "results" => $results
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Ejercicio no encontrado."]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . mysqli_error($link)]);
    }

    mysqli_close($link);
} else {
    echo json_encode(["status" => "error", "message" => "Método de solicitud no válido."]);
}
