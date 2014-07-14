<?php
    $mysql_connect = FConnBase();
    if (!(F_login_is_now(($_COOKIE['login'])))) {
        echo '<html><head><meta http-equiv=Refresh content="0; url=/Exit.php"></head></html>';
        exit;
    }
    F_session();
    $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
    if (mysql_num_rows($res_castle) != 1)
        ShowMessage_and_exit('упс. возникла ошибка.');
    $act = str_replace("'", '', $_GET['action']);
    $act = str_replace("/", '', $act);
    $act = str_replace("*", '', $act);
    $act = str_replace("?", '', $act);
    $act = str_replace("\"", '', $act);
    $act = str_replace("!", '', $act);
    $act = str_replace("=", '', $act);
?>