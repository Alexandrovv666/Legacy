<?php
    //switch ($page) case 'player':
    $item = $_GET['item'];
    switch ($item) {
        case 'ip_adress':
            include 'list/'.$item.'.php';
            break;
        case 'aut_history':
            include 'list/'.$item.'.php';
            break;
        case 'none':
            include 'list/'.$item.'.php';
            break;
        case 'support':
            include 'list/'.$item.'.php';
            break;
        case 'cheater':
            include 'list/'.$item.'.php';
            break;
        case 'admin':
            include 'list/'.$item.'.php';
            break;
        default:
            header("Location: index.php?page=player&login=" . $_COOKIE['login']);
    }
?> 