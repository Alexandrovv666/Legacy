<?php
    include 'API.php';
    include 'Constant.php';
    $linkss = FConnBase();
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lavka","Комната торговца","Повышает приток золота в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("lesop","Комната лесника","Повышает приток древисины в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("kamen","Комната каменщика","Повышает приток камня в замке")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("sklad","Складская комната","Служит для хранения ресурсов")');
    mysql_query('INSERT INTO `haus_const`(`name`, `name_rus`, `descr_rus`) VALUES 
                ("treasury","Сокровещница","Хранит магические предметы")');



?> 
