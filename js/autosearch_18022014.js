/*
 cc:scriptime.blogspot.in
 edited by :midhun.pottmmal
*/

$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_response").fadeOut('slow');
	});

	$("#school").focus();
	var offset = $("#school").offset();
	var width = $("#school").width()-2;
	$("#ajax_response").css("left",offset.left); 
	$("#ajax_response").css("width",width);
	$("#school").keyup(function(event){
		 //alert(event.keyCode);
		 var school = $("#school").val();
		 
		 var baseurl = $("#baseurl").val();
		 var sendurl = baseurl + 'user/AutoSearch';
		 
		 if(school.length)
		 {
			 var numRows = school.length;
			
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: sendurl,
				   data: "data="+school,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_response").fadeIn("slow").html(msg);
					else
					{
						
					  $("#ajax_response").fadeIn("slow");	
					  $("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$("#loading").css("visibility","hidden");
					$("li:last div").removeClass("abc1");
				   }
				 });
			 }
			 else
			
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					 scroll:true;
					  found = 0;
					  $("ul.list li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						scroll:true;
						var sel = $("ul.list li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
						
					  }
					  else
					  
						$("ul.list li:first").addClass("selected");
					 }
					
						
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
					  $("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_response").fadeOut("slow");
					var test=($("li[class='selected'] a").text()).split(' ');
					$("#school").val(test[0]);
					 var baseurl = $("#baseurl").val();
					 var sendurl = baseurl + 'user/AutoSearch';
		 
					$.ajax({
				   type: "POST",
				   url: sendurl,
				   data: "data="+test[0],
				   success: function(msg){	
					if(msg != 0)
					  $("#display").fadeIn("slow").html(msg);
					else
					{
						
					  $("#display").fadeIn("slow");	
					  $("#display").html('<div style="text-align:left;">No Matches Found</div>');
					}
					
				   }
				 });
					//alert(test[0]);
				 break;
				}
			 }
		 }
		 else
			$("#ajax_response").fadeOut("slow");
	});
	
	$("#ajax_response").mouseover(function(){
										   
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  var test=($(this).text()).split(' ');											 
			  $("#school").val(test[0]);
			  var baseurl = $("#baseurl").val();
			  var sendurl = baseurl + 'user/AutoSearch';
		 
			  $("#ajax_response").fadeOut("slow");
			  $.ajax({
				   type: "POST",
				   url: sendurl,
				   data: "data="+test[0],
				   success: function(msg){	
					
					if(msg != 0)
					  $("#display").fadeIn("slow").html(msg);
					else
					{
						
					  $("#display").fadeIn("slow");	
					  $("#display").html('<div style="text-align:left;">No Matches Found</div>');
					}
					
				   }
				 });
		});
	});
	 
});