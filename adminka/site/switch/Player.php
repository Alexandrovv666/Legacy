<?
    $GlAP        = array();
    include $_SERVER['DOCUMENT_ROOT'].'/_api/admin.php';
    if ($_GET['login'] == '') {
        echo '<p id="path">Админка - Список игроков</p>';
        $list_Player = mysql_query('SELECT * FROM `users`');
        while ($GlAP[] = mysql_fetch_array($list_Player)); {
        }
        $count_player = count($GlAP) - 1;
        echo 'Всего игроков на сервере: ' . $count_player;
        echo '<table border="1"><tr><td>ID</td><td>Ник игрока</td><td>Внутренний счёт</td><td>Дата регистрации</td></tr>';
        for ($i = 0; $i < ($count_player); $i++)
            if ($GlAP[$i]['reg_time'] != 0)
                echo '<tr><td>' . $GlAP[$i]['id'] . '</td><td><a href="index.php?ort=Player&login=' . $GlAP[$i]['login'] . '">' . $GlAP[$i]['login'] . '</a></td><td>' . $GlAP[$i]['almaz'] . '</td><td>' . date("H:i:s Y-m-d", $GlAP[$i]['reg_time']) . '</td></tr>';
            else
                echo '<tr><td>' . $GlAP[$i]['id'] . '</td><td><a href="index.php?ort=Player&login=' . $GlAP[$i]['login'] . '">' . $GlAP[$i]['login'] . '</a></td><td>' . $GlAP[$i]['almaz'] . '</td><td><b><font color="#900">Testers account</font></b></td></tr>';
        echo '</table>';
    } else {
        echo '<p id="path">Админка - Информация об игроке "' . $_GET['login'] . '"</p>';
        $list_Player = mysql_query('SELECT * FROM `users` where `login`="' . $_GET['login'] . '"');
        if (mysql_num_rows($list_Player) == 0)
            echo '<html><head><meta http-equiv=Refresh content="0; url=index.php?ort=Player"></head></html>';
        $GlAP       = mysql_fetch_array($list_Player);
        $res_castle = mysql_query('SELECT id FROM `castle` where `id`="' . $GlAP['id'] . '"');
        echo '<table border="0">
                          <tr><td>Ник</td><td>' . $GlAP['login'] . '</td></tr>
                          </table>';
    }
?>
