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
$edad = (int) ($_POST["edad"] ?? 0);
$sexo = trim($_POST["sexo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");
$diagnostico = trim($_POST["diagnostico"] ?? "");
$fecha_ingreso = trim($_POST["fecha_ingreso"] ?? "");
$tipo_sangre = trim($_POST["tipo_sangre"] ?? "");
$fecha_nacimiento = trim($_POST["fecha_nacimiento"] ?? "");

if (
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
    die("Faltan datos obligatorios.");
}

$fecha_ingreso = str_replace("T", " ", $fecha_ingreso);

$sql = "INSERT INTO pacientes (
            nombre,
            apellido,
            edad,
            sexo,
            telefono,
            direccion,
            diagnostico,
            fecha_ingreso,
            tipo_sangre,
            fecha_nacimiento
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die("Error al preparar la consulta: " . mysqli_error($conexion));
}

mysqli_stmt_bind_param(
    $consulta,
    "ssisssssss",
    $nombre,
    $apellido,
    $edad,
    $sexo,
    $telefono,
    $direccion,
    $diagnostico,
    $fecha_ingreso,
    $tipo_sangre,
    $fecha_nacimiento
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Paciente registrado correctamente.")
    );

    exit();

} else {

    die(
        "Error al guardar el paciente: " .
        mysqli_stmt_error($consulta)
    );
}

?>