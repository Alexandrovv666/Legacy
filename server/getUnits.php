<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'getUnits') {
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = abs($arr_res_castle['value_room_' . $_GET['num_room']]);
        if ($time_to_work == 0) {
            $name_room           = $arr_res_castle['room_name_' . $_GET['num_room']];
            $Speed_Get_Unit_time = F_time_tren($name_room);
            F_Transaction();
            mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = "' . ($Speed_Get_Unit_time) . '" WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
            echo int_to_time($Speed_Get_Unit_time);
        } else
            echo int_to_time($time_to_work);
    }
    FClose_mysql_connect($mysql_connect);
?>