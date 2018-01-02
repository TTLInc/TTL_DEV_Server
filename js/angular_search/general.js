
function initialize_header_data()
{
	$('#signin_btn').click(function(){
		$('#header_login').slideDown(300);
		return false;
	})
	$('#register_btn').click(function(){
		$('#header_register').slideDown(300);
		return false;
	})
	$('#close_btn').click(function(){
		$('#header_login').slideUp(300);
		return false;
	});
	$('#close_btn_register').click(function(){
		$('#header_register').slideUp(300);
		return false;
	});
	$(document).ready(function(){
		$('#menu').slicknav();
	});
	$('input').keydown(function(e){
        if (e.keyCode == 13) {
				frmvalidate1();
        }
    });
}
function getfeedback(uid)
{
	var lodUrl = BASE_URL+'user/getFeedback/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();

}
function frmvalidate1()
{
	if( $('#firstName2').val() == '')
	{
		document.getElementById('fname2').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('fname2').style.display = 'none';
	}
	if( $('#email2').val() == '')
	{
		document.getElementById('remail2').style.display = 'block';
		 document.getElementById('email_taken2').style.display = 'none';
		return false;
	}
	else
	{
		document.getElementById('remail2').style.display = 'none';
	}
	var mail=($('#email2').val());
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(! re.test(mail))
	{
		document.getElementById('vremail2').style.display = 'block';
		document.getElementById('email_taken2').style.display = 'none';
		return false;
	}
	else
	{
		$.ajax({
			  type: "GET",
			  url: BASE_URL+'user/ajax_checkjp',
			  data: {name: mail},
			  dataType: "jsonp",
			   jsonp: 'callback',
				jsonpCallback: 'chekEmailTaken',
			  success: function(msg){ 
				if(msg.success==false || msg.success=='false')
				{
					document.getElementById('vremail2').style.display = 'none';
					document.getElementById('email_taken2').style.display = 'block';
				}
				else
				{
						chekEmailTaken12(msg);
				}				
			 }
		});
		return;
	}
}
function chekEmailTaken12(data){
	if(data.success)
	{ 
		document.getElementById('vremail2').style.display = 'none';
		document.getElementById('email_taken2').style.display = 'none';
		PasswordCheck(); 	
	}
	else
	{ 				 
		document.getElementById('vremail2').style.display = 'none';
		document.getElementById('email_taken2').style.display = 'block';
	}
}
function PasswordCheck()
{
	if( $('#mpass').val() == '')
	{
		document.getElementById('mpass1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('mpass1').style.display = 'none';
	}
		var k=$('#mpass').val().length;
		if(k < 6)
		{
			document.getElementById('passlongs').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById('passlongs').style.display = 'none';
		}
	 if( $('#cpassword').val() == '')
	{
		document.getElementById('cpass2').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('cpass2').style.display = 'none';
	} 
	var a=$('#mpass').val();
	var b=$('#cpassword').val()
	if(a != b)
	{
		document.getElementById('fcpass2').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('fcpass2').style.display = 'none';
	} 
	$('#registerForm123').submit();
}
function changeLanguage(lang){
  if(lang==''){
    	return false;
    }
	multiLang = lang;
	$.ajax({
		type: "POST",
		url: BASE_URL+'angular_search/set_language',
		data: { multiLang: multiLang}
	}).done(function( msg ) {
			if(current_seg==current_lang)
			{
				str = self.location.href;
				relocateto = str.replace('/'+existLng, '/'+lang);
				self.location.href = relocateto;
			}
			else
			{
				location.reload();
			}
  	});
}
function initialize_search_page_data()
{
	$('.cm_left01').click(function(){
		$('.cm_left01').toggleClass('active');
		$( ".criteria_showhide" ).slideToggle( "slow");
	});
	$(document).ready(function() {
		$("#datepicker").datepicker();
	});
	$( '#map_canvas, #bingmap_canvas').hide();
	$( '#static_map_canvas').css('cursor', 'pointer');
	$( '#static_map_canvas' ).hover(function(){ $( '#static_map_canvas_image' ).attr("src", BASE_URL+'images/angular_search/tutor_search.jpg');});
	$( '#static_map_canvas' ).mouseout(function(){ $( '#static_map_canvas_image' ).attr("src", BASE_URL+'images/angular_search/tutor_search_activate.jpg');});
	
	$( '#deactivateMap' ).click(function(){
		$( '#imgshow').css('display', 'block');
		$( '#imghid').css('display', 'block');

		$( '#static_map_canvas').show();
		$( '#map_canvas, #bingmap_canvas').hide();
		$( '#deactivateMap').css('display', 'none');
		$( '#deactivateMap').css('z-index', '0');
		document.getElementById("static_map_canvas").style.display = 'none';
	});
	div_show();
	div_hide();
	$('#video_popup').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s',
	});
	//=============OLARK CHAT
			window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
		f[z]=function(){
		(a.s=a.s||[]).push(arguments)};var a=f[z]._={
		},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
		f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
		0:+new Date};a.P=function(u){
		a.p[u]=new Date-a.p[0]};function s(){
		a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
		hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
		return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
		b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
		b.contentWindow[g].open()}catch(w){
		c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
		var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
		b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
		loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
		/* custom configuration goes here (www.olark.com/documentation) */
		olark.identify('9086-704-10-4711');/*]]>*/
	//=============OLARK CHAT
	}
function div_show()
{
	document.getElementById("static_map_canvas").style.display = 'block';
	document.getElementById("imgshow").style.display = 'block';
	document.getElementById("imghid").style.display = 'none';
	$('.map_session_main').addClass('left-side-icon');
	$('.map-div').addClass('map-showdiv');
}

function div_hide()
{
	document.getElementById("map_canvas").style.display = 'none';
	document.getElementById("static_map_canvas").style.display = 'none';
	document.getElementById("imgshow").style.display = 'none';
	document.getElementById("imghid").style.display = 'block';
	$('.map_session_main').removeClass('left-side-icon');
	$('.map-div').removeClass('map-showdiv');
}
//INITIALIZE MAP
function initialize_map(mapDataJson)
{
	if (mapDataJson.length)
	{
		var cookieZoom = getCookieValue("cookieZoom");
		var cookieLat = Number(getCookieValue("cookieLat"));
		var cookieLng = Number(getCookieValue("cookieLng"));
		var dataUid = Number(getCookieValue("userID"));	
		var zoomVal=4;
		var minZoomLevel = 2;
		
		if(dataUid == 0)
		{
			
			var dt = new Date(), expiryTime = dt.setTime( dt.getTime() - 1800000 );
			document.cookie="cookieLat=''; expires=" + dt.toGMTString();
			document.cookie="cookieLng=''; expires=" + dt.toGMTString();
			document.cookie="cookieZoom=''; expires=" + dt.toGMTString();
			document.cookie="cookieLatTmp=''; expires=" + dt.toGMTString();
			document.cookie="cookieLngTmp=''; expires=" + dt.toGMTString();
			document.cookie="cookieZoomTmp=''; expires=" + dt.toGMTString();
			
		}
		
		if(dataUid != 0 && cookieLat == 0 && cookieLng == 0)
		{
			
			cookieZoom = getCookieValue("cookieZoomTmp");
			cookieLat = getCookieValue("cookieLatTmp");
			cookieLng = getCookieValue("cookieLngTmp");
			
		}
		
		if(dataUid != 0)
		{
			var dt = new Date(), expiryTime = dt.setTime( dt.getTime() + 1800000 );
			
			document.cookie="cookieLatTmp="+cookieLat+"; expires=" + dt.toGMTString();
			document.cookie="cookieLngTmp="+cookieLng+"; expires=" + dt.toGMTString();
			document.cookie="cookieZoomTmp="+cookieZoom+"; expires=" + dt.toGMTString();
		}
		//var dtExp = new Date(), expiryTime = dtExp.setTime( dtExp.getTime() - 300000 );
		
		if(document.getElementById("country").value=='0')
		{
			
			zoomVal=2;
		}
		//alert(cookieZoom)
		if(cookieZoom != '')
		{
			zoomVal=Number(cookieZoom);
			//document.cookie="cookieZoom=''; expires=" + dtExp.toGMTString();
		}
		
		//var latlng 			= new google.maps.LatLng(42.7834345, -95.9662495);
		var latlng 			= new google.maps.LatLng(38, -120);
		//--T9_07012013_1135_AM_Set the world as a center
		if(cookieLat != '' && cookieLng != '')
		{
			var latlng 		= new google.maps.LatLng(cookieLat, cookieLng);
			//document.cookie="cookieLat=''; expires=" + dtExp.toGMTString();
			//document.cookie="cookieLng=''; expires=" + dtExp.toGMTString();
		}
		
		var myOptions 		= {
								zoom: zoomVal,
								center: latlng,
								scaleControl:true,
								mapTypeControl:false,
								streetViewControl:false,
								overviewMapControl:false,
								mapTypeId: google.maps.MapTypeId.ROADMAP
								
								 //disableDefaultUI: true
							  }
							  
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		//mapDataJson.setTilt(0);
		
		//alert(mapDataJson.length)
		if(mapDataJson.length == 1)
		{
			//alert(mapDataJson.Lat);
			
			pinOnSingleMap(mapDataJson[0], 1);
			//alert(mapDataJsonFeature.length)
			/*
			$.each(mapDataJsonFeature,function(k,v){
				//alert(v.Lat)
				pinOnMap(v, k);
			})*/
			
		}else{
		
			$.each(mapDataJson,function(k,v){
				pinOnMap(v, k);
			})
			
			//alert(mapDataJsonFeature.length)
			
			/*$.each(mapDataJsonFeature,function(k,v){
				pinOnMap(v, k);
			})*/
			
			var text = mapDataJson[0].country;
		
			geocoder.geocode( { 'address': text}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					//map.setCenter(results[0].geometry.location);
				}else{
					var s= document.getElementById("country").value;
					var text = $("#country option[value="+s+"]").text();
					geocoder.geocode( { 'address': text}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
					}
					
					})
				}
			
			})
			
			
		}
		
		// get current map center and zoom and store this.
		google.maps.event.addListener(map, 'center_changed', function() {
			var dt = new Date(), expiryTime = dt.setTime( dt.getTime() + 1800000 );
			var currentmapzoom = map.getZoom();
			var currentmapcenter = map.getCenter(); 
			var currentLat  = currentmapcenter.lat();
			var currentLng  = currentmapcenter.lng();
			//alert(currentmapzoom)
			document.cookie="cookieLat=" + currentLat + "; expires=" + dt.toGMTString();
			document.cookie="cookieLng=" + currentLng + "; expires=" + dt.toGMTString();
			document.cookie="cookieZoom=" + currentmapzoom + "; expires=" + dt.toGMTString();
			//alert(mapDataJson)
		});

		// Limit the zoom level
	   google.maps.event.addListener(map, 'zoom_changed', function() {
		 if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
	   });

		$('#dialog').attr('buttontype','done');
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
	}
	else
	{
		$("#map_canvas").css("text-align","center").css("background","#ebebeb").html("<span style='font-size:24px; font-weight:bold; color:#999999; position:relative; top:112px;'>No records found.</span>");
	}
}
function getCookieValue(key)
{
currentcookie = document.cookie;
if (currentcookie.length > 0)
{
	firstidx = currentcookie.indexOf(key + "=");
	if (firstidx != -1)
	{
		firstidx = firstidx + key.length + 1;
		lastidx = currentcookie.indexOf(";",firstidx);
		if (lastidx == -1)
		{
			lastidx = currentcookie.length;
		}
		return unescape(currentcookie.substring(firstidx, lastidx));
	}
}
return "";
}
function bookNow1(tid,username,school_id)
{
		var lastClickedOnBook = false;
		//prevent multiple clicks
		if(lastClickedOnBook == true){return false;}
		lastClickedOnBook = true;
		var _data = {};
		if(USER_ID!="")
		{
			_data['sid'] = USER_ID;
		}
		else
		{
			_data['sid'] = 0;
		}
		
		_data['tid'] = tid;
		var refid =REF_IR;
		
		if (school_id > 0 )
		{
			_data['schoolid']=school_id;
		}
		else
		{
			_data['schoolid']=0;
		}
		$.post(BASE_URL+'user/checkClassBookNow',_data,function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			window.cost = json.cost;
			$('#bookingamount').val(window.cost);
			if(json.success == 'false' || json.success == false){
				alert(json.msg);
			}else if(json.enough == false || json.enough == 'false'){
				window.returnvar = false;
				window.avl = true;
				window.profileComplete = true;
				
			}else if(json.availabletobook==false || json.availabletobook=='false'){
				window.returnvar = false;
				window.avl = false;
				window.profileComplete = true;
				
			}else if(json.profileCompletion==false || json.profileCompletion=='false'){
				window.returnvar = false;
				window.avl = true;
				window.profileComplete = false;
				
			}else{
				window.returnvar = true;
			}
			if(json.firstBookNow == false || json.firstBookNow == 'false'){
				window.firstBookNow = false;
			}else{
				window.firstBookNow = true;
				window.profileComplete = false;
			}
			if(json.totalNumSess > 1){
				window.totalNumSess = false;
			}else{
				window.totalNumSess = true;
			}
			
			if(json.enough)
			{
			window.enough=true;
			}
			else
			{
			window.enough=false;
			}
			setTimeout();
		})
		function setTimeout(){
			lastClickedOnBook = false;
			if(window.returnvar == false)
			{
				lastClickedOnBook = false;
				if(window.avl == false)
				{
					//var alertHTML = 'You have alredy booked.';
					if(window.firstBookNow == false){
						var alertHTML = YouAreTryingTo;
					}else{
						var alertHTML = YouAreTryingTo;
					}
					$( "#dialog").html(alertHTML);
					$( "#dialog").dialog({modal: true,title:" ",resizable:false,  close: function( event, ui ) {self.location = self.location.href;}});
					return false;
				}else if(window.profileComplete == false){
					alert(PleaseComplete);
					window.location.href = BASE_URL+'user/registeredit/';
					return false;
				}
				
				else if(window.enough==true){
					 var message =tutotwillsendnoamount;
					  var conf = confirm(message);
					  var classcost = window.cost;
						if(conf == true)
						{
						// send message to tutor
							$.getJSON(BASE_URL+"user/sendBookNowMessage",{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
								
								//redirect to student dashboard page
									window.location.href = BASE_URL+"user/dashboard";
							});return;
						callback(false);
						}else{
							return;
						}
						callback(false);
				}
				else{
					var rechargeURL = BASE_URL+'user/account/';
					var alertHTML = insuuffi;
					$( "#dialog").html(alertHTML);
					$( "#dialog").dialog({modal: true,  buttons: [
			 
			{
				text: "Ok",
				"class": 'saveButtonClass',
				click: function() {
					window.location.href = rechargeURL;
				}
			}
		],
		close: function() {       
		}});
					return false;
				}
			}else{
				//var conf = confirm(message);
				$('#dialog1').dialog({
						modal:true,
						width:'430px',
						resizable:false,
						buttons: {
							"Ok": function() {
								$.getJSON(BASE_URL+"user/sendBookNowMessage",{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
							window.location.href = BASE_URL+"user/dashboard";
							});
							return;callback(false);
							$(this).dialog("close");},
							"Cancel": function() { $(this).dialog("close");}
						}
				});
				lastClickedOnBook = false;
			 
			}
			return false;
		}
}
function pinOnMap(data, i)
{
	var ad = '';
	if(data.city != null)
	{
		ad = ad + data.city + ',';
	}
	if(data.provice != null)
	{
		ad = ad + data.provice + ',';
	}
	if(data.country != null)
	{
		ad = ad + data.country;
	}

	
	if(data.Lat != '')
	{
		loadmarker(data);
	}else{
	geocoder.geocode( { 'address': ad}, function(results, status) {
		var count = 0;
		if (status == google.maps.GeocoderStatus.OK) {
			if (iniCenter == 0){
				
				var s= document.getElementById("country").value;
				if(s  != 0  && set==0){
					var text = $("#country option[value="+s+"]").text();
					geocoder.geocode( { 'address': text}, function(results, status) {
					//alert(data.country);
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						 
					}
					
					})
					set  = 1;
				}
				
				if(set == 0)
				{
					//map.setCenter(results[0].geometry.location);
					iniCenter = 1;
				}
				
			}
			

			var a = results[0].geometry.location.lat();
			var b = results[0].geometry.location.lng();
			/*
			var d		=0.2+(data.uid);
			var R		=6371;
			var brng	=3;
			var lat2 = Math.asin( Math.sin(a)*Math.cos(d/R) + Math.cos(a)*Math.sin(d/R)*Math.cos(brng) );
			var lon2 = b + Math.atan2(Math.sin(brng)*Math.sin(d/R)*Math.cos(a), Math.cos(d/R)-Math.sin(a)*Math.sin(lat2));
			lon2 = lon2 + 1;
			a =a + 2;
			*/
			
			var ab= new google.maps.LatLng(a,b);
			//alert(ab)
			//alert(data.uid);
			var udata = {};
			udata['user_id'] 	= data.uid;
			udata['lat'] 		= a;
			udata['long'] 		= b;
			var iconBase = BASE_URL+'images/';
			var marker = new google.maps.Marker({
													map: map,
													position: ab,
													title: data.username,
													icon: iconBase + 'marker.png'
												});
												
												
				if (data.myself == "1"){
					marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
					marker.title = "My Garage";
				}
				
	// added by maya
	var provice ='';
	if(data.provice=='' || data.provice==null || data.provice== 'undefined')
	{
		provice='';
	}else
	{
		provice=data.provice+',';
	}
		
	var city ='';
	if(data.city=='' || data.city==null || data.city== 'undefined')
	{
		city='';
	}else
	{
		city=data.city+',';
	}
				
if (true || data.simple == "0"){
	
data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
	
var userprofileUrl = profileUrl(data.uid);
				
					var infoHtml = "";
						infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
						
						infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
						if(provice == '')
						{
							infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + data.country + "</p>";
						}
						else{
						infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
						
						}
						infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/session</span></p>";
						
						
						infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
						
						infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
						infoHtml += "</div>";

					var infowindow = new google.maps.InfoWindow({
																	content: infoHtml,																				maxWidth:400,
																	maxHeight: 400,
																	height:450
																});
						google.maps.event.addListener(marker, 'click', function() {
							if( prev_infowindow )
							{
								prev_infowindow.close();
							}
							prev_infowindow = infowindow;
							
							if (infowindow) infowindow.close();
							infowindow.open(map,marker);
							var mkposition = marker.getPosition();
							// set back page history of map 
							var currentmapzoom = map.getZoom();
							var currentmapcenter = map.getCenter(); 
							var currentLat  = mkposition.lat();
							var currentLng  = mkposition.lng();
							//alert(currentmapzoom)
							document.cookie="cookieLat=" + currentLat;
							document.cookie="cookieLng=" + currentLng;
							document.cookie="cookieZoom=" + currentmapzoom;
							
																	
						});
						
				}else{

				}

			}
		count = count + 1;
		});
	}
	

}
var noworry = 0;

function loadmarker(data)
{
	if(noworry == 0)
	{
		
		var text = data.country;
		
		geocoder.geocode( { 'address': text}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			//map.setCenter(results[0].geometry.location);
		}
		
		})
		noworry = 1;
	}
	
	var a = Number(data.Lat);
	var b = Number(data.Lng);
		
	//var shiftedLongitude = b + Math.random() * 0.002;
	//var shiftedLatitude = a + Math.random() * 0.002;
	if(a == 0 && b==0)
	{
	
	}else
	{
	
	
		var ab= new google.maps.LatLng(a,b);
		var info_window = new google.maps.InfoWindow({
			content: 'loading'
		});
		var iconBase = BASE_URL+'images/';
		var marker = new google.maps.Marker({
						map: map,
						position: ab,
						title: data.username,
						icon: iconBase + 'marker.png'
					});
		if (data.myself == "1"){
			marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
			marker.title = "My Garage";
			
		}
		var provice ='';
		if(data.provice=='' || data.provice==null || data.provice== 'undefined')
		{
			provice='';
		}else
		{
			provice=data.provice+',';
		}
			
		var city ='';
		if(data.city=='' || data.city==null || data.city== 'undefined')
		{
			city='';
		}else
		{
			city=data.city+',';
		}
		if (true || data.simple == "0"){
			
			data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );				
			data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
		
			var infoHtml = "";
				infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
				
				infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
				if(provice == '')
							{
								infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + data.country + "</p>";
							}
							else{
							infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
							
							}
							
				
				infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
				
				infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate;

				if(data.hRate == '0')
				{
					infoHtml += ".00";
				}
				if(data.hRate == '13.3' || data.hRate == '26.6')
				{
					infoHtml += "0";
				}
				
				infoHtml += " credits/session</span></p>";

				infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + "' onclick='goProfile("+data.uid+")'>View Profile</a></span></div>";
				infoHtml += "</div>";

			var infowindow = new google.maps.InfoWindow({
													
															content: infoHtml,
															maxWidth:400,
															maxHeight: 400,
															height:450
														});
				google.maps.event.addListener(marker, 'click', function() {
					if( prev_infowindow )
					{
						prev_infowindow.close();
					}
					prev_infowindow = infowindow;
					
					infowindow.close(map,marker);
					infowindow.open(map,marker);
					
					// set back page history of map 
					var currentmapzoom = map.getZoom();
					var mkposition = marker.getPosition();
					var currentmapcenter = map.getCenter(); 
					var currentLat  = mkposition.lat();
					var currentLng  = mkposition.lng();
					
					document.cookie="cookieLat=" + currentLat;
					document.cookie="cookieLng=" + currentLng;
					document.cookie="cookieZoom=" + currentmapzoom;
					document.cookie="userID=" + data.uid;
				});
				
			//var cookieZoom = getCookieValue("cookieZoom");
			var cookieLat = Number(getCookieValue("cookieLat"));
			var cookieLng = Number(getCookieValue("cookieLng"));
			var dataUid = Number(getCookieValue("userID"));			
			
			if(dataUid == data.uid && dataUid != 0)
			{
				if( prev_infowindow )
				{
					prev_infowindow.close();
				}
				prev_infowindow = infowindow;
				
				infowindow.close(map,marker);
				infowindow.open(map,marker);
				//var abcNewCenter= new google.maps.LatLng(cookieLat,cookieLng);
				//map.setCenter(abcNewCenter);
				document.cookie="userID=0";
				
				
			}else{
				var dt = new Date(), expiryTime = dt.setTime( dt.getTime() - 150000 );
				document.cookie="cookieLat=''; expires=" + dt.toGMTString();
				document.cookie="cookieLng=''; expires=" + dt.toGMTString();
				document.cookie="cookieZoom=''; expires=" + dt.toGMTString();
				
			}
			
				
		}
	}	
}
function pinOnSingleMap(data, i)
{
	
	if((data.Lat == '' || data.Lat == null) && (data.Lng == '' || data.Lng == null))
	{
		
		//alert('hi-1');
		
		var ad = '';
		if(data.city != null){
			ad = ad + data.city + ',';
		}
		if(data.provice != null){
			ad = ad + data.provice + ',';
		}
		if(data.country != null){
			ad = ad + data.country;
		}
		geocoder.geocode( { 'address': ad}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) 
			{
				map.setCenter(results[0].geometry.location);
				var a = results[0].geometry.location.lat();
				var b = results[0].geometry.location.lng();
				var ab= new google.maps.LatLng(a,b);
				var iconBase = BASE_URL+'images/';
				var marker = new google.maps.Marker({
														map: map,
														position: ab,
														title: data.username,
														icon: iconBase + 'marker.png'
													});
				if (data.myself == "1"){
						marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
						marker.title = "My Garage";
						
				}
				// added by maya
				var provice ='';
				if(data.provice=='' || data.provice==null || data.provice== 'undefined'){
					provice='';
				}else{
					provice=data.provice+',';
				}
				var city ='';
				if(data.city=='' || data.city==null || data.city== 'undefined'){
					city='';
				}else{
					city=data.city+',';
				}
				if (true || data.simple == "0"){
					var tutorRate = data.hRate;
					var TutorPercentageValue = tutorRate * window.configs['VEE_PRICE_PERCENT']['value'];
					var finalTutorRate = +tutorRate + +TutorPercentageValue;
					//var hRateConfig = window.configs['VEE_PRICE_PERCENT']['value'];
					//data.hRate = hRateConfig +"+"+ data.hRate;
					//data.hRate += parseInt(12, 10);
					//data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
					var infoHtml = "";
					infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
					infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
					if(provice == ''){
						infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + data.country + "</p>";
					}else{
						infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
					}
					infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
					infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + finalTutorRate;
					if(data.hRate == '0'){
						infoHtml += ".00";
					}
					if(data.hRate == '13.3' || data.hRate == '26.6'){
						infoHtml += "0";
					}
					infoHtml += " credits/session</span></p>";
					infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
					infoHtml += "</div>";
					var infowindow = new google.maps.InfoWindow({
																	content: infoHtml,	
																	maxWidth:400,
																	maxHeight: 400,
																	height:450
																});
					google.maps.event.addListener(marker, 'click', function() {
								if( prev_infowindow ){
									prev_infowindow.close();
								}
								prev_infowindow = infowindow;
								if (infowindow) infowindow.close();
								infowindow.open(map,marker);
							});
					}else{

					}
				}
			
			});
	}else
	{
		//alert('hi-2');
		var a = data.Lat;
		var b = data.Lng;
		var ab= new google.maps.LatLng(a,b);
		map.setCenter(ab);
		var iconBase = BASE_URL+'images/';
		var marker = new google.maps.Marker({
												map: map,
												position: ab,
												title: data.username,
												icon: iconBase + 'marker.png'
											});
		if (data.myself == "1"){
				marker.icon = "././upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
				marker.title = "My Garage";
				
		}
		// added by maya
		var provice ='';
		if(data.provice=='' || data.provice==null || data.provice== 'undefined'){
			provice='';
		}else{
			provice=data.provice+',';
		}
		var city ='';
		if(data.city=='' || data.city==null || data.city== 'undefined'){
			city='';
		}else{
			city=data.city+',';
		}
		if (true || data.simple == "0")
		{
			//data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
			//data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
			
			//-------RD @ JULY 01 2016-----//
			if(data.o_mark != ''){
				data.hRate = data.o_hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
				data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
			}else{
				if(data.hRate == data.o_hRate){
					data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
					data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;	
				}

			}
			//-------RD @ JULY 01 2016-----//	
			
			
			var infoHtml = "";
			infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
			infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
			if(provice == ''){
				infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + data.country + "</p>";
			}else{
				infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
			}
			infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
			infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate;
			if(data.hRate == '0'){
				infoHtml += ".00";
			}
			if(data.hRate == '13.3' || data.hRate == '26.6'){
				infoHtml += "0";
			}
			infoHtml += " credits/session</span></p>";
			infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
			infoHtml += "</div>";
			var infowindow = new google.maps.InfoWindow({
															content: infoHtml,	
															maxWidth:400,
															maxHeight: 400,
															height:450
														});
			google.maps.event.addListener(marker, 'click', function() {
						if( prev_infowindow ){
							prev_infowindow.close();
						}
						prev_infowindow = infowindow;
						if (infowindow) infowindow.close();
						infowindow.open(map,marker);
					});
			}else{

			}
		
	}
}	
function profileImgResultThumbMap(src){
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		
		return profileImgNull;
	}
	return profileImgPath+'/'+src;
}
function profileUrl(uid){
	return profileUrlPath+'/'+uid;
}
function createClassUrl(uid){
	
	return createClassPath+'/'+uid+'/'+0;
}
//=========================AUTO SUGGESTION SCHOOL
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
		 
		 var sendurl = BASE_URL + 'user/AutoSearch';
		 
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
					var test=$("li[class='selected'] a").text(); 
					$("#school").val(test);
					 var baseurl = $("#baseurl").val();
					 var sendurl = baseurl + 'user/AutoSearch';
		 
					$.ajax({
				   type: "POST",
				   url: sendurl,
				   data: "data="+test,
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
			  var test=$(this).text();											 
			  $("#school").val(test);
			  var baseurl = $("#baseurl").val();
			  var sendurl = baseurl + 'user/AutoSearch';
		 
			  $("#ajax_response").fadeOut("slow");
			  $.ajax({
				   type: "POST",
				   url: sendurl,
				   data: "data="+test,
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
function getuid(a)
{
	//alert(a);
	var uid=a;
	document.getElementById("sch").value=a;
}
//=========================AUTO SUGGESTION SCHOOL

;(function($,document,window){var
defaults={label:'MENU',duplicate:true,duration:200,easingOpen:'swing',easingClose:'swing',closedSymbol:'&#9658;',openedSymbol:'&#9660;',prependTo:'.mobile_menu',parentTag:'a',closeOnClick:false,allowParentLinks:false,nestedParentLinks:true,showChildren:false,removeIds:false,removeClasses:false,brand:'',init:function(){},beforeOpen:function(){},beforeClose:function(){},afterOpen:function(){},afterClose:function(){}},mobileMenu='slicknav',prefix='slicknav';function Plugin(element,options){this.element=element;this.settings=$.extend({},defaults,options);this._defaults=defaults;this._name=mobileMenu;this.init();}
Plugin.prototype.init=function(){var $this=this,menu=$(this.element),settings=this.settings,iconClass,menuBar;if(settings.duplicate){$this.mobileNav=menu.clone();$this.mobileNav.removeAttr('id');$this.mobileNav.find('*').each(function(i,e){$(e).removeAttr('id');});}else{$this.mobileNav=menu;$this.mobileNav.removeAttr('id');$this.mobileNav.find('*').each(function(i,e){$(e).removeAttr('id');});}
if(settings.removeClasses){$this.mobileNav.removeAttr('class');$this.mobileNav.find('*').each(function(i,e){$(e).removeAttr('class');});}
iconClass=prefix+'_icon';if(settings.label===''){iconClass+=' '+prefix+'_no-text';}
if(settings.parentTag=='a'){settings.parentTag='a href="#"';}
$this.mobileNav.attr('class',prefix+'_nav');menuBar=$('<div class="'+prefix+'_menu"></div>');if(settings.brand!==''){var brand=$('<div class="'+prefix+'_brand">'+settings.brand+'</div>');$(menuBar).append(brand);}
$this.btn=$(['<'+settings.parentTag+' aria-haspopup="true" tabindex="0" class="'+prefix+'_btn '+prefix+'_collapsed">','<span class="'+prefix+'_menutxt">'+settings.label+'</span>','<span class="'+iconClass+'">','<span class="'+prefix+'_icon-bar"></span>','<span class="'+prefix+'_icon-bar"></span>','<span class="'+prefix+'_icon-bar"></span>','</span>','</'+settings.parentTag+'>'].join(''));$(menuBar).append($this.btn);$(settings.prependTo).prepend(menuBar);menuBar.append($this.mobileNav);var items=$this.mobileNav.find('li');$(items).each(function(){var item=$(this),data={};data.children=item.children('ul').attr('role','menu');item.data('menu',data);if(data.children.length>0){var a=item.contents(),containsAnchor=false,nodes=[];$(a).each(function(){if(!$(this).is('ul')){nodes.push(this);}else{return false;}
if($(this).is("a")){containsAnchor=true;}});var wrapElement=$('<'+settings.parentTag+' role="menuitem" aria-haspopup="true" tabindex="-1" class="'+prefix+'_item"/>');if((!settings.allowParentLinks||settings.nestedParentLinks)||!containsAnchor){var $wrap=$(nodes).wrapAll(wrapElement).parent();$wrap.addClass(prefix+'_row');}else
$(nodes).wrapAll('<span class="'+prefix+'_parent-link '+prefix+'_row"/>').parent();if(!settings.showChildren){item.addClass(prefix+'_collapsed');}else{item.addClass(prefix+'_open');}
item.addClass(prefix+'_parent');var arrowElement=$('<span class="'+prefix+'_arrow">'+(settings.showChildren?settings.openedSymbol:settings.closedSymbol)+'</span>');if(settings.allowParentLinks&&!settings.nestedParentLinks&&containsAnchor)
arrowElement=arrowElement.wrap(wrapElement).parent();$(nodes).last().after(arrowElement);}else if(item.children().length===0){item.addClass(prefix+'_txtnode');}
item.children('a').attr('role','menuitem').click(function(event){if(settings.closeOnClick&&!$(event.target).parent().closest('li').hasClass(prefix+'_parent')){$($this.btn).click();}});if(settings.closeOnClick&&settings.allowParentLinks){item.children('a').children('a').click(function(event){$($this.btn).click();});item.find('.'+prefix+'_parent-link a:not(.'+prefix+'_item)').click(function(event){$($this.btn).click();});}});$(items).each(function(){var data=$(this).data('menu');if(!settings.showChildren){$this._visibilityToggle(data.children,null,false,null,true);}});$this._visibilityToggle($this.mobileNav,null,false,'init',true);$this.mobileNav.attr('role','menu');$(document).mousedown(function(){$this._outlines(false);});$(document).keyup(function(){$this._outlines(true);});$($this.btn).click(function(e){e.preventDefault();$this._menuToggle();});$this.mobileNav.on('click','.'+prefix+'_item',function(e){e.preventDefault();$this._itemClick($(this));});$($this.btn).keydown(function(e){var ev=e||event;if(ev.keyCode==13){e.preventDefault();$this._menuToggle();}});$this.mobileNav.on('keydown','.'+prefix+'_item',function(e){var ev=e||event;if(ev.keyCode==13){e.preventDefault();$this._itemClick($(e.target));}});if(settings.allowParentLinks&&settings.nestedParentLinks){$('.'+prefix+'_item a').click(function(e){e.stopImmediatePropagation();});}};Plugin.prototype._menuToggle=function(el){var $this=this;var btn=$this.btn;var mobileNav=$this.mobileNav;if(btn.hasClass(prefix+'_collapsed')){btn.removeClass(prefix+'_collapsed');btn.addClass(prefix+'_open');}else{btn.removeClass(prefix+'_open');btn.addClass(prefix+'_collapsed');}
btn.addClass(prefix+'_animating');$this._visibilityToggle(mobileNav,btn.parent(),true,btn);};Plugin.prototype._itemClick=function(el){var $this=this;var settings=$this.settings;var data=el.data('menu');if(!data){data={};data.arrow=el.children('.'+prefix+'_arrow');data.ul=el.next('ul');data.parent=el.parent();if(data.parent.hasClass(prefix+'_parent-link')){data.parent=el.parent().parent();data.ul=el.parent().next('ul');}
el.data('menu',data);}
if(data.parent.hasClass(prefix+'_collapsed')){data.arrow.html(settings.openedSymbol);data.parent.removeClass(prefix+'_collapsed');data.parent.addClass(prefix+'_open');data.parent.addClass(prefix+'_animating');$this._visibilityToggle(data.ul,data.parent,true,el);}else{data.arrow.html(settings.closedSymbol);data.parent.addClass(prefix+'_collapsed');data.parent.removeClass(prefix+'_open');data.parent.addClass(prefix+'_animating');$this._visibilityToggle(data.ul,data.parent,true,el);}};Plugin.prototype._visibilityToggle=function(el,parent,animate,trigger,init){var $this=this;var settings=$this.settings;var items=$this._getActionItems(el);var duration=0;if(animate){duration=settings.duration;}
if(el.hasClass(prefix+'_hidden')){el.removeClass(prefix+'_hidden');if(!init){settings.beforeOpen(trigger);}
el.slideDown(duration,settings.easingOpen,function(){$(trigger).removeClass(prefix+'_animating');$(parent).removeClass(prefix+'_animating');if(!init){settings.afterOpen(trigger);}});el.attr('aria-hidden','false');items.attr('tabindex','0');$this._setVisAttr(el,false);}else{el.addClass(prefix+'_hidden');if(!init){settings.beforeClose(trigger);}
el.slideUp(duration,this.settings.easingClose,function(){el.attr('aria-hidden','true');items.attr('tabindex','-1');$this._setVisAttr(el,true);el.hide();$(trigger).removeClass(prefix+'_animating');$(parent).removeClass(prefix+'_animating');if(!init){settings.afterClose(trigger);}else if(trigger=='init'){settings.init();}});}};Plugin.prototype._setVisAttr=function(el,hidden){var $this=this;var nonHidden=el.children('li').children('ul').not('.'+prefix+'_hidden');if(!hidden){nonHidden.each(function(){var ul=$(this);ul.attr('aria-hidden','false');var items=$this._getActionItems(ul);items.attr('tabindex','0');$this._setVisAttr(ul,hidden);});}else{nonHidden.each(function(){var ul=$(this);ul.attr('aria-hidden','true');var items=$this._getActionItems(ul);items.attr('tabindex','-1');$this._setVisAttr(ul,hidden);});}};Plugin.prototype._getActionItems=function(el){var data=el.data("menu");if(!data){data={};var items=el.children('li');var anchors=items.find('a');data.links=anchors.add(items.find('.'+prefix+'_item'));el.data('menu',data);}
return data.links;};Plugin.prototype._outlines=function(state){if(!state){$('.'+prefix+'_item, .'+prefix+'_btn').css('outline','none');}else{$('.'+prefix+'_item, .'+prefix+'_btn').css('outline','');}};Plugin.prototype.toggle=function(){var $this=this;$this._menuToggle();};Plugin.prototype.open=function(){var $this=this;if($this.btn.hasClass(prefix+'_collapsed')){$this._menuToggle();}};Plugin.prototype.close=function(){var $this=this;if($this.btn.hasClass(prefix+'_open')){$this._menuToggle();}};$.fn[mobileMenu]=function(options){var args=arguments;if(options===undefined||typeof options==='object'){return this.each(function(){if(!$.data(this,'plugin_'+mobileMenu)){$.data(this,'plugin_'+mobileMenu,new Plugin(this,options));}});}else if(typeof options==='string'&&options[0]!=='_'&&options!=='init'){var returns;this.each(function(){var instance=$.data(this,'plugin_'+mobileMenu);if(instance instanceof Plugin&&typeof instance[options]==='function'){returns=instance[options].apply(instance,Array.prototype.slice.call(args,1));}});return returns!==undefined?returns:this;}};}(jQuery,document,window));