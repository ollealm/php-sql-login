-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 04 aug 2020 kl 22:06
-- Serverversion: 10.4.13-MariaDB
-- PHP-version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `login_nti`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `password`) VALUES
(1, 'test', 'test@test.com', '$2y$10$5h9qxzJlst92xQbh.BjgC.JVeJpU6gYsQHz23sB5tzlkXE0303M6S'),
(2, 'olle', 'olle@olle.com', '$2y$10$pIRzp4nogarV4XYnrhyRU.3Da1e4Mq0GW5peVqy43h2IX2c5vlOP6');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`user_name`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
