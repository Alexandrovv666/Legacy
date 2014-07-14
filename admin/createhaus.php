<?php
    include '../API.php';
    Only_Local_IP();
    echo '=> Установка. Этап 2: Заполнение таблицы зданий.<br>';
    $mysql_connect  = FConnBase();
    $Max_level_HAUS = 700;
    //*************************
    $Max_level_HAUS = $Max_level_HAUS - 1;
    mysql_query('TRUNCATE `haus`');
    $DELTA   = 0;
    $DELTA_X = $Max_level_HAUS + 2;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`tree`, `stone`, `agold`) VALUES ("' . $i . '","","lavka' . ($i + 1) . '","Комната торговца","В этой комнате проживает торговец. Тут он осуществляет свои сделки.", "'.(($i+1)*($i+1)*($i+1)*6).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*30).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`tree`, `stone`, `agold`) VALUES ("' . $i . '","lavka' . ($i) . '","lavka' . ($i + 1) . '","Комната торговца","В этой комнате проживает торговец. Тут он осуществляет свои сделки.", "'.(($i+1)*($i+1)*($i+1)*6).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*30).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `stone`, `atree`) VALUES ("' . ($i + $DELTA) . '","","lesop' . ($i + 1) . '","Комната мастера по дереву","В этой комнате проживает мастер по дереву.","'.(($i+1)*($i+1)*($i+1)*60).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*3).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `stone`, `atree`) VALUES ("' . ($i + $DELTA) . '","lesop' . ($i) . '","lesop' . ($i + 1) . '","Комната мастера по дереву","В этой комнате проживает мастер по дереву.","'.(($i+1)*($i+1)*($i+1)*60).'","'.(($i+1)*($i+1)*($i+1)*5).'","'.(($i+1)*($i+1)*3).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `astone`) VALUES ("' . ($i + $DELTA) . '","","kamen' . ($i + 1) . '","Комната мастера по камню","В этой комнате проживает мастер по камню.","'.(($i+1)*($i+1)*($i+1)*10).'","'.(($i+1)*($i+1)*($i+1)*20).'","'.(($i+1)*($i+1)*1).'")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `astone`) VALUES ("' . ($i + $DELTA) . '","kamen' . ($i) . '","kamen' . ($i + 1) . '","Комната мастера по камню","В этой комнате проживает мастер по камню.","'.(($i+1)*($i+1)*($i+1)*10).'","'.(($i+1)*($i+1)*($i+1)*20).'","'.(($i+1)*($i+1)*1).'")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","","issled' . ($i + 1) . '","Комната исследователя","Исследователь способен находить на глобальной карте владения, такие как шахты, пещеры, лагеря разбойников.","100","70","50")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","issled' . ($i) . '","issled' . ($i + 1) . '","Комната исследователя","Исследователь способен находить на глобальной карте владения, такие как шахты, пещеры, лагеря разбойников.","' . (100 * 3 * ($i + 1)) . '","' . (70 * ($i) * 3) . '","' . ((50 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","","nos' . ($i + 1) . '","Комната щитоносцев","В этой комнате можно тренировать щитоносцев.","400","200","70")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES ("' . ($i + $DELTA) . '","nos' . ($i) . '","nos' . ($i + 1) . '","Комната щитоносцев","В этой комнате можно тренировать щитоносцев.","' . (400 * 3 * ($i + 1)) . '","' . (200 * ($i) * 3) . '","' . ((70 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","voin' . ($i + 1) . '","Комната ополченцов","В этой комнате можно тренировать ополченцов.", "600","300","200")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","voin' . ($i) . '","voin' . ($i + 1) . '","Комната ополченцов","В этой комнате можно тренировать ополченцов.", "' . (600 * 3 * ($i + 1)) . '","' . (300 * ($i) * 3) . '","' . ((200 + $i * 2) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","kon' . ($i + 1) . '","Комната конников","В этой комнате можно тренировать конников.", "1000","500","250")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","kon' . ($i) . '","kon' . ($i + 1) . '","Комната конников","В этой комнате можно тренировать конников.", "' . (1000 * 3 * ($i + 1)) . '","' . (500 * ($i) * 3) . '","' . ((250 + $i * 3) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","tank' . ($i + 1) . '","Комната танков","В этой комнате можно тренировать сильнобронированных солдат.", "2000","1200","900")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","tank' . ($i) . '","tank' . ($i + 1) . '","Комната танков","В этой комнате можно тренировать сильнобронированных солдат.", "' . (2000 * 3 * ($i + 1)) . '","' . (1200 * ($i) * 3) . '","' . ((900 + $i) * ($i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","bival' . ($i + 1) . '","Комната бывалых","В этой комнате можно тренировать опытных бойцов.", "2500","2000","1300")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","bival' . ($i) . '","bival' . ($i + 1) . '","Комната бывалых","В этой комнате можно тренировать опытных бойцов.", "' . (2500 * 3 * ($i + 1)) . '","' . (2000 * ($i) * 3) . '","' . ((1300 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","luk' . ($i + 1) . '","Комната стрелков","В этой комнате можно тренировать стрелков.", "2500","2000","1300")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","luk' . ($i) . '","luk' . ($i + 1) . '","Комната стрелков","В этой комнате можно тренировать стрелков.", "' . (2500 * 3 * ($i + 1)) . '","' . (2000 * ($i) * 3) . '","' . ((1300 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","lekar' . ($i + 1) . '","Комната целителей","В этой комнате можно тренировать целителей.", "5000","3200","6000")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","lekar' . ($i) . '","lekar' . ($i + 1) . '","Комната целителей","В этой комнате можно тренировать целителей.", "' . (5000 * 3 * ($i + 1)) . '","' . (3200 * ($i) * 3) . '","' . ((6000 + $i) * (5 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    for ($i = 0; $i <= $Max_level_HAUS; $i++)
        if ($i == 0)
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","","naim' . ($i + 1) . '","Комната сорвиголов","В этой комнате можно тренировать сорвиголов.", "7000","1000","2000")');
        else
            mysql_query('INSERT INTO `haus`(`number`, `alt_room`, `new_room`, `name`, `opisanie`,`gold`, `tree`, `stone`) VALUES  ("' . ($i + $DELTA) . '","naim' . ($i) . '","naim' . ($i + 1) . '","Комната сорвиголов","В этой комнате можно тренировать сорвиголов.", "' . (7000 * 3 * ($i + 1)) . '","' . (1000 * ($i) * 3) . '","' . ((2000 + $i) * (2 * $i + 1)) . '")');
    $DELTA = $DELTA + $DELTA_X;
    echo '=> Этап 2: Завершено.<br>';
    echo '=> Продолжение установки через 1 сек.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=createarmy.php"></head></html>';
?> 
