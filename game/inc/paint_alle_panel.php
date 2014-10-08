<?
    echo '<div class="panel-up">';
    echo '  <div class="panel-up-navigation">';
    echo '    <p onclick="go_to_exit();">Exit</p>';
    echo '  </div>';
    if ($_COOKIE['ort'] == 'castle'){
        echo '  <div class="panel-up-resoorsed normal-text">';
        echo '    <p id="gold" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="tree" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="stone" class="panel-up-resoorsed-element">load...</p>';
        echo '    <p id="men" class="panel-up-resoorsed-element">load...</p>';
        echo '  </div>';
        echo '  <div id="name-castle"><a href="#window_modal_1" onclick="get_info_castle()">load...</a></div>';
        echo '  <div id="quest"><a href="#window_modal_1" onclick="get_quest()">Квесты</a></div>';
    }
    echo '</div>';
    echo '<div class="panel-left">';
    echo '  <p id="almaz">load...</p>';
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
