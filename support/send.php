<?php
    include '../FUNC.php';
    $linkss = FConnBase();
    echo '<!DOCTYPE html><title>Техническая поддержка.</title><META content="text/html; charset=utf-8" http-equiv="Content-Type">';
    $text = str_replace("\r\n", "_Перенос_строки_", $_POST['text']);
    mysql_query( 'INSERT INTO `mail`(`icon`, `zagolowok`, `text`, `date`, `autor`, `adresat`) VALUES ("0","Ответ от Администрации","' . $text . '","' . time() . '","' . "Администрация" . '","' . $_POST['nick'] . '")' );
    FClose_mysql_connect($linkss);
    echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
?>