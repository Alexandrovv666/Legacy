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
        echo '  <div id="name-castle" onclick=\'api_window_modal_message_open("get_info_castle", 0)\'>load...</div>';
        echo '  <div id="quest" onclick=\'api_window_modal_message_open("quest", 0)\'>������.</div>';
    }
?>
    </div>
    <div class="panel-left">
      <p id="almaz" onclick='api_window_modal_message_open("buy", 0)'>load...</p>
      <div class="panel-left-navigation">
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("adminka", 0)'>���������<br>������</p>
        <p class="panel-left-navigation-element" onclick="go_to_map();">�����</p>
        <p class="panel-left-navigation-element" onclick="go_to_castle();">�����</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mission", 0)'>������</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("mail", 0)'>�����</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("settings", 0)'>���������</p>
        <p class="panel-left-navigation-element" onclick='api_window_modal_message_open("premium", 0)'>�������</p>
      </div>
    </div>
