<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$busqueda = trim($_GET["buscar"] ?? "");

if ($busqueda !== "") {

    $sql = "SELECT * FROM pacientes
            WHERE id_paciente = ?
            OR nombre LIKE ?
            OR apellido LIKE ?
            ORDER BY id_paciente ASC";

    $consulta = mysqli_prepare($conexion, $sql);

    $textoBusqueda = "%" . $busqueda . "%";
    $idBusqueda = is_numeric($busqueda) ? (int) $busqueda : 0;

    mysqli_stmt_bind_param(
        $consulta,
        "iss",
        $idBusqueda,
        $textoBusqueda,
        $textoBusqueda
    );

    mysqli_stmt_execute($consulta);
    $resultado = mysqli_stmt_get_result($consulta);

} else {

    $sql = "SELECT * FROM pacientes
            ORDER BY id_paciente ASC";

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

    <title>Pacientes | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Gestión de pacientes</h1>

            <p>
                Registrar, consultar, modificar y eliminar pacientes.
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
                + Agregar paciente
            </a>

            <form
                action="index.php"
                method="GET"
                class="formulario-busqueda"
            >

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar por ID, nombre o apellido"
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
                <?php echo htmlspecialchars($_GET["mensaje"]); ?>
            </div>

        <?php endif; ?>

        <section class="contenedor-tabla">

            <table class="tabla-pacientes">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th>Diagnóstico</th>
                        <th>Tipo de sangre</th>
                        <th>Fecha de ingreso</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>

                        <?php while ($paciente = mysqli_fetch_assoc($resultado)): ?>

                            <tr>

                                <td>
                                    <?php echo $paciente["id_paciente"]; ?>
                                </td>

                                <td>
                                    <strong>
                                        <?php
                                        echo htmlspecialchars(
                                            $paciente["nombre"] . " " .
                                            $paciente["apellido"]
                                        );
                                        ?>
                                    </strong>

                                    <small>
                                        <?php
                                        echo htmlspecialchars(
                                            $paciente["direccion"]
                                        );
                                        ?>
                                    </small>
                                </td>

                                <td>
                                    <?php echo $paciente["edad"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($paciente["sexo"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($paciente["telefono"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($paciente["diagnostico"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($paciente["tipo_sangre"]); ?>
                                </td>

                                <td>
                                    <?php
                                    echo date(
                                        "d/m/Y",
                                        strtotime($paciente["fecha_ingreso"])
                                    );
                                    ?>
                                </td>

                                <td class="acciones-tabla">

                                    <a
                                        href="editar.php?id=<?php echo $paciente["id_paciente"]; ?>"
                                        class="boton-editar"
                                    >
                                        Editar
                                    </a>

                                    <?php if ($_SESSION["rol"] === "Administrador"): ?>

                                        <a
                                            href="eliminar.php?id=<?php echo $paciente["id_paciente"]; ?>"
                                            class="boton-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar este paciente?');"
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
                                colspan="9"
                                class="sin-resultados"
                            >
                                No se encontraron pacientes.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>