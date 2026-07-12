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

    <title>Agregar habitación | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Registrar habitación</h1>

            <p>
                Completa los datos de la nueva habitación.
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

                    <label for="numero">
                        Número de habitación
                    </label>

                    <input
                        type="text"
                        id="numero"
                        name="numero"
                        maxlength="10"
                        placeholder="Ejemplo: 101"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="tipo">
                        Tipo
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        required
                    >

                        <option value="">
                            Selecciona un tipo
                        </option>

                        <option value="Individual">
                            Individual
                        </option>

                        <option value="Doble">
                            Doble
                        </option>

                        <option value="Suite">
                            Suite
                        </option>

                    </select>

                </div>

                <div class="grupo-formulario">

                    <label for="estado">
                        Estado
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        required
                    >

                        <option value="">
                            Selecciona un estado
                        </option>

                        <option value="Disponible">
                            Disponible
                        </option>

                        <option value="Ocupada">
                            Ocupada
                        </option>

                        <option value="Mantenimiento">
                            Mantenimiento
                        </option>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Guardar habitación
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