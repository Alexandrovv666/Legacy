<?
    include '../API.php';
    Only_Local_IP();
    include 'API.php';
    $linkss = FConnBase();
    switch ($_GET['action']) {
        case 'delete_player':
            if (F_login_is_now($_GET['login'])){
                $id=F_Get_ID($_GET['login']);
                mysql_query('DELETE FROM `users` WHERE `login`="'.$_GET['login'].'"');
                mysql_query('DELETE FROM `castle` WHERE `id`="'.$id.'"');
                mysql_query('DELETE FROM `kast` WHERE `login_ziel`="'.$id.'"');
                mysql_query('ALTER TABLE `see_lager` DROP "'.$_GET['login'].'"');
                echo '+';
            }
            break;
    }
    echo '<html><head><meta http-equiv=Refresh content="0; url='.$_SERVER['HTTP_REFERER'].'"></head></html>';
    FClose_mysql_connect($linkss);
?>