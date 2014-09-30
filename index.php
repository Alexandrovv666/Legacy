<?//PEAR style
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/head.php';
    global $C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password;
    $link = mysql_connect($C_MySQL_Host, $C_MySQL_login, $C_MySQL_Password)or die(mysql_error());
    if (!mysql_select_db("game", $link))
        if (mysql_errno($link) == 1049){
            header("Location: install/mysql/table.php");
            exit;
        }
    mysql_Close($link);
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/gameserver.php';
    global $C_Lang_Project, $C_index_action_Project;
    if (!in_array($_GET['lang'], $C_Lang_Project)){
        header("Location: index.php?lang=rus");
        exit;
    }
    if (!in_array($_GET['game'], $C_index_action_Project)){
        header('Location: index.php?lang='.$_GET['lang'].'&game=aut');
        exit;
    }
    include $_SERVER['DOCUMENT_ROOT'].'/_lang/'.$_GET['lang'].'.php';
    F_echo_html_head();
    echo '<script src="src/index.js"></script><script src="game/js/jquery.min.js"></script><link rel="stylesheet" href="default.css"><div id="fon"><div id="fon-alert"></div></div><img id="logo" src="game/img/Menu/logo.png"><div id="window"><div id="link-license"><a href="Liz.php">'.$C_lang_licenze.'</a></div>';
    if ( $_GET[ 'game' ] == 'reg' )
        echo '<div id="inputs"><a href="index.php?lang='.$_GET['lang'].'&game=aut">'.$C_lang_aut_buttom.'</a></div><form action="Reg.php" method="post"><div id="pole-login">'.$C_lang_caption_login.':<br><input type="text" name="login"/></div><div id="pole-password">'.$C_lang_caption_password.':<br><input type="password" name="password"/></div><div id="input-reg"><input type="submit" value="'.$C_lang_butom_registration.'" name="Tma"/></div></form>';
    else
        echo '<div id="inputs"><a href="index.php?game=reg&window=ok&lang='.$_GET['lang'].'">'.$C_lang_reg_buttom.'</a></div><div id="pole-login">'.$C_lang_caption_login.':<br><input type="text" name="login" id="login"/></div><div id="pole-password">'.$C_lang_caption_password.':<br><input type="password" name="password" id="password"/></div><div id="input-enter" onclick="start_aut();">'.$C_lang_butom_autoriz.'</div>';
?>
</div><div id="get"></div>
<?
echo '<a href="index.php?lang=rus&game='.$_GET['game'].'"><img class="lang" src="game/img/menu/lang/rus.bmp" id="lang-rus"></a>';
echo '<a href="index.php?lang=eng&game='.$_GET['game'].'"><img class="lang" src="game/img/menu/lang/eng.bmp" id="lang-eng"></a>';
?>
<a href="adminka/" id="hidden-aut">Run</a>
<script>setInterval(One, 50)</script>
?>