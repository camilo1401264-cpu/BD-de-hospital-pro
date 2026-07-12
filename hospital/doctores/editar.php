<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$idDoctor = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idDoctor <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT *
        FROM doctores
        WHERE id_doctor = ?";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "i",
    $idDoctor
);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

$doctor = mysqli_fetch_assoc($resultado);

if (!$doctor) {
    die("Doctor no encontrado.");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar doctor | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Editar doctor</h1>

            <p>
                Modifica los datos del doctor seleccionado.
            </p>

        </div>

        <a
            href="index.php"
            class="boton-regresar"
        >
            ← Volver
        </a>

    </header>

    <main class="contenido-crud">

        <section class="contenedor-formulario">

            <form
                action="actualizar.php"
                method="POST"
                class="formulario-paciente"
            >

                <input
                    type="hidden"
                    name="id_doctor"
                    value="<?php echo $doctor["id_doctor"]; ?>"
                >

                <div class="grupo-formulario">

                    <label for="nombre">
                        Nombre
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        maxlength="100"
                        value="<?php echo htmlspecialchars($doctor["nombre"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="apellido">
                        Apellido
                    </label>

                    <input
                        type="text"
                        id="apellido"
                        name="apellido"
                        maxlength="100"
                        value="<?php echo htmlspecialchars($doctor["apellido"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="especialidad">
                        Especialidad
                    </label>

                    <input
                        type="text"
                        id="especialidad"
                        name="especialidad"
                        maxlength="255"
                        value="<?php echo htmlspecialchars($doctor["especialidad"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="cedula_prof">
                        Cédula profesional
                    </label>

                    <input
                        type="text"
                        id="cedula_prof"
                        name="cedula_prof"
                        maxlength="30"
                        value="<?php echo htmlspecialchars($doctor["cedula_prof"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="telefono">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        maxlength="20"
                        value="<?php echo htmlspecialchars($doctor["telefono"]); ?>"
                        required
                    >

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Actualizar doctor
                    </button>

                    <a
                        href="index.php"
                        class="boton-cancelar"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </section>

    </main>

</body>

</html>