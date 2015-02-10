<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    global $C_Numberic, $C_Text_noSpace;
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    $linkss = F_Connect_MySQL();
    $enable_access = false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='index.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> ���� "webadmin/index.php" �������� � ���� "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
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
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
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
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > ���������� ������� ������������ ������� "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > ������ ������������.'.PHP_EOL;
    $page = $_GET['page'];
    $action = $_GET['action'];
    switch ($page) {
        case 'player':
            include '/page/'.$page.'.php';
        break;
        case 'list':
            include '/page/'.$page.'.php';
        break;
        default:
            header("Location: index.php?page=player&login=".$_COOKIE['login']);
    }
    log_admin($log_access);
    F_session_extension();
    mysql_close($linkss);
?> 