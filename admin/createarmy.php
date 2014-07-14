<?php
    include '../API.php';
    Only_Local_IP();
    echo '=> Установка. Этап 3: Заполнение таблицы армии.<br>';
    $linkss = FConnBase();
    mysql_query("INSERT INTO `army_baze` (`name`, `atack`, `zdorov`, `defens`, `raiting`, `Jalovan`, `time_arb`) VALUES('nos', 0, 20, 10, 18, 0.9, 18000),('voin', 10, 40, 0, 30, 1.5, 30000),('kon', 20, 60, 0, 48, 2.4, 48000),('tank', 30, 140, 0, 102, 5.1, 102000),('bival', 50, 60, 0, 66, 3.3, 66000),('luk', 70, 40, 0, 66, 3.3, 66000),('lekar', 10, 30, 10, 114, 5.7, 114000),('naim', 100, 5, 0, 63, 3.15, 63000);");
    FClose_mysql_connect($linkss);
    echo '=> Этап 3: Завершено.<br>';
    echo '=> Продолжение установки через 1 сек.<br>';
    echo '=> Этап 4 может занять длительное время...<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=fullenmap.php"></head></html>';
?> 
