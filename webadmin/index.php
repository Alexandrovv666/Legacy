<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/char.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_constant/head.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/log.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/math.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/mysql.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/_api/processe_data.php';
    $linkss = F_Connect_MySQL();
    $enable_access = false;
    $log_access = '';
    if (basename($_SERVER['PHP_SELF'])!='index.php'){
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='                                             W A R N I N G !'.PHP_EOL;
        $log_access .='------------------------------------------------------------'.PHP_EOL;
        $log_access .='[!] -> Файл "webadmin/index.php" включили в файл "'.basename($_SERVER['PHP_SELF']).'"'.PHP_EOL;
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        http_response_code(404);
        header("404 Not Found");
        exit;
    }
    if (!Chek_string_of_mask($_COOKIE['login'], $C_Text_eng . $C_Numberic))
        $log_access .='[!] -> Кука login не прошла валидацию.'.PHP_EOL;
    else{
        $log_access .= '[.] -> Login = '.$_COOKIE['login'].PHP_EOL;
        if (!Chek_string_of_mask($_COOKIE['session'], $C_Text_eng . $C_Numberic))
            $log_access .='[!] -> Кука session не прошла валидацию.'.PHP_EOL;
        else{
            $log_access .= '[.] -> Session = '.$_COOKIE['session'].PHP_EOL;
            if (!(F_login_is_now($_COOKIE['login'])))
                $log_access .='[!] -> Логин в базе не числится.'.PHP_EOL;
            else{
                $A = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
                $privelege =  $A['root'] + $A['support'] + $A['cheater'];
                if ($privelege>0)
                    $enable_access = true;
            }
        }
    }
    if (!Chek_string_of_mask($_COOKIE['casX'], $C_Numberic)) {
        $log_access .='[!] -> Кука casX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casY'], $C_Numberic)) {
        $log_access .='[!] -> Кука casY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['casZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука casZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapX'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapX не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapY'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapY не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!Chek_string_of_mask($_COOKIE['mapZ'], $C_Numberic)) {
        $log_access .='[!] -> Кука mapZ не прошла валидацию'.PHP_EOL;
        $enable_access = false;
    }
    if (!$enable_access){
        header("404 Not Found");
        http_response_code(404);
        $log_access .='     > Выполнение скрипта остановленно ошибкой "404 Not Found".'.PHP_EOL;
        log_admin($log_access);
        exit;
    }
    $log_access .='     > Доступ предоставлен.'.PHP_EOL;
    class html{
        var $out_html = '';
        var $h1_tags = '';
        var $out_html_menu = '';
        var $out_html_head = '<!DOCTYPE html><html lang="ru"><title>Admin panell</title><META http-equiv="content-type" content="text/html; charset=windows-1251"><link rel="stylesheet" href="default.css">';
        function add_html_line($text){
            $this -> out_html .= $text.'<br>';
        }
        function add_html_line_Hide($text){
            $this -> add_html_line('<small>'.$text.'</small>');
        }

        function add_submenu($text, $link){
            $this -> out_html_menu .= '<a href="index.php?page='.$link.'">'.$text.'</a><br>';
        }
        function set_head($text){
            $this -> h1_tags = '<h1>'.$text.'</h1>';
        }
        function __destruct(){
            echo ($this -> out_html_head);
            echo '<block id="menu">'.($this -> out_html_menu).'</block>';
            echo '<block id="text">'.($this -> h1_tags).($this -> out_html).'</block>';
        }
    }
    $Arr_table_privelege_of_player = mysql_fetch_array(mysql_query('SELECT * FROM `privelege` WHERE `id_user`="'.F_Get_ID($_COOKIE['login']).'" LIMIT 1'));
    $html = new html();
    $html -> add_submenu('Главная', '');
    if ($_GET['page']==''){
        $html -> set_head('Главная страница');
        $html -> add_html_line('Добро пожаловать в административную панель, <b>'. ($_COOKIE['login']) .'</b>.');
        $tmp_string = '';
        if ($Arr_table_privelege_of_player['root']==1)
            $tmp_string .= 'Админ, ';
        if ($Arr_table_privelege_of_player['support']==1)
            $tmp_string .= 'Техническая поддержка, ';
        if ($Arr_table_privelege_of_player['cheater']==1)
            $tmp_string .= 'Отдел тестирования, ';
        $tmp_string .= 'Игрок';
        $html -> add_html_line('У Вас есть права: '.$tmp_string.'.');
        $html -> add_html_line('');
    }
    $html -> add_submenu('Отдел тестирования', 'test');
    if ($_GET['page']=='test'){
        $html -> set_head('Отдел тестирования');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('У Вас нет прав на доступ к этой странице.');
            exit;
        }
        $html -> add_html_line('Пожалуйста, выбирете нужный подраздел.');
        $html -> add_submenu(' - Перечень сотрудников', 'test-list-player');
        $html -> add_submenu(' - Просмотреть задачи', 'test-view-job');
        if ($Arr_table_privelege_of_player['root']==1)
            $html -> add_submenu(' - Закрыть отдел', 'test-close');
    }
    if ($_GET['page']=='test-list-player'){
        $html -> set_head('Отдел тестирования - Список сотрудников');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('У Вас нет прав на доступ к этой странице.');
            exit;
        }
    }
    if ($_GET['page']=='test-view-job'){
        $html -> set_head('Отдел тестирования - Список задач');
        if ($Arr_table_privelege_of_player['cheater']!=1){
            $html -> add_html_line('У Вас нет прав на доступ к этой странице.');
            exit;
        }
    }
    if ($_GET['page']=='test-close'){
        $html -> set_head('Отдел тестирования - Закрытие отдела');
        if ($Arr_table_privelege_of_player['root']!=1){
            $html -> add_html_line('У Вас нет прав на доступ к этой странице.');
            exit;
        }
        $html -> add_html_line('При закрытии отдела все ранее выданные права останутся за игроками. Доступ к админ панели останется, однако в данный отдел доступ будет закрыт.');
        $html -> add_html_line('Подтвердите закрытие отдела <b><u>ЗДЕСЬ</u></b>');
    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }
    if ($_GET['page']=='*'){

    }




?>