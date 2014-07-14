<?php
    include 'API.php';
    include 'Constant.php';
    $mysql_connect = FConnBase();


    if ($act == 'get_info_castle') {
        echo 'Здесь скоро будет вся основная информация о замке.';
    }
    if ($act == 'getsvariants_mission') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        if (mysql_num_rows(mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_GET['x2'] . '" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"')) == 1) {
            echo '<div href="#close" onclick="go_to_castle()">Войти в свой город</div>';
        } else {
            if (mysql_num_rows(mysql_query('SELECT * FROM `see_lager` WHERE `' . F_Get_login($_COOKIE['login']) . '` = "1" and `x`="' . $_GET['x2'] . '" and `y`="' . $_GET['y2'] . '" and `z`="' . $_GET['z2'] . '"')) == 1) {
                echo '<div onclick="StartAtack()">Атаковать лагерь</div><div onclick="StartSpy()">Шпионить лагерь</div>';
            } else {
                echo 'Вы здесь ничего не видите.';
            }
        }
    }
    if ($act == 'newroom') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось начать строительство т.к. не найден Ваш замок.');
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
                if ($name_alt_room != "")
                    mysql_query('UPDATE `game`.`castle` SET `room_name_' . $_GET['num_room'] . '` = "' . $arr_results_new_room['new_room'] . '",  `value_room_' . $_GET['num_room'] . '` = "-' . $time_towork . '", `gold` = `gold`-' . $arr_results_new_room['gold'] . ', `tree` = `tree`-' . $arr_results_new_room['tree'] . ', `stone` = `stone`-' . $arr_results_new_room['stone'] . ', `agold` = `agold`+' . $arr_results_new_room['agold'] . '-' . $arr_results_alt_room['agold'] . ', `atree` = `atree`+' . $arr_results_new_room['atree'] . '-' . $arr_results_alt_room['atree'] . ', `astone` = `astone`+' . $arr_results_new_room['astone'] . '-' . $arr_results_alt_room['astone'] . ' WHERE `castle`.`id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                else
                    mysql_query('UPDATE `game`.`castle` SET `room_name_' . $_GET['num_room'] . '` = "' . $arr_results_new_room['new_room'] . '",  `value_room_' . $_GET['num_room'] . '` = "-' . $time_towork . '", `gold` = `gold`-' . $arr_results_new_room['gold'] . ', `tree` = `tree`-' . $arr_results_new_room['tree'] . ', `stone` = `stone`-' . $arr_results_new_room['stone'] . ', `agold` = `agold`+' . $arr_results_new_room['agold'] . ', `atree` = `atree`+' . $arr_results_new_room['atree'] . ', `astone` = `astone`+' . $arr_results_new_room['astone'] . ' WHERE `castle`.`id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                $pos1 = strpos($arr_results_new_room['new_room'], "lesop");
                if ($pos1 !== false)
                    echo '<div class="castle-room-lesop"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos2 = strpos($arr_results_new_room['new_room'], "kamen");
                if ($pos2 !== false)
                    echo '<div class="castle-room-kamen"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos4 = strpos($arr_results_new_room['new_room'], "lavka");
                if ($pos4 !== false)
                    echo '<div class="castle-room-lavka"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos4 = strpos($arr_results_new_room['new_room'], "issled");
                if ($pos4 !== false)
                    echo '<div class="castle-room-issled"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos3 = strpos($arr_results_new_room['new_room'], "nos");
                if ($pos3 !== false)
                    echo '<div class="castle-room-nos"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "kon");
                if ($pos !== false)
                    echo '<div class="castle-room-kon"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "voin");
                if ($pos !== false)
                    echo '<div class="castle-room-voin"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "tank");
                if ($pos !== false)
                    echo '<div class="castle-room-tank"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "bival");
                if ($pos !== false)
                    echo '<div class="castle-room-bival"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "luk");
                if ($pos !== false)
                    echo '<div class="castle-room-luk"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "lekar");
                if ($pos !== false)
                    echo '<div class="castle-room-lekar"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';
                $pos = strpos($name_room, "naim");
                if ($pos !== false)
                    echo '<div class="castle-room-naim"></div>
                          <p class="level-room">' . onlyInt($arr_results_new_room['new_room']) . '</p>
                          <p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($time_towork) . '</p>';

            }
        }
    }
    if ($act == 'get_time_work_room') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось получить время т.к. замок не обнаружен.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        echo 'ok';
        for ($i = 1; $i <= 35; $i++) {
            $time_to_work   = abs($arr_res_castle['value_room_'.$i]);
            if ($time_to_work != 0)
                echo '|'.int_to_time($time_to_work);
            else
                echo '|0:0:0:0';
        }
        $Global_array_res_Junits_param = array();
        $res_Junits_param              = mysql_query('SELECT * FROM `army_baze`');
        while ($Global_array_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {}
        $Global_array_kast[]           = array();
        $res_all_kast            = mysql_query('SELECT * FROM `kast` where `login_ziel`="' . ($_COOKIE['login']) . '"');
        while ($Global_array_kast[] = mysql_fetch_array($res_all_kast)); {}
        $count_kast = count($Global_array_kast) - 1;
        $magic_add_gold  = 0;
        $magic_add_tree  = 0;
        $magic_add_stone = 0;
        if ($count_kast>0){
            for ($num_kast = 0; $num_kast < $count_kast; $num_kast++)
                switch ($Global_array_kast[$num_kast]['name_kast']){
                    case 2:
                        $magic_add_gold = $magic_add_gold +   300;
                        break;
                    case 3:
                        $magic_add_gold  = $magic_add_gold +  5;
                        $magic_add_tree  = $magic_add_tree +  5;
                        $magic_add_stone = $magic_add_stone + 5;
                        break;
                }
        }
        if ($arr_res_castle['gold'] > $arr_res_castle['maxres'])
            $vorov_gold = floor((($arr_res_castle['gold'] - $arr_res_castle['maxres']) / 100) + 1);
        if ($arr_res_castle['tree'] > $arr_res_castle['maxres'])
            $vorov_tree = floor((($arr_res_castle['tree'] - $arr_res_castle['maxres']) / 100) + 1);
        if ($arr_res_castle['stone'] > $arr_res_castle['maxres'])
            $vorov_stone = floor((($arr_res_castle['stone'] - $arr_res_castle['maxres']) / 100) + 1);
        $summ_jalovan = 0;
        for ($i = 1; $i <= 8; $i++)
            $summ_jalovan = $summ_jalovan + $Global_array_res_Junits_param[$i - 1]['Jalovan'] * $arr_res_castle['army_' . $i];
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['gold'])) .  '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['agold']) .  '/час<br>Расхищение: ' . FShowNumInSpace($vorov_gold + 0) .  '/час<br>Жалование: ' . FShowNumInSpace($summ_jalovan + 0).'/час<br>Магия: '.FShowNumInSpace($magic_add_gold +0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold)/60/60)).'/сек</font></span></a>';
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['tree'])) .  '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['atree']) .  '/час<br>Расхищение: ' . FShowNumInSpace($vorov_tree + 0) .  '/час<br>Магия: '.                                                           FShowNumInSpace($magic_add_tree +0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree)/60/60)).'/сек</font></span></a>';
        echo '|<a class="tooltip" href="#"><font color="#FFF">' . FShowNumInSpace(round($arr_res_castle['stone'])) . '</font><span class="classic">Приток: ' . FShowNumInSpace($arr_res_castle['astone']) . '/час<br>Расхищение: ' . FShowNumInSpace($vorov_stone + 0) . '/час<br>Магия: '.                                                           FShowNumInSpace($magic_add_stone+0).'/час<br>-----------------------<br><i>Склад: ' . FShowNumInSpace($arr_res_castle['maxres']) . '</i><br><b>ИТОГО: ' . FShowNumInSpace($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone) . '/час</b><br><font size="2">Это примерно '.FShowNumInSpace(floor(($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone)/60/60)).'/сек</font></span></a>';
        for ($i = 1; $i <= 8; $i++)///////////////////////
            echo '|'.$arr_res_castle['army_'.$i];
    }
    if ($act == 'start_expedition') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось отправить исследователя т.к. не найден источник миссии.');
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
            for ($i = 0; $i < (onlyInt($arr_res_castle['room_name_' . $_GET['num_room']])); $i++){
                if (F_GetCount_mission_of_ID($_COOKIE['login'])>$Max_Player_Mission)
                    break;
                $rand_x2 = rand(($x2-2), ($x2+2));
                $rand_y2 = rand(($y2-2), ($y2+2));
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
                mysql_query('INSERT INTO `missions`(`ist_x`, `ist_y`, `ist_z`, `vladelez`, `k_x`, `k_y`, `k_z`, `dlina`, `time_finish`, `type`, `napravlen`) VALUES ("' . $_COOKIE['X'] . '","' . $_COOKIE['Y'] . '","' . $_COOKIE['Z'] . '", "' . $_COOKIE['login'] . '",  "' . $rand_x2 . '","' . $rand_y2 . '","' . $rand_z2 . '","' . $dlina . '","' . $dlina . '","expedition","0")')or die(mysql_error());
            }
            mysql_query('UPDATE `castle` SET `value_room_' . $_GET['num_room'] . '` = "' . ($dlina * 2) . '" WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
            echo int_to_time($dlina * 2);
        }else
            echo int_to_time($time_to_work);
    }
    if ($act == 'donat_work') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось ускорить производство т.к. не обнаружен замок.<br>Средства не списаны.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $res_user       = mysql_query('SELECT * FROM `users` WHERE `id` = "' . ($_COOKIE['login']) . '"');
        $arr_res_user   = mysql_fetch_array($res_user);
        $time_to_work   = $arr_res_castle['value_room_' . $_GET['num_room']];
        if ($time_to_work < 0) {
            global $Cost_work_money_speed;
            if ($arr_res_user['almaz'] >= $Cost_work_money_speed) {
                mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = 0 WHERE `id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
                mysql_query('UPDATE `game`.`users` SET `almaz` = `almaz`-' . $Cost_work_money_speed . ' WHERE `users`.`id` = "' . ($_COOKIE['login']) . '"');
                echo int_to_time(1);
            }else{
                echo int_to_time(-$time_to_work);
            }
        }
    }
    if ($act == 'listwork') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "'.($_COOKIE['login']).'" and `x`="'.$_COOKIE['X'].'" and `y`="'.$_COOKIE['Y'].'" and `z`="'.$_COOKIE['Z'].'"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось загрузить список зданий для постройки т.к. не удалось обнаружить Ваш замок.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        if ($arr_res_castle['value_room_' . $_GET['num_room']] != 0) {
            if ($arr_res_castle['value_room_' . $_GET['num_room']] < 0)
                echo '<p>комната строится.</p>
                      <p>Завершить строительство за <a class="tooltip" href="#" onclick="donat_work(' . $_GET['num_room'] . ')">' . $Cost_work_money_speed . '<span class="classic">После оплаты услуги с Вашего счёта спишется ' . $Cost_work_money_speed . ' алмазов.<br>При этом строительство окончится мгновенно.</span></a> алмазов.</p>';
            if ($arr_res_castle['value_room_' . $_GET['num_room']] > 0)
                echo '<p>Комната занята.</p>';
        } else {
            $name_alt_room  = $arr_res_castle['room_name_' . $_GET['num_room']];
            $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `alt_room`="' . $name_alt_room . '"');
            $res_alt_room   = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $name_alt_room . '"');
            $arr_alt_room   = mysql_fetch_array($res_alt_room);
            $count_new_room = mysql_num_rows($res_new_room);
            echo '<p>Для строительства доступно:</p>';
            for ($i = 0; $i < $count_new_room; $i++) {
                $arr_new_room = mysql_fetch_array($res_new_room);
                $name_new_room_mysql = $arr_new_room['new_room'];
                $time_towork         = F_time_towork($name_new_room_mysql);
                echo '<p><a class="tooltip class-link" href="#"';
                if (($arr_res_castle['gold'] >= $arr_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_new_room['tree']))
                    echo ' onclick="StartWorks(\'' . $name_new_room_mysql . '\', ' . $_GET['num_room'] . ')">' . $arr_new_room['name'] . ' ' . onlyInt($name_new_room_mysql) . ' уровня.<span class="classic">' . $arr_new_room['opisanie'] . '<br>' . $arr_new_room['gold'] . '; ' . $arr_new_room['tree'] . '; ' . $arr_new_room['stone'] . '.<br>Время строительста: <b>' . int_to_time($time_towork) . '</b><br>';
                else
                    echo ' onclick="StartWorks(\'' . $name_new_room_mysql . '\', ' . $_GET['num_room'] . ')"><strike>' . $arr_new_room['name'] . ' ' . onlyInt($name_new_room_mysql) . ' уровня.</strike><span class="classic">' . $arr_new_room['opisanie'] . '<br>' . $arr_new_room['gold'] . '; ' . $arr_new_room['tree'] . '; ' . $arr_new_room['stone'] . '.<br>Время строительста: <b>' . int_to_time($time_towork) . '</b><br>';
                if (onlyNoInt($name_new_room_mysql) == "lavka")
                    echo 'Добыча увеличится с ' . ($arr_alt_room['agold'] + 0) . ' до ' . $arr_new_room['agold'] . '<br>--------------------<br>Разница (~' . floor(100 - ($arr_alt_room['agold']) / ($arr_new_room['agold']) * 100) . '%)';
                if (onlyNoInt($name_new_room_mysql) == "kamen")
                    echo 'Добыча увеличится с ' . ($arr_alt_room['astone'] + 0) . ' до ' . $arr_new_room['astone'] . '<br>--------------------<br>Разница (~' . floor(100 - ($arr_alt_room['astone']) / ($arr_new_room['astone']) * 100) . '%)';
                if (onlyNoInt($name_new_room_mysql) == "lesop")
                    echo 'Добыча увеличится с ' . ($arr_alt_room['atree'] + 0) . ' до ' . $arr_new_room['atree'] . '<br>--------------------<br>Разница (~' . floor(100 - ($arr_alt_room['atree']) / ($arr_new_room['atree']) * 100) . '%)';
                if ($name_alt_room != "")
                    if ((onlyNoInt($name_new_room_mysql) == "nos") or (onlyNoInt($name_new_room_mysql) == "voin") or (onlyNoInt($name_new_room_mysql) == "kon") or (onlyNoInt($name_new_room_mysql) == "tank") or (onlyNoInt($name_new_room_mysql) == "bival") or (onlyNoInt($name_new_room_mysql) == "luk") or (onlyNoInt($name_new_room_mysql) == "lekar") or (onlyNoInt($name_new_room_mysql) == "naim"))
                        echo 'Время тренировки<br>Сейчас ' . int_to_time(F_time_tren($name_alt_room) + 0) . '<br>После ' . int_to_time(F_time_tren($name_new_room_mysql) + 0) . '<br>--------------------<br>Разница <b>' . int_to_time(F_time_tren($name_alt_room) - F_time_tren($name_new_room_mysql)) . '</b><br>(~' . floor(100 - F_time_tren($name_new_room_mysql) / F_time_tren($name_alt_room) * 100) . '%)';
                if (!(($arr_res_castle['gold'] >= $arr_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_new_room['tree']))) {
                    echo '<br><b><font color="#F00">Недостаточно ресурсов</font></b><br>Нам нехватает ещё: ';
                    $min_gold  = 0;
                    $min_tree  = 0;
                    $min_stone = 0;
                    if ($arr_res_castle['gold'] < $arr_new_room['gold']) {
                        echo '<br>' . round($arr_new_room['gold'] - $arr_res_castle['gold']) . ' Золотых монет';
                        $min_gold = round($arr_new_room['gold'] - $arr_res_castle['gold']);
                    }
                    if ($arr_res_castle['tree'] < $arr_new_room['tree']) {
                        echo '<br>' . round($arr_new_room['tree'] - $arr_res_castle['tree']) . ' Дерева';
                        $min_tree = round($arr_new_room['tree'] - $arr_res_castle['tree']);
                    }
                    if ($arr_res_castle['stone'] < $arr_new_room['stone']) {
                        echo '<br>' . round($arr_new_room['stone'] - $arr_res_castle['stone']) . ' Камня.';
                        $min_stone = round($arr_new_room['stone'] - $arr_res_castle['stone']);
                    }
                    echo '<br><font size="2">Нужное количество ресурсов наберётся примерно через ';
                    if ($arr_res_castle['gold'] > $arr_res_castle['maxres'])
                        $vorov_gold = floor((($arr_res_castle['gold'] - $arr_res_castle['maxres']) / 100) + 1);
                    if ($arr_res_castle['tree'] > $arr_res_castle['maxres'])
                        $vorov_tree = floor((($arr_res_castle['tree'] - $arr_res_castle['maxres']) / 100) + 1);
                    if ($arr_res_castle['stone'] > $arr_res_castle['maxres'])
                        $vorov_stone = floor((($arr_res_castle['stone'] - $arr_res_castle['maxres']) / 100) + 1);
                    $summ_jalovan = 0;
                    for ($in = 1; $in <= 8; $in++)
                        $summ_jalovan = $summ_jalovan + $Global_array_res_Junits_param[$in - 1]['Jalovan'] * $arr_res_castle['army_' . $in];
                    $Global_array_kast[]        = array();
                    $res_all_kast               = mysql_query('SELECT * FROM `kast` where `login_ziel`="' . ($_COOKIE['login']) . '"');
                    while ($Global_array_kast[] = mysql_fetch_array($res_all_kast)); {}
                    $count_kast = count($Global_array_kast) - 1;
                    $magic_add_gold  = 0;
                    $magic_add_tree  = 0;
                    $magic_add_stone = 0;
                    if ($count_kast>0){
                        for ($num_kast = 0; $num_kast < $count_kast; $num_kast++)
                            switch ($Global_array_kast[$num_kast]['name_kast']){
                                case 2:
                                    $magic_add_gold = $magic_add_gold +   300;
                                    break;
                                case 3:
                                    $magic_add_gold  = $magic_add_gold  + 5;
                                    $magic_add_tree  = $magic_add_tree  + 5;
                                    $magic_add_stone = $magic_add_stone + 5;
                                    break;
                            }
                    }
                    $min_time = -3;
                    if ($min_gold > 0)
                        if (($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold) != 0)
                            if ($min_time < ($min_gold / ($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold)))
                                $min_time = ($min_gold / ($arr_res_castle['agold'] - $summ_jalovan - $vorov_gold + $magic_add_gold));
                    if ($min_tree > 0)
                        if (($arr_res_castle['atree'] - $vorov_tree) != 0)
                            if ($min_time < ($min_tree / ($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree)))
                                $min_time = ($min_tree / ($arr_res_castle['atree'] - $vorov_tree + $magic_add_tree));
                    if ($min_stone > 0)
                        if (($arr_res_castle['astone'] - $vorov_stone) != 0)
                            if ($min_time < ($min_stone / ($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone)))
                                $min_time = ($min_stone / ($arr_res_castle['astone'] - $vorov_stone + $magic_add_stone));
                    echo int_to_time(round($min_time*60*60)).'</font>';
                }
                echo '</span></a></del></p>';
                $name_room      = $arr_res_castle['room_name_' . $_GET['num_room']];
                $Oroginal_name_room = onlyNoInt($name_room);
                if ($name_alt_room != "")
                    $Speed_trenirovka = F_time_tren($name_room);
                if ($Oroginal_name_room == "nos")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать щитоносца<span class="classic">Щитоносец - самый многочисленный отряд любой армии. Благодоря своему щиту, щитоносец прикрывает другие отряды.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "voin")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать ополченца<span class="classic">Ополченец - самый дешёвый юнит, обладающий невысоким здоровьем и атакой, способный с бюольшой лёгкостью справиться с лучникв.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "kon")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать конника<span class="classic">Конник - юнит, вооружённый мощной пикой, способной сбить с ног ополченца.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "tank")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать танка<span class="classic">Танк - тяжелобронированный юнит. Многие столетия оттачивал мастерство сражения с конниками.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "bival")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать бывалова<span class="classic">Бывалый - юнит, специализирующийся на уничтожении танков.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "luk")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать лучника<span class="classic">Издавна лучники славились своим умением исрпользоваь арбалеты. Преследуют бывалых.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "lekar")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать лекаря<span class="classic">Лекарь - выпускник церковно-приходской школы, призванный лечить раненыех.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "naim")
                    echo '<p><a class="tooltip class-link" href="#" onclick="GetUnits(' . $_GET['num_room'] . ')">Заказать сорвиголову<span class="classic">Сорвиголова - идеальный убийца. Способен наносить смертельные ранения в бою. Из недостаткой стоит отметить низкое здоровье.<br>Время тренировки одного юнита: <b>' . int_to_time($Speed_trenirovka) . '</b></span></a></p>';
                if ($Oroginal_name_room == "issled")
                    echo '<p><input type="number" id="x2" value="' . $_COOKIE['X'] . '"/><input type="number" id="y2" value="' . $_COOKIE['Y'] . '"/><br><a class="tooltip class-link" href="#" onclick="StartExpedition(' . $_GET['num_room'] . ')">Отправить исследователя в путешевствие.<span class="classic">Исследователь отправиться исследовать указанное королевство.<br>Он не будет исследовать клетки, на которых стоит город.<br>Он не будет исследовать клетки, на которых расположен лагерь.</span></a></p>';
                if ($name_alt_room != "")
                    echo '<p></p><p><a href="#" class="class-link" onclick="Delete_room(' . $_GET['num_room'] . ')">Освободить комнату.</a></p>';
            }
        }
    }
    if ($act == 'delete_room') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не обнаружен замок.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = abs($arr_res_castle['value_room_' . $_GET['num_room']]);
        if ($time_to_work == 0) {
            $name_alt_room = $arr_res_castle['room_name_' . $_GET['num_room']];
            $res_alt_haus  = mysql_query('SELECT * FROM `haus` WHERE `new_room`="' . $name_alt_room . '"');
            if (mysql_num_rows($res_alt_haus) != 1)
                ShowMessage_and_exit('Не удалось идентифицировать здание для сноса.');
            $arr_res_alt_haus = mysql_fetch_array($res_alt_haus);
            mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = "'.floor(F_time_towork($name_alt_room)/2).'", `room_name_' . $_GET['num_room'] . '`="", `agold`=`agold`-' . $arr_res_alt_haus['agold'] . ', `atree`=`atree`-' . $arr_res_alt_haus['atree'] . ', `astone`=`astone`-' . $arr_res_alt_haus['astone'] . ' WHERE `castle`.`id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '" ');
            echo '<p class="level-room"></p><p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time(floor(F_time_towork($name_alt_room)/2)) . '</p>';
        }
    }
    if ($act == 'loadwindowatack') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не обнаружен замок.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        echo '<table border="1" cellpadding="1"><tr>';
        for ($i = 1; $i <= 8; $i++)
            echo '
<td>
    <table>
        <tr>
            <td>
                <img src="Img/Units/army/' . $i . '.png" width="63">
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <input type="range" min="0" max="' . $arr_res_castle['arm' . $i] . '" id="rangearmy' . $i . '" oninput="correct_army()" value="0" style="width:38px">
                </center>
                <div id="army_in_atack' . $i . '">
                    ***
                </div>
                Макс: ' . $arr_res_castle['arm' . $i] . '
            </td>
        </tr>
    </table>
</td>';
        echo '</tr></table>';
        $summ_count_army = 0;
        for ($i = 1; $i <= 8; $i++)
            $summ_count_army = $summ_count_army + $arr_res_castle['arm' . $i];
        if ($summ_count_army > 0)
            echo '<br><center><div onclick="Start_atack_mission()">Отправить в атаку!</div></center><br><b><u>Идёт тестирование модуля "Атака".<br>Подалуйста, записывайте что и когда сделали. чем точнее, тем лучше.<br>Спасибо за понимание.</u><b>';
        else
            echo '<br><center><b><u>Во владении отсутствуют войска.</u><b></center>';
    }
    if ($act == 'atack_mission_grab') {
        $id_of_log = rand();
        loging(' >> Start log. id=' . ($id_of_log));
        loging(' >> ' . $id_of_log . ' >> Игрок [' . $_COOKIE['login'] . '] Инициировал атаку из [' . $_GET['x1'] . '-' . $_GET['y1'] . '-' . $_GET['z1'] . '] в [' . $_GET['x2'] . '-' . $_GET['y2'] . '-' . $_GET['z2'] . ']');
        loging(' >> ' . $id_of_log . ' >> Армия: ' . $_GET['a1'] . '-' . $_GET['a2'] . '-' . $_GET['a3'] . '-' . $_GET['a4'] . '-' . $_GET['a5'] . '-' . $_GET['a6'] . '-' . $_GET['a7'] . '-' . $_GET['a8']);
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '" and `arm1`>="' . $_GET['a1'] . '" and `arm2`>="' . $_GET['a2'] . '" and `arm3`>="' . $_GET['a3'] . '" and `arm4`>="' . $_GET['a4'] . '" and `arm5`>="' . $_GET['a5'] . '" and `arm6`>="' . $_GET['a6'] . '" and `arm7`>="' . $_GET['a7'] . '" and `arm8`>="' . $_GET['a8'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            exit;
        else {
            $all_summ_arm = 0;
            for ($i = 1; $i <= 8; $i++)
                $all_summ_arm = $all_summ_arm + $_GET['a' . $i];
            $dlina = Function_gettime_for_databaze($_GET['x1'], $_GET['y1'], $_GET['z1'], $_GET['x2'], $_GET['y2'], $_GET['z2']);
            mysql_query('UPDATE `castle` SET `gold`=`gold`-"' . $all_summ_arm . '", `arm1`=`arm1`-"' . $_GET['a1'] . '",`arm2`=`arm2`-"' . $_GET['a2'] . '",`arm3`=`arm3`-"' . $_GET['a3'] . '",`arm4`=`arm4`-"' . $_GET['a4'] . '",`arm5`=`arm5`-"' . $_GET['a5'] . '",`arm6`=`arm6`-"' . $_GET['a6'] . '",`arm7`=`arm7`-"' . $_GET['a7'] . '",`arm8`=`arm8`-"' . $_GET['a8'] . '" WHERE `x`="' . $_GET['x1'] . '" and `y`="' . $_GET['y1'] . '" and `z`="' . $_GET['z1'] . '"');
            mysql_query('INSERT INTO `missions`(`ist_x`, `ist_y`, `ist_z`, `id`, `k_x`, `k_y`, `k_z`,`dlina`, `time_finish`, `type`,`arm1`, `arm2`, `arm3`, `arm4`, `arm5`, `arm6`, `arm7`, `arm8`, `napravlen`) VALUES ("' . $_GET['x1'] . '","' . $_GET['y1'] . '","' . $_GET['z1'] . '","' . $_COOKIE['login'] . '","' . $_GET['x2'] . '","' . $_GET['y2'] . '","' . $_GET['z2'] . '","' . $dlina . '","' . $dlina . '","atack_grab","' . $_GET['a1'] . '","' . $_GET['a2'] . '","' . $_GET['a3'] . '","' . $_GET['a4'] . '","' . $_GET['a5'] . '","' . $_GET['a6'] . '","' . $_GET['a7'] . '","' . $_GET['a8'] . '","0")');
        }
    }
    if ($act == 'loadwindowspy') {
        echo '<br><br><center><b><u>Модуль "Шпионаж" не введён.</u><b></center>';
    }
    if ($act == 'getUnits') {
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . ($_COOKIE['login']) . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось заказать юнита т.к. не обнаружен замок.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = abs($arr_res_castle['value_room_' . $_GET['num_room']]);
        if ($time_to_work == 0) {
            $name_room           = $arr_res_castle['room_name_' . $_GET['num_room']];
            $Speed_Get_Unit_time = F_time_tren($name_room);
            mysql_query('UPDATE `game`.`castle` SET `value_room_' . $_GET['num_room'] . '` = "' . ($Speed_Get_Unit_time) . '" WHERE `castle`.`id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
            echo int_to_time($Speed_Get_Unit_time);
        } else
            echo int_to_time($time_to_work);
    }
    if ($act == 'room_name') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . $_COOKIE['login'] . '" and `x`="' . $_COOKIE['X'] . '" and `y`="' . $_COOKIE['Y'] . '" and `z`="' . $_COOKIE['Z'] . '"');
        if (mysql_num_rows($res_castle) != 1)
            ShowMessage_and_exit('Не удалось загрузить имя комнаты т.к. Ваш замок не обнаружен.');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $name_room      = ($arr_res_castle['room_name_' . $_GET['num_room']]);
        if ($name_room == '')
            echo '(Пустая)';
        if (onlyNoInt($name_room) == "lesop")
            echo '(Комната мастера по дереву ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "kamen")
            echo '(Комната мастера по камню ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "lavka")
            echo '(Комната торговца ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "issled")
            echo '(Комната исследователя ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "nos")
            echo '(Комната щитоносцов ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "voin")
            echo '(Комната ополченцов ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "kon")
            echo '(Комната конников ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "tank")
            echo '(Комната танков ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "bival")
            echo '(Комната бывалых ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "lekar")
            echo '(Комната лекарей ' . onlyInt($name_room) . ' уровня)';
        if (onlyNoInt($name_room) == "naim")
            echo '(Комната сорвиголов ' . onlyInt($name_room) . ' уровня)';
    }
    if ($act == 'getspeed') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
        echo gettime_of_path($_GET['x1'], $_GET['y1'], $_GET['z1'], $_GET['x2'], $_GET['y2'], $_GET['z2']);
    }
    if ($act == 'boy_auto_issled') {
        $res_users     = mysql_query('SELECT almaz FROM `users` WHERE `login` = "' . $_COOKIE['login'] . '"');
        $arr_res_users = mysql_fetch_array($res_users);
        if ($arr_res_users['almaz'] >= 10) {
            mysql_query('UPDATE `users` SET `almaz` = `almaz`-10 WHERE `login` = "' . $_COOKIE['login'] . '"');
            mysql_query('UPDATE `auto_issled` SET `count` = `count`+10 WHERE `login` = "' . $_COOKIE['login'] . '"');
            echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
        } else
            ShowMessage_and_exit('Не удалось приобрести услуга т.к. недостаточно алмазов.');
    }
    if ($act == 'boy_auto_issled2') {
        $res_users     = mysql_query('SELECT almaz FROM `users` WHERE `login` = "' . $_COOKIE['login'] . '"');
        $arr_res_users = mysql_fetch_array($res_users);
        if ($arr_res_users['almaz'] >= 90) {
            mysql_query('UPDATE `users` SET `almaz` = `almaz`-90 WHERE `login` = "' . $_COOKIE['login'] . '"');
            mysql_query('UPDATE `auto_issled` SET `count` = `count`+100 WHERE `login` = "' . $_COOKIE['login'] . '"');
            echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
        } else
            ShowMessage_and_exit('Не удалось приобрести услуга т.к. недостаточно алмазов.');
    }
    if ($act == 'mails') {
        $res_mail                 = mysql_query("SELECT * FROM `mail` WHERE (`adresat` =  '" . $_COOKIE['login'] . "') and `date`=" . $_GET['x'] . " ORDER BY `mail`.`date` DESC LIMIT 1");
        $arr_mail_antwort         = mysql_fetch_array($res_mail);
        $arr_mail_antwort['text'] = str_replace("_Одинарная_кавычка_", "'", $arr_mail_antwort['text']);
        $arr_mail_antwort['text'] = str_replace("_Двойная_кавычка_", '"', $arr_mail_antwort['text']);
        $text_in_WebSite          = str_replace("_Перенос_строки_", "<br>", $arr_mail_antwort['text']);
        $text_in_Input            = str_replace("_Перенос_строки_", "\r\n", $arr_mail_antwort['text']);
        echo '
                              <a class=" link" href="javascript:sh(\'' . $arr_mail_antwort['date'] . '\')">
                                  ' . $arr_mail_antwort['zagolowok'] . '
                              </a>
                              <div id="blabla_' . $arr_mail_antwort['date'] . '" style="display: block;">
                                  <div id="load_mail_' . $arr_mail_antwort['date'] . '">
                                      ' . $text_in_WebSite;
        echo '
        <details>
         <summary>Ответить</summary>
          <form action="server.php?action=mailsend"  method="post">
           <p><i>Ответить</i></p>
           <p><input type="text" name="adress" value="' . $arr_mail_antwort['autor'] . '"></p>
           <p><textarea rows="10" cols="45" name="texts">' . $text_in_Input . "\r\n" . "\r\n" . 'Ответ ' . $_COOKIE['login'] . ':' . "\r\n" . '</textarea></p>
           <p><input type="submit" value="Ответить"></p>
          </form>
        </details>';
        echo '
                                  </div>
                              </div>';
        mysql_query('UPDATE `game`.`mail` SET `wr` = "1" WHERE `adresat` = "' . $_COOKIE['login'] . '" and `date`="' . $_GET['x'] . '"');
    }
    if ($act == 'mailsend') {
        echo '<META content="text/html; charset=utf-8" http-equiv="Content-Type">';
        $text = $_POST['texts'];
        $text = str_replace("'", "_Одинарная_кавычка_", $text);
        $text = str_replace('"', "_Двойная_кавычка_", $text);
        $text = str_replace("\r\n", "_Перенос_строки_", $text);
        mysql_query('INSERT INTO `mail`(`icon`, `zagolowok`, `text`, `date`, `autor`, `adresat`) VALUES ("1","Сообщение от ' . $_COOKIE['login'] . '","' . $text . '","' . time() . '","' . $_COOKIE['login'] . '","' . $_POST['adress'] . '")');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    if ($act == 'delmailsend') {
        mysql_query('DELETE FROM `mail` WHERE `date` = "' . $_GET['datedell'] . '" and `adresat` = "' . $_COOKIE['login'] . '"');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    if ($act == 'delmailsendallwinmisssionsexpedit') {
        mysql_query('DELETE FROM `mail` WHERE (`zagolowok` = "Результаты экспедиции(+)") and (`adresat` = "' . $_COOKIE['login'] . '")');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    if ($act == 'delmailsendallerrormisssionsexpedit') {
        mysql_query('DELETE FROM `mail` WHERE (`zagolowok` = "Результаты экспедиции(-)") and (`adresat` = "' . $_COOKIE['login'] . '")');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    if ($act == 'delmailsendall') {
        mysql_query('DELETE FROM `mail` WHERE `adresat` = "' . $_COOKIE['login'] . '" and `date`<="' . time() . '"');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    if ($act == 'hack')
        echo 'HACK!!!!!!<html><head><meta http-equiv=Refresh content="0; url=Exit.php"></head></html>';
    FClose_mysql_connect($mysql_connect);
?>