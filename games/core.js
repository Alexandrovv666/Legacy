function one(){
    if (window.LoadVar){
        document.getElementById('window-loading-window').innerHTML='<br><br>Пожалуйста, подождите<br>Полёт к замку';
        window.LoadVar=false;
    }
    {
        window.elapsed_time_from_the_start=window.elapsed_time_from_the_start+1;
        if (window.enable_scroll_map){
            if (window.elapsed_time_from_the_start>1){
                $('#cell').load("/server/castle.php");
                jQuery(document).ready(function() {jQuery.scrollTo('#Bmap_'+(localStorage.getItem("Castle_X"))+'_'+(localStorage.getItem("Castle_Y")),3666);});
                window.enable_scroll_map=false;
            }
        }
        if ((window.elapsed_time_from_the_start > 7)){
            document.getElementById('window-loading-window').innerHTML='<br><br>Пожалуйста, подождите<br>Создание планеты';
            var leftScroll = getBodyScrollLeft();
            var ClientWidth= getClientWidth();
            var topScroll = getBodyScrollTop();
            var Clientheight= getClientHeight();
            var enableBreak = false;
            var allVisibleLoaded = true;
            for (var x = 0; x <= 100; x++){
                if (enableBreak) break;
                for (var y = 0; y <= 70; y++){
//                    if (enableBreak) break;==>> Грузит РЕАЛЬНО БЫСТРЕЕ!!
                    if (document.getElementById('Bmap_'+x+'_'+y).innerHTML=='')
                        if (isIntoView('Bmap_'+x+'_'+y, leftScroll, ClientWidth, topScroll, Clientheight)){
                            $('#Bmap_'+x+'_'+y).load("/server/get.php?x="+x+"&y="+y);
                            enableBreak = true;
                            if (allVisibleLoaded)
                                allVisibleLoaded=false;//Если заполнены ВСЕ видимые, то и результиурующая тоже будет
                        }
                }
            }
            if (allVisibleLoaded){
    
             document.getElementById('window-loading').style.display = 'none';
allVisibleLoaded=false;
            }
        }
        Fresize();
    }

}
function CloseWindowsCastle(){
    document.getElementById('cell').style.display = 'none';
}