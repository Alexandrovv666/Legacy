<?php
/*
 * ������ ���������� ������� ������
 * ��� ���������� ������ ���� ������� ���������� ������� �������������� ���� �������� ������� ����
 *   for ($i = 1; $i <= $Max_level_HAUS; $i++) {
 *       $V_new           = 'lavka' . $i;                                 - ��������� �������� � ����������
 *       $V_gold          =                                               - ��������� ���������� ������ ��� ���������
 *       $V_tree          =                                               - ��������� ���������� ��������� ��� ���������
 *       $V_stone         =                                               - ��������� ���������� ����� ��� ���������
 *       $V_men           =                                               - ��������� ���������� ����� ��� �������������
 *       $V_max_men       = floor(incprz($V_men, $Percent_kritical_men)); - ������������ ���������� ����� �� �������\���������
 *       $V_max_sklad_men =                                               - �� ������� ���������� ���������� ������������� ���������� ���������
 *       $V_agold         =                                               - �� ������� ���������� ������ ������
 *       $V_atree         =                                               - �� ������� ���������� ������ ���������
 *       $V_astone        =                                               - �� ������� ���������� ������ �����
 *       $V_asklad        =                                               - �� ������� ���������� ����������� ��������
 *       $V_amen          =                                               - �� ������� ���������� �����������
 *       $V_default_time  =                                               - ����� �������������
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
    $Percent_kritical_men = 40;
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lavka' . $i;
        $V_gold          = 0;
        $V_tree          = $i * 10;
        $V_stone         = $i * 3;
        $V_men           = $i * $i * 6;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = $i * 20;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 1;//1
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lesop' . $i;
        $V_gold          =  $i * 20;
        $V_tree          = 0;
        $V_stone         = $i * 2;
        $V_men           = $i * $i * 7;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = $i * 5;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 1;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'kamen' . $i;
        $V_gold          = $i * 50;
        $V_tree          = $i * 15;
        $V_stone         = 0;
        $V_men           = $i * $i * 11;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = $i * 1;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 1;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'haus' . $i;
        $V_gold          = $i * $i * 200;
        $V_tree          = $i * $i * 130;
        $V_stone         = $i * $i * 60;
        $V_men           = $i * $i * 40;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = $i * $i * 100;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = $i * 5;
        $V_default_time  = $i * $i * 60 * 2;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'sklad' . $i;
        $V_gold          = $i * $i * $i * 3000;
        $V_tree          = $i * $i * $i * 2000;
        $V_stone         = $i * $i * $i * 1000;
        $V_men           = $i * $i * $i * $i * 250;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = $i * 5000;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 15;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'market' . $i;
        $V_gold          = $i * $i * $i * 1000;
        $V_tree          = $i * $i * $i * 1000;
        $V_stone         = $i * $i * $i * 1000;
        $V_men           = $i * $i * 90;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 15;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'nos' . $i;
        $V_gold          = $i * $i * 1100;
        $V_tree          = $i * $i * 700;
        $V_stone         = $i * $i * 500;
        $V_men           = $i * $i * 200;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 2;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'voin' . $i;
        $V_gold          = $i * $i * 1200;
        $V_tree          = $i * $i * 800;
        $V_stone         = $i * $i * 600;
        $V_men           = $i * $i * 300;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 3;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'kon' . $i;
        $V_gold          = $i * $i * 1300;
        $V_tree          = $i * $i * 900;
        $V_stone         = $i * $i * 700;
        $V_men           = $i * $i * 400;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 4;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'tank' . $i;
        $V_gold          = $i * $i * 1400;
        $V_tree          = $i * $i * 1000;
        $V_stone         = $i * $i * 800;
        $V_men           = $i * $i * 500;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 5;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'bival' . $i;
        $V_gold          = $i * $i * 1500;
        $V_tree          = $i * $i * 1100;
        $V_stone         = $i * $i * 900;
        $V_men           = $i * $i * 600;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 6;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'luk' . $i;
        $V_gold          = $i * $i * 1600;
        $V_tree          = $i * $i * 1200;
        $V_stone         = $i * $i * 1000;
        $V_men           = $i * $i * 700;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 7;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'lekar' . $i;
        $V_gold          = $i * $i * 3200;
        $V_tree          = $i * $i * 2400;
        $V_stone         = $i * $i * 1000;
        $V_men           = $i * $i * 1400;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 15;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'naim' . $i;
        $V_gold          = $i * $i * 1800;
        $V_tree          = $i * $i * 1400;
        $V_stone         = $i * $i * 1200;
        $V_men           = $i * $i * 900;
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
    for ($i = 1; $i <= $Max_level_HAUS; $i++) {
        $V_new           = 'treasury' . $i;
        $V_gold          = $i * $i * $i * 10000;
        $V_tree          = $i * $i * $i * 10000;
        $V_stone         = $i * $i * $i * 25000;
        $V_men           = $i * $i * 750;
        $V_max_men       = floor(incprz($V_men, $Percent_kritical_men));
        $V_max_sklad_men = 0;
        $V_agold         = 0;
        $V_atree         = 0;
        $V_astone        = 0;
        $V_asklad        = 0;
        $V_amen          = 0;
        $V_default_time  = $i * $i * 60 * 60 * 3;
        mysql_query('INSERT INTO `haus`(`id` ,`new`, `gold`, `tree`, `stone`, `men`, `max_men`, `max_sklad_men`,`agold`, `atree`, `astone`, `asklad`, `amen`, `default_time`) VALUES ("' . $V_ID++ . '", "' . $V_new . '", "' . $V_gold . '", "' . $V_tree . '", "' . $V_stone . '", "' . $V_men . '", "' . $V_max_men . '", "' . $V_max_sklad_men . '", "' . $V_agold . '", "' . $V_atree . '", "' . $V_astone . '", "' . $V_asklad . '", "' . $V_amen . '", "' . $V_default_time . '")');
    }
/*
 * ������ ��� ������ �������.
*/
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lavka","������� ��������","�������� ������ ������ � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lesop","������� �������","�������� ������ ��������� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("kamen","������� ���������","�������� ������ ����� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("haus","����� �������","�������� ������ ��������� � ��� ������������ ����������� � �����")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("sklad","��������� �������","������ ��� �������� ��������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("market","������� ������","��� ����� ��������� ������ � ������� �������� ����������� ����� � ������ �������.")');

    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("nos","������� ����������","��������� �������� ����������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("voin","������� ������","��������� �������� ������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("kon","������� ���������","��������� ����������� ���������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("tank","������� ���������","��������� ����������� ������������������� ������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("bival","������� �������� �����","��������� ����������� ������ ������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("luk","������� ������� ��� �������","��������� ����������� ��������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lekar","������� ��������","��������� ��������� � ����� �������")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("naim","������� ������","��� ����� ������ �����")');

    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("treasury","������������","������ ���������� ��������")');
    echo 'Step 2 is finish.<br>';
    echo 'Wait 3 second for start step 3.<br>';
    echo '<html><head><meta http-equiv=Refresh content="1; url=army.php"></head></html>';
?>