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
            FROM doctores
            WHERE id_doctor = ?
               OR nombre LIKE ?
               OR apellido LIKE ?
               OR especialidad LIKE ?
               OR cedula_prof LIKE ?
            ORDER BY id_doctor ASC";

    $consulta = mysqli_prepare($conexion, $sql);

    $idBusqueda = is_numeric($busqueda)
        ? (int) $busqueda
        : 0;

    $textoBusqueda = "%" . $busqueda . "%";

    mysqli_stmt_bind_param(
        $consulta,
        "issss",
        $idBusqueda,
        $textoBusqueda,
        $textoBusqueda,
        $textoBusqueda,
        $textoBusqueda
    );

    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);

} else {

    $sql = "SELECT *
            FROM doctores
            ORDER BY id_doctor ASC";

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

    <title>Doctores | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Gestión de doctores</h1>

            <p>
                Registrar, consultar, modificar y eliminar doctores.
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
                + Agregar doctor
            </a>

            <form
                action="index.php"
                method="GET"
                class="formulario-busqueda"
            >

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar por ID, nombre, especialidad o cédula"
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
                        Mostrar todos
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
                        <th>Doctor</th>
                        <th>Especialidad</th>
                        <th>Cédula profesional</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>

                        <?php while ($doctor = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php echo $doctor["id_doctor"]; ?>
                                </td>

                                <td>

                                    <strong>
                                        Dr.
                                        <?php
                                        echo htmlspecialchars(
                                            $doctor["nombre"] . " " .
                                            $doctor["apellido"]
                                        );
                                        ?>
                                    </strong>

                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $doctor["especialidad"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $doctor["cedula_prof"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $doctor["telefono"]
                                    );
                                    ?>
                                </td>

                                <td class="acciones-tabla">

                                    <a
                                        href="editar.php?id=<?php echo $doctor["id_doctor"]; ?>"
                                        class="boton-editar"
                                    >
                                        Editar
                                    </a>

                                    <?php if ($_SESSION["rol"] === "Administrador"): ?>

                                        <a
                                            href="eliminar.php?id=<?php echo $doctor["id_doctor"]; ?>"
                                            class="boton-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar este doctor?');"
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
                                colspan="6"
                                class="sin-resultados"
                            >
                                No se encontraron doctores.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>