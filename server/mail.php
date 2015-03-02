<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    $linkss = F_Connect_MySQL();
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/security_loop.php';
    F_session_extension();
    if ($_GET['action'] == 'list') {
        class class_mail {
            var $Theme;
            var $Autor;
            var $Adresat;
            var $Byte_Write;
            var $Time_In;
            var $hash;

            public function __construct( $Theme, $Autor, $Adresat, $Byte_Write, $Time_In, $hash ) {
                $this->Theme = $Theme;
                $this->Autor = $Autor;
                $this->Adresat = $Adresat;
                $this->Byte_Write = $Byte_Write;
                $this->Time_In = $Time_In;
                $this->hash = $hash;
            }
            public function class_mail_HTML_Print(  ) {
                if ($this->Byte_Write==0)
                    $this->Theme ='<b>'.$this->Theme.'</b>';
                $tag_tr = '<tr>';
                if ($this->Adresat==$this->Autor)
                    $tag_tr = '<tr bgcolor="#FAEBD7">';
                elseif ($this->Adresat=='Admin')
                    $tag_tr = '<tr bgcolor="#E6E6FA">';
                $JavaScryptCode = 'onclick="api_window_modal_message_get_data(\'server/mail.php?action=get_mail&param1='.($this->Time_In).'&param2='.($this->hash).'\')"';
                echo $tag_tr.'<td '.$JavaScryptCode.'>'.($this->Theme).'</td><td>'.date("d F   H:i:s",($this->Time_In)).'</td><td>'.F_Get_Login(($this->Autor)).'</td></tr>';
            }
        }
        $Res_mail            = mysql_query('SELECT * FROM `mail` WHERE `id_ziel`="' . (F_Get_ID($_COOKIE['login'])) . '" AND (`time_end`<"' . time() . '") AND (`delete_flag`="0") ORDER BY `time_end` DESC');
        $Array_mail          = array();
        while ($Array_mail[] = mysql_fetch_array($Res_mail)); { }
        $count_mail          = count($Array_mail) - 1;

        $Global_Mail = array( );
        for ( $i = 0; $i <= $count_mail; $i++ ) {
            $mail_Theme = $Array_mail[$i]['caption'];
            $mail_Autor = $Array_mail[$i]['id_autor'];
            $mail_Adresat = $Array_mail[$i]['id_ziel'];
            $mail_Byte_Write = $Array_mail[$i]['write_flag'];
            $mail_Time_In = $Array_mail[$i]['time_end'];
            $mail_hash = $Array_mail[$i]['hash'];
            $Global_Mail[ $i ] = new class_mail( $mail_Theme, $mail_Autor, $mail_Adresat, $mail_Byte_Write, $mail_Time_In, $mail_hash );
        }
        echo 'ok|Почта - входящие|';
        echo '<table border="1"><tr><td width="170px">Заголовок</td><td>Дата</td><td width="90px">Автор</td></tr>';
        for ( $i = 0; $i < $count_mail; $i++ ) {
            $Global_Mail[ $i ] -> class_mail_HTML_Print();
        }
        echo '</table>';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=new\')">(Написать)</text>';
    }
    if ($_GET['action'] == 'new') {
        echo 'ok|Почта - новое письмо|';
        echo '<center>Внимание!<br>В тексте письма/заголовке разрешены только символы латиницы, русского языка и цифры.<br>В слуцчае нарушения - письма доставлены не будут.<br>';
        echo 'Существуют также ограничения на длинну: 50 символов в заголовке и 500 в тексте сообщения.</center>';
        echo '<textarea id="z" cols="50" rows="1">Получатель</textarea>';
        echo '<textarea id="cap" cols="50" rows="1">Тема</textarea>';
        echo '<textarea id="txt" cols="80" rows="4">Текст</textarea>';
        echo '<text onclick="api_window_modal_message_send_data(\'server/mail.php?action=plus\',\'mail\')">Отправить</text><br><br><br>';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">Вернуться во входящие</text>';
    }
    if ($_GET['action'] == 'get_mail') {
        $num = $_GET['param1'];
        $hash = $_GET['param2'];
        class class_mail {
            var $Theme;
            var $Autor;
            var $Adresat;
            var $Text;
            var $Time_In;
            var $hash;
            public function __construct( $Theme, $Autor, $Adresat, $Text, $Time_In, $hash ) {
                $this->Theme = $Theme;
                $this->Autor = $Autor;
                $this->Adresat = $Adresat;
                $this->Text = $Text;
                $this->Time_In = $Time_In;
                $this->hash = $hash;
            }
            public function class_mail_HTML_Print(  ) {
                $this->Theme ='<center>'.$this->Theme.'</center>';
                echo 'Письмо поступило '.date("d F   H:i:s",($this->Time_In)).' от '.F_Get_Login(($this->Autor)).';';
                echo '<hr>'.$this->Theme.'<hr>'.$this->Text.'<hr><br><br><br>';
            }
        }
        $Res_mail            = mysql_query('SELECT * FROM `mail` WHERE `id_ziel`="' . (F_Get_ID($_COOKIE['login'])) . '" AND (`time_end`="' . $num . '") AND (`hash`="' . $hash . '") AND (`delete_flag`="0") ORDER BY `time_end` DESC');
                               mysql_query('UPDATE `mail` SET `write_flag`="1" WHERE `id_ziel`="' . (F_Get_ID($_COOKIE['login'])) . '" AND (`time_end`="' . $num . '") AND (`hash`="' . $hash . '")');
        $Array_mail          = array();
        while ($Array_mail[] = mysql_fetch_array($Res_mail)); { }
        $count_mail          = count($Array_mail) - 1;

        $Global_Mail = array( );
        for ( $i = 0; $i <= $count_mail; $i++ ) {
            $mail_Theme = $Array_mail[$i]['caption'];
            $mail_Autor = $Array_mail[$i]['id_autor'];
            $mail_Adresat = $Array_mail[$i]['id_ziel'];
            $mail_Text = $Array_mail[$i]['text'];
            $mail_Time_In = $Array_mail[$i]['time_end'];
            $mail_hash = $Array_mail[$i]['hash'];
            $Global_Mail[ $i ] = new class_mail( $mail_Theme, $mail_Autor, $mail_Adresat, $mail_Text, $mail_Time_In, $mail_hash );
        }
        echo 'ok|Почта - письмо|';
        if ($count_mail==0){
            echo '<center>Странно!<br>Запрошенное письмо не найдено</center>';
        }elseif ($count_mail>1)
            echo '<center>Странно!<br>Найдено более чем одно письмо...</center>';
        for ( $i = 0; $i < $count_mail; $i++ )
            $Global_Mail[ $i ] -> class_mail_HTML_Print();
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">Вернуться во входящие</text><br>';
    }
    if ($_GET['action'] == 'plus') {
        $count= mysql_num_rows(mysql_query('SELECT * FROM `mail` WHERE `id_autor`="' . (F_Get_ID($_COOKIE['login'])) . '" AND (`time_start`>"' . (time()-8) . '")'));
        if ($count>=5){
            echo 'ok|Почта - Письмо <b>НЕ</b> отправлено|';
            mysql_Close($linkss);
            exit;
        }
        $text = $_GET['txt'];
        if (!Chek_string_of_mask($_GET['cap'], $C_Text . ' ')){
            echo 'ok|Почта - Письмо <b>НЕ</b> отправлено|';
            mysql_Close($linkss);
            exit;
        }
        if (!Chek_string_of_mask($text, $C_Text . ' ')){
            echo 'ok|Почта - Письмо <b>НЕ</b> отправлено|';
            mysql_Close($linkss);
            exit;
        }
        if (strlen($_GET['cap'])>55){
            echo 'ok|Почта - Письмо <b>НЕ</b> отправлено|';
            mysql_Close($linkss);
            exit;
        }
        if (strlen($text)>512){
            echo 'ok|Почта - Письмо <b>НЕ</b> отправлено|';
            mysql_Close($linkss);
            exit;
        }
//Проверка, что это не сплошной текст и там есть-таки пробелы
        $num_space = 0;
        for ( $i = 0; $i <= strlen($text); $i++ ){
            if ($num_space<50){
                if ($text[$i]==' ')
                    $num_space = 0;
                else
                    $num_space = $num_space + 1;
            }else{
                mysql_Close($linkss);
                exit;
            }
        }
        $hash = md5 ( $_GET['cap'].$text.microtime() ).crypt($_GET['cap'].$text.microtime(), $_COOKIE['login']).$_COOKIE['login'];
        mysql_query('INSERT INTO `mail` (`time_start`, `time_end`, `caption`, `text`, `id_autor`, `id_ziel`, `hash`) VALUES 
                                ("'.time().'","'.(time()+1).'","'.($_GET['cap']).'","'.($_GET['txt']).'","'.(F_Get_ID($_COOKIE['login'])).'","'.(F_Get_ID($_GET['z'])).'", "'.($hash).'")');
        echo 'ok|Почта - Письмо отправлено|';
        echo '<text onclick="api_window_modal_message_get_data(\'server/mail.php?action=list\')">Вернуться во входящие</text>';
    }
    mysql_Close($linkss);
?>