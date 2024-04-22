$(document).ready(function(){
var name = $("#cate");
var description = $("#desc");
var add = $("#add");

function isEmpty(e){
    if(e.val() == ""){
        e.css("border","2px solid red");
        e.prop("title","Fill this input");
        return true;
    }else{
        e.css("border","2px solid black");
        e.removeAttr("title");
        return false;
    }
} 

add.click(function(){
    if(!isEmpty(name) && !isEmpty(description)){
        $.ajax({
            url:'cat.php',
            method:'POST',
            dataType:'JSON',
            data:{
                name:name.val(),
                desc:description.val()
            },
            success:function(data){
                if(parseInt(data) == 0){
                    alert("done");
                    name.val("");
                    description.val("");
                }
            }
        });  
    }
});



});