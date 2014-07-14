<?//PEAR style
    include 'API.php';
    include 'Constant.php';
    $link = mysql_connect("192.168.0.66", "root", "");
    if (!mysql_select_db("game", $link))
        if (mysql_errno($link) == 1049){
            header("Location: install/craetetable.php");
            exit;
        }

//    mysql_table_seek($tablename, $dbname);
    FClose_mysql_connect($link);
    echo '<META http-equiv="content-type" content="text/html; charset=windows-1251"><script src="game/jquery.min.js"></script><script src="src/index.js"></script><link rel="stylesheet" href="default.css"><title>Наследие воителей</title><div id="fon"><div id="fon-alert"></div></div><div id="logo"><img src="game/img/Menu/logo.png"></div><div id="window"><div id="link-license"><a href="Liz.php">Лицензионное соглашение</a></div>';
    if ( $_GET[ 'game' ] == 'register' ){
        echo '<div id="inputs"><a href="index.php">АВТОРИЗАЦИЯ</a></div>';
        global $ebableRegistration;
        if ($ebableRegistration)
            echo'<form action="Reg.php" method="post"><div id="pole-login">Логин:<br><input type="text" name="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password"/></div><div id="input-reg"><input type="submit" value="Зарегистрироваться!" name="Tma"/></div></form>';
    }
    else{
        echo '<div id="inputs"><a href="index.php?game=register&window=ok">РЕГИСТРАЦИЯ</a></div><div id="pole-login">Логин:<br><input type="text" name="login" id="login"/></div><div id="pole-password">Пароль:<br><input type="password" name="password" id="password"/></div><div id="input-enter" onclick="start_aut();">Войти</div>';
    }
    echo '</div><div id="get"></div>';
    echo '<script>setInterval(One, 50)</script>';
?>