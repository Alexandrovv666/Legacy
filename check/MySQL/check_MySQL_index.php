<?php
    include 'check_MySQL_config.php';
    if ($const_check_MySQL_table_it_enable){
        F_Loging($const_file_mysql_result_it_name,  'Начало проверки MySQL данных.');
        F_Loging($const_file_mysql_result_it_name,  'Проверка таблицы "army_baze".');
        if (!(mysql_table_seek("army_baze", "game"))){
            F_Loging($const_file_global_raport_it_name, 'База данных "army_baze" отсутствует.');
            F_Loging($const_file_mysql_raport_it_name,  'База данных "army_baze" отсутствует.');
            mysql_query("CREATE TABLE IF NOT EXISTS `army_baze` (`name` text NOT NULL, `atack` int(11) NOT NULL, `zdorov` int(11) NOT NULL, `defens` int(11) NOT NULL, `raiting` int(11) NOT NULL, `Jalovan` float NOT NULL, `time_arb` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            mysql_query("INSERT INTO `army_baze` (`name`, `atack`, `zdorov`, `defens`, `raiting`, `Jalovan`, `time_arb`) VALUES('nos', 0, 20, 10, 18, 0.9, 18000),('voin', 10, 40, 0, 30, 1.5, 30000),('kon', 20, 60, 0, 48, 2.4, 48000),('tank', 30, 140, 0, 102, 5.1, 102000),('bival', 50, 60, 0, 66, 3.3, 66000),('luk', 70, 40, 0, 66, 3.3, 66000),('lekar', 10, 30, 10, 114, 5.7, 114000),('naim', 100, 5, 0, 63, 3.15, 63000);");
            F_Loging($const_file_mysql_raport_it_name,  'База данных "army_baze" создана и заполнена.');
        }else{
            if (mysql_num_rows(mysql_query("SELECT * FROM `army_baze` LIMIT 1"))<0){
                mysql_query("INSERT INTO `army_baze` (`name`, `atack`, `zdorov`, `defens`, `raiting`, `Jalovan`, `time_arb`) VALUES('nos', 0, 20, 10, 18, 0.9, 18000),('voin', 10, 40, 0, 30, 1.5, 30000),('kon', 20, 60, 0, 48, 2.4, 48000),('tank', 30, 140, 0, 102, 5.1, 102000),('bival', 50, 60, 0, 66, 3.3, 66000),('luk', 70, 40, 0, 66, 3.3, 66000),('lekar', 10, 30, 10, 114, 5.7, 114000),('naim', 100, 5, 0, 63, 3.15, 63000);");
                F_Loging($const_file_mysql_raport_it_name,  'База данных "army_baze" заполнена.');
            }else{
            }
        }
    }
?> 
