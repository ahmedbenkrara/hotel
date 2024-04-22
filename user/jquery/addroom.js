$(document).ready(function(){
    var number = $("#Rnumber");
    var price = $("#Rprice");
    var idcat = $("#Scat");
    var description = $("#Sdes");
    var amenties = $("#Samenties");
    var image = $("#image");
    var av = $("#av");
    var unav = $("#unav");
    var status = 0;
    var property;

    function isEmpty(e){
        if(e.val() == ''){
            e.css("border","2px solid red");
            e.prop("title","Fill this input");
            return true;
        }else{
            e.css("border","2px solid black");
            e.removeAttr('title');
            return false;
        }
    }

    function isNumber(e){
        var exp = /^[0-9]+$/;

        if(!exp.test(e.val())){
            e.css("border","2px solid red");
            e.prop("title","Must be a number");
            return true;
        }else{
            e.css("border","2px solid black");
            e.removeAttr('title');
            return false;
        }
    }

    function isImage(){
        var prop = $("#image").prop('files')[0];
        var name = prop.name;
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext,['gif','png','jpg','jpeg']) == -1){
            alert('Invalid image');
            return false;
        }else{
            property = prop;
            return true;
        }
    }

    function isSelected(e){
        if(e.val() == null){
            e.css("border","2px solid red");
            e.prop("title","Select category");
            return true;
        }else{
            e.css("border","2px solid black");
            e.removeAttr('title');
            return false;
        }
    }

    $("#addroom").click(function(e){
        if(!isNumber(number) && !isNumber(price) && !isEmpty(description) && !isEmpty(amenties) && isImage() && !isSelected(idcat)){
            if(av.is(':checked')){
                status = 1;
            }

            alert("Room inserted with success");

        }else{
            e.preventDefault();
        }
    });

});