<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/network.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/install.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/gameserver.php';
    $mysql_connect = F_Connect_MySQL();
    $x=$_GET['x'];
    Global $Max_X_map, $Max_Y_map;
    echo '���������� �����.<br>';
    echo '�.�. ������� ����� ������ ��� ����������, ������� ������ �� ��������� ������.<br>';
    echo '������� �������� '.$x.'/'.$Max_X_map.'<br>';
    echo '�� ��� ����� �������� '.(115*$Max_Y_map).' ����� � �������<br>';
    echo '����� ����� � ������� �� �������� �����: '.(115*$Max_Y_map*$Max_X_map).'<br>';
    for ($y = 1; $y <= $Max_Y_map; $y++) 
        for ($z = 1; $z <= 115; $z++){
           $terr = 0;
           if (Shans(30))
               $terr=rand(1,7);
           mysql_query('INSERT INTO `map`(`x`, `y`, `z`, `terrain`) VALUES ("'.$x.'", "'.$y.'", "'.$z.'", "'.$terr.'")')or die(mysql_error());
        }
    mysql_close($mysql_connect);
    if ($x!=$Max_X_map){
        echo '��������� ���� ����� 1 ���.';
        echo '<html><head><meta http-equiv=Refresh content="1; url=map.php?x='.($x+1).'"></head></html>';
    }else{
        API_INSTALL_ECHO_END_STEP();
    }
?>