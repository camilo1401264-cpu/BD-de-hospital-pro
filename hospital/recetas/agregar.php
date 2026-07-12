<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$sqlCitas = "SELECT
                c.id_cita,
                c.fecha_cita,
                c.estado,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor,
                d.especialidad
            FROM citas c
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor
            ORDER BY c.fecha_cita DESC";

$citas = mysqli_query($conexion, $sqlCitas);

if (!$citas) {
    die(
        "Error al consultar las citas: " .
        mysqli_error($conexion)
    );
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

    <title>Generar receta | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Generar receta médica</h1>

            <p>
                Selecciona una cita y captura el tratamiento.
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

            <?php if (mysqli_num_rows($citas) === 0): ?>

                <div class="mensaje-advertencia">

                    No hay citas registradas. Primero debes registrar
                    una cita médica.

                </div>

                <a
                    href="../citas/agregar.php"
                    class="boton-agregar"
                >
                    Registrar cita
                </a>

            <?php else: ?>

                <form
                    action="guardar.php"
                    method="POST"
                    class="formulario-paciente"
                >

                    <div class="grupo-formulario ancho-completo">

                        <label for="id_cita">
                            Cita médica
                        </label>

                        <select
                            id="id_cita"
                            name="id_cita"
                            required
                        >

                            <option value="">
                                Selecciona una cita
                            </option>

                            <?php while ($cita = mysqli_fetch_assoc($citas)): ?>

                                <option value="<?php echo $cita["id_cita"]; ?>">

                                    Cita #<?php echo $cita["id_cita"]; ?>

                                    -

                                    Paciente:
                                    <?php
                                    echo htmlspecialchars(
                                        $cita["nombre_paciente"] . " " .
                                        $cita["apellido_paciente"]
                                    );
                                    ?>

                                    -

                                    Doctor:
                                    <?php
                                    echo htmlspecialchars(
                                        $cita["nombre_doctor"] . " " .
                                        $cita["apellido_doctor"]
                                    );
                                    ?>

                                    -

                                    <?php
                                    echo date(
                                        "d/m/Y h:i a",
                                        strtotime($cita["fecha_cita"])
                                    );
                                    ?>

                                    -

                                    <?php
                                    echo htmlspecialchars($cita["estado"]);
                                    ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                        <small class="ayuda-formulario">
                            La cita contiene automáticamente los datos
                            del paciente y del médico.
                        </small>

                    </div>

                    <div class="grupo-formulario">

                        <label for="medicamento">
                            Medicamento
                        </label>

                        <input
                            type="text"
                            id="medicamento"
                            name="medicamento"
                            maxlength="100"
                            placeholder="Ejemplo: Paracetamol"
                            required
                        >

                    </div>

                    <div class="grupo-formulario">

                        <label for="dosis">
                            Dosis
                        </label>

                        <input
                            type="text"
                            id="dosis"
                            name="dosis"
                            maxlength="50"
                            placeholder="Ejemplo: 500 mg cada 8 horas"
                            required
                        >

                    </div>

                    <div class="grupo-formulario ancho-completo">

                        <label for="indicaciones">
                            Indicaciones
                        </label>

                        <textarea
                            id="indicaciones"
                            name="indicaciones"
                            rows="6"
                            maxlength="255"
                            placeholder="Escribe las indicaciones del tratamiento"
                            required
                        ></textarea>

                    </div>

                    <div class="acciones-formulario ancho-completo">

                        <button
                            type="submit"
                            class="boton-guardar"
                        >
                            Guardar receta
                        </button>

                        <a
                            href="index.php"
                            class="boton-cancelar"
                        >
                            Cancelar
                        </a>

                    </div>

                </form>

            <?php endif; ?>

        </section>

    </main>

</body>

</html>