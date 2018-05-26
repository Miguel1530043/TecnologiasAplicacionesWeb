-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2018 a las 05:48:43
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
-- Base de datos: `practica08`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `matricula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `carrera` int(11) NOT NULL,
  `tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`matricula`, `nombre`, `carrera`, `tutor`) VALUES
(1, 'Miguel Angel HernÃ¡ndez RodrÃ­guez', 6, 1),
(4, 'Jorge Enrique HernÃ¡ndez RodrÃ­guez', 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_tutoria`
--

CREATE TABLE `alumno_tutoria` (
  `id_alumno` int(11) NOT NULL,
  `id_tutoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`) VALUES
(6, 'Ingenieria en Tencologias de la Informacion'),
(8, 'Ingenieria en Mecatronica'),
(9, 'Licenciatura en Administracion y Gestion de PequeÃ'),
(10, 'IngenierÃ­a en Mecatronica'),
(11, 'IngenierÃ­a en Sistemas Automotrices');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `numero` int(11) NOT NULL,
  `carrera` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`numero`, `carrera`, `nombre`, `email`, `password`) VALUES
(1, 6, 'Mario Rodriguez Chavez', 'mrodriguezc@upv.edu.mx', 'mario'),
(3, 8, 'Marcela Rodriguez', 'marcela@gmail.com', 'marcela'),
(4, 6, 'Jose Manuel', 'jose@gmail.com', 'j jn'),
(7, 6, 'Jose', 'jose@corre.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `id` int(11) NOT NULL,
  `tutor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `tipo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`id`, `tutor`, `fecha`, `hora`, `descripcion`, `tipo`) VALUES
(2, 1, '2017-12-31', '11:58', 'MSIXMI', 'Individual');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `alumno_ibfk_1` (`carrera`),
  ADD KEY `tutor` (`tutor`);

--
-- Indices de la tabla `alumno_tutoria`
--
ALTER TABLE `alumno_tutoria`
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_tutoria` (`id_tutoria`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor` (`tutor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `maestro`
--
ALTER TABLE `maestro`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`tutor`) REFERENCES `maestro` (`numero`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `alumno_tutoria`
--
ALTER TABLE `alumno_tutoria`
  ADD CONSTRAINT `alumno_tutoria_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`matricula`),
  ADD CONSTRAINT `alumno_tutoria_ibfk_2` FOREIGN KEY (`id_tutoria`) REFERENCES `tutoria` (`id`);

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `maestro_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`id`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD CONSTRAINT `tutoria_ibfk_1` FOREIGN KEY (`tutor`) REFERENCES `maestro` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
