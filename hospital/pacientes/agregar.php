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

    <title>Agregar paciente | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Registrar paciente</h1>

            <p>
                Completa los datos del nuevo paciente.
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
                        maxlength="80"
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
                        maxlength="80"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="fecha_nacimiento">
                        Fecha de nacimiento
                    </label>

                    <input
                        type="date"
                        id="fecha_nacimiento"
                        name="fecha_nacimiento"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="edad">
                        Edad
                    </label>

                    <input
                        type="number"
                        id="edad"
                        name="edad"
                        min="0"
                        max="120"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="sexo">
                        Sexo
                    </label>

                    <select
                        id="sexo"
                        name="sexo"
                        required
                    >

                        <option value="">
                            Selecciona una opción
                        </option>

                        <option value="Masculino">
                            Masculino
                        </option>

                        <option value="Femenino">
                            Femenino
                        </option>

                        <option value="Otro">
                            Otro
                        </option>

                    </select>

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

                <div class="grupo-formulario ancho-completo">

                    <label for="direccion">
                        Dirección
                    </label>

                    <input
                        type="text"
                        id="direccion"
                        name="direccion"
                        maxlength="120"
                        required
                    >

                </div>

                <div class="grupo-formulario ancho-completo">

                    <label for="diagnostico">
                        Diagnóstico
                    </label>

                    <textarea
                        id="diagnostico"
                        name="diagnostico"
                        maxlength="120"
                        rows="4"
                        required
                    ></textarea>

                </div>

                <div class="grupo-formulario">

                    <label for="fecha_ingreso">
                        Fecha y hora de ingreso
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_ingreso"
                        name="fecha_ingreso"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="tipo_sangre">
                        Tipo de sangre
                    </label>

                    <select
                        id="tipo_sangre"
                        name="tipo_sangre"
                        required
                    >

                        <option value="">
                            Selecciona una opción
                        </option>

                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Guardar paciente
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