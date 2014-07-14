<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'atack_mission_grab') {
        $id_of_log = rand();
        loging(' >> Start log. id=' . ($id_of_log));
        loging(' >> ' . $id_of_log . ' >> Игрок [' . $_COOKIE['login'] . '] Инициировал атаку из [' . $_GET['x1'] . '-' . $_GET['y1'] . '-' . $_GET['z1'] . '] в [' . $_GET['x2'] . '-' . $_GET['y2'] . '-' . $_GET['z2'] . ']');
        loging(' >> ' . $id_of_log . ' >> Армия: ' . $_GET['a1'] . '-' . $_GET['a2'] . '-' . $_GET['a3'] . '-' . $_GET['a4'] . '-' . $_GET['a5'] . '-' . $_GET['a6'] . '-' . $_GET['a7'] . '-' . $_GET['a8']);
        for ($i = 1; $i <= 8; $i++)
            $all_summ_arm = $all_summ_arm + $_GET['a' . $i];
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `gold`>"'.$all_summ_arm.'" and `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '" and `army_1`>="' . $_GET['a1'] . '" and `army_2`>="' . $_GET['a2'] . '" and `army_3`>="' . $_GET['a3'] . '" and `army_4`>="' . $_GET['a4'] . '" and `army_5`>="' . $_GET['a5'] . '" and `army_6`>="' . $_GET['a6'] . '" and `army_7`>="' . $_GET['a7'] . '" and `army_8`>="' . $_GET['a8'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            exit;
        else {
            $all_summ_arm = 0;
            $dlina = Function_gettime_for_databaze($_GET['x1'], $_GET['y1'], $_GET['z1'], $_GET['x2'], $_GET['y2'], $_GET['z2']);
            $Ares_castle = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '" '));
            F_Transaction();
            loging(' >> ' . $id_of_log . ' >> Армия до: ' . $Ares_castle['army_1'] . '-' . $Ares_castle['army_2'] . '-' . $Ares_castle['army_3'] . '-' . $Ares_castle['army_4'] . '-' . $Ares_castle['army_5'] . '-' . $Ares_castle['army_6'] . '-' . $Ares_castle['army_7'] . '-' . $Ares_castle['army_8']);
            mysql_query('UPDATE `Castle` SET `gold`=`gold`-"' . $all_summ_arm . '", `army_1`=`army_1`-"' . $_GET['a1'] . '",`army_2`=`army_2`-"' . $_GET['a2'] . '",`army_3`=`army_3`-"' . $_GET['a3'] . '",`army_4`=`army_4`-"' . $_GET['a4'] . '",`army_5`=`army_5`-"' . $_GET['a5'] . '",`army_6`=`army_6`-"' . $_GET['a6'] . '",`army_7`=`army_7`-"' . $_GET['a7'] . '",`army_8`=`army_8`-"' . $_GET['a8'] . '" WHERE `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '"');
            mysql_query('INSERT INTO `missions`(`ist_x`, `ist_y`, `ist_z`, `id`, `k_x`, `k_y`, `k_z`,`dlina`, `time_finish`, `type`,`army_1`, `army_2`, `army_3`, `army_4`, `army_5`, `army_6`, `army_7`, `army_8`, `napravlen`, `vladelez`) VALUES ("' . $_GET['x1'] . '","' . $_GET['y1'] . '","' . $_GET['z1'] . '","' . $_COOKIE['login'] . '","' . $_GET['x2'] . '","' . $_GET['y2'] . '","' . $_GET['z2'] . '","' . $dlina . '","' . $dlina . '","atack_grab","' . $_GET['a1'] . '","' . $_GET['a2'] . '","' . $_GET['a3'] . '","' . $_GET['a4'] . '","' . $_GET['a5'] . '","' . $_GET['a6'] . '","' . $_GET['a7'] . '","' . $_GET['a8'] . '","0", "'.$_COOKIE['login'].'")');
            loging(' >> ' . $id_of_log . ' >> Армии хватило. Миссия отправлена. Длительность: '.$dlina.' сек.');
            $Ares_castle = mysql_fetch_array(mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '" '));
            loging(' >> ' . $id_of_log . ' >> Армия после: ' . $Ares_castle['army_1'] . '-' . $Ares_castle['army_2'] . '-' . $Ares_castle['army_3'] . '-' . $Ares_castle['army_4'] . '-' . $Ares_castle['army_5'] . '-' . $Ares_castle['army_6'] . '-' . $Ares_castle['army_7'] . '-' . $Ares_castle['army_8']);
        }
        loging(' >> ' . $id_of_log . ' >> Конец лога.');
    }
    FClose_mysql_connect($mysql_connect);
?>