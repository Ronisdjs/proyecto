-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2024 a las 12:55:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_jamb_ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`, `employee_id`, `status`) VALUES
(1, 'dduarte@hotmail.com', '21232f297a57a5a743894a0e4a801fc3', '2017-01-24 16:21:18', '2024-09-16 14:47:21', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `updateDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `supplier`, `creationDate`, `image`, `updateDate`) VALUES
(1, 'nike', 1, 1, '2024-09-14 00:17:40', NULL, NULL),
(2, 'adidas', 1, 1, '2024-09-14 00:17:40', NULL, NULL),
(3, 'Rebook', 1, 2, '2024-09-16 05:10:27', 'rebook2.png', '2024-09-16 12:31:43'),
(6, 'Arequipe', 1, 1, '2024-09-17 05:03:37', 'Screenshot_2024-09-13-13-55-48-478_com.facebook.katana.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`, `status`) VALUES
(1, 'Zapatos ', 'sdfsadfdsf', '2024-09-12 19:17:37', '2024-09-15 23:34:58', 0),
(2, 'Deporte', 'Zapatos para Deporte', '2024-09-12 19:17:37', '2024-09-15 21:36:27', 0),
(3, 'Zapatos Casuales', 'Zapatos sencillos para toda ocacion', '2024-09-12 19:17:37', '', 0),
(4, 'Moda', 'Zapatos en tendencia de moda', '2024-09-12 19:17:37', '', 0),
(5, 'botas', 'sadasd', '0000-00-00 00:00:00', '2024-09-15 23:22:21', 0),
(12, 'botas', 'antsrr', '2024-09-14 01:22:01', '2024-09-13 20:22:01', 0),
(15, 'Moda', 'Zapatos de Moda', '2024-09-17 08:31:35', '2024-09-17 03:31:35', 1),
(16, 'Running', 'Zapatillas para deportes ', '2024-09-17 08:31:47', '2024-09-17 03:31:47', 1),
(17, 'Urban', 'Zapatillas de Estilo Urbano', '2024-09-17 08:32:30', '2024-09-17 03:32:30', 1),
(18, 'Training', 'Zapatillas para Entrenamientos y Ejercicio', '2024-09-17 08:33:44', '2024-09-17 03:33:44', 1),
(19, 'Botas', 'Zapatos de estilo Unico', '2024-09-17 08:34:09', '2024-09-17 03:34:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id`, `name`, `description`, `email`, `phone`, `address`, `nit`) VALUES
(1, 'JambEcommerce', 'JambEcommerce es una tienda en línea que ofrece una amplia variedad de productos de calidad a precios competitivos. Descubre una experiencia de compra rápida y segura, con opciones de pago flexibles y envíos a todo el país.', 'info@company.com', '000000000000', 'Bogotá, Colombia bosa', 1020124154);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `identification` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) DEFAULT NULL,
  `identificationType` int(11) DEFAULT NULL,
  `updateDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `last_name`, `email`, `phone`, `gender`, `identification`, `position`, `regDate`, `status`, `identificationType`, `updateDate`) VALUES
(1, 'david eduardo', 'duran duarte', 'dduarte@hotmail.com', '456442181', 1, '012345', 1, '2024-09-13 22:44:07', '1', 1, '2024-09-16 13:30:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`id`, `name`, `status`) VALUES
(1, 'Masculino', 1),
(2, 'Femenino', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identification_type`
--

CREATE TABLE `identification_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `identification_type`
--

INSERT INTO `identification_type` (`id`, `type`) VALUES
(1, 'CC'),
(2, 'PASS'),
(3, 'DNI'),
(4, 'NIT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(100) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `userId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`, `sale_id`) VALUES
(12, 1, 1, '2024-09-15 15:12:39', 'efectivo', 'Enviado', 3),
(14, 4, 1, '2024-09-15 15:21:32', 'efectivo', 'Enviado', 5),
(15, 3, 1, '2024-09-15 15:25:16', 'efectivo', 'Enviado', 6),
(16, 2, 1, '2024-09-15 15:31:30', 'datafono', 'Enviado', 7),
(17, 3, 1, '2024-09-15 15:38:03', 'efectivo', 'Entregado', 8),
(18, 1, 1, '2024-09-15 15:41:09', 'efectivo', 'Entregado', 9),
(19, 3, 1, '2024-09-15 15:41:46', 'datafono', 'Entregado', 10),
(20, 4, 1, '2024-09-15 15:43:50', 'datafono', 'Entregado', 11),
(21, 4, 1, '2024-09-15 15:43:50', 'datafono', 'Entregado', 11),
(22, 4, 1, '2024-09-15 15:58:25', 'datafono', 'Entregado', 12),
(23, 4, 1, '2024-09-15 15:58:25', 'datafono', 'Entregado', 12),
(24, 4, 1, '2024-09-15 16:06:26', 'datafono', 'Entregado', 13),
(25, 4, 1, '2024-09-15 16:06:26', 'datafono', 'Entregado', 13),
(26, 2, 3, '2024-09-15 16:17:01', 'datafono', 'Entregado', 14),
(27, 2, 1, '2024-09-15 16:17:01', 'datafono', 'Entregado', 14),
(28, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(29, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(30, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(31, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(32, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(33, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(34, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(35, 4, 1, '2024-09-15 16:27:21', 'datafono', 'Entregado', 15),
(36, 2, 1, '2024-09-15 16:33:31', 'efectivo', 'Entregado', 16),
(37, 2, 1, '2024-09-15 16:33:31', 'efectivo', 'Entregado', 16),
(38, 2, 1, '2024-09-15 16:55:34', 'efectivo', 'Entregado', 17),
(39, 2, 1, '2024-09-15 16:55:34', 'efectivo', 'Entregado', 17),
(40, 2, 1, '2024-09-15 16:55:34', 'efectivo', 'Entregado', 17),
(41, 2, 2, '2024-09-15 16:59:28', 'efectivo', 'Entregado', 18),
(42, 3, 2, '2024-09-15 17:26:34', 'efectivo', 'Entregado', 19),
(43, 4, 2, '2024-09-15 17:28:47', 'efectivo', 'Entregado', 20),
(44, 4, 2, '2024-09-15 17:31:10', 'efectivo', 'Entregado', 21),
(45, 3, 2, '2024-09-15 17:34:30', 'efectivo', 'Entregado', 22),
(46, 2, 2, '2024-09-15 17:36:51', 'efectivo', 'Entregado', 23),
(47, 2, 2, '2024-09-15 17:36:51', 'efectivo', 'Entregado', 23),
(48, 3, 1, '2024-09-15 17:48:18', 'efectivo', 'Entregado', 24),
(49, 4, 1, '2024-09-15 17:48:44', 'efectivo', 'Entregado', 24),
(50, 4, 1, '2024-09-15 17:48:44', 'efectivo', 'Entregado', 24),
(51, 4, 1, '2024-09-15 17:49:13', 'efectivo', 'Entregado', 25),
(52, 4, 1, '2024-09-15 17:49:13', 'efectivo', 'Entregado', 25),
(53, 2, 1, '2024-09-15 17:51:28', 'efectivo', 'Entregado', 25),
(54, 2, 1, '2024-09-15 17:51:28', 'efectivo', 'Entregado', 25),
(55, 4, 1, '2024-09-15 17:54:46', 'efectivo', 'Entregado', 26),
(56, 4, 1, '2024-09-15 17:54:46', 'efectivo', 'Entregado', 26),
(57, 4, 2, '2024-09-15 17:55:18', 'efectivo', 'Entregado', 27),
(58, 4, 2, '2024-09-15 18:01:41', 'efectivo', 'Entregado', 28),
(59, 2, 1, '2024-09-15 18:01:49', 'efectivo', 'Entregado', 28),
(60, 2, 2, '2024-09-15 18:01:49', 'efectivo', 'Entregado', 28),
(61, 2, 1, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(62, 2, 2, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(63, 2, 1, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(64, 2, 2, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(65, 2, 1, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(66, 2, 2, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(67, 2, 1, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(68, 2, 2, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(69, 2, 1, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(70, 2, 2, '2024-09-15 18:03:42', 'efectivo', 'Entregado', 29),
(71, 4, 2, '2024-09-15 18:14:05', 'efectivo', 'Entregado', 30),
(72, 4, 3, '2024-09-17 04:52:12', 'efectivo', 'Entregado', 31),
(73, 1, 1, '2024-09-17 05:04:41', 'efectivo', 'Entregado', 32),
(74, 3, 1, '2024-09-17 05:07:30', 'datafono', 'Entregado', 33),
(75, 4, 1, '2024-09-17 05:22:21', 'datafono', 'Entregado', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(9, 12, 'Enviado', 'enviado', '2024-09-16 20:55:39'),
(11, 14, 'Enviado', 'ok', '2024-09-17 06:52:32'),
(12, 16, 'Enviado', 'ok', '2024-09-17 06:53:06'),
(13, 15, 'Enviado', 'ok', '2024-09-17 06:53:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id`, `name`, `status`) VALUES
(1, 'AdministradoR', 1),
(2, 'Vendedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(2, 3, 4, 5, 5, 'Anuj Kumar', 'BEST PRODUCT FOR ME :)', 'BEST PRODUCT FOR ME :)', '2017-02-26 20:43:57'),
(3, 3, 3, 4, 3, 'Sarita pandey', 'Nice Product', 'Value for money', '2017-02-26 20:52:46'),
(4, 3, 3, 4, 3, 'Sarita pandey', 'Nice Product', 'Value for money', '2017-02-26 20:59:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `updateproduct` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `discount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `stock`, `creationDate`, `status`, `brand`, `updateproduct`, `quantity`) VALUES
(1, 15, 3, 'Zapatilla de running \"Velocity\"', 'FastRun', 250000.00, 5, NULL, 'casual1.jpeg', 'casual3.jpg', 'casual4.jpg', 'In Stock', '2017-01-30 16:54:35', 1, 1, NULL, 27),
(2, 16, 4, 'Bota de CrossFit \"Fuerza2', 'CrossFit Agility', 320000.00, 2, NULL, 'adidas1.jfif', 'adidas2.jfif', 'adidas3.jfif', 'In Stock', '2017-01-30 16:59:00', 1, 2, NULL, 23),
(3, 15, 4, 'Zapatilla de moda \"Urban\"', 'CasualWear', 150000.00, 8, NULL, 'botas01.jfif', 'botas1.jfif', 'botas02.jfif', 'In Stock', '2017-02-04 04:03:15', 1, 1, NULL, 4),
(4, 15, 4, 'Zapatilla de running \"Endurance\"', 'FastRun', 380000.00, 20, NULL, 'botas2.jfif', 'botas03.jfif', 'botas3.jfif', 'In Stock', '2017-02-04 04:04:43', 0, 1, NULL, 17),
(5, 18, 4, 'Bota de CrossFit \"Intenso\"', 'CrossFit Pro', 500000.00, 25, NULL, 'metcon1.jfif', 'metcon2.jfif', 'metcon3.jfif', 'In Stock', '2017-02-04 04:06:17', 1, 2, NULL, 27),
(6, 16, 4, 'Zapatilla de moda \"Fashion\"', 'CasualWear', 238900.00, 60, NULL, 'new1.jfif', 'new2.jfif', 'new3.jfif', 'In Stock', '2017-02-04 04:08:07', 1, 1, NULL, 12),
(7, 16, 4, 'Zapatilla de running \"Rápido\"', 'FastRun', 235900.00, 12, NULL, 'nike.png', 'nike1.png', 'nike2.png', 'In Stock', '2017-02-04 04:10:17', 1, 1, NULL, 3),
(8, 18, 4, 'Bota de CrossFit \"Potencia\"', 'CrossFit Pro', 124800.00, 14, NULL, 'nike1.jfif', 'nike2jfif', 'nike3.jfif', 'In Stock', '2017-02-04 04:11:54', 1, 2, NULL, 2),
(9, 19, 5, 'Zapatilla de moda \"Casual\"', 'CasualWear', 458920.00, 15, NULL, 'nikeAir1.jfif', 'nikeAir2.jfif', 'nikeAir3.jfif', 'In Stock', '2017-02-04 04:17:03', 1, 1, NULL, 3),
(11, 17, 6, 'Zapatilla de running \"Ligera\"', 'SportWear', 148000.00, 25, NULL, 'puma1.jfif', 'puma2.jfif', 'puma3.jfif', 'In Stock', '2017-02-04 04:26:17', 1, 2, NULL, 22),
(12, 17, 6, 'Bota de CrossFit \"Agilidad\"', 'FastRun', 370000.00, 18, NULL, 'rebook1.jpg', 'reebok2.jpg', 'reebook3.jpg', 'In Stock', '2017-02-04 04:28:17', 1, 1, NULL, 1),
(13, 17, 6, 'Zapatilla de moda \"Deportiva\"', 'SpeedDemon', 478900.00, 35, NULL, 'roshe2.jfif', 'roshe1.jfif', 'roshe3.jfif', 'In Stock', '2017-02-04 04:30:24', 1, 2, NULL, 2),
(14, 19, 6, 'Zapatilla de running \"Resistencia\"', 'ElegantWear', 602000.00, 22, NULL, 'vomero1.jfif', 'vomero2.jfif', 'vomero3.jfif', 'In Stock', '2017-02-04 04:32:15', 1, 1, NULL, 1),
(15, 15, 8, 'Bota de CrossFit \"Fuerza Max\"', 'TrendWear', 284000.00, 25, NULL, 'casual5.jpg', 'casual6.jpg', 'casual7.jpg', 'In Stock', '2017-02-04 04:35:13', 1, 2, NULL, 1),
(16, 15, 8, 'Zapatilla de moda \"Elegante\"', 'CasualWear', 358000.00, 11, NULL, 'casual1.jpeg', 'casual4.jpg', 'casual3.jpg', 'In Stock', '2017-02-04 04:36:23', 1, 1, NULL, 2),
(17, 18, 9, 'Zapatilla de running \"Velocidad\"', 'CasualWear', 425000.00, 5, NULL, 'adidas1.jfif', 'adidas2.jfif', 'adidas3.jfif', 'In Stock', '2017-02-04 04:40:37', 1, 2, NULL, 3),
(18, 15, 10, 'Bota de CrossFit \"Intenso Pro\"', 'MarathonRun', 678000.00, 10, NULL, 'metcon2.jfif', 'metcon1.jfif', 'metcon3.jfif', 'In Stock', '2017-02-04 04:42:27', 1, 1, NULL, 2),
(19, 18, 12, 'Zapatilla de moda \"Tendencia\"', 'FastRun', 528900.00, 40, NULL, '1.jpeg', '2.jpeg', '3.jpeg', 'In Stock', '2017-03-10 20:16:03', 1, 2, NULL, 3),
(20, 19, 12, 'Zapatilla de running \"Maratón\"', 'MarathonRun', 425800.00, 25, NULL, '1.jpeg', '2.jpeg', '3.jpeg', 'Out in Stock', '2017-03-10 20:19:22', 1, 2, NULL, 0),
(23, 17, 20, 'Bota de CrossFit \"Potencia Plus\"', 'CrossFit Power', 235000.00, 5, 'zapatos casuales ', 'casual2.jpg', 'casula3.jpg', 'casual4.jpg', 'In Stock', '2024-09-17 08:44:44', 1, 6, '2024-09-17 08:44:44', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `suppliers_id` int(11) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT NULL,
  `payment_metod` varchar(100) DEFAULT NULL,
  `type_purchase` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,0) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_product` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `purchasedetail`
--

INSERT INTO `purchasedetail` (`id`, `product_id`, `quantity_product`, `unit_price`, `purchase_id`) VALUES
(1, 3, 1, 0, 1),
(2, 1, 1, 0, 1),
(3, 4, 4, 0, 1),
(4, 1, 1, 0, 1),
(5, 1, 1, 0, 1),
(6, 2, 1, 0, 1),
(7, 2, 1, 0, 1),
(8, 5, 2, 0, 1),
(9, 4, 1, 0, 1),
(10, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `creation_date` timestamp NULL DEFAULT NULL,
  `sale_status` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `total_price` decimal(15,2) DEFAULT NULL,
  `tax_iva` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `sale_portal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `creation_date`, `sale_status`, `user_id`, `employee_id`, `total_price`, `tax_iva`, `discount`, `sale_portal`) VALUES
(1, '2024-09-15 14:30:37', 0, 4, 1, 0.00, 0.00, 0.00, ''),
(2, '2024-09-15 14:35:05', 0, 4, 1, 0.00, 0.00, 0.00, ''),
(3, '2024-09-15 15:12:39', 0, 1, 1, 40.00, 7.00, 4.00, 'Fisica'),
(4, '2024-09-15 15:15:36', 0, 4, 1, 152.00, 27.00, 14.00, 'Fisica'),
(5, '2024-09-15 15:21:32', 1, 4, 1, 152.49, 26.58, 13.99, 'Fisica'),
(6, '2024-09-15 15:25:16', 1, 3, 1, 152.49, 26.58, 13.99, 'Fisica'),
(7, '2024-09-15 15:31:30', 1, 2, 1, 11988.91, 2089.81, 1099.90, 'Fisica'),
(8, '2024-09-15 15:38:03', 1, 3, 1, 40319.10, 7028.10, 3699.00, 'Fisica'),
(9, '2024-09-15 15:41:09', 1, 1, 1, 152491.00, 26581.00, 13990.00, 'Fisica'),
(10, '2024-09-15 15:41:46', 1, 3, 1, 1525.78, 265.96, 139.98, 'Fisica'),
(11, '2024-09-15 15:43:50', 1, 4, 1, 192810.10, 33609.10, 17689.00, 'Fisica'),
(12, '2024-09-15 15:58:25', 1, 4, 1, 18528.26, 3229.70, 1699.84, 'Fisica'),
(13, '2024-09-15 16:06:26', 1, 4, 1, 11115.06, 1937.49, 1019.73, 'Fisica'),
(14, '2024-09-15 16:17:01', 1, 2, 1, 21143.82, 3685.62, 1939.80, 'Fisica'),
(15, '2024-09-15 16:27:21', 1, 4, 1, 173635.04, 30266.66, 15929.82, 'Fisica'),
(16, '2024-09-15 16:33:31', 1, 2, 1, 164479.91, 28670.81, 15089.90, 'Fisica'),
(17, '2024-09-15 16:55:34', 1, 2, 1, 172109.26, 30000.70, 15789.84, 'Fisica'),
(18, '2024-09-15 16:59:28', 1, 2, 1, 13078.69, 2279.77, 1199.88, 'Fisica'),
(19, '2024-09-15 17:26:34', 1, 3, 1, 13078.69, 2279.77, 1199.88, 'Fisica'),
(20, '2024-09-15 17:28:47', 1, 4, 1, 23977.82, 4179.62, 2199.80, 'Fisica'),
(21, '2024-09-15 17:31:10', 1, 4, 1, 304982.00, 53162.00, 27980.00, 'Fisica'),
(22, '2024-09-15 17:34:30', 1, 3, 1, 23977.82, 4179.62, 2199.80, 'Fisica'),
(23, '2024-09-15 17:36:51', 1, 2, 1, 304982.00, 53162.00, 27980.00, 'Fisica'),
(24, '2024-09-15 17:48:18', 1, 3, 1, 11988.91, 2089.81, 1099.90, 'Fisica'),
(25, '2024-09-15 17:49:13', 1, 4, 1, 164479.91, 28670.81, 15089.90, 'Fisica'),
(26, '2024-09-15 17:54:46', 1, 4, 1, 164479.91, 28670.81, 15089.90, 'Fisica'),
(27, '2024-09-15 17:55:18', 1, 4, 1, 304982.00, 53162.00, 27980.00, 'Fisica'),
(28, '2024-09-15 18:01:41', 1, 4, 1, 304982.00, 53162.00, 27980.00, 'Fisica'),
(29, '2024-09-15 18:03:42', 1, 2, 1, 345301.10, 60190.10, 31679.00, 'Fisica'),
(30, '2024-09-15 18:14:05', 1, 4, 1, 304982.00, 53162.00, 27980.00, 'Fisica'),
(31, '2024-09-17 04:52:12', 1, 4, 1, 504331.45, 87910.99, 46268.94, 'Fisica'),
(32, '2024-09-17 05:04:41', 1, 1, 1, 457691.00, 79781.00, 41990.00, 'Fisica'),
(33, '2024-09-17 05:07:30', 1, 3, 1, 239778.20, 41796.20, 21998.00, 'Fisica'),
(34, '2024-09-17 05:22:21', 1, 4, 1, 609964.00, 106324.00, 55960.00, 'Fisica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_detail`
--

CREATE TABLE `sale_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `quantity_product` int(11) DEFAULT NULL,
  `unit_price` decimal(10,0) DEFAULT NULL,
  `price_discount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sale_detail`
--

INSERT INTO `sale_detail` (`id`, `product_id`, `sale_id`, `quantity_product`, `unit_price`, `price_discount`) VALUES
(1, 2, 3, 1, 36990, NULL),
(2, 2, 3, 1, 36990, NULL),
(3, 1, 4, 1, 139900, NULL),
(4, 1, 5, 1, 139900, NULL),
(5, 1, 6, 1, 139900, NULL),
(6, 3, 7, 1, 10999, NULL),
(7, 2, 8, 1, 36990, NULL),
(8, 1, 9, 1, 139900, NULL),
(9, 6, 10, 1, 6999, NULL),
(10, 1, 11, 1, 139900, NULL),
(11, 2, 11, 1, 36990, NULL),
(12, 3, 12, 1, 10999, 10999),
(13, 4, 12, 1, 9999, 5999),
(14, 4, 13, 1, 9999, 5999),
(15, 11, 13, 1, 19990, 4198),
(16, 4, 14, 3, 9999, 17998),
(17, 6, 14, 1, 6999, 1400),
(18, 4, 15, 1, 9999, 5999),
(19, 6, 15, 1, 6999, 1400),
(20, 5, 15, 1, 11999, 11999),
(21, 1, 15, 1, 139900, 139900),
(22, 4, 15, 1, 9999, 5999),
(23, 6, 15, 1, 6999, 1400),
(24, 5, 15, 1, 11999, 11999),
(25, 1, 15, 1, 139900, 139900),
(26, 1, 16, 1, 139900, 139900),
(27, 3, 16, 1, 10999, 10999),
(28, 1, 17, 1, 139900, 139900),
(29, 5, 17, 1, 11999, 11999),
(30, 4, 17, 1, 9999, 5999),
(31, 4, 18, 2, 9999, 11999),
(32, 4, 19, 2, 9999, 11999),
(33, 3, 20, 2, 10999, 21998),
(34, 1, 21, 2, 139900, 279800),
(35, 3, 22, 2, 10999, 21998),
(36, 1, 23, 2, 139900, 279800),
(37, 1, 23, 2, 139900, 279800),
(38, 3, 24, 1, 10999, 10999),
(39, 1, 24, 1, 139900, 139900),
(40, 2, 24, 1, 36990, 36990),
(41, 3, 25, 1, 10999, 10999),
(42, 1, 25, 1, 139900, 139900),
(43, 3, 25, 1, 10999, 10999),
(44, 1, 25, 1, 139900, 139900),
(45, 3, 26, 1, 10999, 10999),
(46, 1, 26, 1, 139900, 139900),
(47, 1, 27, 2, 139900, 279800),
(48, 1, 28, 2, 139900, 279800),
(49, 3, 28, 1, 10999, 10999),
(50, 1, 28, 2, 139900, 279800),
(51, 2, 29, 1, 36990, 36990),
(52, 1, 29, 2, 139900, 279800),
(53, 2, 29, 1, 36990, 36990),
(54, 1, 29, 2, 139900, 279800),
(55, 2, 29, 1, 36990, 36990),
(56, 1, 29, 2, 139900, 279800),
(57, 2, 29, 1, 36990, 36990),
(58, 1, 29, 2, 139900, 279800),
(59, 2, 29, 1, 36990, 36990),
(60, 1, 29, 2, 139900, 279800),
(61, 1, 30, 2, 139900, 279800),
(62, 1, 31, 3, 139900, 419700),
(63, 2, 31, 1, 36990, 36990),
(64, 4, 31, 1, 9999, 5999),
(65, 13, 32, 10, 41990, 419900),
(66, 3, 33, 20, 10999, 219980),
(67, 1, 34, 4, 139900, 559600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`, `status`) VALUES
(2, 17, 'Dama', '2017-01-26 16:24:52', '2024-09-17 00:36:15', 1),
(3, 15, 'Retro', '2017-01-26 16:29:09', '2024-09-15 23:00:51', 1),
(4, 19, 'Deportivos', '2017-01-30 16:55:48', '', 1),
(5, 19, 'Casuales', '2017-02-04 04:12:40', '', 1),
(6, 18, 'Deportivos', '2017-02-04 04:13:00', '', 1),
(7, 16, 'Ejercicio Diario', '2017-02-04 04:13:27', '', 1),
(8, 18, 'Deportivos', '2017-02-04 04:13:54', '', 1),
(9, 17, 'Retro', '2017-02-04 04:36:45', '', 1),
(10, 18, 'Retro', '2017-02-04 04:37:02', '', 1),
(11, 16, 'Retro', '2017-02-04 04:37:51', '', 1),
(12, 15, 'Men Footwears', '2017-03-10 20:12:59', '', 1),
(13, 17, 'sandalias', '2024-09-14 01:24:07', '2024-09-13 20:24:07', 1),
(14, 16, 'Zapatitos ', '2024-09-17 05:01:43', '2024-09-17 00:01:43', 1),
(15, 15, 'adidas', '2024-09-17 05:36:35', '2024-09-17 00:36:35', 1),
(16, 15, 'Retro', '2024-09-17 08:35:37', '2024-09-17 03:35:37', 1),
(17, 15, 'Colaboraciones', '2024-09-17 08:36:16', '2024-09-17 03:36:16', 1),
(18, 16, 'Atletismo', '2024-09-17 08:36:28', '2024-09-17 03:36:28', 1),
(19, 16, 'Ejercicio Diario', '2024-09-17 08:37:03', '2024-09-17 03:37:03', 1),
(20, 17, 'Casuales', '2024-09-17 08:37:21', '2024-09-17 03:37:21', 1),
(21, 17, 'Elegantes', '2024-09-17 08:37:36', '2024-09-17 03:37:36', 1),
(22, 18, 'Crossfit', '2024-09-17 08:37:47', '2024-09-17 03:37:47', 1),
(23, 18, 'Deportes Extremos', '2024-09-17 08:37:57', '2024-09-17 03:37:57', 1),
(24, 19, 'Urbanas', '2024-09-17 08:38:15', '2024-09-17 03:38:15', 1),
(25, 19, 'Trabajo', '2024-09-17 08:38:21', '2024-09-17 03:38:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `identificationNumber` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `typeDocumentId` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NULL DEFAULT NULL,
  `updateDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `address`, `phone`, `identificationNumber`, `status`, `typeDocumentId`, `email`, `creationdate`, `updateDate`) VALUES
(1, 'DISTRIBUIDORA DEPORTIVAS S.A', 'CARRERA 7 #89-12, BARRIO CHAPINERO, BOGOTA, CUNDINAMARCA', '3028751258', 154878412, 1, 4, 'CONTACTO@DISTRIBUIDORA-DEPORTIVA.COM', NULL, '2024-09-16 14:52:29'),
(2, 'MODA Y ESTILO LTDA', 'CARRERA 7 #89-13, BARRIO CHAPINERO, BOGOTA, CUNDINAMARCA', '303456789', 2147483647, 1, 4, 'VENTAS@MODA-ESTILO.COM', '2024-09-15 22:16:56', NULL),
(3, 'AXA S.A.S.', 'Calle 80 # 30-45', '3104298615', 1004697201, 1, 2, 'axasas@gmail.com', '2024-09-17 05:25:39', '2024-09-17 05:26:59'),
(4, 'mauricio', 'Calle 42, Cra. 87h #12', '3192731523', 1084330337, 1, 1, 'Ferreteriaferretigre@gmail.com', '2024-09-17 06:01:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:18:50', '', 1),
(2, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:29:33', '', 1),
(3, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:30:11', '', 1),
(4, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 15:00:23', '26-02-2017 11:12:06 PM', 1),
(5, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:08:58', '', 0),
(6, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:09:41', '', 0),
(7, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:10:04', '', 0),
(8, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:10:31', '', 0),
(9, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:13:43', '', 1),
(10, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-27 18:52:58', '', 0),
(11, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-27 18:53:07', '', 1),
(12, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-03 18:00:09', '', 0),
(13, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-03 18:00:15', '', 1),
(14, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-06 18:10:26', '', 1),
(15, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 12:28:16', '', 1),
(16, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 18:43:27', '', 1),
(17, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 18:55:33', '', 1),
(18, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 19:44:29', '', 1),
(19, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-08 19:21:15', '', 1),
(20, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-15 17:19:38', '', 1),
(21, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-15 17:20:36', '15-03-2017 10:50:39 PM', 1),
(22, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-16 01:13:57', '', 1),
(23, 'hgfhgf@gmass.com', 0x3a3a3100000000000000000000000000, '2018-04-29 09:30:40', '', 1),
(24, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 19:06:07', '10-09-2024 02:20:58 AM', 1),
(25, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-11 00:57:52', '11-09-2024 07:01:27 AM', 1),
(26, 'brayan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-14 02:15:10', '16-09-2024 06:42:09 AM', 1),
(27, 'brayan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-16 17:44:36', NULL, 1),
(28, 'brayan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-16 21:10:05', '17-09-2024 07:14:18 AM', 1),
(29, 'brayan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-17 01:46:04', '17-09-2024 02:51:43 PM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `identificationType` int(11) DEFAULT NULL,
  `identificationNumber` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `registerType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`, `status`, `identificationType`, `identificationNumber`, `gender`, `registerType`) VALUES
(1, 'Daniel Andres Quitero Lopes', 'anuj.lpu1@gmail.com', 300000000, 'f925916e2754e5e03f75dd58a5733251', 'bogota cundinamarca /bosa', 'New Delhi', 'Delhi', 110001, 'New Delhi', 'New Delhi', 'Delhi', 110092, '2017-02-04 19:30:50', '2024-09-16 09:31:26', 1, 1, 23454782, 1, 'web'),
(2, 'Amit ', 'amit@gmail.com', 8285703355, '5c428d8875d2948607f3e3fe134d71b4', '', '', '', 0, '', '', '', 0, '2017-03-15 17:21:22', '', 1, 1, 54973820, 1, 'web'),
(3, 'hg', 'hgfhgf@gmass.com', 1121312312, '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', 0, '', '', '', 0, '2018-04-29 09:30:32', '', 1, 1, 852159774, 1, 'web'),
(4, 'brayan toro', 'brayan@gmail.com', 236448, 'a5e2ae551ea173951054b05767361199', 'bosa', 'bosa', 'bosa', 0, 'bosa', 'bosa', 'bosa', 0, '2024-09-14 00:17:40', '2024-09-13 19:17:40', 1, 1, 1259871, 1, 'Fisico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(1, 1, 1, '2017-02-27 18:53:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_employee` (`employee_id`);

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brands_supplier` (`supplier`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `identification` (`identification`),
  ADD KEY `fk_employees_typeIdentification` (`identificationType`),
  ADD KEY `fk_employees_gender` (`gender`),
  ADD KEY `fk_employees_position` (`position`);

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`userId`),
  ADD KEY `fk_order_sale` (`sale_id`);

--
-- Indices de la tabla `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ordertrackhistory_order` (`orderId`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productreviews_product` (`productId`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_brand` (`brand`),
  ADD KEY `fk_products_subcategory` (`subCategory`),
  ADD KEY `fk_products_category` (`category`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sales_employee` (`employee_id`),
  ADD KEY `fk_sales_user` (`user_id`);

--
-- Indices de la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sales_detail_sale` (`sale_id`),
  ADD KEY `fk_sales_detail_product` (`product_id`);

--
-- Indices de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategory_category` (`categoryid`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_unique` (`identificationNumber`),
  ADD UNIQUE KEY `suppliers_unique_1` (`email`),
  ADD KEY `fk_suppliers_tipe_identifiaction` (`typeDocumentId`);

--
-- Indices de la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificationNumber_unique` (`identificationNumber`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `fk_users_identificationType` (`identificationType`),
  ADD KEY `fk_users_gender` (`gender`);

--
-- Indices de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wishlist_product` (`productId`),
  ADD KEY `fk_wishlist_user` (`userId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `purchasedetail`
--
ALTER TABLE `purchasedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Filtros para la tabla `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `fk_brands_supplier` FOREIGN KEY (`supplier`) REFERENCES `suppliers` (`id`);

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employees_gender` FOREIGN KEY (`gender`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `fk_employees_position` FOREIGN KEY (`position`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `fk_employees_typeIdentification` FOREIGN KEY (`identificationType`) REFERENCES `identification_type` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD CONSTRAINT `fk_ordertrackhistory_order` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productreviews`
--
ALTER TABLE `productreviews`
  ADD CONSTRAINT `fk_productreviews_product` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_products_subcategory` FOREIGN KEY (`subCategory`) REFERENCES `subcategory` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `fk_sales_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD CONSTRAINT `fk_sales_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_sales_detail_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Filtros para la tabla `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_subcategory_category` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `fk_suppliers_tipe_identifiaction` FOREIGN KEY (`typeDocumentId`) REFERENCES `identification_type` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_gender` FOREIGN KEY (`gender`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `fk_users_identificationType` FOREIGN KEY (`identificationType`) REFERENCES `identification_type` (`id`);

--
-- Filtros para la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
