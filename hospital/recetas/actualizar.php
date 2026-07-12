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

$idReceta = (int) ($_POST["id_receta"] ?? 0);
$idCita = (int) ($_POST["id_cita"] ?? 0);
$medicamento = trim($_POST["medicamento"] ?? "");
$dosis = trim($_POST["dosis"] ?? "");
$indicaciones = trim($_POST["indicaciones"] ?? "");

if (
    $idReceta <= 0 ||
    $idCita <= 0 ||
    $medicamento === "" ||
    $dosis === "" ||
    $indicaciones === ""
) {
    die("Los datos de la receta no son válidos.");
}

$sql = "UPDATE recetas SET
            id_cita = ?,
            medicamento = ?,
            dosis = ?,
            indicaciones = ?
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
    "isssi",
    $idCita,
    $medicamento,
    $dosis,
    $indicaciones,
    $idReceta
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Receta actualizada correctamente.")
    );

    exit();
}

die(
    "Error al actualizar la receta: " .
    mysqli_stmt_error($consulta)
);

?>