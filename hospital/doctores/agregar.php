<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
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

    <title>Agregar doctor | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Registrar doctor</h1>

            <p>
                Completa los datos del nuevo doctor.
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
                action="guardar.php"
                method="POST"
                class="formulario-paciente"
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
                        required
                    >

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Guardar doctor
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