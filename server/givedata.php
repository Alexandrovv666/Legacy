<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    $mysql_connect = F_Connect_MySQL();
    global $C_Numberic, $C_Text_noSpace;
    if (basename($_SERVER['PHP_SELF']) != 'givedata.php') {
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '                                             W A R N I N G !' . PHP_EOL;
        $log_access .= '------------------------------------------------------------' . PHP_EOL;
        $log_access .= '[!] -> Файл "givedata.php" включили в файл "' . basename($_SERVER['PHP_SELF']) . '"' . PHP_EOL;
        $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
        loging($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    include $_SERVER['DOCUMENT_ROOT'].'/_api/security.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
    if ($_GET['act'] == 'null') {
        if ($enable_access) {
            F_session_extension();
            include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
        } else {
            header("404 Not Found");
            http_response_code(404);
            echo "404 Not Found";
            $log_access .= '     > Выполнение скрипта остановленно ошибкой "404 Not Found".' . PHP_EOL;
            loging($log_access);
            exit;
        }
        mysql_close($mysql_connect);
    }
?>