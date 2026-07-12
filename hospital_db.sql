-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2026 a las 01:22:08
-- Versión del servidor: 8.0.46
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int NOT NULL,
  `id_doctor` int NOT NULL,
  `id_habitacion` int NOT NULL,
  `id_paciente` int NOT NULL,
  `fecha_cita` datetime NOT NULL,
  `motivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` enum('Programada','Completada','Cancelada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_doctor`, `id_habitacion`, `id_paciente`, `fecha_cita`, `motivo`, `estado`) VALUES
(1, 1, 1, 1, '2026-07-15 09:00:00', 'Consulta médica general', 'Programada'),
(2, 2, 2, 2, '2026-07-16 10:00:00', 'Dolor de cabeza frecuente', 'Completada'),
(3, 3, 3, 3, '2026-07-17 11:00:00', 'Revisión de presión arterial', 'Cancelada'),
(4, 4, 4, 4, '2026-07-18 12:00:00', 'Dolor abdominal', 'Programada'),
(5, 5, 5, 5, '2026-07-19 13:00:00', 'Consulta de seguimiento', 'Completada'),
(6, 6, 6, 6, '2026-07-20 14:00:00', 'Evaluación médica', 'Cancelada'),
(7, 7, 7, 7, '2026-07-21 15:00:00', 'Revisión de resultados', 'Programada'),
(8, 8, 8, 8, '2026-07-22 16:00:00', 'Control preventivo', 'Completada'),
(9, 9, 9, 9, '2026-07-23 09:00:00', 'Consulta médica general', 'Cancelada'),
(10, 10, 10, 10, '2026-07-24 10:00:00', 'Dolor de cabeza frecuente', 'Programada'),
(11, 1, 11, 11, '2026-07-25 11:00:00', 'Revisión de presión arterial', 'Completada'),
(12, 2, 12, 12, '2026-07-26 12:00:00', 'Dolor abdominal', 'Cancelada'),
(13, 3, 13, 13, '2026-07-27 13:00:00', 'Consulta de seguimiento', 'Programada'),
(14, 4, 14, 14, '2026-07-28 14:00:00', 'Evaluación médica', 'Completada'),
(15, 5, 15, 15, '2026-07-29 15:00:00', 'Revisión de resultados', 'Cancelada'),
(16, 6, 16, 16, '2026-07-30 16:00:00', 'Control preventivo', 'Programada'),
(17, 7, 17, 17, '2026-07-31 09:00:00', 'Consulta médica general', 'Completada'),
(18, 8, 18, 18, '2026-08-01 10:00:00', 'Dolor de cabeza frecuente', 'Cancelada'),
(19, 9, 19, 19, '2026-08-02 11:00:00', 'Revisión de presión arterial', 'Programada'),
(20, 10, 20, 20, '2026-08-03 12:00:00', 'Dolor abdominal', 'Completada'),
(21, 1, 1, 21, '2026-08-04 13:00:00', 'Consulta de seguimiento', 'Cancelada'),
(22, 2, 2, 22, '2026-08-05 14:00:00', 'Evaluación médica', 'Programada'),
(23, 3, 3, 23, '2026-08-06 15:00:00', 'Revisión de resultados', 'Completada'),
(24, 4, 4, 24, '2026-08-07 16:00:00', 'Control preventivo', 'Cancelada'),
(25, 5, 5, 25, '2026-08-08 09:00:00', 'Consulta médica general', 'Programada'),
(26, 8, 12, 107, '2026-07-14 18:52:00', 'Resfriado común', 'Programada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `cedula_prof` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `nombre`, `apellido`, `especialidad`, `cedula_prof`, `telefono`) VALUES
(1, 'Alejandro', 'García López', 'Medicina General', 'CED-000001', '5510000001'),
(2, 'Daniela', 'Martínez Ruiz', 'Pediatría', 'CED-000002', '5510000002'),
(3, 'Roberto', 'Hernández Soto', 'Cardiología', 'CED-000003', '5510000003'),
(4, 'Mariana', 'Torres Mendoza', 'Dermatología', 'CED-000004', '5510000004'),
(5, 'Fernando', 'Ramírez Castro', 'Traumatología', 'CED-000005', '5510000005'),
(6, 'Gabriela', 'Flores Jiménez', 'Ginecología', 'CED-000006', '5510000006'),
(7, 'Ricardo', 'Sánchez Ortiz', 'Neurología', 'CED-000007', '5510000007'),
(8, 'Natalia', 'Morales Vargas', 'Oftalmología', 'CED-000008', '5510000008'),
(9, 'Eduardo', 'Reyes Navarro', 'Medicina Interna', 'CED-000009', '5510000009'),
(10, 'Valeria', 'Cruz Romero', 'Otorrinolaringología', 'CED-000010', '5510000010'),
(11, 'Larissa', 'Reyes Cruz', 'Medicina General', 'CED-0022541', '5518454587');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int NOT NULL,
  `numero` varchar(10) NOT NULL,
  `tipo` enum('Individual','Doble','Suite') NOT NULL,
  `estado` enum('Disponible','Ocupada','Mantenimiento') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `numero`, `tipo`, `estado`) VALUES
(1, '101', 'Individual', 'Mantenimiento'),
(2, '102', 'Doble', 'Ocupada'),
(3, '103', 'Suite', 'Disponible'),
(4, '104', 'Individual', 'Ocupada'),
(5, '105', 'Doble', 'Ocupada'),
(6, '106', 'Suite', 'Disponible'),
(7, '107', 'Individual', 'Disponible'),
(8, '108', 'Doble', 'Disponible'),
(9, '109', 'Suite', 'Disponible'),
(10, '110', 'Individual', 'Mantenimiento'),
(11, '111', 'Doble', 'Disponible'),
(12, '112', 'Suite', 'Disponible'),
(13, '113', 'Individual', 'Disponible'),
(14, '114', 'Doble', 'Disponible'),
(15, '115', 'Suite', 'Disponible'),
(16, '116', 'Individual', 'Disponible'),
(17, '117', 'Doble', 'Disponible'),
(18, '118', 'Suite', 'Disponible'),
(19, '119', 'Individual', 'Disponible'),
(20, '120', 'Doble', 'Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `edad` int NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `diagnostico` varchar(120) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `tipo_sangre` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `apellido`, `edad`, `sexo`, `telefono`, `direccion`, `diagnostico`, `fecha_ingreso`, `tipo_sangre`, `fecha_nacimiento`) VALUES
(1, 'Juan', 'Pérez García', 18, 'Masculino', '5520000001', 'Calle Salud 1, Colonia Centro', 'Consulta general', '2026-07-01 09:00:00', 'A+', '2008-01-01'),
(2, 'María', 'López Hernández', 5, 'Femenino', '5520000002', 'Calle Salud 2, Colonia Centro', 'Dolor de cabeza', '2026-07-01 10:00:00', 'A-', '2007-02-02'),
(3, 'Carlos', 'Martínez Sánchez', 20, 'Masculino', '5520000003', 'Calle Salud 3, Colonia Centro', 'Fiebre', '2026-07-01 11:00:00', 'B+', '2006-03-03'),
(4, 'Ana', 'González Ramírez', 21, 'Femenino', '5520000004', 'Calle Salud 4, Colonia Centro', 'Dolor abdominal', '2026-07-01 12:00:00', 'B-', '2005-04-04'),
(5, 'Luis', 'Rodríguez Torres', 22, 'Masculino', '5520000005', 'Calle Salud 5, Colonia Centro', 'Presión arterial alta', '2026-07-01 13:00:00', 'AB+', '2004-05-05'),
(6, 'Sofía', 'Flores Mendoza', 23, 'Femenino', '5520000006', 'Calle Salud 6, Colonia Centro', 'Infección respiratoria', '2026-07-01 14:00:00', 'AB-', '2003-06-06'),
(7, 'José', 'Gómez Castro', 24, 'Masculino', '5520000007', 'Calle Salud 7, Colonia Centro', 'Dolor muscular', '2026-07-01 15:00:00', 'O+', '2002-07-07'),
(8, 'Valentina', 'Díaz Morales', 25, 'Femenino', '5520000008', 'Calle Salud 8, Colonia Centro', 'Revisión médica', '2026-07-01 16:00:00', 'O-', '2001-08-08'),
(9, 'Miguel', 'Vargas Reyes', 26, 'Masculino', '5520000009', 'Calle Salud 9, Colonia Centro', 'Alergia', '2026-07-01 17:00:00', 'A+', '2000-09-09'),
(10, 'Camila', 'Cruz Ortiz', 27, 'Femenino', '5520000010', 'Calle Salud 10, Colonia Centro', 'Control preventivo', '2026-07-01 18:00:00', 'A-', '1999-10-10'),
(11, 'Diego', 'Jiménez Navarro', 28, 'Masculino', '5520000011', 'Calle Salud 11, Colonia Centro', 'Consulta general', '2026-07-01 19:00:00', 'B+', '1998-11-11'),
(12, 'Fernanda', 'Moreno Romero', 29, 'Femenino', '5520000012', 'Calle Salud 12, Colonia Centro', 'Dolor de cabeza', '2026-07-01 20:00:00', 'B-', '1997-12-12'),
(13, 'Jorge', 'Ruiz Silva', 30, 'Masculino', '5520000013', 'Calle Salud 13, Colonia Centro', 'Fiebre', '2026-07-01 21:00:00', 'AB+', '1996-01-13'),
(14, 'Paola', 'Álvarez Rojas', 31, 'Femenino', '5520000014', 'Calle Salud 14, Colonia Centro', 'Dolor abdominal', '2026-07-01 22:00:00', 'AB-', '1995-02-14'),
(15, 'Andrés', 'Soto Aguilar', 32, 'Masculino', '5520000015', 'Calle Salud 15, Colonia Centro', 'Presión arterial alta', '2026-07-01 23:00:00', 'O+', '1994-03-15'),
(16, 'Daniela', 'Méndez Campos', 33, 'Femenino', '5520000016', 'Calle Salud 16, Colonia Centro', 'Infección respiratoria', '2026-07-02 00:00:00', 'O-', '1993-04-16'),
(17, 'Ricardo', 'Ortega Vega', 34, 'Masculino', '5520000017', 'Calle Salud 17, Colonia Centro', 'Dolor muscular', '2026-07-02 01:00:00', 'A+', '1992-05-17'),
(18, 'Natalia', 'Guerrero Luna', 35, 'Femenino', '5520000018', 'Calle Salud 18, Colonia Centro', 'Revisión médica', '2026-07-02 02:00:00', 'A-', '1991-06-18'),
(19, 'Emilio', 'Castillo Medina', 36, 'Masculino', '5520000019', 'Calle Salud 19, Colonia Centro', 'Alergia', '2026-07-02 03:00:00', 'B+', '1990-07-19'),
(20, 'Alejandra', 'Ramos Cabrera', 37, 'Femenino', '5520000020', 'Calle Salud 20, Colonia Centro', 'Control preventivo', '2026-07-02 04:00:00', 'B-', '1989-08-20'),
(21, 'Fernando', 'Pérez García', 38, 'Masculino', '5520000021', 'Calle Salud 21, Colonia Centro', 'Consulta general', '2026-07-02 05:00:00', 'AB+', '1988-09-21'),
(22, 'Gabriela', 'López Hernández', 39, 'Femenino', '5520000022', 'Calle Salud 22, Colonia Centro', 'Dolor de cabeza', '2026-07-02 06:00:00', 'AB-', '1987-10-22'),
(23, 'Roberto', 'Martínez Sánchez', 40, 'Masculino', '5520000023', 'Calle Salud 23, Colonia Centro', 'Fiebre', '2026-07-02 07:00:00', 'O+', '1986-11-23'),
(24, 'Mariana', 'González Ramírez', 41, 'Femenino', '5520000024', 'Calle Salud 24, Colonia Centro', 'Dolor abdominal', '2026-07-02 08:00:00', 'O-', '1985-12-24'),
(25, 'Eduardo', 'Rodríguez Torres', 42, 'Masculino', '5520000025', 'Calle Salud 25, Colonia Centro', 'Presión arterial alta', '2026-07-02 09:00:00', 'A+', '1984-01-25'),
(26, 'Juan', 'Flores Mendoza', 43, 'Femenino', '5520000026', 'Calle Salud 26, Colonia Centro', 'Infección respiratoria', '2026-07-02 10:00:00', 'A-', '1983-02-26'),
(27, 'María', 'Gómez Castro', 44, 'Masculino', '5520000027', 'Calle Salud 27, Colonia Centro', 'Dolor muscular', '2026-07-02 11:00:00', 'B+', '1982-03-27'),
(28, 'Carlos', 'Díaz Morales', 45, 'Femenino', '5520000028', 'Calle Salud 28, Colonia Centro', 'Revisión médica', '2026-07-02 12:00:00', 'B-', '1981-04-28'),
(29, 'Ana', 'Vargas Reyes', 46, 'Masculino', '5520000029', 'Calle Salud 29, Colonia Centro', 'Alergia', '2026-07-02 13:00:00', 'AB+', '1980-05-01'),
(30, 'Luis', 'Cruz Ortiz', 47, 'Femenino', '5520000030', 'Calle Salud 30, Colonia Centro', 'Control preventivo', '2026-07-02 14:00:00', 'AB-', '1979-06-02'),
(31, 'Sofía', 'Jiménez Navarro', 48, 'Masculino', '5520000031', 'Calle Salud 31, Colonia Centro', 'Consulta general', '2026-07-02 15:00:00', 'O+', '1978-07-03'),
(32, 'José', 'Moreno Romero', 49, 'Femenino', '5520000032', 'Calle Salud 32, Colonia Centro', 'Dolor de cabeza', '2026-07-02 16:00:00', 'O-', '1977-08-04'),
(33, 'Valentina', 'Ruiz Silva', 50, 'Masculino', '5520000033', 'Calle Salud 33, Colonia Centro', 'Fiebre', '2026-07-02 17:00:00', 'A+', '1976-09-05'),
(34, 'Miguel', 'Álvarez Rojas', 51, 'Femenino', '5520000034', 'Calle Salud 34, Colonia Centro', 'Dolor abdominal', '2026-07-02 18:00:00', 'A-', '1975-10-06'),
(35, 'Camila', 'Soto Aguilar', 52, 'Masculino', '5520000035', 'Calle Salud 35, Colonia Centro', 'Presión arterial alta', '2026-07-02 19:00:00', 'B+', '1974-11-07'),
(36, 'Diego', 'Méndez Campos', 53, 'Femenino', '5520000036', 'Calle Salud 36, Colonia Centro', 'Infección respiratoria', '2026-07-02 20:00:00', 'B-', '1973-12-08'),
(37, 'Fernanda', 'Ortega Vega', 54, 'Masculino', '5520000037', 'Calle Salud 37, Colonia Centro', 'Dolor muscular', '2026-07-02 21:00:00', 'AB+', '1972-01-09'),
(38, 'Jorge', 'Guerrero Luna', 55, 'Femenino', '5520000038', 'Calle Salud 38, Colonia Centro', 'Revisión médica', '2026-07-02 22:00:00', 'AB-', '1971-02-10'),
(39, 'Paola', 'Castillo Medina', 56, 'Masculino', '5520000039', 'Calle Salud 39, Colonia Centro', 'Alergia', '2026-07-02 23:00:00', 'O+', '1970-03-11'),
(40, 'Andrés', 'Ramos Cabrera', 57, 'Femenino', '5520000040', 'Calle Salud 40, Colonia Centro', 'Control preventivo', '2026-07-03 00:00:00', 'O-', '1969-04-12'),
(41, 'Daniela', 'Pérez García', 58, 'Masculino', '5520000041', 'Calle Salud 41, Colonia Centro', 'Consulta general', '2026-07-03 01:00:00', 'A+', '1968-05-13'),
(42, 'Ricardo', 'López Hernández', 59, 'Femenino', '5520000042', 'Calle Salud 42, Colonia Centro', 'Dolor de cabeza', '2026-07-03 02:00:00', 'A-', '1967-06-14'),
(43, 'Natalia', 'Martínez Sánchez', 60, 'Masculino', '5520000043', 'Calle Salud 43, Colonia Centro', 'Fiebre', '2026-07-03 03:00:00', 'B+', '1966-07-15'),
(44, 'Emilio', 'González Ramírez', 61, 'Femenino', '5520000044', 'Calle Salud 44, Colonia Centro', 'Dolor abdominal', '2026-07-03 04:00:00', 'B-', '1965-08-16'),
(45, 'Alejandra', 'Rodríguez Torres', 62, 'Masculino', '5520000045', 'Calle Salud 45, Colonia Centro', 'Presión arterial alta', '2026-07-03 05:00:00', 'AB+', '1964-09-17'),
(46, 'Fernando', 'Flores Mendoza', 63, 'Femenino', '5520000046', 'Calle Salud 46, Colonia Centro', 'Infección respiratoria', '2026-07-03 06:00:00', 'AB-', '1963-10-18'),
(47, 'Gabriela', 'Gómez Castro', 64, 'Masculino', '5520000047', 'Calle Salud 47, Colonia Centro', 'Dolor muscular', '2026-07-03 07:00:00', 'O+', '1962-11-19'),
(48, 'Roberto', 'Díaz Morales', 65, 'Femenino', '5520000048', 'Calle Salud 48, Colonia Centro', 'Revisión médica', '2026-07-03 08:00:00', 'O-', '1961-12-20'),
(49, 'Mariana', 'Vargas Reyes', 66, 'Masculino', '5520000049', 'Calle Salud 49, Colonia Centro', 'Alergia', '2026-07-03 09:00:00', 'A+', '1960-01-21'),
(50, 'Eduardo', 'Cruz Ortiz', 67, 'Femenino', '5520000050', 'Calle Salud 50, Colonia Centro', 'Control preventivo', '2026-07-03 10:00:00', 'A-', '1959-02-22'),
(51, 'Juan', 'Jiménez Navarro', 68, 'Masculino', '5520000051', 'Calle Salud 51, Colonia Centro', 'Consulta general', '2026-07-03 11:00:00', 'B+', '1958-03-23'),
(52, 'María', 'Moreno Romero', 69, 'Femenino', '5520000052', 'Calle Salud 52, Colonia Centro', 'Dolor de cabeza', '2026-07-03 12:00:00', 'B-', '1957-04-24'),
(53, 'Carlos', 'Ruiz Silva', 70, 'Masculino', '5520000053', 'Calle Salud 53, Colonia Centro', 'Fiebre', '2026-07-03 13:00:00', 'AB+', '1956-05-25'),
(54, 'Ana', 'Álvarez Rojas', 71, 'Femenino', '5520000054', 'Calle Salud 54, Colonia Centro', 'Dolor abdominal', '2026-07-03 14:00:00', 'AB-', '1955-06-26'),
(55, 'Luis', 'Soto Aguilar', 72, 'Masculino', '5520000055', 'Calle Salud 55, Colonia Centro', 'Presión arterial alta', '2026-07-03 15:00:00', 'O+', '1954-07-27'),
(56, 'Sofía', 'Méndez Campos', 73, 'Femenino', '5520000056', 'Calle Salud 56, Colonia Centro', 'Infección respiratoria', '2026-07-03 16:00:00', 'O-', '1953-08-28'),
(57, 'José', 'Ortega Vega', 74, 'Masculino', '5520000057', 'Calle Salud 57, Colonia Centro', 'Dolor muscular', '2026-07-03 17:00:00', 'A+', '1952-09-01'),
(58, 'Valentina', 'Guerrero Luna', 75, 'Femenino', '5520000058', 'Calle Salud 58, Colonia Centro', 'Revisión médica', '2026-07-03 18:00:00', 'A-', '1951-10-02'),
(59, 'Miguel', 'Castillo Medina', 76, 'Masculino', '5520000059', 'Calle Salud 59, Colonia Centro', 'Alergia', '2026-07-03 19:00:00', 'B+', '1950-11-03'),
(60, 'Camila', 'Ramos Cabrera', 77, 'Femenino', '5520000060', 'Calle Salud 60, Colonia Centro', 'Control preventivo', '2026-07-03 20:00:00', 'B-', '1949-12-04'),
(61, 'Diego', 'Pérez García', 78, 'Masculino', '5520000061', 'Calle Salud 61, Colonia Centro', 'Consulta general', '2026-07-03 21:00:00', 'AB+', '1948-01-05'),
(62, 'Fernanda', 'López Hernández', 79, 'Femenino', '5520000062', 'Calle Salud 62, Colonia Centro', 'Dolor de cabeza', '2026-07-03 22:00:00', 'AB-', '1947-02-06'),
(63, 'Jorge', 'Martínez Sánchez', 80, 'Masculino', '5520000063', 'Calle Salud 63, Colonia Centro', 'Fiebre', '2026-07-03 23:00:00', 'O+', '1946-03-07'),
(64, 'Paola', 'González Ramírez', 18, 'Femenino', '5520000064', 'Calle Salud 64, Colonia Centro', 'Dolor abdominal', '2026-07-04 00:00:00', 'O-', '2008-04-08'),
(65, 'Andrés', 'Rodríguez Torres', 19, 'Masculino', '5520000065', 'Calle Salud 65, Colonia Centro', 'Presión arterial alta', '2026-07-04 01:00:00', 'A+', '2007-05-09'),
(66, 'Daniela', 'Flores Mendoza', 20, 'Femenino', '5520000066', 'Calle Salud 66, Colonia Centro', 'Infección respiratoria', '2026-07-04 02:00:00', 'A-', '2006-06-10'),
(67, 'Ricardo', 'Gómez Castro', 21, 'Masculino', '5520000067', 'Calle Salud 67, Colonia Centro', 'Dolor muscular', '2026-07-04 03:00:00', 'B+', '2005-07-11'),
(68, 'Natalia', 'Díaz Morales', 22, 'Femenino', '5520000068', 'Calle Salud 68, Colonia Centro', 'Revisión médica', '2026-07-04 04:00:00', 'B-', '2004-08-12'),
(69, 'Emilio', 'Vargas Reyes', 23, 'Masculino', '5520000069', 'Calle Salud 69, Colonia Centro', 'Alergia', '2026-07-04 05:00:00', 'AB+', '2003-09-13'),
(70, 'Alejandra', 'Cruz Ortiz', 24, 'Femenino', '5520000070', 'Calle Salud 70, Colonia Centro', 'Control preventivo', '2026-07-04 06:00:00', 'AB-', '2002-10-14'),
(71, 'Fernando', 'Jiménez Navarro', 25, 'Masculino', '5520000071', 'Calle Salud 71, Colonia Centro', 'Consulta general', '2026-07-04 07:00:00', 'O+', '2001-11-15'),
(72, 'Gabriela', 'Moreno Romero', 26, 'Femenino', '5520000072', 'Calle Salud 72, Colonia Centro', 'Dolor de cabeza', '2026-07-04 08:00:00', 'O-', '2000-12-16'),
(73, 'Roberto', 'Ruiz Silva', 27, 'Masculino', '5520000073', 'Calle Salud 73, Colonia Centro', 'Fiebre', '2026-07-04 09:00:00', 'A+', '1999-01-17'),
(74, 'Mariana', 'Álvarez Rojas', 28, 'Femenino', '5520000074', 'Calle Salud 74, Colonia Centro', 'Dolor abdominal', '2026-07-04 10:00:00', 'A-', '1998-02-18'),
(75, 'Eduardo', 'Soto Aguilar', 29, 'Masculino', '5520000075', 'Calle Salud 75, Colonia Centro', 'Presión arterial alta', '2026-07-04 11:00:00', 'B+', '1997-03-19'),
(76, 'Juan', 'Méndez Campos', 30, 'Femenino', '5520000076', 'Calle Salud 76, Colonia Centro', 'Infección respiratoria', '2026-07-04 12:00:00', 'B-', '1996-04-20'),
(77, 'María', 'Ortega Vega', 31, 'Masculino', '5520000077', 'Calle Salud 77, Colonia Centro', 'Dolor muscular', '2026-07-04 13:00:00', 'AB+', '1995-05-21'),
(78, 'Carlos', 'Guerrero Luna', 32, 'Femenino', '5520000078', 'Calle Salud 78, Colonia Centro', 'Revisión médica', '2026-07-04 14:00:00', 'AB-', '1994-06-22'),
(79, 'Ana', 'Castillo Medina', 33, 'Masculino', '5520000079', 'Calle Salud 79, Colonia Centro', 'Alergia', '2026-07-04 15:00:00', 'O+', '1993-07-23'),
(80, 'Luis', 'Ramos Cabrera', 34, 'Femenino', '5520000080', 'Calle Salud 80, Colonia Centro', 'Control preventivo', '2026-07-04 16:00:00', 'O-', '1992-08-24'),
(81, 'Sofía', 'Pérez García', 35, 'Masculino', '5520000081', 'Calle Salud 81, Colonia Centro', 'Consulta general', '2026-07-04 17:00:00', 'A+', '1991-09-25'),
(82, 'José', 'López Hernández', 36, 'Femenino', '5520000082', 'Calle Salud 82, Colonia Centro', 'Dolor de cabeza', '2026-07-04 18:00:00', 'A-', '1990-10-26'),
(83, 'Valentina', 'Martínez Sánchez', 37, 'Masculino', '5520000083', 'Calle Salud 83, Colonia Centro', 'Fiebre', '2026-07-04 19:00:00', 'B+', '1989-11-27'),
(84, 'Miguel', 'González Ramírez', 38, 'Femenino', '5520000084', 'Calle Salud 84, Colonia Centro', 'Dolor abdominal', '2026-07-04 20:00:00', 'B-', '1988-12-28'),
(85, 'Camila', 'Rodríguez Torres', 39, 'Masculino', '5520000085', 'Calle Salud 85, Colonia Centro', 'Presión arterial alta', '2026-07-04 21:00:00', 'AB+', '1987-01-01'),
(86, 'Diego', 'Flores Mendoza', 40, 'Femenino', '5520000086', 'Calle Salud 86, Colonia Centro', 'Infección respiratoria', '2026-07-04 22:00:00', 'AB-', '1986-02-02'),
(87, 'Fernanda', 'Gómez Castro', 41, 'Masculino', '5520000087', 'Calle Salud 87, Colonia Centro', 'Dolor muscular', '2026-07-04 23:00:00', 'O+', '1985-03-03'),
(88, 'Jorge', 'Díaz Morales', 42, 'Femenino', '5520000088', 'Calle Salud 88, Colonia Centro', 'Revisión médica', '2026-07-05 00:00:00', 'O-', '1984-04-04'),
(89, 'Paola', 'Vargas Reyes', 43, 'Masculino', '5520000089', 'Calle Salud 89, Colonia Centro', 'Alergia', '2026-07-05 01:00:00', 'A+', '1983-05-05'),
(90, 'Andrés', 'Cruz Ortiz', 44, 'Femenino', '5520000090', 'Calle Salud 90, Colonia Centro', 'Control preventivo', '2026-07-05 02:00:00', 'A-', '1982-06-06'),
(91, 'Daniela', 'Jiménez Navarro', 45, 'Masculino', '5520000091', 'Calle Salud 91, Colonia Centro', 'Consulta general', '2026-07-05 03:00:00', 'B+', '1981-07-07'),
(92, 'Ricardo', 'Moreno Romero', 46, 'Femenino', '5520000092', 'Calle Salud 92, Colonia Centro', 'Dolor de cabeza', '2026-07-05 04:00:00', 'B-', '1980-08-08'),
(93, 'Natalia', 'Ruiz Silva', 47, 'Masculino', '5520000093', 'Calle Salud 93, Colonia Centro', 'Fiebre', '2026-07-05 05:00:00', 'AB+', '1979-09-09'),
(94, 'Emilio', 'Álvarez Rojas', 48, 'Femenino', '5520000094', 'Calle Salud 94, Colonia Centro', 'Dolor abdominal', '2026-07-05 06:00:00', 'AB-', '1978-10-10'),
(95, 'Alejandra', 'Soto Aguilar', 49, 'Masculino', '5520000095', 'Calle Salud 95, Colonia Centro', 'Presión arterial alta', '2026-07-05 07:00:00', 'O+', '1977-11-11'),
(96, 'Fernando', 'Méndez Campos', 50, 'Femenino', '5520000096', 'Calle Salud 96, Colonia Centro', 'Infección respiratoria', '2026-07-05 08:00:00', 'O-', '1976-12-12'),
(97, 'Gabriela', 'Ortega Vega', 51, 'Masculino', '5520000097', 'Calle Salud 97, Colonia Centro', 'Dolor muscular', '2026-07-05 09:00:00', 'A+', '1975-01-13'),
(98, 'Roberto', 'Guerrero Luna', 52, 'Femenino', '5520000098', 'Calle Salud 98, Colonia Centro', 'Revisión médica', '2026-07-05 10:00:00', 'A-', '1974-02-14'),
(99, 'Mariana', 'Castillo Medina', 53, 'Masculino', '5520000099', 'Calle Salud 99, Colonia Centro', 'Alergia', '2026-07-05 11:00:00', 'B+', '1973-03-15'),
(100, 'Eduardo', 'Ramos Cabrera', 54, 'Femenino', '5520000100', 'Calle Salud 100, Colonia Centro', 'Control preventivo', '2026-07-05 12:00:00', 'B-', '1972-04-16'),
(101, 'Juan', 'Pérez García', 55, 'Masculino', '5520000101', 'Calle Salud 101, Colonia Centro', 'Consulta general', '2026-07-05 13:00:00', 'AB+', '1971-05-17'),
(102, 'María', 'López Hernández', 56, 'Femenino', '5520000102', 'Calle Salud 102, Colonia Centro', 'Dolor de cabeza', '2026-07-05 14:00:00', 'AB-', '1970-06-18'),
(103, 'Carlos', 'Martínez Sánchez', 57, 'Masculino', '5520000103', 'Calle Salud 103, Colonia Centro', 'Fiebre', '2026-07-05 15:00:00', 'O+', '1969-07-19'),
(104, 'Ana', 'González Ramírez', 58, 'Femenino', '5520000104', 'Calle Salud 104, Colonia Centro', 'Dolor abdominal', '2026-07-05 16:00:00', 'O-', '1968-08-20'),
(105, 'Luis', 'Rodríguez Torres', 59, 'Masculino', '5520000105', 'Calle Salud 105, Colonia Centro', 'Presión arterial alta', '2026-07-05 17:00:00', 'A+', '1967-09-21'),
(106, 'Sofía', 'Flores Mendoza', 60, 'Femenino', '5520000106', 'Calle Salud 106, Colonia Centro', 'Infección respiratoria', '2026-07-05 18:00:00', 'A-', '1966-10-22'),
(107, 'José', 'Gómez Castro', 61, 'Masculino', '5520000107', 'Calle Salud 107, Colonia Centro', 'Dolor muscular', '2026-07-05 19:00:00', 'B+', '1965-11-23'),
(108, 'Valentina', 'Díaz Morales', 62, 'Femenino', '5520000108', 'Calle Salud 108, Colonia Centro', 'Revisión médica', '2026-07-05 20:00:00', 'B-', '1964-12-24'),
(109, 'Miguel', 'Vargas Reyes', 63, 'Masculino', '5520000109', 'Calle Salud 109, Colonia Centro', 'Alergia', '2026-07-05 21:00:00', 'AB+', '1963-01-25'),
(110, 'Camila', 'Cruz Ortiz', 64, 'Femenino', '5520000110', 'Calle Salud 110, Colonia Centro', 'Control preventivo', '2026-07-05 22:00:00', 'AB-', '1962-02-26'),
(111, 'Diego', 'Jiménez Navarro', 65, 'Masculino', '5520000111', 'Calle Salud 111, Colonia Centro', 'Consulta general', '2026-07-05 23:00:00', 'O+', '1961-03-27'),
(112, 'Fernanda', 'Moreno Romero', 66, 'Femenino', '5520000112', 'Calle Salud 112, Colonia Centro', 'Dolor de cabeza', '2026-07-06 00:00:00', 'O-', '1960-04-28'),
(113, 'Jorge', 'Ruiz Silva', 67, 'Masculino', '5520000113', 'Calle Salud 113, Colonia Centro', 'Fiebre', '2026-07-06 01:00:00', 'A+', '1959-05-01'),
(114, 'Paola', 'Álvarez Rojas', 68, 'Femenino', '5520000114', 'Calle Salud 114, Colonia Centro', 'Dolor abdominal', '2026-07-06 02:00:00', 'A-', '1958-06-02'),
(115, 'Andrés', 'Soto Aguilar', 69, 'Masculino', '5520000115', 'Calle Salud 115, Colonia Centro', 'Presión arterial alta', '2026-07-06 03:00:00', 'B+', '1957-07-03'),
(116, 'Daniela', 'Méndez Campos', 70, 'Femenino', '5520000116', 'Calle Salud 116, Colonia Centro', 'Infección respiratoria', '2026-07-06 04:00:00', 'B-', '1956-08-04'),
(117, 'Ricardo', 'Ortega Vega', 71, 'Masculino', '5520000117', 'Calle Salud 117, Colonia Centro', 'Dolor muscular', '2026-07-06 05:00:00', 'AB+', '1955-09-05'),
(118, 'Natalia', 'Guerrero Luna', 72, 'Femenino', '5520000118', 'Calle Salud 118, Colonia Centro', 'Revisión médica', '2026-07-06 06:00:00', 'AB-', '1954-10-06'),
(119, 'Emilio', 'Castillo Medina', 73, 'Masculino', '5520000119', 'Calle Salud 119, Colonia Centro', 'Alergia', '2026-07-06 07:00:00', 'O+', '1953-11-07'),
(120, 'Alejandra', 'Ramos Cabrera', 74, 'Femenino', '5520000120', 'Calle Salud 120, Colonia Centro', 'Control preventivo', '2026-07-06 08:00:00', 'O-', '1952-12-08'),
(121, 'Fernando', 'Pérez García', 75, 'Masculino', '5520000121', 'Calle Salud 121, Colonia Centro', 'Consulta general', '2026-07-06 09:00:00', 'A+', '1951-01-09'),
(122, 'Gabriela', 'López Hernández', 76, 'Femenino', '5520000122', 'Calle Salud 122, Colonia Centro', 'Dolor de cabeza', '2026-07-06 10:00:00', 'A-', '1950-02-10'),
(123, 'Roberto', 'Martínez Sánchez', 77, 'Masculino', '5520000123', 'Calle Salud 123, Colonia Centro', 'Fiebre', '2026-07-06 11:00:00', 'B+', '1949-03-11'),
(124, 'Mariana', 'González Ramírez', 78, 'Femenino', '5520000124', 'Calle Salud 124, Colonia Centro', 'Dolor abdominal', '2026-07-06 12:00:00', 'B-', '1948-04-12'),
(125, 'Eduardo', 'Rodríguez Torres', 79, 'Masculino', '5520000125', 'Calle Salud 125, Colonia Centro', 'Presión arterial alta', '2026-07-06 13:00:00', 'AB+', '1947-05-13'),
(126, 'Juan', 'Flores Mendoza', 80, 'Femenino', '5520000126', 'Calle Salud 126, Colonia Centro', 'Infección respiratoria', '2026-07-06 14:00:00', 'AB-', '1946-06-14'),
(127, 'María', 'Gómez Castro', 18, 'Masculino', '5520000127', 'Calle Salud 127, Colonia Centro', 'Dolor muscular', '2026-07-06 15:00:00', 'O+', '2008-07-15'),
(128, 'Carlos', 'Díaz Morales', 19, 'Femenino', '5520000128', 'Calle Salud 128, Colonia Centro', 'Revisión médica', '2026-07-06 16:00:00', 'O-', '2007-08-16'),
(129, 'Ana', 'Vargas Reyes', 20, 'Masculino', '5520000129', 'Calle Salud 129, Colonia Centro', 'Alergia', '2026-07-06 17:00:00', 'A+', '2006-09-17'),
(130, 'Luis', 'Cruz Ortiz', 21, 'Femenino', '5520000130', 'Calle Salud 130, Colonia Centro', 'Control preventivo', '2026-07-06 18:00:00', 'A-', '2005-10-18'),
(131, 'Sofía', 'Jiménez Navarro', 22, 'Masculino', '5520000131', 'Calle Salud 131, Colonia Centro', 'Consulta general', '2026-07-06 19:00:00', 'B+', '2004-11-19'),
(132, 'José', 'Moreno Romero', 23, 'Femenino', '5520000132', 'Calle Salud 132, Colonia Centro', 'Dolor de cabeza', '2026-07-06 20:00:00', 'B-', '2003-12-20'),
(133, 'Valentina', 'Ruiz Silva', 24, 'Masculino', '5520000133', 'Calle Salud 133, Colonia Centro', 'Fiebre', '2026-07-06 21:00:00', 'AB+', '2002-01-21'),
(134, 'Miguel', 'Álvarez Rojas', 25, 'Femenino', '5520000134', 'Calle Salud 134, Colonia Centro', 'Dolor abdominal', '2026-07-06 22:00:00', 'AB-', '2001-02-22'),
(135, 'Camila', 'Soto Aguilar', 26, 'Masculino', '5520000135', 'Calle Salud 135, Colonia Centro', 'Presión arterial alta', '2026-07-06 23:00:00', 'O+', '2000-03-23'),
(136, 'Diego', 'Méndez Campos', 27, 'Femenino', '5520000136', 'Calle Salud 136, Colonia Centro', 'Infección respiratoria', '2026-07-07 00:00:00', 'O-', '1999-04-24'),
(137, 'Fernanda', 'Ortega Vega', 28, 'Masculino', '5520000137', 'Calle Salud 137, Colonia Centro', 'Dolor muscular', '2026-07-07 01:00:00', 'A+', '1998-05-25'),
(138, 'Jorge', 'Guerrero Luna', 29, 'Femenino', '5520000138', 'Calle Salud 138, Colonia Centro', 'Revisión médica', '2026-07-07 02:00:00', 'A-', '1997-06-26'),
(139, 'Paola', 'Castillo Medina', 30, 'Masculino', '5520000139', 'Calle Salud 139, Colonia Centro', 'Alergia', '2026-07-07 03:00:00', 'B+', '1996-07-27'),
(140, 'Andrés', 'Ramos Cabrera', 31, 'Femenino', '5520000140', 'Calle Salud 140, Colonia Centro', 'Control preventivo', '2026-07-07 04:00:00', 'B-', '1995-08-28'),
(141, 'Daniela', 'Pérez García', 32, 'Masculino', '5520000141', 'Calle Salud 141, Colonia Centro', 'Consulta general', '2026-07-07 05:00:00', 'AB+', '1994-09-01'),
(142, 'Ricardo', 'López Hernández', 33, 'Femenino', '5520000142', 'Calle Salud 142, Colonia Centro', 'Dolor de cabeza', '2026-07-07 06:00:00', 'AB-', '1993-10-02'),
(143, 'Natalia', 'Martínez Sánchez', 34, 'Masculino', '5520000143', 'Calle Salud 143, Colonia Centro', 'Fiebre', '2026-07-07 07:00:00', 'O+', '1992-11-03'),
(144, 'Emilio', 'González Ramírez', 35, 'Femenino', '5520000144', 'Calle Salud 144, Colonia Centro', 'Dolor abdominal', '2026-07-07 08:00:00', 'O-', '1991-12-04'),
(145, 'Alejandra', 'Rodríguez Torres', 36, 'Masculino', '5520000145', 'Calle Salud 145, Colonia Centro', 'Presión arterial alta', '2026-07-07 09:00:00', 'A+', '1990-01-05'),
(146, 'Fernando', 'Flores Mendoza', 37, 'Femenino', '5520000146', 'Calle Salud 146, Colonia Centro', 'Infección respiratoria', '2026-07-07 10:00:00', 'A-', '1989-02-06'),
(147, 'Gabriela', 'Gómez Castro', 38, 'Masculino', '5520000147', 'Calle Salud 147, Colonia Centro', 'Dolor muscular', '2026-07-07 11:00:00', 'B+', '1988-03-07'),
(148, 'Roberto', 'Díaz Morales', 39, 'Femenino', '5520000148', 'Calle Salud 148, Colonia Centro', 'Revisión médica', '2026-07-07 12:00:00', 'B-', '1987-04-08'),
(149, 'Mariana', 'Vargas Reyes', 40, 'Masculino', '5520000149', 'Calle Salud 149, Colonia Centro', 'Alergia', '2026-07-07 13:00:00', 'AB+', '1986-05-09'),
(150, 'Eduardo', 'Cruz Ortiz', 41, 'Femenino', '5520000150', 'Calle Salud 150, Colonia Centro', 'Control preventivo', '2026-07-07 14:00:00', 'AB-', '1985-06-10'),
(151, 'Juan', 'Jiménez Navarro', 42, 'Masculino', '5520000151', 'Calle Salud 151, Colonia Centro', 'Consulta general', '2026-07-07 15:00:00', 'O+', '1984-07-11'),
(152, 'María', 'Moreno Romero', 43, 'Femenino', '5520000152', 'Calle Salud 152, Colonia Centro', 'Dolor de cabeza', '2026-07-07 16:00:00', 'O-', '1983-08-12'),
(153, 'Carlos', 'Ruiz Silva', 44, 'Masculino', '5520000153', 'Calle Salud 153, Colonia Centro', 'Fiebre', '2026-07-07 17:00:00', 'A+', '1982-09-13'),
(154, 'Ana', 'Álvarez Rojas', 45, 'Femenino', '5520000154', 'Calle Salud 154, Colonia Centro', 'Dolor abdominal', '2026-07-07 18:00:00', 'A-', '1981-10-14'),
(155, 'Luis', 'Soto Aguilar', 46, 'Masculino', '5520000155', 'Calle Salud 155, Colonia Centro', 'Presión arterial alta', '2026-07-07 19:00:00', 'B+', '1980-11-15'),
(156, 'Sofía', 'Méndez Campos', 47, 'Femenino', '5520000156', 'Calle Salud 156, Colonia Centro', 'Infección respiratoria', '2026-07-07 20:00:00', 'B-', '1979-12-16'),
(157, 'José', 'Ortega Vega', 48, 'Masculino', '5520000157', 'Calle Salud 157, Colonia Centro', 'Dolor muscular', '2026-07-07 21:00:00', 'AB+', '1978-01-17'),
(158, 'Valentina', 'Guerrero Luna', 49, 'Femenino', '5520000158', 'Calle Salud 158, Colonia Centro', 'Revisión médica', '2026-07-07 22:00:00', 'AB-', '1977-02-18'),
(159, 'Miguel', 'Castillo Medina', 50, 'Masculino', '5520000159', 'Calle Salud 159, Colonia Centro', 'Alergia', '2026-07-07 23:00:00', 'O+', '1976-03-19'),
(160, 'Camila', 'Ramos Cabrera', 51, 'Femenino', '5520000160', 'Calle Salud 160, Colonia Centro', 'Control preventivo', '2026-07-08 00:00:00', 'O-', '1975-04-20'),
(161, 'Diego', 'Pérez García', 52, 'Masculino', '5520000161', 'Calle Salud 161, Colonia Centro', 'Consulta general', '2026-07-08 01:00:00', 'A+', '1974-05-21'),
(162, 'Fernanda', 'López Hernández', 53, 'Femenino', '5520000162', 'Calle Salud 162, Colonia Centro', 'Dolor de cabeza', '2026-07-08 02:00:00', 'A-', '1973-06-22'),
(163, 'Jorge', 'Martínez Sánchez', 54, 'Masculino', '5520000163', 'Calle Salud 163, Colonia Centro', 'Fiebre', '2026-07-08 03:00:00', 'B+', '1972-07-23'),
(164, 'Paola', 'González Ramírez', 55, 'Femenino', '5520000164', 'Calle Salud 164, Colonia Centro', 'Dolor abdominal', '2026-07-08 04:00:00', 'B-', '1971-08-24'),
(165, 'Andrés', 'Rodríguez Torres', 56, 'Masculino', '5520000165', 'Calle Salud 165, Colonia Centro', 'Presión arterial alta', '2026-07-08 05:00:00', 'AB+', '1970-09-25'),
(166, 'Daniela', 'Flores Mendoza', 57, 'Femenino', '5520000166', 'Calle Salud 166, Colonia Centro', 'Infección respiratoria', '2026-07-08 06:00:00', 'AB-', '1969-10-26'),
(167, 'Ricardo', 'Gómez Castro', 58, 'Masculino', '5520000167', 'Calle Salud 167, Colonia Centro', 'Dolor muscular', '2026-07-08 07:00:00', 'O+', '1968-11-27'),
(168, 'Natalia', 'Díaz Morales', 59, 'Femenino', '5520000168', 'Calle Salud 168, Colonia Centro', 'Revisión médica', '2026-07-08 08:00:00', 'O-', '1967-12-28'),
(169, 'Emilio', 'Vargas Reyes', 60, 'Masculino', '5520000169', 'Calle Salud 169, Colonia Centro', 'Alergia', '2026-07-08 09:00:00', 'A+', '1966-01-01'),
(170, 'Alejandra', 'Cruz Ortiz', 61, 'Femenino', '5520000170', 'Calle Salud 170, Colonia Centro', 'Control preventivo', '2026-07-08 10:00:00', 'A-', '1965-02-02'),
(171, 'Fernando', 'Jiménez Navarro', 62, 'Masculino', '5520000171', 'Calle Salud 171, Colonia Centro', 'Consulta general', '2026-07-08 11:00:00', 'B+', '1964-03-03'),
(172, 'Gabriela', 'Moreno Romero', 63, 'Femenino', '5520000172', 'Calle Salud 172, Colonia Centro', 'Dolor de cabeza', '2026-07-08 12:00:00', 'B-', '1963-04-04'),
(173, 'Roberto', 'Ruiz Silva', 64, 'Masculino', '5520000173', 'Calle Salud 173, Colonia Centro', 'Fiebre', '2026-07-08 13:00:00', 'AB+', '1962-05-05'),
(174, 'Mariana', 'Álvarez Rojas', 65, 'Femenino', '5520000174', 'Calle Salud 174, Colonia Centro', 'Dolor abdominal', '2026-07-08 14:00:00', 'AB-', '1961-06-06'),
(175, 'Eduardo', 'Soto Aguilar', 66, 'Masculino', '5520000175', 'Calle Salud 175, Colonia Centro', 'Presión arterial alta', '2026-07-08 15:00:00', 'O+', '1960-07-07'),
(176, 'Juan', 'Méndez Campos', 67, 'Femenino', '5520000176', 'Calle Salud 176, Colonia Centro', 'Infección respiratoria', '2026-07-08 16:00:00', 'O-', '1959-08-08'),
(177, 'María', 'Ortega Vega', 68, 'Masculino', '5520000177', 'Calle Salud 177, Colonia Centro', 'Dolor muscular', '2026-07-08 17:00:00', 'A+', '1958-09-09'),
(178, 'Carlos', 'Guerrero Luna', 69, 'Femenino', '5520000178', 'Calle Salud 178, Colonia Centro', 'Revisión médica', '2026-07-08 18:00:00', 'A-', '1957-10-10'),
(179, 'Ana', 'Castillo Medina', 70, 'Masculino', '5520000179', 'Calle Salud 179, Colonia Centro', 'Alergia', '2026-07-08 19:00:00', 'B+', '1956-11-11'),
(180, 'Luis', 'Ramos Cabrera', 71, 'Femenino', '5520000180', 'Calle Salud 180, Colonia Centro', 'Control preventivo', '2026-07-08 20:00:00', 'B-', '1955-12-12'),
(181, 'Sofía', 'Pérez García', 72, 'Masculino', '5520000181', 'Calle Salud 181, Colonia Centro', 'Consulta general', '2026-07-08 21:00:00', 'AB+', '1954-01-13'),
(182, 'José', 'López Hernández', 73, 'Femenino', '5520000182', 'Calle Salud 182, Colonia Centro', 'Dolor de cabeza', '2026-07-08 22:00:00', 'AB-', '1953-02-14'),
(183, 'Valentina', 'Martínez Sánchez', 74, 'Masculino', '5520000183', 'Calle Salud 183, Colonia Centro', 'Fiebre', '2026-07-08 23:00:00', 'O+', '1952-03-15'),
(184, 'Miguel', 'González Ramírez', 75, 'Femenino', '5520000184', 'Calle Salud 184, Colonia Centro', 'Dolor abdominal', '2026-07-09 00:00:00', 'O-', '1951-04-16'),
(185, 'Camila', 'Rodríguez Torres', 76, 'Masculino', '5520000185', 'Calle Salud 185, Colonia Centro', 'Presión arterial alta', '2026-07-09 01:00:00', 'A+', '1950-05-17'),
(186, 'Diego', 'Flores Mendoza', 77, 'Femenino', '5520000186', 'Calle Salud 186, Colonia Centro', 'Infección respiratoria', '2026-07-09 02:00:00', 'A-', '1949-06-18'),
(187, 'Fernanda', 'Gómez Castro', 78, 'Masculino', '5520000187', 'Calle Salud 187, Colonia Centro', 'Dolor muscular', '2026-07-09 03:00:00', 'B+', '1948-07-19'),
(188, 'Jorge', 'Díaz Morales', 79, 'Femenino', '5520000188', 'Calle Salud 188, Colonia Centro', 'Revisión médica', '2026-07-09 04:00:00', 'B-', '1947-08-20'),
(189, 'Paola', 'Vargas Reyes', 80, 'Masculino', '5520000189', 'Calle Salud 189, Colonia Centro', 'Alergia', '2026-07-09 05:00:00', 'AB+', '1946-09-21'),
(190, 'Andrés', 'Cruz Ortiz', 18, 'Femenino', '5520000190', 'Calle Salud 190, Colonia Centro', 'Control preventivo', '2026-07-09 06:00:00', 'AB-', '2008-10-22'),
(191, 'Daniela', 'Jiménez Navarro', 19, 'Masculino', '5520000191', 'Calle Salud 191, Colonia Centro', 'Consulta general', '2026-07-09 07:00:00', 'O+', '2007-11-23'),
(192, 'Ricardo', 'Moreno Romero', 20, 'Femenino', '5520000192', 'Calle Salud 192, Colonia Centro', 'Dolor de cabeza', '2026-07-09 08:00:00', 'O-', '2006-12-24'),
(193, 'Natalia', 'Ruiz Silva', 21, 'Masculino', '5520000193', 'Calle Salud 193, Colonia Centro', 'Fiebre', '2026-07-09 09:00:00', 'A+', '2005-01-25'),
(194, 'Emilio', 'Álvarez Rojas', 22, 'Femenino', '5520000194', 'Calle Salud 194, Colonia Centro', 'Dolor abdominal', '2026-07-09 10:00:00', 'A-', '2004-02-26'),
(195, 'Alejandra', 'Soto Aguilar', 23, 'Masculino', '5520000195', 'Calle Salud 195, Colonia Centro', 'Presión arterial alta', '2026-07-09 11:00:00', 'B+', '2003-03-27'),
(196, 'Fernando', 'Méndez Campos', 24, 'Femenino', '5520000196', 'Calle Salud 196, Colonia Centro', 'Infección respiratoria', '2026-07-09 12:00:00', 'B-', '2002-04-28'),
(197, 'Gabriela', 'Ortega Vega', 25, 'Masculino', '5520000197', 'Calle Salud 197, Colonia Centro', 'Dolor muscular', '2026-07-09 13:00:00', 'AB+', '2001-05-01'),
(198, 'Roberto', 'Guerrero Luna', 26, 'Femenino', '5520000198', 'Calle Salud 198, Colonia Centro', 'Revisión médica', '2026-07-09 14:00:00', 'AB-', '2000-06-02'),
(199, 'Mariana', 'Castillo Medina', 27, 'Masculino', '5520000199', 'Calle Salud 199, Colonia Centro', 'Alergia', '2026-07-09 15:00:00', 'O+', '1999-07-03'),
(200, 'Eduardo', 'Ramos Cabrera', 28, 'Femenino', '5520000200', 'Calle Salud 200, Colonia Centro', 'Control preventivo', '2026-07-09 16:00:00', 'O-', '1998-08-04'),
(201, 'Juan', 'Pérez García', 29, 'Masculino', '5520000201', 'Calle Salud 201, Colonia Centro', 'Consulta general', '2026-07-09 17:00:00', 'A+', '1997-09-05'),
(202, 'María', 'López Hernández', 30, 'Femenino', '5520000202', 'Calle Salud 202, Colonia Centro', 'Dolor de cabeza', '2026-07-09 18:00:00', 'A-', '1996-10-06'),
(203, 'Carlos', 'Martínez Sánchez', 31, 'Masculino', '5520000203', 'Calle Salud 203, Colonia Centro', 'Fiebre', '2026-07-09 19:00:00', 'B+', '1995-11-07'),
(204, 'Ana', 'González Ramírez', 32, 'Femenino', '5520000204', 'Calle Salud 204, Colonia Centro', 'Dolor abdominal', '2026-07-09 20:00:00', 'B-', '1994-12-08'),
(205, 'Luis', 'Rodríguez Torres', 33, 'Masculino', '5520000205', 'Calle Salud 205, Colonia Centro', 'Presión arterial alta', '2026-07-09 21:00:00', 'AB+', '1993-01-09'),
(206, 'Sofía', 'Flores Mendoza', 34, 'Femenino', '5520000206', 'Calle Salud 206, Colonia Centro', 'Infección respiratoria', '2026-07-09 22:00:00', 'AB-', '1992-02-10'),
(207, 'José', 'Gómez Castro', 35, 'Masculino', '5520000207', 'Calle Salud 207, Colonia Centro', 'Dolor muscular', '2026-07-09 23:00:00', 'O+', '1991-03-11'),
(208, 'Valentina', 'Díaz Morales', 36, 'Femenino', '5520000208', 'Calle Salud 208, Colonia Centro', 'Revisión médica', '2026-07-10 00:00:00', 'O-', '1990-04-12'),
(209, 'Miguel', 'Vargas Reyes', 37, 'Masculino', '5520000209', 'Calle Salud 209, Colonia Centro', 'Alergia', '2026-07-10 01:00:00', 'A+', '1989-05-13'),
(210, 'Camila', 'Cruz Ortiz', 38, 'Femenino', '5520000210', 'Calle Salud 210, Colonia Centro', 'Control preventivo', '2026-07-10 02:00:00', 'A-', '1988-06-14'),
(211, 'Diego', 'Jiménez Navarro', 39, 'Masculino', '5520000211', 'Calle Salud 211, Colonia Centro', 'Consulta general', '2026-07-10 03:00:00', 'B+', '1987-07-15'),
(212, 'Fernanda', 'Moreno Romero', 40, 'Femenino', '5520000212', 'Calle Salud 212, Colonia Centro', 'Dolor de cabeza', '2026-07-10 04:00:00', 'B-', '1986-08-16'),
(213, 'Jorge', 'Ruiz Silva', 41, 'Masculino', '5520000213', 'Calle Salud 213, Colonia Centro', 'Fiebre', '2026-07-10 05:00:00', 'AB+', '1985-09-17'),
(214, 'Paola', 'Álvarez Rojas', 42, 'Femenino', '5520000214', 'Calle Salud 214, Colonia Centro', 'Dolor abdominal', '2026-07-10 06:00:00', 'AB-', '1984-10-18'),
(215, 'Andrés', 'Soto Aguilar', 43, 'Masculino', '5520000215', 'Calle Salud 215, Colonia Centro', 'Presión arterial alta', '2026-07-10 07:00:00', 'O+', '1983-11-19'),
(216, 'Daniela', 'Méndez Campos', 44, 'Femenino', '5520000216', 'Calle Salud 216, Colonia Centro', 'Infección respiratoria', '2026-07-10 08:00:00', 'O-', '1982-12-20'),
(217, 'Ricardo', 'Ortega Vega', 45, 'Masculino', '5520000217', 'Calle Salud 217, Colonia Centro', 'Dolor muscular', '2026-07-10 09:00:00', 'A+', '1981-01-21'),
(218, 'Natalia', 'Guerrero Luna', 46, 'Femenino', '5520000218', 'Calle Salud 218, Colonia Centro', 'Revisión médica', '2026-07-10 10:00:00', 'A-', '1980-02-22'),
(219, 'Emilio', 'Castillo Medina', 47, 'Masculino', '5520000219', 'Calle Salud 219, Colonia Centro', 'Alergia', '2026-07-10 11:00:00', 'B+', '1979-03-23'),
(220, 'Alejandra', 'Ramos Cabrera', 48, 'Femenino', '5520000220', 'Calle Salud 220, Colonia Centro', 'Control preventivo', '2026-07-10 12:00:00', 'B-', '1978-04-24'),
(221, 'Fernando', 'Pérez García', 49, 'Masculino', '5520000221', 'Calle Salud 221, Colonia Centro', 'Consulta general', '2026-07-10 13:00:00', 'AB+', '1977-05-25'),
(222, 'Gabriela', 'López Hernández', 50, 'Femenino', '5520000222', 'Calle Salud 222, Colonia Centro', 'Dolor de cabeza', '2026-07-10 14:00:00', 'AB-', '1976-06-26'),
(223, 'Roberto', 'Martínez Sánchez', 51, 'Masculino', '5520000223', 'Calle Salud 223, Colonia Centro', 'Fiebre', '2026-07-10 15:00:00', 'O+', '1975-07-27'),
(224, 'Mariana', 'González Ramírez', 52, 'Femenino', '5520000224', 'Calle Salud 224, Colonia Centro', 'Dolor abdominal', '2026-07-10 16:00:00', 'O-', '1974-08-28'),
(225, 'Eduardo', 'Rodríguez Torres', 53, 'Masculino', '5520000225', 'Calle Salud 225, Colonia Centro', 'Presión arterial alta', '2026-07-10 17:00:00', 'A+', '1973-09-01'),
(226, 'Juan', 'Flores Mendoza', 54, 'Femenino', '5520000226', 'Calle Salud 226, Colonia Centro', 'Infección respiratoria', '2026-07-10 18:00:00', 'A-', '1972-10-02'),
(227, 'María', 'Gómez Castro', 55, 'Masculino', '5520000227', 'Calle Salud 227, Colonia Centro', 'Dolor muscular', '2026-07-10 19:00:00', 'B+', '1971-11-03'),
(228, 'Carlos', 'Díaz Morales', 56, 'Femenino', '5520000228', 'Calle Salud 228, Colonia Centro', 'Revisión médica', '2026-07-10 20:00:00', 'B-', '1970-12-04'),
(229, 'Ana', 'Vargas Reyes', 57, 'Masculino', '5520000229', 'Calle Salud 229, Colonia Centro', 'Alergia', '2026-07-10 21:00:00', 'AB+', '1969-01-05'),
(230, 'Luis', 'Cruz Ortiz', 58, 'Femenino', '5520000230', 'Calle Salud 230, Colonia Centro', 'Control preventivo', '2026-07-10 22:00:00', 'AB-', '1968-02-06'),
(231, 'Sofía', 'Jiménez Navarro', 59, 'Masculino', '5520000231', 'Calle Salud 231, Colonia Centro', 'Consulta general', '2026-07-10 23:00:00', 'O+', '1967-03-07'),
(232, 'José', 'Moreno Romero', 60, 'Femenino', '5520000232', 'Calle Salud 232, Colonia Centro', 'Dolor de cabeza', '2026-07-11 00:00:00', 'O-', '1966-04-08'),
(233, 'Valentina', 'Ruiz Silva', 61, 'Masculino', '5520000233', 'Calle Salud 233, Colonia Centro', 'Fiebre', '2026-07-11 01:00:00', 'A+', '1965-05-09'),
(234, 'Miguel', 'Álvarez Rojas', 62, 'Femenino', '5520000234', 'Calle Salud 234, Colonia Centro', 'Dolor abdominal', '2026-07-11 02:00:00', 'A-', '1964-06-10'),
(235, 'Camila', 'Soto Aguilar', 63, 'Masculino', '5520000235', 'Calle Salud 235, Colonia Centro', 'Presión arterial alta', '2026-07-11 03:00:00', 'B+', '1963-07-11'),
(236, 'Diego', 'Méndez Campos', 64, 'Femenino', '5520000236', 'Calle Salud 236, Colonia Centro', 'Infección respiratoria', '2026-07-11 04:00:00', 'B-', '1962-08-12'),
(237, 'Fernanda', 'Ortega Vega', 65, 'Masculino', '5520000237', 'Calle Salud 237, Colonia Centro', 'Dolor muscular', '2026-07-11 05:00:00', 'AB+', '1961-09-13'),
(238, 'Jorge', 'Guerrero Luna', 66, 'Femenino', '5520000238', 'Calle Salud 238, Colonia Centro', 'Revisión médica', '2026-07-11 06:00:00', 'AB-', '1960-10-14'),
(239, 'Paola', 'Castillo Medina', 67, 'Masculino', '5520000239', 'Calle Salud 239, Colonia Centro', 'Alergia', '2026-07-11 07:00:00', 'O+', '1959-11-15'),
(240, 'Andrés', 'Ramos Cabrera', 68, 'Femenino', '5520000240', 'Calle Salud 240, Colonia Centro', 'Control preventivo', '2026-07-11 08:00:00', 'O-', '1958-12-16'),
(241, 'Daniela', 'Pérez García', 69, 'Masculino', '5520000241', 'Calle Salud 241, Colonia Centro', 'Consulta general', '2026-07-11 09:00:00', 'A+', '1957-01-17'),
(242, 'Ricardo', 'López Hernández', 70, 'Femenino', '5520000242', 'Calle Salud 242, Colonia Centro', 'Dolor de cabeza', '2026-07-11 10:00:00', 'A-', '1956-02-18'),
(243, 'Natalia', 'Martínez Sánchez', 71, 'Masculino', '5520000243', 'Calle Salud 243, Colonia Centro', 'Fiebre', '2026-07-11 11:00:00', 'B+', '1955-03-19'),
(244, 'Emilio', 'González Ramírez', 72, 'Femenino', '5520000244', 'Calle Salud 244, Colonia Centro', 'Dolor abdominal', '2026-07-11 12:00:00', 'B-', '1954-04-20'),
(245, 'Alejandra', 'Rodríguez Torres', 73, 'Masculino', '5520000245', 'Calle Salud 245, Colonia Centro', 'Presión arterial alta', '2026-07-11 13:00:00', 'AB+', '1953-05-21'),
(246, 'Fernando', 'Flores Mendoza', 74, 'Femenino', '5520000246', 'Calle Salud 246, Colonia Centro', 'Infección respiratoria', '2026-07-11 14:00:00', 'AB-', '1952-06-22'),
(247, 'Gabriela', 'Gómez Castro', 75, 'Masculino', '5520000247', 'Calle Salud 247, Colonia Centro', 'Dolor muscular', '2026-07-11 15:00:00', 'O+', '1951-07-23'),
(248, 'Roberto', 'Díaz Morales', 76, 'Femenino', '5520000248', 'Calle Salud 248, Colonia Centro', 'Revisión médica', '2026-07-11 16:00:00', 'O-', '1950-08-24'),
(249, 'Mariana', 'Vargas Reyes', 77, 'Masculino', '5520000249', 'Calle Salud 249, Colonia Centro', 'Alergia', '2026-07-11 17:00:00', 'A+', '1949-09-25'),
(250, 'Eduardo', 'Cruz Ortiz', 78, 'Femenino', '5520000250', 'Calle Salud 250, Colonia Centro', 'Control preventivo', '2026-07-11 18:00:00', 'A-', '1948-10-26'),
(251, 'CLEMENTE', 'AGUILAR JIMENEZ', 36, 'Masculino', '5565424795', 'CAMINO A TEZOPILO  MNZ6 LT', 'TIENE DIABETES', '2026-07-12 16:49:00', 'O+', '1990-10-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int NOT NULL,
  `id_cita` int NOT NULL,
  `medicamento` varchar(100) NOT NULL,
  `dosis` varchar(50) NOT NULL,
  `indicaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_cita`, `medicamento`, `dosis`, `indicaciones`) VALUES
(1, 1, 'Paracetamol', '500 mg cada 8 horas', 'Tomar después de los alimentos durante cinco días.'),
(2, 2, 'Ibuprofeno', '400 mg cada 12 horas', 'Mantener reposo y tomar abundantes líquidos.'),
(3, 3, 'Amoxicilina', 'Una tableta cada 24 horas', 'No suspender el tratamiento sin indicación médica.'),
(4, 4, 'Loratadina', '5 ml cada 8 horas', 'Evitar alimentos irritantes durante el tratamiento.'),
(5, 5, 'Omeprazol', 'Una cápsula antes del desayuno', 'Tomar a la misma hora todos los días.'),
(6, 6, 'Metformina', 'Una tableta por la noche', 'Regresar a consulta si los síntomas continúan.'),
(7, 7, 'Losartán', '500 mg cada 8 horas', 'Tomar después de los alimentos durante cinco días.'),
(8, 8, 'Diclofenaco', '400 mg cada 12 horas', 'Mantener reposo y tomar abundantes líquidos.'),
(9, 9, 'Azitromicina', 'Una tableta cada 24 horas', 'No suspender el tratamiento sin indicación médica.'),
(10, 10, 'Naproxeno', '5 ml cada 8 horas', 'Evitar alimentos irritantes durante el tratamiento.'),
(11, 11, 'Paracetamol', 'Una cápsula antes del desayuno', 'Tomar a la misma hora todos los días.'),
(12, 12, 'Ibuprofeno', 'Una tableta por la noche', 'Regresar a consulta si los síntomas continúan.'),
(13, 13, 'Amoxicilina', '500 mg cada 8 horas', 'Tomar después de los alimentos durante cinco días.'),
(14, 14, 'Loratadina', '400 mg cada 12 horas', 'Mantener reposo y tomar abundantes líquidos.'),
(15, 15, 'Omeprazol', 'Una tableta cada 24 horas', 'No suspender el tratamiento sin indicación médica.'),
(16, 16, 'Metformina', '5 ml cada 8 horas', 'Evitar alimentos irritantes durante el tratamiento.'),
(17, 17, 'Losartán', 'Una cápsula antes del desayuno', 'Tomar a la misma hora todos los días.'),
(18, 18, 'Diclofenaco', 'Una tableta por la noche', 'Regresar a consulta si los síntomas continúan.'),
(19, 19, 'Azitromicina', '500 mg cada 8 horas', 'Tomar después de los alimentos durante cinco días.'),
(20, 20, 'Naproxeno', '400 mg cada 12 horas', 'Mantener reposo y tomar abundantes líquidos.'),
(21, 21, 'Paracetamol', 'Una tableta cada 24 horas', 'No suspender el tratamiento sin indicación médica.'),
(22, 22, 'Ibuprofeno', '5 ml cada 8 horas', 'Evitar alimentos irritantes durante el tratamiento.'),
(23, 23, 'Amoxicilina', 'Una cápsula antes del desayuno', 'Tomar a la misma hora todos los días.'),
(24, 24, 'Loratadina', 'Una tableta por la noche', 'Regresar a consulta si los síntomas continúan.'),
(25, 25, 'Omeprazol', '500 mg cada 8 horas', 'Tomar después de los alimentos durante cinco días.'),
(26, 26, 'PARACETAMOL', '500mg cada 8 horas', 'Tomarlo por 7 dias hasta que acabe el tratamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Administrador','Medico') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `rol`) VALUES
(1, 'ING Emilio', '1234', 'Administrador'),
(2, 'ING Zahira', '1234', 'Administrador'),
(3, 'ING Evelyn', '1234', 'Administrador'),
(4, 'ING Rocio', '1234', 'Administrador'),
(5, 'Dr. Ale', '1234', 'Medico'),
(6, 'Dra. Dani', '1234', 'Medico'),
(7, 'Dr. Robert', '1234', 'Medico'),
(8, 'Dra. Mari', '1234', 'Medico'),
(9, 'Dr. Fer', '1234', 'Medico'),
(10, 'Dra. Gabi', '1234', 'Medico'),
(11, 'Dr. Richard', '1234', 'Medico'),
(12, 'Dra. Nataly', '1234', 'Medico'),
(13, 'Dr. Eduard', '1234', 'Medico'),
(14, 'Dra. Lari', '1234', 'Medico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_habitacion` (`id_habitacion`,`id_paciente`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
