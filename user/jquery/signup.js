$(document).ready(function(){
    function verify_name(e){
        var name = /^[A-Za-z]{3,20}$/;
        if(!name.test(e.val())){
            e.css('border','2px solid red');
            e.prop('title','Enter a valid name');
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }

    function verify_cin(e){
        if(e.val().length < 3){
            e.css('border','2px solid red');
            e.prop('title','Enter a valid cin');
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }

    function verify_email(e){
        var email = /^[A-Za-z0-9._-]+@[a-z]+.[a-z]{2,3}$/;
        if(!email.test(e.val())){
            e.css('border','2px solid red');
            e.prop('title','Enter a valid email');
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }

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

    function verify_phone(e){
        var phone = /^[0-9]{10}$/;
        if(!phone.test(e.val())){
            e.css('border','2px solid red');
            e.prop('title','Enter a valid phone');
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }

    function verify_date(e){
        var today = new Date();
        var date = new Date(e.val());
        var year = today.getFullYear() - date.getFullYear();
        var month = today.getMonth()+1 - date.getMonth();
        var day = today.getDate()-date.getDay();   

        if(month >= 0){
            if(day < 0){
                year--;
            }
        }else{
            year--;
        }

       if(e.val() == '' || year < 16){
            e.css('border','2px solid red');
            if(e.val() == ''){
                e.removeAttr('title');
                e.prop('title','Enter your birthday');    
            }else{
                e.removeAttr('title');
                e.prop('title','Your age should be above 16'); 
            }
            return false;
        }else{
            e.removeAttr('title');
            e.css('border','2px solid black');
            return true;
        }
    }
    


    $('#send').click(function(){
        
        if(verify_name($('#fname')) && verify_name($('#sname')) && verify_cin($('#cin')) && verify_email($('#email')) && verify_pass($('#pass')) && verify_phone($('#phone')) && verify_date($('#bdy'))){
            var fname = $('#fname').val();
            var sname = $('#sname').val();
            var cin = $('#cin').val();
            var email = $('#email').val();
            var pass = $('#pass').val();
            var phone = $('#phone').val();
            var bdy = $('#bdy').val();

            $.ajax({
                url:'sign.php',
                method:'POST',
                dataType:'JSON',
                data:{
                    fname:fname,
                    sname:sname,
                    cin:cin,
                    email:email,
                    password:pass,
                    phone:phone,
                    bdy:bdy
                },success:function(error){
                    function emailer(){
                        alert("The email you entred already exists");
                        $('#email').css('border','2px solid red');
                        $('#email').prop('title','Enter another email');
                    }
                    function cin(){
                        alert("The CIN you entred already exists");
                        $('#cin').css('border','2px solid red');
                        $('#cin').prop('title','Enter another cin');
                    }
                    if(parseInt(error) == 0){
                        emailer();
                    }else if(parseInt(error) == 1){
                        cin();
                    }else if(parseInt(error) == 11){
                        emailer();
                        cin();
                    }else{
                        alert(error);
                    }
                }

            })
        }

    });


});