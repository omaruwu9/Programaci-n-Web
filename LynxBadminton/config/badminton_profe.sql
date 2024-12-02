-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 01:13:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `badminton_profe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `no_serie` int(11) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `id_marca`, `no_serie`, `descripcion`) VALUES
(2, 1, 123456789, 'Balón de futbol '),
(3, 1, 1234589, 'Kit de 10 pares de calcetas'),
(6, 4, 771, 'Par de Tenis Rojos #26'),
(7, 7, 21321, 'Mochila');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_renta`
--

CREATE TABLE `estado_renta` (
  `id_estado_renta` int(11) NOT NULL,
  `estado_renta` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `estado_renta`
--

INSERT INTO `estado_renta` (`id_estado_renta`, `estado_renta`) VALUES
(1, 'Ocupado'),
(3, 'Libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_forma_pago` int(11) NOT NULL,
  `forma_pago` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id_forma_pago`, `forma_pago`) VALUES
(1, 'Tarjeta de credito'),
(2, 'Tarjeta de debito'),
(3, 'Efectivo'),
(6, 'Transferencia Interbancaria SPEI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(1, 'hombre'),
(2, 'mujer'),
(3, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(1, 'Void'),
(2, 'Nike'),
(4, 'Adidas'),
(5, 'Puma'),
(6, 'Fila'),
(7, 'Pirma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renta`
--

CREATE TABLE `renta` (
  `id_renta` int(11) NOT NULL,
  `id_usuario_empleado` int(11) DEFAULT NULL,
  `id_usuario_cliente` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `id_forma_pago` int(11) DEFAULT NULL,
  `id_estado_renta` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT curdate(),
  `hora` char(10) DEFAULT NULL,
  `duracion` char(40) DEFAULT NULL,
  `costo` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `renta`
--

INSERT INTO `renta` (`id_renta`, `id_usuario_empleado`, `id_usuario_cliente`, `id_equipo`, `id_forma_pago`, `id_estado_renta`, `fecha`, `hora`, `duracion`, `costo`) VALUES
(5, 10, 16, 2, 3, 1, '2024-11-30 00:00:00', '02:45:00', '01:00:00', '1500.00'),
(6, 17, 16, 6, 3, 1, '2024-12-01 00:00:00', '03:12:00', '02:00:00', '150.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `foto` mediumblob DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT current_timestamp(),
  `id_genero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_rol`, `nombres`, `apellidos`, `clave`, `foto`, `email`, `ultimo_acceso`, `id_genero`) VALUES
(10, 1, 'Omar', 'Patiño', '123', 0x6a7067, 'omar@gmail.com', '2024-10-17 09:46:10', 3),
(16, 2, 'Benjamin', 'Jaramillo', '123', 0x6a7067, 'benjamin@gmail.com', '2024-11-03 14:11:33', NULL),
(17, 1, 'Juan', 'Patino', '123', NULL, 'juan@gmail.com', '2024-11-03 14:17:25', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `no_serie` (`no_serie`),
  ADD KEY `fk_id_marca` (`id_marca`);

--
-- Indices de la tabla `estado_renta`
--
ALTER TABLE `estado_renta`
  ADD PRIMARY KEY (`id_estado_renta`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `renta`
--
ALTER TABLE `renta`
  ADD PRIMARY KEY (`id_renta`),
  ADD KEY `fk_id_usuario_empleado` (`id_usuario_empleado`),
  ADD KEY `fk_id_usuario_cliente` (`id_usuario_cliente`),
  ADD KEY `fk_id_equipo` (`id_equipo`),
  ADD KEY `fk_id_forma_pago` (`id_forma_pago`),
  ADD KEY `fk_id_estado_renta` (`id_estado_renta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_id_rol` (`id_rol`),
  ADD KEY `fk_usuario_genero` (`id_genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado_renta`
--
ALTER TABLE `estado_renta`
  MODIFY `id_estado_renta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `renta`
--
ALTER TABLE `renta`
  MODIFY `id_renta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Filtros para la tabla `renta`
--
ALTER TABLE `renta`
  ADD CONSTRAINT `fk_id_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`),
  ADD CONSTRAINT `fk_id_estado_renta` FOREIGN KEY (`id_estado_renta`) REFERENCES `estado_renta` (`id_estado_renta`),
  ADD CONSTRAINT `fk_id_forma_pago` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`),
  ADD CONSTRAINT `fk_id_usuario_cliente` FOREIGN KEY (`id_usuario_cliente`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_id_usuario_empleado` FOREIGN KEY (`id_usuario_empleado`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `fk_usuario_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
