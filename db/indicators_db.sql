-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2020 a las 16:51:33
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indicators_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uf_historical_data`
--

CREATE TABLE `uf_historical_data` (
  `ID` int(11) NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VALUE` float NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `uf_historical_data`
--

INSERT INTO `uf_historical_data` (`ID`, `DATE`, `VALUE`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, '2020-09-04 08:00:00', 28683.1, '2020-09-04 14:36:30', '0000-00-00'),
(2, '2020-09-03 08:00:00', 28682.2, '2020-09-04 14:36:30', '0000-00-00'),
(3, '2020-09-02 08:00:00', 28681.3, '2020-09-04 14:36:30', '0000-00-00'),
(4, '2020-09-01 08:00:00', 28680.4, '2020-09-04 14:36:30', '0000-00-00'),
(5, '2020-08-31 08:00:00', 28679.4, '2020-09-04 14:36:30', '0000-00-00'),
(6, '2020-08-30 08:00:00', 28678.5, '2020-09-04 14:36:30', '0000-00-00'),
(7, '2020-08-29 08:00:00', 28677.6, '2020-09-04 14:36:30', '0000-00-00'),
(8, '2020-08-28 08:00:00', 28676.7, '2020-09-04 14:36:30', '0000-00-00'),
(9, '2020-08-27 08:00:00', 28675.8, '2020-09-04 14:36:30', '0000-00-00'),
(10, '2020-08-26 08:00:00', 28674.8, '2020-09-04 14:36:30', '0000-00-00'),
(11, '2020-08-25 08:00:00', 28673.9, '2020-09-04 14:36:30', '0000-00-00'),
(12, '2020-08-24 08:00:00', 28673, '2020-09-04 14:36:30', '0000-00-00'),
(13, '2020-08-23 08:00:00', 28672.1, '2020-09-04 14:36:30', '0000-00-00'),
(14, '2020-08-22 08:00:00', 28671.1, '2020-09-04 14:36:30', '0000-00-00'),
(15, '2020-08-21 08:00:00', 28670.2, '2020-09-04 14:36:30', '0000-00-00'),
(16, '2020-08-20 08:00:00', 28669.3, '2020-09-04 14:36:30', '0000-00-00'),
(17, '2020-08-19 08:00:00', 28668.3, '2020-09-04 14:36:30', '0000-00-00'),
(18, '2020-08-18 08:00:00', 28667.4, '2020-09-04 14:36:30', '0000-00-00'),
(19, '2020-08-17 08:00:00', 28666.5, '2020-09-04 14:36:30', '0000-00-00'),
(20, '2020-08-16 08:00:00', 28665.6, '2020-09-04 14:36:30', '0000-00-00'),
(21, '2020-08-15 08:00:00', 28664.7, '2020-09-04 14:36:30', '0000-00-00'),
(22, '2020-08-14 08:00:00', 28663.7, '2020-09-04 14:36:30', '0000-00-00'),
(23, '2020-08-13 08:00:00', 28662.8, '2020-09-04 14:36:30', '0000-00-00'),
(24, '2020-08-12 08:00:00', 28661.9, '2020-09-04 14:36:30', '0000-00-00'),
(25, '2020-08-11 08:00:00', 28661, '2020-09-04 14:36:30', '0000-00-00'),
(26, '2020-08-10 08:00:00', 28660, '2020-09-04 14:36:30', '0000-00-00'),
(27, '2020-08-09 08:00:00', 28659.1, '2020-09-04 14:36:30', '0000-00-00'),
(28, '2020-08-08 08:00:00', 28660, '2020-09-04 14:36:30', '0000-00-00'),
(29, '2020-08-07 08:00:00', 28661, '2020-09-04 14:36:30', '0000-00-00'),
(30, '2020-08-06 08:00:00', 28661.9, '2020-09-04 14:36:30', '0000-00-00'),
(31, '2020-08-05 08:00:00', 28662.8, '2020-09-04 14:36:30', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `uf_historical_data`
--
ALTER TABLE `uf_historical_data`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `uf_historical_data`
--
ALTER TABLE `uf_historical_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
