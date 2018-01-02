$(function() {
	$('#createchatgroup').click(function(){
	
		$("#currentlivechat").hide();
		//$("#student_prof_Wp").show();
		$("#owngroup").show("slow");
	});
	
	$('#backlivechat').click(function(){
		$("#owngroup").hide();
		$("#currentlivechat").show("slow");
	});
	
	$('#cancellivechat').click(function(){
		$("#owngroup").hide();
		$("#currentlivechat").show("slow");
	});
	
	$('#livechatgroup').click(function(){
		$('#mainframe').load('http://dev.thetalklist.com/user/live_chat/');
	});
	
	$('a@[href=#]').attr('href','javascript:void(0)');
		//username = false;
		$('#chat_name').blur(function(){
			//checkGroupname();
		});
		$('#sendtext').click(function(){
			sendMessage1();
		});
});