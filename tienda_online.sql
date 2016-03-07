-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2016 a las 10:58:42
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(450) DEFAULT NULL,
  `Descripcion` text,
  `Anuncio` text,
  `Oculto` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Codigo`, `Nombre`, `Descripcion`, `Anuncio`, `Oculto`) VALUES
(1, 'Aves', 'Especie Ave', NULL, 'F'),
(2, 'Perros', 'Especie Canina', NULL, 'F'),
(3, 'Gatos', 'Especie Felina', NULL, 'F'),
(4, 'Reptiles', 'Especie Reptil', NULL, 'F'),
(5, 'Peces', 'Entorno Acuatico', NULL, 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compradores`
--

CREATE TABLE `compradores` (
  `Codigo` int(11) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Nombre_usuario` varchar(45) NOT NULL,
  `Contrasena` varchar(120) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `CP` varchar(45) NOT NULL,
  `Provincias` varchar(45) NOT NULL,
  `Borrado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compradores`
--

INSERT INTO `compradores` (`Codigo`, `DNI`, `Nombre`, `Nombre_usuario`, `Contrasena`, `Correo`, `Direccion`, `CP`, `Provincias`, `Borrado`) VALUES
(1, '44240482-M', 'Juan Rodriguez Becerro', 'JuanRo', '1234', 'adriangirolmontes@gmail.com', 'El cerro, 4', '21863', 'Huelva', 'N'),
(6, '44240482-M', 'Adrian Girol Montes Modificado', 'adriangirolmontes', '12345', 'adriangirolmontes@gmail.com', 'Don francisco Romero 42', '21600', 'Huelva', NULL),
(7, '44444222-D', 'Borja', 'borja', '12345', 'borjaramos7@gmail.com', 'Josefita 56', '23401', 'Huelva', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_de_pedido`
--

CREATE TABLE `lineas_de_pedido` (
  `Codigo_linea` int(11) NOT NULL,
  `Productos_Codigo` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Importe` decimal(7,2) DEFAULT NULL,
  `Pedidos_codigo_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineas_de_pedido`
--

INSERT INTO `lineas_de_pedido` (`Codigo_linea`, `Productos_Codigo`, `Cantidad`, `Importe`, `Pedidos_codigo_pedido`) VALUES
(1, 17, 1, '22.00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codigo_pedido` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `Estado` char(2) DEFAULT NULL,
  `Compradores_Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo_pedido`, `fecha`, `Estado`, `Compradores_Codigo`) VALUES
(1, '2016-02-26', 'NP', 6),
(2, '2016-02-26', 'NP', 6),
(3, '2016-02-26', 'NP', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Nombre` varchar(265) NOT NULL,
  `Codigo` int(11) NOT NULL,
  `Precio` decimal(7,2) DEFAULT NULL,
  `Descuento_aplicable` decimal(7,2) DEFAULT NULL,
  `Imagen_Producto` varchar(500) DEFAULT NULL,
  `IVA` int(11) DEFAULT NULL,
  `Descripcion` text,
  `Anuncio` text,
  `Categoria_Codigo` int(11) NOT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Destacado` char(1) DEFAULT NULL,
  `Fecha_ini_destacado` date DEFAULT NULL,
  `Fecha_fin_destacado` date DEFAULT NULL,
  ` Oculto` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Nombre`, `Codigo`, `Precio`, `Descuento_aplicable`, `Imagen_Producto`, `IVA`, `Descripcion`, `Anuncio`, `Categoria_Codigo`, `Stock`, `Destacado`, `Fecha_ini_destacado`, `Fecha_fin_destacado`, ` Oculto`) VALUES
('Persa', 9, '120.00', NULL, 'asset/plantilla/img/prueba.jpg', 21, 'Gato de raza persa', NULL, 3, 0, 'S', NULL, NULL, NULL),
(' Chino', 10, '256.00', NULL, 'asset/plantilla/img/maine.jpg', 21, 'Gato de raza china', NULL, 3, 0, 'S', NULL, NULL, NULL),
('Abisinio', 11, '84.00', NULL, 'asset/plantilla/img/abisino.jpg', 21, 'Raza abisino', NULL, 3, 0, 'S', NULL, NULL, NULL),
('Maine Coon', 12, '127.00', NULL, 'asset/plantilla/img/maine.jpg', 21, 'Raza Maine Coon', NULL, 3, 5, 'N', NULL, NULL, NULL),
('Ragdoll', 13, '276.00', NULL, 'asset/plantilla/img/.jpg', 21, 'Raza ragdoll', NULL, 3, 1, 'N', NULL, NULL, NULL),
('Bengala', 14, '81.00', NULL, 'asset/plantilla/img/.jpg', 21, 'Raza Bengala', NULL, 3, 9, 'N', NULL, NULL, NULL),
('bulldog', 15, '246.00', NULL, 'asset/plantilla/img/bulldog.jpg', 21, 'Raza Bullgod', NULL, 2, 2, 'S', NULL, NULL, NULL),
('Caniche', 16, '186.00', NULL, 'asset/plantilla/img/caniche.jpg', 21, 'Raza Caniche', NULL, 2, 1, 'S', NULL, NULL, NULL),
('Jilguero', 17, '22.00', NULL, 'asset/plantilla/img/jilguero.jpg', 21, 'Tipo Jilguero', NULL, 1, 12, 'S', NULL, NULL, NULL),
('Yorkside', 18, '96.86', NULL, 'asset/plantilla/img/Yorkside.jpg', 21, 'Perro de tamaño pequeño con padres de raza Yorkside.', NULL, 2, 12, 'S', NULL, NULL, NULL),
('Pastor Belga', 19, '206.08', NULL, 'asset/plantilla/img/PastorBelga.jpg', 21, 'Perro de tamaño grande, propio para cuidar grandes extensiones de terreno, adaptados al frío.', NULL, 2, 2, 'N', NULL, NULL, NULL),
('Agaporni', 20, '27.00', NULL, 'asset/plantilla/img/Agaporni.jpg', 21, 'Ave exotica  de tamaño pequeño, muy cariñosa y inteligente', NULL, 1, 12, 'S', NULL, NULL, NULL),
('Cacatua', 21, '75.00', NULL, 'asset/plantilla/img/Cacatua.jpg', 21, 'Ave exotica  de tamaño mediano, muy cariñosa y inteligente', NULL, 1, 12, 'N', NULL, NULL, NULL),
('Loro Yaco', 22, '75.00', NULL, 'asset/plantilla/img/Yaco.jpg', 21, 'Ave exotica  de tamaño Grande, charlatana y inteligente', NULL, 1, 12, 'N', NULL, NULL, NULL),
('Iguana', 23, '40.48', NULL, 'asset/plantilla/img/Iguana.jpg', NULL, 'Reptil verde, come insectos. De mediano tamaño', NULL, 4, 6, 'S', NULL, NULL, NULL),
('Iguana Crestada de Fiyi', 24, '82.48', NULL, 'asset/plantilla/img/IguanaFiyi.jpg', NULL, 'Reptil natural del caribe de origen exotico, come insectos. De mediano tamaño', NULL, 4, 6, 'S', NULL, NULL, NULL),
('Payaso', 25, '82.56', NULL, 'asset/plantilla/img/Payaso.jpg', NULL, 'Pez exotico de agua salada, de colores llamativos.', NULL, 5, 2, 'N', NULL, NULL, NULL),
('Globo', 26, '45.56', NULL, 'asset/plantilla/img/Globo.jpg', NULL, 'Pez exotico de agua salada,se hincha cuando se siente amenazado', NULL, 5, 2, 'S', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `compradores`
--
ALTER TABLE `compradores`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `lineas_de_pedido`
--
ALTER TABLE `lineas_de_pedido`
  ADD PRIMARY KEY (`Codigo_linea`),
  ADD KEY `fk_Productos_has_Pedidos_Productos1_idx` (`Productos_Codigo`),
  ADD KEY `fk_Lineas_de_pedido_Pedidos1_idx` (`Pedidos_codigo_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo_pedido`),
  ADD KEY `fk_Pedidos_Compradores1_idx` (`Compradores_Codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_Productos_Categoria_idx` (`Categoria_Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compradores`
--
ALTER TABLE `compradores`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `lineas_de_pedido`
--
ALTER TABLE `lineas_de_pedido`
  MODIFY `Codigo_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_de_pedido`
--
ALTER TABLE `lineas_de_pedido`
  ADD CONSTRAINT `fk_Productos_has_Pedidos_Productos1` FOREIGN KEY (`Productos_Codigo`) REFERENCES `productos` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_Pedidos_Compradores1` FOREIGN KEY (`Compradores_Codigo`) REFERENCES `compradores` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Categoria` FOREIGN KEY (`Categoria_Codigo`) REFERENCES `categorias` (`Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
