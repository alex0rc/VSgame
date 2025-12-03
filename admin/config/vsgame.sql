-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2025 a las 22:18:44
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
-- Base de datos: `vsgame`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cards`
--

INSERT INTO `cards` (`id`, `name`, `attack`, `defense`, `image`) VALUES
(1, 'Warrior', 8, 5, '../assets/img/cards/1_card.jpg'),
(2, 'Sorceress', 5, 8, '../assets/img/cards/2_card.jpg'),
(3, 'Beastmaster', 6, 6, '../assets/img/cards/3_card.jpg'),
(4, 'Celestial', 7, 7, '../assets/img/cards/4_card.jpg'),
(5, 'Palindromo', 4, 9, '../assets/img/cards/5_card.jpg'),
(6, 'Beastvencer', 9, 4, '../assets/img/cards/6_card.jpg'),
(7, 'Shadowblade', 7, 6, '../assets/img/cards/7_card.jpg'),
(8, 'Stormcaller', 6, 8, '../assets/img/cards/8_card.jpg'),
(9, 'Rockguard', 8, 7, '../assets/img/cards/9_card.jpg'),
(10, 'Nightstalker', 9, 5, '../assets/img/cards/10_card.jpg'),
(11, 'Frostbinder', 5, 9, '../assets/img/cards/11_card.jpg'),
(12, 'Ironfury', 8, 6, '../assets/img/cards/12_card.jpg'),
(13, 'Sunbreaker', 7, 7, '../assets/img/cards/13_card.jpg'),
(14, 'Venomcaster', 6, 9, '../assets/img/cards/14_card.jpg'),
(15, 'RuneKnight', 9, 6, '../assets/img/cards/15_card.jpg'),
(16, 'Bloodhunter', 10, 4, '../assets/img/cards/16_card.jpg'),
(17, 'Starweaver', 5, 8, '../assets/img/cards/17_card.jpg'),
(18, 'Titanborn', 9, 7, '../assets/img/cards/18_card.jpg'),
(19, 'Ashdrifter', 7, 6, '../assets/img/cards/19_card.jpg'),
(20, 'Warfang', 8, 5, '../assets/img/cards/20_card.jpg'),
(21, 'Spiritcaller', 6, 10, '../assets/img/cards/21_card.jpg'),
(22, 'Grimwarden', 9, 6, '../assets/img/cards/22_card.jpg'),
(23, 'Lightbringer', 7, 8, '../assets/img/cards/23_card.jpg'),
(24, 'Bonecrusher', 10, 5, '../assets/img/cards/24_card.jpg'),
(25, 'Windshaper', 6, 7, '../assets/img/cards/25_card.jpg'),
(26, 'Pyromancer', 8, 6, '../assets/img/cards/26_card.jpg'),
(27, 'Shadowpriest', 7, 9, '../assets/img/cards/27_card.jpg'),
(28, 'Skyhunter', 9, 5, '../assets/img/cards/28_card.jpg'),
(29, 'Earthshaker', 8, 8, '../assets/img/cards/29_card.jpg'),
(30, 'Soulrender', 10, 6, '../assets/img/cards/30_card.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `difficulty`, `name`) VALUES
(1, 1, 'Easy'),
(2, 2, 'Normal'),
(3, 3, 'Hard');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `difficulty_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `total_rounds` int(11) NOT NULL,
  `rounds_won` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `wins` int(11) DEFAULT 0,
  `losses` int(11) DEFAULT 0,
  `rol` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registration_date`, `wins`, `losses`, `rol`) VALUES
(1, 'sergi', 'sergi@email.com', '$2y$10$mrwvyeLQHzSSeF2ihWYHGuQMt.kp0rlkq9Sd.ysVNzWCPRPvQBgYK', '2025-11-24 15:57:21', 0, 3, 0),
(2, 'jordi', 'jordi@email.com', '$2y$10$hLajbFF3Kwb2UYN4jEZtA.6yHTbwyte.i2En0WbXX0WfGJjnK4pYK', '2025-11-24 15:58:00', 0, 1, 1),
(3, 'aserrrrrrrr', 'a@a.co', '$2y$10$XbVigHX13nx4zydV.alex.UcXxxNh0iGzlZHh9aWJTNSKL2xwHje.', '2025-11-24 20:08:33', 0, 1, 0),
(4, 'sergi1005', 'sergi@example.com', '$2y$10$0jkmU2YvGDXiQ.6EkSBTkOirpCWNoIgCDRiKjw99k/do/omzQm3p2', '2025-11-24 20:15:40', 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `difficulty_id` (`difficulty_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`difficulty_id`) REFERENCES `config` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
