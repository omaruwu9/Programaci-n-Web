-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 07:00:15
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
-- Base de datos: `scortsdb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_nuevo_usuario` (IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(50), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(100), IN `p_rol` ENUM('C','S'), IN `p_genero` ENUM('H','M','O'))   BEGIN
    DECLARE nuevo_id_usuario INT;

    -- Insertar el nuevo usuario en la tabla Usuario
    INSERT INTO Usuario (nombre, apellido, email, password, rol, genero)
    VALUES (p_nombre, p_apellido, p_email, p_password, p_rol, p_genero);

    -- Obtener el id del usuario recién insertado
    SET nuevo_id_usuario = LAST_INSERT_ID();

    -- Si el rol es 'Scort', insertar en la tabla Scort
    IF p_rol = 'Scort' THEN
        INSERT INTO Scort (id_scort, alias)
        VALUES (nuevo_id_usuario, p_nombre);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado_pago` varchar(50) DEFAULT NULL,
  `estatus` varchar(50) DEFAULT NULL,
  `no_transaccion` varchar(50) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL,
  `testimonio1` text DEFAULT NULL,
  `testimonio2` text DEFAULT NULL,
  `id_scort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `id_cliente`, `fecha`, `hora`, `monto`, `total`, `estado_pago`, `estatus`, `no_transaccion`, `id_pago`, `testimonio1`, `testimonio2`, `id_scort`) VALUES
(1, 26, '2024-12-04', '20:46:47', 300.00, 400.00, 'Pendiente', 'Pendiente', '123455', 1, ' ', 'mal servicio', 2),
(3, 26, '2024-12-05', '15:50:00', 0.00, NULL, 'Pendiente', 'Cancelado', NULL, 2, NULL, NULL, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`) VALUES
(26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `id_pago` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`id_pago`, `metodo_pago`) VALUES
(1, 'efectivo'),
(2, 'tarjeta'),
(3, 'transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(1, 'masculino'),
(2, 'femenino'),
(3, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasfrecuentes`
--

CREATE TABLE `preguntasfrecuentes` (
  `id_preguntas_frecuentes` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntasfrecuentes`
--

INSERT INTO `preguntasfrecuentes` (`id_preguntas_frecuentes`, `pregunta`, `respuesta`) VALUES
(1, '¿Cómo puedo reservar una cita?', 'Para reservar una cita, por favor, contacta a través de nuestro sistema de mensajes o mediante nuestro número de teléfono disponible en la página de contacto.'),
(2, '¿Cuáles son los servicios que ofrecen?', 'Ofrecemos una variedad de servicios, incluyendo acompañamiento, citas privadas, cenas, y más. Puedes consultar todos los detalles en la sección de servicios de nuestra página.'),
(3, '¿Es seguro usar este servicio?', 'Sí, la seguridad de nuestros usuarios es una prioridad. Tomamos todas las medidas necesarias para garantizar una experiencia segura y discreta.'),
(4, '¿Puedo elegir a la persona con la que quiero tener una cita?', 'Sí, puedes elegir el perfil que más te interese y hacer la reserva directamente desde la página.'),
(5, '¿Qué tipo de pagos aceptan?', 'Aceptamos pagos a través de transferencias bancarias, tarjetas de crédito y algunos servicios de pago en línea.'),
(6, '¿Ofrecen descuentos o promociones?', 'Sí, ofrecemos promociones especiales en fechas seleccionadas o para reservas de larga duración. Consulta nuestra página de promociones para más detalles.'),
(7, '¿Puedo cancelar una cita?', 'Sí, puedes cancelar una cita con al menos 24 horas de antelación. Ten en cuenta que algunas condiciones pueden aplicar dependiendo del tipo de servicio.'),
(8, '¿Cómo puedo verificar la disponibilidad de una persona?', 'La disponibilidad de nuestras escorts se muestra en sus perfiles individuales. También puedes contactar directamente con ellas para confirmar horarios.'),
(9, '¿Qué sucede si no llego a tiempo a la cita?', 'Es importante llegar a tiempo para aprovechar al máximo el servicio. Si llegas tarde, se podría aplicar un cargo adicional o la cita podría ser reprogramada.'),
(10, '¿Ofrecen servicios fuera de la ciudad?', 'Sí, ofrecemos servicios fuera de la ciudad por un costo adicional. Por favor, contacta con nosotros para más detalles.'),
(11, '¿Hay algún tipo de servicio exclusivo para clientes VIP?', 'Sí, tenemos servicios exclusivos para clientes VIP que incluyen atenciones especiales y disponibilidad prioritaria.'),
(12, '¿Es posible solicitar servicios personalizados?', 'Sí, ofrecemos servicios personalizados según tus preferencias. Puedes discutir tus necesidades al momento de la reserva.'),
(13, '¿Qué pasa si no estoy satisfecho con el servicio?', 'Si no estás satisfecho con el servicio, por favor contacta con nosotros dentro de las 24 horas para discutir una solución.'),
(14, '¿Cómo puedo comunicarme con el equipo de atención al cliente?', 'Puedes comunicarte con nosotros a través del formulario de contacto en nuestra página web o enviando un correo a nuestro soporte.'),
(15, '¿Qué precauciones de salud toman las escorts?', 'Todas nuestras escorts toman las precauciones de salud necesarias para garantizar un servicio seguro para ambos, incluidos exámenes regulares y prácticas de higiene.'),
(16, '¿Puedo solicitar una sesión de varias horas?', 'Sí, puedes reservar una cita de varias horas según tus necesidades. Los detalles de precios y disponibilidad están disponibles en cada perfil.'),
(17, '¿Qué hacer si tengo alguna pregunta durante la cita?', 'Si tienes alguna pregunta o solicitud durante la cita, puedes hablar directamente con la escort de manera respetuosa. Estamos aquí para garantizar una experiencia agradable.'),
(18, '¿Las fotos que se muestran en los perfiles son reales?', 'Sí, todas las fotos en los perfiles son auténticas y reflejan la apariencia real de nuestras escorts.'),
(19, '¿Cómo puedo dejar una reseña después de la cita?', 'Después de la cita, recibirás un correo para dejar una reseña sobre el servicio que recibiste. Tu opinión es importante para nosotros.'),
(20, '¿Ofrecen servicios de acompañamiento para eventos sociales?', 'Sí, ofrecemos servicios de acompañamiento para cenas, eventos o cualquier otra ocasión especial. Contáctanos para más detalles.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'scort'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scort`
--

CREATE TABLE `scort` (
  `id_usuario` int(11) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `estatura` decimal(4,2) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `medidas` varchar(50) DEFAULT NULL,
  `imagen` mediumblob DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scort`
--

INSERT INTO `scort` (`id_usuario`, `alias`, `ciudad`, `contacto`, `estatura`, `peso`, `medidas`, `imagen`, `email`, `password`) VALUES
(2, 'Natasha', 'Celaya', '4111140945', 1.72, 80.00, '80,80,70', 0x75736572732f325f666f746f5f70657266696c2e706e67, 'natasha@lagoonsvip.com', '$2y$10$Zmyt5E0Ni4EJearhrwOQlO3eYCTfhtzP1BIBtXpXqJtK.mfLlfnDK'),
(21, 'Lu', 'Celaya', 'Instagar: @luisa.lg', 1.60, 50.00, '90,60,90', 0x75736572732f32315f70657266696c322e706e67, 'luisa@lagoonsvip.com', '$2y$10$kSEtEf0JUa2FwxAid6Mtk.Nn4Ih7QUEduSNlOnnb5FbNn20nkeDzy'),
(27, '', NULL, NULL, NULL, NULL, NULL, NULL, 'angela@lagoonsvip.com', '1234'),
(28, '', NULL, NULL, NULL, NULL, NULL, NULL, 'jennifer@lagoonsvip.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('C','S') NOT NULL,
  `genero` enum('H','M','O') NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `imagen` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `email`, `password`, `rol`, `genero`, `telefono`, `imagen`) VALUES
(1, 'Omar', 'Patiño', 'omar@lagoonsvip.com', '1234', '', 'H', '4111140945', ''),
(2, 'Natasha', 'Gallardo', 'natasha@lagoonsvip.com', '1234', 'S', 'M', '4111122333', ''),
(21, 'Luisa', 'Patiño', 'luisa@lagoonsvip.com', '1234', 'S', 'M', '4111140940', ''),
(26, 'Chayanne', 'Patiño', 'juan@gmail.com', '$2y$10$fyUfcShWgCcPUn442IohCe6Fue.hSZz1F/evItfduDShazkC1iifW', 'C', 'H', '4111140945', 0x75736572732f32365f63686179616e6e652e6a7067),
(27, 'Angela', 'Arellano', 'angela@lagoonsvip.com', '1234', 'S', 'M', '5221450987', ''),
(28, 'Jennifer', 'Gmez', 'jennifer@lagoonsvip.com', '1234', 'S', 'M', '4321234567890', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_pago` (`id_pago`),
  ADD KEY `fk_scort` (`id_scort`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `preguntasfrecuentes`
--
ALTER TABLE `preguntasfrecuentes`
  ADD PRIMARY KEY (`id_preguntas_frecuentes`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `scort`
--
ALTER TABLE `scort`
  ADD PRIMARY KEY (`id_usuario`,`email`,`password`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntasfrecuentes`
--
ALTER TABLE `preguntasfrecuentes`
  MODIFY `id_preguntas_frecuentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_pago`) REFERENCES `formapago` (`id_pago`),
  ADD CONSTRAINT `fk_scort` FOREIGN KEY (`id_scort`) REFERENCES `scort` (`id_usuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `scort`
--
ALTER TABLE `scort`
  ADD CONSTRAINT `scort_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
