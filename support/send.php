<?php
    include '../FUNC.php';
    $linkss = FConnBase();
    echo '<!DOCTYPE html><title>����������� ���������.</title><META content="text/html; charset=utf-8" http-equiv="Content-Type">';
    $text = str_replace("\r\n", "_�������_������_", $_POST['text']);
    mysql_query( 'INSERT INTO `mail`(`icon`, `zagolowok`, `text`, `date`, `autor`, `adresat`) VALUES ("0","����� �� �������������","' . $text . '","' . time() . '","' . "�������������" . '","' . $_POST['nick'] . '")' );
    FClose_mysql_connect($linkss);
    echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
?>