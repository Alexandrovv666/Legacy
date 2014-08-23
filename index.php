<?//PEAR style
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/mysql.php';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password);
    if (!mysql_select_db("game", $link))
        if (mysql_errno($link) == 1049){
            header("Location: install/mysql/table.php");
            exit;
        }
    mysql_Close($link);
?>
<title>Наследие воителей</title>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<script src="game/jquery.min.js"></script>
<script src="src/index.js"></script>
<link rel="stylesheet" href="default.css">
<div id="fon">
  <div id="fon-alert"></div>
</div>
  <img id="logo" src="game/img/Menu/logo.png">
<div id="window">
  <div id="link-license">
    <a href="Liz.php">Лицензионное соглашение</a>
  </div>';
<?
    if ( $_GET[ 'game' ] == 'register' ){
        echo '<div id="inputs"><a href="index.php">АВТОРИЗАЦИЯ</a></div>';
        global $ebableRegistration;
        if ($ebableRegistration)
            echo'<form action="Reg.php" method="post"><div id="pole-login">Логин:<br><input type="text" name="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password"/></div><div id="input-reg"><input type="submit" value="Зарегистрироваться!" name="Tma"/></div></form>';
    }
    else{
        echo '<div id="inputs"><a href="index.php?game=register&window=ok">РЕГИСТРАЦИЯ</a></div><div id="pole-login">Логин:<br><input type="text" name="login" id="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password" id="password"/></div><div id="input-enter" onclick="start_aut();">Войти</div>';
    }
?>
</div><div id="get"></div>
<a href="adminka/" id="hidden-aut">Run</a>
<script>setInterval(One, 50)</script>
?>