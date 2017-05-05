-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 May 2017, 14:39:57
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `airlinedb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `connections`
--

CREATE TABLE `connections` (
  `ID` int(6) NOT NULL,
  `Namee` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `connections`
--

INSERT INTO `connections` (`ID`, `Namee`, `Surname`, `Phone`, `Email`) VALUES
(1, 'SELMAN', 'German', '02324789125', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `creditcards`
--

CREATE TABLE `creditcards` (
  `ID` int(6) NOT NULL,
  `CardNo` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `CardHolderName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CardHolderSurname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ExpirationDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `creditcards`
--

INSERT INTO `creditcards` (`ID`, `CardNo`, `CardHolderName`, `CardHolderSurname`, `ExpirationDate`) VALUES
(1, '12345678', 'Selma', 'yuk', '2017-05-09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deneme`
--

CREATE TABLE `deneme` (
  `number` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `no` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `deneme`
--

INSERT INTO `deneme` (`number`, `no`) VALUES
('5', 0),
('5', 541),
('5', 541);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `ID` int(6) NOT NULL,
  `IsAdmin` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `Namee` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNo` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `Passwordd` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FlightMoney` int(4) UNSIGNED NOT NULL,
  `Gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`ID`, `IsAdmin`, `Namee`, `Surname`, `Email`, `PhoneNo`, `Passwordd`, `FlightMoney`, `Gender`) VALUES
(4, 'N', 'elma', 'gnc', 'gnc@gmail.com', '7563789421', '123', 0, 'F'),
(6, 'A', 'admin', 'admin', 'admin@gmail.com', '02327897863', 'admin123', 0, 'F');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `memberticket`
--

CREATE TABLE `memberticket` (
  `ID` int(6) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `TicketId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `passengers`
--

CREATE TABLE `passengers` (
  `ID` int(6) NOT NULL,
  `Namee` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Brithdate` date NOT NULL,
  `TC` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `passengers`
--

INSERT INTO `passengers` (`ID`, `Namee`, `Surname`, `Brithdate`, `TC`, `Gender`) VALUES
(1, 'Selman', 'Yerlikaya', '2017-05-10', NULL, 'M');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(6) NOT NULL,
  `PassergerId` int(11) NOT NULL,
  `ConnectionId` int(11) NOT NULL,
  `FlightId` int(11) NOT NULL,
  `CCardId` int(11) NOT NULL,
  `PNR` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `tickets`
--

INSERT INTO `tickets` (`ID`, `PassergerId`, `ConnectionId`, `FlightId`, `CCardId`, `PNR`, `Price`) VALUES
(1, 1, 1, 1, 1, '13232', 100);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `creditcards`
--
ALTER TABLE `creditcards`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNo`);

--
-- Tablo için indeksler `memberticket`
--
ALTER TABLE `memberticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberId` (`MemberId`),
  ADD KEY `TicketId` (`TicketId`);

--
-- Tablo için indeksler `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `PNR` (`PNR`),
  ADD KEY `CCardId` (`CCardId`),
  ADD KEY `PassergerId` (`PassergerId`),
  ADD KEY `ConnectionId` (`ConnectionId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `connections`
--
ALTER TABLE `connections`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `creditcards`
--
ALTER TABLE `creditcards`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `memberticket`
--
ALTER TABLE `memberticket`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `passengers`
--
ALTER TABLE `passengers`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
