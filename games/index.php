<?php
    include '../API.php';
    $linkss = FConnBase();
    include 'inc/checkdata.php';
    F_session();
    $ID=F_Get_ID($_COOKIE['login']);
    $arr_castle = mysql_query('SELECT * FROM `castle` WHERE `id` = "'.($ID).'" LIMIT 1');
    FClose_mysql_connect($linkss);
?> 
<!DOCTYPE html>
<title>Наследие воителей</title>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="default.css">
<link rel="stylesheet" href="castle.css">
<script src="var.js"></script>
<script src="api.js"></script>
<script src="graph.js"></script>
<script src="core.js"></script>
<script src="jquery-2.1.1.js"></script>
<script src="jquery.min.js"></script>
<script src="jquery.scrollTo-1.4.3.1-min.js"></script>
<div id="site">
   <div id="window-loading">
      <div id="window-loading-fon"></div>
      <center>
         <div id="window-loading-window" class="text"><br>Пожалуйста, подождите<br>Загрузка клиента</div>
      </center>
   </div>
   <div class="panel-up">panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up | panel-up</div>
   <div id="cell"></div>
   <div id="map">
<?php
   for ($x = 0; $x <= 200; $x++)
      for ($y = 0; $y <= 300; $y++)
          echo '<div class="map_cell scroll" id="Bmap_'.$x.'_'.$y.'"></div>';
?>
   </div>
</div>
<script>setInterval(one, 1000)</script>
