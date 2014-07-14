<?
$log_for_mial =$log_for_mial. 'Раунд №'.$raund.' начался!<br><table border="1"><tr>';
for ($num_otr = 1; $num_otr <= 8; $num_otr++)
  $log_for_mial = $log_for_mial.'<td><table width="15px"><tr><td><img src="img/Units/army/'.$num_otr.'.png" width="40"></td></tr><tr><td><center>'.$army_1[$num_otr].'</center></td></tr></table></td>';
$log_for_mial = $log_for_mial.'</tr><tr><td colspan="8"><center><b>ПРОТИВ</b></center></td></tr>';
for ($num_otr = 1; $num_otr <= 8; $num_otr++)
  $log_for_mial = $log_for_mial.'<td>
<table width="15px"><tr><td><img src="img/Units/army/'.$num_otr.'.png" width="40"></td></tr><tr><td><center>'.$army_2[$num_otr].'</center></td></tr></table></td>';
$log_for_mial = $log_for_mial.'</tr></table><br>';
return $log_for_mial;
?>