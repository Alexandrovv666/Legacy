<?php
if ($_GET['action']=='ban'){
    SetCookie("AUTOSTART", '');
    echo '<html><head><meta http-equiv=Refresh content="0; url=index.php?window=ban"></head></html>';
    exit;
}
SetCookie("Login", '');
SetCookie("session", '');
SetCookie("X", '');
SetCookie("Y", '');
SetCookie("Z", '');
SetCookie("ort", '');
SetCookie("X_map", '');
SetCookie("Y_map", '');
SetCookie("AUTOSTART", '');
echo '<html><head><meta http-equiv=Refresh content="0; url=index.php"></head></html>';
?>

