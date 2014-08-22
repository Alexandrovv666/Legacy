<?php
    include '../API.php';
    include '../Constant.php';
    if ($_GET['action'] == 'get_time_work_room') {
        $mysql_connect = FConnBase();
        global $C_Numberic, $C_Text_noSpace;
        if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
            loging('Кука login не прошла валидацию.');
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
        if ($arr_res_castle['gold'] > $arr_res_castle['maxres'])
            $vorov_gold = floor((($arr_res_castle['gold'] - $arr_res_castle['maxres']) / 100) + 1);
        if ($arr_res_castle['tree'] > $arr_res_castle['maxres'])
            $vorov_tree = floor((($arr_res_castle['tree'] - $arr_res_castle['maxres']) / 100) + 1);
        if ($arr_res_castle['stone'] > $arr_res_castle['maxres'])
            $vorov_stone = floor((($arr_res_castle['stone'] - $arr_res_castle['maxres']) / 100) + 1);
        if ($arr_res_castle['men'] > $arr_res_castle['max_men'])
            $vorov_men = floor((($arr_res_castle['men'] - $arr_res_castle['max_men']) / 100) + 1);

        $summ_jalovan = 0;
        for ($i = 1; $i <= 8; $i++)
            $summ_jalovan = $summ_jalovan + $Global_array_res_Junits_param[$i - 1]['Jalovan'] * $arr_res_castle['army_' . $i];
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['gold'])) .  '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['agold']) .  '/час<br>Расхищение: ' . FShowNumInSpace($vorov_gold + 0) .  '/час<br>Жалование: ' . FShowNumInSpace($summ_jalovan + 0).'/час<br>Магия: '.FShowNumInSpace($magic_add_gold +0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold)/60/60)).'/сек</font></span></a>';
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['tree'])) .  '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['atree']) .  '/час<br>Расхищение: ' . FShowNumInSpace($vorov_tree + 0) .  '/час<br>Магия: '.                                                           FShowNumInSpace($magic_add_tree +0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree)/60/60)).'/сек</font></span></a>';
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['stone'])) . '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['astone']) . '/час<br>Расхищение: ' . FShowNumInSpace($vorov_stone + 0) . '/час<br>Магия: '.                                                           FShowNumInSpace($magic_add_stone+0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone)/60/60)).'/сек</font></span></a>';
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['men'])) . '</font><span class="classic">Прирост: ' . FShowNumInSpace($arr_res_castle['amen']) . '/час<br>разбегание?: ' . FShowNumInSpace($vorov_men + 0) . '/час<br>-----------------------<br><i>Максимум: ' . FShowNumInSpace($arr_res_castle['max_men']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['amen']) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['amen'])/60/60)).'/сек</font></span></a>';
        for ($i = 1; $i <= 8; $i++)
            echo '|'.$arr_res_castle['army_'.$i];
    }
    FClose_mysql_connect($mysql_connect);
?>