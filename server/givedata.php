<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    if ($_GET['act'] == 'null') {
        $mysql_connect = F_Connect_MySQL();
        global $C_Numberic, $C_Text_noSpace;
        include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
        if ($enable_access) {
            F_session_extension();
            include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
        } //$enable_access
        else
            echo 'no;0';
        mysql_close($mysql_connect);
    } //$_GET['act'] == 'null'
?>