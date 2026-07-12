<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$idCita = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idCita <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM citas WHERE id_cita = ?";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "i",
    $idCita
);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);
$cita = mysqli_fetch_assoc($resultado);

if (!$cita) {
    die("La cita no fue encontrada.");
}

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

$fechaCita = date(
    "Y-m-d\TH:i",
    strtotime($cita["fecha_cita"])
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

    <title>Editar cita | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Editar cita médica</h1>

            <p>
                Modifica los datos de la cita seleccionada.
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
                    name="id_cita"
                    value="<?php echo $cita["id_cita"]; ?>"
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

                        <?php while ($paciente = mysqli_fetch_assoc($pacientes)): ?>

                            <option
                                value="<?php echo $paciente["id_paciente"]; ?>"
                                <?php
                                echo $cita["id_paciente"] == $paciente["id_paciente"]
                                    ? "selected"
                                    : "";
                                ?>
                            >

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

                        <?php while ($doctor = mysqli_fetch_assoc($doctores)): ?>

                            <option
                                value="<?php echo $doctor["id_doctor"]; ?>"
                                <?php
                                echo $cita["id_doctor"] == $doctor["id_doctor"]
                                    ? "selected"
                                    : "";
                                ?>
                            >

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

                        <?php while ($habitacion = mysqli_fetch_assoc($habitaciones)): ?>

                            <option
                                value="<?php echo $habitacion["id_habitacion"]; ?>"
                                <?php
                                echo $cita["id_habitacion"] == $habitacion["id_habitacion"]
                                    ? "selected"
                                    : "";
                                ?>
                            >

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
                        Fecha y hora
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_cita"
                        name="fecha_cita"
                        value="<?php echo $fechaCita; ?>"
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
                        required
                    ><?php echo htmlspecialchars($cita["motivo"]); ?></textarea>

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

                        <?php

                        $estados = [
                            "Programada",
                            "Completada",
                            "Cancelada"
                        ];

                        foreach ($estados as $estado):

                        ?>

                            <option
                                value="<?php echo $estado; ?>"
                                <?php
                                echo $cita["estado"] === $estado
                                    ? "selected"
                                    : "";
                                ?>
                            >
                                <?php echo $estado; ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Actualizar cita
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