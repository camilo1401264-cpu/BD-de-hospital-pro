<?php

$host = "localhost";
$usuario = "root";
$password = "123456789"; // Si no tienes contraseña, deja ""
$bd = "hospital_db";

$conexion = mysqli_connect($host, $usuario, $password, $bd);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");
?>