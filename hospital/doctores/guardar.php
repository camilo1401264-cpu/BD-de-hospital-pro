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

$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$especialidad = trim($_POST["especialidad"] ?? "");
$cedulaProf = trim($_POST["cedula_prof"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");

if (
    $nombre === "" ||
    $apellido === "" ||
    $especialidad === "" ||
    $cedulaProf === "" ||
    $telefono === ""
) {
    die("Todos los campos son obligatorios.");
}

$sql = "INSERT INTO doctores (
            nombre,
            apellido,
            especialidad,
            cedula_prof,
            telefono
        ) VALUES (?, ?, ?, ?, ?)";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

mysqli_stmt_bind_param(
    $consulta,
    "sssss",
    $nombre,
    $apellido,
    $especialidad,
    $cedulaProf,
    $telefono
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Doctor registrado correctamente.")
    );

    exit();
}

die(
    "Error al registrar el doctor: " .
    mysqli_stmt_error($consulta)
);

?>