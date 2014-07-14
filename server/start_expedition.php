<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'start_expedition') {
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = $arr_res_castle['value_room_' . $_GET['num_room']];
        if ($time_to_work == 0){
            if (empty($_GET['x2']))
                $x2=$_COOKIE['X'];
            else
                $x2=$_GET['x2'];
            if (empty($_GET['y2']))
                $y2=$_COOKIE['Y'];
            else
                $y2=$_GET['y2'];
            global $Max_X_map, $Max_Y_map, $Max_Player_Mission;
            F_Transaction();
            for ($i = 0; $i < (onlyInt($arr_res_castle['room_name_' . $_GET['num_room']])); $i++){
                if (F_GetCount_mission_of_login(($_COOKIE['login']))>=$Max_Player_Mission)
                    break;
                $rand_x2 = rand(($x2-1), ($x2+1));
                $rand_y2 = rand(($y2-1), ($y2+1));
                if ($rand_x2>$Max_X_map)
                    $rand_x2=$Max_X_map;
                if ($rand_x2<1)
                    $rand_x2=1;
                if ($rand_y2>$Max_Y_map)
                    $rand_y2=$Max_Y_map;
                if ($rand_y2<1)
                    $rand_y2=1;
                $rand_z2 = rand(1, 105);
                $dlina   = Function_gettime_for_databaze($_COOKIE['X'], $_COOKIE['Y'], $_COOKIE['Z'], $rand_x2, $rand_y2, $rand_z2);
                $dlina   = decPrz($dlina, onlyInt($arr_res_castle['room_name_' . $_GET['num_room']]));
                mysql_query('INSERT INTO `missions`(`ist_x`, `ist_y`, `ist_z`, `vladelez`, `k_x`, `k_y`, `k_z`, `dlina`, `time_finish`, `type`, `napravlen`) VALUES ("' . $_COOKIE['X'] . '","' . $_COOKIE['Y'] . '","' . $_COOKIE['Z'] . '", "' . $_COOKIE['login'] . '",  "' . $rand_x2 . '","' . $rand_y2 . '","' . $rand_z2 . '","' . $dlina . '","' . $dlina . '","expedition","0")');
            }
            mysql_query('UPDATE `castle` SET `value_room_' . $_GET['num_room'] . '` = "' . ($dlina * 2) . '" WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
            echo int_to_time($dlina * 2);
        }else
            echo int_to_time($time_to_work);
    }
    FClose_mysql_connect($mysql_connect);
?>