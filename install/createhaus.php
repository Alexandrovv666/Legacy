<?php
    include '../API.php';
    $mysql_connect  = FConnBase();
    $Max_level_HAUS = 10;
    //*************************
    $Max_level_HAUS = $Max_level_HAUS - 1;
    mysql_query('TRUNCATE `haus`');//�� ������ ���������� �������
    $DELTA   = 0;//������ � �������
    $DELTA_X = $Max_level_HAUS + 2;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        mysql_query('INSERT INTO `haus`(`id`, `new`, `tree`, `stone`, `agold`) VALUES ("'.$i.'","lavka'.($i+1).'","'.(15*($i+1)).'","'.$i.'","'.($i*30+30).'")');
    $DELTA_X = $Max_level_HAUS + 2;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        mysql_query('INSERT INTO `haus`(`id`, `new`, `gold`, `stone`, `atree`) VALUES ("'.$i.'","lesop'.($i+1).'","'.(50*($i+1)).'","'.($i*10).'","'.($i*20+20).'")');




    echo '=> ���� 2: ���������.<br>';
    echo '=> ����������� ��������� ����� 1 ���.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=createarmy.php"></head></html>';
?> 
