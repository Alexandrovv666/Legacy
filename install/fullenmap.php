<?php
    include '../API.php';
    include '../Constant.php';
    Only_Local_IP();
    $linkss = FConnBase();
    global $Max_X_map, $Max_Y_map;
    echo '=> Установка. Этап 4: Заполнение карты. ';
    if ($_GET['x']!='')
        echo $_GET['x'].'/'.$Max_X_map;
    echo '<br>';
    if ($_GET['x']!='')
        if ($_GET['x']>0)
            for ($y = 1; $y <= $Max_Y_map; $y++)
                for ($z = 1; $z <= 105; $z++){
                    $terr = rand(0,7);
                    mysql_query('INSERT INTO `map`(`x`, `y`, `z`, `terrain`) VALUES ("'.$_GET['x'].'","'.$y.'","'.$z.'","'.$terr.'")');
                }
    FClose_mysql_connect($linkss);
    if ($_GET['x']=='')
        echo '<html><head><meta http-equiv=Refresh content="1; url=fullenmap.php?x=0"></head></html>';
    else
        if ($_GET['x']!=$Max_X_map)
            echo '<html><head><meta http-equiv=Refresh content="0; url=fullenmap.php?x='.($_GET['x']+1).'"></head></html>';
    echo '=> Этап 4: Завершено.<br>';
    echo '=> Продолжение установки через 1 сек.<br>';
    if ($_GET['x']==$Max_X_map)
        echo '<html><head><meta http-equiv=Refresh content="1; url=StartServer.php"></head></html>';
?> 
