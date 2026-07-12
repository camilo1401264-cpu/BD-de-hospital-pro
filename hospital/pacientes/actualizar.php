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

$id = (int) ($_POST["id_paciente"] ?? 0);
$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$edad = (int) ($_POST["edad"] ?? 0);
$sexo = trim($_POST["sexo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");
$diagnostico = trim($_POST["diagnostico"] ?? "");
$fecha_ingreso = trim($_POST["fecha_ingreso"] ?? "");
$tipo_sangre = trim($_POST["tipo_sangre"] ?? "");
$fecha_nacimiento = trim($_POST["fecha_nacimiento"] ?? "");

if (
    $id <= 0 ||
    $nombre === "" ||
    $apellido === "" ||
    $edad < 0 ||
    $sexo === "" ||
    $telefono === "" ||
    $direccion === "" ||
    $diagnostico === "" ||
    $fecha_ingreso === "" ||
    $tipo_sangre === "" ||
    $fecha_nacimiento === ""
) {
    die("Datos inválidos.");
}

$fecha_ingreso = str_replace("T", " ", $fecha_ingreso);

$sql = "UPDATE pacientes SET
            nombre = ?,
            apellido = ?,
            edad = ?,
            sexo = ?,
            telefono = ?,
            direccion = ?,
            diagnostico = ?,
            fecha_ingreso = ?,
            tipo_sangre = ?,
            fecha_nacimiento = ?
        WHERE id_paciente = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die("Error al preparar la consulta: " . mysqli_error($conexion));
}

mysqli_stmt_bind_param(
    $consulta,
    "ssisssssssi",
    $nombre,
    $apellido,
    $edad,
    $sexo,
    $telefono,
    $direccion,
    $diagnostico,
    $fecha_ingreso,
    $tipo_sangre,
    $fecha_nacimiento,
    $id
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Paciente actualizado correctamente.")
    );

    exit();

} else {

    die(
        "Error al actualizar el paciente: " .
        mysqli_stmt_error($consulta)
    );
}

?>