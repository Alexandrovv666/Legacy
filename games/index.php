<?php
    include '../API.php';
    $linkss = FConnBase();
    include 'inc/checkdata.php';
    F_session();
    FClose_mysql_connect($linkss);
?> 
<!DOCTYPE html>
<title>Наследие воителей</title>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="default.css">
<script src="var.js"></script>
<script src="api.js"></script>
<script src="core.js"></script>
<script src="jquery-2.1.1.js"></script>
<div id="LocalDatabase">
</div>
<div class="panel-up">
  <div class="panel-up-navigation">
  </div>
</div>
<div id="map">
<?php
   for ($x = 0; $x <= 300; $x++)
      for ($y = 0; $y <= 300; $y++)
          echo '<div class="map_cell" id="map_'.$x.'_'.$y.'"></div>';
?> 
</div>
<div id="castle"></div>
<script>setInterval(one, 1000)</script>