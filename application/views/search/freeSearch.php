<?php $this->layout->appendFile('css',"css/search.css");?>
<?php $this->layout->appendFile('javascript',"js/jquery.placeholder.js");?>
<?php $this->layout->appendFile('javascript',"js/jq.page.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"http://maps.googleapis.com/maps/api/js?key=AIzaSyCSFpeVsw_KWwduTJUXinAG09guE5_lOOU&sensor=false");?>

<script>
window.perPage = 6;
window.searchData = [];
var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
var profileImgNull = '<?php echo profile_image("");?>';
var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
var createClassPath = '<?php echo base_url("user/calendar/uid/");?>';
var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';
$(function(){
	$('#country').change(function(){
		var _cid = $(this).val();
		$.getJSON('<?php echo Base_url("user/getProvices");?>',{cid:_cid},function(provices){
			if (String == provices.constructor) {      
				eval ('var provices = ' + provices);
			}
			$('select#province').empty();
			provices[0] = 'All';
			for (var key in provices) {
				if (!provices.hasOwnProperty(key)) {
					continue;
				}
				if(key == 0){
					var option = $('<option />').val(key).append(provices[key]).attr('selected','selected');
				}
				else{
					var option = $('<option />').val(key).append(provices[key]);
				}
				$('select#province').append(option);    
			}
		});
	});
	$('#country').trigger('change');
	/*
	var langs = <?php echo json_encode($langs);?>;
	$.each(langs,function(k,v){
		langs[k]['value'] = v['lang'];
	})
	$('#langInput').autocomplete({
		minLength: 0,
		source: langs,
		focus: function( event, ui ) {
			$( "#langInput" ).val( ui.item.lang );
			return false;
		},
		select: function( event, ui ) {
			$( "#langInput" ).val( ui.item.value );
			$( "#langInput" ).before('<span><span class="text">'+ui.item.value+'</span><a href="javascript:void(0)" class="delLangs">x</a></span>');
			$( "#langInput" ).val( '' );
			$('#langs').val($('#langs').val()+ui.item.value+',');
			return false;
		}
	});
	$('.delLangs').live('click',function(){
		var _clickEl = $(this);
		var _index = _clickEl.parents('span').index();
		var _val = _clickEl.prev().html();
		var _langs = $('#langs').val();
		var _langsArray = _langs.split(',');
		_langsArray.splice(_index,1);
		_langs = _langsArray.join(',');
		$('#langs').val(_langs);
		_clickEl.parents('span').remove();
		//var sIndex = _langs.indexOf(',',_index+1);
		//console.info(_index,_langsArray);
	})
	$('.langu').click(function(){
		$('#langInput',this).focus();
	})*/
	$('input[placeholder]').placeholder();
	$('textarea[placeholder]').placeholder();
});
</script>
<div class="search">
	<div class="search_top">Search</div>
	<div class="search_mid">
		
		
		<div class="search_lf">
			<div class="search_lf_top">
				<span class="left-ttl">Build a Tutor</span>
			</div>
			
			<div class="search_lf_mid search_lf_mid2">
	  		
			<div class="search_lf_mid">
				<!--<a href="javascript:void(0);" class="btn_red" style="width:167px;" id="free_search" target="_blank">Free Session Search</a>-->
				<input type="hidden" id="free_search">
				<input type="hidden" value="" id="free_session"  name="freeSes" />
			</div>
			
				
				<dl>
					<dt><span class="icon_1">Languages</span></dt>
					<dd>
						<div class="select-box-marg">
							<?php echo form_dropdown('langInput1',$langsAll,'',' id="langInput1" class="raduisSelect w78" ');?>
						</div>
					</dd>
					<dd>
						<div>
							<?php echo form_dropdown('langInput2',$langsAll,'',' id="langInput2" class="raduisSelect w78" ');?>	
						</div>
					</dd>
				</dl>
				<dl>
					<dt><span class="icon_2">MAXIMUM COST USD</span></dt>
					<dd>
						<input type="hidden" value="0" id="hourRateStart" name="hourRateStart" />
						<?php echo form_dropdown('hourRateEnd',$price,'100',' id="hourRateEnd" class="raduisSelect w78"  ');?>
					</dd>
				</dl>
					<dl>
					<dt><span class="icon_2">GENDER</span></dt>
					<dd>
						<select class="raduisSelect" name="gender" id="gender">
							<option value="all">all</option>
							<option value="0">female</option>
							<option value="1">male</option>
							
						</select>
					</dd>
				</dl>
				<dl>
					<dt><span class="icon_3">LOCATION</span></dt>
					<dd class="white">
						<?php echo form_dropdown('country',$countries,'0',' id="country" class="raduisSelect w78 select-box-marg"  ');?>
						<select class="raduisSelect w78" id="province"></select>
							
					</dd>
				</dl>
				
				<dl>
					<dt><span class="icon_none">Availability</span></dt>
					<dd><span class="nobg check">
						<input id="online" name="online" value="1" type="radio">
						<label for="female" class="radio-btn">Online Now</label>
						</span> <span style="float:right"><img src="<?php echo base_url('images/arrow.png');?>" width="8" height="18" alt="ed" /></span></dd>
				</dl>
				
				
				
				<dl>
					<dt><span class="c133e5f icon_8">DISCUSSION TOPICS</span></dt>
					<dd>
						<input name="keywords" id="keywords" type="text" class="raduisSelect" style="width:170px; height:21px;"  value="">
										
					</dd>
				</dl>
				
				<dl>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic1" name="discussiontopic" value="TOEIC" type="radio"><label for="female" class="radio-btn">TOEIC</label></span></dd>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic2" name="discussiontopic" value="TOEFL" type="radio"><label for="female" class="radio-btn">TOEFL</label></span></dd>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic3" name="discussiontopic" value="Business" type="radio"><label for="female" class="radio-btn">Business</label></span></dd>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic4" name="discussiontopic" value="Medical" type="radio"><label for="female" class="radio-btn">Medical</label></span></dd>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic5" name="discussiontopic" value="Finance" type="radio"><label for="female" class="radio-btn">Finance</label></span></dd>
					<dd class="rad-btn-mar"><span class="nobg check"><input id="discussiontopic6" name="discussiontopic" value="Software" type="radio"><label for="female" class="radio-btn">Software</label></span></dd>
				</dl>
				
				
				
				
				<div class="submit_btn submit_btn2"><input value="Search" class="btn_red" id="search" type="submit"></div>
			</div>
		</div>
		
		
		
		<!--//left end-->
		<div class="search_rt">
			<div class="search_rt_top" id="map_canvas" style="height:500px">
				<img src="<?php echo base_url('images/temp/474_296.jpg');?>">
			</div>
			<div class="search_rt_mid">
				<div class="search_rt_mid_t">
					<span class="search_rt_mid_t_lf lh30">Showing <font class="number nowShow">1-6</font> out of <font class="number count">20</font> results</span>
					<div class="search_rt_mid_t_rt">
						<div class="v_ajax_page"></div>
					</div>
					<span id="sortBy">
						<select class="raduisSelect w78 search_rt_mid_t_rt mr30 sortKeys">
							<option value="firstName_1">Name</option>
							<option value="hRate_1">Price</option>
							<option value="avgRate_0">Rating</option>
						</select>
						
							<span class="search_rt_mid_t_rt lh30 mr10">Sort By</span>
							<span class="search_rt_mid_t_rt mr30 lh30">
								<a href="#" class="viewCount">View <font class="number">20</font></a>  |  <a href="#" class="viewCount">View <font class="number">All</font></a> 
							</span>
					</span>
				</div>
				<div class="result_title">Featured Tutors</div>
				<div class="result_list featured">

				</div>
				<div class="result_title">More Results</div>
				<div class="result_list result">

				</div>
				<div class="fr pt20"><div class="v_ajax_page"><a class="first" href="#">&lt;&lt;</a><a class="prev" href="#">&lt;</a><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a class="next" href="#">&gt;</a><a class="last" href="#">&gt;&gt;</a></div></div>
			</div>
		</div>
		<!--//right end-->
	</div>
</div>

<?php if($this->session->userdata('free_session') == 'y'):?>
<textarea id="resultListTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImg($T.pic)}"/></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1>{$T.lesson_name} - <font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<p></p>
		</div>
		<div class="dd_rt">${$T.hRate}/class</div>
	</div>
	<div class="dd_bot">
		<div class="stars"><a class="current_rating" style="width:{$T.avgRate*30}px" href="#"></a><a class="one-star" href="#"></a><a class="two-stars" href="#"></a><a class="three-stars" href="#"></a><a class="four-stars" href="#"></a><a class="five-stars" href="#"></a></div>
		<div class="btn_group"><a class="btn_red_big" href="{createClassUrl($T.uid)}">Book Free Session</a></div>
	</div>
</dd>

-->
</textarea>
<?php else: ?>
<textarea id="resultListTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImg($T.pic)}"/></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1>{$T.lesson_name} - <font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<p></p>
		</div>
		<div class="dd_rt">${$T.hRate}/class</div>
	</div>
	<div class="dd_bot">
		<div class="stars"><a class="current_rating" style="width:{$T.avgRate*30}px" href="#"></a><a class="one-star" href="#"></a><a class="two-stars" href="#"></a><a class="three-stars" href="#"></a><a class="four-stars" href="#"></a><a class="five-stars" href="#"></a></div>
		<div class="btn_group"><a class="btn_blue_big" href="javascript:void(0)" onclick="addToPotential({$T.uid})">Add to Potential Tutors</a><a class="btn_red_big" href="{createClassUrl($T.uid)}">Create Appointment</a></div>
	</div>
</dd>

-->
</textarea>
<?php endif; ?>

<textarea id="freeResultListTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImg($T.pic)}"/></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1>{$T.lesson_name} - <font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<p><span>Description:</span>  {$T.lesson_desc}.</p>
		</div>
		<div class="dd_rt2">{$T.hRate}</div>
	</div>
	<div class="dd_bot">
		<div class="stars"><a class="current_rating" style="width:{$T.avgRate*30}px" href="#"></a><a class="one-star" href="#"></a><a class="two-stars" href="#"></a><a class="three-stars" href="#"></a><a class="four-stars" href="#"></a><a class="five-stars" href="#"></a></div>
		<div class="btn_group"><a class="btn_blue_big" href="javascript:void(0)" onclick="addToPotential({$T.uid})">Add to Potential Tutors</a><a class="btn_red_big" href="{createClassUrl($T.uid,{$firstTime})}">Create Appointment</a></div>
	</div>
</dd>

-->
</textarea>
<script>
function addToPotential(id){
	$('#dialog').html('updating');
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$.post('<?php echo base_url('user/addPotentialTeachers');?>',{id:id},function(result){
		if (String == result.constructor) {      
			eval ('var result = ' + result);
		}
		$('#dialog').attr('buttonType','done');
		if(result.error){
			$('#dialog').html(result.msg);
		}
		else {
			$('#dialog').html('updated');
		}
	})
}
function profileUrl(uid){
	/*var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
	var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
	var createClassPath = '<?php echo base_url("user/profile/uid/");?>';
	var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';*/
	return profileUrlPath+'/'+uid;
}
function profileImg(src){
	//console.info(src);
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		return profileImgNull;
	}
	return profileImgPath+'/'+src;
}

function createClassUrl(uid,first){
	return createClassPath+'/'+uid+'/'+first;
}
$(function(){
	// function for free search
	$("#free_search").click(function(){		

		$("#free_session").val('y');
		$("#sortBy").hide();
	
		var _data = {};
		_data['freeSes'] = $('#free_session').val();	
		
		//_data['langs'] = $.trim($('#langs').val());
		_hRateStart = $('#hourRateStart').val();
		_hRateEnd = $('#hourRateEnd').val();
		if(parseInt(_hRateEnd)<parseInt(_hRateStart)){
			$('#dialog').html('Hourly Rate "To" field must be larger than "From".');
			$('#dialog').dialog({modal:true});
			return;
		}
		
		_data['hRateStart'] = _hRateStart;
		_data['hRateEnd'] = _hRateEnd;
		_data['availableTobook'] = false;
		_data['langInput1'] = $('#langInput1').val();	
		_data['langInput2'] = $('#langInput2').val();
		_data['online'] = $('#online').is(":checked");
		_data['gender'] = $('input[name=gender]:checked').val();
		_data['country'] = $('#country').val();
		_data['province'] = $('#province').val();
		_data['keyword'] = $('#keywords').val();
		_data['page'] = 1;
		_data['perPage'] = window.perPage;
		var _sort = $('.sortKeys').val().split('_');
		_data['sort'] = _sort[0];
		_data['sortAsc'] = _sort[1];
		getSearch(_data);		
	});
	
	$('a[href=#]').attr('href','javascript:void(0)');
	//initialize();
	$('#search').click(function(){
		
		$("#sortBy").show();
		
		var _data = {};
		_data['langs'] = $.trim($('#langs').val());
		_hRateStart = $('#hourRateStart').val();
		_hRateEnd = $('#hourRateEnd').val();
		if(parseInt(_hRateEnd)<parseInt(_hRateStart)){
			$('#dialog').html('Hourly Rate "To" field must be larger than "From".');
			$('#dialog').dialog({modal:true});
			return;
		}
		$("#free_session").val('');
		_data['freeSes'] = $('#free_session').val();	
		_data['hRateStart'] = _hRateStart;
		_data['hRateEnd'] = _hRateEnd;
		_data['availableTobook'] = $('#availableTobook').is(":checked");
		_data['online'] = $('#online').is(":checked");
		_data['gender'] = $('input[name=gender]:checked').val();
		_data['country'] = $('#country').val();
		_data['province'] = $('#province').val();
		_data['keyword'] = $('#keywords').val();
		_data['page'] = 1;
		_data['perPage'] = window.perPage;
		var _sort = $('.sortKeys').val().split('_');
		_data['sort'] = _sort[0];
		_data['sortAsc'] = _sort[1];
		getSearch(_data);
		
	});
	$('.sortKeys').change(function(){
		$('#search').trigger('click');
	})
	$('#free_search').trigger('click');
	$('.viewCount').click(function(){
		var _perPage = $('.number',this).html();
		if(_perPage == 'all'){
			_perPage = 10000;
		}
		var _data = window.searchData;
		_data['page'] = 1;
		_data['perPage'] = _perPage;
		getSearch(_data);
	})
})

function getSearch(data){
	
	window.searchData = data;
	$('#dialog').html('loading.').attr('buttontype','doing');
	$('#dialog').dialog({modal: true});
	var sType = $('#free_session').val();
	
	$.get('<?php echo base_url("search/doSearch");?>',data,function(msg){
		
		//console.log(msg);
		if (String == msg.constructor) {      
			eval ('var result = ' + msg);
		} else {
			var result = msg;
		}
		$('.number.nowShow').html(((result.page-1)*result.perPage +1 )+'-'+((result.page-1)*result.perPage + result.count));
		$('.number.count').html(result.totalCount);
		$('.v_ajax_page').pagination(result.totalCount,{
					current_page:result.page-1,
					items_per_page:result.perPage,
					callback:function(page,perPage,el){
						var _data = window.searchData;
						_data['page'] = page+1;
						getSearch(_data);
					}
				});
		
		$('.result_list.featured').empty();
		


		$.each(result.rows['feature'],function(k,v){			
		
			var temp = $("<dl></dl>");
			
			if(sType == 'y')
				temp.setTemplateElement('freeResultListTemplate');
			else
				temp.setTemplateElement('resultListTemplate');
			temp.processTemplate(v);
			temp.appendTo('.result_list.featured').show(1000);
		})
		$('.result_list.result').empty();
		
		$.each(result.rows['result'],function(k,v){			
			var temp = $('<dl class="none"></dl>');
			if(sType == 'y')
				temp.setTemplateElement('freeResultListTemplate');
			else
				temp.setTemplateElement('resultListTemplate');
			temp.processTemplate(v);
			temp.appendTo('.result_list.result').show(1000);
		})
			
		mapDataJson = result.rows['feature'];
		Array.prototype.push.apply(mapDataJson,result.rows['result']);
		//console.info(mapDataJson);
		initialize();
		$('#dialog').attr('buttontype','done');
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	})
}

var mapDataJson = [];
var geocoder = new google.maps.Geocoder();
var iniCenter = 0;
var map;
	
function initialize() {
	if (mapDataJson.length){
		var latlng = new google.maps.LatLng(40.7834345, -73.9662495);
		var myOptions = {
		    zoom: 12,
		    center: latlng,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
	    }
	    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		$.each(mapDataJson,function(k,v){
			pinOnMap(v, k);
		})
		//pinOnMap(mapDataJson[0], 0);
	}else{
		$("#map_canvas").css("text-align","center").css("background","#ebebeb").html("<span style='font-size:24px; font-weight:bold; color:#999999; position:relative; top:112px;'>No Tutors Found</span>");
	}
}
 
function pinOnMap(data, i){
	geocoder.geocode( { 'address': data.city +', ' +data.provice+', ' +data.country}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			if (iniCenter == 0){
				map.setCenter(results[0].geometry.location);
			}
			iniCenter = 1;
			
			var marker = new google.maps.Marker({
	            map: map,
	            position: results[0].geometry.location,
	            title: data.username
	        });
	        if (data.myself == "1"){
		        marker.icon = "./upload/module/38/icon_garage.gif?temp_id=0.5081533275078982";
		        marker.title = "My Garage";
				map.setCenter(results[0].geometry.location);
	        }
	        if (true || data.simple == "0"){
		        var infoHtml = "";
		        infoHtml += "<div style='min-width:300px; overflow-y:auto; position:relative; top:0px; left:0px;'>";
		        infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
				infoHtml += "<img src='" + profileImg(data.pic) + "' style='height:30px; margin:4px;' />";
		        infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'>Location: </span>" +  data.city +', ' +data.provice+', ' +data.country + "</p>";
		        infoHtml += "	<p><span style='color:red; font-weight:bold;'>Hourly Rate$" + data.hRate + "/hr</span></p>";
		        infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + "' target='_blank'>View Profile</a></span></div>";
		        infoHtml += "</div>";
		        var infowindow = new google.maps.InfoWindow({
			        content: infoHtml,
			        height:450
			    });
			    google.maps.event.addListener(marker, 'click', function() {
				    infowindow.open(map,marker);
				});
	        }else{
		        
	        }
	        
		}
		/*i = i + 1;
		if (i < mapDataJson.length){
			pinOnMap(mapDataJson[i], i);
		}else{
			return false;
		}*/
	});
}
</script>

