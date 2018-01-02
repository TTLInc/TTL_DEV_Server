function validation() {
	//alert("hi");
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

var k=0;
var h=5;
function Addmore(){
	var str='';
	k++;
	h=(h+10);
	str+='<tr id="add'+k+'" ><td align="center"><input type="text" name="p2" id="p2" value="" class="num" size="'+h+'" /><input type="button" name="del" class="remove" value="Delete" onclick="Remove('+k+');" >'+k+'</td></tr>'
	//$("#tab").append(str);
	//$("#addfirst").before(str);
	$("#addlast").after(str);
	$("#addmiddle").before(str);
	}
function Remove(id){
	//alert(6);
	var id = "add"+id;
	$('#'+id).remove();
	}