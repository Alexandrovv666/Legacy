<?
    echo '<link rel="stylesheet" href="map.css"><script src="map.js"></script>';
    include 'inc/show_map/show_terrain.php';
    echo '<div class="conteyner-site"><div class="castle-engine">';
    $x=1;
    $y=1;
    global $EnableSeeAllLager;
    $Global_array_castle          = array();
    $res_all_castle               = mysql_query('SELECT x, y, z FROM `castle` WHERE `x` ="' . $_COOKIE['X_map'] . '" AND `y` ="' . $_COOKIE['Y_map'] . '"');
    while ($Global_array_castle[] = mysql_fetch_array($res_all_castle)); {}
    $count_castle                 = count($Global_array_castle) - 1;

    $Global_array_map          = array();
    $res_all_map               = mysql_query('SELECT * FROM `map` WHERE `x` ="' . $_COOKIE['X_map'] . '" AND `y` ="' . $_COOKIE['Y_map'] . '"');
    while ($Global_array_map[] = mysql_fetch_array($res_all_map)); {}
    $count_map                 = count($Global_array_map) - 1;

    $Global_array_lager          = array();
    if ($EnableSeeAllLager)
        $res_all_lager               = mysql_query('SELECT * FROM `lager` WHERE `x` ="' . $_COOKIE['X_map'] . '" AND `y` ="' . $_COOKIE['Y_map'] . '"');
    else
        $res_all_lager               = mysql_query('SELECT * FROM `see_lager` WHERE `x` ="' . $_COOKIE['X_map'] . '" AND `y` ="' . $_COOKIE['Y_map'] . '" AND `'.($_COOKIE['login']).'`="1"');
    while ($Global_array_lager[] = mysql_fetch_array($res_all_lager)); {}
    $count_lager                 = count($Global_array_lager) - 1;
    for ($x = 1; $x <= 7; $x++)
        for ($y = 1; $y <= 15; $y++){
            for ($num_map = 0; $num_map <= $count_map; $num_map++)
                if ($Global_array_map[$num_map]['z']==(($x*15-15)+$y))
                    echo '<a href="#Window_map_click" onclick="Click_map('.(($x*15-15)+$y).')">
<div class="map-cell map-cell-'.$x.'-x map-cell-x-'.$y.' '.function_show_terrain($Global_array_map[$num_map]['terrain']).'">'.(($x*15-15)+$y);
            if ($count_castle>0){
                for ($num_castle = 0; $num_castle <= $count_castle; $num_castle++)
                    if ($Global_array_castle[$num_castle]['z']==(($x*15-15)+$y))
                        echo '<p class="castle"></p>';
            }
            if ($count_lager>0)
                for ($num_lager = 0; $num_lager <= $count_lager; $num_lager++)
                    if ($Global_array_lager[$num_lager]['z']==(($x*15-15)+$y)){
                        $arr_res_lager = mysql_fetch_array(mysql_query('SELECT level FROM `lager` WHERE `x` ="' . $_COOKIE['X_map'] . '" AND `y` ="' . $_COOKIE['Y_map'] . '" AND `z` ="' . (($x*15-15)+$y) . '"'));
                        echo '<p class="lager"><p class="lager-name">Лагерь<br>['.$arr_res_lager['level'].']</p></p>';
                    }
            echo '</div></a>';
        }
    echo '</div></div>';
    global $Max_X_map, $Max_Y_map;
    if ($_COOKIE['Y_map']!=1)
        echo '<div class="map-navigation-elements" id="map-navigation-element-8" onclick="go_to_cell(8, '.($_COOKIE['Y_map']-1).')"></div>';
    if ($_COOKIE['X_map']!=1)
        echo '<div class="map-navigation-elements" id="map-navigation-element-4" onclick="go_to_cell(4, '.($_COOKIE['X_map']-1).')"></div>';
    if ($Max_X_map!=$_COOKIE['X_map'])
        echo '<div class="map-navigation-elements" id="map-navigation-element-6" onclick="go_to_cell(6, '.($_COOKIE['X_map']+1).')"></div>';
    if ($_COOKIE['Y_map']!=$Max_Y_map)
        echo '<div class="map-navigation-elements" id="map-navigation-element-2" onclick="go_to_cell(2, '.($_COOKIE['Y_map']+1).')"></div>';

?>
