<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$busqueda = trim($_GET["buscar"] ?? "");

if ($busqueda !== "") {

    $sql = "SELECT *
            FROM habitaciones
            WHERE id_habitacion = ?
               OR numero LIKE ?
               OR tipo LIKE ?
               OR estado LIKE ?
            ORDER BY id_habitacion ASC";

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

    $sql = "SELECT *
            FROM habitaciones
            ORDER BY id_habitacion ASC";

    $resultado = mysqli_query($conexion, $sql);
}

if (!$resultado) {
    die(
        "Error al consultar las habitaciones: " .
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

    <title>Habitaciones | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Gestión de habitaciones</h1>

            <p>
                Registrar, consultar, modificar y eliminar habitaciones.
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
                + Agregar habitación
            </a>

            <form
                action="index.php"
                method="GET"
                class="formulario-busqueda"
            >

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar por ID, número, tipo o estado"
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
                        <th>ID</th>
                        <th>Número</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($resultado) > 0): ?>

                        <?php while ($habitacion = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php
                                    echo $habitacion["id_habitacion"];
                                    ?>
                                </td>

                                <td>

                                    <strong>
                                        Habitación
                                        <?php
                                        echo htmlspecialchars(
                                            $habitacion["numero"]
                                        );
                                        ?>
                                    </strong>

                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $habitacion["tipo"]
                                    );
                                    ?>
                                </td>

                                <td>

                                    <span class="estado-habitacion estado-<?php echo strtolower($habitacion["estado"]); ?>">

                                        <?php
                                        echo htmlspecialchars(
                                            $habitacion["estado"]
                                        );
                                        ?>

                                    </span>

                                </td>

                                <td class="acciones-tabla">

                                    <a
                                        href="editar.php?id=<?php echo $habitacion["id_habitacion"]; ?>"
                                        class="boton-editar"
                                    >
                                        Editar
                                    </a>

                                    <?php if ($_SESSION["rol"] === "Administrador"): ?>

                                        <a
                                            href="eliminar.php?id=<?php echo $habitacion["id_habitacion"]; ?>"
                                            class="boton-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta habitación?');"
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
                                colspan="5"
                                class="sin-resultados"
                            >
                                No se encontraron habitaciones.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>