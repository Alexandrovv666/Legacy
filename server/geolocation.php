<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'get_data') {
        if ($_GET['block'] == "geolocation") {
            if (!(mysql_table_seek("statistic_player", "game")))
                mysql_query("CREATE TABLE IF NOT EXISTS `statistic_player` (`login` text NOT NULL, `time_update` int(11) NOT NULL, `geolocat_x` float NOT NULL, `geolocat_y` float NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            mysql_query('INSERT INTO `statistic_player`(`login`, `time_update`, `geolocat_x`, `geolocat_y`) VALUES ("' . F_Get_login($_COOKIE['login']) . '","' . time() . '","' . $_GET['local1'] . '","' . $_GET['local2'] . '")');
            echo '<html><head><meta http-equiv=Refresh content="0; url=/game/"></head></html>';
        }
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
    }
    FClose_mysql_connect($mysql_connect);
?>