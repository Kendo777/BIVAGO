-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2022 a las 22:57:11
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
-- Base de datos: `ia_ii_api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adress` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Procesadores'),
(6, 'Graficas'),
(7, 'Portatiles'),
(8, 'Torres'),
(9, 'Monitores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditcards`
--

CREATE TABLE `creditcards` (
  `id` int(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `root` varchar(128) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `root`) VALUES
(1, 'default.png'),
(2, 'AmdR3.png'),
(3, 'AmdR5.png'),
(4, 'AmdR7.png'),
(5, 'AmdR9.png'),
(6, 'Inteli3.png'),
(7, 'Inteli5.png'),
(8, 'Inteli7.png'),
(9, 'Inteli9.png'),
(10, 'amdRad5700msi.png'),
(11, 'amdRad6800.png'),
(12, 'amdRad6900giga.png'),
(13, 'asusStrixScar17.png'),
(14, 'corsairCustom.png'),
(15, 'custom1.png'),
(16, 'HPelitedesk.png'),
(17, 'inWinMonster.png'),
(18, 'lenovoThinkPad.png'),
(19, 'monitorDellBasic.png'),
(20, 'monitorDellGaming.png'),
(21, 'monitorLg.png'),
(22, 'monitorLgUltra.png'),
(23, 'monitorLgUltraGear.png'),
(24, 'monitorSamsungUltra.png'),
(25, 'msiGl63.png'),
(26, 'msigs65.png'),
(27, 'nfortecCustom.png'),
(28, 'Nvidia2070sasus.png'),
(29, 'Nvidia3080.png'),
(30, 'Nvidia3080asus.png'),
(31, 'Nvidia3080msi.png'),
(32, 'monitorSamsung.png'),
(33, 'Nvidia3090asus.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(32) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creditCard_id` int(16) NOT NULL,
  `adress` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `pn` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Product description:',
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `shippingTax` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `subCategory_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `pn`, `description`, `stock`, `price`, `shippingTax`, `category_id`, `subCategory_id`, `image_id`) VALUES
(8, 'AMD Ryzen 3 3100', '0001001', 'AMD Ryzen 3 3100, 4 cores / 8 Threads, 3,6 - 3,9GHZ, 65W, No iGPU', 9, 99, 5, 5, 20, 2),
(9, 'AMD Ryzen 3 3300', '0001002', 'AMD Ryzen 3 3300, 4 cores / 8 Threads, 3.8 - 4.3GHZ, 65W, No iGPU', 14, 120, 5, 5, 20, 2),
(10, 'AMD Ryzen 5 3500', '0001003', 'AMD Ryzen 3 3500, 6 cores / 6 Threads, 3.6 - 4.1GHZ, 65W, No iGPU', 6, 170, 5, 5, 21, 3),
(11, 'AMD Ryzen 5 3600X', '0001004', 'AMD Ryzen 3 3600X, 6 cores / 12 Threads, 3.8 - 4.4GHZ, 95W, No iGPU', 9, 230, 5, 5, 21, 3),
(12, 'AMD Ryzen 5 5600X', '0001005', 'AMD Ryzen 5 5600X, 6 cores / 12 Threads, 3.7 - 4.6GHZ, 65W, No iGPU', 2, 299, 5, 5, 21, 3),
(13, 'AMD Ryzen 5 3400G', '0001006', 'AMD Ryzen 5 5600X, 4 cores / 8 Threads, 3.7 - 4.2GHZ, 65W, with iGPU', 2, 149, 5, 5, 21, 3),
(15, 'AMD Ryzen 7 3700X', '0001007', 'AMD Ryzen 7 3700X, 8 cores / 16 Threads, 3.6 - 4.4GHZ, 95W, No iGPU', 3, 329, 5, 5, 22, 4),
(16, 'AMD Ryzen 7 5800X', '0001008', 'AMD Ryzen 7 5800X, 8 cores / 16 Threads, 3.8 - 4.7GHZ, 105W, No iGPU', 5, 469, 5, 5, 22, 4),
(17, 'AMD Ryzen 9 3900X', '0001009', 'AMD Ryzen 9 3900X, 12 cores / 24 Threads, 3.8 - 4.6GHZ, 105W, No iGPU', 2, 499, 5, 5, 23, 5),
(18, 'AMD Ryzen 9 5900X', '0001010', 'AMD Ryzen 9 5900X, 12 cores / 24 Threads, 3.7 - 4.8GHZ, 105W, No iGPU', 0, 559, 5, 5, 23, 5),
(19, 'AMD Ryzen 9 5950X', '0001011', 'AMD Ryzen 9 5950X, 16 cores / 32 Threads, 3.4 - 4.9GHZ, 105W, No iGPU', 1, 809, 5, 5, 23, 5),
(20, 'Intel i3 10100F', '0002001', 'Intel i3 10100F, 4 cores / 8 Threads, 3.6 - 4.3GHZ, 65W, No iGPU', 21, 85, 5, 5, 24, 6),
(21, 'Intel i3 10300', '0002002', 'Intel i3 10300, 4 cores / 8 Threads, 3.7 - 4.4GHZ, 65W, with iGPU', 12, 149, 5, 5, 24, 6),
(22, 'Intel i5 9400F', '0002003', 'Intel i5 9400F, 6 cores / 6 Threads, 2.9 - 4.1GHZ, 65W, no iGPU', 12, 129, 5, 5, 25, 7),
(23, 'Intel i5 10400', '0002004', 'Intel i5 10400, 6 cores / 12 Threads, 2.9 - 4.3GHZ, 65W, with iGPU', 18, 159, 5, 5, 25, 7),
(24, 'Intel i5 10600K', '0002005', 'Intel i5 10600K, 6 cores / 12 Threads, 4.1 - 4.9GHZ, 95W, with iGPU', 11, 249, 5, 5, 25, 7),
(25, 'Intel i7 9700', '0002006', 'Intel i7 9700, 8 cores / 8 Threads, 3.0 - 4.7GHZ, 65W, with iGPU', 6, 249, 5, 5, 26, 8),
(26, 'Intel i9 10900K', '0002009', 'Intel i9 10900K, 10 cores / 20 Threads, 3.7 - 5.3GHZ, 125W, with iGPU', 2, 549, 5, 5, 27, 9),
(27, 'MSI Radeon RX 5700', '0001501', 'Packed with the pure AMD gaming experience, the MSI Radeon RX 5700 graphics offers a unique combination of simplicity and performance.', 6, 430, 10, 6, 29, 10),
(28, 'AMD Radeon RX 6800', '0001502', 'The AMD Radeon™ RX 6800 graphics card, powered by AMD RDNA™ 2 architecture, is engineered to deliver ultra-high frame rates and serious 4K resolution gaming.', 0, 749, 10, 6, 29, 11),
(29, 'AMD Radeon RX 6900 XT', '0001503', 'Powered by RDNA2 Radeon ™ RX 6900 XT. Integrated with 16GB 256-bit GDDR6 memory interface. WINDFORCE 3X cooling system with alternate rotating fans.', 2, 1099, 10, 6, 29, 12),
(30, 'Asus Dual GeForce RTX 2070 SUPER OC', '0003001', 'ASUS Dual GeForce® RTX 2070 SUPER ™ EVO OC edition 8GB GDDR6 graphics with two powerful Axial-tech fans to enjoy triple A and VR games with higher refresh rates.', 11, 499, 10, 6, 28, 28),
(31, 'Nvidia GeForce RTX 3080', '0003002', 'The GeForce RTX ™ 3080 delivers the ultra performance gamers crave, powered by Ampere, NVIDIA\'s second-generation RTX architecture.', 0, 729, 10, 6, 28, 29),
(32, 'Asus TUF GeForce RTX 3080 10GB GDDR6X', '0003003', 'RTX. IT\'S ON. Enjoy today\'s biggest blockbusters like never before with the visual fidelity of real-time ray tracing and the ultimate performance of DLSS powered by AI.', 0, 899, 10, 6, 28, 30),
(33, 'Asus ROG Strix GeForce RTX 3090 Gaming OC 24GB GDDR6X', '0003004', 'NVIDIA® GeForce RTX ™ 3090 graphics engine. PCI Express 4.0 bus standard. 24GB GDDR6X video memory. 1875Mhz engine clock. CUDA 10496 core. Memory speed 19.5 Gbps.', 0, 1949, 10, 6, 28, 33),
(34, 'MSI GeForce RTX 3080 GAMING X TRIO 10GB GDDR6X', '0003005', 'RTX. IT\'S ON. Enjoy today\'s biggest blockbusters like never before with the visual fidelity of real-time ray tracing and the ultimate performance of DLSS powered by AI.', 0, 839, 10, 6, 28, 31),
(35, 'Asus Rog Strix SCAR 17', '0004001', 'The new Ryzen 9 5900HX from AMD, an RTX 3080, 64 GB of dual channel DDR4-3200 RAM and a 156HZ 2k display.', 4, 2569, 20, 7, 32, 13),
(36, 'Lenovo Thinkpad 20S6 15.6', '0005001', 'With an expandable 39.62 cm (15.6 \") screen and a keyboard with a numeric keypad, the ThinkPad T15i is a powerful high-end mobile device for data professionals whose technology needs are not confined to the desktop.', 15, 1789, 10, 7, 30, 18),
(37, 'MSI GL73 8SD-046XES', '0006001', 'Intel Core i7-8750H - NVIDIA GeForce GTX 1660 Ti - RAM: 16 GB - 512 GB SSD - 17.3', 5, 1309, 20, 7, 31, 25),
(38, 'MSI GS65 Stealth Thin 8RE-252ES', '0006002', 'Intel Core i7-8750H/16GB/512GB SSD/GTX 1060/15.6\"', 3, 1789, 20, 7, 31, 26),
(39, 'Custom PC Build Gold Corsair', '0007001', 'Intel Core i7/16GB/512GB SSD/Nvidia RTX 2070s', 8, 1799, 35, 8, 34, 14),
(40, 'Custom PC Build Basic', '0007002', 'Intel Core i3/8GB/256GB SSD/Nvidia GTX 1660', 16, 899, 35, 8, 34, 15),
(41, 'Custom PC Build Silver Nfortec', '0007003', 'Intel Core i5/16GB/512GB SSD/Nvidia RTX 2060s', 16, 1249, 35, 8, 34, 27),
(42, 'Custom PC Build Platinum InWin', '0007004', 'Intel Core i9/32GB/1TB SSD/Nvidia RTX 3080/ Custom water cool', 2, 2799, 40, 8, 34, 17),
(43, 'HP EliteDesk 800 G1', '0008001', 'Intel Core i5 6500 / 8GB / 240GB SSD', 12, 299, 20, 8, 33, 16),
(44, 'Dell Basic Monitor', '0009001', '1080p 60Hz', 26, 179, 20, 9, 35, 19),
(45, 'Dell S-series 27 inch - S2719DGF', '0009002', 'QHD (2560 x 1440) up to 155 Hz, 16: 9, 1ms Response Time, HDMI 2.0, DP 1.2, USB, FreeSync, LED, Height, Tilt, Pan and Pivot Adjustment.', 10, 489, 20, 9, 35, 20),
(46, 'LG Curved Ultrawide Monitor', '0010001', 'Panel VA: 3440x1440, 21:9, 5ms, 100Hz, 300nit, 1500:1, sRGB>99%', 10, 449, 25, 9, 36, 22),
(47, 'Samsung Odyssey G7 32', '0011001', 'QLED WQHD 240Hz HDR600 ', 5, 749, 25, 9, 37, 32),
(48, 'Samsung Odyssey G9 49', '0011002', 'QLED Dual QHD 240Hz G-Sync Compatible HDR600 ', 3, 1499, 35, 9, 37, 24),
(49, 'LG 27GN750-B Ultragear', '0010002', 'Panel IPS: 1920x1080p, 16:9, 400 CD/m², 1000:1, 240 Hz, 1 ms, DPx1, HDMIx2, USB', 5, 489, 25, 9, 36, 21),
(50, 'LG 34GK950F Ultragear Gaming Monitor 34', '0010003', 'QuadHD UltraWide Curved 21: 9 LED NanoIPS HDR 400, 3440 x 1440, 1ms MBR, AMD FreeSync 144Hz, HDMI 2.0, Display Port 1.4, USB Hub, Adjustable Height, Flicker Safe', 2, 1499, 35, 9, 36, 23),
(51, 'Intel i7 10700K', '0002007', 'Intel i7 10700K, 8 cores / 16 Threads, 3.8 - 5.1GHZ, 95W, with iGPU', 9, 339, 5, 5, 26, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`) VALUES
(20, 'AMD Ryzen 3', 5),
(21, 'AMD Ryzen 5', 5),
(22, 'AMD Ryzen 7', 5),
(23, 'AMD Ryzen 9', 5),
(24, 'Intel i3', 5),
(25, 'Intel i5', 5),
(26, 'Intel i7', 5),
(27, 'Intel i9', 5),
(28, 'NVIDIA', 6),
(29, 'AMD', 6),
(30, 'Lenovo', 7),
(31, 'MSI', 7),
(32, 'Asus', 7),
(33, 'HP', 8),
(34, 'Custom', 8),
(35, 'Dell', 9),
(36, 'LG', 9),
(37, 'Samsung', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `pwd` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pwd`, `verified`) VALUES
(2, 'Jorge', 'jorgerv97@gmail.com', '$2y$10$zbc0KiPwY.yjOigukV3eguj3lCunQsPH8ayccHeBrmht7SYaP2nQy', 1),
(3, 'Jorge2', 'jorge2@gmail.com', '$2y$10$sPT8fFt9g2umguxggQFbeuL1WLRVCcihpv7AsF05/v6zpo0xbf9Ta', 1),
(4, 'Jorge3', 'jorgerv3@gmail.com', '$2y$10$oufs.INIfxmmxWF28b2pReIaeE5RumzcoHkxfA/iTAUq2C.cvyITO', 0),
(5, 'Jorge3', 'jorgeruiz@gmail.com', '$2y$10$ej2H0d1KIHQswY9szKDkbOGN0MvPiYYkQyp1aDy8FQR6vhB.BQlXy', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admins_user_id` (`user_id`);

--
-- Indices de la tabla `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adresses_user_id` (`user_id`);

--
-- Indices de la tabla `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cartitems_cart_id` (`cart_id`),
  ADD KEY `fk_cartitems_product_id` (`product_id`);

--
-- Indices de la tabla `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carts_user_id` (`user_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `creditcards`
--
ALTER TABLE `creditcards`
  ADD KEY `fk_creditcards_user_id` (`user_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderitems_order_id` (`order_id`),
  ADD KEY `fk_orderitems_product_id` (`product_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user_id` (`user_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_image_id` (`image_id`),
  ADD KEY `fk_products_category_id` (`category_id`),
  ADD KEY `fk_products_subcategory_id` (`subCategory_id`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategories_categories_id` (`category_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_admins_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_adresses_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `fk_cartitems_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cartitems_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `creditcards`
--
ALTER TABLE `creditcards`
  ADD CONSTRAINT `fk_creditcards_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_orderitems_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orderitems_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_subcategory_id` FOREIGN KEY (`subCategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_subcategories_categories_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
