<?
    echo '<div class="panel-up">';
    echo '  <div class="panel-up-navigation">';
    echo '    <p onclick="go_to_exit();">Exit</p>';
    if ($ort == 'castle')//show first castle
        echo '    <div class="conteyner-site-castle-name">conteyner-site-castle-name</div>';
    echo '  </div>';
    if ($_COOKIE['ort'] == 'castle'){
        global $Global_array_castle;
        echo '  <div class="panel-up-resoorsed">';
        echo '    <p id="gold" class="panel-up-resoorsed-element">'.floor($Global_array_castle['gold']).'</p>';
        echo '    <p id="tree" class="panel-up-resoorsed-element">'.floor($Global_array_castle['tree']).'</p>';
        echo '    <p id="stone" class="panel-up-resoorsed-element">'.floor($Global_array_castle['stone']).'</p>';
        echo '  </div>';
        echo '  <div id="name-castle"><a href="#window_modal_1" onclick="get_info_castle()">|'.$Global_array_castle['name'].'|</a></div>';
    }
    echo '</div>';
    echo '<div class="panel-left">';
    echo '  <p id="almaz">ALMAZI</p>';
    echo '  <div class="panel-left-navigation">';
    echo '    <p class="panel-left-navigation-element" onclick="go_to_map();" title="Перейти к осмотру королевств.">MAP</p>';
    echo '    <p class="panel-left-navigation-element" onclick="go_to_castle();">Castle</p>';
    echo '    <p class="panel-left-navigation-element"><a href="#window_modal_1" onclick="ClicMission()">Mission</a></p>';
    echo '    <p class="panel-left-navigation-element"><a href="#window_modal_1" onclick="ClicMail(1,0)">Mail</a></p>';
    echo '    <p class="panel-left-navigation-element">Settings</p>';
    echo '    <p class="panel-left-navigation-element">Premium</p>';
    echo '  </div>';
    echo '</div>';
?>
