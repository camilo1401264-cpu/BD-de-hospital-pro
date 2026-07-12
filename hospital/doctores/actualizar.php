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

$idDoctor = (int) ($_POST["id_doctor"] ?? 0);
$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$especialidad = trim($_POST["especialidad"] ?? "");
$cedulaProf = trim($_POST["cedula_prof"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");

if (
    $idDoctor <= 0 ||
    $nombre === "" ||
    $apellido === "" ||
    $especialidad === "" ||
    $cedulaProf === "" ||
    $telefono === ""
) {
    die("Los datos del doctor no son válidos.");
}

$sql = "UPDATE doctores SET
            nombre = ?,
            apellido = ?,
            especialidad = ?,
            cedula_prof = ?,
            telefono = ?
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
    "sssssi",
    $nombre,
    $apellido,
    $especialidad,
    $cedulaProf,
    $telefono,
    $idDoctor
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Doctor actualizado correctamente.")
    );

    exit();
}

die(
    "Error al actualizar el doctor: " .
    mysqli_stmt_error($consulta)
);

?>