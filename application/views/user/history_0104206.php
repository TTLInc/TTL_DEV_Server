<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal = $this->lookup_model->getValue('104', $multi_lang);
$lhistory = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('105', $multi_lang);
$lmonthly = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('106', $multi_lang);
$lannually = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('107', $multi_lang);
$ltotal = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('78', $multi_lang);
$ldate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);
$ltutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('111', $multi_lang);
$lstudent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('244', $multi_lang);
$ltalkmap = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('245', $multi_lang);
$lmytalklist = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('246', $multi_lang);
$lshareonfb = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('247', $multi_lang);
$llocationoftutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('248', $multi_lang);
$llocationofstudent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('249', $multi_lang);
$lzoomin = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('250', $multi_lang);
$lapproxlocation = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('251', $multi_lang);
$llocationshow = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('108', $multi_lang);
$lmin = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('159', $multi_lang);
$lview = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('445', $multi_lang);	$lSTUDENT_ATTENDANCE   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('530', $multi_lang);	$lABSENT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('531', $multi_lang);	$lPRESENT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('532', $multi_lang);	$lSHARE_ON_FACEBOOK   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('652', $multi_lang);	$lSHARE_ON_FACEBOOK_tip   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('894', $multi_lang);	$types   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('702', $multi_lang);	$personals   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('895', $multi_lang);	$orgs   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('321', $multi_lang);	$lcredits  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('902', $multi_lang);	$statement = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSFpeVsw_KWwduTJUXinAG09guE5_lOOU&sensor=false"></script>


<?php //$this->layout->appendFile('javascript',"js/canvas/jquery-1.6.2.min.js");?>
<?php //$this->layout->appendFile('javascript',"js/canvas/html2canvas.js");?>
<?php //$this->layout->appendFile('javascript',"js/canvas/jquery.plugin.html2canvas.js");?>

<?php 
//---R&D@Oct-16-2013 : Load capture js
$this->layout->appendFile('javascript',"js/capture/capture.js");
//---R&D@Oct-16-2013 : Load capture js
?>

<?php 

$i			=0; 
$students 	= array();
$teachers 	= array();
?>
	<?php 
	$jsk = 0;
	foreach($history as $k=>$v):?>
 	<?php
	$students[$jsk]=$v['sid'];
	$teachers[$jsk]=$v['tid'];
	$jsk++;
	endforeach;
	
	$newarray = array_merge($students,$teachers);
	$newarray = array_unique($newarray);
	
	$nwdataArray = '';
	$noofcon = count($newarray);
	$i = 1;
	foreach ($newarray as $dts)
	{
		if($i == $noofcon)
		{
			$nwdataArray .= $dts;
		}else{
			
			$nwdataArray .= $dts.',';
		}
		$i++;
	}
?>

<script type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1"></script>
<script>
function displayInfobox(e) {
	pinInfobox.setOptions({title: e.target.Title, description: e.target.Description, visible:true, offset: new Microsoft.Maps.Point(0,25)});
	pinInfobox.setLocation(e.target.getLocation());
}

function hideInfobox(e) {
	pinInfobox.setOptions({ visible: false });
}		
		var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
		var profileImgNull = '<?php echo profile_image("");?>';
		var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
		var createClassPath = '<?php echo base_url("user/calendar/uid/");?>';
		var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';
		var geocoder 		= new google.maps.Geocoder();
		var iniCenter 		= 0;
		var snapShotControl = null;
		var latlngs=[];
		var map = new Object();
		var mapDataJson = '';
		var prev_infowindow = '';
		var pinInfoBox;  //the pop up info box
		var infoboxLayer = new Microsoft.Maps.EntityCollection();
		var pinLayer = new Microsoft.Maps.EntityCollection();
		var bingmapkey = "Au1Jki4Iyi13HSjmTuMeV89xzr-Vf5gAwuqfAW2FG-iDwMpd3umKenQIN4FmJ4Tv";

		$(window).load(function() {
		      
		});

		var _cid = '<?php echo $nwdataArray; ?>';
		
		$.get('<?php echo Base_url("search/getHIS");?>',{cid:_cid},function(msg){
					
					//alert(msg);
					if (String == msg.constructor) {      
						eval ('var result = ' + msg);
					} else {
						var result = msg;
					}
				
				mapDataJson = result.rows['result'];
				<?php 
				if(USER_CNT == "CN") {?>
					initializebingmap();
				<?php } else {?>
					initialize();
				<?php }?>
				
		})

		function initialize()
		{
			if (mapDataJson.length)
			{
			/*zoomVal=2;
			var latlng 			= new google.maps.LatLng(30, -125);
			var myOptions 		= {
									zoom: zoomVal,
									center: latlng,
									scaleControl:true,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								  }
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);*/
			this.newmap = map;
			if(document.getElementById('hdmapid'))
			{
				document.getElementById('hdmapid').value = map;
			}
			zoomVal=2;
			var latlng 			= new google.maps.LatLng(30, -125);
			var myOptions 		= {
									zoom: zoomVal,
									center: latlng,
									scaleControl:true,
									mapTypeId: google.maps.MapTypeId.ROADMAP
								  }
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				
				var bounds = new google.maps.LatLngBounds();
				var skvcount = 0;
				var minLat =0;
				var maxLat = 1000;
				var noofmarkers = <?php echo $noofcon; ?>;
				
				$.each(mapDataJson,function(k,v){
						var data = v;
						var lattrimmed = $.trim(data.Lat);
						//alert(data.provice);
						if(lattrimmed == '')
						{
							var ad = '';
							if(data.city != null){
								ad = ad + data.city +',';
							}
							if(data.provice != null){
								ad = ad + data.provice +',';
							}
							if(data.country != null){
								ad = ad + data.country;
							}
							
							geocoder.geocode( { 'address': ad}, function(results, status) {
									
									if (status == google.maps.GeocoderStatus.OK) {
										
										latlngs.push(results[0].geometry.location);
										
									}
									
									var a = results[0].geometry.location.lat();
									var b = results[0].geometry.location.lng();
									var ab= new google.maps.LatLng(a,b);
									var udatan = {};
									udatan['user_id'] 	= data.uid;
									udatan['lat'] 		= a;
									udatan['long'] 		= b;
									
									$.get('<?php echo base_url("search/storeL");?>',udatan,function(msg){	
											//alert(msg);
									})
									var iconBase = '<?php echo base_url("images");?>';
									var marker = new google.maps.Marker({
																		map: map,
																		position: ab,
																		title: data.username,
																		icon: iconBase + '/marker.png'
																	});
									google.maps.event.addListener(marker, "click", function()
									{
										this.map = map;
										if (data.myself == "1"){
											//marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
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
										//alert('h1'+provice);
										if (true || data.simple == "0")
										{
											
											data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
											data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
												
											var userprofileUrl = profileUrl(data.uid);
									
											var infoHtml = "";
											infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
											
											infoHtml += "<img src='" + profileImg(data.pic) + "' style='height:60px; width:50px; margin:4px;' />";
											if(provice == '')
											{
												infoHtml += "<p><span style='font-weight:bold; color:#b47700;'>Location: </span>"+city+""+ data.country + "</p>";
											}
											else{
											infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
											
											}
											
											infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/class</span></p>";
											
											infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
											
											infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
											infoHtml += "</div>";
											
											
											
											
											var infowindow = new google.maps.InfoWindow({
																						content: infoHtml,
																						height:450
																					});	
											infowindow.open(map,marker);		
					
										}
										
										if( prev_infowindow )
										{
											prev_infowindow.close();
										}
										prev_infowindow = infowindow;
										
									})
									
							})
							
						}else{
							//alert(data.hRate);
							latlngs.push(new google.maps.LatLng(data.Lat, data.Lng));
							
							var ab= new google.maps.LatLng(data.Lat,data.Lng);
							
							var iconBase = '<?php echo base_url("images");?>';
			        		var marker = new google.maps.Marker({
																map: map,
																position: ab,
																title: data.username,
																icon: iconBase + '/marker.png'
															});
							
			        		google.maps.event.addListener(marker, "click", function()
					        {
								
								
								
			        			this.map = map;
				        		if (data.myself == "1"){
									//marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
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
									
							//alert('h2'+provice);
							var city ='';
							if(data.city=='' || data.city==null || data.city== 'undefined')
							{
								city='';
							}else
							{
								city=data.city+',';
							}
							
							if (true || data.simple == "0"){
												
							var userprofileUrl = profileUrl(data.uid);
							
								data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
								data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
								
							
								var infoHtml = "";
									infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
									
									infoHtml += "<img src='" + profileImg(data.pic) + "' style='height:60px; width:50px; margin:4px;' />";
									if(provice == '')
									{
										infoHtml += "<p><span style='font-weight:bold; color:#b47700;'>Location: </span>"+city+""+ data.country + "</p>";
									}
									else{
									infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
									
									}
									
									infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/class</span></p>";
									
									infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
									
									infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
									infoHtml += "</div>";
									
									
									
									
									var infowindow = new google.maps.InfoWindow({
																				content: infoHtml,
																				height:450
																			});	
									infowindow.open(map,marker);		
			
								}
								
								if( prev_infowindow )
								{
									prev_infowindow.close();
								}
								prev_infowindow = infowindow;
								
							})
					    }
						/*var latlngnew = new google.maps.LatLng(data.Lat,data.Lng); 
						
						if(noofmarkers!=1)
						{
							bounds.extend(latlngnew);
						}*/
				})
				
				/*if(noofmarkers!=1)
				{
					map.fitBounds (bounds);
				}*/
				
			}else{
				var HOST = '<?php echo base_url();?>';
				$("#map_canvas").css("text-align","center").css({ opacity: 0.4 }).css('background-image', 'url('+ HOST +'images/google_map.png)').html("<span style='font-size:24px; font-weight:bold; color:#000000; position:relative; top:125px;'><?php if($roleId == 1){ ?>The TalkMap will show locations of your students.<?php } elseif($roleId == 0) { ?>The TalkMap will show locations of your tutors.<?php } else { echo "The TalkMap will show locations"; } ?></span>");
			}
		}
		
		function initializebingmap()
		{
			
			if (mapDataJson.length)
			{
				this.newmap = map;
				if(document.getElementById('hdmapid'))
				{
					document.getElementById('hdmapid').value = map;
				}
				map = new Microsoft.Maps.Map(document.getElementById('bingmap_canvas'), {
					credentials: 'Au1Jki4Iyi13HSjmTuMeV89xzr-Vf5gAwuqfAW2FG-iDwMpd3umKenQIN4FmJ4Tv',
					enableClickableLogo: false,
					enableSearchLogo:false,
					showDashboard:false,
					showScalebar:false,
					center: new Microsoft.Maps.Location(30, -125), 
					zoom: 2
				});
				
				/*var bounds = new google.maps.LatLngBounds();
				var skvcount = 0;
				var minLat =0;
				var maxLat = 1000;
				var noofmarkers = <?php echo $noofcon; ?>;*/
				
				$.each(mapDataJson,function(k,v){
						var data = v;
						var lattrimmed = $.trim(data.Lat);
						if(lattrimmed == '')
						{
							var ad = '';
							if(data.city != null){
								ad = ad + data.city +',';
							}
							if(data.provice != null){
								ad = ad + data.provice +',';
							}
							if(data.country != null){
								ad = ad + data.country;
							}
							
							$.ajax({
								url: "https://dev.virtualearth.net/REST/v1/Locations",
								dataType: "jsonp",
								data: {
									key: "Au1Jki4Iyi13HSjmTuMeV89xzr-Vf5gAwuqfAW2FG-iDwMpd3umKenQIN4FmJ4Tv",
									q: ad
								},
								jsonp: "jsonp",
								success: function (result) {
									
									if (result &&
										   result.resourceSets &&
										   result.resourceSets.length > 0 &&
										   result.resourceSets[0].resources &&
										   result.resourceSets[0].resources.length > 0) 
									{
										var center = map.getCenter();
										var a = result.resourceSets[0].resources[0].point.coordinates[0];
										var b = result.resourceSets[0].resources[0].point.coordinates[1];
										
										var udata = {};
										udata['user_id'] 	= data.uid;
										udata['lat'] 		= a;
										udata['long'] 		= b;
										
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
										//alert('h1'+provice);
										if (true || data.simple == "0")
										{
											data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
											data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
											var userprofileUrl = profileUrl(data.uid);
											var infoHtml = "";
											infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";											
											infoHtml += "<img src='" + profileImg(data.pic) + "' style='height:60px; width:50px; margin:4px;' />";
											if(provice == '')
											{
												infoHtml += "<p><span style='font-weight:bold; color:#b47700;'>Location: </span>"+city+""+ data.country + "</p>";
											}
											else{
											infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
											}
											infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/class</span></p>";
											infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
											infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
											infoHtml += "</div>";
											
											var infoboxOptions = {width :350, height :150, showCloseButton: true, zIndex: 0, offset:new Microsoft.Maps.Point(10,0), showPointer: true, visible: false};
											pinInfobox = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0, 0), infoboxOptions);
											infoboxLayer.push(pinInfobox);
										
										
											//for (var i = 0 ; i < 10; i++){
												//add pushpins
												var latLon = new Microsoft.Maps.Location(result.resourceSets[0].resources[0].point.coordinates[0], result.resourceSets[0].resources[0].point.coordinates[1]);
												var pin = new Microsoft.Maps.Pushpin(latLon,{icon:"<?php echo base_url("images")."/marker.png";?>",draggable: false});
												pin.Title = data.username;//usually title of the infobox
												pin.Description = infoHtml; //information you want to display in the infobox
												pinLayer.push(pin); //add pushpin to pinLayer
												Microsoft.Maps.Events.addHandler(pin, 'click', displayInfobox);
											//}
										
											map.entities.push(pinLayer);
											map.entities.push(infoboxLayer);
										}
									}
								}
							});
						}else{
							this.map = map;
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
							if (true || data.simple == "0")
							{
								data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
								data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
								var userprofileUrl = profileUrl(data.uid);
								var infoHtml = "";
								infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";											
								infoHtml += "<img src='" + profileImg(data.pic) + "' style='height:60px; width:50px; margin:4px;' />";
								if(provice == '')
								{
									infoHtml += "<p><span style='font-weight:bold; color:#b47700;'>Location: </span>"+city+""+ data.country + "</p>";
								}
								else{
								infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
								}
								infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/class</span></p>";
								infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
								infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile</a></span></div>";
								infoHtml += "</div>";
								
								var infoboxOptions = {width :350, height :150, showCloseButton: true, zIndex: 0, offset:new Microsoft.Maps.Point(10,0), showPointer: true, visible: false};
								pinInfobox = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0, 0), infoboxOptions);
								infoboxLayer.push(pinInfobox);
								
								var latLon = new Microsoft.Maps.Location(result.resourceSets[0].resources[0].point.coordinates[0], result.resourceSets[0].resources[0].point.coordinates[1]);
								var pin = new Microsoft.Maps.Pushpin(latLon,{icon:"<?php echo base_url("images")."/marker.png";?>",draggable: false});
								pin.Title = data.username;//usually title of the infobox
								pin.Description = infoHtml; //information you want to display in the infobox
								pinLayer.push(pin); //add pushpin to pinLayer
								Microsoft.Maps.Events.addHandler(pin, 'click', displayInfobox);
							
								map.entities.push(pinLayer);
								map.entities.push(infoboxLayer);
							}
					    }
			});
				
			}else{
				var HOST = '<?php echo base_url();?>';
				$("#bingmap_canvas").css("text-align","center").css({ opacity: 0.4 }).css('background-image', 'url('+ HOST +'images/google_map.png)').html("<span style='font-size:24px; font-weight:bold; color:#000000; position:relative; top:125px;'><?php if($roleId == 1){ ?>The TalkMap will show locations of your students.<?php } elseif($roleId == 0) { ?>The TalkMap will show locations of your tutors.<?php } else { echo "The TalkMap will show locations"; } ?></span>");
			}
		
		}

		function shareonfacebook(){
			html2canvas($("#map_canvas"), {
				//proxy: "<?php echo base_url('js/capture/server.js'); ?>",
				proxy: "<?php echo base_url('js/capture/html2canvasproxy.php'); ?>",
				useCORS: true,
				onrendered: function(canvas) {	
				var myImage = canvas.toDataURL("image/png");
					$.post("<?php echo base_url('js/capture/save.php'); ?>", {data: myImage}, function (file) {
						imgurl = "<?php echo base_url('js/capture/tmp/'); ?>/" + file;
						$( '#canvasImage' ).val(imgurl);
					});
				}
			});
			
			var currentUrl      = encodeURIComponent(location.href);
			//var imgurl 			= document.getElementById('canvasImage').value; 
			var imgurl 			= "https://dev.thetalklist.com/images/google_map.png";
			
			var userdata = document.getElementById('userdata').value; 
			var userlocation = document.getElementById('userlocation').value; 
			var userprofileurl = document.getElementById('userprofileurl').value;
			//var imgurl = '<?php echo base_url('images/sharefb.jpg'); ?>';
			var shareurl = '';
			shareurl = shareurl + "https://www.facebook.com/sharer.php?s=100&";
			userprofileurl = '<?php echo base_url('user/history/uid/'.$this->uid); ?>';
			shareurl = shareurl + "p[title]=My Personal TalkMap&";
			shareurl = shareurl + "p[summary]=Learning English on https://www.TheTalkList.com" + userlocation + "&";
			shareurl = shareurl + "p[url]=" + userprofileurl + "&";
			shareurl = shareurl + "p[images][0]=" + imgurl + "&";			
			window.open(shareurl,'sharer','toolbar=0,status=0,width=548,height=325');
		}
		
		
		function shareonweibo(){
			var link = location.href;
			var shareurl 		= '';
			shareurl  			= "https://service.weibo.com/share/share.php?title=My Personal TalkMap&pic=https://www.thetalklist.com/images/sharefb.jpg&url=";
			shareurl = shareurl + link;
			window.open(shareurl,'sharer','toolbar=0,status=0,width=548,height=325');

		}
		
		function shareonqq(){
			var link = location.href;
			var shareurl 		= '';
			shareurl 			= shareurl + "https://share.v.t.qq.com/index.php?c=share&a=index&";
			shareurl 			= shareurl + "title=My Personal TalkMap&" ;
			shareurl 			= shareurl + "url=" + link + "&";
			shareurl 			= shareurl + "pic=https://www.thetalklist.com/images/sharefb.jpg";			
			window.open(shareurl,'sharer','toolbar=0,status=0,width=548,height=325');

		}

		/*
		function takeSnap(userdata){
			  var snapShotControl = new SnapShotControl();
			
		      imgSize = new GSize(400, 400);
		      snapShotControl.setMapSize(imgSize);
		      
		      var mapType = 'roadmap';
		      snapShotControl.setMapType(mapType);
		
		      var format = 'jpg';
		      snapShotControl.setFormat(format);
				 
		      var url = snapShotControl.getImage();
		      
		      window.open("https://www.facebook.com/sharer.php?s=100&amp;p[title]={$data.custom_title}&amp;p[summary]={$data.short_description}&amp;p[url]={$data.url}&amp;p[images][0]={$data.matches}&','sharer','toolbar=0,status=0,width=548,height=325");
		      
		      var url = snapShotControl.getImage();
		      alert('url'+url)
		      
	    }
		*/
		function profileUrl(uid){
			
			return profileUrlPath+'/'+uid;
		}

		function profileImg(src){
		
			if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
				return profileImgNull;
			}			
			return profileImgPath+'/'+src;
		}
		
		/*
		$('#sharebtnnw').click(function(){
			alert('hi');
			    var el = $('#map_canvas').get(0); 
			    html2canvas.Preload(el, {
			        complete: function(image){
			            var queue = html2canvas.Parse(el, image, {elements: el}),
			                $canvas = $(html2canvas.Renderer(queue, {elements: el}));
			            	$('#sharebtn').attr('src',$canvas[0].toDataURL());
			               alert($canvas[0].toDataURL())
			        }
			    });
			});
		
		*/
		
</script>


<!--<body onLoad="initialize()">-->
 <div class="baseBox baseBoxBg clearfix">
    	<?php //echo 'profileuid---'.$linkType;exit; ?>
        <div class="content_main fr">
        	<div class="main_inner">
				<?php 
					if($linkType == 's_private')
					{
						$ulClass = 'student_prof';
					}else{
						$ulClass = 'teacher_prof';
					}
				?>
				
			   <ul class="<?php echo $ulClass; ?>"> 
                	<?php if($this->session->userdata['roleId']==4){
					
					echo organization_menu($linkType,'h_prof',$profile['uid']);
					}
					else if($this->session->userdata['roleId']==5){
					
					echo Affiliate_menu($linkType,'h_prof',$profile['uid']);
					}
					else
					{
					 
					// echo profile_menu($linkType,'h_prof',$profile['uid']);
					 
					 }?>
               </ul>
			   <?php if($linkType == 't_public'): ?>
			   <?php echo mailAptBtn($chkfreesession,$profile['uid']);?>
			   <?php endif; ?>
			   <!--
              <ul class="student_prof">
                    <?php //echo profile_menu('s_private','p_dasb',$profile['uid']);?>
              </ul>-->
                <!--
                <ul class="student_prof">
					
                    <li><a class="p_dasb " href="<?php echo Base_url('user/dashboard');?>"><span>Dashboard</span></a></li>
					<li><a href="<?php echo Base_url('user/calendar');?>" class="c_prof"><span>Calendar</span></a></li>
                    <li><a href="<?php echo Base_url('user/user/teachers/uid/'.$this->uid);?>" class="t_prof"><span>talklist</span></a></li>
					<li><a href="<?php echo Base_url('user/history');?>" class="h_prof prof_on" onclick="history.go(-1)"><span>History</span></a></li>
					<li><a href="<?php echo Base_url('user/lessons');?>" class="a_prof"><span>Lessons </span></a></li>
					<li><a href="<?php echo Base_url('user/inbox');?>" class="i_prof"><span>beepbox</span></a></li>
					<li><a href="<?php echo Base_url('user/account');?>" class="p_prof "><span>Account</span></a></li>
                    
                </ul>
                -->
                <!--/student_prof--> 
                <div id="student_prof_Wp">
                    <div class="mod">
						<!--T9 Talk Map -->
                        <?php 
						if($this->session->userdata['roleId'] < 4) {?>
                        	<div class="content tle" style="padding-top:0px;">
								<h2><?php echo $statement;?></h2>
								<span class="btnExport">
									<input type="text" id="monthyear" value="<?php echo date("m/Y");?>" class="input" />
									<?php
									$arrVal = $this->lookup_model->getValue('1270', $multi_lang);
									$lngExport = $arrVal[$multi_lang];?>
									<input class="ftinputcls" type="button" id='export' value="<?php echo $lngExport;?>" />
								</span>
							</div>
                        <?php }?>    
                            <div class="content tle">
                            	<h2><?php echo $ltalkmap;?> 
									
<?php if($multi_lang != 'ch'){ ?>
<span class="fbspanshare" style="font-size:1em;width:132px;">
<!--<input class="ftinputcls" type="button" id='sharebtnnw' onclick='shareonfacebook();' value="<?php echo $lshareonfb;?>" >-->
</span>
<?php } else{ ?>
<span class="fbspanshare2" style="font-size:1em;">
Share:
<input class="ftinputcls" type="button" id='sharebtnnw' onclick='shareonweibo();' value="<?php echo 'Sina Weibo';?>" >
<input class="ftinputcls" type="button" id='sharebtnnw' onclick='shareonqq();' value="<?php echo 'QQ';?>" >
</span>
<?php } ?>								
									
									<span style="float:right;padding-right:132px;font-size:1em;" id="talklist">
									<?php echo $lmytalklist;?>:
									</span>
                            	</h2>
                            	</div>
                        
            <?php 
			if(USER_CNT == "CN") {?>
            	<div class="search_rt_top"  id="bingmap_canvas" style="position:relative;height:500px;display:block;"></div>
			<?php } else {?>
            	<div class="search_rt_top history-map"  id="map_canvas" style="height:500px;display:block;"></div>
            <?php }?>   
						<?php if($history){ ?>
						<span style="float:right;">*<?php echo $lapproxlocation;?></span>
						<span style="float:left;"><?php echo $lzoomin;?></span>
						<?php  } ?>
                    	<!--T9 Talk Map -->
						
                            <div class="content tle"><h2><?php echo $lhistory;?></h2></div>
                        
                        <div class="bd">
                          <div class="historyWp">
                               <div class="history_tle f18 agnC">
                               <a href="?type=month" <?php if($filterType=='month'):?>class="history_tle_on"<?php endif;?> ><?php echo $lmonthly;?></a> / 
                               <a href="?type=year" <?php if($filterType=='year'):?>class="history_tle_on"<?php endif;?> ><?php echo $lannually;?></a> / 
                               <a href="?type=all" <?php if($filterType=='all'):?>class="history_tle_on"<?php endif;?> ><?php echo $ltotal;?></a></div>
                               <table class="history_table f14">
                                   <thead>
                                    	<tr><th><?php echo $ldate;?></th>
                                        <th>
											<?php 
											if($this->session->userdata['roleId']<4){
												echo $lstudent;
											}
                                            else
                                            {
												echo $ltutor."/".$lstudent;
                                            }?>
                                        </th>
                                        <th>
											<?php 
											if($this->session->userdata['roleId']<4) {
												echo $ltutor;
											}
											else
											{
												echo $lSTUDENT_ATTENDANCE;
											}?>
                                        </th><th><?php echo $types; ?></th><th><?php if($this->session->userdata['roleId']<4){ echo $lcredits;} else {echo $ltotal;}?></th></tr>
                                   </thead>
                                   <tbody>
									<?php if($history){ 
                                   		
                                   			$i			= 0; 
											$total 		= 0;
											$students 	= array();
											$teachers 	= array();
											
											?>
											
                                   <?php foreach($history as $k=>$v):?>
									<?php
											
											$students[$i]=$v['sid'];
											$teachers[$i]=$v['tid'];
											
											/*$action = unserialize(@$v['action']);
											if($action['studentConnected']==1)
											{
												$sconnect='Y';
											}
											else
											{
												$sconnect='N';
											}
											if($action['tutorConnected']==1)
											{
												$tconnect='Y';
											}
											else
											{
												$tconnect='N';
											}*/
                                   	?>
                                   		<tr>
                                   			<td><?php echo date( 'M d, Y | h:i a ' , outTime($v['startTime']) );?></td>
                                   			<td>
                                   				<?php
												if($this->session->userdata['roleId']<4) {
												?>
                                                	<?php if($profile['uid'] != $v['sid']):?>
                                                        <a href="<?php echo tl_url('user/calendar',$v['sid']);?>"><?php echo $v['sFN'],' ',$v['sLN']?></a>
                                                    <?php else:?>
                                                        <?php echo $v['sFN'],' ',$v['sLN']?>
                                                        
                                                    <?php endif;?>
												<?php
												}
												else
												{?>
													<?php 
													if($profile['uid'] != $v['tid']):?>
                                                        <a href="<?php echo tl_url('user/calendar',$v['tid']);?>"><?php echo $v['tFN'],' ',$v['tLN']?></a>
                                                    <?php else:?>
                                                        <?php echo $v['tFN'],' ',$v['tLN']?>
                                                    <?php endif;?>
                                               <?php }?> 
                                   			</td>
											<td>
											                                   				<?php
												if($this->session->userdata['roleId']<4) {
												?>
                                                	<?php if($profile['uid'] != $v['tid']):?>
                                                        <a href="<?php echo tl_url('user/calendar',$v['tid']);?>"><?php echo $v['tFN'],' ',$v['tLN']?></a>
                                                    <?php else:?>
                                                        <?php echo $v['tFN'],' ',$v['tLN']?>
                                                    <?php endif;?>
												<?php
												}
												else
												{?>
													<?php if($v['s_attend'] == 1){echo $lPRESENT;}else{echo $lABSENT;} ?>
                                               <?php }?>
											</td>
											<td><?php if($v['school_id']==0) echo $personals; else echo $orgs; ?> </td>
                                   			<td>
												<b>
													<!--25 <?php echo $lmin;?>-->
													<?php 
													if ($this->session->userdata('uid') == $v['sid']) {
														$fee = $v['fee']*(-1);
													} else {
														$fee = $v['t_hrate'];
													}
													echo $fee;
													$total += ($fee*1);
													//echo "0";$total += 0;
													?>
												</b>
											</td>
                                   		</tr>
                                   
								<?php $i++; endforeach;?>
								<?php  }?>
								<?php
                                   		if($history){
                                   		$newarray = array_merge($students,$teachers);
										$newarray = array_unique($newarray);
										$historycounter = count($newarray);
                                ?>
                                   		
                                   			
                                   			<?php
                                   			for($j=0;$j<count($newarray);$j++){ ?>
                                   				
                                   				<script>document.getElementById("talklist").innerHTML = '<?php echo $lmytalklist ?> : <?php echo $historycounter;?>'</script>
                                   			<?php }
                                   		}else{ ?>
                                   
                                   				
                                   <?php } ?>
                                   </tbody>
                               </table>
                               <div class="history_total agnR fb f30">
                                   <?php echo $ltotal;?>:  &nbsp;&nbsp;
								   <span class="c06a0c1">
									<?php
									echo $total;
									//echo count($history)*25;?> <?php //echo $lmin;?></span>  
                               </div>
                          </div>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
</div>
	<script>
	window.delClickData = '';//save the param del data
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		$('.del').click(function(){
			var _tr = $(this).parents('tr');
			var _delId = _tr.attr('inboxId');
			var _data = {id:_delId}; 
			window.delTrObj = _tr;
			$('#dialog1').dialog({
				modal:true,
				buttons: {
					"Delete the item": function() {
						delDo();
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			})
		})
		$("span.fbspanshare").hover(function () {
			$(this).append('<div class="tooltip"><p><?php echo $lSHARE_ON_FACEBOOK_tip; ?></p></div>');
		}, function () {
			$("div.tooltip").remove();
		});
		
	})
	function delDo(){
				
		var _delId = window.delTrObj.attr('inboxId');
		var _data = {id:_delId}; 
		
		$.post('<?php echo base_url("user/del_message");?>',_data,function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$('#dialog').html('Del Success..');
				$('#dialog').dialog({modal:true});
				window.delTrObj.remove();
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			//$('#send').attr('buttontype','done');
		})		
	}
	</script>
	
	 <script>
	var attempts = 0;
function addToPotential(id){
 
	<?php if($roleIdn != 0) {?>
		alert('Bookings are reserved for student accounts');
		return false;
	<?php } else { ?>
	$('#dialog').html('updating');
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$.post('<?php echo base_url('user/addPotentialTeachers');?>',{id:id},function(result){
		if (String == result.constructor) {
			//eval ('var result = ' + result);
			var result;
			//result = eval('(' + msg + ')');
			eval('result = ' + result);
		}
		$('#dialog').attr('buttonType','done');
		if(result.error){
			$('#dialog').html(result.msg);
		}
		else {
			$('#dialog').html('updated');
			//$('#dialog').attr('buttonType','done');
		}
	})
	<?php
	}
	?>
}
	</script>
	
	<script>
	function bookNow(tid,username)
{

//alert(tid);

var lastClickedOnBook = false;
	//prevent multiple clicks
	if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	
	//if(_uid == '')
	//{
		//alert('Login First!');
		//return false;
	//}
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	//window.returnvar = true;
	
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
	/*alert(msg);
	return false;*/
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(!json.enough){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = true;
			
		}else if(!json.availabletobook){
			window.returnvar = false;
			window.avl = false;
			window.profileComplete = true;
			
		}else if(!json.profileCompletion){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = false;
			
		}else{
			window.returnvar = true;
		}
		if(!json.firstBookNow ){
			window.firstBookNow = false;
		}else{
			window.firstBookNow = true;
			window.profileComplete = true;
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
		
		
		
	})
	setTimeout(function(){
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = 'You have already booked your Session.';
				}else{
					var alertHTML = 'You have already booked your Free Session.';
				}
				
				
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true});
				return false;
			}else if(window.profileComplete == false){
				alert('Please complete your personal profile before your booking');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
				else if(window.enough==true){
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session.";
			      var conf = confirm(message);
				 if(conf == true)
			{
			 	// send message to tutor
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid},function(msg){
					//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			}else{
				return false;
			}
			  
			}
			
			
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = 'Insufficient credits to buy a session.  Please <a href="'+rechargeURL+'" >recharge</a> account.';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true});
				return false;
			}
		}else{
			if(window.firstBookNow == false){
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			}else{
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session.";
			}
			//var message = "You are booking a class with "+username+" right now. If they confirm this booking then you will automatically be launched into the Vee-session. If they haven’t entered your classroom within the 3minute countdown timer, then feel free to exit the session and your account will be credited.";
			//var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			
			var conf = confirm(message);
			if(conf == true)
			{
				// send message to tutor
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid},function(msg){
				
						//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			}else{
				return false;
			}
			lastClickedOnBook = false;
		}
		
		
	},2500);
	//lastClickedOnBook = false;
}
window.configs = <?php echo json_encode($config);?>;
	</script>
	
	<div id="dialog1" title="Comfirm" style="display:none">
		<p>Are you sure to delete it?.</p>
	</div>
	<input type="hidden" id="hdmapid" value="" />
    <input type="hidden" id="userdata" value="" />
    <input type="hidden" id="userlocation" value="" />
    <input type="hidden" id="userprofileurl" value="" />
    <input type="hidden" id="canvasImage" value="" />
<style>
span.fbspanshare {
  cursor: pointer;
  display: inline-block;
  color: White;
  border-radius: 8px;
  position: relative;
}
span.fbspanshare img {
  vertical-align : middle;
}
div.tooltip {
  background-color: #3399cc;
  color: White;
  position: absolute;
  left:-160px;
  top: -29px;
  z-index: 1000000;
  width: 150px;
  border-radius: 5px;
}
div.tooltip:before {
  border-color: transparent #3399cc transparent transparent;
  border-left: 6px solid #3399cc;
  border-style: solid;
  border-width: 6px 0px 6px 6px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
  position: absolute;
  top: 40%;
  left:150px;
}
div.tooltip p {
  margin: 10px;
  color: White; font-size:12px; text-shadow:none; line-height:16px; font-weight:bold;
}
</style>
 
<style>
.wrap {
    margin-top:  210px;
}
</style> 
<?php $this->layout->appendFile('javascript',"js/jquery.mtz.monthpicker.js");?> 
<script type="text/javascript">
$(document).ready(function(){
	$("#export").click(function(){
		$("#monthyear").css("border","");
		if ($("#monthyear").val()!="") {
			var myVal = $("#monthyear").val().replace("/","-");
			self.location = "<?php echo base_url();?>user/export/"+myVal;
		} else {
			$("#monthyear").css("border","1px solid #FF0000");
		}
		return false;
	});
	$('#monthyear').monthpicker();
});
</script>
