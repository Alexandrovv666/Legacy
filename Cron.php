<?php
    include 'API.php';
    Only_Local_IP();
    $links = FConnBase();
    F_TranzationUp();
    echo 'Transaction is up.<br>';
    global $Max_X_map, $Max_Y_map, $Wait_to_startCron, $Max_worket_time, $AverageCountLager;
    echo '<META http-equiv="content-type" content="text/html; charset=windows-1251">';
    echo '<script language = \'javascript\'> var delay = ' . $Wait_to_startCron . '; setTimeout("document.location.href=\'Cron.php\'", delay);</script>';
    $arr_res_work = mysql_fetch_array(mysql_query('SELECT Value FROM `settings` WHERE `name_parametr` = "work"'));
    $work         = $arr_res_work['Value'];
    if ($work != 1) {
        echo '<b>Warinng!</b> GameServer is <b>down</b>!!<br>';
        FClose_mysql_connect($links);
        exit;
    }
    echo 'GameServer is work.<br>';
    echo 'Step 1: Load MySQL data bigined.<br>';
    $arr_time        = mysql_fetch_array(mysql_query('SELECT Value FROM `settings` WHERE `name_parametr` = "timers"'));
    $alt_time        = $arr_time['Value'];
    $to_be_processed = $_SERVER['REQUEST_TIME'] - $alt_time;
    if ($to_be_processed < 2) {
        echo 'Wait...';
        exit;
    }
    $GA_castle       = array();
    $res_alle_castle = mysql_query('SELECT * FROM `castle`');
    while ($GA_castle[] = mysql_fetch_array($res_alle_castle)); {
    }
    $count_castle        = count($GA_castle) - 1;
    $GA_castle_bak       = array();
    $GA_castle_bak       = $GA_castle;
    $GA_res_Junits_param = array();
    $res_Junits_param    = mysql_query('SELECT * FROM `army_baze`');
    while ($GA_res_Junits_param[] = mysql_fetch_array($res_Junits_param)); {
    }
    echo 'Step 2. Processed game data begined.<br>';
    echo 'To be processed ' . $to_be_processed . ' second.<br>';
    $V_i = 1;
    for ($alt_time = $alt_time; $alt_time <= ($_SERVER['REQUEST_TIME']); $alt_time++) {
        echo 'Server process ' . $V_i++ . '/' . $to_be_processed . ' second: ' . $alt_time . '<br>';
        
        if ($count_castle > 0)
            for ($num_castle = 0; $num_castle < $count_castle; $num_castle++) {
                $summ_jalovan_army = 0;
                for ($i = 1; $i <= 8; $i++) {
                    $summ_jalovan += $summ_jalovan + $GA_res_Junits_param[$i - 1]['Jalovan'] * $GA_castle[$num_castle]['army_' . $i];
                    $summ_jalovan += $summ_jalovan + ($GA_res_Junits_param[$i - 1]['Jalovan'] * $GA_castle[$num_castle]['army_hidden_' . $i] * 0.5);
                }
                $GA_castle[$num_castle]['tree']  = $GA_castle[$num_castle]['tree'] + ($GA_castle[$num_castle]['atree'] / 3600);
                $GA_castle[$num_castle]['stone'] = $GA_castle[$num_castle]['stone'] + ($GA_castle[$num_castle]['astone'] / 3600);
                $GA_castle[$num_castle]['gold']  = $GA_castle[$num_castle]['gold'] + ($GA_castle[$num_castle]['agold'] / 3600) - ($summ_jalovan / 3600);
                if ($GA_castle[$num_castle]['tree'] > $GA_castle[$num_castle]['maxres'])
                    $GA_castle[$num_castle]['tree'] = $GA_castle[$num_castle]['tree'] - round((($GA_castle[$num_castle]['tree'] - $GA_castle[$num_castle]['maxres']) / 3600 / 100), 7);
                if ($GA_castle[$num_castle]['stone'] > $GA_castle[$num_castle]['maxres'])
                    $GA_castle[$num_castle]['stone'] = $GA_castle[$num_castle]['stone'] - round((($GA_castle[$num_castle]['stone'] - $GA_castle[$num_castle]['maxres']) / 3600 / 100), 7);
                if ($GA_castle[$num_castle]['men'] > $GA_castle[$num_castle]['max_men'])
                    $GA_castle[$num_castle]['men'] = $GA_castle[$num_castle]['men'] - round((($GA_castle[$num_castle]['men'] - $GA_castle[$num_castle]['max_men']) / 3600 / 100), 7);
                if ($GA_castle[$num_castle]['gold'] > $GA_castle[$num_castle]['maxres'])
                    $GA_castle[$num_castle]['gold'] = $GA_castle[$num_castle]['gold'] - round((($GA_castle[$num_castle]['gold'] - $GA_castle[$num_castle]['maxres']) / 3600 / 100), 7);
                if ($GA_castle[$num_castle]['gold'] < 0) {
                    $rand_arm = rand(1, 8);
                    if ($GA_castle[$num_castle]['army_' . $rand_arm] > 0)
                        $GA_castle[$num_castle]['army_' . $rand_arm] = $GA_castle[$num_castle]['army_' . $rand_arm] - (1 * rand(1, 5));
                    $GA_castle[$num_castle]['gold'] = 0;
                }
                for ($i = 1; $i <= 8; $i++)
                    if ($GA_castle[$num_castle]['army_' . $i] < 0)
                        $GA_castle[$num_castle]['army_' . $i] = 0;
            }
    }
end_real_time:
    for ($num_castle = 0; $num_castle < $count_castle; $num_castle++) {
        $qwery = 'UPDATE `castle` SET `gold`="' . $GA_castle[$num_castle]['gold'] . '",`tree`="' . $GA_castle[$num_castle]['tree'] . '",`stone`="' . $GA_castle[$num_castle]['stone'] . '"';
        for ($i = 1; $i <= 35; $i++)
            $qwery = $qwery . ', `c_' . $i . '_n` = "' . $GA_castle[$num_castle]['c_' . $i . '_n'] . '"';
        for ($j = 1; $j <= 8; $j++)
            for ($i = 1; $i <= 35; $i++)
                $qwery = $qwery . ', `c_' . $i . '_' . $j . '` = "' . $GA_castle[$num_castle]['c_' . $i . '_' . $j] . '" ';
        for ($i = 1; $i <= 8; $i++)
            $qwery = $qwery . ', `army_' . $i . '` = "' . $GA_castle[$num_castle]['army_' . $i] . '" ';
        $qwery = $qwery . 'WHERE `x`="' . $GA_castle[$num_castle]['x'] . '" AND `y`="' . $GA_castle[$num_castle]['y'] . '" AND `z`="' . $GA_castle[$num_castle]['z'] . '"';
        mysql_query($qwery);
    }
    
    
    mysql_query('UPDATE `game`.`settings` SET `Value` = "' . ($alt_time) . '" WHERE `settings`.`name_parametr` = "timers"');
    F_TranzationDown();
    echo 'Transaction is down.<br>';
    mysql_close($links);
    
    
    
?>