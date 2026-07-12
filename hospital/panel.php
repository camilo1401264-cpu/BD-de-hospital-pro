<?php

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_SESSION["rol"])) {
    header("Location: login/login.php");
    exit();
}

require_once "conexion/conexion.php";

date_default_timezone_set("America/Mexico_City");

$usuario = $_SESSION["usuario"];
$rol = $_SESSION["rol"];

$meses = [
    1 => "enero",
    2 => "febrero",
    3 => "marzo",
    4 => "abril",
    5 => "mayo",
    6 => "junio",
    7 => "julio",
    8 => "agosto",
    9 => "septiembre",
    10 => "octubre",
    11 => "noviembre",
    12 => "diciembre"
];

$fechaActual = date("d") . " de " .
               $meses[(int) date("n")] . " de " .
               date("Y");

$esAdministrador = $rol === "Administrador";
$esMedico = $rol === "Medico";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Panel principal | Hospital SaMy</title>

    <link
        rel="stylesheet"
        href="css/estilos.css"
    >
</head>

<body class="pagina-panel">

    <!-- ENCABEZADO -->

    <header class="cabecera-principal">

        <div class="marca-hospital">

            <div class="logo-hospital">
                ♡
            </div>

            <div>
                <h1>Hospital SaMy</h1>
                <p>Salud Integral</p>
            </div>

        </div>

        <div class="datos-cabecera">

            <div class="fecha-cabecera">
                <span class="icono-cabecera">▣</span>

                <span>
                    <?php echo htmlspecialchars($fechaActual); ?>
                </span>
            </div>

            <div class="separador-cabecera"></div>

            <div class="usuario-cabecera">

                <span class="avatar-usuario">●</span>

                <div>
                    <p>
                        Usuario:
                        <strong>
                            <?php echo htmlspecialchars($usuario); ?>
                        </strong>
                    </p>

                    <p>
                        Rol:
                        <strong>
                            <?php echo htmlspecialchars($rol); ?>
                        </strong>
                    </p>
                </div>

            </div>

            <a
                class="boton-cerrar"
                href="login/cerrar_sesion.php"
            >
                ↪ Cerrar sesión
            </a>

        </div>

    </header>

    <!-- MENÚ -->

    <nav class="menu-principal">

        <a
            href="panel.php"
            class="menu-activo"
        >
            <span>⌂</span>
            Inicio
        </a>

        <a href="pacientes/">
            <span>♟</span>
            Pacientes
        </a>

        <?php if ($esAdministrador): ?>

            <a href="doctores/">
                <span>♧</span>
                Doctores
            </a>

            <a href="habitaciones/">
                <span>▰</span>
                Habitaciones
            </a>

        <?php endif; ?>

        <a href="citas/">
            <span>▣</span>
            Citas
        </a>

        <a href="recetas/">
            <span>▤</span>
            Recetas
        </a>

        <?php if ($esAdministrador): ?>

            <a href="reportes/">
                <span>▥</span>
                Reportes
            </a>

        <?php endif; ?>

    </nav>

    <!-- CONTENIDO PRINCIPAL -->

    <main class="contenido-panel">

        <!-- BIENVENIDA -->

        <section class="seccion-bienvenida">

            <div class="texto-bienvenida">

                <h2>Bienvenido al sistema</h2>

                <p class="texto-rol">
                    Has iniciado sesión como

                    <span class="etiqueta-rol">
                        <?php
                        echo $esAdministrador
                            ? "Administrador"
                            : "Médico";
                        ?>
                    </span>
                </p>

                <div class="linea-decorativa"></div>

                <?php if ($esAdministrador): ?>

                    <p class="descripcion-bienvenida">
                        Tienes acceso completo a los módulos,
                        operaciones CRUD y reportes del sistema.
                    </p>

                <?php else: ?>

                    <p class="descripcion-bienvenida">
                        Puedes consultar pacientes, registrar citas
                        y emitir recetas médicas.
                    </p>

                <?php endif; ?>

            </div>

            <div class="imagen-hospital">

                <div class="simbolo-medico">
                    ♡
                </div>

                <div class="simbolo-estetoscopio">
                    ♧
                </div>

            </div>

        </section>

        <div class="distribucion-panel">

            <!-- MÓDULOS -->

            <section class="contenedor-modulos">

                <div class="titulo-seccion">

                    <span class="icono-titulo">▦</span>

                    <h2>
                        <?php
                        echo $esAdministrador
                            ? "Módulos del sistema"
                            : "Módulos disponibles para usted";
                        ?>
                    </h2>

                </div>

                <div class="rejilla-modulos">

                    <!-- PACIENTES -->

                    <article class="tarjeta-modulo">

                        <div class="icono-modulo">
                            ♟
                        </div>

                        <div class="informacion-modulo">

                            <h3>Pacientes</h3>

                            <p>
                                <?php
                                echo $esAdministrador
                                    ? "Gestión y administración de pacientes del hospital."
                                    : "Consulta la información de los pacientes.";
                                ?>
                            </p>

                            <a href="pacientes/">
                                Ir al módulo
                                <span>›</span>
                            </a>

                        </div>

                    </article>

                    <!-- DOCTORES -->

                    <?php if ($esAdministrador): ?>

                        <article class="tarjeta-modulo">

                            <div class="icono-modulo">
                                ♧
                            </div>

                            <div class="informacion-modulo">

                                <h3>Doctores</h3>

                                <p>
                                    Administración de doctores
                                    y personal médico.
                                </p>

                                <a href="doctores/">
                                    Ir al módulo
                                    <span>›</span>
                                </a>

                            </div>

                        </article>

                    <?php endif; ?>

                    <!-- HABITACIONES -->

                    <?php if ($esAdministrador): ?>

                        <article class="tarjeta-modulo">

                            <div class="icono-modulo">
                                ▰
                            </div>

                            <div class="informacion-modulo">

                                <h3>Habitaciones</h3>

                                <p>
                                    Control de habitaciones
                                    y disponibilidad.
                                </p>

                                <a href="habitaciones/">
                                    Ir al módulo
                                    <span>›</span>
                                </a>

                            </div>

                        </article>

                    <?php endif; ?>

                    <!-- CITAS -->

                    <article class="tarjeta-modulo">

                        <div class="icono-modulo">
                            ▣
                        </div>

                        <div class="informacion-modulo">

                            <h3>Citas</h3>

                            <p>
                                Registrar y consultar
                                citas médicas.
                            </p>

                            <a href="citas/">
                                Ir al módulo
                                <span>›</span>
                            </a>

                        </div>

                    </article>

                    <!-- RECETAS -->

                    <article class="tarjeta-modulo">

                        <div class="icono-modulo">
                            ▤
                        </div>

                        <div class="informacion-modulo">

                            <h3>Recetas</h3>

                            <p>
                                Emitir y gestionar
                                recetas médicas.
                            </p>

                            <a href="recetas/">
                                Ir al módulo
                                <span>›</span>
                            </a>

                        </div>

                    </article>

                    <!-- REPORTES -->

                    <?php if ($esAdministrador): ?>

                        <article class="tarjeta-modulo">

                            <div class="icono-modulo">
                                ▥
                            </div>

                            <div class="informacion-modulo">

                                <h3>Reportes</h3>

                                <p>
                                    Consultar reportes y estadísticas
                                    generales del hospital.
                                </p>

                                <a href="reportes/">
                                    Ir al módulo
                                    <span>›</span>
                                </a>

                            </div>

                        </article>

                    <?php endif; ?>

                </div>

            </section>

            <!-- INFORMACIÓN LATERAL -->

            <aside class="panel-informacion">

                <div class="titulo-informacion">

                    <span>ⓘ</span>

                    <h2>Información de sesión</h2>

                </div>

                <div class="dato-sesion">

                    <span class="icono-dato">♙</span>

                    <div>
                        <small>Usuario</small>

                        <strong>
                            <?php echo htmlspecialchars($usuario); ?>
                        </strong>
                    </div>

                </div>

                <div class="dato-sesion">

                    <span class="icono-dato">♟</span>

                    <div>
                        <small>Rol</small>

                        <strong>
                            <?php
                            echo $esAdministrador
                                ? "Administrador"
                                : "Médico";
                            ?>
                        </strong>
                    </div>

                </div>

                <div class="dato-sesion">

                    <span class="icono-dato">◷</span>

                    <div>
                        <small>Fecha de consulta</small>

                        <strong>
                            <?php echo htmlspecialchars($fechaActual); ?>
                        </strong>
                    </div>

                </div>

                <hr>

                <div class="equipo-trabajo">

                    <h3>Realizado por:</h3>

                    <ul>
                        <li>ING CARLOS RAMÍREZ</li>
                        <li>ING ZAHIRA ROSALES</li>
                        <li>ING EVELYN MARTÍNEZ</li>
                        <li>ING ROCÍO CARMONA</li>
                    </ul>

                </div>

                <div class="decoracion-medica">
                    ♡
                </div>

            </aside>

        </div>

    </main>

    <!-- PIE DE PÁGINA -->

    <footer class="pie-pagina">

        <p>
            &copy;
            <?php echo date("Y"); ?>
            Hospital SaMy Salud Integral.
            Todos los derechos reservados.
        </p>

    </footer>

</body>

</html>