<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$busqueda = trim($_GET["buscar"] ?? "");

$sqlBase = "SELECT
                r.id_receta,
                r.medicamento,
                r.dosis,
                r.indicaciones,
                c.id_cita,
                c.fecha_cita,
                c.estado AS estado_cita,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor,
                d.especialidad
            FROM recetas r
            INNER JOIN citas c
                ON r.id_cita = c.id_cita
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor";

if ($busqueda !== "") {

    $sql = $sqlBase . "
            WHERE r.id_receta = ?
               OR r.medicamento LIKE ?
               OR CONCAT(p.nombre, ' ', p.apellido) LIKE ?
               OR CONCAT(d.nombre, ' ', d.apellido) LIKE ?
            ORDER BY id_receta ASC";

    $consulta = mysqli_prepare($conexion, $sql);

    $idBusqueda = is_numeric($busqueda)
        ? (int) $busqueda
        : 0;

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

    $sql = $sqlBase . "
            ORDER BY id_receta ASC";

    $resultado = mysqli_query($conexion, $sql);
}

if (!$resultado) {
    die(
        "Error al consultar las recetas: " .
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

    <title>Recetas | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Gestión de recetas médicas</h1>

            <p>
                Registrar, consultar, modificar y eliminar recetas.
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
                + Generar receta
            </a>

            <form
                action="index.php"
                method="GET"
                class="formulario-busqueda"
            >

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar por ID, paciente, doctor o medicamento"
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

                <?php
                echo htmlspecialchars($_GET["mensaje"]);
                ?>

            </div>

        <?php endif; ?>

        <section class="contenedor-tabla">

            <table class="tabla-pacientes">

                <thead>

                    <tr>
                        <th>ID receta</th>
                        <th>Cita</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Indicaciones</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($resultado) > 0): ?>

                        <?php while ($receta = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php echo $receta["id_receta"]; ?>
                                </td>

                                <td>

                                    <strong>
                                        Cita #<?php echo $receta["id_cita"]; ?>
                                    </strong>

                                    <small>
                                        <?php
                                        echo date(
                                            "d/m/Y h:i a",
                                            strtotime($receta["fecha_cita"])
                                        );
                                        ?>
                                    </small>

                                </td>

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $receta["nombre_paciente"] . " " .
                                        $receta["apellido_paciente"]
                                    );
                                    ?>

                                </td>

                                <td>

                                    <strong>
                                        Dr.
                                        <?php
                                        echo htmlspecialchars(
                                            $receta["nombre_doctor"] . " " .
                                            $receta["apellido_doctor"]
                                        );
                                        ?>
                                    </strong>

                                    <small>
                                        <?php
                                        echo htmlspecialchars(
                                            $receta["especialidad"]
                                        );
                                        ?>
                                    </small>

                                </td>

                                <td>

                                    <strong>
                                        <?php
                                        echo htmlspecialchars(
                                            $receta["medicamento"]
                                        );
                                        ?>
                                    </strong>

                                </td>

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $receta["dosis"]
                                    );
                                    ?>

                                </td>

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $receta["indicaciones"]
                                    );
                                    ?>

                                </td>

                                <td class="acciones-tabla">

    <a
        href="editar.php?id=<?php echo $receta["id_receta"]; ?>"
        class="boton-editar"
    >
        Editar
    </a>

    <a
        href="imprimir.php?id=<?php echo $receta["id_receta"]; ?>"
        class="boton-imprimir"
        target="_blank"
    >
        Imprimir
    </a>

    <?php if ($_SESSION["rol"] === "Administrador"): ?>

        <a
            href="eliminar.php?id=<?php echo $receta["id_receta"]; ?>"
            class="boton-eliminar"
            onclick="return confirm('¿Seguro que deseas eliminar esta receta?');"
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
                                No se encontraron recetas.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>