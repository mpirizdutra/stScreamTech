

$(document).ready(function(){

    var time = new Date().getTime();
    $("body").on("mousemove keypress", function() {
        time = new Date().getTime();
        //alert(time);
    });

    function refresh() {

        if(new Date().getTime() - time >= 600000){
           // alert(time);

            window.location.reload(true);


        }

        else{setTimeout(refresh, 10000);}
           // var t=new Date().getTime();
            //var r=(t-time)/120;
            //alert(r+">="+60000);
            //$("div#inf").empty();
            //$("div#inf").append(r);

        }

    setTimeout(refresh, 10000);



});
