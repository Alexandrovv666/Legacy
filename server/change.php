<?php
    include '../API.php';
    include '../Constant.php';
    if ($_GET['action'] == 'change') {
        $mysql_connect = FConnBase();
        global $C_Numberic, $C_Text_noSpace;
        if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
            loging('���� login �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['X'], $C_Numberic)) {
            loging('���� X �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Y'], $C_Numberic)) {
            loging('���� Y �� ������ ���������');
            exit;
        }
        if (!Chek_string_of_mask($_COOKIE['Z'], $C_Numberic)) {
            loging('���� Z �� ������ ���������');
            exit;
        }
        if (!F_IF_session()) {
            loging('������ ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            loging('get �������� num_room �� ������ ���������.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['men'], $C_Numberic)) {
            loging('get �������� num_room �� ������ ���������.');
            exit;
        }
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_room     = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
        $arr_res_room = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room).'"'));
        $Time_Work_Def = -$arr_res_room['default_time'];
        $def_men = $arr_res_room['men'];
        $max_men = $arr_res_room['max_men'];
        $real_men = $arr_res_castle['c_' . ($_GET['num_room']) . '_2'];
        $before_time = $arr_res_castle['c_' . ($_GET['num_room']) . '_1'];
        $razn_men = $_GET['men'] - $real_men;
        if ($_GET['men']!=0){
            $k = $_GET['men']/$real_men;
            $time = floor($before_time/$k);
        }else
            $time = $before_time*(-1);
        mysql_query('UPDATE `game`.`castle` SET `c_' . $_GET['num_room'] . '_1` = "'.$time.'", `c_' . $_GET['num_room'] . '_2` = "'.$_GET['men'].'",  `men`=`men`+'.($razn_men*(-1)).' WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        FClose_mysql_connect($mysql_connect);
    }
?>