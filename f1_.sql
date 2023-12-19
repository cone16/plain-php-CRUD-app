-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Okt 2023 um 22:13
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
-- Datenbank: `f1_`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `driver`
--

CREATE TABLE `driver` (
  `id` int(10) NOT NULL,
  `driverId` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `givenName` varchar(255) NOT NULL,
  `familyName` varchar(255) NOT NULL,
  `dateOfBirth` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `driver`
--

INSERT INTO `driver` (`id`, `driverId`, `url`, `givenName`, `familyName`, `dateOfBirth`, `nationality`) VALUES
(151, 'cohom', 'http://en.wikipedia.org/wiki/Jyrki_J%C3%A4rvilehto', 'Conrad', 'Hofmann', '1984-02-21', 'German'),
(211, 'lehto', 'http://en.wikipedia.org/wiki/Jyrki_J%C3%A4rvilehto', 'Jyrki', 'Järvilehto', '1966-01-31', 'Finnish'),
(212, 'jean', 'http://en.wikipedia.org/wiki/Max_Jean', 'Max', 'Jean', '1943-07-27', 'French'),
(213, 'johansson', 'http://en.wikipedia.org/wiki/Stefan_Johansson', 'Stefan', 'Johansson', '1956-09-08', 'Swedish'),
(214, 'johnson', 'http://en.wikipedia.org/wiki/Eddie_Johnson_(auto_racer)', 'Eddie', 'Johnson', '1919-02-10', 'American'),
(215, 'leslie_johnson', 'http://en.wikipedia.org/wiki/Leslie_Johnson_(racing_driver)', 'Leslie', 'Johnson', '1912-03-22', 'British'),
(216, 'johnstone', 'http://en.wikipedia.org/wiki/Bruce_Johnstone_(racing_driver)', 'Bruce', 'Johnstone', '1937-01-30', 'South African'),
(217, 'jones', 'http://en.wikipedia.org/wiki/Alan_Jones_(Formula_1)', 'Alan', 'Jones', '1946-11-02', 'Australian'),
(218, 'tom_jones', 'http://en.wikipedia.org/wiki/Tom_Jones_(auto_racer)', 'Tom', 'Jones', '1943-04-26', 'American'),
(219, 'jover', 'http://en.wikipedia.org/wiki/Juan_Jover', 'Juan', 'Jover', '1903-11-23', 'Spanish'),
(220, 'karch', 'http://en.wikipedia.org/wiki/Oswald_Karch', 'Oswald', 'Karch', '1917-03-06', 'German'),
(221, 'karthikeyan', 'http://en.wikipedia.org/wiki/Narain_Karthikeyan', 'Narain', 'Karthikeyan', '1977-01-14', 'Indian'),
(222, 'katayama', 'http://en.wikipedia.org/wiki/Ukyo_Katayama', 'Ukyo', 'Katayama', '1963-05-29', 'Japanese'),
(223, 'kavanagh', 'http://en.wikipedia.org/wiki/Ken_Kavanagh', 'Ken', 'Kavanagh', '1923-12-12', 'Australian'),
(224, 'keegan', 'http://en.wikipedia.org/wiki/Rupert_Keegan', 'Rupert', 'Keegan', '1955-02-26', 'British'),
(225, 'keizan', 'http://en.wikipedia.org/wiki/Eddie_Keizan', 'Eddie', 'Keizan', '1944-09-12', 'South African'),
(226, 'keller', 'http://en.wikipedia.org/wiki/Al_Keller', 'Al', 'Keller', '1920-04-11', 'American'),
(227, 'kelly', 'http://en.wikipedia.org/wiki/Joe_Kelly_(Formula_One)', 'Joe', 'Kelly', '1913-03-13', 'Irish'),
(228, 'kennedy', 'http://en.wikipedia.org/wiki/David_Kennedy_(racing_driver)', 'Dave', 'Kennedy', '1953-01-15', 'Irish'),
(229, 'kessel', 'http://en.wikipedia.org/wiki/Loris_Kessel', 'Loris', 'Kessel', '1950-04-01', 'Swiss'),
(230, 'kessler', 'http://en.wikipedia.org/wiki/Bruce_Kessler', 'Bruce', 'Kessler', '1936-03-23', 'American'),
(231, 'kiesa', 'http://en.wikipedia.org/wiki/Nicolas_Kiesa', 'Nicolas', 'Kiesa', '1978-03-03', 'Danish'),
(232, 'kinnunen', 'http://en.wikipedia.org/wiki/Leo_Kinnunen', 'Leo', 'Kinnunen', '1943-08-05', 'Finnish'),
(233, 'kladis', 'http://en.wikipedia.org/wiki/Danny_Kladis', 'Danny', 'Kladis', '1917-02-10', 'American'),
(234, 'klenk', 'http://en.wikipedia.org/wiki/Hans_Klenk', 'Hans', 'Klenk', '1919-10-28', 'German'),
(235, 'klien', 'http://en.wikipedia.org/wiki/Christian_Klien', 'Christian', 'Klien', '1983-02-07', 'Austrian'),
(236, 'kling', 'http://en.wikipedia.org/wiki/Karl_Kling', 'Karl', 'Kling', '1910-09-16', 'German'),
(237, 'klodwig', 'http://en.wikipedia.org/wiki/Ernst_Klodwig', 'Ernst', 'Klodwig', '1903-05-23', 'East German'),
(238, 'kobayashi', 'http://en.wikipedia.org/wiki/Kamui_Kobayashi', 'Kamui', 'Kobayashi', '1986-09-13', 'Japanese'),
(239, 'koinigg', 'http://en.wikipedia.org/wiki/Helmuth_Koinigg', 'Helmuth', 'Koinigg', '1948-11-03', 'Austrian'),
(240, 'kovalainen', 'http://en.wikipedia.org/wiki/Heikki_Kovalainen', 'Heikki', 'Kovalainen', '1981-10-19', 'Finnish');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `driverId` (`driverId`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
