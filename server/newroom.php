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
            loging('get параметр name не прошёл валидацию: "'.$_GET['namenewroomroom'].'"');
            exit;
        }
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            loging('get параметр namenewroomroom не прошёл валидацию.');
            exit;
        }
        if (!Chek_string_of_mask($_GET['men'], $C_Numberic)) {
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
//WORK!
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `new`="' . $_GET['namenewroomroom'] . '" LIMIT 1');
        if (mysql_num_rows($res_new_room) != 1) {
            loging('невозможно извлечь из базы здание "'.$_GET['namenewroomroom'].'" для постройки');
            exit;
        }
        $arr_res_new_room = mysql_fetch_array($res_new_room);
        if (($arr_res_castle['gold'] >= $arr_res_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_res_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_res_new_room['tree'])) {
            $VMenForWork = $_GET['men'];
            if ($arr_res_castle['men']<$VMenForWork){
                loging('Свободного населения меньше, чем есть в наличии.');
                $VMenForWork=$arr_res_castle['men'];
            }
            if ($VMenForWork==0)
                $VTimeForWork = ($arr_res_new_room['default_time']*(-1));//Положительное число - бесконечная стройка
            else
                $VTimeForWork = floor($arr_res_new_room['default_time'] * ($arr_res_new_room['men']/$VMenForWork));
            F_Transaction();
            SQLQWERY_Log('UPDATE `game`.`castle` SET `c_' . $_GET['num_room'] . '_n` = "' . $arr_res_new_room['new'] . '",  `c_' . $_GET['num_room'] . '_1` = "' . ($VTimeForWork*(-1)) . '", `c_' . $_GET['num_room'] . '_2` = "' . $VMenForWork . '", `c_' . $_GET['num_room'] . '_3` = "' . $arr_res_new_room['id'] . '", `gold` = `gold`-' . $arr_res_new_room['gold'] . ', `tree` = `tree`-' . $arr_res_new_room['tree'] . ', `stone` = `stone`-' . $arr_res_new_room['stone'] . ', `men`=`men`-"'.$VMenForWork.'" WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        }else{
            loging('попытка построить комнату "'.$_GET['namenewroomroom'].'" при недостатке ресурсов');
            exit;
        }
//
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['X'] . '" AND `y`="' . $_COOKIE['Y'] . '" AND `z`="' . $_COOKIE['Z'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        echo 'ok';
        for ($i = 1; $i <= 35; $i++) {
            if ($arr_res_castle['c_'.$i.'_1']<=0){
            $time_to_work   = abs($arr_res_castle['c_'.$i.'_1']);
                if ($time_to_work != 0)
                    echo '|'.int_to_time($time_to_work);
                else
                    echo '|0:0:0:0';
            }
            if ($arr_res_castle['c_'.$i.'_1']>0)
                echo '|--:--:--:--';
        }
        $Global_array_res_Junits_param = array();
        $res_Junits_param              = mysql_query('SELECT * FROM `army_baze`');
        while ($Global_array_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {}
        $Global_array_kast[]           = array();
        $res_all_kast            = mysql_query('SELECT * FROM `kast` where `id_ziel`="' . F_Get_ID($_COOKIE['login']) . '"');
        while ($Global_array_kast[] = mysql_fetch_array($res_all_kast)); {}
        $count_kast = count($Global_array_kast) - 1;
        $magic_add_gold  = 0;
        $magic_add_tree  = 0;
        $magic_add_stone = 0;
        if ($count_kast>0){
            for ($num_kast = 0; $num_kast < $count_kast; $num_kast++)
                switch ($Global_array_kast[$num_kast]['id_kast']){
                    case 1:
                        $magic_add_gold = $magic_add_gold +   200;
                        break;
                    case 2:
                        $magic_add_gold  = $magic_add_gold +  3000;
                        break;
                }
        }
//GOLD
        $summ_jalovan = 0;
        for ($i = 1; $i <= 8; $i++)
            $summ_jalovan = $summ_jalovan + $Global_array_res_Junits_param[$i - 1]['Jalovan'] * $arr_res_castle['army_' . $i];
        $V_gold = $arr_res_castle['gold'];
        $V_agold = $arr_res_castle['agold'];
        $V_maxres = $arr_res_castle['maxres'];
        if ($V_gold > $V_maxres)
            $vorov_gold = floor((($V_gold - $V_maxres) / 100) + 1);
        echo '|<a class="tooltip normal-text" href="#">';
        if ($vorov_gold>0)
            echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_gold))  . '</b></font>';
        else
            echo '<font color="#FFF">' . FShowNumInSpace(round($V_gold))  . '</font>';
        echo '<span class="classic">Приток: ' .  FShowNumInSpace($V_agold)  . '/час<br>';
        if ($vorov_gold>0)
            echo 'Расхищение: ' . FShowNumInSpace($vorov_gold + 0) .  '/час<br>';
        if ($summ_jalovan>0)
            echo 'Жалование: ' . FShowNumInSpace($summ_jalovan + 0).'/час<br>';
        if ($magic_add_gold>0)
            echo 'Магия: '.FShowNumInSpace($magic_add_gold + 0).'/час<br>';
        echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
        echo '<b>ИТОГО: ' . FShowNumInSpace($V_agold - $summ_jalovan - $vorov_gold + $magic_add_gold) . '/час</b><br>';
        echo '<p class="small-text">Это примерно '.FShowNumInSpace(floor(($V_agold - $summ_jalovan - $vorov_gold + $magic_add_gold)/60/60)).'/сек</p></span></a>';
//TREE
        $V_tree = $arr_res_castle['tree'];
        $V_atree = $arr_res_castle['atree'];
        if ($V_tree > $V_maxres)
            $vorov_tree = floor((($V_tree - $V_maxres) / 100) + 1);
        echo '|<a class="tooltip normal-text" href="#">';
        if ($vorov_tree>0)
            echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_tree))  . '</b></font>';
        else
            echo '<font color="#FFF">' . FShowNumInSpace(round($V_tree))  . '</font>';
        echo '<span class="classic">Приток: ' .  FShowNumInSpace($V_atree)  . '/час<br>';
        if ($vorov_tree>0)
            echo 'Расхищение: ' . FShowNumInSpace($vorov_tree + 0) .  '/час<br>';
        if ($magic_add_tree>0)
            echo 'Магия: '.FShowNumInSpace($magic_add_tree + 0).'/час<br>';
        echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
        echo '<b>ИТОГО: ' . FShowNumInSpace($V_atree - $vorov_tree + $magic_add_tree) . '/час</b><br>';
        echo '<p class="small-text">Это примерно '.FShowNumInSpace(floor(($V_atree - $vorov_tree + $magic_add_tree)/60/60)).'/сек</p></span></a>';
//STONE
        $V_stone = $arr_res_castle['stone'];
        $V_astone = $arr_res_castle['astone'];
        if ($V_stone > $V_maxres)
            $vorov_stone = floor((($V_stone - $V_maxres) / 100) + 1);
        echo '|<a class="tooltip normal-text" href="#">';
        if ($vorov_stone>0)
            echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_stone))  . '</b></font>';
        else
            echo '<font color="#FFF">' . FShowNumInSpace(round($V_stone))  . '</font>';
        echo '<span class="classic">Приток: ' .  FShowNumInSpace($V_astone)  . '/час<br>';
        if ($vorov_stone>0)
            echo 'Расхищение: ' . FShowNumInSpace($vorov_stone + 0) .  '/час<br>';
        if ($magic_add_stone>0)
            echo 'Магия: '.FShowNumInSpace($magic_add_stone + 0).'/час<br>';
        echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
        echo '<b>ИТОГО: ' . FShowNumInSpace($V_astone - $vorov_stone + $magic_add_stone) . '/час</b><br>';
        echo '<p class="small-text">Это примерно '.FShowNumInSpace(floor(($V_astone - $vorov_stone + $magic_add_stone)/60/60)).'/сек</p></span></a>';
//MEN
        $V_Amen = $arr_res_castle['amen'];
        $V_Men = $arr_res_castle['men'];
        $V_Max_men = $arr_res_castle['max_men'];
        if ($V_Men > $V_Max_men)
            $vorov_men = floor((($V_Men - $V_Max_men) / 100) + 1);
        $V_Prirost = 0;
        echo '|<a class="tooltip normal-text" href="#">';
        if ($vorov_men>0)
            echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_Men))  . '</b></font>';
        else
            echo '<font color="#FFF">' . FShowNumInSpace(round($V_Men))  . '</font>';
        if ($V_Men < $V_Max_men)
            $V_Prirost = floor(decPrz($V_Men, 99.9));
        echo '<span class="classic">Прирост: ' . FShowNumInSpace($arr_res_castle['amen'])   . '/час<br>';
        echo '0.1%-ый прирост: ' . FShowNumInSpace($V_Prirost)   . '/час';
        if ($V_Prirost==0)
            echo '<p class="small-text">Жилища переполнены</p>';
        if ($vorov_men>0)
            echo 'Разбегание: ' . FShowNumInSpace($vorov_men + 0) . '/час<br>';
        echo '<i>Максимум: ' . FShowNumInSpace($V_Max_men) . '</i><br>';
        echo '<b class="big-text">ИТОГО: ' . FShowNumInSpace($V_Amen + $V_Prirost - $vorov_men) . '/час</b><br>';
        echo '<p class="small-text">Это примерно '.FShowNumInSpace(floor(($V_Amen + $V_Prirost - $vorov_men)/60/60)).'/сек</p></span></a>';
        for ($i = 1; $i <= 8; $i++)
            echo '|'.$arr_res_castle['army_'.$i];
        echo '|<div class="castle-room-'.onlyNoInt($arr_res_new_room['new']).'"></div>
              <p class="level-room">' . onlyInt($arr_res_new_room['new']) . '</p>
              <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($VTimeForWork) . '</p>';
        mysql_close($mysql_connect);
    }
?>