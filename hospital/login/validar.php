<?php

session_start();

require_once "../conexion/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$usuario = trim($_POST["usuario"] ?? "");
$password = trim($_POST["password"] ?? "");

if ($usuario === "" || $password === "") {
    header("Location: login.php?error=1");
    exit();
}

$sql = "SELECT id_usuario, usuario, password, rol
        FROM usuarios
        WHERE usuario = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

mysqli_stmt_bind_param($consulta, "s", $usuario);
mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

if ($fila = mysqli_fetch_assoc($resultado)) {

    if ($password === $fila["password"]) {

        session_regenerate_id(true);

        $_SESSION["id_usuario"] = $fila["id_usuario"];
        $_SESSION["usuario"] = $fila["usuario"];
        $_SESSION["rol"] = $fila["rol"];

        header("Location: ../panel.php");
        exit();
    }
}

header("Location: login.php?error=1");
exit();

?>