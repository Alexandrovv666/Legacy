<?
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'].'/_api/processe_data.php';
    global $C_Text_noSpace, $C_Numberic;
    if (!Chek_string_of_mask($_COOKIE['login'],($C_Numberic.$C_Text_noSpace))){
        header("Location: /index.php");
        exit;
    }
    if (!(F_login_is_now($_COOKIE['login']))){
        echo 'Error #001: Incorrect Login.<br><a href="/exit.php">Relogin</a>';
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['session'],($C_Numberic.$C_Text_noSpace))){
        header("Location: /index.php");
        exit;
    }
?>
