<?
    include $_SERVER['DOCUMENT_ROOT'].'/_api/math.php';
    echo '<div class="conteyner-site">';
    echo '  <div class="castle-engine">';
    echo '    <div id="castle-basic-wood-0" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-1" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-2" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-3" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-4" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-5" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-6" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-wood-7" class="castle-basic-wood"></div>';
    echo '    <div id="castle-basic-stone-0" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-1" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-2" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-3" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-4" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-5" class="castle-basic-stone"></div>';
    echo '    <div id="castle-basic-stone-6" class="castle-basic-stone"></div>';
    $res_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "' . F_Get_ID($_COOKIE[ 'login' ]) . '" and `x`="'.$_COOKIE[ 'casX' ].'" and `y`="'.$_COOKIE[ 'casY' ].'" and `z`="'.$_COOKIE[ 'casZ' ].'"');
    $Global_array_castle = mysql_fetch_array($res_castle);
    $x=1;
    $y=1;
    $num_room=1;
    for ($x = 1; $x <= 5; $x++){
        for ($y = 1; $y <= 7; $y++){
            $name_room = $Global_array_castle['c_'.$num_room.'_n'];
            $time_room = $Global_array_castle['c_'.$num_room.'_1'];
            echo '<div class="castle-room castle-room-'.$y.'-x castle-room-x-'.$x.'" id="room-'.$num_room.'" onclick=\'api_window_modal_message_open("click_room",'.$num_room.')\'>';
            echo '<div class="castle-room-'.onlyNoInt($name_room).'"></div>';
            $level_room = onlyInt($name_room);
            if ($level_room!=0)
                echo '<p class="level-room normal-text">'.onlyInt($name_room).'</p>';
            echo '<div id="box-room-'.$num_room.'"></div>';
            echo '<p class="time-room" id="timer'.$num_room.'">';
            if ($time_room<0) echo int_to_time(abs($time_room));
            if ($time_room>0) echo '--:--:--:--';
            echo '</p>';
            echo '</div>';
            $num_room=$num_room+1;
        }
    }
    echo '  </div>';
    echo '  <div class="castle-army">';
    $Global_array_res_Junits_param = array();
    $res_Junits_param = mysql_query('SELECT * FROM `army_baze`');
    while ($Global_array_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {
    }
    for ($army = 1; $army <= 8; $army++)
        echo '<div id="castle-army-img-'.$army.'" class="castle-army-element"><a class="tooltip" href="#"><font color="#777" class="army-info">i</font><span class="classic">�������� ��������������:<br>����� '.$Global_array_res_Junits_param[$army - 1]['atack'].'<br>�������� '.$Global_array_res_Junits_param[$army - 1]['zdorov'].'<br>������ '.$Global_array_res_Junits_param[$army - 1]['defens'].'</span></a><p class="castle-army-count" id="arm'.$army.'">'.$Global_array_castle['army_'.$army].'</p></div>';
    echo '  </div>';
    echo '  <div class="castle-army-hidden"></div>';
    echo '</div>';
?>
