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
    die("No tienes permiso para eliminar citas.");
}

require_once "../conexion/conexion.php";

$idCita = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idCita <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "DELETE FROM citas WHERE id_cita = ?";

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
    $idCita
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Cita eliminada correctamente.")
    );

    exit();

}

die(
    "No se pudo eliminar la cita. Puede tener recetas relacionadas. Error: " .
    mysqli_stmt_error($consulta)
);

?>