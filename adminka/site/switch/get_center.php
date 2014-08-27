<?
    $GlAP        = array();
    include $_SERVER['DOCUMENT_ROOT'].'/_api/admin.php';
    if ($_GET['login'] != ''){
        if (($_GET['x'] == '') and($_GET['y'] == '') and($_GET['z'] == '')){
            echo '<p id="path">Админка - центр выдачи по игроку "' . $_GET['login'] . '"</p>';
            $list_Player = mysql_query('SELECT * FROM `users` where `login`="' . $_GET['login'] . '"');
            if (mysql_num_rows($list_Player) == 0)
                echo '<html><head><meta http-equiv=Refresh content="0; url=index.php?ort=Player"></head></html>';
            $GlAP       = mysql_fetch_array($list_Player);
            $res_castle = mysql_query('SELECT * FROM `castle` where `id`="' . $GlAP['id'] . '"');
            $a_castle   = mysql_fetch_array($res_castle);
            echo '<table border="0"><tr><td width="100px">Ник</td><td>' . $GlAP['login'] . '</td></tr><tr><td width="100px">Ник</td><td>' . $GlAP['login'] . '</td></tr></table>';
            echo '<table border="1"><tr><td width="20px">X</td><td width="20px">Y</td><td width="20px">Z</td><td width="160px">название замка</td><td width="130px">Выдать предметы</td></tr><tr><td>'.$a_castle['x'].'</td><td>'.$a_castle['y'].'</td><td>'.$a_castle['z'].'</td><td>'.$a_castle['name'].'</td><td><a href="http://legacy/adminka/index.php?location=get_center&login='.$_GET['login'].'&x='.$a_castle['x'].'&y='.$a_castle['y'].'&z='.$a_castle['z'].'">Выдать предметы</a></td></tr></table>';
        }else{
            $list_Player = mysql_query('SELECT * FROM `users` where `login`="' . $_GET['login'] . '"');
            $GlAP       = mysql_fetch_array($list_Player);
            $res_castle = mysql_query('SELECT * FROM `castle` where `id`="' . $GlAP['id'] . '"');
            $a_castle   = mysql_fetch_array($res_castle);
            echo '<p id="path">Админка - центр выдачи по игроку "' . $_GET['login'] . '" в город ['.$a_castle['x'].'-'.$a_castle['y'].'-'.$a_castle['z'].'] "'.$a_castle['name'].'"</p>';
            echo '<a href="server.php?action=get_item&adres_x='.$a_castle['x'].'&adres_y='.$a_castle['y'].'&adres_z='.$a_castle['z'].'&item=500k_res">Выдать по 500К золота, девера и камня.</a>';
        }
    }
?>
