<?
    if ($_COOKIE['login']==''){
        echo 'Error #000: Login is null!<br><a href="/exit.php">Relogin</a>';
        exit;
    }
    if (!(F_login_is_now($_COOKIE['login']))){
        echo 'Error #001: Incorrect Login.<br><a href="/exit.php">Relogin</a>';
        exit;
    }
?>
