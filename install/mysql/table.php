<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    echo 'Создание БД и таблиц.<br>';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    mysql_query('CREATE DATABASE IF NOT EXISTS `game` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
    mysql_select_db('game');
    mysql_set_charset("CP1251");
//army_baze
    mysql_query("CREATE TABLE IF NOT EXISTS `army_baze` (`name` varchar(25) NOT NULL, `atack` smallint(6) NOT NULL, `zdorov` smallint(6) NOT NULL, `defens` smallint(6) NOT NULL, `raiting` smallint(6) NOT NULL, `Jalovan` float NOT NULL, `time_arb` mediumint(9) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//aut_history
    mysql_query("CREATE TABLE IF NOT EXISTS `aut_history` (`time` bigint(20) NOT NULL, `login` varchar(15) NOT NULL, `ip` varchar(15) NOT NULL, `session` varchar(5) NOT NULL, `user_agent` varchar(200) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//castle
    $qwery = "CREATE TABLE IF NOT EXISTS `castle` (";
    $qwery .= "`id` int(11) NOT NULL, `x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL,";
    $qwery .= " `name` varchar(10) NOT NULL, `timegate` int(11) NOT NULL,";
    $qwery .= " `gold` double NOT NULL, `tree` double NOT NULL, `stone` double NOT NULL, `men` double NOT NULL,";
    $qwery .= " `agold` float NOT NULL, `atree` float NOT NULL, `astone` float NOT NULL, `amen`double NOT NULL, `max_men` double NOT NULL,";
    $qwery .= " `maxres` int(11) NOT NULL ";
    for ($i = 1; $i <= 8; $i++)
        $qwery .= ", `army_".$i."` int(11) NOT NULL, `army_hidden_".$i."` int(11) NOT NULL";
    $qwery .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysql_query($qwery);
    $qwery = 'ALTER TABLE `castle` ';
    for ($i = 1; $i <= 35; $i++){
        $qwery .= ' ADD COLUMN `c_'.($i).'_n` varchar(15) NOT NULL,';//название комнаты
        $qwery .= ' ADD COLUMN `c_'.($i).'_1` bigint(20) NOT NULL,';//оставшееся время до конца стройки
        $qwery .= ' ADD COLUMN `c_'.($i).'_2` int(11) NOT NULL,';//количество людей на стройке
        $qwery .= ' ADD COLUMN `c_'.($i).'_3` int(11) NOT NULL,';//ID комнаты которая строится - не проверено
        $qwery .= ' ADD COLUMN `c_'.($i).'_4` double NOT NULL,';//Процент построенного
    }
    mysql_query(substr($qwery, 0, strlen($qwery)-1));
//haus
    mysql_query("CREATE TABLE IF NOT EXISTS `haus` (`id` mediumint(9) NOT NULL, `new` text NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `men` int(11) NOT NULL, `max_men` int(11) NOT NULL, `max_sklad_men` int(11) NOT NULL, `agold` int(11) NOT NULL, `atree` int(11) NOT NULL, `astone` int(11) NOT NULL, `asklad` int(11) NOT NULL, `amen` int(11) NOT NULL, `default_time` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//haus_const
    mysql_query("CREATE TABLE IF NOT EXISTS `haus_const` (`name` varchar(15) NOT NULL, `name_rus` varchar(30) NOT NULL, `descr_rus` varchar(150) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//mail
    mysql_query("CREATE TABLE IF NOT EXISTS `mail` (`time_start` int(11) NOT NULL, `time_end` int(11) NOT NULL, `caption` varchar(30) NOT NULL, `text` varchar(200) NOT NULL, `icon` int(11) NOT NULL, `id_autor` int(11) NOT NULL, `id_ziel` int(11) NOT NULL, `write_flag` tinyint(1) NOT NULL, `arhive_metka` int(11) NOT NULL, `warning_metka` int(11) NOT NULL, `admin_metka` int(11) NOT NULL, `hash` text NOT NULL, `delete_flag` tinyint(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//map
    mysql_query("CREATE TABLE IF NOT EXISTS `map` (`x` smallint(6) NOT NULL, `y` smallint(6) NOT NULL, `z` tinyint(4) NOT NULL, `terrain` varchar(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//privelege
    mysql_query("CREATE TABLE IF NOT EXISTS `privelege` (`id_user` int(11) NOT NULL, `root` tinyint(1) NOT NULL, `cheater` tinyint(1) NOT NULL, `support` tinyint(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//session
    mysql_query("CREATE TABLE IF NOT EXISTS `session` (`time` int(11) NOT NULL, `login` varchar(15) NOT NULL, `status` int(11) NOT NULL, `ip` varchar(15) NOT NULL, `session` varchar(5) NOT NULL, `user_agent` varchar(200) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
//settings
    mysql_query("CREATE TABLE IF NOT EXISTS `settings` (`id` int(11) NOT NULL AUTO_INCREMENT, `name_parametr` varchar(15) NOT NULL, `Value` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('timers', '".time()."'),('work', '0'),('TRANSACTION', 0);");
//users
    mysql_query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL AUTO_INCREMENT, `login` varchar(15) NOT NULL, `password` text NOT NULL, `reg_time` int(11) NOT NULL, `almaz` float NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    mysql_query("ALTER TABLE `users` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_close($link);
    echo '<html><head><meta http-equiv=Refresh content="1; url=map.php?x=1"></head></html>';
?>