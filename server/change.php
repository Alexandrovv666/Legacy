<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    if ($_GET['action'] == 'change') {
        $mysql_connect = F_Connect_MySQL();
        global $C_Numberic, $C_Text_noSpace;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            $log_access .= 'get параметр "num_room" не прошёл валидацию.' . PHP_EOL;
            loging($log_access);
            exit;
        } //!Chek_string_of_mask($_GET['num_room'], $C_Numberic)
        if (!Chek_string_of_mask($_GET['men'], ($C_Numberic . '-'))) {
            $log_access .= 'get параметр "men" не прошёл валидацию.' . PHP_EOL;
            loging($log_access);
            exit;
        } //!Chek_string_of_mask($_GET['men'], ($C_Numberic . '-'))
        F_session_extension();
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_COOKIE['casZ'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_room      = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
        $arr_res_room   = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room) . '"'));
        $Time_Work_all  = $arr_res_room['default_time'];
        $men_to_room    = $arr_res_room['men'];
        $real_men       = $arr_res_castle['c_' . ($_GET['num_room']) . '_2'];
        $before_time    = $arr_res_castle['c_' . ($_GET['num_room']) . '_1'];
        $add_men        = $_GET['men'];
        $new_men        = $real_men + $add_men;
        if ($real_men != 0) {
            if ($new_men != 0) {
                $k    = ($add_men + $real_men) / $real_men;
                $time = floor($before_time / $k);
            } //$new_men != 0
            else {
                $time      = $before_time * (-1);
                $prz_after = -($Time_Work_all / $before_time);
            }
        } //$real_men != 0
        else {
            $time_after = floor($arr_res_castle['c_' . ($_GET['num_room']) . '_4'] * $Time_Work_all);
            $time       = floor(($Time_Work_all - $time_after) * ($men_to_room / $new_men)) * (-1);
        }
        F_Transaction();
        mysql_query('UPDATE `game`.`castle` SET `c_' . ($_GET['num_room']) . '_4`="' . $prz_after . '", `c_' . $_GET['num_room'] . '_1` = "' . ($time) . '", `c_' . $_GET['num_room'] . '_2` = "' . ($real_men + $_GET['men']) . '",  `men`=`men`-' . ($add_men) . ' WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['casX'] . '" and `y`="' . $_COOKIE['casY'] . '" and `z`="' . $_COOKIE['casZ'] . '"');
        echo 'ok';
        mysql_close($mysql_connect);
    } //$_GET['action'] == 'change'
?>