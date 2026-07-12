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
    die("No tienes permiso para eliminar pacientes.");
}

require_once "../conexion/conexion.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "DELETE FROM pacientes WHERE id_paciente = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die("Error al preparar la consulta: " . mysqli_error($conexion));
}

mysqli_stmt_bind_param($consulta, "i", $id);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Paciente eliminado correctamente.")
    );

    exit();

} else {

    die(
        "No se pudo eliminar el paciente. Puede tener citas o recetas relacionadas. Error: " .
        mysqli_stmt_error($consulta)
    );
}

?>