<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/log.php';
    $enable_access = true;
    $log_admin_access = '';
    global $C_Numberic, $C_Text_noSpace;
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
        $log_admin_access .=('Incorrect login. ');
        goto access_deny;
    }else
        $log_admin_access .=('Login   => "'.$_COOKIE['login'].'". ');
    if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic)) {
        $log_admin_access .=('Incorrect session. ');
        goto access_deny;
    }else
        $log_admin_access .=('Session =>: "'.$_COOKIE['session'].'". ');
    $mysql_connect = F_Connect_MySQL();
    if (!F_IF_session()) {
        $log_admin_access .=('Session is active. ');
        $enable_access = false;
    }else
        $log_admin_access .=('Session is not active. ');
    if (!F_Is_Root_ID(F_Get_ID($_COOKIE['login']))){
        $log_admin_access .=('"'.$_COOKIE['login'].'" is deny. ');
        $enable_access = false;
    }else
        $log_admin_access .=('Access is allowe. ');
    if (!$enable_access){
access_deny:
        http_response_code(418);
        header("HTTP/1.1 418 I'm a teapot");
        $log_admin_access .=('Show message "Error 418".');
        log_admin_access($log_admin_access);
        echo '<html><h1>418 I\'m a teapot</h1><br><p>The HTCPCP Server is a teapot. The responding entity MAY be short and stout.</p></html>';
        exit;
    }else
        log_admin_access($log_admin_access);
    F_session_extension();
    include $_SERVER['DOCUMENT_ROOT'].'/adminka/site/menu.php';
    include $_SERVER['DOCUMENT_ROOT'].'/adminka/site/switch.php';
    mysql_close($mysql_connect);
?>
