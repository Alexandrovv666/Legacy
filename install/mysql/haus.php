<?php
/*
 * Скрипт заполнения таблицы комнат
 * для добавления нового типа комнаты необходимо создать дополнительный блок согласно шаблону ниже
 *   for ($i = 1; $i <= $Max_level_HAUS; $i++) {
 *       $V_new           = 'lavka' . $i;                                 - служеюное название в апострофах
 *       $V_gold          =                                               - требуемое количества золота для постройки
 *       $V_tree          =                                               - требуемое количество древесины для постройки
 *       $V_stone         =                                               - требуемое количество камня для постройки
 *       $V_men           =                                               - требуемое количество людей для строительства
 *       $V_max_men       = floor(incprz($V_men, $Percent_kritical_men)); - максимальное количество людей на стройке\улучшении
 *       $V_max_sklad_men =                                               - на сколько увеличится показатель максимального количества населения
 *       $V_agold         =                                               - на сколько увеличится приток золота
 *       $V_atree         =                                               - на сколько увеличится приток древисины
 *       $V_astone        =                                               - на сколько увеличится приток камня
 *       $V_asklad        =                                               - на сколько увеличится вместимость ресурсов
 *       $V_amen          =                                               - на сколько увеличится рождаемость
 *       $V_default_time  =                                               - время строительства
 *       mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
 *   }
*/
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/gameserver.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/math.php';
    $mysql_connect = F_Connect_MySQL();
    echo 'Step 2. Create MySQL lines for haus in table.<br>';
    global $Max_level_HAUS;
    $V_ID = 1;
    $Percent_kritical_men = 30;
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lavka' . $i;
        $V_gold          = 0;
        $V_tree          = $i * 20;
        $V_stone         = $i * 10;
        $V_men           = $i * $i * 8;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = $i * 20;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 41;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lesop' . $i;
        $V_gold          =  $i * 100;
        $V_tree          = 0;
        $V_stone         = $i * 9;
        $V_men           = $i * $i * 12;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = $i * 5;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'kamen' . $i;
        $V_gold          = $i * 200;
        $V_tree          = $i * 20;
        $V_stone         = 0;
        $V_men           = $i * $i * 13;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = $i * 1;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 80;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'haus' . $i;
        $V_gold          = $i * $i * 700;
        $V_tree          = $i * $i * 100;
        $V_stone         = $i * $i * 60;
        $V_men           = $i * $i * 38;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = $i * $i * 300;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = $i * 5;
        $V_default_time  = $i * $i * 115;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'sklad' . $i;
        $V_gold          = $i * $i * $i * 2000;
        $V_tree          = $i * $i * $i * 600;
        $V_stone         = $i * $i * $i * 150;
        $V_men           = $i * $i * $i * $i * 120;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = $i * 5000;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 45;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'market' . $i;
        $V_gold          = $i * $i * $i * 1000;
        $V_tree          = $i * $i * $i * 2100;
        $V_stone         = $i * $i * $i * 800;
        $V_men           = $i * $i * 1200;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 1;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'treasury' . $i;
        $V_gold          = $i * $i * $i * 300000;
        $V_tree          = $i * $i * $i * 90000;
        $V_stone         = $i * $i * $i * 50000;
        $V_men           = $i * $i * 3000;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 9;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
/*
 * тексты для каждой комнаты.
*/
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
                ("market","Комната менялы","Тут можно заключать сделки с другими игроками посредством рынка и менять ресурсы.")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("treasury","Сокровещница","Хранит магические предметы")');
    echo 'Step 2 is finish.<br>';
    echo 'Wait 3 second for start step 3.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=army.php"></head></html>';
?>