<?php
    include 'API.php';
    include 'Constant.php';
    if ($Disable_login){
         echo 'warining|'.$Disable_login_message;
         exit;
    }
    $linkss                 = FConnBase();
    $login                  = $_GET['login'];
    $password               = $_GET['password'];
    global $C_Text_noSpace, $C_Numberic;
    if (!Chek_string_of_mask($login,($C_Numberic.$C_Text_noSpace))){
        echo 'warining|Логин некорректен';
        exit;
    }
    if (!Chek_string_of_mask($password,($C_Numberic.$C_Text_noSpace))){
        echo 'warining|Пароль некорректен';
        exit;
    }
    global $BanList;
    if ($EnableBanList)
        if (in_array((strtolower($login)), $BanList)){
            echo 'warining|Вам нельзя авторизовываться.';
            exit;
        }
    $sol_of_login      = 'teamlead';
    $sol_of_password_1 = 'Game';
    $sol_of_password_2 = 'LegacyOfWarriors';
    $md5_of_login_user = md5 ( $login.$sol_of_login );
    $hach_of_password = crypt($login, $sol_of_login).crypt($password, $sol_of_login).crypt($login, $md5_of_login_user).crypt($password, $md5_of_login_user).crypt($login, $sol_of_password_1).crypt($password, $sol_of_password_1).crypt($login, $sol_of_password_2).crypt($password, $sol_of_password_2).crypt($login, $md5_of_login_user).crypt($password, $md5_of_login_user).crypt($login, $password);
    $table_list = mysql_query('SELECT login FROM `users` WHERE `password`="'.$hach_of_password.'"');
    while ($row = mysql_fetch_row($table_list))
        if (strtolower($login)==strtolower($row['0'])){
            $chars    = $C_Numberic.$C_Text_noSpace;
            $numChars = strlen($chars);
            $session = '';
            for ($i = 0; $i < 40; $i++)
                $session .= substr($chars, rand(1, $numChars) - 1, 1);
            if (mysql_table_seek("session","game")){
                if (mysql_num_rows(mysql_query('SELECT * FROM  `session` WHERE `login`="'.$_GET['login'].'"'))==1){
                    mysql_query('UPDATE `session` SET `time`="'.time().'", `status`="1",`ip`="'.$_SERVER['REMOTE_ADDR'].'",`session`="'.$session.'" WHERE `login`="'.$_GET['login'].'"');
                }else{
                    mysql_query('INSERT INTO `session`(`time`, `login`, `status`, `ip`, `session`) VALUES ("'.time().'","'.$_GET['login'].'","1","'.$_SERVER['REMOTE_ADDR'].'","'.$session.'")');
                }
            }else{
                mysql_query('CREATE TABLE IF NOT EXISTS `session` ( `time` int(11) NOT NULL, `login` text NOT NULL, `status` int(11) NOT NULL, `ip` text NOT NULL, `session` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
                mysql_query('INSERT INTO `session`(`time`, `login`, `status`, `ip`, `session`) VALUES ("'.time().'","'.$_GET['login'].'","1","'.$_SERVER['REMOTE_ADDR'].'","'.$session.'")');
            }
            echo '<script language = \'javascript\'> var delay = 100; setTimeout("document.location.href=\'SetCookie.php?login='.$login.'\'", delay); </script>';
            exit;
        }
    echo 'warining|Комбинация логин-пароль не найдены.';
?>
