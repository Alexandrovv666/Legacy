<?php
echo '<script src="src/jquery.min.js"></script>
<script>
function handle_error(err) {
}
function show_map(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $("#geolocation").load("server/geolocation.php?action=get_data"+"&block=geolocation&local1="+latitude+"&local2="+longitude);
}
</script>
<script>
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(show_map, handle_error);
        document.cookie="ort=castle";
    }else
        alert("Ваш браузер НЕ поддерживается. Нам очень жаль.");
</script>
';
echo '<div id="geolocation"></div>Вы должны подтвердить запрос данных о Вашем местоположении.<br>Это является обязательным условием для игры.';
?>