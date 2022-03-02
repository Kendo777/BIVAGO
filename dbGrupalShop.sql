-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2022 a las 22:56:40
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupalshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `addresses`
--

CREATE TABLE `addresses` (
  `addressId` int(11) NOT NULL,
  `user` varchar(128) NOT NULL,
  `direction` varchar(128) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `city` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `addresses`
--

INSERT INTO `addresses` (`addressId`, `user`, `direction`, `zipCode`, `city`, `country`) VALUES
(5, 'CrapiKoda', 'C/AVENIDA CASTEJON DE VALDEJASA, 65', 50830, 'VILLANUEVA DE GALLEGO', 'España');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditcard`
--

CREATE TABLE `creditcard` (
  `creditCardId` int(11) NOT NULL,
  `user` varchar(128) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `creditcard`
--

INSERT INTO `creditcard` (`creditCardId`, `user`, `number`, `name`, `date`) VALUES
(4, 'CrapiKoda', 123564897, 'Marc Lozano', '2021-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `shop` varchar(128) NOT NULL,
  `cuantity` int(11) NOT NULL,
  `totalPrize` double NOT NULL,
  `creditCardId` int(11) DEFAULT NULL,
  `user` varchar(128) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `send` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`orderId`, `itemId`, `shop`, `cuantity`, `totalPrize`, `creditCardId`, `user`, `addressId`, `date`, `paid`, `send`) VALUES
(69, 89, 'Steampunk', 3, 17.61, 4, 'CrapiKoda', 5, '2021-01-29 01:15:06', 1, 1),
(70, 25, 'Steampunk', 1, 13.549999999999999, 4, 'CrapiKoda', 5, '2021-01-29 01:21:20', 1, 0),
(71, 89, 'Steampunk', 1, 5.87, 4, 'CrapiKoda', 5, '2021-01-29 01:21:20', 1, 0),
(75, 172, 'Steampunk', 1, 12.18, 4, 'CrapiKoda', 5, '2021-01-29 14:05:24', 1, 0),
(102, 29, 'Compopop', 1, 1109, 4, 'CrapiKoda', 5, '2021-01-29 17:13:07', 1, 0),
(103, 29, 'Compopop', 1, 1109, 4, 'CrapiKoda', 5, '2021-01-29 17:20:02', 1, 0),
(104, 9, 'Steampunk', 25, 26, 4, 'CrapiKoda', 5, '2021-01-29 18:39:09', 1, 0),
(105, 8, 'Compopop', 1, 104, 4, 'CrapiKoda', 5, '2021-01-29 18:39:09', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shops`
--

CREATE TABLE `shops` (
  `name` varchar(128) CHARACTER SET utf16 NOT NULL,
  `link` varchar(256) CHARACTER SET utf16 NOT NULL,
  `imagesLink` varchar(256) CHARACTER SET utf16 NOT NULL,
  `myUser` varchar(128) CHARACTER SET utf16 NOT NULL,
  `myPwd` varchar(256) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `shops`
--

INSERT INTO `shops` (`name`, `link`, `imagesLink`, `myUser`, `myPwd`) VALUES
('Compopop', 'Compopop', '', 'Jorge', '1234'),
('Steampunk', 'http://localhost/PAPI/OnlineShop/getProducts.php?user=Bivago&password=bivago', '', 'Bivago', 'bivago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `userName` varchar(128) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `valid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user`, `email`, `password`, `userName`, `phone`, `valid`) VALUES
('CrapiKoda', 'mark.mart@lapin.fi', '$2y$10$L8f3ojjMWyY/6EMn2OhS/eYrPDFzGv170ie/6eXU.oQvdMoxcVK2i', 'Marc Lozano Martinez', '695961511', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `fk_addresses_user` (`user`);

--
-- Indices de la tabla `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`creditCardId`),
  ADD KEY `fk_creditcard_user` (`user`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_ordera_address_id` (`addressId`),
  ADD KEY `fk_ordera_creditCard_id` (`creditCardId`),
  ADD KEY `fk_ordera_user` (`user`),
  ADD KEY `fk_ordera_shop` (`shop`);

--
-- Indices de la tabla `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `creditCardId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_user` FOREIGN KEY (`user`) REFERENCES `users` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `fk_creditcard_user` FOREIGN KEY (`user`) REFERENCES `users` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ordera_address_id` FOREIGN KEY (`addressId`) REFERENCES `addresses` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordera_creditCard_id` FOREIGN KEY (`creditCardId`) REFERENCES `creditcard` (`creditCardId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordera_shop` FOREIGN KEY (`shop`) REFERENCES `shops` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordera_user` FOREIGN KEY (`user`) REFERENCES `users` (`user`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
