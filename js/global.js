
//START THE QUERY
(function($){  
						
	// GLOBAL VARIABLES
$().ready(function() {	//on page load start
	
	
	//MAIN NAVIGATION
	/*
	$('#top_navi > li').mouseenter(function(){
		//$('ul', this).stop();
		$('ul', this).slideDown(100);
	})
	$('#top_navi > li').mouseleave(function(){
		//$('ul', this).stop();
		$('ul', this).slideUp(100);
	})
	*/
	
	
	$('.tpNav1 > li').mouseenter(function(){
		//$('ul', this).stop();
		$('ul', this).slideDown(100);
	})
	$('.tpNav1 > li').mouseleave(function(){
		//$('ul', this).stop();
		$('ul', this).slideUp(100);
	})
	
	$('.tpNav2 > li').mouseenter(function(){
		//$('ul', this).stop();
		$('ul', this).slideDown(100);
	})
	$('.tpNav2 > li').mouseleave(function(){
		//$('ul', this).stop();
		$('ul', this).slideUp(100);
	})
	
	$('.tpNav3 > li').mouseenter(function(){
		//$('ul', this).stop();
		$('ul', this).slideDown(100);
	})
	$('.tpNav3 > li').mouseleave(function(){
		//$('ul', this).stop();
		$('ul', this).slideUp(100);
	})
	
	$('.tpNav4 > li').mouseenter(function(){
		//$('ul', this).stop();
		$('ul', this).slideDown(100);
	})
	$('.tpNav4 > li').mouseleave(function(){
		//$('ul', this).stop();
		$('ul', this).slideUp(100);
	})
	
	
	
	
	
	
	
	
	
	
	
	//SIGNUP OPEN
	$('#signin_btn').click(function(){
		$('#header_login').slideDown(300);
		return false;
	})
	$('#close_btn').click(function(){
		$('#header_login').slideUp(300);
		return false;
	})
		
 	
}); //on page load end




})(jQuery);