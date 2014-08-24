var timer = 0;
/*   NAVIGATION*/
function go_to_map(){
  document.cookie="ort=map";
  window.location='';
  document.cookie="X_map="+get_cookie("X");
  document.cookie="Y_map="+get_cookie("Y");
}
function go_to_castle(){
  document.cookie="ort=castle";
  window.location='';
}
function go_to_exit(){
  if (confirm("Хотите выйти?"))
    window.location='/Exit.php';
}
function ClicMission(){
    $("#get_data_window_modal_1").load("/server/mission.php?action=mission");
}
function CMission(x){
    $("#get_data_window_modal_1").load("/server/mission.php?action=mission"+"&d="+x);
}
function ClicMail(num_page, filt){
    $("#get_data_window_modal_1").load("/server/mail.php?action=mail&num_page="+num_page+"&filt="+filt);
}
function DMail(n, x){
    $("#get_data_window_modal_1").load("/server/mail.php?action=mail&num_page="+n+"&d="+x);
}
function DAMail(n, x){
    $("#get_data_window_modal_1").load("/server/mail.php?action=mail&num_page="+n+"&type="+x);
}

function timers_room(){
    for (var i = 1; i <= 35; i++)
        if (document.getElementById("timer"+i)){
            var perem=document.getElementById("timer"+i).innerHTML;
            if (perem!=''){
                if (perem=='--:--:--:--')
                    continue;
                get_progress(i);
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
    for (var i = 1; i <= 200; i++)
        if (document.getElementById("timer_miss"+i)){
            var perem=document.getElementById("timer_miss"+i).innerHTML;
            if (perem!=''){
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
                    loadXMLDoc("mission", i);
                else{
                    document.getElementById("timer_miss"+i).innerHTML=arr[0]+":"+arr[1]+":"+arr[2]+":"+arr[3];
                }
            }
        }
}
function One(x){
    timer = timer + 1;
    if ( timer >= 1000 )
        timer = 0;
    timers_room();
    if (get_cookie('ort').indexOf('castle') + 1){
        if (timer % 15 == 1)
            loadXMLDoc("get_time_work_room", 0);
    }

}