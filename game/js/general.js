function room_time(){
    for (var i = 1; i <= 35; i++)
        if (document.getElementById("timer"+i)){
            var perem=document.getElementById("timer"+i).innerHTML;
            if (perem!=''){
                if (perem=='--:--:--:--')
                    continue;
                var arr = perem.split(':');
                arr[3] = arr[3] - 1;
                if (arr[3] < 0){
                    arr[3] = 59;
                    arr[2] = arr[2] - 1;
                }
                if (arr[2] < 0){
                    arr[2] = 59;
                    arr[1] = arr[1] - 1;
                }
                if (arr[1] < 0){
                    arr[1] = 23;
                    arr[0] = arr[0] - 1;
                }
                if (arr[0] <= -1)
                    loadXMLDoc("get_time_work_room", 0);
                else
                    document.getElementById("timer"+i).innerHTML=arr[0]+":"+arr[1]+":"+arr[2]+":"+arr[3];
            }
        }
}
function One(x){
    timer = timer + 1;
    if ( timer >= 1000 )
        timer = 0;
    room_time();
    if (get_cookie('ort').indexOf('castle') + 1)
        if (timer % 5 == 1)
            loadXMLDoc("get_time_work_room", 0);
}