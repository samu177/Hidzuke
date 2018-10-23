-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2018 a las 21:03:58
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
CREATE DATABASE IF NOT EXISTS `hidzuke` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hidzuke`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hini` time NOT NULL,
  `hend` time NOT NULL,
  `id_poll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `link`, `id_user`, `date`) VALUES
(1, 'title1', 'desc1', 'link1', 1, '2018-10-27'),
(2, 'title2', 'desc2', 'link2', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

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
(3, 'samuel', 'samuel', 'samusoto177@gmail.com'),
(4, 'Victor', 'aaaaaa', 'samu.17_@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_dates`
--

CREATE TABLE `users_dates` (
  `id_user` int(11) NOT NULL,
  `id_dates` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_polls`
--

CREATE TABLE `users_polls` (
  `id_user` int(11) NOT NULL,
  `id_poll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_polls`
--

INSERT INTO `users_polls` (`id_user`, `id_poll`) VALUES
(1, 1),
(3, 1),
(3, 2);

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
  ADD KEY `id_dates` (`id_dates`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
