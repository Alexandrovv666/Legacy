<?php
    include '../API.php';
    Only_Local_IP();
    echo '=> Установка. Этап 5: Включение сервера.<br>';
    $linkss = FConnBase();
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('stressTest', '0');");
    global $Count_line_test;
    mysql_query("INSERT INTO `settings` (`name_parametr`, `Value`) VALUES ('hardCount', '".$Count_line_test."');");
    mysql_query("UPDATE `game`.`settings` SET  `Value` =  '1' WHERE  `settings`.`name_parametr` ='work'");
    FClose_mysql_connect($linkss);
    echo '=> Этап 5: Завершено.<br>';
    echo '=> Продолжение установки через 1 сек.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=/test.php"></head></html>';
?> 
