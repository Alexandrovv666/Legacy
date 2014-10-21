<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    $mysql_connect = F_Connect_MySQL();
    mysql_query("UPDATE `game`.`settings` SET  `Value` =  '1' WHERE  `settings`.`name_parametr` ='work'");
    mysql_close($mysql_connect);
    echo 'ÃÎÒÎÂÎ!';
?> 
