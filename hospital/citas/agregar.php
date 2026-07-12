<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$pacientes = mysqli_query(
    $conexion,
    "SELECT id_paciente, nombre, apellido
     FROM pacientes
     ORDER BY nombre, apellido"
);

$doctores = mysqli_query(
    $conexion,
    "SELECT id_doctor, nombre, apellido, especialidad
     FROM doctores
     ORDER BY nombre, apellido"
);

$habitaciones = mysqli_query(
    $conexion,
    "SELECT id_habitacion, numero, tipo, estado
     FROM habitaciones
     ORDER BY numero"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registrar cita | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Registrar cita médica</h1>

            <p>
                Selecciona al paciente, doctor y habitación.
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

                    <label for="id_paciente">
                        Paciente
                    </label>

                    <select
                        id="id_paciente"
                        name="id_paciente"
                        required
                    >

                        <option value="">
                            Selecciona un paciente
                        </option>

                        <?php while ($paciente = mysqli_fetch_assoc($pacientes)): ?>

                            <option value="<?php echo $paciente["id_paciente"]; ?>">

                                <?php
                                echo htmlspecialchars(
                                    $paciente["nombre"] . " " .
                                    $paciente["apellido"]
                                );
                                ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="grupo-formulario">

                    <label for="id_doctor">
                        Doctor
                    </label>

                    <select
                        id="id_doctor"
                        name="id_doctor"
                        required
                    >

                        <option value="">
                            Selecciona un doctor
                        </option>

                        <?php while ($doctor = mysqli_fetch_assoc($doctores)): ?>

                            <option value="<?php echo $doctor["id_doctor"]; ?>">

                                Dr.
                                <?php
                                echo htmlspecialchars(
                                    $doctor["nombre"] . " " .
                                    $doctor["apellido"] . " - " .
                                    $doctor["especialidad"]
                                );
                                ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="grupo-formulario">

                    <label for="id_habitacion">
                        Habitación
                    </label>

                    <select
                        id="id_habitacion"
                        name="id_habitacion"
                        required
                    >

                        <option value="">
                            Selecciona una habitación
                        </option>

                        <?php while ($habitacion = mysqli_fetch_assoc($habitaciones)): ?>

                            <option value="<?php echo $habitacion["id_habitacion"]; ?>">

                                Habitación
                                <?php
                                echo htmlspecialchars(
                                    $habitacion["numero"] . " - " .
                                    $habitacion["tipo"] . " - " .
                                    $habitacion["estado"]
                                );
                                ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="grupo-formulario">

                    <label for="fecha_cita">
                        Fecha y hora de la cita
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_cita"
                        name="fecha_cita"
                        required
                    >

                </div>

                <div class="grupo-formulario ancho-completo">

                    <label for="motivo">
                        Motivo de la cita
                    </label>

                    <textarea
                        id="motivo"
                        name="motivo"
                        rows="4"
                        maxlength="255"
                        placeholder="Describe el motivo de la consulta"
                        required
                    ></textarea>

                </div>

                <div class="grupo-formulario">

                    <label for="estado">
                        Estado de la cita
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        required
                    >

                        <option value="Programada">
                            Programada
                        </option>

                        <option value="Completada">
                            Completada
                        </option>

                        <option value="Cancelada">
                            Cancelada
                        </option>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Guardar cita
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