<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    if (basename($_SERVER['PHP_SELF']) != 'get_time_work_room.php') {
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '                                             W A R N I N G !' . PHP_EOL;
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '[!] -> Файл "get_time_work_room.php" включили в файл "' . basename($_SERVER['PHP_SELF']) . '"' . PHP_EOL;
        $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
        loging($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if ($_GET['action'] == 'get_time_work_room') {
        $mysql_connect = F_Connect_MySQL();
        include $_SERVER['DOCUMENT_ROOT'].'/_api/security.php';
        if (!Chek_string_of_mask($_GET['num_room'], $C_Numberic)) {
            $log_access .= '[!] -> Get-num_room is invalid.' . PHP_EOL;
            $enable_access = false;
        }
        $log_access .= '[.] -> Get-num_room=' . $_GET['num_room'] . PHP_EOL;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
        F_session_extension();
        include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
        mysql_close($mysql_connect);
    }
    loging($log_access);
?>