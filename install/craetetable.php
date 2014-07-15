<? //PEAR style
    include '../API.php';
    echo '=> Установка. Этап 1: Создание таблиц.<br>';
    $link = mysql_connect("Legacy", "root", "") or die('Пожалуйста, перезагрузите страницу.<br>Если подобное повторяется, свяжитесь с Администрацией и сообщите ей сообщение ошибки.<br>Сообщение <u>'.mysql_error().'</u>');
    mysql_query('CREATE DATABASE IF NOT EXISTS `game` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
    mysql_select_db('game') or die('Пожалуйста, перезагрузите страницу.<br>Если подобное повторяется, свяжитесь с Администрацией и сообщите ей сообщение ошибки.<br>Сообщение: <b><u>'.mysql_error().'</u></b>');
    mysql_set_charset("CP1251");
    mysql_query('CREATE TABLE IF NOT EXISTS `settings` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name_parametr` text NOT NULL, `Value` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('timers', '".time()."'),('work', 0);");
    $qwery  = 'CREATE TABLE IF NOT EXISTS `castle` (';
    $qwery .= '`id` int(11) NOT NULL,  `x` int(11) NOT NULL,  `y` int(11) NOT NULL, ';
    $qwery .= '`z` int(11) NOT NULL,  `name` text NOT NULL,  `timegate` int(11) NOT NULL,';
    $qwery .= '`gold` double NOT NULL,  `tree` double NOT NULL,  `stone` double NOT NULL,';
    $qwery .= '`agold` float NOT NULL,  `atree` float NOT NULL,  `astone` float NOT NULL, ';
    $qwery .= '`maxres` int(11) NOT NULL, ';
    for ($i = 1; $i <= 8; $i++)
            $qwery .= ' `army_'.$i.'` int(11) NOT NULL, `army_hidden_'.$i.'` int(11) NOT NULL, ';
    $qwery .= ' `room_name_1` text NOT NULL, `value_room_1` int(11) NOT NULL ';
    for ($i = 2; $i <= 35; $i++)
        $qwery .= ', `room_name_'.$i.'` text NOT NULL, `value_room_'.$i.'` int(11) NOT NULL ';
    $qwery .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
    mysql_query($qwery);
    mysql_query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL AUTO_INCREMENT, `login` text NOT NULL,  `password` text NOT NULL,  `reg_time` int(11) NOT NULL,  `almaz` float NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("ALTER TABLE `users` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_query("CREATE TABLE IF NOT EXISTS `session` (`time` int(11) NOT NULL, `login` text NOT NULL, `status` int(11) NOT NULL, `ip` text NOT NULL, `session` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `see_lager` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `missions` (`id` int(11) NOT NULL AUTO_INCREMENT, `ist_x` int(11) NOT NULL, `ist_y` int(11) NOT NULL, `ist_z` int(11) NOT NULL, `vladelez` text NOT NULL, `k_x` int(11) NOT NULL, `k_y` int(11) NOT NULL, `k_z` int(11) NOT NULL, `dlina` int(11) NOT NULL, `time_finish` int(11) NOT NULL, `type` text NOT NULL, `army_1` int(11) NOT NULL, `army_2` int(11) NOT NULL, `army_3` int(11) NOT NULL, `army_4` int(11) NOT NULL, `army_5` int(11) NOT NULL, `army_6` int(11) NOT NULL, `army_7` int(11) NOT NULL, `army_8` int(11) NOT NULL, `res1` int(11) NOT NULL, `res2` int(11) NOT NULL, `res3` int(11) NOT NULL, `men` int(11) NOT NULL, `almaz` int(11) NOT NULL, `kupz` int(11) NOT NULL, `napravlen` int(11) NOT NULL, `time_help` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    mysql_query("CREATE TABLE IF NOT EXISTS `map` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `terrain` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `statistic_player` (`login` text NOT NULL, `time_update` int(11) NOT NULL, `geolocat_x` float NOT NULL, `geolocat_y` float NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `lager` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `level` int(11) NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `army_1` int(11) NOT NULL, `army_2` int(11) NOT NULL, `army_3` int(11) NOT NULL, `army_4` int(11) NOT NULL, `army_5` int(11) NOT NULL, `army_6` int(11) NOT NULL, `army_7` int(11) NOT NULL, `army_8` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `haus` (`number` int(11) NOT NULL, `alt_room` text NOT NULL, `new_room` text NOT NULL, `name` text NOT NULL, `opisanie` text NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `agold` int(11) NOT NULL, `atree` int(11) NOT NULL, `astone` int(11) NOT NULL, UNIQUE KEY `number` (`number`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `ban_list` (`id` int(11) NOT NULL, `login` text NOT NULL, `time_end` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `kast` (`login_ziel` int(11) NOT NULL, `name_kast` int(11) NOT NULL, `name_ist` int(11) NOT NULL, `time_start` int(11) NOT NULL,  `time_end` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `army_baze` (`name` text NOT NULL, `atack` int(11) NOT NULL, `zdorov` int(11) NOT NULL, `defens` int(11) NOT NULL, `raiting` int(11) NOT NULL, `Jalovan` float NOT NULL, `time_arb` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    FClose_mysql_connect($link);
    echo '=> Этап 1: Завершено.<br>';
    echo '=> Этап 2: может занять длительное время...<br>';
    echo '<html><head><meta http-equiv=Refresh content="3; url=createhaus.php"></head></html>';

?>