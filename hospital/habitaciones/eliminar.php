<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

if (
    !isset($_SESSION["rol"]) ||
    $_SESSION["rol"] !== "Administrador"
) {
    die("No tienes permiso para eliminar habitaciones.");
}

require_once "../conexion/conexion.php";

$idHabitacion = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idHabitacion <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "DELETE FROM habitaciones
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
    "i",
    $idHabitacion
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Habitación eliminada correctamente.")
    );

    exit();
}

die(
    "No se pudo eliminar la habitación. Puede tener citas relacionadas. Error: " .
    mysqli_stmt_error($consulta)
);

?>