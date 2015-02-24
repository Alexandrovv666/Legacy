<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/gameserver.php';
    if (basename($_SERVER['PHP_SELF']) != 'listwork.php') {
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '                                             W A R N I N G !' . PHP_EOL;
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '[!] -> Файл "listwork.php" включили в файл "' . basename($_SERVER['PHP_SELF']) . '"' . PHP_EOL;
        $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
        loging($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if ($_GET['action'] == 'listwork') {
        $mysql_connect = F_Connect_MySQL();
        global $C_Numberic, $C_Text_noSpace;
        include $_SERVER['DOCUMENT_ROOT'].'/_api/security.php';
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            $log_access .='[!] -> Get-num_room is invalid.'.PHP_EOL;
            $enable_access = false;
        }
        $log_access .= '[.] -> Get-num_room=' . $_GET['num_room'] . PHP_EOL;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
        F_session_extension();
        echo 'ok|';
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_COOKIE['casZ'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $time_to_work   = $arr_res_castle['c_' . $_GET['num_room'] . '_1'];
        switch (true) {
            case ($time_to_work != 0):
                $log_access .= '[.] -> Комната в работе. Осталось сек: '.($time_to_work*(-1)) . PHP_EOL;
                $name_room    = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
                $arr_res_room = mysql_fetch_array(mysql_query('SELECT * FROM haus WHERE `new`="' . ($name_room) . '"'));
                $worked       = floor($arr_res_castle['c_' . $_GET['num_room'] . '_2']);
                echo 'Информация о строящейся/улучшабщейся комнате|';
                echo '<input class="slider" type="range" min="0" max="' . $arr_res_room['max_men'] . '" value="' . $worked . '" id="range_people_at_work" oninput="CorrectMenForWorkCH(' . $arr_res_room['men'] . ', ' . $arr_res_room['max_men'] . ',' . floor($arr_res_castle['men']) . ',' . $worked . ', ' . -($arr_res_castle['c_' . $_GET['num_room'] . '_1']) . ', ' . $arr_res_castle['c_' . $_GET['num_room'] . '_2'] . ')"><br>';
                echo '<span id="will_men_to_work">' . $worked . ' из ' . $arr_res_room['max_men'] . '</span><br>';
                echo 'Будет дополнительно отправлено: <span id="add_to_works">0</span><br>';
                echo '<center>Останется времени до завершения: <span class="text-bold" id="time_of_work">' . int_to_time(-($arr_res_castle['c_' . $_GET['num_room'] . '_1'])) . '</span> из <span class="text-bold" id="def_time_of_work">' . int_to_time($arr_res_room['default_time']) . '</span></center><br>';
                echo '<center><p class="big-text" onclick="ChangeMen(' . $_GET['num_room'] . ')">Принять</p></center>';
                break;
            case ($time_to_work == 0):
                global $Max_level_HAUS;
                $name_alt_room         = $arr_res_castle['c_' . ($_GET['num_room']) . '_n'];
                $log_access .= '[.] -> Комната '.$name_alt_room.' бездействует.' . PHP_EOL;
                $arr_res_room_for_work = array();
                if (onlyInt($name_alt_room) == 0)
                    $res_room_for_work = mysql_query('SELECT * FROM haus WHERE ((id mod ' . $Max_level_HAUS . ')=' . (onlyInt($name_alt_room) + 1) . ')');
                else
                    $res_room_for_work = mysql_query('SELECT * FROM haus WHERE `new`="' . (onlyNoInt($name_alt_room) . (onlyInt($name_alt_room) + 1)) . '"');
                while ($arr_res_room_for_work[] = mysql_fetch_array($res_room_for_work)); {
            }
                $count_room_for_work = count($arr_res_room_for_work) - 1;
                echo 'Список комнат для постройки\улучшения|';
                echo '<p>Для строительства доступно:</p>';
                $log_access .= '[.] -> Игроку предложено:' . PHP_EOL;
                for ($i = 0; $i < $count_room_for_work; $i++) {
                    echo '<p onclick="api_window_modal_message_get_data(\'/server/StartWorkRoom.php?action=StartWorkRoom&num_room=' . $_GET['num_room'] . '&name=' . $arr_res_room_for_work[$i]['new'] . '\')">';
                    $res_room_rus      = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($arr_res_room_for_work[$i]['new']) . '"');
                    $arr_name_room_rus = mysql_fetch_array($res_room_rus);
                    $log_access .= '     > ' .$arr_name_room_rus['name_rus'].' '. onlyInt($arr_res_room_for_work[$i]['new']) . ' ур.'. PHP_EOL;
                    if (($arr_res_castle['gold'] >= $arr_res_room_for_work[$i]['gold']) AND ($arr_res_castle['tree'] >= $arr_res_room_for_work[$i]['tree']) AND ($arr_res_castle['stone'] >= $arr_res_room_for_work[$i]['stone']))
                        echo $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' уровня.';
                    else
                        echo '<strike>' . $arr_name_room_rus['name_rus'] . ' ' . onlyInt($arr_res_room_for_work[$i]['new']) . ' уровня.</strike>';
                    echo '</p><hr>';
                }
                if (in_array((onlyNoInt($name_alt_room)),array("nos","voin","kon","tank","bival","luk","lekar","naim"))){
                    $log_access .= '[.] -> + Это боевая комната' . PHP_EOL;
                    if ($arr_res_castle['gold'] >= 5)
                        echo 'Заказать юнита<br>';
                    else
                        echo '<strike>Заказать юнита</strike><br>';

                }
                break;
        }
        mysql_close($mysql_connect);
    }
    loging($log_access);
?>