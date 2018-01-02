function validation() {
    alert("hi");
    var type = $("input").attr("value");

    //alert(type);
    var num = $("input");
    //alert(num);
    for(i=0; i<num.length; i++ ){
        //alert(4)
        alert(num[i].attr("value"));	
    }
    var divs = $(".num");
    for( i=0; i<divs.length; i++ ){
        alert("Found Division: " + divs[i].attr("type"));
    }
}

var k=6;
function Addmore(){
    var str='';
    k++;
    str+='<tr id="add'+k+'" ><td>price'+k+'</td><td><input type="text" name="p2" id="p2" value="" class="num" size="50" /><input type="button" name="del" class="remove" value="Delete" onclick="Remove('+k+');" ></td></tr>'
    //$("#tab").append(str);
    $("#addfirst1").after(str);
    //$("#addfirst").before(str);
    //$("#addlast").after(str);
    $("#addlast1").before(str);
}
function Remove(id){
    //alert(6);
    var id = "add"+id;
    $('#'+id).remove();
}
        
function ajaxcall(){
    $.ajax({
        type: 'POST',
        url: "user.php",
        data: {
            iUserId: '1',
            name: 'chakradhar'
        },
        success: function(data){
            alert(data);
        }
    });
    $.post(
    "user.php",
    {iUserId: '1', name: 'chakra'},
    'POST',function(data){
       alert(data) 
    });
}


