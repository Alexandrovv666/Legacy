<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    echo '�������� �� � ������.<br>';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (5, "�������� ������", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (6, "�������� ������2", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (7, "�������� ������3", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (8, "�������� ������4", "����� ���-�� �������")');

    mysql_close($link);
    API_INSTALL_ECHO_END_STEP();
?>