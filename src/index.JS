var timer = 0;
function start_aut(){
    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;
    $("#get").load("autentification.php?login="+login+"&password="+password);
}
function One(){
    timer = timer + 1;
    if ( timer >= 1000 )
        timer = 0;
    if (timer % 10 == 0){
        var ssw = document.getElementById('get').innerHTML;
        if (ssw !== "")
            if (ssw.indexOf('warining') + 1){
                var sswa = ssw.split('|');
                document.getElementById('get').innerHTML="";
                document.getElementById('window').style.background="#A44";
                document.getElementById('fon-alert').style.opacity=1;
                alert(sswa[1]);
                document.getElementById('window').style.background="#4A6";
                document.getElementById('fon-alert').style.opacity=0;
            }
    }
}
