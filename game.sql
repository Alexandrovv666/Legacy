DROP TABLE IF EXISTS `kast_help`;
CREATE TABLE IF NOT EXISTS `kast_help` (
  `ID` int(11) NOT NULL,
  `description` text NOT NULL,
  `mana` int(11) NOT NULL,
  `time_min` int(11) NOT NULL,
  `time_max` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `kast_help`;
INSERT INTO `kast_help` (`ID`, `description`, `mana`, `time_min`, `time_max`) VALUES
(0, 'Игроки не могут напасть на замок.', 2000, 86400, 604800),
(1, 'Увеличиывет приток золота в замках игрока на 200/час.', 60, 3600, 360000),
(2, 'Увеличиывет приток золота в замках игрока на 3000/час.', 200, 25200, 108000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
