<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$idReceta = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idReceta <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT *
        FROM recetas
        WHERE id_receta = ?";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "i",
    $idReceta
);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

$receta = mysqli_fetch_assoc($resultado);

if (!$receta) {
    die("La receta no fue encontrada.");
}

$sqlCitas = "SELECT
                c.id_cita,
                c.fecha_cita,
                c.estado,
                p.nombre AS nombre_paciente,
                p.apellido AS apellido_paciente,
                d.nombre AS nombre_doctor,
                d.apellido AS apellido_doctor
            FROM citas c
            INNER JOIN pacientes p
                ON c.id_paciente = p.id_paciente
            INNER JOIN doctores d
                ON c.id_doctor = d.id_doctor
            ORDER BY c.fecha_cita DESC";

$citas = mysqli_query($conexion, $sqlCitas);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar receta | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Editar receta médica</h1>

            <p>
                Modifica el tratamiento indicado.
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
                    name="id_receta"
                    value="<?php echo $receta["id_receta"]; ?>"
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

                        <?php while ($cita = mysqli_fetch_assoc($citas)): ?>

                            <option
                                value="<?php echo $cita["id_cita"]; ?>"
                                <?php
                                echo $receta["id_cita"] == $cita["id_cita"]
                                    ? "selected"
                                    : "";
                                ?>
                            >

                                Cita #<?php echo $cita["id_cita"]; ?>

                                -

                                <?php
                                echo htmlspecialchars(
                                    $cita["nombre_paciente"] . " " .
                                    $cita["apellido_paciente"]
                                );
                                ?>

                                -

                                Dr.
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

                            </option>

                        <?php endwhile; ?>

                    </select>

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
                        value="<?php echo htmlspecialchars($receta["medicamento"]); ?>"
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
                        value="<?php echo htmlspecialchars($receta["dosis"]); ?>"
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
                        required
                    ><?php echo htmlspecialchars($receta["indicaciones"]); ?></textarea>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Actualizar receta
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