<?php
    include '../API.php';
    Only_Local_IP();
    echo '=> ���������. ���� 2: ���������� ������� ������.<br>';
    $mysql_connect  = FConnBase();
    $Max_level_HAUS = 700;
    //*************************
    $Max_level_HAUS = $Max_level_HAUS - 1;
    mysql_query('TRUNCATE `haus`');
    $DELTA   = 0;
    $DELTA_X = $Max_level_HAUS + 2;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`tree`, `stone`, `agold`) VALUES ("' . $i . '","","lavka' . ($i + 1) . '","������� ��������","� ���� ������� ��������� ��������. ��� �� ������������ ���� ������.", "'.(($i+1)*($i+1)*($i+1)*6).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*30).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`tree`, `stone`, `agold`) VALUES ("' . $i . '","lavka' . ($i) . '","lavka' . ($i + 1) . '","������� ��������","� ���� ������� ��������� ��������. ��� �� ������������ ���� ������.", "'.(($i+1)*($i+1)*($i+1)*6).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*30).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `stone`, `atree`) VALUES ("' . ($i + $DELTA) . '","","lesop' . ($i + 1) . '","������� ������� �� ������","� ���� ������� ��������� ������ �� ������.","'.(($i+1)*($i+1)*($i+1)*60).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*3).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `stone`, `atree`) VALUES ("' . ($i + $DELTA) . '","lesop' . ($i) . '","lesop' . ($i + 1) . '","������� ������� �� ������","� ���� ������� ��������� ������ �� ������.","'.(($i+1)*($i+1)*($i+1)*60).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*3).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `astone`) VALUES ("' . ($i + $DELTA) . '","","kamen' . ($i + 1) . '","������� ������� �� �����","� ���� ������� ��������� ������ �� �����.","'.(($i+1)*($i+1)*($i+1)*10).'","'.(($i+1)*($i+1)*($i+1)*20).'","'.(($i+1)*($i+1)*1).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `astone`) VALUES ("' . ($i + $DELTA) . '","kamen' . ($i) . '","kamen' . ($i + 1) . '","������� ������� �� �����","� ���� ������� ��������� ������ �� �����.","'.(($i+1)*($i+1)*($i+1)*10).'","'.(($i+1)*($i+1)*($i+1)*20).'","'.(($i+1)*($i+1)*1).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","","issled' . ($i + 1) . '","������� �������������","������������� �������� �������� �� ���������� ����� ��������, ����� ��� �����, ������, ������ �����������.","100","70","50")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","issled' . ($i) . '","issled' . ($i + 1) . '","������� �������������","������������� �������� �������� �� ���������� ����� ��������, ����� ��� �����, ������, ������ �����������.","' . (100 * 3 * ($i + 1)) . '","' . (70 * ($i) * 3) . '","' . ((50 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","","nos' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.","400","200","70")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","nos' . ($i) . '","nos' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.","' . (400 * 3 * ($i + 1)) . '","' . (200 * ($i) * 3) . '","' . ((70 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","voin' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.", "600","300","200")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","voin' . ($i) . '","voin' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.", "' . (600 * 3 * ($i + 1)) . '","' . (300 * ($i) * 3) . '","' . ((200 + $i * 2) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","kon' . ($i + 1) . '","������� ��������","� ���� ������� ����� ����������� ��������.", "1000","500","250")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","kon' . ($i) . '","kon' . ($i + 1) . '","������� ��������","� ���� ������� ����� ����������� ��������.", "' . (1000 * 3 * ($i + 1)) . '","' . (500 * ($i) * 3) . '","' . ((250 + $i * 3) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","tank' . ($i + 1) . '","������� ������","� ���� ������� ����� ����������� ������������������� ������.", "2000","1200","900")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","tank' . ($i) . '","tank' . ($i + 1) . '","������� ������","� ���� ������� ����� ����������� ������������������� ������.", "' . (2000 * 3 * ($i + 1)) . '","' . (1200 * ($i) * 3) . '","' . ((900 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","bival' . ($i + 1) . '","������� �������","� ���� ������� ����� ����������� ������� ������.", "2500","2000","1300")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","bival' . ($i) . '","bival' . ($i + 1) . '","������� �������","� ���� ������� ����� ����������� ������� ������.", "' . (2500 * 3 * ($i + 1)) . '","' . (2000 * ($i) * 3) . '","' . ((1300 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","luk' . ($i + 1) . '","������� ��������","� ���� ������� ����� ����������� ��������.", "2500","2000","1300")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","luk' . ($i) . '","luk' . ($i + 1) . '","������� ��������","� ���� ������� ����� ����������� ��������.", "' . (2500 * 3 * ($i + 1)) . '","' . (2000 * ($i) * 3) . '","' . ((1300 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","lekar' . ($i + 1) . '","������� ���������","� ���� ������� ����� ����������� ���������.", "5000","3200","6000")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","lekar' . ($i) . '","lekar' . ($i + 1) . '","������� ���������","� ���� ������� ����� ����������� ���������.", "' . (5000 * 3 * ($i + 1)) . '","' . (3200 * ($i) * 3) . '","' . ((6000 + $i) * (5 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","naim' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.", "7000","1000","2000")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","naim' . ($i) . '","naim' . ($i + 1) . '","������� ����������","� ���� ������� ����� ����������� ����������.", "' . (7000 * 3 * ($i + 1)) . '","' . (1000 * ($i) * 3) . '","' . ((2000 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    echo '=> ���� 2: ���������.<br>';
    echo '=> ����������� ��������� ����� 1 ���.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=createarmy.php"></head></html>';
?> 
