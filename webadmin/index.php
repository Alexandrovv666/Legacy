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
        $log_access .='[!] -> Файл "webadmin/index.php" включили в файл "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic))
        $log_access .='[!] -> Кука login не прошла валидацию.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic))
            $log_access .='[!] -> Кука session не прошла валидацию.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> Логин в базе не числится.'.PHP_EOL;
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> Кука casX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> Кука casY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука casZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > Доступ предоставлен.'.PHP_EOL;
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