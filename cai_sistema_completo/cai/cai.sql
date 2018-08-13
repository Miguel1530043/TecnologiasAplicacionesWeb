-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2018 a las 11:55:56
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` int(7) NOT NULL,
  `nombre_alumno` varchar(255) COLLATE utf8_bin NOT NULL,
  `apellidos_alumno` varchar(255) COLLATE utf8_bin NOT NULL,
  `carrera` varchar(255) COLLATE utf8_bin NOT NULL,
  `grupo` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `nombre_alumno`, `apellidos_alumno`, `carrera`, `grupo`, `email`) VALUES
(1530100, 'Gerardo ', 'Cedillo ', 'Ingenieria en Sistemas Automotries', 7, 'gerardo@upv.edu.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(255) COLLATE utf8_bin NOT NULL,
  `nivel` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `nivel`, `teacher`) VALUES
(6, '203-A', 5, 1928),
(7, '1-A', 9, 9928311);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `id_hora` int(11) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha` date NOT NULL,
  `unidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_alumno`
--

CREATE TABLE `horas_alumno` (
  `id_hora` int(11) NOT NULL,
  `matricula_alumno` int(11) NOT NULL,
  `actividad` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teachers`
--

CREATE TABLE `teachers` (
  `num_empleado` int(11) NOT NULL,
  `nombre_teacher` varchar(255) COLLATE utf8_bin NOT NULL,
  `apellidos_teacher` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `foto` varchar(5000) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `teachers`
--

INSERT INTO `teachers` (`num_empleado`, `nombre_teacher`, `apellidos_teacher`, `email`, `password`, `foto`, `telefono`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', 'views/img/', '000000000'),
(1928, 'Renata ', 'Baez Tijerina', 'rbaezt@upv.edu.mx', 'pancho', 'views/img/IMG-20171225-WA0015.jpg', '8341019574'),
(1982321, 'Mario Humberto', 'Rodriguez Chavez', 'mrodriguezc@upv.edu.mx', 'mario', 'views/img/vr7pFND.jpg', '8341234567'),
(9928311, 'Miguel', 'Hernandez', '1530043@upv.edu.mx', 'miguel', 'views/img/IMG-20170226-WA0006.jpg', '8342154699'),
(9999122, 'Osiel', 'Gomez Flores', 'osiel@upv.edu.mx', 'osielito', 'views/img/IMG-20180225-WA0003.jpg', '8341380235');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id_unidad` int(11) NOT NULL,
  `numero_unidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `grupos_ibfk_1` (`teacher`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id_hora`),
  ADD KEY `unidad` (`unidad`);

--
-- Indices de la tabla `horas_alumno`
--
ALTER TABLE `horas_alumno`
  ADD PRIMARY KEY (`id_hora`,`matricula_alumno`),
  ADD KEY `matricula_alumno` (`matricula_alumno`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`num_empleado`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id_unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `teachers` (`num_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horas`
--
ALTER TABLE `horas`
  ADD CONSTRAINT `horas_ibfk_1` FOREIGN KEY (`unidad`) REFERENCES `unidades` (`id_unidad`);

--
-- Filtros para la tabla `horas_alumno`
--
ALTER TABLE `horas_alumno`
  ADD CONSTRAINT `horas_alumno_ibfk_1` FOREIGN KEY (`id_hora`) REFERENCES `horas` (`id_hora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `horas_alumno_ibfk_2` FOREIGN KEY (`matricula_alumno`) REFERENCES `alumnos` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
