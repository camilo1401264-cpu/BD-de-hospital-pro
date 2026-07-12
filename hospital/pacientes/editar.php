<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM pacientes WHERE id_paciente = ?";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param($consulta, "i", $id);
mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);
$paciente = mysqli_fetch_assoc($resultado);

if (!$paciente) {
    die("Paciente no encontrado.");
}

$fechaIngreso = date(
    "Y-m-d\TH:i",
    strtotime($paciente["fecha_ingreso"])
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

    <title>Editar paciente | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >
</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>
            <h1>Editar paciente</h1>

            <p>
                Modifica los datos del paciente seleccionado.
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
                    name="id_paciente"
                    value="<?php echo $paciente["id_paciente"]; ?>"
                >

                <div class="grupo-formulario">

                    <label for="nombre">
                        Nombre
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="<?php echo htmlspecialchars($paciente["nombre"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="apellido">
                        Apellido
                    </label>

                    <input
                        type="text"
                        id="apellido"
                        name="apellido"
                        value="<?php echo htmlspecialchars($paciente["apellido"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="fecha_nacimiento">
                        Fecha de nacimiento
                    </label>

                    <input
                        type="date"
                        id="fecha_nacimiento"
                        name="fecha_nacimiento"
                        value="<?php echo htmlspecialchars($paciente["fecha_nacimiento"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="edad">
                        Edad
                    </label>

                    <input
                        type="number"
                        id="edad"
                        name="edad"
                        min="0"
                        max="120"
                        value="<?php echo $paciente["edad"]; ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="sexo">
                        Sexo
                    </label>

                    <select
                        id="sexo"
                        name="sexo"
                        required
                    >

                        <option
                            value="Masculino"
                            <?php echo $paciente["sexo"] === "Masculino" ? "selected" : ""; ?>
                        >
                            Masculino
                        </option>

                        <option
                            value="Femenino"
                            <?php echo $paciente["sexo"] === "Femenino" ? "selected" : ""; ?>
                        >
                            Femenino
                        </option>

                        <option
                            value="Otro"
                            <?php echo $paciente["sexo"] === "Otro" ? "selected" : ""; ?>
                        >
                            Otro
                        </option>

                    </select>

                </div>

                <div class="grupo-formulario">

                    <label for="telefono">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        value="<?php echo htmlspecialchars($paciente["telefono"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario ancho-completo">

                    <label for="direccion">
                        Dirección
                    </label>

                    <input
                        type="text"
                        id="direccion"
                        name="direccion"
                        value="<?php echo htmlspecialchars($paciente["direccion"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario ancho-completo">

                    <label for="diagnostico">
                        Diagnóstico
                    </label>

                    <textarea
                        id="diagnostico"
                        name="diagnostico"
                        rows="4"
                        required
                    ><?php echo htmlspecialchars($paciente["diagnostico"]); ?></textarea>

                </div>

                <div class="grupo-formulario">

                    <label for="fecha_ingreso">
                        Fecha y hora de ingreso
                    </label>

                    <input
                        type="datetime-local"
                        id="fecha_ingreso"
                        name="fecha_ingreso"
                        value="<?php echo $fechaIngreso; ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="tipo_sangre">
                        Tipo de sangre
                    </label>

                    <select
                        id="tipo_sangre"
                        name="tipo_sangre"
                        required
                    >

                        <?php

                        $tiposSangre = [
                            "A+",
                            "A-",
                            "B+",
                            "B-",
                            "AB+",
                            "AB-",
                            "O+",
                            "O-"
                        ];

                        foreach ($tiposSangre as $tipo):

                        ?>

                            <option
                                value="<?php echo $tipo; ?>"
                                <?php echo $paciente["tipo_sangre"] === $tipo ? "selected" : ""; ?>
                            >
                                <?php echo $tipo; ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Actualizar paciente
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