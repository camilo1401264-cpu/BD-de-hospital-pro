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

$idCita = (int) ($_POST["id_cita"] ?? 0);
$medicamento = trim($_POST["medicamento"] ?? "");
$dosis = trim($_POST["dosis"] ?? "");
$indicaciones = trim($_POST["indicaciones"] ?? "");

if (
    $idCita <= 0 ||
    $medicamento === "" ||
    $dosis === "" ||
    $indicaciones === ""
) {
    die("Todos los campos son obligatorios.");
}

/*
Comprobar que la cita seleccionada existe.
*/
$sqlCita = "SELECT id_cita
            FROM citas
            WHERE id_cita = ?";

$validarCita = mysqli_prepare(
    $conexion,
    $sqlCita
);

mysqli_stmt_bind_param(
    $validarCita,
    "i",
    $idCita
);

mysqli_stmt_execute($validarCita);

$resultadoCita = mysqli_stmt_get_result(
    $validarCita
);

if (mysqli_num_rows($resultadoCita) === 0) {
    die("La cita seleccionada no existe.");
}

$sql = "INSERT INTO recetas (
            id_cita,
            medicamento,
            dosis,
            indicaciones
        ) VALUES (?, ?, ?, ?)";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

mysqli_stmt_bind_param(
    $consulta,
    "isss",
    $idCita,
    $medicamento,
    $dosis,
    $indicaciones
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Receta registrada correctamente.")
    );

    exit();
}

die(
    "Error al registrar la receta: " .
    mysqli_stmt_error($consulta)
);

?>