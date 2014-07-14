<? //PEAR style
    include '../API.php';
    Only_Local_IP();
    echo '=> Установка. Этап 1: Создание таблиц.<br>';
    $linkss = FConnBase();
    if (!(mysql_table_seek("settings", "game"))) {
        mysql_query('CREATE TABLE IF NOT EXISTS `settings` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name_parametr` text NOT NULL, `Value` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');
        mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('timers', '".time()."'),('work', 0);");
        echo '=> CREATE TABLE `settings`<br>';
    }
    if (!(mysql_table_seek("castle", "game"))) {
        $qwery = "CREATE TABLE IF NOT EXISTS `castle` (
`id` int(11) NOT NULL,  `x` int(11) NOT NULL,  `y` int(11) NOT NULL,  `z` int(11) NOT NULL,  `name` text NOT NULL,  `timegate` int(11) NOT NULL,
  `gold` double NOT NULL,  `tree` double NOT NULL,  `stone` double NOT NULL,
  `agold` float NOT NULL,  `atree` float NOT NULL,  `astone` float NOT NULL,  `maxres` int(11) NOT NULL, ";
        for ($i = 1; $i <= 8; $i++)
            $qwery = $qwery." `army_".$i."` int(11) NOT NULL, `army_hidden_".$i."` int(11) NOT NULL, ";
        $qwery = $qwery." `room_name_1` text NOT NULL,  `value_room_1` int(11) NOT NULL";
        for ($i = 2; $i <= 35; $i++)
            $qwery = $qwery.", `room_name_".$i."` text NOT NULL,  `value_room_".$i."` int(11) NOT NULL";
        $qwery = $qwery.") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        mysql_query($qwery);
        echo '=> CREATE TABLE `castle`<br>';
    }
    if (!(mysql_table_seek("users", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL AUTO_INCREMENT, `login` text NOT NULL,  `password` text NOT NULL,  `reg_time` int(11) NOT NULL,  `almaz` float NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        mysql_query("ALTER TABLE `users` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
        echo '=> CREATE TABLE `users`<br>';
    }
    if (!(mysql_table_seek("session", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `session` (`time` int(11) NOT NULL, `login` text NOT NULL, `status` int(11) NOT NULL, `ip` text NOT NULL, `session` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `session`<br>';
    }
    if (!(mysql_table_seek("see_lager", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `see_lager` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `see_lager`<br>';
    }
    if (!(mysql_table_seek("missions", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `missions` (`id` int(11) NOT NULL AUTO_INCREMENT, `ist_x` int(11) NOT NULL, `ist_y` int(11) NOT NULL, `ist_z` int(11) NOT NULL, `vladelez` text NOT NULL, `k_x` int(11) NOT NULL, `k_y` int(11) NOT NULL, `k_z` int(11) NOT NULL, `dlina` int(11) NOT NULL, `time_finish` int(11) NOT NULL, `type` text NOT NULL, `army_1` int(11) NOT NULL, `army_2` int(11) NOT NULL, `army_3` int(11) NOT NULL, `army_4` int(11) NOT NULL, `army_5` int(11) NOT NULL, `army_6` int(11) NOT NULL, `army_7` int(11) NOT NULL, `army_8` int(11) NOT NULL, `res1` int(11) NOT NULL, `res2` int(11) NOT NULL, `res3` int(11) NOT NULL, `men` int(11) NOT NULL, `almaz` int(11) NOT NULL, `kupz` int(11) NOT NULL, `napravlen` int(11) NOT NULL, `time_help` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
        echo '=> CREATE TABLE `missions`<br>';
    }
    if (!(mysql_table_seek("map", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `map` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `terrain` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `map`<br>';
    }
    if (!(mysql_table_seek("statistic_player", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `statistic_player` (`login` text NOT NULL, `time_update` int(11) NOT NULL, `geolocat_x` float NOT NULL, `geolocat_y` float NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `statistic_player`<br>';
    }
    if (!(mysql_table_seek("lager", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `lager` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `level` int(11) NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `army_1` int(11) NOT NULL, `army_2` int(11) NOT NULL, `army_3` int(11) NOT NULL, `army_4` int(11) NOT NULL, `army_5` int(11) NOT NULL, `army_6` int(11) NOT NULL, `army_7` int(11) NOT NULL, `army_8` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `lager`<br>';
    }
    if (!(mysql_table_seek("haus", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `haus` (`number` int(11) NOT NULL, `alt_room` text NOT NULL, `new_room` text NOT NULL, `name` text NOT NULL, `opisanie` text NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `agold` int(11) NOT NULL, `atree` int(11) NOT NULL, `astone` int(11) NOT NULL, UNIQUE KEY `number` (`number`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `haus`<br>';
    }
    if (!(mysql_table_seek("ban_list", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `ban_list` (`id` int(11) NOT NULL, `login` text NOT NULL, `time_end` int(11) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `ban_list`<br>';
    }
    if (!(mysql_table_seek("kast", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `kast` (`login_ziel` int(11) NOT NULL, `name_kast` int(11) NOT NULL, `name_ist` int(11) NOT NULL, `time_start` int(11) NOT NULL,  `time_end` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `kast`<br>';
    }
    if (!(mysql_table_seek("army_baze", "game"))) {
        mysql_query("CREATE TABLE IF NOT EXISTS `army_baze` (`name` text NOT NULL, `atack` int(11) NOT NULL, `zdorov` int(11) NOT NULL, `defens` int(11) NOT NULL, `raiting` int(11) NOT NULL, `Jalovan` float NOT NULL, `time_arb` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        echo '=> CREATE TABLE `army_baze`<br>';
    }
    if (!(mysql_table_seek("artifacts", "game"))) {
        $qwery = "CREATE TABLE IF NOT EXISTS `artifacts` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `placing` int(11) NOT NULL,
                    `army_atack` int(11) NOT NULL, `army_heath` int(11) NOT NULL, `army_defend` int(11) NOT NULL";
        for ($i = 1; $i <= 8; $i++)
            $qwery = $qwery.", `army_atack_".$i."` int(11) NOT NULL".", `army_heath_".$i."` int(11) NOT NULL".", `army_defend_".$i."` int(11) NOT NULL";
        $qwery = $qwery.", `add_gold` int(11) NOT NULL";
        $qwery = $qwery.", `add_tree` int(11) NOT NULL";
        $qwery = $qwery.", `add_stone` int(11) NOT NULL";
        $qwery = $qwery.", `a_vorov_res` int(11) NOT NULL";
        $qwery = $qwery.", `a_vorov_gold` int(11) NOT NULL";
        $qwery = $qwery.", `a_vorov_tree` int(11) NOT NULL";
        $qwery = $qwery.", `a_vorov_stone` int(11) NOT NULL";
        $qwery = $qwery.", `sklad` int(11) NOT NULL";
        $qwery = $qwery.", `minus_time_mission` int(11) NOT NULL";
        $qwery = $qwery.",  PRIMARY KEY (`id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
        mysql_query($qwery);
        echo '=> CREATE TABLE `artifacts`<br>';
    }
    FClose_mysql_connect($linkss);
    echo '=> Этап 1: Завершено.<br>';
    echo '=> Продолжение установки через 1 сек.<br>';
    echo '=> Этап 2 может занять длительное время...<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=createhaus.php"></head></html>';

?>