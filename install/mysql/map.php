<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
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
           if (Shans(10))
               $terr=rand(1,7);
           mysql_query('INSERT INTO `map`(`x`, `y`, `z`, `terrain`) VALUES ("'.$x.'", "'.$y.'", "'.$z.'", "'.$terr.'")')or die(mysql_error());
        }
    mysql_close($mysql_connect);
    if ($x!=$Max_X_map){
        echo '��������� ���� ����� 2 ���.';
        echo '<html><head><meta http-equiv=Refresh content="2; url=map.php?x='.($x+1).'"></head></html>';
    }else{
        echo '<html><head><meta http-equiv=Refresh content="7; url=haus.php"></head></html>';
    }
?>