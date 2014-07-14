<?
    echo '<div id="window_modal_1" class="modalDialog"><div><a href="#close" title="Закрыть" class="close" onclick="reset_window_modal_1()">X</a><div id="get_data_window_modal_1"><img src="Img/interface/other/loading.gif" width="34px"></div></div></div>';
    if ($_COOKIE['ort'] == 'map')
        echo '<div id="Window_map_click" class="modalDialog"><div><a href="#close" title="Закрыть" class="close" onclick="resetWindow_map_click()">X</a><h2><div id="map_ziel">map_ziel</div></h2><h3><div id="info_mission">info_mission</div></h3><div align="right"><div id="map_time_to_ziel">map_time_to_ziel</div></div><div id="button_box"><div id="variants_mission"><img src="Img/interface/other/loading.gif" width="34px"></div></div><div id="Window_box"></div></div></div>';
    echo '<div id="ping"></div>';
?>

