<?php
    $login    = $_POST['login'];
    $password = $_POST['password'];
    include 'API.php';
    include 'Constant.php';
    global $Max_X_map, $Max_Y_map, $C_Text_noSpace, $C_Numberic;
    if (!Chek_string_of_mask($login,($C_Numberic.$C_Text_noSpace))){
        echo 'Логин некорректен';
        exit;
    }
    if (!Chek_string_of_mask($password,($C_Numberic.$C_Text_noSpace))){
        echo 'Логин некорректен';
        exit;
    }
    $linkss = FConnBase();
    if (F_login_is_now($login)) echo 'Логин занят';
    $wariants = 0;
    // Ищем свободное место для игрока
    do {
        $wariants          = $wariants + 1;
        $x                 = rand(1, $Max_X_map);
        $y                 = rand(1, $Max_Y_map);
        $z                 = rand(1, 105);
        $count_res_terrain = mysql_num_rows(mysql_query('SELECT z FROM `map` WHERE `x` =' . $x . ' AND `y` =' . $y . ' AND `z` =' . $z . ' AND `terrain`!=0'));
        $count_res_castle  = mysql_num_rows(mysql_query('SELECT z FROM `castle` WHERE `x` =' . $x . ' AND `y` =' . $y . ' AND `z` ="' . $z.'"'));
        $count_res_lager   = mysql_num_rows(mysql_query('SELECT z FROM `lager` WHERE `x` =' . $x . ' AND `y` =' . $y . ' AND `z` ="' . $z.'"'));
        if (($count_res_lager == 0) and ($count_res_castle == 0) and ($count_res_terrain == 1))
            goto metka1;
        if ($wariants > 2000)
            goto metka1;
    } while (true);
metka1:
    if ($wariants > 2000) {
        echo '<H1><center>Системе не удалось найти место для игрока</center><H1><br><H2><center>Свяжитесь с администратором и сообщите ему об этом</center><H2><br>';
        exit;
    }
    $sol_of_login      = 'teamlead';
    $sol_of_password_1 = 'Game';
    $sol_of_password_2 = 'LegacyOfWarriors';
    $md5_of_login_user = md5 ( $login.$sol_of_login );
    $hach_of_password = crypt($login, $sol_of_login).crypt($password, $sol_of_login).crypt($login, $md5_of_login_user).crypt($password, $md5_of_login_user).crypt($login, $sol_of_password_1).crypt($password, $sol_of_password_1).crypt($login, $sol_of_password_2).crypt($password, $sol_of_password_2).crypt($login, $md5_of_login_user).crypt($password, $md5_of_login_user).crypt($login, $password);
    mysql_query('INSERT INTO `users`(`login`, `password`, `almaz`, `reg_time`) VALUES ("' . $login . '","' . $hach_of_password . '", "10", "' . time() . '")');
    mysql_query('ALTER TABLE `see_lager` ADD `' . $login . '` INT NOT NULL');
    mysql_query('INSERT INTO `castle`(`id`, `x`, `y`, `z`, `name`, `gold`, `tree`, `stone`, `agold`, `atree`, `astone`) VALUES ("'.F_Get_ID($login).'" , ' . $x . ',' . $y . ',' . $z . ',"Безымянный замок",2000,1000,50,1,1,1)');
    mysql_query('INSERT INTO `privilege`(`ID`, `value`) VALUES ("'.F_Get_ID($login).'","player")');
    $get_random_kast=mysql_query('SELECT `time_min`, `time_max` FROM `kast_help` WHERE `ID`="0"');
    $array_get_random_kast=mysql_fetch_array($get_random_kast);
    $lang_kast=rand($array_get_random_kast['time_min'], $array_get_random_kast['time_max']);
    mysql_query('INSERT INTO `kast`(`id_ziel`, `id_kast`, `time_start`, `time_end`) VALUES ("' . F_Get_ID($login) . '", "' . $id_kast . '", "' . time() . '", "' . (time()+$lang_kast) . '")');
    echo '<html><head><meta http-equiv=Refresh content="0; url=index.php"></head></html>';
?>

