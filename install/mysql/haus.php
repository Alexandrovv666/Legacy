<?php
    include $_SERVER['DOCUMENT_ROOT'].'/API.php';
    $mysql_connect  = FConnBase();
    echo 'Step 2. Create MySQL lines for haus in table.<br>';
    global $Max_level_HAUS;
    //*************************
    $V_ID = 1;
    mysql_query('TRUNCATE `haus`');//На случай обновлении таблицы
    for ($i = 1; $i <= $Max_level_HAUS; $i++){
        $V_new = 'lavka'.$i;
        $V_gold = $i*8;
        $V_tree = $i*$i*10;
        $V_stone = $i*$i*4;
        $V_men = $i*$i*8;
        $V_max_men = $i*$i*15;
        $V_agold = $i*20;
        $V_atree = 0;
        $V_astone = 0;
        $V_asklad = 0;
        $V_amen = 0;
        $V_default_time = $i*$i*41;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("'.$V_ID++.'", "'.$V_new.'", "'.$V_gold.'", "'.$V_tree.'", "'.$V_stone.'", "'.$V_men.'", "'.$V_max_men.'", "'.$V_agold.'", "'.$V_atree.'", "'.$V_astone.'", "'.$V_asklad.'", "'.$V_amen.'", "'.$V_default_time.'")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++){
        $V_new = 'lesop'.$i;
        $V_gold = $i*$i*40;
        $V_tree = $i*4;
        $V_stone = $i*$i*2;
        $V_men = $i*$i*12;
        $V_max_men = $i*$i*13;
        $V_agold = 0;
        $V_atree = $i*5;
        $V_astone = 0;
        $V_asklad = 0;
        $V_amen = 0;
        $V_default_time = $i*$i*26;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("'.$V_ID++.'", "'.$V_new.'", "'.$V_gold.'", "'.$V_tree.'", "'.$V_stone.'", "'.$V_men.'", "'.$V_max_men.'", "'.$V_agold.'", "'.$V_atree.'", "'.$V_astone.'", "'.$V_asklad.'", "'.$V_amen.'", "'.$V_default_time.'")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++){
        $V_new = 'treasury'.$i;
        $V_gold = $i*$i*$i*300000;
        $V_tree = $i*$i*$i*90000;
        $V_stone = $i*$i*$i*50000;
        $V_men = $i*$i*3000;
        $V_max_men = $i*$i*3200;
        $V_agold = 0;
        $V_atree = 0;
        $V_astone = 0;
        $V_asklad = 0;
        $V_amen = 0;
        $V_default_time = $i*$i*60*60*7;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("'.$V_ID++.'", "'.$V_new.'", "'.$V_gold.'", "'.$V_tree.'", "'.$V_stone.'", "'.$V_men.'", "'.$V_max_men.'", "'.$V_agold.'", "'.$V_atree.'", "'.$V_astone.'", "'.$V_asklad.'", "'.$V_amen.'", "'.$V_default_time.'")');
    }
    echo 'Step 2 is finish.<br>';
    echo 'Wait 3 second for start step 3.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=army.php"></head></html>';
?> 
