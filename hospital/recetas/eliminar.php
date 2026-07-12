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
    die("No tienes permiso para eliminar recetas.");
}

require_once "../conexion/conexion.php";

$idReceta = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idReceta <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "DELETE FROM recetas
        WHERE id_receta = ?";

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
    $idReceta
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Receta eliminada correctamente.")
    );

    exit();
}

die(
    "Error al eliminar la receta: " .
    mysqli_stmt_error($consulta)
);

?>