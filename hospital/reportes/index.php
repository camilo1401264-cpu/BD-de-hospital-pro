<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

/*
Solo el administrador puede consultar los reportes.
*/
if (
    !isset($_SESSION["rol"]) ||
    $_SESSION["rol"] !== "Administrador"
) {
    die("No tienes permiso para consultar los reportes.");
}

require_once "../conexion/conexion.php";

/*
CONSULTA 1:
Mostrar todas las citas con el nombre
del paciente y del médico.
*/
$sqlCitas = "SELECT
                c.id_cita,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor,
                d.especialidad,
                h.numero AS numero_habitacion,
                c.fecha_cita,
                c.motivo,
                c.estado
            FROM citas c
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor
            INNER JOIN habitaciones h
                ON c.id_habitacion = h.id_habitacion
            ORDER BY c.id_cita ASC";

$citas = mysqli_query($conexion, $sqlCitas);

if (!$citas) {
    die(
        "Error en la consulta de citas: " .
        mysqli_error($conexion)
    );
}

/*
CONSULTA 2:
Mostrar habitaciones ocupadas
con el paciente asignado.

La relación se obtiene mediante la tabla citas,
porque citas contiene id_habitacion e id_paciente.
*/
$sqlHabitaciones = "SELECT DISTINCT
                        h.id_habitacion,
                        h.numero,
                        h.tipo,
                        h.estado,
                        p.id_paciente,
                        p.nombre AS nombre_paciente,
                        p.apellido AS apellido_paciente,
                        c.fecha_cita
                    FROM habitaciones h
                    INNER JOIN citas c
                        ON h.id_habitacion = c.id_habitacion
                    INNER JOIN pacientes p
                        ON c.id_paciente = p.id_paciente
                    WHERE h.estado = 'Ocupada'
                    ORDER BY h.numero ASC";

$habitaciones = mysqli_query(
    $conexion,
    $sqlHabitaciones
);

if (!$habitaciones) {
    die(
        "Error en la consulta de habitaciones: " .
        mysqli_error($conexion)
    );
}

/*
CONSULTA 3:
Mostrar todas las citas programadas.
*/
$sqlProgramadas = "SELECT
                        c.id_cita,
                        p.nombre AS nombre_paciente,
                        p.apellido AS apellido_paciente,
                        d.nombre AS nombre_doctor,
                        d.apellido AS apellido_doctor,
                        d.especialidad,
                        h.numero AS numero_habitacion,
                        c.fecha_cita,
                        c.motivo,
                        c.estado
                    FROM citas c
                    INNER JOIN pacientes p
                        ON c.id_paciente = p.id_paciente
                    INNER JOIN doctores d
                        ON c.id_doctor = d.id_doctor
                    INNER JOIN habitaciones h
                        ON c.id_habitacion = h.id_habitacion
                    WHERE c.estado = 'Programada'
                    ORDER BY c.fecha_cita ASC";

$programadas = mysqli_query(
    $conexion,
    $sqlProgramadas
);

if (!$programadas) {
    die(
        "Error en la consulta de citas programadas: " .
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

    <title>
        Consultas JOIN | Hospital SaMy
    </title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>
                Consultas de múltiples tablas
            </h1>

            <p>
                Información relacionada mediante
                consultas INNER JOIN.
            </p>

        </div>

        <a
            href="../panel.php"
            class="boton-regresar"
        >
            ← Volver al panel
        </a>

    </header>

    <main class="contenido-crud contenido-reportes">

        <!-- CONSULTA 1 -->

        <section class="seccion-reporte">

            <div class="encabezado-reporte">

                <div>

                    <span class="numero-consulta">
                        Consulta 1
                    </span>

                    <h2>
                        Todas las citas
                    </h2>

                    <p>
                        Citas relacionadas con pacientes,
                        doctores y habitaciones.
                    </p>

                </div>

                <span class="contador-reporte">

                    <?php
                    echo mysqli_num_rows($citas);
                    ?>
                    resultados

                </span>

            </div>

            <div class="contenedor-tabla">

                <table class="tabla-pacientes">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Especialidad</th>
                            <th>Habitación</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($citas) > 0): ?>

                            <?php while ($fila = mysqli_fetch_assoc($citas)): ?>

                                <tr>

                                    <td>
                                        <?php echo $fila["id_cita"]; ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["nombre_paciente"] .
                                            " " .
                                            $fila["apellido_paciente"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        Dr.
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["nombre_doctor"] .
                                            " " .
                                            $fila["apellido_doctor"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["especialidad"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["numero_habitacion"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo date(
                                            "d/m/Y h:i a",
                                            strtotime(
                                                $fila["fecha_cita"]
                                            )
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["motivo"]
                                        );
                                        ?>
                                    </td>

                                    <td>

                                        <span class="estado-cita estado-<?php echo strtolower($fila["estado"]); ?>">

                                            <?php
                                            echo htmlspecialchars(
                                                $fila["estado"]
                                            );
                                            ?>

                                        </span>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="sin-resultados"
                                >
                                    No hay citas registradas.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

        <!-- CONSULTA 2 -->

        <section class="seccion-reporte">

            <div class="encabezado-reporte">

                <div>

                    <span class="numero-consulta">
                        Consulta 2
                    </span>

                    <h2>
                        Habitaciones ocupadas
                    </h2>

                    <p>
                        Habitaciones ocupadas relacionadas
                        con el paciente asignado.
                    </p>

                </div>

                <span class="contador-reporte">

                    <?php
                    echo mysqli_num_rows($habitaciones);
                    ?>
                    resultados

                </span>

            </div>

            <div class="contenedor-tabla">

                <table class="tabla-pacientes">

                    <thead>

                        <tr>
                            <th>ID habitación</th>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>ID paciente</th>
                            <th>Paciente</th>
                            <th>Fecha relacionada</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($habitaciones) > 0): ?>

                            <?php while ($fila = mysqli_fetch_assoc($habitaciones)): ?>

                                <tr>

                                    <td>
                                        <?php
                                        echo $fila["id_habitacion"];
                                        ?>
                                    </td>

                                    <td>
                                        Habitación
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["numero"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["tipo"]
                                        );
                                        ?>
                                    </td>

                                    <td>

                                        <span class="estado-habitacion-ocupada">
                                            Ocupada
                                        </span>

                                    </td>

                                    <td>
                                        <?php
                                        echo $fila["id_paciente"];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["nombre_paciente"] .
                                            " " .
                                            $fila["apellido_paciente"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo date(
                                            "d/m/Y h:i a",
                                            strtotime(
                                                $fila["fecha_cita"]
                                            )
                                        );
                                        ?>
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="7"
                                    class="sin-resultados"
                                >
                                    No existen habitaciones ocupadas
                                    con pacientes relacionados.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

        <!-- CONSULTA 3 -->

        <section class="seccion-reporte">

            <div class="encabezado-reporte">

                <div>

                    <span class="numero-consulta">
                        Consulta 3
                    </span>

                    <h2>
                        Citas programadas
                    </h2>

                    <p>
                        Lista de las citas cuyo estado
                        es Programada.
                    </p>

                </div>

                <span class="contador-reporte">

                    <?php
                    echo mysqli_num_rows($programadas);
                    ?>
                    resultados

                </span>

            </div>

            <div class="contenedor-tabla">

                <table class="tabla-pacientes">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Especialidad</th>
                            <th>Habitación</th>
                            <th>Fecha</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($programadas) > 0): ?>

                            <?php while ($fila = mysqli_fetch_assoc($programadas)): ?>

                                <tr>

                                    <td>
                                        <?php
                                        echo $fila["id_cita"];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["nombre_paciente"] .
                                            " " .
                                            $fila["apellido_paciente"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        Dr.
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["nombre_doctor"] .
                                            " " .
                                            $fila["apellido_doctor"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["especialidad"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["numero_habitacion"]
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo date(
                                            "d/m/Y h:i a",
                                            strtotime(
                                                $fila["fecha_cita"]
                                            )
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo htmlspecialchars(
                                            $fila["motivo"]
                                        );
                                        ?>
                                    </td>

                                    <td>

                                        <span class="estado-cita estado-programada">
                                            Programada
                                        </span>

                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="sin-resultados"
                                >
                                    No existen citas programadas.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>

</html>