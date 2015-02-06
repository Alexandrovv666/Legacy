<?
    $enable_access = false;
    $log_access = '';
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
            else
                $enable_access = true;
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-casX is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-casX='.$_COOKIE['casX'].PHP_EOL;
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-casY is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-casY='.$_COOKIE['casY'].PHP_EOL;
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-casZ is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-casZ='.$_COOKIE['casZ'].PHP_EOL;
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-mapX is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-mapX='.$_COOKIE['mapX'].PHP_EOL;
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-mapY is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-mapY='.$_COOKIE['mapY'].PHP_EOL;
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> Cookie-mapZ is invalid.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Cookie-mapZ='.$_COOKIE['mapZ'].PHP_EOL;
    if (!F_IF_session()) {
        $log_access .='[!] -> Session is inactive.'.PHP_EOL;
        $enable_access = false;
    }
    $log_access .='[.] -> Session is active.'.PHP_EOL;
?>