<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    $mysql_connect = F_Connect_MySQL();
    global $C_Numberic, $C_Text_noSpace;
    $enable_access=false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='givedata.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> ���� "givedata.php" �������� � ���� "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        loging($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    $log_access = '';
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic))
        $log_access .='[!] -> ���� login �� ������ ���������.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic))
            $log_access .='[!] -> ���� session �� ������ ���������.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> ����� � ���� �� ��������.'.PHP_EOL;
            else
                $enable_access = true;
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> ���� casX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> ���� casY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� casZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapX �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapY �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> ���� mapZ �� ������ ���������'.PHP_EOL;
        $enable_access = false;
    }
    if ($_GET['act'] == 'null') {
        if ($enable_access) {
            F_session_extension();
            include $_SERVER['DOCUMENT_ROOT'] . '/server/_get_time_and_res.php';
        }
        else{
            header("404 Not Found");
            http_response_code(404);
            echo "404 Not Found";
            $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
            loging($log_access);
            exit;
        }
        mysql_close($mysql_connect);
    }
?>