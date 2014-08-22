<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/API.php';
    $mysql_connect = FConnBase();
    echo 'Step 2. Create MySQL lines for haus in table.<br>';
    global $Max_level_HAUS;
    //*************************
    $V_ID = 1;
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lavka' . $i;
        $V_gold          = $i * 8;
        $V_tree          = $i * $i * 10;
        $V_stone         = $i * $i * 4;
        $V_men           = $i * $i * 8;
        $V_max_men       = $V_men+5;
        $V_max_sklad_men = 0;
        $V_agold         = $i * 20;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * $i * $i * $i * 41;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lesop' . $i;
        $V_gold          = $i * $i * 40;
        $V_tree          = $i * 4;
        $V_stone         = $i * $i * 2;
        $V_men           = $i * $i * 12;
        $V_max_men       = $V_men+5;
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = $i * 5;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * $i * $i * $i * 26;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'kamen' . $i;
        $V_gold          = $i * $i * 20;
        $V_tree          = $i * $i * 15;
        $V_stone         = $i * 1;
        $V_men           = $i * $i * 11;
        $V_max_men       = $V_men+5;
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = $i * 1;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * $i * $i * $i * 34;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'haus' . $i;
        $V_gold          = $i * $i * 400;
        $V_tree          = $i * $i * 100;
        $V_stone         = $i * $i * 20;
        $V_men           = $i * $i * 64;
        $V_max_men       = $V_men+5;
        $V_max_sklad_men = $i * $i * 200;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = $i * 5;
        $V_default_time  = $i * $i * $i * $i * $i * 240;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'sklad' . $i;
        $V_gold          = $i * $i * $i * 2000;
        $V_tree          = $i * $i * $i * 600;
        $V_stone         = $i * $i * $i * 150;
        $V_men           = $i * $i * $i * $i * 120;
        $V_max_men       = $i * $i * $i * $i * $i * 170;
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = $i * $i * 5000;
        $V_amen          = 0;
        $V_default_time  = $i * $i * $i * $i * $i * 900;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'treasury' . $i;
        $V_gold          = $i * $i * $i * 300000;
        $V_tree          = $i * $i * $i * 90000;
        $V_stone         = $i * $i * $i * 50000;
        $V_men           = $i * $i * 3000;
        $V_max_men       = $i * $i * 3200;
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * $i * $i * $i * 60 * 60 * 7;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lavka","Комната торговца","Повышает приток золота в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lesop","Комната лесника","Повышает приток древисины в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("kamen","Комната каменщика","Повышает приток камня в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("haus","Жилая комната","Повышает приток населения и его максимальную численность в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("sklad","Складская комната","Служит для хранения ресурсов")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("treasury","Сокровещница","Хранит магические предметы")');
    echo 'Step 2 is finish.<br>';
    echo 'Wait 3 second for start step 3.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=army.php"></head></html>';
?>