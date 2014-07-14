<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'listwork') {
        echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
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
                    $res_all_kast               = mysql_query('SELECT * FROM `kast` where `id_ziel`="' . F_Get_ID($_COOKIE['login']) . '"');
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
                                    $magic_add_gold  = $magic_add_gold  + 3000;
                                    break;
                            }
                    }
                    $min_time = -1;
                    if ($min_gold > 0){
                        $glob_add_Gold = $arr_res_castle['agold'] - $summ_jalovan - $vorov_gold;
                        if ($glob_add_Gold > 0)
                            if ($min_time < ($min_gold / $glob_add_Gold))
                                $min_time = ($min_gold / $glob_add_Gold);
                    }

                    if ($min_tree > 0){
                        $glob_add_Tree = $arr_res_castle['atree'] - $vorov_tree + $magic_add_tree;
                        if ($glob_add_Tree > 0)
                            if ($min_time < ($min_tree / $glob_add_Tree))
                                $min_time = ($min_tree / $glob_add_Tree);
                    }
                    if ($min_stone > 0){
                        $glob_add_Stone = $arr_res_castle['astone'] - $vorov_stone + $magic_add_stone;
                        if ($glob_add_Stone > 0)
                            if ($min_time < ($min_stone / ($glob_add_Stone)))
                                $min_time = ($min_stone / $glob_add_Stone);
                    }
                    if (($min_time==0) or ($min_time==-1))
                      echo '<b>никогда</b>.';
                    else
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
    FClose_mysql_connect($mysql_connect);
?>