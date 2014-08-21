<?php
    include $_SERVER['DOCUMENT_ROOT'].'/API.php';
    include $_SERVER['DOCUMENT_ROOT'].'/Constant.php';
    if ($_GET['action'] == 'newroom') {
        $mysql_connect = FConnBase();
        global $C_Numberic, $C_Text_noSpace;
        if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
            loging('Кука login не прошла валидацию.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['namenewroomroom'], $C_Text_noSpace . $C_Numberic)) {
            loging('get параметр namenewroomroom не прошёл валидацию.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['X'], $C_Numberic)) {
            loging('Кука X не прошла валидацию.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Y'], $C_Numberic)) {
            loging('Кука Y не прошла валидацию');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Z'], $C_Numberic)) {
            loging('Кука Z не прошла валидацию');
            exit;
        }
        if (!F_IF_session()) {
            loging('Сессия игрока неактивна.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            loging('get параметр num_room не прошёл валидацию.');
            exit;
        }
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `new`="' . $_GET['namenewroomroom'] . '" LIMIT 1');
        if (mysql_num_rows($res_new_room) != 1) {
            loging('невозможно извлечь из базы здание "'.$_GET['namenewroomroom'].'" для постройки');
            exit;
        }
        $arr_res_new_room = mysql_fetch_array($res_new_room);
        if (($arr_res_castle['gold'] >= $arr_res_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_res_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_res_new_room['tree'])) {
            F_Transaction();
            mysql_query('UPDATE `game`.`castle` SET `c_' . $_GET['num_room'] . '_n` = "' . $arr_res_new_room['new'] . '",  `c_' . $_GET['num_room'] . '_1` = "-' . $arr_res_new_room['default_time'] . '", `c_' . $_GET['num_room'] . '_3` = "' . $arr_res_new_room['id'] . '", `gold` = `gold`-' . $arr_res_new_room['gold'] . ', `tree` = `tree`-' . $arr_res_new_room['tree'] . ', `stone` = `stone`-' . $arr_res_new_room['stone'] . ' WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
            echo '<div class="castle-room-'.onlyNoInt($arr_res_new_room['new']).'"></div>
                  <p class="level-room">' . onlyInt($arr_res_new_room['new']) . '</p>
                  <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($arr_res_new_room['default_time']) . '</p>';
        }else{
            loging('попытка построить комнату "'.$_GET['namenewroomroom'].'" при недостатке ресурсов');
            exit;
        }
        mysql_close($mysql_connect);
    }
?>