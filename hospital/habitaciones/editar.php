<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login/login.php");
    exit();
}

require_once "../conexion/conexion.php";

$idHabitacion = isset($_GET["id"])
    ? (int) $_GET["id"]
    : 0;

if ($idHabitacion <= 0) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT *
        FROM habitaciones
        WHERE id_habitacion = ?";

$consulta = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $consulta,
    "i",
    $idHabitacion
);

mysqli_stmt_execute($consulta);

$resultado = mysqli_stmt_get_result($consulta);

$habitacion = mysqli_fetch_assoc($resultado);

if (!$habitacion) {
    die("La habitación no fue encontrada.");
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

    <title>Editar habitación | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="../css/estilos.css"
    >

</head>

<body class="pagina-crud">

    <header class="cabecera-crud">

        <div>

            <h1>Editar habitación</h1>

            <p>
                Modifica los datos de la habitación seleccionada.
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
                    name="id_habitacion"
                    value="<?php echo $habitacion["id_habitacion"]; ?>"
                >

                <div class="grupo-formulario">

                    <label for="numero">
                        Número de habitación
                    </label>

                    <input
                        type="text"
                        id="numero"
                        name="numero"
                        maxlength="10"
                        value="<?php echo htmlspecialchars($habitacion["numero"]); ?>"
                        required
                    >

                </div>

                <div class="grupo-formulario">

                    <label for="tipo">
                        Tipo
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        required
                    >

                        <option
                            value="Individual"
                            <?php echo $habitacion["tipo"] === "Individual" ? "selected" : ""; ?>
                        >
                            Individual
                        </option>

                        <option
                            value="Doble"
                            <?php echo $habitacion["tipo"] === "Doble" ? "selected" : ""; ?>
                        >
                            Doble
                        </option>

                        <option
                            value="Suite"
                            <?php echo $habitacion["tipo"] === "Suite" ? "selected" : ""; ?>
                        >
                            Suite
                        </option>

                    </select>

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

                        <option
                            value="Disponible"
                            <?php echo $habitacion["estado"] === "Disponible" ? "selected" : ""; ?>
                        >
                            Disponible
                        </option>

                        <option
                            value="Ocupada"
                            <?php echo $habitacion["estado"] === "Ocupada" ? "selected" : ""; ?>
                        >
                            Ocupada
                        </option>

                        <option
                            value="Mantenimiento"
                            <?php echo $habitacion["estado"] === "Mantenimiento" ? "selected" : ""; ?>
                        >
                            Mantenimiento
                        </option>

                    </select>

                </div>

                <div class="acciones-formulario ancho-completo">

                    <button
                        type="submit"
                        class="boton-guardar"
                    >
                        Actualizar habitación
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