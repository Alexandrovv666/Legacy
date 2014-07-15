function one(){
    if (window.LoadVar){
        if (window.CorrectMapCell){
            for (var x = 0; x <= 300; x++)
                for (var y = 0; y <= 300; y++)
                    if(document.getElementById('map_'+x+'_'+y)){
                        var posit = document.getElementById('map_'+x+'_'+y); 
                        posit.style.left=((51*x)+'px');
                        posit.style.top =((40+(51*y))+'px');
                    }
            window.CorrectMapCell=false;
$.ajax({type: "POST",url: "/server/coord.php",data: "login="+get_cookie('login')+"&line=x",success: function(msg){
localStorage.setItem("Castle_X", msg);
}});
$.ajax({type: "POST",url: "/server/coord.php",data: "login="+get_cookie('login')+"&line=y",success: function(msg){
localStorage.setItem("Castle_Y", msg);
}});

        }
    }else{
        window.elapsed_time_from_the_start=window.elapsed_time_from_the_start+1;
        if (window.elapsed_time_from_the_start==4){//Спустя 4 секунды переместим окно игрока к своему замку на карте

        }
    }
}
