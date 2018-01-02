<?php 
/*header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache'); */
?>
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
$arrVal 	= $this->lookup_model->getValue('3', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('153', $multi_lang);
$lshowing	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('152', $multi_lang);
$lsortby	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('38', $multi_lang);
$lquicksearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('143', $multi_lang);
$lfreesearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('39', $multi_lang);
$llanguages	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('40', $multi_lang);
$lratings	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('41', $multi_lang);
$lcostperclass	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('42', $multi_lang);
$lavailability	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('162', $multi_lang);
$lavailabilitytobook	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('145', $multi_lang);
$ladvsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('146', $multi_lang);
$lall		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('144', $multi_lang);
$lcurrentonline	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('43', $multi_lang);
$lnextavailsession		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('114', $multi_lang);
$lgender	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('116', $multi_lang);
$lmale		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('115', $multi_lang);
$lfemale	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('147', $multi_lang);
$lprofilekeyword= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('117', $multi_lang);
$llocation	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('56', $multi_lang);
$lname		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('148', $multi_lang);
$lfuturedtutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('149', $multi_lang);
$lmoreresult	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('161', $multi_lang);
$lstars		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('155', $multi_lang);
$loutof		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('154', $multi_lang);
$lresults	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('47', $multi_lang);
$lprice		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('53', $multi_lang);
$lrating	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('159', $multi_lang);
$lview		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('273', $multi_lang);
$lbuildatutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('274', $multi_lang);
$lmaxcostusd	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('275', $multi_lang);
$lonlinenow	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('276', $multi_lang);
$ldiscusstopics = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('277', $multi_lang);
$lbusiness	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('278', $multi_lang);
$lmedical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('279', $multi_lang);
$lfinance	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('280', $multi_lang);
$lsoftware	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('3', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('288', $multi_lang);
$lnopreference	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('287', $multi_lang);
$lmapoftutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('289', $multi_lang);
$lshowmember	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('160', $multi_lang);
$lzoomin	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('222', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('277', $multi_lang);
$lbusiness	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('278', $multi_lang);
$lmedical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('279', $multi_lang);
$lfinance	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('280', $multi_lang);
$lsoftware	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('323', $multi_lang); 
$videotext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('359', $multi_lang); 
$authortext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('360', $multi_lang); 
$vvideosearchresult = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('321', $multi_lang); 
$vcredits = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('331', $multi_lang);
$ltoeic	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('332', $multi_lang);
$ltoefl	= $arrVal[$multi_lang];
//$arrVal 	= $this->lookup_model->getValue('363', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('384', $multi_lang);
$vbuildlesson	= $arrVal[$multi_lang];
//$arrVal 	= $this->lookup_model->getValue('274', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('385', $multi_lang);
$maxicc	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('367', $multi_lang);
$ldiscusstopics = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('376', $multi_lang);
$vbuy = $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);	$lSEARCH   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('319', $multi_lang);	$lkeyword   			= $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('526', $multi_lang);	$lENTER_AUTHOR   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('527', $multi_lang);	$lVIDEO_KEYWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('528', $multi_lang);	$lNO_RESULTS   		= $arrVal[$multi_lang];





?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php 
$this->layout->appendFile('javascript',"js/jquery.placeholder.js");
$this->layout->appendFile('javascript',"js/jq.page.js");
$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/jquery.blockUI.js");

if($this->session->userdata('userFrom') == 'landing'):
$this->session->unset_userdata('userFrom');
endif;
?>
<script>
window.perPage = 20;
window.searchData = [];
var profileImgPath = '<?php echo base_url("uploads/video/");?>';
var profileImgNull = '<?php echo base_url("images/no-img.jpg");?>';
var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
var createClassPath = '<?php echo base_url("user/calendar/uid/");?>';
var createLessonPath = '<?php echo base_url("user/lessons/uid/");?>';
var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';
var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';
var _data = window.searchData;
//alert(_data['page']);
$(function(){
	//if()
	if($('#country').val() == 0)
	{
		//alert('hi');
		//$('#country').trigger('change');
	}
	$('#country').change(function(){
		var _cid = $(this).val();
		//alert('cid----'+_cid);
		if(_cid == '' || _cid == 0)
		{
			_cid = 2;
		}
		$.getJSON('<?php echo Base_url("user/getProvices");?>',{cid:_cid},function(provices){
			if (String == provices.constructor) {
				eval ('var provices = ' + provices);
			}
			$('select#province').empty();
			provices[0] = 'All States';
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
	
});

function checkuncheck(obj)
{
	if (obj.__chk) obj.checked = false
	if(obj.__chk == false)
		document.getElementById('keywords').value = obj.value;
	else
		document.getElementById('keywords').value = '';
}
function writeScript(src) {
    document.write('<' + 'script src="' + src + '"' +
                   ' type="text/javascript"><' + '/script>');
  }
</script>
<div class="search">
	<!--<div class="search_top"><?php echo $videotext;?></div>-->
	<div class="search_mid">
		<div class="search_lf">
			<div class="search_lf_top">
				<span class="left-ttl"><?php echo $vbuildlesson;?></span>
			</div>
			<div class="search_lf_mid search_lf_mid2">
	  		<?php
			//if(($this->session->userdata('firstTime') == 'y') && (!$this->session->userdata['user_type']== 'Landding') ) {
			if($this->session->userdata('firstTime') == 'y' ) {
			?>
			<div class="search_lf_mid">
				<!--<input type="button" class="btn_red1" style="width:167px;margin-top: 33px;" id="free_search"  value="Free Session Search" />-->
				<input type="hidden" value="" id="free_session"  name="freeSes" />
			</div>
			<?php } else {  ?>
			<input type="hidden" value="" id="free_session"  name="freeSes" />
			<?php } ?>

				<dl>
					<dt><span class="icon_1"><?php echo $llanguages;?></span></dt>
					<dd>
						<div class="select-box-marg">                        
							<?php 
								echo form_dropdown('langInput1',$langsAll,@$sessionSearchData["langInput1Selected"],' id="langInput1" class="raduisSelect w78" ');?>
						</div>
					</dd>
					<!--
					<dt><span class="icon_1">2nd <?php echo $llanguages;?></span></dt>
					<dd>
						<div>
							<?php							
							echo form_dropdown('langInput2',$langsAll2,@$sessionSearchData["langInput2Selected"],' id="langInput2" class="raduisSelect w78" ');?>	
						</div>
					</dd>
					-->
				</dl>
				<dl>
					<dt><span class="icon_2"><?php echo $maxicc;?></span></dt>
					<dd>
						<input type="hidden" value="0" id="hourRateStart" name="hourRateStart" />
						<?php 
							if(@$sessionSearchData["hRateEndSelected"])
							{
								$hRateEndSelected = $sessionSearchData["hRateEndSelected"];
							}else{
								$hRateEndSelected = '200';
							}
						?>
						<?php echo form_dropdown('hourRateEnd',$price,$hRateEndSelected,' id="hourRateEnd" class="raduisSelect w78"  ');?>
					</dd>
				</dl>
				<!--
				<dl>
					<dt><span class="icon_2"><?php echo $lgender;?></span></dt>
					<dd>
						<?php //echo $sessionSearchData["genderSelected"]; ?>
						<select class="raduisSelect" name="gender" id="gender">
							<option value="all" <?php if(@$sessionSearchData["genderSelected"] == 'all'){echo 'selected';} ?>>No Preference</option>
							<option value="0" <?php if(@$sessionSearchData["genderSelected"] == '0'){echo 'selected';} ?>>female</option>
							<option value="1" <?php if(@$sessionSearchData["genderSelected"] == '1'){echo 'selected';} ?>>male</option>
							
						</select>
					</dd>
				</dl>
				
				
				<dl>
					<dt><span class="icon_3"><?php echo $llocation;?></span></dt>
					<dd class="white">
						<?php 
							if(@$sessionSearchData["countrySelected"])
							{
								$countrySelected = $sessionSearchData["countrySelected"];
							}else{
								$countrySelected = '0';
							}
						?>
						<?php echo form_dropdown('country',$countries,$countrySelected,' id="country" class="raduisSelect w78 select-box-marg"  ');?>
						<?php echo form_dropdown('province',$provinces,'0',' id="province" class="raduisSelect w78"  ');?>
						
					</dd>
				</dl>
				
				
				<dl>
					<dt><span class="icon_none"><?php echo $lavailability;?></span></dt>
					<dd><span class="nobg check">
						<input id="online" name="online" value="1" <?php if(@$sessionSearchData["onlineSelected"] == 'true'){echo "checked='checked'";} ?>  type="radio" onMouseDown="this.__chk = this.checked" onClick="if (this.__chk) this.checked = false">
						<label for="female" class="radio-btn"><?php echo $lonlinenow;?></label>
						</span> <span style="float:right"><img src="<?php echo base_url('images/arrow.png');?>" alt="ed" title="Show members that are currently online so you may communicate in real time with instant messaging or Beepbox messages" /></span></dd>
				</dl>
				-->
				<dl>
					<dt><span class="c133e5f icon_8"><?php echo $authortext; ?></span></dt>
					<dd>
						<input name="author" id="author" type="text" class="raduisSelect" style="width:170px; height:21px;"  value="<?php if(@$sessionSearchData["authorSelected"]){echo $sessionSearchData["authorSelected"];}else{echo $lENTER_AUTHOR;}; ?>"
						onblur="if(this.value == '') this.value = '<?php echo $lENTER_AUTHOR;?>'" onfocus="if(this.value == '<?php echo $lENTER_AUTHOR;?>') this.value = ''">
						 
					</dd>
				</dl>
				<dl>
					<dt><span class="c133e5f icon_8"><?php //echo $ldiscusstopics;?><?php echo $lkeyword;?></span></dt>
					<dd>
						<input name="keywords" id="keywords" type="text" class="raduisSelect" style="width:170px; height:21px;"  value="<?php if(@$sessionSearchData["keywordSelected"]){echo $sessionSearchData["keywordSelected"];}else{echo $lVIDEO_KEYWORD;}; ?>"
						onblur="if(this.value == '') this.value = '<?php echo $lVIDEO_KEYWORD;?>'" onfocus="if(this.value == '<?php echo $lVIDEO_KEYWORD;?>') this.value = ''"
						>
						 
					</dd>
				</dl>
				<!--remove
				<dl>
					<dd class="rad-btn-mar"><span class="nobg check">
                    <input <?php if(@$sessionSearchData["last_toefl_scoreSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic1"  name="discussiontopic" value="TOEIC" name="TOEIC"  type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn" ><?php echo $ltoeic; ?></label></span></dd>
                    
					<dd class="rad-btn-mar"><span class="nobg check"><input <?php if(@$sessionSearchData["last_toiec_scoreSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic2"  name="discussiontopic" value="TOEFL" name="TOEFL"  type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn"><?php echo $ltoefl; ?></label></span></dd>
                    
					<dd class="rad-btn-mar"><span class="nobg check"><input <?php if(@$sessionSearchData["fltr_businessSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic3" name="discussiontopic" value="Business" type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn"><?php echo $lbusiness;?></label></span></dd>
                    
					<dd class="rad-btn-mar"><span class="nobg check"><input <?php if(@$sessionSearchData["fltr_medicalSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic4"  name="discussiontopic" value="Medical" type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn"><?php echo $lmedical;?></label></span></dd>
                    
					<dd class="rad-btn-mar"><span class="nobg check"><input <?php if(@$sessionSearchData["fltr_financeSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic5"  name="discussiontopic" value="Finance" type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn"><?php echo $lfinance;?></label></span></dd>
                    
					<dd class="rad-btn-mar"><span class="nobg check"><input <?php if(@$sessionSearchData["fltr_softwareSelected"] == 'true'){echo "checked='checked'";} ?> id="discussiontopic6" name="discussiontopic" value="Software" type="radio" onMouseDown="this.__chk = this.checked" onClick="checkuncheck(this);"><label for="female" class="radio-btn"><?php echo $lsoftware;?></label></span></dd>
				</dl>
				-->
				<div class="submit_btn"><input value="<?php echo $lSEARCH;?>" class="btn_red" id="search" type="submit"></div>
			</div>
		</div>
		<!--//left end--> 
		
	  <div class="search_rt">
        
        <div class="src-hd">
				<h4><?php echo $vvideosearchresult;?></h4>
				<!--<span><?php echo $lzoomin;?></span>-->
			</div> 
			<div style="clear:both;" ></div> 
	  
	  <!--<div class="search_rt_top" id="map_canvas" style="height:500px"></div>-->
	  
			<!--<div class="showZoomInText">Zoom in and select tutor off the map.</div>-->
			<div class="search_rt_mid" style="padding-top:2px !important;">
				<div class="search_rt_mid_t">
					<div style=" float: left; width: 245px;">
						<span class="search_rt_mid_t_lf lh30"><?php echo $lshowing;?> <font class="number nowShow">1-20</font> <?php echo $loutof; ?> <font class="number count">20</font> <?php echo $lresults;?></span><span id="keydisplay" style="line-height: 30px;margin-left: 5px;"></span>
					</div>
					<!--<div class="search_rt_mid_t_rt">
						<div class="v_ajax_page"></div>
					</div>-->
					<span class="search_rt_mid_t_rt lh30 mr10"><?php echo $lsortby;?></span>
					<select class="raduisSelect w78 search_rt_mid_t_rt mr30 sortKeys">
						<option value="price_1"><?php echo $lprice;?></option>
						<option value="firstName_1"><?php echo $lname;?></option>
					</select>
					<span class="search_rt_mid_t_rt mr30 lh30" style="float:right; margin-left:300px;">
						<a href="#" class="viewCount"><?php echo $lview;?> <font class="number">20</font></a>  |  <a href="#" class="viewCount"><?php echo $lview;?> <font class="number"><?php echo $lall;?></font></a> 
					</span>
				</div>
				
				<!--
				<div class="result_title"><?php echo $lfuturedtutor;?></div>
				<div class="result_list featured"></div>
				-->
				
				<!--<div class="result_title"><?php echo $lmoreresult;?></div>-->
				<div class="result_list result">

				</div>
				<div class="no_result_found" style="display:none;"><?php echo $lNO_RESULTS;?></div>
				<div class="fr pt20"><div class="v_ajax_page"><a class="first" href="#">&lt;&lt;</a><a class="prev" href="#">&lt;</a><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a class="next" href="#">&gt;</a><a class="last" href="#">&gt;&gt;</a></div></div>
			</div>
		</div>
		<!--//right end-->
	</div>
</div>
<?php 
$roleIdn = $this->session->userdata('roleId');

if($roleIdn == 0)
{
	$apointmentbutton = "../images/btn-srch-02.png";
	$potentialbutton  = "../images/btn-srch-01.png";
}else{
	$apointmentbutton = "../images/btn-srch-02-gray.png";
	$potentialbutton  = "../images/btn-srch-01-gray.png";
}

$buynowbutton = '../images/buy-now-btn.png';

?>

<textarea id="resultListTemplate" style="display:none">
<!--
<dt><img src="{profileImgResultThumb($T.source)}" width="163"/></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1>{$T.lesson_name}  <font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<p>{($T.desc != null) ? $T.desc : ''}</p>
		</div>
		<div class="dd_rt">{($T.price > 0) ? $T.price : '0.00'} <?php echo $vcredits; ?></div>
	</div>
	<div class="dd_bot">
		<div class="btn_group">
			<a href="{createLessonUrl($T.uid)}"><input type="button" class="" value="<?php echo $vbuy; ?>" id="register" /></a>
		
        </div>
	</div>
</dd>

-->
</textarea>

<script>

var attempts = 0;

function profileUrl(uid){
	return profileUrlPath+'/'+uid;
}
function profileImg(src){
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		return profileImgNull;
	}
	return profileImgPath+'/'+src;
}
function profileImgResultThumb(src){
	//alert(src);
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		
		//return timthumbUrl + profileImgNull + '&h=163&w=163&zc=0';
		return profileImgNull;
	}else{
		var imgurl = profileImgPath + '/' + src + '.jpg';
		if(fileExists(imgurl))
		{
			//return timthumbUrl + profileImgPath+'/'+src+ '.jpg'+ '&h=163&w=163&zc=0';
			//return timthumbUrl + profileImgPath+'/'+src+ '.jpg'+ '&w=163&zc=0';
			return profileImgPath+'/'+src+ '.jpg';
		}else{
			//return timthumbUrl + profileImgNull + '&h=163&w=163&zc=0';
			return profileImgNull;
		}
		
	}
	
}
function fileExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
function createLessonUrl(uid){
	return createLessonPath+'/'+uid;
}
window.configs = <?php echo json_encode($config);?>;
$(function(){
	$('a[href=#]').attr('href','javascript:void(0)');
	$('#search').click(function(){
		var _data = {};
		_data['langs'] = $.trim($('#langs').val());
		_hRateStart = $('#hourRateStart').val();
		_hRateEnd = $('#hourRateEnd').val();
		if(parseInt(_hRateEnd)<parseInt(_hRateStart)){
			$('#dialog').html('COST PER CLASS "To" field must be larger than "From".');
			$('#dialog').dialog({modal:true});
			return;
		}
		//_data['freeSes'] = $('#free_session').val();
		
		_data['langInput1'] = $('#langInput1').val();	
		//_data['langInput2'] = $('#langInput2').val();	
		_data['langInput2'] = 0;
		_data['hRateStart'] = _hRateStart;
		_data['hRateEnd'] = _hRateEnd;
		_data['availableTobook'] = false;
		_data['online'] = false;
		_data['gender'] = 'all';
		_data['last_toefl_score'] = $('#discussiontopic1').is(":checked");
		_data['last_toiec_score'] = $('#discussiontopic2').is(":checked");
		_data['fltr_business'] = $('#discussiontopic3').is(":checked");
		_data['fltr_medical'] = $('#discussiontopic4').is(":checked");
		_data['fltr_finance'] = $('#discussiontopic5').is(":checked");
		_data['fltr_software'] = $('#discussiontopic6').is(":checked");
		
		_data['country'] = 0;
		_data['province'] = 0;
		_data['keyword'] = $.trim($('#keywords').val());
		_data['author'] = $.trim($('#author').val());
		
		//alert(_data['keyword'])
		if(_data['keyword'] != '' && _data['keyword'] != '<?php echo $lVIDEO_KEYWORD;?>')
		{
			$('#keydisplay').html(' for ' + _data['keyword']);
		}else{
			$('#keydisplay').html('');
		}
		_data['page'] = 1;
		_data['perPage'] = window.perPage;
		var _sort = $('.sortKeys').val().split('_');
		_data['sort'] = _sort[0];
		_data['sortAsc'] = _sort[1];
		//var src = getSearch(_data);
		getSearch(_data);
		
	});
	$('.sortKeys').change(function(){
		$('#search').trigger('click');
	})
	$('#search').trigger('click');
	
	$('#keywords').on('keypress', function (event) {
         if(event.which == '13'){
			$('#search').trigger('click');
         }
    });
	$('#author').on('keypress', function (event) {
         if(event.which == '13'){
			$('#search').trigger('click');
         }
    });
	
	$('.viewCount').click(function(){
		var _perPage = $('.number',this).html();
		
		if(_perPage == 'All'){
			_perPage = 10000;
		}
		
		var _data = window.searchData;
		_data['page'] = 1;
		_data['perPage'] = _perPage;
		
		//var src = getSearch(_data);
		getSearch(_data);
		
	})
})

function getSearch(data){
	window.searchData = data;
	if(data.keyword == '<?php echo $lVIDEO_KEYWORD;?>'){  data.keyword = 'Example: John UCLA TOEFL'}
	if(data.author  == '<?php echo $lENTER_AUTHOR;?>'){  data.author = 'Enter Author'}
	
	/*$('#dialog').html('loading.').attr('buttontype','doing');
	$('#dialog').dialog({modal: true});*/
	$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });

	var sType = $('#free_session').val();
	$.ajax({
		url: "<?php echo base_url("search/doVideoSearch");?>",
		type: 'GET',
		data: window.searchData,
		dataType: 'html',
		cache: false,
		success: function (msg){
					$.unblockUI();
					//alert(msg);
					//return false;
					if (String == msg.constructor)
					{
						var result;
						//result = eval('(' + msg + ')');
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					//alert(result.rows['result'])
					if(result.count != '' || result.count !=0)
					{
						$('.number.nowShow').html(((result.page-1)*result.perPage +1 )+'-'+((result.page-1)*result.perPage + result.count));
						$('.number.count').html(result.totalCount);
						$('.search_rt_mid_t_rt').show();
						$('.v_ajax_page').show();
					}
					else{
						$('.number.nowShow').html('0-0');
						$('.search_rt_mid_t_rt').attr('style','display:none');
						$('.v_ajax_page').attr('style','display:none');
						$('.number.count').html('0');
						$('.result_list .featured').html('No Tutors found');
					}
					
					
					$('.v_ajax_page').pagination(result.totalCount,{
								current_page:result.page-1,
								items_per_page:result.perPage,
								callback:function(page,perPage,el){
									var _data = window.searchData;
									_data['page'] = page+1;
									getSearch(_data);
								}
					});
					
					
					$('.result_list.result').empty();
					$.each(result.rows['result'],function(k,v){
						//alert(v);
						var temp = $('<dl class="none"></dl>');
						temp.setTemplateElement('resultListTemplate');
						
						v['price'] = v['price'] * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
						v['price'] = Math.round(parseInt(v['price'] *10000) /100)  /100;
						v['price'] = v['price'].toFixed(2);
						
						temp.processTemplate(v);
						temp.appendTo('.result_list.result').show(1000);
					})
					if(result.count == '' || result.count ==0)
					{
						//alert('hi');
						$('.search_rt_mid_t').hide();
						$('.no_result_found').show();
					}else{
						//alert('hi-2');
						$('.search_rt_mid_t').show();
						$('.no_result_found').hide();
					}
					
					$('#dialog').attr('buttontype','done');
					$( "#dialog:ui-dialog" ).dialog( "destroy" );
					
		}
		
	 });
				return 'searchresulttrue'; 
	
}
function goProfile(userid)
{
	document.cookie="userID=" + userid;
}
$('#dialog').attr('buttontype','done');
$( "#dialog:ui-dialog" ).dialog( "destroy" );
</script>

<!-- Naver Analytics code -->
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js">
</script> <script type="text/javascript"> if (!wcs_add) var
 wcs_add={}; wcs_add["wa"] = "s_15f3d51a6740"; if (!_nasa) var
 _nasa={}; wcs.inflow(); wcs_do(_nasa); </script>
 <!-- Naver conversion code -->