<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    if ($_GET['action'] == 'newroom') {
        $mysql_connect = F_Connect_MySQL();
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            $log_access .= '[!] -> Get-num_room is invalid.' . PHP_EOL;
            $enable_access = false;
        }
        $log_access .= '[.] -> Get-num_room=' . $_GET['num_room'] . PHP_EOL;
        if (!Chek_string_of_mask($_GET['namenewroomroom'], ($C_Text . $C_Numberic))) {
            $log_access .= '[!] -> Get-namenewroomroom is invalid.' . PHP_EOL;
            $enable_access = false;
        }
        $log_access .= '[.] -> Get-namenewroomroom=' . $_GET['namenewroomroom'] . PHP_EOL;
        if (!Chek_string_of_mask($_GET['men'], ($C_Numberic))) {
            $log_access .= '[!] -> Get-men is invalid.' . PHP_EOL;
            $enable_access = false;
        }
        $log_access .= '[.] -> Get-men=' . $_GET['men'] . PHP_EOL;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
        F_session_extension();
        $res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_COOKIE['casZ'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
        $arr_res_castle = mysql_fetch_array($res_castle);
        $res_new_room   = mysql_query('SELECT * FROM `haus` WHERE `new`="' . $_GET['namenewroomroom'] . '" LIMIT 1');
        if (mysql_num_rows($res_new_room) != 1) {
            $log_access .= '[!] -> ���������� ������� �� ���� ������� "' . $_GET['namenewroomroom'] . '" ��� ���������' . PHP_EOL;
            loging($log_access);
            exit;
        }
        $log_access .= '[.] -> ������� "' . $_GET['namenewroomroom'] . '" ��������� �� ���� �������' . PHP_EOL;
        $arr_res_new_room = mysql_fetch_array($res_new_room);
        if (onlyInt($arr_res_new_room['new']) == 1) {
            if ($arr_res_castle['c_' . $_GET['num_room'] . '_n'] != '') {
                $log_access .= '[!] -> ������� ��������� ������� ������� ������ � �������� �������.' . PHP_EOL;
                loging($log_access);
                exit;
            }
        } else {
            if (onlyNoInt($arr_res_castle['c_' . $_GET['num_room'] . '_n']) . (onlyInt($arr_res_castle['c_' . $_GET['num_room'] . '_n']) + 1) != ($arr_res_new_room['new'])) {
                $log_access .= '[!] -> �������� ������� �� �������� �������������� ����� �������.' . PHP_EOL;
                loging($log_access);
                exit;
            }
        }
        if (($arr_res_castle['gold'] >= $arr_res_new_room['gold']) AND ($arr_res_castle['stone'] >= $arr_res_new_room['stone']) AND ($arr_res_castle['tree'] >= $arr_res_new_room['tree'])) {
            $VMenForWork = $_GET['men'];
            if ($arr_res_castle['men'] < $VMenForWork) {
                $log_access .= '[?] -> ���������� ��������� ������, ��� ���� � �������.' . PHP_EOL;
                $log_access .= '     > ��������, ����� ������ � 2 ���� ��� ������ �� ������������ �������.' . PHP_EOL;
                $log_access .= '     > �������������� �����������: ������ ���.' . PHP_EOL;
                loging($log_access);
                $VMenForWork = $arr_res_castle['men'];
            }
            if ($VMenForWork == 0)
                $VTimeForWork = ($arr_res_new_room['default_time'] * (-1));
            else
                $VTimeForWork = floor($arr_res_new_room['default_time'] * ($arr_res_new_room['men'] / $VMenForWork));
            F_Transaction();
            mysql_query('UPDATE `game`.`castle` SET `c_' . $_GET['num_room'] . '_n` = "' . $arr_res_new_room['new'] . '",  `c_' . $_GET['num_room'] . '_1` = "' . ($VTimeForWork * (-1)) . '", `c_' . $_GET['num_room'] . '_2` = "' . $VMenForWork . '", `c_' . $_GET['num_room'] . '_3` = "' . $arr_res_new_room['id'] . '", `gold` = `gold`-' . $arr_res_new_room['gold'] . ', `tree` = `tree`-' . $arr_res_new_room['tree'] . ', `stone` = `stone`-' . $arr_res_new_room['stone'] . ', `men`=`men`-"' . $VMenForWork . '" WHERE `castle`.`id` = "' . F_Get_ID($_COOKIE['login']) . '" and `x`="' . $_COOKIE['casX'] . '" and `y`="' . $_COOKIE['casY'] . '" and `z`="' . $_COOKIE['casZ'] . '"');
        } else {
            $log_access .= '[!] -> ������� ��������� ������� ��� ���������� ��������.' . PHP_EOL;
            loging($log_access);
            exit;
        }
        echo '<div id="box-room-' . $_GET['num_room'] . '"></div><div class="castle-room-' . onlyNoInt($arr_res_new_room['new']) . '"></div><p class="level-room">' . onlyInt($arr_res_new_room['new']) . '</p><p class="time-room" id="timer' . $_GET['num_room'] . '">' . int_to_time($VTimeForWork) . '</p>';
        mysql_close($mysql_connect);
    }
    loging($log_access);
?>