<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'boy_auto_issled2') {
        $res_users     = mysql_query('SELECT almaz FROM `users` WHERE `login` = "' . $_COOKIE['login'] . '"');
        $arr_res_users = mysql_fetch_array($res_users);
        if ($arr_res_users['almaz'] >= 90) {
            mysql_query('UPDATE `users` SET `almaz` = `almaz`-90 WHERE `login` = "' . $_COOKIE['login'] . '"');
            mysql_query('UPDATE `auto_issled` SET `count` = `count`+100 WHERE `login` = "' . $_COOKIE['login'] . '"');
            echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
        } else
            ShowMessage_and_exit('Не удалось приобрести услуга т.к. недостаточно алмазов.');
    }
    FClose_mysql_connect($mysql_connect);
?>