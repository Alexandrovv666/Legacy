<?//PEAR style
/*
�������� ������� ������. ��� ������� ��������� � ������� InnoDB
*/
    echo 'Step 1. Create MySQL Database and tables.<br>';
    include $_SERVER['DOCUMENT_ROOT'].'/API.php';
    global $C_MySQL_Host, $C_MySQL_login;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, "");
    mysql_query('CREATE DATABASE IF NOT EXISTS `game` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
    mysql_select_db('game');
    mysql_set_charset("CP1251");
    mysql_query("CREATE TABLE IF NOT EXISTS `kast` (`x` int(11) NOT NULL, `y` int(11) NOT NULL, `z` int(11) NOT NULL, `id_ziel` int(11) NOT NULL, `id_kast` int(11) NOT NULL, `time_start` int(11) NOT NULL, `time_end` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    mysql_query("CREATE TABLE IF NOT EXISTS `haus` (`id` int(11) NOT NULL, `new` text NOT NULL, `gold` int(11) NOT NULL, `tree` int(11) NOT NULL, `stone` int(11) NOT NULL, `men` int(11) NOT NULL, `max_men` int(11) NOT NULL, `agold` int(11) NOT NULL, `atree` int(11) NOT NULL, `astone` int(11) NOT NULL, `asklad` int(11) NOT NULL, `amen` int(11) NOT NULL, `default_time` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("ALTER TABLE `haus` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_query("CREATE TABLE IF NOT EXISTS `settings` (`id` int(11) NOT NULL AUTO_INCREMENT, `name_parametr` varchar(10) NOT NULL, `Value` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('timers', '".time()."'),('work', 0);");
    mysql_query("CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL AUTO_INCREMENT, `login` text NOT NULL, `password` text NOT NULL, `reg_time` int(11) NOT NULL, `almaz` float NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    mysql_query("ALTER TABLE `users` MODIFY COLUMN `id` INT AUTO_INCREMENT;");
    mysql_query("CREATE TABLE IF NOT EXISTS `session` (`time` int(11) NOT NULL, `login` varchar(20) NOT NULL, `status` int(11) NOT NULL, `ip` varchar(15) NOT NULL, `session` varchar(30) NOT NULL, `user_agent` varchar(200) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
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
        $qwery .= ' ADD COLUMN `c_'.($i).'_4` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_5` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_6` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_7` int(11) NOT NULL,';
        $qwery .= ' ADD COLUMN `c_'.($i).'_8` int(11) NOT NULL,';
    }
    mysql_query(substr($qwery, 0, strlen($qwery)-1));
    FClose_mysql_connect($link);
    echo 'Step 1 is Finish.<br>';
    echo 'Wait 3 second for start step 2.<br>';
    echo '<html><head><meta http-equiv=Refresh content="3; url=haus.php"></head></html>';
?>