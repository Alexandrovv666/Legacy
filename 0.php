<?php
    include 'API.php';
    include 'Constant.php';
    $linkss = FConnBase();
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lavka","������ �࣮��","����蠥� ��⮪ ����� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lesop","������ ��᭨��","����蠥� ��⮪ �ॢ�ᨭ� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("kamen","������ �����騪�","����蠥� ��⮪ ����� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("sklad","�����᪠� ������","��㦨� ��� �࠭���� ����ᮢ")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("treasury","���஢�魨�","�࠭�� �����᪨� �।����")');



?> 
