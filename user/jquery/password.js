$(document).ready(function(){

    var actual = $(".actual").first();
    var newp = $(".new").first();
    var newp1 = $(".new1").first();
    var send = $("#sendpass");

    function verify_pass(e){
        
        if(e.val().length <= 6){
            e.css('border','2px solid red');
            e.prop('title','Try a stronger password');
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }

    function isSame(e,i){
        
        if(e.val() != i.val()){
            i.css('border','2px solid red');
            i.prop('title','Passwords aren\'t the same');
            return false;
        }else{
            i.removeAttr('title');
            i.css('border','2px solid black');
            return true;
        }
    }

    send.click(function(){
        if(verify_pass(newp) && verify_pass(newp1)){
            if(isSame(newp,newp1)){
                $.ajax({
                    url:'changepass.php',
                    method:'POST',
                    dataType:'JSON',
                    data:{
                        actual:actual.val(),
                        New:newp.val(),
                        New1:newp1.val()
                    },
                    success:function(data){
                        if(parseInt(data.toString()) == -1){
                            alert("choose a new password !")
                        }else if(parseInt(data.toString()) == 1){
                            alert("wrong password")
                        }else{
                            alert("password updated with success")
                        }
                    }
                })
            }
        }
    });

})