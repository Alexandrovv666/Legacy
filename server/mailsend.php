<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'mailsend') {
        echo '<META content="text/html; charset=utf-8" http-equiv="Content-Type">';
        $text = $_POST['texts'];
        $text = str_replace("'", "_���������_�������_", $text);
        $text = str_replace('"', "_�������_�������_", $text);
        $text = str_replace("\r\n", "_�������_������_", $text);
        mysql_query('INSERT INTO `mail`(`icon`, `zagolowok`, `text`, `date`, `autor`, `adresat`) VALUES ("1","��������� �� ' . $_COOKIE['login'] . '","' . $text . '","' . time() . '","' . $_COOKIE['login'] . '","' . $_POST['adress'] . '")');
        echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
    }
    FClose_mysql_connect($mysql_connect);
?>