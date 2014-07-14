<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'newroom') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_alt_room  = $arr_res_castle['room_name_' . $_GET['num_room']];
        $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $_GET['namenewroomroom'] . '" and `alt_room`="' . $name_alt_room . '" LIMIT 1');
        $res_alt_room   = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $name_alt_room . '" LIMIT 1');
        if (mysql_num_rows($res_new_room) != 1) {
            ShowMessage_and_exit('Не удалось начать строительство из-за внутренней ошибки.');
        } else {
            $arr_results_new_room = mysql_fetch_array($res_new_room);
            $arr_results_alt_room = mysql_fetch_array($res_alt_room);
            $name_room            = $arr_results_new_room['new_room'];
            if (($arr_res_castle['gold'] >= $arr_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_new_room['tree'])) {
                $time_towork = F_time_towork($_GET['namenewroomroom']);
                F_Transaction();
                if ($name_alt_room != "")
                    mysql_query('UPDATE `game`.`castle` SET `room_name_' . $_GET['num_room'] . '` = "' . $arr_results_new_room['new_room'] . '",  `value_room_' . $_GET['num_room'] . '` = "-' . $time_towork . '", `gold` = `gold`-' . $arr_results_new_room['gold'] . ', `tree` = `tree`-' . $arr_results_new_room['tree'] . ', `stone` = `stone`-' . $arr_results_new_room['stone'] . ', `agold` = `agold`+' . $arr_results_new_room['agold'] . '-' . $arr_results_alt_room['agold'] . ', `atree` = `atree`+' . $arr_results_new_room['atree'] . '-' . $arr_results_alt_room['atree'] . ', `astone` = `astone`+' . $arr_results_new_room['astone'] . '-' . $arr_results_alt_room['astone'] . ' WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                else
                    mysql_query('UPDATE `game`.`castle` SET `room_name_' . $_GET['num_room'] . '` = "' . $arr_results_new_room['new_room'] . '",  `value_room_' . $_GET['num_room'] . '` = "-' . $time_towork . '", `gold` = `gold`-' . $arr_results_new_room['gold'] . ', `tree` = `tree`-' . $arr_results_new_room['tree'] . ', `stone` = `stone`-' . $arr_results_new_room['stone'] . ', `agold` = `agold`+' . $arr_results_new_room['agold'] . ', `atree` = `atree`+' . $arr_results_new_room['atree'] . ', `astone` = `astone`+' . $arr_results_new_room['astone'] . ' WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                echo '<div class="castle-room-'.onlyNoInt($arr_results_new_room['new_room']).'"></div>
                      <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                      <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
            }
        }
    }
    FClose_mysql_connect($mysql_connect);
?>