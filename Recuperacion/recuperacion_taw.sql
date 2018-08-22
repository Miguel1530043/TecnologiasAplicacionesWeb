-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-08-2018 a las 13:56:42
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
-- Base de datos: `recuperacion_taw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(7) NOT NULL,
  `clave` int(11) NOT NULL,
  `clave_alterna` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `servicio` int(1) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `unidad_compra` int(11) NOT NULL,
  `unidad_venta` int(11) NOT NULL,
  `factor` int(11) NOT NULL,
  `iva` int(1) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `precio_compra_iva` int(11) NOT NULL,
  `precio_compra_promedio` int(11) NOT NULL,
  `precio_compra_iva_promedio` int(11) NOT NULL,
  `precio1` int(11) NOT NULL,
  `precio2` int(11) NOT NULL,
  `precio3` int(11) NOT NULL,
  `precio4` int(11) NOT NULL,
  `precio_venta1` int(11) NOT NULL,
  `precio_venta2` int(11) NOT NULL,
  `precio_venta3` int(11) NOT NULL,
  `precio_venta4` int(11) NOT NULL,
  `unidades_mayoreo1` int(11) NOT NULL,
  `unidades_mayoreo2` int(11) NOT NULL,
  `unidades_mayoreo3` int(11) NOT NULL,
  `unidades_mayoreo4` int(11) NOT NULL,
  `imagen` varchar(50000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `clave`, `clave_alterna`, `descripcion`, `servicio`, `categoria`, `departamento`, `unidad_compra`, `unidad_venta`, `factor`, `iva`, `precio_compra`, `precio_compra_iva`, `precio_compra_promedio`, `precio_compra_iva_promedio`, `precio1`, `precio2`, `precio3`, `precio4`, `precio_venta1`, `precio_venta2`, `precio_venta3`, `precio_venta4`, `unidades_mayoreo1`, `unidades_mayoreo2`, `unidades_mayoreo3`, `unidades_mayoreo4`, `imagen`) VALUES
(2, 999111, 9991112, 'Lentes para el sol', 0, 'ACCESORIOS', 'LIQUIDACION', 1, 1, 1, 1, 400, 464, 380, 441, 400, 400, 400, 400, 650, 650, 650, 650, 9770, 100, 100, 100, 'views/img/lentes.jpg'),
(3, 9999, 999998, 'imimi', 1, 'HERRAMIENTAS', 'ESCOLARES', 11, 1111, 22, 1, 2222, 2578, 222, 258, 222, 222, 222, 22, 22, 22, 222, 222, 20, 22, 22, 22, 'views/img/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'ACCESORIOS'),
(2, 'HERRAMIENTAS'),
(3, 'LIBROS Y CUADERNOS'),
(4, 'ROPA'),
(5, 'AUTOMOVILES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `fecha`, `total`) VALUES
(1, 2018, 6500),
(2, 2018, 6500),
(3, 2018, 6500),
(4, 2018, 6500),
(5, 2018, 6500),
(6, 2018, 6500),
(7, 2018, 72150),
(8, 2018, 72150),
(9, 2018, 65000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_articulo`
--

CREATE TABLE `compras_articulo` (
  `id_compra` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `clave` int(11) NOT NULL,
  `nombre_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_articulo`
--

INSERT INTO `compras_articulo` (`id_compra`, `id_articulo`, `clave`, `nombre_articulo`, `cantidad`, `precio`) VALUES
(9, 2, 999111, 0, 100, 65000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`) VALUES
(1, 'CARROZERIA'),
(2, 'LIQUIDACION'),
(3, 'VESTIMENTA'),
(4, 'ESCOLARES'),
(5, 'PLOMERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `nombre_articulo` varchar(200) NOT NULL,
  `referencia` varchar(200) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_articulo`, `nombre_articulo`, `referencia`, `comentario`, `cantidad`, `fecha`) VALUES
(1, 2, 'Lentes para el sol', '91919', 'hola', 129, '2018-08-22'),
(2, 2, 'Lentes para el sol', '9112', 'Para ya no tener', 1299, '2018-08-22'),
(3, 2, 'Lentes para el sol', 'i191', 'Miguel', 1000, '2018-08-22'),
(4, 2, 'Lentes para el sol', '991919191', 'hola', 999, '2018-08-22'),
(5, 2, 'Lentes para el sol', '1001', 'Necesarios', 10000, '2018-08-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`) VALUES
(1, '2065-00-00', 2018),
(2, '2065-00-00', 2018),
(3, '2065-00-00', 2018),
(4, '0000-00-00', 2018),
(5, '0000-00-00', 2018),
(6, '0000-00-00', 2018),
(7, '0000-00-00', 2018),
(8, '0000-00-00', 2018),
(9, '0000-00-00', 2018),
(10, '0000-00-00', 2018),
(11, '2018-08-22', 330),
(12, '2018-08-22', 11700),
(13, '2018-08-22', 24442),
(14, '2018-08-22', 650),
(15, '2018-08-22', 650),
(16, '2018-08-22', 72150),
(17, '2018-08-22', 438750),
(18, '2018-08-22', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_articulo`
--

CREATE TABLE `venta_articulo` (
  `id_venta` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `clave` int(11) NOT NULL,
  `nombre_articulo` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_articulo`
--

INSERT INTO `venta_articulo` (`id_venta`, `id_articulo`, `clave`, `nombre_articulo`, `cantidad`, `precio`) VALUES
(16, 2, 999111, '0', 111, 72150),
(17, 2, 999111, 'Lentes para el sol', 9, 5850),
(17, 2, 999111, 'Lentes para el sol', 666, 432900);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_articulo`
--
ALTER TABLE `compras_articulo`
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_articulo`
--
ALTER TABLE `venta_articulo`
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras_articulo`
--
ALTER TABLE `compras_articulo`
  ADD CONSTRAINT `compras_articulo_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `compras_articulo_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`);

--
-- Filtros para la tabla `venta_articulo`
--
ALTER TABLE `venta_articulo`
  ADD CONSTRAINT `venta_articulo_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `venta_articulo_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
