<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$idHabitacion = (int) ($_POST["id_habitacion"] ?? 0);
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
    $idHabitacion <= 0 ||
    $numero === "" ||
    !in_array($tipo, $tiposPermitidos, true) ||
    !in_array($estado, $estadosPermitidos, true)
) {
    die("Los datos de la habitación no son válidos.");
}

/*
Comprobar que el número no esté ocupado
por otra habitación.
*/
$sqlRepetida = "SELECT id_habitacion
                FROM habitaciones
                WHERE numero = ?
                  AND id_habitacion <> ?";

$validacion = mysqli_prepare(
    $conexion,
    $sqlRepetida
);

mysqli_stmt_bind_param(
    $validacion,
    "si",
    $numero,
    $idHabitacion
);

mysqli_stmt_execute($validacion);

$resultadoValidacion = mysqli_stmt_get_result(
    $validacion
);

if (mysqli_num_rows($resultadoValidacion) > 0) {
    die("Ya existe otra habitación con ese número.");
}

$sql = "UPDATE habitaciones SET
            numero = ?,
            tipo = ?,
            estado = ?
        WHERE id_habitacion = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

mysqli_stmt_bind_param(
    $consulta,
    "sssi",
    $numero,
    $tipo,
    $estado,
    $idHabitacion
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Habitación actualizada correctamente.")
    );

    exit();
}

die(
    "Error al actualizar la habitación: " .
    mysqli_stmt_error($consulta)
);

?>