<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'delete_room') {
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = abs($arr_res_castle['value_room_' . $_GET['num_room']]);
        if ($time_to_work == 0) {
            $name_alt_room = $arr_res_castle['room_name_' . $_GET['num_room']];
            $res_alt_haus  = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $name_alt_room . '"');
            if (mysql_num_rows($res_alt_haus) != 1)
                ShowMessage_and_exit('Не удалось идентифицировать здание для сноса.');
            $arr_res_alt_haus = mysql_fetch_array($res_alt_haus);
            F_Transaction();
            mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = "'.floor(F_time_towork($name_alt_room)/2).'", `room_name_' . $_GET['num_room'] . '`="", `agold`=`agold`-' . $arr_res_alt_haus['agold'] . ', `atree`=`atree`-' . $arr_res_alt_haus['atree'] . ', `astone`=`astone`-' . $arr_res_alt_haus['astone'] . ' WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '" ');
            echo '<p class="level-room"></p><p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time(floor(F_time_towork($name_alt_room)/2)) . '</p>';
        }
    }
    FClose_mysql_connect($mysql_connect);
?>