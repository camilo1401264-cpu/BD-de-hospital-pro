<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: agregar.php");
    exit();
}

$numero = trim($_POST["numero"] ?? "");
$tipo = trim($_POST["tipo"] ?? "");
$estado = trim($_POST["estado"] ?? "");

$tiposPermitidos = [
    "Individual",
    "Doble",
    "Suite"
];

$estadosPermitidos = [
    "Disponible",
    "Ocupada",
    "Mantenimiento"
];

if (
    $numero === "" ||
    !in_array($tipo, $tiposPermitidos, true) ||
    !in_array($estado, $estadosPermitidos, true)
) {
    die("Los datos de la habitación no son válidos.");
}

/*
Comprobar que no exista otra habitación
con el mismo número.
*/
$sqlRepetida = "SELECT id_habitacion
                FROM habitaciones
                WHERE numero = ?";

$validacion = mysqli_prepare(
    $conexion,
    $sqlRepetida
);

mysqli_stmt_bind_param(
    $validacion,
    "s",
    $numero
);

mysqli_stmt_execute($validacion);

$resultadoValidacion = mysqli_stmt_get_result(
    $validacion
);

if (mysqli_num_rows($resultadoValidacion) > 0) {
    die("Ya existe una habitación con ese número.");
}

$sql = "INSERT INTO habitaciones (
            numero,
            tipo,
            estado
        ) VALUES (?, ?, ?)";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

mysqli_stmt_bind_param(
    $consulta,
    "sss",
    $numero,
    $tipo,
    $estado
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Habitación registrada correctamente.")
    );

    exit();
}

die(
    "Error al registrar la habitación: " .
    mysqli_stmt_error($consulta)
);

?>