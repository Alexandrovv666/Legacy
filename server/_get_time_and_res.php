<?php
$res_castle     = mysql_query('SELECT * FROM `castle` WHERE `x`="' . $_COOKIE['casX'] . '" AND `y`="' . $_COOKIE['casY'] . '" AND `z`="' . $_COOKIE['casZ'] . '" and `id`="' . F_Get_ID($_COOKIE['login']) . '"');
$arr_res_castle = mysql_fetch_array($res_castle);
$out = '';
$out.='ok;';
for ($i = 1; $i <= 35; $i++) {
  if ($arr_res_castle['c_' . $i . '_1'] <= 0) {
    $time_to_work = abs($arr_res_castle['c_' . $i . '_1']);
    if ($time_to_work != 0)
      $out.=int_to_time($time_to_work);
    else
      $out.='0:0:0:0';
  }
  if ($arr_res_castle['c_' . $i . '_1'] > 0)
    $out.='--:--:--:--';
  $out.='|';
}
$out=substr($out, 0, strlen($out)-1);//Удалить последний символ
$out.=';';
echo $out;
$Global_array_res_Junits_param = array();
$res_Junits_param              = mysql_query('SELECT * FROM `army_baze`');
while ($Global_array_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {
}
//GOLD
$summ_jalovan = 0;
for ($i = 1; $i <= 8; $i++)
  $summ_jalovan = $summ_jalovan + $Global_array_res_Junits_param[$i - 1]['Jalovan'] * $arr_res_castle['army_' . $i];
$V_gold   = $arr_res_castle['gold'];
$V_agold  = $arr_res_castle['agold'];
$V_maxres = $arr_res_castle['maxres'];
if ($V_gold > $V_maxres)
  $vorov_gold = floor((($V_gold - $V_maxres) / 100) + 1);
echo '<a class="tooltip normal-text" href="#">';
if ($vorov_gold > 0)
  echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_gold)) . '</b></font>';
else
  echo '<font color="#FFF">' . FShowNumInSpace(round($V_gold)) . '</font>';
echo '<span class="classic">Приток: ' . FShowNumInSpace($V_agold) . '/час<br>';
if ($vorov_gold > 0)
  echo 'Расхищение: ' . FShowNumInSpace($vorov_gold + 0) . '/час<br>';
if ($summ_jalovan > 0)
  echo 'Жалование: ' . FShowNumInSpace($summ_jalovan + 0) . '/час<br>';
if ($magic_add_gold > 0)
  echo 'Магия: ' . FShowNumInSpace($magic_add_gold + 0) . '/час<br>';
echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
echo '<b>ИТОГО: ' . FShowNumInSpace($V_agold - $summ_jalovan - $vorov_gold + $magic_add_gold) . '/час</b><br>|';
//TREE
$V_tree  = $arr_res_castle['tree'];
$V_atree = $arr_res_castle['atree'];
if ($V_tree > $V_maxres)
  $vorov_tree = floor((($V_tree - $V_maxres) / 100) + 1);
echo '<a class="tooltip normal-text" href="#">';
if ($vorov_tree > 0)
  echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_tree)) . '</b></font>';
else
  echo '<font color="#FFF">' . FShowNumInSpace(round($V_tree)) . '</font>';
echo '<span class="classic">Приток: ' . FShowNumInSpace($V_atree) . '/час<br>';
if ($vorov_tree > 0)
  echo 'Расхищение: ' . FShowNumInSpace($vorov_tree + 0) . '/час<br>';
if ($magic_add_tree > 0)
  echo 'Магия: ' . FShowNumInSpace($magic_add_tree + 0) . '/час<br>';
echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
echo '<b>ИТОГО: ' . FShowNumInSpace($V_atree - $vorov_tree + $magic_add_tree) . '/час</b><br>|';
//STONE
$V_stone  = $arr_res_castle['stone'];
$V_astone = $arr_res_castle['astone'];
if ($V_stone > $V_maxres)
  $vorov_stone = floor((($V_stone - $V_maxres) / 100) + 1);
echo '<a class="tooltip normal-text" href="#">';
if ($vorov_stone > 0)
  echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_stone)) . '</b></font>';
else
  echo '<font color="#FFF">' . FShowNumInSpace(round($V_stone)) . '</font>';
echo '<span class="classic">Приток: ' . FShowNumInSpace($V_astone) . '/час<br>';
if ($vorov_stone > 0)
  echo 'Расхищение: ' . FShowNumInSpace($vorov_stone + 0) . '/час<br>';
if ($magic_add_stone > 0)
  echo 'Магия: ' . FShowNumInSpace($magic_add_stone + 0) . '/час<br>';
echo 'Склад: ' . FShowNumInSpace($V_maxres) . '<br>';
echo '<b>ИТОГО: ' . FShowNumInSpace($V_astone - $vorov_stone + $magic_add_stone) . '/час</b><br>|';
//MEN
$V_Amen    = $arr_res_castle['amen'];
$V_Men     = $arr_res_castle['men'];
$V_Max_men = $arr_res_castle['max_men'];
$V_Prirost = 0;
if ($V_Men > $V_Max_men)
  $vorov_men = floor((($V_Men - $V_Max_men) / 100) + 1);
if ($V_Men < $V_Max_men)
  $V_Prirost = floor(decPrz($V_Men, 99.9))+1;
echo '<a class="tooltip normal-text" href="#">';
if ($vorov_men > 0)
  echo '<font color="#F00" class="big-text"><b>' . FShowNumInSpace(round($V_Men)) . '</b></font>';
else
  echo '<font color="#FFF">' . FShowNumInSpace(round($V_Men)) . '</font>';
echo '<span class="classic">Прирост: ' . FShowNumInSpace($arr_res_castle['amen']) . '/час<br>';
if ($V_Men >= $V_Max_men)
  echo '<p class="small-text">Жилища переполнены</p>';
if ($V_Men < $V_Max_men)
  if ($V_Men > 0)
    echo '0.1%-ый прирост: ' . FShowNumInSpace($V_Prirost) . '/час<br>';
if ($vorov_men > 0)
  echo 'Разбегание: ' . FShowNumInSpace($vorov_men + 0) . '/час<br>';
echo '<i>Максимум: ' . FShowNumInSpace($V_Max_men) . '</i><br>';
echo '<b class="big-text">ИТОГО: ' . FShowNumInSpace($V_Amen + $V_Prirost - $vorov_men) . '/час</b><br>;';
$out = '';
for ($i = 1; $i <= 8; $i++)
  $out.= $arr_res_castle['army_' . $i].'|';
$out=substr($out, 0, strlen($out)-1);//Удалить последний символ
echo $out;
?>