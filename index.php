<?php
    //PEAR style
    //SECURITY TAB
    if (basename($_SERVER['PHP_SELF']) != 'index.php') {
        http_response_code(404);
        header("404 Not Found");
        exit;
    } //basename($_SERVER['PHP_SELF']) != 'index.php'
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password) or die(mysql_error());
    if (!mysql_select_db("game", $link))
        if (mysql_errno($link) == 1049) {
            header("Location: install/mysql/table.php");
            exit;
        } //mysql_errno($link) == 1049
    mysql_Close($link);
    SetCookie("test", 'yes');
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/gameserver.php';
    global $C_Lang_Project, $C_index_action_Project;
    if (!in_array($_GET['game'], $C_index_action_Project)) {
        header('Location: index.php?game=aut');
        exit;
    } //!in_array($_GET['game'], $C_index_action_Project)
    F_echo_html_head();
    echo '<script src="js/main.js"></script><script src="js/jquery.min.js"></script><link rel="stylesheet" href="default.css"><div id="fon"><div id="fon-alert"></div></div><img id="logo" src="img/Menu/logo.png"><div id="window"><div id="link-license"><a href="Liz.php">Лицензионное соглашение</a></div>';
    if ($_GET['game'] == 'reg')
        echo '<div id="inputs"><a href="index.php?game=aut">Авторизация</a></div><form action="Reg.php" method="post"><div id="pole-login">Логин:<br><input type="text" name="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password"/></div><div id="input-reg"><input type="submit" value="Зарегистрироваться" name="Tma"/></div></form>';
    else
        echo '<div id="inputs"><a href="index.php?game=reg&window=ok">Регистрация</a></div><div id="pole-login">Логин:<br><input type="text" name="login" id="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password" id="password"/></div><div id="input-enter" onclick="start_aut();">Войти</div>';
?>
</div><div id="get"></div>
<a href="adminka/" id="hidden-aut">Run</a>
<script>setInterval(One, 50)</script>