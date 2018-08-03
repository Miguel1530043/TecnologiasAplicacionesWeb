-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2018 a las 15:33:42
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
(161616, 'juanita', 'juanes', 'Ingenieria en Sistemas Automotries', 6, 'juanita@hotmail.com'),
(191919, 'pedrito', 'almaraz', 'Ingenieria en Sistemas Automotries', 8, 'pedrito@hotmail.com'),
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
(7, '1-A', 9, 9928311),
(8, '809-A', 4, 161999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `id_hora` int(11) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`id_hora`, `hora_entrada`, `hora_salida`, `fecha`) VALUES
(1, '05:13:00', '06:09:33', '2018-07-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_alumno`
--

CREATE TABLE `horas_alumno` (
  `id_hora` int(11) NOT NULL,
  `matricula_alumno` int(11) NOT NULL,
  `actividad` varchar(255) COLLATE utf8_bin NOT NULL,
  `unidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `horas_alumno`
--

INSERT INTO `horas_alumno` (`id_hora`, `matricula_alumno`, `actividad`, `unidad`) VALUES
(1, 1530100, 'Reading', 1);

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
(29812, 'Mariana', 'hinojosa', 'mariana@gmail.com', 'mariana', 'views/img/3.jpg', '8347638888'),
(161999, 'juan de dios', 'de dios', 'juan@gmail', 'juan', 'views/img/3d_star_abstract-1024x768.jpg', '88989'),
(1982321, 'Mario Humberto', 'Rodriguez Chavez', 'mrodriguezc@upv.edu.mx', 'mario', 'views/img/vr7pFND.jpg', '8341234567'),
(9928311, 'Miguel', 'Hernandez', '1530043@upv.edu.mx', 'miguel', 'views/img/IMG-20170226-WA0006.jpg', '8342154699'),
(9999122, 'Osiel', 'Gomez Flores', 'osiel@upv.edu.mx', 'osielito', 'views/img/abstract-desktop-wallpaper-g-picture-7-photo-stock-7.jpg', '8341380235');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `fecha_inicio`, `fecha_termino`) VALUES
(1, '2018-05-01', '2018-05-25'),
(2, '2018-05-28', '2018-06-22'),
(3, '2018-06-25', '2018-07-13'),
(4, '2018-07-30', '2018-08-17');

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
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `horas_alumno`
--
ALTER TABLE `horas_alumno`
  ADD PRIMARY KEY (`id_hora`,`matricula_alumno`),
  ADD KEY `matricula_alumno` (`matricula_alumno`),
  ADD KEY `unidad` (`unidad`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`num_empleado`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Filtros para la tabla `horas_alumno`
--
ALTER TABLE `horas_alumno`
  ADD CONSTRAINT `horas_alumno_ibfk_1` FOREIGN KEY (`id_hora`) REFERENCES `horas` (`id_hora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `horas_alumno_ibfk_2` FOREIGN KEY (`matricula_alumno`) REFERENCES `alumnos` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `horas_alumno_ibfk_3` FOREIGN KEY (`unidad`) REFERENCES `unidad` (`id_unidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
