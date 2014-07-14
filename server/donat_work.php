<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'donat_work') {
        $arr_res_castle = mysql_fetch_array($res_castle);
        $res_user       = mysql_query('SELECT * FROM `users` WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_user   = mysql_fetch_array($res_user);
        $time_to_work   = $arr_res_castle['value_room_' . $_GET['num_room']];
        if ($time_to_work < 0) {
            global $Cost_work_money_speed;
            if ($arr_res_user['almaz'] >= $Cost_work_money_speed) {
                mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = 0 WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                mysql_query('UPDATE `game`.`users` SET `almaz` = `almaz`-' . $Cost_work_money_speed . ' WHERE `users`.`id` = "' . F_Get_ID($_COOKIE['login']) . '"');
                echo int_to_time(1);
            }else{
                echo int_to_time(-$time_to_work);
            }
        }
    }
    FClose_mysql_connect($mysql_connect);
?>