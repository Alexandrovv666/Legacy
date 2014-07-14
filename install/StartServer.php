<?php
    include '../API.php';
    Only_Local_IP();
    echo '=> Установка. Этап 5: Включение сервера.<br>';
    $linkss = FConnBase();
    mysql_query("UPDATE `game`.`settings` SET  `Value` =  '1' WHERE  `settings`.`name_parametr` ='work'");
    FClose_mysql_connect($linkss);
    echo '=> Завершено.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=/test.php"></head></html>';
?> 
