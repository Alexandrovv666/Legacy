<?php
  $microtime_start_work=microtime(true);
  $newtime             =time();
  include 'API.php';
  Only_Local_IP();
  $linkss=FConnBase();
  mysql_query("UPDATE `settings` SET `Value`='1' WHERE `name_parametr`='TRANSACTION'");
  mysql_query("SET AUTOCOMMIT=0");
  mysql_query("START TRANSACTION");
  echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
  global $Wait_to_startCron, $Max_X_map, $Max_Y_map, $Max_worket_time, $AverageCountLager;
  echo '<script language = \'javascript\'> var delay = ' . $Wait_to_startCron . '; setTimeout("document.location.href=\'test.php\'", delay); </script>';
  $count_user=mysql_num_rows(mysql_query('SELECT * FROM `users`'));
  if($count_user==1)
    mysql_query('UPDATE `privilege` SET `value`="root"');
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
  $GA_miss            =array();
  $worket_time        =0;
  $GA_res_Junits_param=array();
  $GA_kast[]          =array();
  $res_Junits_param   =mysql_query('SELECT * FROM `army_baze`');
  while($GA_res_Junits_param[]=mysql_fetch_array($res_Junits_param)); {
  }
  $res_alle_castle=mysql_query('SELECT * FROM `castle`');
  while($GA_castle[]=mysql_fetch_array($res_alle_castle)); {
  }
  $count_castle  =count($GA_castle)-1;
  $GA_castle_bak =$GA_castle;
  $res_alle_lager=mysql_query('SELECT * FROM `lager`');
  while($GA_lager[]=mysql_fetch_array($res_alle_lager)); {
  }
  $res_all_miss=mysql_query('SELECT * FROM `missions`');
  while($GA_miss[]=mysql_fetch_array($res_all_miss)); {
  }
  $count_miss  =count($GA_miss)-1;
  $res_all_kast=mysql_query('SELECT * FROM `kast`');
  while($GA_kast[]=mysql_fetch_array($res_all_kast)); {
  }
  $count_kast=count($GA_kast)-1;
  $count_user=mysql_num_rows(mysql_query('SELECT * FROM `users`'));
  if(rand(0, 60*60*2)==1) { //всреднем, каждые 2 ч на кого-то падает закл
    $id_kast              =rand(1, 2);
    $get_random_kast      =mysql_query('SELECT `time_min`, `time_max` FROM `kast_help` WHERE `ID`="' . $id_kast . '"');
    $array_get_random_kast=mysql_fetch_array($get_random_kast);
    $lang_kast            =rand($array_get_random_kast['time_min'], $array_get_random_kast['time_max']);
    mysql_query('INSERT INTO `kast`(`id_ziel`, `id_kast`, `time_start`, `time_end`) VALUES ("' . F_GetRand_IDLogin() . '", "' . $id_kast . '", "' . time() . '", "' . (time()+$lang_kast) . '")');
  }
  $count_lager=mysql_num_rows($res_alle_lager);
  if($count_lager<($Max_X_map*$Max_Y_map*$AverageCountLager)) {
    $x                                  =rand(1, $Max_X_map);
    $y                                  =rand(1, $Max_Y_map);
    $z                                  =rand(1, 105);
    $Enable_lager_spaun___count_castle  =mysql_num_rows(mysql_query('SELECT z FROM `castle` where `x`="' . $x . '" and `y`="' . $y . '" and `z`="' . $z . '"'));
    $Enable_lager_spaun___count_lager   =mysql_num_rows(mysql_query('SELECT z FROM `lager` where `x`="' . $x . '" and `y`="' . $y . '" and `z`="' . $z . '"'));
    $Enable_lager_spaun___count_missions=mysql_num_rows(mysql_query('SELECT id FROM `missions` where `k_x`="' . $x . '" and `k_y`="' . $y . '" and `k_z`="' . $z . '"'));
    if($Enable_lager_spaun___count_missions==0)
      if($Enable_lager_spaun___count_lager==0)
        if($Enable_lager_spaun___count_castle==0) {
          $Lager_level=rand(1, 3);
          $lager_Gold =0;
          $lager_Tree =0;
          $lager_Stone=0;
          $army_1     =0;
          $army_2     =0;
          $army_3     =0;
          $army_4     =0;
          $army_5     =0;
          $army_6     =0;
          $army_7     =0;
          $army_8     =0;
          switch($Lager_level) {
          case 1:
            $lager_Gold =rand(0, 500);
            $lager_Tree =rand(0, 100);
            $lager_Stone=rand(0, 50);
            $army_1     =rand(1, 5);
            $army_6     =rand(1, 1);
            break;
          case 2:
            $lager_Gold =rand(0, 1000);
            $lager_Tree =rand(0, 200);
            $lager_Stone=rand(0, 100);
            $army_1     =rand(10, 50);
            $army_2     =rand(5, 30);
            break;
          case 3:
            $lager_Gold =rand(0, 2000);
            $lager_Tree =rand(0, 400);
            $lager_Stone=rand(0, 200);
            $army_1     =rand(100, 200);
            $army_2     =rand(60, 130);
            $army_3     =rand(40, 90);
            break;
          }
          mysql_query('INSERT INTO `lager`(`x`, `y`, `z`, `level`, `gold`, `tree`, `stone`, `army_1`, `army_2`, `army_3`, `army_4`, `army_5`, `army_6`, `army_7`, `army_8`, `time_to_drop`) VALUES ("' . $x . '","' . $y . '","' . $z . '","' . $Lager_level . '","' . $lager_Gold . '","' . $lager_Tree . '","' . $lager_Stone . '","' . $army_1 . '","' . $army_2 . '","' . $army_3 . '","' . $army_4 . '","' . $army_5 . '","' . $army_6 . '","' . $army_7 . '","' . $army_8 . '", "' . (60*60*24*5+rand(0, 60*60*24*10)) . '")'); //5сут+10сут
        }
  }
  for($alt_time=$alt_time; $alt_time<=($newtime); $alt_time++) {
    $worket_time=$worket_time+1;
    if((time()-$newtime)>$MaxTimeWorkCron)
      goto end_real_time;
    if($worket_time>$Max_worket_time)
      goto end_real_time;
    mysql_query('DELETE FROM `kast` WHERE `time_end`<"' . $alt_time . '"');
    if($count_lager>10) {
      for($num_lager=0; $num_lager<$count_lager; $num_lager++) {
        if($GA_lager[$num_lager]['time_to_drop']>0)
          $GA_lager[$num_lager]['time_to_drop']=$GA_lager[$num_lager]['time_to_drop']-1;
        else
          mysql_query('DELETE FROM `see_lager` WHERE `x`="' . $GA_lager[$num_lager]['x'] . '" and `y`="' . $GA_lager[$num_lager]['y'] . '" and `z`="' . $GA_lager[$num_lager]['z'] . '"');
        if(Shans(1))
          if(Shans(1))
            if(Shans(1)) {
          if($GA_lager[$num_lager]['gold']>0)
            $GA_lager[$num_lager]['gold']=$GA_lager[$num_lager]['gold']+rand(0, 2);
          if($GA_lager[$num_lager]['tree']>0)
            $GA_lager[$num_lager]['tree']=$GA_lager[$num_lager]['tree']+rand(0, 2);
          if($GA_lager[$num_lager]['stone']>0)
            $GA_lager[$num_lager]['stone']=$GA_lager[$num_lager]['stone']+rand(0, 2);
          if(Shans(80))
            for($num_army=1; $num_army<9; $num_army++)
              if($GA_lager[$num_lager]['army_' . $num_army]>0)
                $GA_lager[$num_lager]['army_' . $num_army]=$GA_lager[$num_lager]['army_' . $num_army]+(rand(0, (9-$num_army))); //чем совершеннее существо тем меньше макс прирост
        }
      }
    }
    mysql_query('DELETE FROM `lager` WHERE `time_to_drop`="0"');
    for($num_miss=0; $num_miss<$count_miss; $num_miss++) {
      if($GA_miss[$num_miss]['time_finish']==0) {
        if($GA_miss[$num_miss]['type']=='atack_grab') {
          if($GA_miss[$num_miss]['napravlen']==1) { //вернулась атакующая миссия с грабежа
            for($num_castle=0; $num_castle<=$count_castle; $num_castle++) {
              if(($GA_castle[$num_castle]['x']==$GA_miss[$num_miss]['ist_x'])and($GA_castle[$num_castle]['y']==$GA_miss[$num_miss]['ist_y'])and($GA_castle[$num_castle]['z']==$GA_miss[$num_miss]['ist_z'])) {
                for($num_otr=1; $num_otr<9; $num_otr++)
                  $GA_castle[$num_castle]['army_' . $num_otr]=$GA_castle[$num_castle]['army_' . $num_otr]+$GA_miss[$num_miss]['army_' . $num_otr];
                $id_of_log=rand();
                loging__(' >> Start log. id=' . ($id_of_log));
                loging__(' >> ' . $id_of_log . ' >> Армия игрока [' . $GA_miss[$num_miss]['vladelez'] . '] в составе [' . $GA_miss[$num_miss]['army_1'] . '-' . $GA_miss[$num_miss]['army_2'] . '-' . $GA_miss[$num_miss]['army_3'] . '-' . $GA_miss[$num_miss]['army_4'] . '-' . $GA_miss[$num_miss]['army_5'] . '-' . $GA_miss[$num_miss]['army_6'] . '-' . $GA_miss[$num_miss]['army_7'] . '-' . $GA_miss[$num_miss]['army_8'] . '] вернулась в город [' . $GA_castle[$num_castle]['x'] . '-' . $GA_castle[$num_castle]['y'] . '-' . $GA_castle[$num_castle]['z'] . ']');
                loging__(' >> ' . $id_of_log . ' >> Конец лога');
                break;
              }
            }
          } else { //атакующая миссия добралась до цели
            for($num_lager=0; $num_lager<$count_lager; $num_lager++)
            if (($GA_miss[$num_miss]['k_x']==$GA_lager[$num_lager]['x']) and ($GA_miss[$num_miss]['k_y']==$GA_lager[$num_lager]['y']) and ($GA_miss[$num_miss]['k_z']==$GA_lager[$num_lager]['z'])){
              $id_of_log=rand();
              loging__(' >> ' . $id_of_log . ' >> Start log. id=');
              loging__(' >> ' . $id_of_log . ' >> Армия игрока [' . $GA_miss[$num_miss]['vladelez'] . '] в составе [' . $GA_miss[$num_miss]['army_1'] . '-' . $GA_miss[$num_miss]['army_2'] . '-' . $GA_miss[$num_miss]['army_3'] . '-' . $GA_miss[$num_miss]['army_4'] . '-' . $GA_miss[$num_miss]['army_5'] . '-' . $GA_miss[$num_miss]['army_6'] . '-' . $GA_miss[$num_miss]['army_7'] . '-' . $GA_miss[$num_miss]['army_8'] . '] обралась до лагеря ['.$GA_lager[$num_lager]['x'].'-'.$GA_lager[$num_lager]['y'].'-'.$GA_lager[$num_lager]['z'].']');
              loging__(' >> ' . $id_of_log . ' >> Загрузка параметров юнитов...');
              $army_1 = array();
              $army_2 = array();
              $army_1_minus = array();
              $army_2_minus = array();

              $army_1_get_uron = array();
              $army_2_get_uron = array();
              $army_1_bak = array();
              $army_2_bak = array();
              $army_1_atack = array();
              $army_2_atack = array();
              $army_1_zdorov = array();
              $army_2_zdorov = array();
              $army_1_defens = array();
              $army_2_defens = array();
              for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                $army_1[$num_otr] = $GA_miss[$num_miss]['army_' . $num_otr];
                $army_2[$num_otr] = $GA_lager[$num_lager]['army_' . $num_otr];
                $army_1_atack[$num_otr]=$GA_res_Junits_param[$num_otr-1]['atack']*$army_1[$num_otr];
                $army_2_atack[$num_otr]=$GA_res_Junits_param[$num_otr-1]['atack']*$army_2[$num_otr];
                $army_1_zdorov[$num_otr]=$GA_res_Junits_param[$num_otr-1]['zdorov']*$army_1[$num_otr];
                $army_2_zdorov[$num_otr]=$GA_res_Junits_param[$num_otr-1]['zdorov']*$army_2[$num_otr];
                $army_1_defens[$num_otr]=$GA_res_Junits_param[$num_otr-1]['defens'];
                $army_2_defens[$num_otr]=$GA_res_Junits_param[$num_otr-1]['defens'];
              }
              $army_1_prz = array();
              $army_2_prz = array();
              $army_1_bak = $army_1;
              $army_2_bak = $army_2;
include '1.php';
$log_for_mial = $log_for_mial.'<details><summary>Подробности</summary>';
              for ($raund = 1; $raund <= 200; $raund++){
loging__(' >> ' . $id_of_log . ' >> Раунд №'.$raund.' начался!');
loging__(' >> ' . $id_of_log . ' >> Армия 1:'.$army_1[1].' - '.$army_1[2].' - '.$army_1[3].' - '.$army_1[4].' - '.$army_1[5].' - '.$army_1[6].' - '.$army_1[7].' - '.$army_1[8]);
loging__(' >> ' . $id_of_log . ' >> Армия 2:'.$army_2[1].' - '.$army_2[2].' - '.$army_2[3].' - '.$army_2[4].' - '.$army_2[5].' - '.$army_2[6].' - '.$army_2[7].' - '.$army_2[8]);
                $count_army_1=0;
                $count_army_2=0;
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1_prz[$num_otr]=0;
                  $army_2_prz[$num_otr]=0;
                }
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $count_army_1=$count_army_1+$army_1[$num_otr];
                  $count_army_2=$count_army_2+$army_2[$num_otr];
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 :'.$count_army_1.' голов');
                loging__(' >> ' . $id_of_log . ' >> Армия 2 :'.$count_army_2.' голов');
include '1.php';
                if (($count_army_1<=0) or ($count_army_2<=0))
                  break;
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1_prz[$num_otr]=$army_1[$num_otr]/$count_army_1 * 100;
                  $army_2_prz[$num_otr]=$army_2[$num_otr]/$count_army_2 * 100;
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 проценты: '.$army_1_prz[1].' - '.$army_1_prz[2].' - '.$army_1_prz[3].' - '.$army_1_prz[4].' - '.$army_1_prz[5].' - '.$army_1_prz[6].' - '.$army_1_prz[7].' - '.$army_1_prz[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 проценты: '.$army_2_prz[1].' - '.$army_2_prz[2].' - '.$army_2_prz[3].' - '.$army_2_prz[4].' - '.$army_2_prz[5].' - '.$army_2_prz[6].' - '.$army_2_prz[7].' - '.$army_2_prz[8]);
                $summ_atack_of_army_1=0;
                $summ_atack_of_army_2=0;
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $summ_atack_of_army_1=$summ_atack_of_army_1+$army_1_atack[$num_otr];
                  $summ_atack_of_army_2=$summ_atack_of_army_2+$army_2_atack[$num_otr];
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 суммарная атака: '.$summ_atack_of_army_1);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 суммарная атака: '.$summ_atack_of_army_2);
                loging__(' >> ' . $id_of_log . ' >> Армия 1 сумм здоров:     '.$army_1_zdorov[1].' - '.$army_1_zdorov[2].' - '.$army_1_zdorov[3].' - '.$army_1_zdorov[4].' - '.$army_1_zdorov[5].' - '.$army_1_zdorov[6].' - '.$army_1_zdorov[7].' - '.$army_1_zdorov[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 сумм здоров:     '.$army_2_zdorov[1].' - '.$army_2_zdorov[2].' - '.$army_2_zdorov[3].' - '.$army_2_zdorov[4].' - '.$army_2_zdorov[5].' - '.$army_2_zdorov[6].' - '.$army_2_zdorov[7].' - '.$army_2_zdorov[8]);
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1_get_uron[$num_otr]=$army_1_prz[$num_otr]*$summ_atack_of_army_2/100;
                  $army_2_get_uron[$num_otr]=$army_2_prz[$num_otr]*$summ_atack_of_army_1/100;
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 готовы принять урона:'.$army_1_get_uron[1].' - '.$army_1_get_uron[2].' - '.$army_1_get_uron[3].' - '.$army_1_get_uron[4].' - '.$army_1_get_uron[5].' - '.$army_1_get_uron[6].' - '.$army_1_get_uron[7].' - '.$army_1_get_uron[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 готовы принять урона:'.$army_2_get_uron[1].' - '.$army_2_get_uron[2].' - '.$army_2_get_uron[3].' - '.$army_2_get_uron[4].' - '.$army_2_get_uron[5].' - '.$army_2_get_uron[6].' - '.$army_2_get_uron[7].' - '.$army_2_get_uron[8]);
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1_get_uron[$num_otr]=decprz($army_1_get_uron[$num_otr],$army_1_defens[$num_otr]);
                  $army_2_get_uron[$num_otr]=decprz($army_2_get_uron[$num_otr],$army_2_defens[$num_otr]);
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 урон после защиты:'.$army_1_get_uron[1].' - '.$army_1_get_uron[2].' - '.$army_1_get_uron[3].' - '.$army_1_get_uron[4].' - '.$army_1_get_uron[5].' - '.$army_1_get_uron[6].' - '.$army_1_get_uron[7].' - '.$army_1_get_uron[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 урон после защиты:'.$army_2_get_uron[1].' - '.$army_2_get_uron[2].' - '.$army_2_get_uron[3].' - '.$army_2_get_uron[4].' - '.$army_2_get_uron[5].' - '.$army_2_get_uron[6].' - '.$army_2_get_uron[7].' - '.$army_2_get_uron[8]);
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1_minus[$num_otr]=round($army_1_get_uron[$num_otr]/$GA_res_Junits_param[$num_otr-1]['zdorov']);
                  $army_2_minus[$num_otr]=round($army_2_get_uron[$num_otr]/$GA_res_Junits_param[$num_otr-1]['zdorov']);
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 умирает:'.$army_1_minus[1].' - '.$army_1_minus[2].' - '.$army_1_minus[3].' - '.$army_1_minus[4].' - '.$army_1_minus[5].' - '.$army_1_minus[6].' - '.$army_1_minus[7].' - '.$army_1_minus[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 умирает:'.$army_2_minus[1].' - '.$army_2_minus[2].' - '.$army_2_minus[3].' - '.$army_2_minus[4].' - '.$army_2_minus[5].' - '.$army_2_minus[6].' - '.$army_2_minus[7].' - '.$army_2_minus[8]);
                for ($num_otr = 1; $num_otr <= 8; $num_otr++){
                  $army_1[$num_otr] = $army_1[$num_otr]-$army_1_minus[$num_otr];
                  $army_2[$num_otr] = $army_2[$num_otr]-$army_2_minus[$num_otr];
                  if ($army_1[$num_otr]<0) $army_1[$num_otr]=0;
                  if ($army_2[$num_otr]<0) $army_2[$num_otr]=0;
                }
                loging__(' >> ' . $id_of_log . ' >> Армия 1 остатки:'.$army_1[1].' - '.$army_1[2].' - '.$army_1[3].' - '.$army_1[4].' - '.$army_1[5].' - '.$army_1[6].' - '.$army_1[7].' - '.$army_1[8]);
                loging__(' >> ' . $id_of_log . ' >> Армия 2 остатки:'.$army_2[1].' - '.$army_2[2].' - '.$army_2[3].' - '.$army_2[4].' - '.$army_2[5].' - '.$army_2[6].' - '.$army_2[7].' - '.$army_2[8]);
                loging__(' >> ' . $id_of_log . ' >> Раунд №'.$raund.' закончился!');
                loging__(' >> ' . $id_of_log . ' >> ------------------------------');
              }
$log_for_mial = $log_for_mial.'</details>';
              $log_for_mial = str_replace("'", "_Одинарная_кавычка_", $log_for_mial);
              $log_for_mial = str_replace('"', '_Двойная_кавычка_', $log_for_mial);
              F_Create_Mail($GA_miss[$num_miss]['vladelez'], 'Военачальник', 4, 'Отчёт о битве', $log_for_mial);
              loging__(' >> ' . $id_of_log . ' >> Конец лога');
            }
          }
        } //--$GA_miss[$num_miss]['type']=='atack_grab'
        if($GA_miss[$num_miss]['type']=='expedition') {
          if($GA_miss[$num_miss]['napravlen']==0) { //следак добрался до точки на карте
            if(rand(0, 100)<=60) { //60% шанс найти что-либо
              $res_lager=mysql_query('SELECT level FROM `lager` WHERE `x`="' . $GA_miss[$num_miss]['k_x'] . '" and `y`="' . $GA_miss[$num_miss]['k_y'] . '" and `z`="' . $GA_miss[$num_miss]['k_z'] . '"');
              if(mysql_num_rows($res_lager)==1) {
                $A_res_lager=mysql_fetch_array($res_lager);
                if(mysql_num_rows(mysql_query('SELECT * FROM `see_lager` WHERE `x`="' . $GA_miss[$num_miss]['k_x'] . '" and `y`="' . $GA_miss[$num_miss]['k_y'] . '" and `z`="' . $GA_miss[$num_miss]['k_z'] . '"'))==1)
                  mysql_query('UPDATE `see_lager` SET `' . ($GA_miss[$num_miss]['vladelez']) . '`=1 WHERE `x`="' . $GA_miss[$num_miss]['k_x'] . '" and `y`="' . $GA_miss[$num_miss]['k_y'] . '" and `z`="' . $GA_miss[$num_miss]['k_z'] . '"');
                else
                  mysql_query('INSERT INTO `see_lager`(`x`, `y`, `z`, `' . ($GA_miss[$num_miss]['vladelez']) . '`) VALUES ("' . $GA_miss[$num_miss]['k_x'] . '", "' . $GA_miss[$num_miss]['k_y'] . '", "' . $GA_miss[$num_miss]['k_z'] . '", 1)');
                mysql_query('INSERT INTO `mail`(`adresat`, `autor`, `time`, `type`, `theme`, `text`) VALUES ("' . $GA_miss[$num_miss]['vladelez'] . '","Исследователь","' . $alt_time . '","2","Результаты исследования(+)","На поле [' . $GA_miss[$num_miss]['k_x'] . '-' . $GA_miss[$num_miss]['k_y'] . '-' . $GA_miss[$num_miss]['k_z'] . '] обнаружен лагерь ' . $A_res_lager['level'] . ' уровня.")');
              } else //40% шанс выпал, но клетка пуста
                mysql_query('INSERT INTO `mail`(`adresat`, `autor`, `time`, `type`, `theme`, `text`) VALUES ("' . $GA_miss[$num_miss]['vladelez'] . '","Исследователь","' . $alt_time . '","1","Результаты исследования(-)","Исследователь добрался до [' . $GA_miss[$num_miss]['k_x'] . '-' . $GA_miss[$num_miss]['k_y'] . '-' . $GA_miss[$num_miss]['k_z'] . '].<br>Но он ничего не обнаружил.")');
            } else //40% шанс не выпал. всё в трубу)
              mysql_query('INSERT INTO `mail`(`adresat`, `autor`, `time`, `type`, `theme`, `text`) VALUES ("' . $GA_miss[$num_miss]['vladelez'] . '","Исследователь","' . $alt_time . '","1","Результаты исследования(-)","Исследователь добрался до [' . $GA_miss[$num_miss]['k_x'] . '-' . $GA_miss[$num_miss]['k_y'] . '-' . $GA_miss[$num_miss]['k_z'] . '].<br>Но он ничего не обнаружил.")');
            $GA_miss[$num_miss]['time_finish']=$GA_miss[$num_miss]['dlina'];
            $GA_miss[$num_miss]['napravlen']  =1;
          }
        } //--$GA_miss[$num_miss]['type']=='expedition'
      } //--$GA_miss[$num_miss]['time_finish']==0
      if($GA_miss[$num_miss]['time_finish']>-1)
        $GA_miss[$num_miss]['time_finish']=$GA_miss[$num_miss]['time_finish']-1;
      if(($GA_miss[$num_miss]['time_finish']==-1)and($GA_miss[$num_miss]['napravlen']==0)) {
        $GA_miss[$num_miss]['time_finish']=$GA_miss[$num_miss]['dlina'];
        $GA_miss[$num_miss]['napravlen']  =1;
      }
    }
    for($num_castle=0; $num_castle<$count_castle; $num_castle++) {
      if($count_kast>0) {
        for($num_kast=0; $num_kast<$count_kast; $num_kast++)
          if($GA_castle[$num_castle]['id']==$GA_kast[$num_kast]['id_ziel']) {
            switch($GA_kast[$num_kast]['id_kast']) {
            case 1:
              $GA_castle[$num_castle]['gold']=$GA_castle[$num_castle]['gold']+(200/60/60);
              break;
            case 2:
              $GA_castle[$num_castle]['gold']=$GA_castle[$num_castle]['gold']+(3000/60/60);
              break;
            }
          }
      }
      for($i=1; $i<=35; $i++) {
        if($GA_castle[$num_castle]['value_room_' . $i]!=0) {
          if($GA_castle[$num_castle]['value_room_' . ($i)]>0)
            $GA_castle[$num_castle]['value_room_' . ($i)]=$GA_castle[$num_castle]['value_room_' . ($i)]-1;
          else
            $GA_castle[$num_castle]['value_room_' . ($i)]=$GA_castle[$num_castle]['value_room_' . ($i)]+1;
        }
        if($GA_castle[$num_castle]['value_room_' . ($i)]==1) {
          $name_room=$GA_castle[$num_castle]['room_name_' . $i];
          if(onlyNoInt($name_room)=="nos")
            $GA_castle[$num_castle]['army_1']=$GA_castle[$num_castle]['army_1']+1;
          if(onlyNoInt($name_room)=="voin")
            $GA_castle[$num_castle]['army_2']=$GA_castle[$num_castle]['army_2']+1;
          if(onlyNoInt($name_room)=="kon")
            $GA_castle[$num_castle]['army_3']=$GA_castle[$num_castle]['army_3']+1;
          if(onlyNoInt($name_room)=="tank")
            $GA_castle[$num_castle]['army_4']=$GA_castle[$num_castle]['army_4']+1;
          if(onlyNoInt($name_room)=="bival")
            $GA_castle[$num_castle]['army_5']=$GA_castle[$num_castle]['army_5']+1;
          if(onlyNoInt($name_room)=="luk")
            $GA_castle[$num_castle]['army_6']=$GA_castle[$num_castle]['army_6']+1;
          if(onlyNoInt($name_room)=="lekar")
            $GA_castle[$num_castle]['army_7']=$GA_castle[$num_castle]['army_7']+1;
          if(onlyNoInt($name_room)=="naim")
            $GA_castle[$num_castle]['army_8']=$GA_castle[$num_castle]['army_8']+1;
        }
      }
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
  for($num_miss=0; $num_miss<$count_miss; $num_miss++) {
    $qwery='UPDATE `missions` SET `time_finish`="' . $GA_miss[$num_miss]['time_finish'] . '", `army_1`="' . $GA_miss[$num_miss]['army_1'] . '",`army_2`="' . $GA_miss[$num_miss]['army_2'] . '",`army_3`="' . $GA_miss[$num_miss]['army_3'] . '",`army_4`="' . $GA_miss[$num_miss]['army_4'] . '",`army_5`="' . $GA_miss[$num_miss]['army_5'] . '",`army_6`="' . $GA_miss[$num_miss]['army_6'] . '",`army_7`="' . $GA_miss[$num_miss]['army_7'] . '",`army_8`="' . $GA_miss[$num_miss]['army_8'] . '",`res1`="' . $GA_miss[$num_miss]['res1'] . '",`res2`="' . $GA_miss[$num_miss]['res2'] . '",`res3`="' . $GA_miss[$num_miss]['res3'] . '",`men`="' . $GA_miss[$num_miss]['men'] . '",`almaz`="' . $GA_miss[$num_miss]['almaz'] . '", `napravlen`="' . $GA_miss[$num_miss]['napravlen'] . '",`time_help`="' . $GA_miss[$num_miss]['time_help'] . '" WHERE `id`="' . $GA_miss[$num_miss]['id'] . '"';
    mysql_query($qwery);
  }
  mysql_query('DELETE FROM `missions` WHERE `napravlen`="1" AND `time_finish`="-1"');
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
  for($num_lager=0; $num_lager<$count_lager; $num_lager++)
    mysql_query('UPDATE `lager` SET `time_to_drop`="' . $GA_lager[$num_lager]['time_to_drop'] . '",`gold`="' . $GA_lager[$num_lager]['gold'] . '",`tree`="' . $GA_lager[$num_lager]['tree'] . '",`stone`="' . $GA_lager[$num_lager]['stone'] . '",`army_1`="' . $GA_lager[$num_lager]['army_1'] . '",`army_2`="' . $GA_lager[$num_lager]['army_2'] . '",`army_3`="' . $GA_lager[$num_lager]['army_3'] . '",`army_4`="' . $GA_lager[$num_lager]['army_4'] . '",`army_5`="' . $GA_lager[$num_lager]['army_5'] . '",`army_6`="' . $GA_lager[$num_lager]['army_6'] . '",`army_7`="' . $GA_lager[$num_lager]['army_7'] . '",`army_8`="' . $GA_lager[$num_lager]['army_8'] . '" WHERE `x`="' . $GA_lager[$num_lager]['x'] . '" AND `y`="' . $GA_lager[$num_lager]['y'] . '" and `z`="' . $GA_lager[$num_lager]['z'] . '"');
  mysql_query('UPDATE `game`.`settings` SET `Value` = "' . ($alt_time) . '" WHERE `settings`.`name_parametr` = "timers"');
  $time_work_cron=microtime(true)-$microtime_start_work;
  echo 'Сервер отработал ', $time_work_cron, ' сек.<br>';
  if(!(mysql_table_seek("speed", "game")))
    mysql_query('CREATE TABLE IF NOT EXISTS `speed` (  `time` int(11) NOT NULL,  `count_player` int(11) NOT NULL,  `time_work_int_ms` int(11) NOT NULL,  `MySQLCommitSystem` tinyint(1) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
  echo 'Количество пользователей на сервере = ', $count_user, '.<br>Отработали ' . $worket_time . ' сек.';
  if($count_user>3)
    mysql_query('INSERT INTO `speed`(`time`, `count_player`, `time_work_int_ms` ) VALUES ("' . time() . '","' . $count_user . '","' . floor($time_work_cron/$time_for_will_world*1000) . '")');
  mysql_query("COMMIT");//ROLLBACK   COMMIT
  mysql_query("SET AUTOCOMMIT=1");
  mysql_query("UPDATE `settings` SET `Value`='0' WHERE `name_parametr`='TRANSACTION'");
  FClose_mysql_connect($linkss);




?>