<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    echo '�������� �� � ������.<br>';
    $link = F_Connect_MySQL();
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (9, "�������� ������5", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (10, "�������� ������6", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (11, "�������� ������7", "����� ���-�� �������")');
    mysql_query('INSERT INTO `quest_const`(`id_quest`, `name_quest`, `descriptin_quest`) 
    VALUES (12, "�������� ������8", "����� ���-�� �������")');

    mysql_close($link);
    API_INSTALL_ECHO_END_STEP();
?>