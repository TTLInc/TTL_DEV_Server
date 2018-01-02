
//START THE QUERY
(function($){  
						
	// GLOBAL VARIABLES
$().ready(function() {	//on page load start

	//MOBILE MENU SHOW / HIDE
	var mob_menu = $('#nav-toggle');
	var navigation = $('.navi_col');
	mob_menu.click(function(){
		navigation.each(function(){
			if($(this).hasClass('signinbtn')){
				//do nothing
			}else{

				if($(this).is(':hidden')){
					$(this).slideDown(300);
				}else{
					$(this).slideUp(300);
				}

			}
		})
		
		return false;
	})
	



	//MAIN NAVI
	var navi_link = $('#navigation > li');
	navi_link.mouseenter(function(){
		var submenu = $('ul', this).size();
		if(submenu > 0){
			$('ul', this).stop(true, true).fadeIn(100);
		}
	}).mouseleave(function(){
		var submenu = $('ul', this).size();
		if(submenu > 0){
			$('ul', this).stop(true, true).fadeOut(100);
		}
	})

	//BANNER PARALLAX START
	if ($('.banner_parallax').length !== 0) {
		$('.banner_parallax').parallax("50%", 0.1);
	}
	//BANNER PARALLAX END
	
	//FOOTER DIVIDER
	//$('li', '#footer_links').last().addClass('last');
	
	//MAIN PAGE START
	if ($('#main_page').length !== 0) {
		//HOW IT WORKS
		$('#how_it_works_section').css({'background-image':'url(images/how_it_works_2.jpg)', 'background-color':'#dbdedf', 'background-position':'top', 'background-repeat':'no-repeat'});
		
		//FADE ELEMENTS
		var set_fade_elements  = function(){

			//fade on scroll out								  
			$('.fade').each(function(){
				//fade out
				var fade_top = $(this).offset().top + 140;
				var window_top = $(window).scrollTop();
				$output = (fade_top - window_top)/200;
				$check_top = window_top + 500;
				if($output < 1 ){
					$(this).css({'opacity':$output});
				}
				//fade in
				var browser_height = $(window).height() - 200;
				var this_pos = $(this).offset().top;
				$check_pos = window_top + browser_height;//((fade_top - window_top)+browser_height)/200;
				$output_in = ($check_pos - this_pos) / 200;
				
				if($output_in > 0 && $output_in < 1){
					$(this).css({'opacity':$output_in});
				}
				//this handles the center portion of viewport
				if($output > 1 && $output_in > 1){
					$(this).css({'opacity':1});
				}
			})
		}
		//ON PAGE LOAD
		set_fade_elements();
		
		
		//TOP NAVI MAKING FIXED
		var set_top_navi  = function(){
			var top_navi_pos = $('#banner_parallax').height();
			var header_height = $('#top_navi').height();
			var window_pos = $(window).scrollTop();
			if(window_pos > top_navi_pos){
				$('#top_navi').css({'position':'fixed'})
				$('#banner_parallax').css({'marginBottom':header_height})
			}else{
				$('#top_navi').css({'position':'relative'})
				$('#banner_parallax').css({'marginBottom':0})
			}
		}
		
		
		//HOW IT WORKS SECTION
		var set_how_it_works = function(){
			var window_pos = $(window).scrollTop();
			var htw_pos = $('#how_it_works_section').offset().top;
			if(window_pos > htw_pos){
				$('#how_it_works_section').css({'background-attachment':'fixed'})
			}else{
				$('#how_it_works_section').css({'background-attachment':'scroll'})
			}
		}
		
		//CALL THE FUNCTIONS ON BROWSER SCROLL
		$(window).scroll(function(){
			set_fade_elements();
			set_top_navi();
			set_how_it_works();
		});
	}
	
	
	if ($('#product_slider').length !== 0) {
		$('.pro_slider').slick({
			dots: false,
			arrows: true,
			autoplay: false,
			autoplaySpeed: 2000,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			onAfterChange: function(slider, i){
				$('a', '#slider_navi').removeClass('current');
				$('#slider_navi_'+i).addClass('current');
			}
		});
		
		//slickGoTo
		$('a', '.slider_navi').on('click', function(){
		  	//slideIndex++;
			var num = $(this).attr('data-rel');
			$('.pro_slider').slickGoTo(num);
			
			$('a', '.slider_navi').removeClass('current');
			$(this).addClass('current');
			
			return false;
		});

	}	
	
	
	/*
	//BACK TO TOP
	var back_to_top = $('#back_to_top');
	back_to_top.click(function(){
		$("html, body").animate({ scrollTop: 0 }, 500);
	})
	*/
	
	
	
	//NEWS BOXES HEIGHTS
	if ($('.cu_dds').length !== 0) {
		//only if not mobile / tabs
		var wrapperMargin = $('.banner_inner').css('marginTop');
		if(wrapperMargin == '102px' ){
			$('.cu_dds').selectbox('', 'searchbox');
		}
	}
	
	//COMPANY LISTS
	if ($('#company_lists').length !== 0) {
		var company_box = $('.company_box');
		company_box.mouseenter(function(){
			$('.hover', this).stop().animate({'top':0}, 300);
		}).mouseleave(function(){
			$('.hover', this).stop().animate({'top':'100%'}, 300);
		})
	}
	
	
	//accordion
	if ($('.accordion').length !== 0) {
		var acc_handle = $('h3', '.accordion');
		var acc_content = $('.acc_content', '.accordion');
		acc_handle.click(function(){
			var myEle = $(this).next();
			if( myEle.is(':hidden') ){
				//scroll to section
				var clickedItem = $(this);
				//open section
				acc_content.stop(true, true).slideUp(300);
				myEle.stop(true, true).slideDown(300, function(){
					var scrPos = clickedItem.offset().top - 90;
					$('body, html').stop().animate({'scrollTop':scrPos},300);
				});
				//active link
				acc_handle.removeClass('active');
				$(this).addClass('active');
				
			}else{
				myEle.stop(true, true).slideUp(300);
				//active link
				$(this).removeClass('active');
			}
			return false;
		})
	}
	
	//leave_testimonial
	if ($('#leave_testimonial').length !== 0) {
		var testi_handle = $('h4','#leave_testimonial');
		var testi_content = $('.testimonial_form','#leave_testimonial');
		testi_handle.click(function(){
			if( testi_content.is(':hidden') ){
				testi_content.stop(true, true).slideDown(300);
				$(this).addClass('active');
			}else{
				testi_content.stop(true, true).slideUp(300);
				$(this).removeClass('active');
			}
		})
		
	}
	
	//show_popup
	if ($('#show_popup').length !== 0) {
		var show_popup = $('#show_popup');
		var wtr_popup = $('.wtr_popup');
		var popup_overlay = $('.popup_overlay');
		var close_popup = $('.close_popup');
		show_popup.click(function(){
			wtr_popup.css({'display':'block'});
			//overlay
			var docHeight = $(document).height();
			popup_overlay.css({'display':'block', 'height':docHeight});
			//scroll only if mobile
			var what_to_write_margin = $('.what_to_write').css('marginBottom');
			if(what_to_write_margin == '1px'){
				var scrtop = close_popup.offset().top;
				$('html, body').stop().animate({'scrollTop':scrtop}, 300);
			}
			return false;
		})
		popup_overlay.click(function(){
			wtr_popup.css({'display':'none'});
			//overlay
			popup_overlay.css({'display':'none'});
			return false;
		})
		close_popup.click(function(){
			wtr_popup.css({'display':'none'});
			//overlay
			popup_overlay.css({'display':'none'});
			return false;
		})
		
	}
	
		



	//Nav Search Form
	
	
}); //on page load end




})(jQuery);
