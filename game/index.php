<?php
    $enable_access = true;
    $log_access = '';
    if (!($_COOKIE['casX']==$_COOKIE['mapX'])){
        $log_access .='Incorrect `COOKIE["casX"]` and `COOKIE["mapX"]`. ';
        $enable_access = false;
    }
    if (!($_COOKIE['casY']==$_COOKIE['mapY'])){
        $log_access .='Incorrect `COOKIE["casY"]` and `COOKIE["mapY"]`. ';
        $enable_access = false;
    }
    if (!($_COOKIE['casZ']==$_COOKIE['mapZ'])){
        $log_access .='Incorrect `COOKIE["casZ"]` and `COOKIE["mapZ"]`. ';
        $enable_access = false;
    }
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    global $C_Numberic, $C_Text_noSpace;
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_noSpace . $C_Numberic)) {
        $log_access .='Incorrect login. ';
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='Incorrect `COOKIE["casX"]`. ';
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='Incorrect `COOKIE["casY"]`. ';
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='Incorrect `COOKIE["casZ"]`. ';
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_noSpace . $C_Numberic)) {
        $log_access .=('Incorrect session. ');
        $enable_access = false;
    }
    include $_SERVER['DOCUMENT_ROOT'].'/_api/mysql.php';
    $linkss = F_Connect_MySQL();
    if (!(F_login_is_now($_COOKIE['login']))){
        $log_access .=('Incorrect `COOKIE["login"]`. ');
        $enable_access = false;
    }
    if (!$enable_access){
        include $_SERVER['DOCUMENT_ROOT'].'/_api/log.php';
        http_response_code(413);
        $log_access .=('Message "Error 413".');
        loging($log_access);
        exit;
    }

    include $_SERVER['DOCUMENT_ROOT'].'/_constant/head.php';
    F_session_extension();
    F_echo_html_head();
?>
<link rel="stylesheet" href="default.css">
<link rel="stylesheet" href="css\window.css">
<link rel="stylesheet" href="css\default.css">
<script src="js\v_1\jquery.min.js"></script>
<script src="js\v_1\processed.js"></script>
<script src="js\v_1\var.js"></script>
<script src="js\v_1\api.js"></script>
<script src="js\v_1\castle.js"></script>
<script src="js\v_1\general.js"></script>

<div id="fon"></div>
<?php
    include 'inc/invisible.php';
    include 'inc/paint_alle_panel.php';
    switch ($_COOKIE['ort']) {
        case 'castle':
            include 'inc/Show_Castle.php';
            break;
        case 'map':
//            function_show_map();
            break;
        default:
            echo 'Что-то пошло не так...';
    }
    mysql_close($linkss);
?> 
<script>setInterval(One, 1000)</script>