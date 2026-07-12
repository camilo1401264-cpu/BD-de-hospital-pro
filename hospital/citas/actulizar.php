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

$idCita = (int) ($_POST["id_cita"] ?? 0);
$idDoctor = (int) ($_POST["id_doctor"] ?? 0);
$idHabitacion = (int) ($_POST["id_habitacion"] ?? 0);
$idPaciente = (int) ($_POST["id_paciente"] ?? 0);
$fechaCita = trim($_POST["fecha_cita"] ?? "");
$motivo = trim($_POST["motivo"] ?? "");
$estado = trim($_POST["estado"] ?? "");

$estadosPermitidos = [
    "Programada",
    "Completada",
    "Cancelada"
];

if (
    $idCita <= 0 ||
    $idDoctor <= 0 ||
    $idHabitacion <= 0 ||
    $idPaciente <= 0 ||
    $fechaCita === "" ||
    $motivo === "" ||
    !in_array($estado, $estadosPermitidos, true)
) {
    die("Los datos de la cita no son válidos.");
}

$fechaCita = str_replace("T", " ", $fechaCita);

$sql = "UPDATE citas SET
            id_doctor = ?,
            id_habitacion = ?,
            id_paciente = ?,
            fecha_cita = ?,
            motivo = ?,
            estado = ?
        WHERE id_cita = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

mysqli_stmt_bind_param(
    $consulta,
    "iiisssi",
    $idDoctor,
    $idHabitacion,
    $idPaciente,
    $fechaCita,
    $motivo,
    $estado,
    $idCita
);

if (mysqli_stmt_execute($consulta)) {

    header(
        "Location: index.php?mensaje=" .
        urlencode("Cita actualizada correctamente.")
    );

    exit();

}

die(
    "Error al actualizar la cita: " .
    mysqli_stmt_error($consulta)
);

?>