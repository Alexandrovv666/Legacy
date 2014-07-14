<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ( $act == 'mail' ) {
        if ($_GET['d']!='')
            mysql_query('DELETE FROM `mail` WHERE `adresat` =  "' . $_COOKIE['login'] . '" and `id`="'.$_GET['d'].'"');
        if ($_GET['type']!='')
            mysql_query('DELETE FROM `mail` WHERE `adresat` =  "' . $_COOKIE['login'] . '" and `type`="'.$_GET['type'].'"');
        $count_mail_all = 0;
        $count_mail     = 0;
        $res_mail_all   = mysql_query('SELECT * FROM  `mail` WHERE  `adresat` =  "' . $_COOKIE['login'] . '"');
        $count_mail_all = mysql_num_rows($res_mail_all);
        if ($count_mail_all>0){
            if (($_GET['filt']==0) or ($_GET['filt']==''))
              $res_mail   = mysql_query('SELECT * FROM `mail` WHERE `adresat` =  "' . $_COOKIE['login'] . '"                                  ORDER BY `mail`.`time` DESC LIMIT '.(($_GET['num_page']-1)*20).',20 ');
            else
              $res_mail   = mysql_query('SELECT * FROM `mail` WHERE `adresat` =  "' . $_COOKIE['login'] . '" and `type`="'.$_GET['filt'].'" ORDER BY `mail`.`time` DESC LIMIT '.(($_GET['num_page']-1)*20).',20 ');

            $count_mail = mysql_num_rows($res_mail);
            echo $count_mail.'/'.$count_mail_all.'<br>';
            echo '<div class="scroll"><table border="1" cellpadding="0" bgcolor="F0F8F9" width="780px">';
            for ($i = 0; $i < ($count_mail); $i++) {
                $Array_mail = mysql_fetch_array($res_mail);
                $Array_mail['text'] = str_replace("_Одинарная_кавычка_", "'", $Array_mail['text']);
                $Array_mail['text'] = str_replace('_Двойная_кавычка_', '"', $Array_mail['text']);

                if (date("j",$Array_mail['time'])==date("j"))
                    echo '<tr><td><details><summary><b>'.$Array_mail['theme'].'</b>('.$Array_mail['autor'].')</summary><br>'.$Array_mail['text'].'</details></td><td width="130px">'.(date("H:i:s",$Array_mail['time'])).       '</td><td width="17px"><a onclick="DMail('.$_GET['num_page'].','.$Array_mail['id'].')">X</a></td></tr>';
                else
                    echo '<tr><td><details><summary><b>'.$Array_mail['theme'].'</b>('.$Array_mail['autor'].')</summary><br>'.$Array_mail['text'].'</details></td><td width="130px">'.(date("j.n.Y(H:i:s)",$Array_mail['time'])).'</td><td width="17px"><a onclick="DMail('.$_GET['num_page'].','.$Array_mail['id'].')">X</a></td></tr>';
            }
            echo '</table></div>';
            if ($_GET['num_page']>1)
                echo '<a onclick="ClicMail('.($_GET['num_page']-1).', '.$_GET['filt'].')"><=</a>';
            if ($_GET['num_page']<ceil($count_mail_all/20))
                echo '<a onclick="ClicMail('.($_GET['num_page']+1).', '.$_GET['filt'].')">=></a>';
            echo '<br>';
            if (($_GET['filt']==0) or ($_GET['filt']==''))
                echo 'Фильтр почты не применён.<br>';
            if ($_GET['filt']==1)
                echo 'ФИЛЬТР: Только неудачные исследования. (<a onclick="ClicMail('.($_GET['num_page']).', 0)">Выключить фильтр</a>)<br>';
            else
                echo '<a onclick="ClicMail('.($_GET['num_page']).', 1)">Фильтровать: только неудачные исследования</a><br>';
            if ($_GET['filt']==2)
                echo 'ФИЛЬТР: Только удачные исследования. (<a onclick="ClicMail('.($_GET['num_page']).', 0)">Выключить фильтр</a>)<br>';
            else
                echo '<a onclick="ClicMail('.($_GET['num_page']).', 2)">Фильтровать: только удачные исследования</a><br>';
            if ($_GET['filt']==3)
                echo 'ФИЛЬТР: Только письма о шпионаже. (<a onclick="ClicMail('.($_GET['num_page']).', 0)">Выключить фильтр</a>)<br>';
            else
                echo '<a onclick="ClicMail('.($_GET['num_page']).', 3)">Фильтровать: только письма о шпионаже</a><br>';

            echo '<hr><a onclick="DAMail('.$_GET['num_page'].',1)">Удалить неудачные отчёты исследователей</a>';
        }else
            echo '<br><br>Почта пуста.<br><br>';
    }
    FClose_mysql_connect($mysql_connect);
?>