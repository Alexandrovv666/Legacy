<?php
    include '../API.php';
    include '../Constant.php';
    include 'one.php';
    if ($act == 'mails') {
        $res_mail                 = mysql_query("SELECT * FROM `mail` WHERE (`adresat` =  '" . $_COOKIE['login'] . "') and `date`=" . $_GET['x'] . " ORDER BY `mail`.`date` DESC LIMIT 1");
        $arr_mail_antwort         = mysql_fetch_array($res_mail);
        $arr_mail_antwort['text'] = str_replace("_���������_�������_", "'", $arr_mail_antwort['text']);
        $arr_mail_antwort['text'] = str_replace("_�������_�������_", '"', $arr_mail_antwort['text']);
        $text_in_WebSite          = str_replace("_�������_������_", "<br>", $arr_mail_antwort['text']);
        $text_in_Input            = str_replace("_�������_������_", "\r\n", $arr_mail_antwort['text']);
        echo '
                              <a class=" link" href="javascript:sh(\'' . $arr_mail_antwort['date'] . '\')">
                                  ' . $arr_mail_antwort['zagolowok'] . '
                              </a>
                              <div id="blabla_' . $arr_mail_antwort['date'] . '" style="display: block;">
                                  <div id="load_mail_' . $arr_mail_antwort['date'] . '">
                                      ' . $text_in_WebSite;
        echo '
        <details>
         <summary>��������</summary>
          <form action="server.php?action=mailsend"  method="post">
           <p><i>��������</i></p>
           <p><input type="text" name="adress" value="' . $arr_mail_antwort['autor'] . '"></p>
           <p><textarea rows="10" cols="45" name="texts">' . $text_in_Input . "\r\n" . "\r\n" . '����� ' . $_COOKIE['login'] . ':' . "\r\n" . '</textarea></p>
           <p><input type="submit" value="��������"></p>
          </form>
        </details>';
        echo '
                                  </div>
                              </div>';
    }
    FClose_mysql_connect($mysql_connect);
?>