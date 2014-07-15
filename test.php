<?php
  $microtime_start_work=microtime(true);
  $newtime             =time();
  include 'API.php';
  Only_Local_IP();
  $linkss=FConnBase();
  mysql_query("UPDATE `settings` SET `Value`='1' WHERE `name_parametr`='TRANSACTION'");
  echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
  global $Wait_to_startCron, $Max_X_map, $Max_Y_map, $Max_worket_time, $AverageCountLager;
  echo '<script language = \'javascript\'> var delay = ' . $Wait_to_startCron . '; setTimeout("document.location.href=\'test.php\'", delay); </script>';
  $arr_res_work=mysql_fetch_array(mysql_query('SELECT Value FROM `settings` WHERE `name_parametr` = "work"'));
  $work        =$arr_res_work['Value'];
  if($work!=1) {
    echo 'Сервер не работает.<br>Необходимо вмешательство Архадминистратора<br>';
    FClose_mysql_connect($linkss);
    exit;
  }
  $arr_time           =mysql_fetch_array(mysql_query('SELECT Value FROM `settings` WHERE `name_parametr` = "timers"'));
  $alt_time           =$arr_time['Value'];
  $time_for_will_world=$newtime-$alt_time;
  if($time_for_will_world<1)
    exit;
  $time_for_will_world=$newtime-$alt_time+1;
  echo 'Предстоит обработать мир за ' . $time_for_will_world . ' сек.<br>';
  $GA_castle          =array();
  $GA_castle_bak      =array();
  $worket_time        =0;
  $GA_res_Junits_param=array();
  $res_Junits_param   =mysql_query('SELECT * FROM `army_baze`');
  while($GA_res_Junits_param[]=mysql_fetch_array($res_Junits_param)); {
  }
  $res_alle_castle=mysql_query('SELECT * FROM `castle`');
  while($GA_castle[]=mysql_fetch_array($res_alle_castle)); {
  }
  $count_castle  =count($GA_castle)-1;
  $GA_castle_bak =$GA_castle;




  for($alt_time=$alt_time; $alt_time<=($newtime); $alt_time++) {
    $worket_time=$worket_time+1;
    if((time()-$newtime)>$MaxTimeWorkCron)
      goto end_real_time;
    if($worket_time>$Max_worket_time)
      goto end_real_time;

    for($num_castle=0; $num_castle<$count_castle; $num_castle++) {
      $summ_jalovan=0;
      for($i=1; $i<=8; $i++)
        $summ_jalovan=$summ_jalovan+$GA_res_Junits_param[$i-1]['Jalovan']*$GA_castle[$num_castle]['army_' . $i];
      $GA_castle[$num_castle]['tree'] =$GA_castle[$num_castle]['tree']+($GA_castle[$num_castle]['atree']/3600);
      $GA_castle[$num_castle]['stone']=$GA_castle[$num_castle]['stone']+($GA_castle[$num_castle]['astone']/3600);
      $GA_castle[$num_castle]['gold'] =$GA_castle[$num_castle]['gold']+($GA_castle[$num_castle]['agold']/3600)-($summ_jalovan/3600);
      if($GA_castle[$num_castle]['tree']>$GA_castle[$num_castle]['maxres'])
        $GA_castle[$num_castle]['tree']=$GA_castle[$num_castle]['tree']-round((($GA_castle[$num_castle]['tree']-$GA_castle[$num_castle]['maxres'])/3600/100), 7);
      if($GA_castle[$num_castle]['stone']>$GA_castle[$num_castle]['maxres'])
        $GA_castle[$num_castle]['stone']=$GA_castle[$num_castle]['stone']-round((($GA_castle[$num_castle]['stone']-$GA_castle[$num_castle]['maxres'])/3600/100), 7);
      if($GA_castle[$num_castle]['gold']>$GA_castle[$num_castle]['maxres'])
        $GA_castle[$num_castle]['gold']=$GA_castle[$num_castle]['gold']-round((($GA_castle[$num_castle]['gold']-$GA_castle[$num_castle]['maxres'])/3600/100), 7);
      if($GA_castle[$num_castle]['gold']<0) {
        $rand_arm=rand(1, 8);
        if($GA_castle[$num_castle]['army_' . $rand_arm]>0)
          $GA_castle[$num_castle]['army_' . $rand_arm]=$GA_castle[$num_castle]['army_' . $rand_arm]-(1*rand(1, 5));
        $GA_castle[$num_castle]['gold']=0;
      }
      for($i=1; $i<=8; $i++)
        if($GA_castle[$num_castle]['army_' . $i]<0)
          $GA_castle[$num_castle]['army_' . $i]=0;
    }
    mysql_query('UPDATE `game`.`users` SET `almaz`=`almaz`+0.' . rand(0, 30) . ' WHERE `almaz`<10000 ');
  }
end_real_time:
  for($num_castle=0; $num_castle<$count_castle; $num_castle++) {
    $qwery='UPDATE `castle` SET `gold`="' . $GA_castle[$num_castle]['gold'] . '",`tree`="' . $GA_castle[$num_castle]['tree'] . '",`stone`="' . $GA_castle[$num_castle]['stone'] . '", `army_1`="' . $GA_castle[$num_castle]['army_1'] . '",`army_2`="' . $GA_castle[$num_castle]['army_2'] . '",`army_3`="' . $GA_castle[$num_castle]['army_3'] . '",`army_4`="' . $GA_castle[$num_castle]['army_4'] . '",`army_5`="' . $GA_castle[$num_castle]['army_5'] . '",`army_6`="' . $GA_castle[$num_castle]['army_6'] . '",`army_7`="' . $GA_castle[$num_castle]['army_7'] . '",`army_8`="' . $GA_castle[$num_castle]['army_8'] . '"';
    for($i=1; $i<=35; $i++) {
      if(($GA_castle_bak[$num_castle]['value_room_' . ($i)])!=0)
        $qwery=$qwery . ', `value_room_' . ($i) . '` = "' . $GA_castle[$num_castle]['value_room_' . ($i)] . '" ';
    }
    for($i=1; $i<=8; $i++)
      $qwery=$qwery . ', `army_' . $i . '` = "' . $GA_castle[$num_castle]['army_' . $i] . '" ';
    $qwery=$qwery . 'WHERE `x`="' . $GA_castle[$num_castle]['x'] . '" AND `y`="' . $GA_castle[$num_castle]['y'] . '" AND `z`="' . $GA_castle[$num_castle]['z'] . '"';
    mysql_query($qwery);
  }
  mysql_query('UPDATE `game`.`settings` SET `Value` = "' . ($alt_time) . '" WHERE `settings`.`name_parametr` = "timers"');
  $time_work_cron=microtime(true)-$microtime_start_work;
  echo 'Сервер отработал ', $time_work_cron, ' сек.<br>';
  echo 'Количество пользователей на сервере = ', $count_user, '.<br>Отработали ' . $worket_time . ' сек.';
  mysql_query("UPDATE `settings` SET `Value`='0' WHERE `name_parametr`='TRANSACTION'");
  FClose_mysql_connect($linkss);




?>