-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2018 a las 00:09:44
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
-- Base de datos: `practica06`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `position` varchar(256) NOT NULL,
  `carrier` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `sport` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sport`
--

INSERT INTO `sport` (`id`, `name`, `position`, `carrier`, `email`, `sport`) VALUES
(7, 'Cristiano Ronaldo', 'Delantero', 'Ingenieria en Mecatronica', 'cristiano@gmail.com', 'FootBall'),
(101, 'Michael Jordan', 'Alero', 'Ingenieria en Mecatronica', 'michael_jordan@gmail.com', 'BasketBall');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `status_id`, `user_type_id`) VALUES
(1, 'admin@correo.com', '12345678', 1, 2),
(2, 'bernardo@correo.com', '23456789', 1, 1),
(3, 'sergio@correo.com', '34567890', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `date_logged_in` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_log`
--

INSERT INTO `user_log` (`id`, `date_logged_in`, `user_id`) VALUES
(1, '2015-11-11', 1),
(2, '2016-03-01', 1),
(3, '2016-03-02', 2),
(4, '2016-03-03', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Final'),
(2, 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_status_idx` (`status_id`),
  ADD KEY `fk_user_user_type1_idx` (`user_type_id`);

--
-- Indices de la tabla `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_log_user1_idx` (`user_id`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `fk_user_log_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
