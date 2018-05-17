-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-05-2018 a las 05:54:38
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica7`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`) VALUES
(93939, 'Camisa', 300),
(99883, 'Zapatos', 900),
(120912, 'Pepsi 3lt', 18.2),
(994839, 'Pantalon', 500),
(1292039, 'Choookis', 16.29),
(2147483647, 'FRESCA 2LT', 20.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user_name`, `password`) VALUES
(1, 'Jorge123', '499f07ed426c4a2e6ba8177350ead3e7'),
(2, 'MiguelAngelHernÃ¡ndezRodrÃ­guez1530043', '9eb0c9605dc81a68731f61b3e0838937'),
(3, 'miguel123', '9eb0c9605dc81a68731f61b3e0838937'),
(4, 'Marcela', '9cdcde4755ceeb6b5ad173c606e8997a'),
(5, 'Marcela', '9cdcde4755ceeb6b5ad173c606e8997a'),
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `fecha`, `monto`) VALUES
(1, '2018-05-15', 200),
(2, '2018-05-16', 0),
(3, '2018-05-16', 0),
(4, '2018-05-16', 0),
(5, '2018-05-16', 0),
(6, '2018-05-16', 0),
(7, '2018-05-16', 0),
(8, '2018-05-16', 0),
(9, '2018-05-16', 800),
(10, '2018-05-16', 800),
(11, '2018-05-16', 300),
(12, '2018-05-16', 2600),
(13, '2018-05-16', 2600),
(14, '2018-05-16', 2600),
(15, '2018-05-16', 2600),
(16, '2018-05-16', 2600),
(17, '2018-05-16', 300),
(18, '2018-05-16', 1716.29),
(19, '2018-05-16', 9100),
(20, '2018-05-16', 2000),
(21, '2018-05-17', 5200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_venta`, `id_producto`, `cantidad`, `costo`) VALUES
(1, 93939, 10, 9999),
(17, 93939, 1, 300),
(18, 93939, 1, 300),
(18, 99883, 1, 900),
(18, 994839, 1, 500),
(18, 1292039, 1, 16.29),
(19, 93939, 9, 2700),
(19, 99883, 6, 5400),
(19, 994839, 2, 1000),
(20, 93939, 5, 1500),
(20, 994839, 1, 500),
(21, 93939, 9, 2700),
(21, 994839, 5, 2500);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
