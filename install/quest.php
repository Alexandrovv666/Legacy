<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    echo 'Создание БД и таблиц.<br>';
    $link = F_Connect_MySQL();
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (9, "Написать игроку5", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (10, "Написать игроку6", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (11, "Написать игроку7", "Нужно что-то сделать")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (12, "Написать игроку8", "Нужно что-то сделать")');

    mysql_close($link);
    API_INSTALL_ECHO_END_STEP();
?>