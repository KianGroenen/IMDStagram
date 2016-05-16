-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2016 om 20:33
-- Serverversie: 10.1.9-MariaDB
-- PHP-versie: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdstagram`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `commenter_ID` int(11) NOT NULL,
  `tekst` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follows`
--

CREATE TABLE `follows` (
  `ID` int(11) NOT NULL,
  `followed_user_ID` int(11) NOT NULL,
  `follower_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `follows`
--

INSERT INTO `follows` (`ID`, `followed_user_ID`, `follower_ID`) VALUES
(1, 38, 37);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `liker_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `tekst` varchar(3000) NOT NULL,
  `foto` varchar(3000) NOT NULL,
  `inapropriate` int(11) NOT NULL,
  `location` varchar(3000) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`ID`, `user_ID`, `tekst`, `foto`, `inapropriate`, `location`, `dateCreated`) VALUES
(5, 35, 'marginaal', '12771748_874602779328647_2710427920871641239_o.jpg', 0, '', '2016-05-15 22:00:00'),
(6, 37, 'mopje', '1vLLI3A.png', 0, '', '2016-05-15 22:00:00'),
(7, 37, 'aaaa', 'guy-at-privates-inline_B5BEFD10DB594CD9B86A8E64EBF22ED7.jpg', 0, '', '2016-05-16 15:58:59'),
(9, 37, 'dfdljfflq', 'a2mVroE_700b_v1.jpg', 0, '', '2016-05-16 16:20:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Avatar` varchar(500) DEFAULT NULL,
  `prive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `Avatar`, `prive`) VALUES
(35, 'jon', '$2y$12$DDp5z3DNNq16DuwNUS5sNez20HVdbVUuX99J2SH8Ld6bPLsFK3Wv.', 'email', NULL, 0),
(36, 'user', '$2y$12$e9v.i0HQFF8l7eBVsB1.fOMK6wLkSk7hBF9kyyxxLanpsB/bUveHO', 'email', NULL, 1),
(37, 'bieke', '$2y$12$vXx1yJcfUAt4uUIiNLR19u3lK8Dpu16Vztozie7RnEDXtIbDQF2pK', 'slet', 'dickbutt.jpg', 1),
(38, 'helloKitty', '$2y$12$fetwRMFBF3bxBkJqX9XG7OBaKiplXYlGYJi7ibPcuil8gHetu1CuO', 'hello@kitty.com', 'maxresdefault.jpg', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
