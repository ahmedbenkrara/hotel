$(document).ready(function(){
    $('.cat1').css({'height':$(window).height(),'display':'none'});
    $('.menu').click(function(){
        $(this).fadeOut();
        $('.welcoming').css({'display':'none'});
        $('.cat1').css({'display':'block'});
        $('.cat1').animate({"left":"0"},{duration:500});
    });
    $('.cat1 img').click(function(){  
        $('.cat1').animate({"left":"-383px"},{duration:500,complete:function(){
            $('.cat1').css({'display':'none'});
            $('.welcoming').css({'display':'block'});
        }});
        $('.menu').fadeIn();
    });

    var name = $('#name');
    var subject = $('#subject');
    var email = $('#email');
    var message = $('#message');
    var send = $('#send');

    function isNotEmpty(e){
        if(e.val() == ""){
            e.parent().css("border","3px solid red");
            e.parent().attr("title","Fill all informations");
            return false;
        }else{
            e.parent().css("border","")
            e.parent().css("borderBottom","3px solid #a68ac2");
            e.parent().removeAttr("title");
            return true;
        }
    }

    send.click(function(){
        if(isNotEmpty(name) && isNotEmpty(subject) && isNotEmpty(email) && isNotEmpty(message)){
            $.ajax({
                url:'first.php',
                method:'POST',
                dataType:'JSON',
                data:{
                    name : name.val(),
                    subject : subject.val(),
                    email : email.val(),
                    message : message.val()
                }, success: function(response){
                    if(response.response.toString() == "Email sent with success"){
                        alert("Email sent with success");
                    }else{
                        alert("Enter a valid email");
                    }
                }
            });
        }
    });


});