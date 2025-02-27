-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 25. 23:40
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `carenplay`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `charity_companies`
--

CREATE TABLE `charity_companies` (
  `Charity_Id` int(11) NOT NULL,
  `Charity_Name` varchar(70) NOT NULL,
  `Charity_Bio` varchar(150) NOT NULL,
  `Charity_Mail` varchar(60) NOT NULL,
  `Charity_Phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game`
--

CREATE TABLE `game` (
  `Games_Id` int(11) NOT NULL,
  `Players_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `games`
--

CREATE TABLE `games` (
  `Game_Id` int(11) NOT NULL,
  `Game_Name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `games_difficulty`
--

CREATE TABLE `games_difficulty` (
  `Game_Diff_Id` int(11) NOT NULL,
  `Game_Difficulty` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `games_review`
--

CREATE TABLE `games_review` (
  `Games_Review_Id` int(11) NOT NULL,
  `Games_Review_User` varchar(25) DEFAULT NULL,
  `Games_Review_Text` varchar(255) DEFAULT NULL,
  `Games_Review` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game_creators`
--

CREATE TABLE `game_creators` (
  `Game_Creators_Id` int(11) NOT NULL,
  `Game_Creators_Name` varchar(40) DEFAULT NULL,
  `Game_Creators_Email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game_mode`
--

CREATE TABLE `game_mode` (
  `Game_Mode_Id` int(11) NOT NULL,
  `Game_Mode` varchar(15) DEFAULT NULL,
  `Game_Mode_Info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `game_mode`
--

INSERT INTO `game_mode` (`Game_Mode_Id`, `Game_Mode`, `Game_Mode_Info`) VALUES
(1, 'Solo', 'Ebben a játékmódban a SAJÁT legjobb eredményeiddel fogsz tudni versenyezni. Ez a játékmód tökéletes azoknak akiket nem a versenyszellem hajt, hanem inkább hogy az, hogy maguk képességét fejlesszék.'),
(2, 'Multiplayer', 'Ebben a játékmódban az összes játékos egymás ellen versenyzik a \"Legjobb\" cimért. Ez a játékmód tökéletes annak akiben van versenyszellem és szeretné beugrani a mélyvízbe.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game_score`
--

CREATE TABLE `game_score` (
  `Game_Type_Id` int(11) NOT NULL,
  `User_Points` int(11) DEFAULT NULL,
  `Username` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game_type`
--

CREATE TABLE `game_type` (
  `Game_Type_id` int(11) NOT NULL,
  `Game_Type` varchar(30) DEFAULT NULL,
  `Game_Description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player`
--

CREATE TABLE `player` (
  `Player_Id` int(11) NOT NULL,
  `Player_Username` varchar(25) DEFAULT NULL,
  `Player_Points` int(11) DEFAULT NULL,
  `Player_Game_Played_Difficulty` varchar(25) DEFAULT NULL,
  `Player_Count_Games` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`User_id`, `username`, `email`, `password`) VALUES
(3, 'yoyo', 'yoyo@gmail.com', '$2y$12$IuQ3I6VoL78eijdISMhBAuRKh5CJZm2OWc7mi3HQNNcS77uRkjrDa'),
(5, 'Kolbasz', 'kolbasz@gmail.com', '$2y$12$bIlpxGdCIpmcMlNtI9d.BO1Dic0qGCjL1IGZGIVZXgkLSXmE0OZEW');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_generated_money`
--

CREATE TABLE `user_generated_money` (
  `User_Generated_Id` int(11) NOT NULL,
  `User_Generated_Money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `charity_companies`
--
ALTER TABLE `charity_companies`
  ADD PRIMARY KEY (`Charity_Id`);

--
-- A tábla indexei `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`Games_Id`);

--
-- A tábla indexei `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`Game_Id`);

--
-- A tábla indexei `games_difficulty`
--
ALTER TABLE `games_difficulty`
  ADD PRIMARY KEY (`Game_Diff_Id`);

--
-- A tábla indexei `games_review`
--
ALTER TABLE `games_review`
  ADD PRIMARY KEY (`Games_Review_Id`);

--
-- A tábla indexei `game_creators`
--
ALTER TABLE `game_creators`
  ADD PRIMARY KEY (`Game_Creators_Id`);

--
-- A tábla indexei `game_mode`
--
ALTER TABLE `game_mode`
  ADD PRIMARY KEY (`Game_Mode_Id`);

--
-- A tábla indexei `game_score`
--
ALTER TABLE `game_score`
  ADD PRIMARY KEY (`Game_Type_Id`);

--
-- A tábla indexei `game_type`
--
ALTER TABLE `game_type`
  ADD PRIMARY KEY (`Game_Type_id`);

--
-- A tábla indexei `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`Player_Id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- A tábla indexei `user_generated_money`
--
ALTER TABLE `user_generated_money`
  ADD PRIMARY KEY (`User_Generated_Id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `game`
--
ALTER TABLE `game`
  MODIFY `Games_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `game_mode`
--
ALTER TABLE `game_mode`
  MODIFY `Game_Mode_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
