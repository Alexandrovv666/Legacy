<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    Only_Local_IP();
    $mysql_connect = F_Connect_MySQL();
    mysql_query("UPDATE `game`.`settings` SET  `Value` =  '1' WHERE  `settings`.`name_parametr` ='work'");
    mysql_close($mysql_connect);
    echo '<html><head><meta http-equiv=Refresh content="1; url=/Cron.php?hard=0"></head></html>';
?> 
