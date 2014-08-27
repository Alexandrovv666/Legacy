<?php
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/log.php';
    $enable_access = true;
    global $C_Numberic, $C_Text_noSpace;
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
        loging('Попытка зайти в админку. Кука login не прошла валидацию: '.$_COOKIE['login']);
        goto access_deny;
    }
    if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic)) {
        loging('Попытка зайти в админку. Кука session не прошла валидацию: '.$_COOKIE['session']);
        goto access_deny;
    }
    $mysql_connect = F_Connect_MySQL();
    if (!F_IF_session()) {
        loging('Сессия игрока неактивна.');
        $enable_access = false;
    }
    if (!F_Is_Root_ID(F_Get_ID($_COOKIE['login']))){
        loging('Сессия игрока неактивна.');
        $enable_access = false;
    }
    if (!$enable_access){
access_deny:
        header("HTTP/1.1 418 I'm a teapot");
        echo '<html><h1>418 I\'m a teapot</h1><br><p>The HTCPCP Server is a teapot. The responding entity MAY be short and stout.</p></html>';
        exit;
    }
    loging_admin('Доступ к админке предоставлен игроку '.$_COOKIE['login'].'.');
    F_session_extension();
    
    mysql_close($mysql_connect);
?>
