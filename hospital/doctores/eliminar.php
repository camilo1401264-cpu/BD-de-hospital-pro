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
    die("No tienes permiso para eliminar doctores.");
}

require_once "../conexion/conexion.php";

$idDoctor = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idDoctor <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "DELETE FROM doctores
        WHERE id_doctor = ?";

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
    $idDoctor
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Doctor eliminado correctamente.")
    );

    exit();
}

die(
    "No se pudo eliminar el doctor. Puede tener citas relacionadas. Error: " .
    mysqli_stmt_error($consulta)
);

?>