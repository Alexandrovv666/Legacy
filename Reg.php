<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/gameserver.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    $login    = $_POST['login'];
    $password = $_POST['password'];
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
        $z                 = rand(1, 115);
        $count_res_castle  = mysql_num_rows(mysql_query('SELECT x FROM `castle` WHERE `x` ="' . $x . '" AND `y` ="' . $y . '" and `z`="'.$z.'"'));
        if ($count_res_castle == 0)
            goto metka1;
        if ($wariants > 2001)
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
    mysql_query('INSERT INTO `users`(`login`, `password`, `almaz`, `reg_time`) VALUES ("' . $login . '","' . $hach_of_password . '", "777", "' . time() . '")');
    mysql_query('INSERT INTO `castle` (`id`, `x`, `y`, `z`, `name`, `gold`, `tree`, `stone`, `men`, `max_men`, `maxres`) VALUES ("'.F_Get_ID($login).'" , ' . $x . ',' . $y . ',' . $z . ',"Безымянный замок",2000,1000,600,50,400,5000)');
    mysql_query('INSERT INTO `privelege`(`id_user`) VALUES ("'.F_Get_ID($login).'")');
    echo 'Персонаж зарегистрирован<html><head><meta http-equiv=Refresh content="4; url=index.php"></head></html>';
?>

