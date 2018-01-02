$(document).ready(function() {
	//$('input[type="text"]').addClass("txt_box");
	
	$('input[type="text"]').focus(function() {
		
		//$(this).removeClass("txt_box").addClass("txt_box_active");
		if (this.className != 'txtbox email_popup'){
			if (this.value == this.defaultValue){ 
				this.value = '';
			}
			if(this.value != this.defaultValue){
				this.select();
			}
		}
		
	});
	$('input[type="text"]').blur(function() {
		//$(this).removeClass("txt_box_active").addClass("txt_box");
		if (this.className != 'txtbox email_popup'){
			if ($.trim(this.value) == ''){
				this.value = (this.defaultValue ? this.defaultValue : '');
			}
		}
	});

	$('textarea').focus(function() {
		if (this.value == this.defaultValue){ 
			this.value = '';
		}
		if(this.value != this.defaultValue){
			this.select();
		}
	});
	$('textarea').blur(function() {
		if ($.trim(this.value) == ''){
			this.value = (this.defaultValue ? this.defaultValue : '');
		}
	});

	$('select').focus(function() {
		//$(this).removeClass("sel_box").addClass("sel_box_active");
	});
	$('select').blur(function() {
		//$(this).removeClass("sel_box_active").addClass("sel_box");
	});
});