<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    if ($_GET['action'] == 'StartWorkRoom') {
        $linkss = F_Connect_MySQL();
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            $log_access .= 'get параметр "num_room" не прошёл валидацию.' . PHP_EOL;
            $enable_access = false;
        }
        if (!Chek_string_of_mask($_GET['name'], ($C_Text . $C_Numberic))) {
            $log_access .= 'get параметр "name" не прошёл валидацию.' . PHP_EOL;
            $enable_access = false;
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
        F_session_extension();
        echo 'ok|Строительство комнаты|';
        echo '<span class="txt">';
        $res_castle        = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_COOKIE['casZ'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $a_castle          = mysql_fetch_array($res_castle);
        $res_room_for_work = mysql_query('SELECT * FROM haus WHERE `new`="' . $_GET['name'] . '"');
        $a_room_for_work   = mysql_fetch_array($res_room_for_work);
        $res_room_rus      = mysql_query('SELECT * FROM `haus_const` WHERE `name`="' . onlyNoInt($a_room_for_work['new']) . '"');
        $a_room_rus        = mysql_fetch_array($res_room_rus);
        echo '<span>' . $a_room_rus['name_rus'] . ' ' . onlyInt($a_room_for_work['new']) . ' уровня.</span><br>';
        echo '<i>Описание:</i>' . $a_room_rus['descr_rus'] . '<br>Требуется ресурсов:<br>';
        if ($a_castle['gold'] < $a_room_for_work['gold'])
            echo '<font color="red">Золото: ' . $a_room_for_work['gold'] . '</font><br>';
        else
            echo 'Золото: ' . $a_room_for_work['gold'] . '<br>';
        if ($a_castle['tree'] < $a_room_for_work['tree'])
            echo '<font color="red">Дерево: ' . $a_room_for_work['tree'] . '</font><br>';
        else
            echo 'Дерево: ' . $a_room_for_work['tree'] . '<br>';
        if ($a_castle['stone'] < $a_room_for_work['stone'])
            echo '<font color="red">Камень: ' . $a_room_for_work['stone'] . '</font><br>';
        else
            echo 'Камень: ' . $a_room_for_work['stone'] . '<br>';
        $VarMen = floor($a_room_for_work['men']);
        if (floor($a_castle['men']) < $VarMen)
            $VarMen = floor($a_castle['men']);
        echo '<br><input class="slider" type=range min=0 max=' . $a_room_for_work['men'] . ' value=' . $VarMen . ' id="men_for_work" oninput="CorrectMenForWork(' . $a_room_for_work['men'] . ',' . floor($a_castle['men']) . ')"><br>';
        echo '<span id="men_to_work_user">' . $VarMen . ' / ' . $a_room_for_work['men'] . '</span><br>';
        echo 'Будет отправлено <span id="to_works">' . ($VarMen) . '</span> народу<br>';
        echo '<center>Время постройки: <span class="text-bold" id="time_of_work">' . int_to_time($a_room_for_work['default_time']) . '</span> из <span class="text-bold" id="def_time_of_work">' . int_to_time($a_room_for_work['default_time']) . '</span></center><br>';
        echo '<center><p class="class-link big-text" onclick="StartWorks(\'' . $_GET['name'] . '\',' . $_GET['num_room'] . ')">Начать стройку!</p></center>';
        echo '</span>';
        mysql_Close($linkss);
    }
    loging($log_access);
?>