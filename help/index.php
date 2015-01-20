<?php
    echo '<div style="position: absolute; top: 010px; left: 50px"><b>Оглавление</b></div>';
    echo '<div style="position: absolute; top: 030px; left: 10px"><a href="index.php">Главная</a></div>';
    echo '<div style="position: absolute; top: 050px; left: 10px"><a href="index.php?site=castle">Замок</a></div>';
    echo '<div style="position: absolute; top: 070px; left: 10px"><a href="index.php?site=panel">Панель ресурсов</a></div>';
    echo '<div style="position: absolute; top: 090px; left: 10px"><a href="index.php?site=arbeit">Стройка</a></div>';
    echo '<div style="position: absolute; top: 110px; left: 10px"><a href="index.php?site=add">Добыча и расхищение ресурсов</a></div>';
    echo '<div style="position: absolute; top: 130px; left: 10px"><b>Частые проблемы</b></div>';
    echo '<div style="position: absolute; top: 150px; left: 10px"><a href="index.php?site=cookie">Проблема с куками</a></div>';
    $site = $_GET['site'];
    $out = '';
    if ($site == ''){
        $out = '<h1>Главная</h1>Добро пожаловать в энциклопедию.<br><h2>Требования к браузеру.</h2>1. Куки должны быть включены (если возникают проблемы с куками).<br>2. Ваш браузер, должен быть версии не ниже чем: ';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )  $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') )   $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') )   $out .= '3.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') )    $out .= '10.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $out .= '7.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $out .= '7.0';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $out .= '7.0';
    }
    if ($site == 'castle')
        $out = '<h1>Замок</h1>Первое что видит игрок, это свой замок.<br>Понучалу он пуст';
    if ($site == 'cookie'){
        $out = '<h1>Куки</h1>Для игры необходимо включить куки.<br><h2>Порядок включения кук для Вашего браузера</h2>';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )  $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') )   $out .= 'Зайдите в меню "настройки".<br><img src="img/chrome/1.png" width="400"><br><br>В поле поиска введите "cookie" и нажмите на кнопку "Настройки контента".<br><img src="img/chrome/2.png" width="700"><br><br>Установите переключатель как показано ниже.<br><img src="img/chrome/3.png" width="600"><br><br>';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') )   $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') )    $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $out .= '';
        if ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $out .= '';
    }
    echo '<div style="position: absolute; top: 10px; left: 350px">'.$out.'</div>';
?>