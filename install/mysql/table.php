<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    echo 'Создание БД и таблиц.<br>';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    mysql_query('CREATE DATABASE IF NOT EXISTS `game` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
    mysql_select_db('game');
    mysql_set_charset("CP1251");
    mysql_query("CREATE TABLE IF NOT EXISTS `kast` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `id_ziel` int(11) NOT NULL, `id_kast` int(11) NOT NULL, `time_start` int(11) NOT NULL, `time_end` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `haus` (`id` int(11) NOT NULL, `new` text NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `men` int(11) NOT NULL, `max_men` int(11) NOT NULL, `max_sklad_men` int(11) NOT NULL, `agold` int(11) NOT NULL, `atree` int(11) NOT NULL, `astone` int(11) NOT NULL, `asklad` int(11) NOT NULL, `amen` int(11) NOT NULL, `default_time` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("CREATE TABLE IF NOT EXISTS `settings` (`id` int(11) NOT NULL AUTO_INCREMENT, `name_parametr` varchar(15) NOT NULL, `Value` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('timers', '".time()."'),('work', '0'),('TRANSACTION', 0);");
    mysql_query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL AUTO_INCREMENT, `login` text NOT NULL, `password` text NOT NULL, `reg_time` int(11) NOT NULL, `almaz` float NOT NULL, `lang` varchar(5) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    mysql_query("ALTER TABLE `users` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_query("CREATE TABLE IF NOT EXISTS `session` (`time` int(11) NOT NULL, `login` varchar(20) NOT NULL, `status` int(11) NOT NULL, `ip` varchar(15) NOT NULL, `session` varchar(30) NOT NULL, `user_agent` varchar(200) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `cron` (`when_added` bigint(20) NOT NULL, `time_start` bigint(20) NOT NULL, `name` varchar(20) NOT NULL, `comment` text NOT NULL, `before_lock_server` int(11) NOT NULL, `before_mail_caption` text NOT NULL, `before_mail_text` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `privelege` (`id_user` int(11) NOT NULL, `root` int(11) NOT NULL, `support` int(11) NOT NULL, `tester` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `ban_user` (`date` bigint(20) NOT NULL, `id_user` int(11) NOT NULL, `time_start` bigint(20) NOT NULL, `time_end` bigint(20) NOT NULL, `comment_world` text NOT NULL, `admin_comment` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `mail` (`time_start` int(11) NOT NULL, `time_end` int(11) NOT NULL, `caption` varchar(30) NOT NULL, `text` text NOT NULL, `icon` int(11) NOT NULL, `id_autor` int(11) NOT NULL, `id_ziel` int(11) NOT NULL, `arhive_metka` int(11) NOT NULL, `warning_metka` int(11) NOT NULL, `admin_metka` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE `map` (`id` int(11) NOT NULL, `x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `terrain` int(11) NOT NULL) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("CREATE TABLE IF NOT EXISTS `army_baze` (`name` varchar(25) NOT NULL, `atack` int(11) NOT NULL, `zdorov` int(11) NOT NULL, `defens` int(11) NOT NULL, `raiting` int(11) NOT NULL, `Jalovan` float NOT NULL, `time_arb` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
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
        $qwery .= ' ADD COLUMN `c_'.($i).'_n` text NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_1` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_2` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_3` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_4` double NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_5` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_6` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_7` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_8` int(11) NOT NULL,';
    }
    mysql_query(substr($qwery, 0, strlen($qwery)-1));
    mysql_query("CREATE TABLE IF NOT EXISTS `haus_const` (`name` text NOT NULL, `name_rus` text NOT NULL, `descr_rus` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query('CREATE TABLE IF NOT EXISTS `progress` (
  `id_login` int(11) NOT NULL,
  `input` int(11) NOT NULL,
  `exit` int(11) NOT NULL,
  `golden_room_worked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    mysql_query('CREATE TABLE IF NOT EXISTS `quest_status` (`id_user` int(11) NOT NULL, `id_quest` int(11) NOT NULL, `status` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    mysql_query('CREATE TABLE IF NOT EXISTS `quest_const` (
  `id_quest` int(11) NOT NULL,
  `name_quest` text NOT NULL,
  `descriptin_quest` text NOT NULL,
  `if_eq_progress_input` int(11) NOT NULL,
  `if_b_golden_room_worked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    mysql_query("ALTER TABLE `quest_const` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_close($link);
    API_INSTALL_ECHO_END_STEP();
    echo '<html><head><meta http-equiv=Refresh content="5; url=map.php?x=1"></head></html>';
?>