$(document).ready(function(){
    var send = $("#send");
    var from = $("#from");
    var To = $("#to");

    function valid(e){
        var date = new Date(e.val());
        

        if(date.toString() == "Invalid Date"){
            e.css("border","2px solid red");
            e.prop("title","Shouldn't be empty");
            return false;
        }else{
            e.css("border","2px solid black");
            e.removeAttr("title");
            return true;
        }
    }

    function isvalid(){
        if(valid(from) && valid(To)){
            var f = new Date(from.val());
            var t = new Date(To.val());
            var today = new Date();
            var to = today.toString().split(" ");
            var to1 = [to[1],to[2],to[3]];
            to1 = to1.join();
            
            var fo = f.toString().split(" ");
            var fo1 = [fo[1],fo[2],fo[3]];
            fo1 = fo1.join();

            if(f > t){
                from.css("border","2px solid red");
                from.prop("title","Should be less than the end date !");
                return false;
            }if(today > f){
                if(to1 != fo1){
                    from.css("border","2px solid red");
                    from.prop("title","Should be greater than or equals today's date !");
                    return false;
                }else{
                    return true;
                }
            }else{
                from.css("border","2px solid black");
                from.removeAttr("title");
                return true;
            }

            

        }else{
            return false;
        }
    }

    send.click(function(e){
        if(!isvalid()){
           /* var f = $("#from").val();
            $.ajax({
                url:'',
                type:'POST',
                dataType:'JSON',
                data:{
                    start:f
                },success:function(data){

                }
            });*/
            e.preventDefault();
        }       
    });
});