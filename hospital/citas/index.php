<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$busqueda = trim($_GET["buscar"] ?? "");

if ($busqueda !== "") {

    $sql = "SELECT
                c.id_cita,
                c.fecha_cita,
                c.motivo,
                c.estado,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor,
                d.especialidad,
                h.numero AS numero_habitacion,
                h.tipo AS tipo_habitacion
            FROM citas c
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor
            INNER JOIN habitaciones h
                ON c.id_habitacion = h.id_habitacion
            WHERE c.id_cita = ?
               OR CONCAT(p.nombre, ' ', p.apellido) LIKE ?
               OR CONCAT(d.nombre, ' ', d.apellido) LIKE ?
               OR c.motivo LIKE ?
            ORDER BY id_cita ASC";

    $consulta = mysqli_prepare($conexion, $sql);

    $idBusqueda = is_numeric($busqueda) ? (int) $busqueda : 0;
    $textoBusqueda = "%" . $busqueda . "%";

    mysqli_stmt_bind_param(
        $consulta,
        "isss",
        $idBusqueda,
        $textoBusqueda,
        $textoBusqueda,
        $textoBusqueda
    );

    mysqli_stmt_execute($consulta);
    $resultado = mysqli_stmt_get_result($consulta);

} else {

    $sql = "SELECT
                c.id_cita,
                c.fecha_cita,
                c.motivo,
                c.estado,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor,
                d.especialidad,
                h.numero AS numero_habitacion,
                h.tipo AS tipo_habitacion
            FROM citas c
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor
            INNER JOIN habitaciones h
                ON c.id_habitacion = h.id_habitacion
            ORDER BY id_cita ASC";

    $resultado = mysqli_query($conexion, $sql);
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

    <title>Citas | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Gestión de citas médicas</h1>

            <p>
                Registrar, consultar, modificar y eliminar citas.
            </p>
        </div>

        <a
            href="../panel.php"
            class="boton-regresar"
        >
            ← Volver al panel
        </a>

    </header>

    <main class="contenido-crud">

        <section class="barra-acciones">

            <a
                href="agregar.php"
                class="boton-agregar"
            >
                + Registrar cita
            </a>

            <form
                action="index.php"
                method="GET"
                class="formulario-busqueda"
            >

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar por ID, paciente, doctor o motivo"
                    value="<?php echo htmlspecialchars($busqueda); ?>"
                >

                <button type="submit">
                    Buscar
                </button>

                <?php if ($busqueda !== ""): ?>

                    <a
                        href="index.php"
                        class="boton-limpiar"
                    >
                        Mostrar todas
                    </a>

                <?php endif; ?>

            </form>

        </section>

        <?php if (isset($_GET["mensaje"])): ?>

            <div class="mensaje-exito">
                <?php echo htmlspecialchars($_GET["mensaje"]); ?>
            </div>

        <?php endif; ?>

        <section class="contenedor-tabla">

            <table class="tabla-pacientes">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Habitación</th>
                        <th>Fecha y hora</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>

                        <?php while ($cita = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php echo $cita["id_cita"]; ?>
                                </td>

                                <td>
                                    <strong>
                                        <?php
                                        echo htmlspecialchars(
                                            $cita["nombre_paciente"] . " " .
                                            $cita["apellido_paciente"]
                                        );
                                        ?>
                                    </strong>
                                </td>

                                <td>
                                    <strong>
                                        Dr. <?php
                                        echo htmlspecialchars(
                                            $cita["nombre_doctor"] . " " .
                                            $cita["apellido_doctor"]
                                        );
                                        ?>
                                    </strong>

                                    <small>
                                        <?php
                                        echo htmlspecialchars(
                                            $cita["especialidad"]
                                        );
                                        ?>
                                    </small>
                                </td>

                                <td>
                                    Habitación
                                    <?php
                                    echo htmlspecialchars(
                                        $cita["numero_habitacion"]
                                    );
                                    ?>

                                    <small>
                                        <?php
                                        echo htmlspecialchars(
                                            $cita["tipo_habitacion"]
                                        );
                                        ?>
                                    </small>
                                </td>

                                <td>
                                    <?php
                                    echo date(
                                        "d/m/Y h:i a",
                                        strtotime($cita["fecha_cita"])
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $cita["motivo"]
                                    );
                                    ?>
                                </td>

                                <td>

                                    <span class="estado-cita estado-<?php echo strtolower($cita["estado"]); ?>">

                                        <?php
                                        echo htmlspecialchars(
                                            $cita["estado"]
                                        );
                                        ?>

                                    </span>

                                </td>

                                <td class="acciones-tabla">

                                    <a
                                        href="editar.php?id=<?php echo $cita["id_cita"]; ?>"
                                        class="boton-editar"
                                    >
                                        Editar
                                    </a>

                                    <?php if ($_SESSION["rol"] === "Administrador"): ?>

                                        <a
                                            href="eliminar.php?id=<?php echo $cita["id_cita"]; ?>"
                                            class="boton-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta cita?');"
                                        >
                                            Eliminar
                                        </a>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="8"
                                class="sin-resultados"
                            >
                                No se encontraron citas.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>