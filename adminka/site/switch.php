<div id="content">
<?
    include $_SERVER['DOCUMENT_ROOT'].'/_constant/adminka.php';
    global $c_array_adminka_location;
    if (!in_array($_GET['location'], $c_array_adminka_location)){
        loging('Игрок "'.$_COOKIE['login'].'" вручную писал get-запрос location.: '.$_GET['location']);
        exit;
    }
    switch ($_GET['location']) {
        case 'Player':
            include $_SERVER['DOCUMENT_ROOT'].'/adminka/site/switch/Player.php';
            break;
        case 'get_center':
            include $_SERVER['DOCUMENT_ROOT'].'/adminka/site/switch/get_center.php';
            break;

        case 'castle':
            $GlobalArrCastle = array();
            $linkss = FConnBase();
            $list_Castle = mysql_query('SELECT * FROM `castle` where `id`="'.$_GET['id'].'"');
            FClose_mysql_connect($linkss);
            $count_Castle = mysql_num_rows($list_Castle);
            while ($GlobalArrCastle[] = mysql_fetch_array($list_Castle)); {}
            echo '<table border="1"><tr><td>X</td><td>Y</td><td>Z</td><td>Название</td><td>Девиз</td><td>Статус</td></tr>';
            $num_castle = 0;
            for ($num_castle = 0; $num_castle < ($count_Castle); $num_castle++)
                echo '<tr><td>'.$GlobalArrCastle[$num_castle]['x'].'</td><td>'.$GlobalArrCastle[$num_castle]['y'].'</td><td>'.$GlobalArrCastle[$num_castle]['z'].'</td><td>'.$GlobalArrCastle[$num_castle]['name'].'</td><td>???</td><td>???</td></tr>';
            echo '</table>';
            break;
        default:
            include $_SERVER['DOCUMENT_ROOT'].'/adminka/site/switch/default.php';
            break;
    }
?>
</div>