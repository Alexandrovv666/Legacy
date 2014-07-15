var V_Arr_Global_Obj = [];
var LoadVar = false;
var CorrectMapCell = true;
var elapsed_time_from_the_start = 0;
for (var x = 0; x <= 300; x++){
    V_Arr_Global_Obj[x] = [];
    for (var y = 0; y <= 300; y++){
        V_Arr_Global_Obj[x][y]=[];
        V_Arr_Global_Obj[x][y]['terrain']='';
    }
    if (x==300) LoadVar=true;
}


