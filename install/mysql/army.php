<?php
// ��������� �������� 23.02.2015
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    $mysql_connect = F_Connect_MySQL();
    mysql_query("INSERT INTO `army_baze` (`name`, `atack`, `zdorov`, `defens`, `raiting`, `Jalovan`, `time_arb`) VALUES ('nos', 0, 20, 10, 18, 0.9, 18000), ('voin', 10, 40, 0, 30, 1.5, 30000), ('kon', 20, 60, 0, 48, 2.4, 48000), ('tank', 30, 140, 0, 102, 5.1, 102000), ('bival', 50, 60, 0, 66, 3.3, 66000), ('luk', 70, 40, 0, 66, 3.3, 66000), ('lekar', 10, 30, 10, 114, 5.7, 114000), ('naim', 100, 5, 0, 63, 3.15, 63000);");
    mysql_close($mysql_connect);
    echo '<html><head><meta http-equiv=Refresh content="1; url=/install/runserver.php"></head></html>';
?>