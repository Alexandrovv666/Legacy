<?php
    if ($const_check_it_enable){
        include 'check_config.php';
        F_Loging($const_file_global_result_it_name, 'Начало блока проверки.');
        if ($const_check_MySQL_it_enable)
            include 'MySQL/check_MySQL_index.php';
    }
?> 
