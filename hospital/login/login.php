<?php
session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: ../panel.php");
    exit();
}

$error = isset($_GET["error"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio de sesión</title>

    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body class="fondo-login">

    <div class="contenedor-login">

        <h1>Hospital SaMy</h1>
        <h2>Salud Integral</h2>

        <p class="subtitulo">Inicio de sesión</p>

        <?php if ($error): ?>
            <div class="mensaje-error">
                Usuario o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <form action="validar.php" method="POST">

            <label for="usuario">Usuario</label>

            <input
                type="text"
                id="usuario"
                name="usuario"
                placeholder="Escribe tu usuario"
                required
            >

            <label for="password">Contraseña</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Escribe tu contraseña"
                required
            >

            <button type="submit">
                Iniciar sesión
            </button>

        </form>

    </div>

</body>
</html>