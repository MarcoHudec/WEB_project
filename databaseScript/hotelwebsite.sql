-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jan 2024 um 21:21
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotelwebsite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `bild_url` text NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`id`, `bild_url`, `title`, `text`, `date`) VALUES
(45, 'uploads/news/Dominic_1704917914.png', 'Das Lächeln des Dominic Kalarickal', 'Dominic Kalarickal war ein aufgeweckter Junge mit einem Lächeln, das die Herzen der Menschen berührte. Trotz der widrigen Umstände, die sein Leben geprägt hatten, verbreitete er Freude und Hoffnung, wo immer er hinging. Seine Hingabe, anderen zu helfen und seine positive Einstellung inspirierten alle, die ihn kannten.', '2024-01-10 21:18:34');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` text NOT NULL,
  `date_reservation` date NOT NULL,
  `breakfast` text NOT NULL,
  `parkingspot` text NOT NULL,
  `pet` text NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `date_start`, `date_end`, `status`, `date_reservation`, `breakfast`, `parkingspot`, `pet`, `totalprice`) VALUES
(41, 24, 1, '2024-01-10', '2024-01-11', 'canceled', '2024-01-10', 'yes', 'no', 'yes', 130);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room` text NOT NULL,
  `status` text NOT NULL DEFAULT 'available',
  `price` int(11) NOT NULL,
  `breakfastprice` int(11) NOT NULL,
  `parkingspotprice` int(11) NOT NULL,
  `petprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `rooms`
--

INSERT INTO `rooms` (`id`, `room`, `status`, `price`, `breakfastprice`, `parkingspotprice`, `petprice`) VALUES
(1, 'Standard mit Kingsize-Bett', 'available', 100, 20, 10, 10),
(2, 'Standard mit Queensize-Bett', 'available', 100, 20, 10, 10),
(3, 'Deluxe mit Kingsize-Bett', 'available', 200, 20, 10, 10),
(5, 'Executive Suite', 'available', 300, 20, 10, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `salutation` text NOT NULL,
  `role` text NOT NULL DEFAULT 'user',
  `status` text NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `salutation`, `role`, `status`) VALUES
(19, 'Admin', '$2y$10$Gfzk3pJgo7xvuimv/NKW1OO37BgRxHzubqZ3a7n//mMMqXVEs1/WS', 'admin@gmx.at', 'Admin', 'Admin', 'male', 'admin', 'active'),
(24, 'Marcel', '$2y$10$Q7R51cEB1NMG8qjuu.IAXedcu5tLemj2EWIvDvfHh7K2E0EvAq9.C', 'marcel.ivanic@gmx.at', 'Marcel', 'Ivanic', 'male', 'user', 'active'),
(25, 'Marco', '$2y$10$NCKd0OiKxLmtHbXXuCbNVe0n/CtkLy0ymzbT0w52HtGgq.iYcXMiS', 'marco.hudec@gmx.at', 'Marco', 'Hudec', 'male', 'user', 'inactive');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
