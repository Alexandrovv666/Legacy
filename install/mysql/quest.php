<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    echo 'Создание БД и таблиц.<br>';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (5, "Написать игроку", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (6, "Написать игроку2", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (7, "Написать игроку3", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (8, "Написать игроку4", "Нужно что-то сделать")');

    mysql_close($link);
    API_INSTALL_ECHO_END_STEP();
?>