-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2018 a las 19:08:00
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hidzuke`
--
DROP DATABASE IF EXISTS `hidzuke`;
CREATE DATABASE IF NOT EXISTS `hidzuke` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hidzuke`;

-- --------------------------------------------------------

--
-- Usuario de la base de datos: `hidzuke`
--
GRANT ALL PRIVILEGES ON *.* TO 'hidzuke_user'@'localhost' IDENTIFIED BY PASSWORD '*A9BB3B8CDD4B81C8B3B72EE6DB8A1EC2B4AA1008' WITH GRANT OPTION;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dates`
--

DROP TABLE IF EXISTS `dates`;
CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hini` time NOT NULL,
  `hend` time NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `id_poll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dates`
--

INSERT INTO `dates` (`id`, `date`, `hini`, `hend`, `votes`, `id_poll`) VALUES
(28, '2018-10-29', '22:00:00', '00:00:00', 3, 35),
(29, '2018-10-30', '22:00:00', '00:00:00', 2, 35),
(30, '2018-10-31', '21:00:00', '00:00:00', 3, 35),
(33, '2018-10-29', '12:30:00', '14:30:00', 2, 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `hours` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `link`, `id_user`, `date`, `hours`) VALUES
(35, 'Cena ', 'Elegir el día que mejor os convenga', 'clUeAfEbsi', 9, '2018-10-29', '22:00 00:00'),
(38, 'Matrícula TSW', 'PLS PLS', 'hD227ARzrb', 11, '2018-10-29', '12:30 14:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pwd` varchar(16) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `pwd`, `mail`) VALUES
(1, 'admin', 'admin', 'admin@admin.com'),
(9, 'Victor', 'victor', 'victor@gmail.com'),
(10, 'Samuel', 'samuel', 'samuel@gmail.com'),
(11, 'Lipido', 'lipido', 'lipido@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_dates`
--

DROP TABLE IF EXISTS `users_dates`;
CREATE TABLE `users_dates` (
  `id_user` int(11) NOT NULL,
  `id_dates` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_dates`
--

INSERT INTO `users_dates` (`id_user`, `id_dates`) VALUES
(9, 28),
(9, 30),
(9, 33),
(10, 28),
(10, 29),
(10, 30),
(10, 33),
(11, 28),
(11, 29),
(11, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_polls`
--

DROP TABLE IF EXISTS `users_polls`;
CREATE TABLE `users_polls` (
  `id_user` int(11) NOT NULL,
  `id_poll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_polls`
--

INSERT INTO `users_polls` (`id_user`, `id_poll`) VALUES
(9, 35),
(9, 38),
(10, 35),
(10, 38),
(11, 35),
(11, 38);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dates_ibfk_1` (`id_poll`);

--
-- Indices de la tabla `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `link` (`link`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `users_dates`
--
ALTER TABLE `users_dates`
  ADD PRIMARY KEY (`id_user`,`id_dates`),
  ADD KEY `id_dates` (`id_dates`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users_polls`
--
ALTER TABLE `users_polls`
  ADD PRIMARY KEY (`id_user`,`id_poll`),
  ADD KEY `id_poll` (`id_poll`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`id_poll`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_dates`
--
ALTER TABLE `users_dates`
  ADD CONSTRAINT `users_dates_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_dates_ibfk_2` FOREIGN KEY (`id_dates`) REFERENCES `dates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_polls`
--
ALTER TABLE `users_polls`
  ADD CONSTRAINT `users_polls_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_polls_ibfk_2` FOREIGN KEY (`id_poll`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
