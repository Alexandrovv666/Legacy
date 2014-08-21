<?php
    include $_SERVER['DOCUMENT_ROOT'].'/API.php';
    Only_Local_IP();
    $linkss = FConnBase();
    mysql_query("UPDATE `game`.`settings` SET  `Value` =  '1' WHERE  `settings`.`name_parametr` ='work'");
    FClose_mysql_connect($linkss);
    echo '<html><head><meta http-equiv=Refresh content="1; url=/Cron.php"></head></html>';
?> 
