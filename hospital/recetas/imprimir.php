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

$sql = "SELECT
            r.id_receta,
            r.medicamento,
            r.dosis,
            r.indicaciones,

            c.id_cita,
            c.fecha_cita,
            c.motivo,
            c.estado AS estado_cita,

            p.id_paciente,
            p.nombre AS nombre_paciente,
            p.apellido AS apellido_paciente,
            p.edad,
            p.sexo,
            p.telefono,
            p.direccion,
            p.diagnostico,
            p.tipo_sangre,
            p.fecha_nacimiento,

            d.id_doctor,
            d.nombre AS nombre_doctor,
            d.apellido AS apellido_doctor,
            d.especialidad,
            d.cedula_prof,
            d.telefono AS telefono_doctor

        FROM recetas r

        INNER JOIN citas c
            ON r.id_cita = c.id_cita

        INNER JOIN pacientes p
            ON c.id_paciente = p.id_paciente

        INNER JOIN doctores d
            ON c.id_doctor = d.id_doctor

        WHERE r.id_receta = ?";

$consulta = mysqli_prepare($conexion, $sql);

if (!$consulta) {
    die(
        "Error al preparar la consulta: " .
        mysqli_error($conexion)
    );
}

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

date_default_timezone_set("America/Mexico_City");

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
        Receta médica #<?php echo $receta["id_receta"]; ?>
    </title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-impresion">

    <div class="acciones-impresion">

        <a
            href="index.php"
            class="boton-volver-receta"
        >
            ← Volver
        </a>

        <button
            type="button"
            class="boton-imprimir-receta"
            onclick="window.print()"
        >
            Imprimir receta
        </button>

    </div>

    <main class="hoja-receta">

        <header class="encabezado-receta">

            <div class="logo-receta">
                ♡
            </div>

            <div class="titulo-receta">

                <h1>
                    Hospital SaMy Salud Integral
                </h1>

                <p>
                    Receta médica
                </p>

            </div>

            <div class="folio-receta">

                <strong>
                    Folio:
                </strong>

                <span>
                    #<?php echo $receta["id_receta"]; ?>
                </span>

                <small>
                    <?php echo date("d/m/Y"); ?>
                </small>

            </div>

        </header>

        <section class="datos-medico-receta">

            <h2>
                Datos del médico
            </h2>

            <div class="rejilla-datos-receta">

                <div>

                    <span>
                        Médico
                    </span>

                    <strong>
                        Dr.
                        <?php
                        echo htmlspecialchars(
                            $receta["nombre_doctor"] . " " .
                            $receta["apellido_doctor"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Especialidad
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["especialidad"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Cédula profesional
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["cedula_prof"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Teléfono
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["telefono_doctor"]
                        );
                        ?>
                    </strong>

                </div>

            </div>

        </section>

        <section class="datos-paciente-receta">

            <h2>
                Datos del paciente
            </h2>

            <div class="rejilla-datos-receta">

                <div>

                    <span>
                        Nombre
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["nombre_paciente"] . " " .
                            $receta["apellido_paciente"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Edad
                    </span>

                    <strong>
                        <?php echo $receta["edad"]; ?> años
                    </strong>

                </div>

                <div>

                    <span>
                        Sexo
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["sexo"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Tipo de sangre
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["tipo_sangre"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Fecha de nacimiento
                    </span>

                    <strong>
                        <?php
                        echo date(
                            "d/m/Y",
                            strtotime(
                                $receta["fecha_nacimiento"]
                            )
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Teléfono
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["telefono"]
                        );
                        ?>
                    </strong>

                </div>

                <div class="dato-completo-receta">

                    <span>
                        Dirección
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["direccion"]
                        );
                        ?>
                    </strong>

                </div>

            </div>

        </section>

        <section class="datos-consulta-receta">

            <h2>
                Información de la consulta
            </h2>

            <div class="rejilla-datos-receta">

                <div>

                    <span>
                        Número de cita
                    </span>

                    <strong>
                        #<?php echo $receta["id_cita"]; ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Fecha de la cita
                    </span>

                    <strong>
                        <?php
                        echo date(
                            "d/m/Y h:i a",
                            strtotime(
                                $receta["fecha_cita"]
                            )
                        );
                        ?>
                    </strong>

                </div>

                <div class="dato-completo-receta">

                    <span>
                        Motivo
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["motivo"]
                        );
                        ?>
                    </strong>

                </div>

                <div class="dato-completo-receta">

                    <span>
                        Diagnóstico
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["diagnostico"]
                        );
                        ?>
                    </strong>

                </div>

            </div>

        </section>

        <section class="tratamiento-receta">

            <h2>
                Tratamiento indicado
            </h2>

            <div class="medicamento-receta">

                <div>

                    <span>
                        Medicamento
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["medicamento"]
                        );
                        ?>
                    </strong>

                </div>

                <div>

                    <span>
                        Dosis
                    </span>

                    <strong>
                        <?php
                        echo htmlspecialchars(
                            $receta["dosis"]
                        );
                        ?>
                    </strong>

                </div>

            </div>

            <div class="indicaciones-receta">

                <span>
                    Indicaciones
                </span>

                <p>
                    <?php
                    echo nl2br(
                        htmlspecialchars(
                            $receta["indicaciones"]
                        )
                    );
                    ?>
                </p>

            </div>

        </section>

        <section class="firmas-receta">

            <div class="firma-receta">

                <div class="linea-firma"></div>

                <p>
                    Firma del médico
                </p>

                <strong>
                    Dr.
                    <?php
                    echo htmlspecialchars(
                        $receta["nombre_doctor"] . " " .
                        $receta["apellido_doctor"]
                    );
                    ?>
                </strong>

            </div>

            <div class="firma-receta">

                <div class="linea-firma"></div>

                <p>
                    Sello del hospital
                </p>

            </div>

        </section>

        <footer class="pie-receta">

            <p>
                Hospital SaMy Salud Integral
            </p>

            <p>
                Este documento contiene información médica
                de carácter confidencial.
            </p>

        </footer>

    </main>

</body>

</html>