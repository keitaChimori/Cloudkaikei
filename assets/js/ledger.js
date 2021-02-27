var total_money = document.getElementById("money");
total = 0;
$("#data tbody tr").each(function(){
var txt = $(this).find("td").text();

info = txt.split("\n");
data = info[7];
data = data.replace("                    ", "");
data = data.replace(" ", "");
data = data.replace("円", "");
var data = Number( data );
total = total + data;
console.log(total);
});
total_money.innerHTML = total;
$(function(){
    $("#button").bind("click",function(){
        var total_money = document.getElementById("money");
        total = 0;

        var com,time1,time2;
        com = $("#inputCompany").val();
        re = new RegExp(com);

        time1 = document.getElementById("inputDate1").value
        time2 = document.getElementById("inputDate2").value
        const words1 = time1.split("-");
        const words2 = time2.split("-");
        year1 = words1[0];
        month1 = words1[1];
        day1 = words1[2];
        year2 = words2[0];
        month2 = words2[1];
        day2 = words2[2];

        $("#data tbody tr").each(function(){
            var txt = $(this).find("td").text();

            info = txt.split("\n");
            data = info[3];
            data = data.replace("                    ", "");
            time1 = time1.replace("-", "/");
            time1 = time1.replace("-", "/");
            time2 = time2.replace("-", "/");
            time2 = time2.replace("-", "/");
            flag = 1;

            if(words1 != ""){   //期間が指定されているとき
                var days1 = new Date(data);
                var days2 = new Date(time1);
                // 経過時間をミリ秒で取得
                var ms = days1.getTime() - days2.getTime();
                // ミリ秒を日付に変換(端数切捨て)
                var days3 = Math.floor(ms / (1000*60*60*24));

                var days1 = new Date(time2);
                var days2 = new Date(data);
                // 経過時間をミリ秒で取得
                var ms = days1.getTime() - days2.getTime();
                // ミリ秒を日付に変換(端数切捨て)
                var days4 = Math.floor(ms / (1000*60*60*24));

                if(days3>=0 && days4>=0){
                flag = 0;
                }
            }else{
            flag = 0;
            }

            if(flag == 0){
            if(txt.match(re) != null){
                $(this).show();

                data = info[7];
                data = data.replace("                    ", "");
                data = data.replace(" ", "");
                data = data.replace("円", "");
                var data = Number( data );
                total = total + data;
            }else{
                flag = 1;
            }
            }
            if(flag == 1){
                $(this).hide();
            }
            total_money.innerHTML = total;
        });

    });

    $("#button2").bind("click",function(){
        $("#data tr").show();
        var total_money = document.getElementById("money");
        total = 0;
        $("#data tbody tr").each(function(){
        var txt = $(this).find("td").text();

        info = txt.split("\n");
        data = info[7];
        data = data.replace("                    ", "");
        data = data.replace(" ", "");
        data = data.replace("円", "");
        var data = Number( data );
        total = total + data;
        console.log(total);
        });
        total_money.innerHTML = total;
    });
});