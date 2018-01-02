<?php 
header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache'); 
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
$arrVal 	= $this->lookup_model->getValue('366', $multi_lang);
$secondlang	= $arrVal[$multi_lang];
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
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('277', $multi_lang);
$lbusiness	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('278', $multi_lang);
$lmedical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('279', $multi_lang);
$lfinance	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('280', $multi_lang);
$lsoftware	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('331', $multi_lang);
$ltoeic	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('332', $multi_lang);
$ltoefl	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('365', $multi_lang);
$vsession	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('274', $multi_lang);
$maxicc	= $arrVal[$multi_lang];

//--R&D@Oct-30 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('319', $multi_lang);	$lkeyword   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);	$lSEARCH   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('448', $multi_lang);	$lAVAILIBILITY_ANY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('449', $multi_lang);	$lAVAILIBILITY_TIME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('450', $multi_lang);	$lAVAILIBILITY_NOW   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('453', $multi_lang);	$lADD_P_TUTORS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('454', $multi_lang);	$lREQ_APPOINTMENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('455', $multi_lang);	$lCRE_APPOINTMENT   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('519', $multi_lang);	$lanytutor   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('520', $multi_lang);	$ldatetimelocal	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('521', $multi_lang);	$lreadytotalk  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('321', $multi_lang);	$lcredits  	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('649', $multi_lang);	$laddtopotential  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('650', $multi_lang);	$lcreateappointment = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('651', $multi_lang);	$lrequestappointment = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('655', $multi_lang);	$lDE_ACTIVATE_MAP = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('664', $multi_lang);	$lMESSAGE_THIS_TUTOR = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('667', $multi_lang);	$lREQUEST_APPOINTMENT_TIP   = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('668', $multi_lang);	$lCREATE_APPOINTMENT_TIP   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('669', $multi_lang);	$lBEEP_BOX_TIP   			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('467', $multi_lang);	$lBOOK_NOW   			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('676', $multi_lang);	$lFREE_SESSION   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('722', $multi_lang);	$lgoldtutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('723', $multi_lang);	$lsilvertutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('724', $multi_lang);	$lbronzetutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('728', $multi_lang);	$free_session  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('731', $multi_lang);	$lSchedule  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('740', $multi_lang);	$lSend_message  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('741', $multi_lang);	$ltalknow  	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('780', $multi_lang);	$lbronze  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('781', $multi_lang);	$lsilver  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('782', $multi_lang);	$lgold  	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('789', $multi_lang);	$viewmap  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('796', $multi_lang);	$selectoption  	= $arrVal[$multi_lang];

//--R&D@Oct-30 : Set Language Variables

?>
 
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php 
$this->layout->appendFile('javascript',"js/jquery.placeholder.js");
$this->layout->appendFile('javascript',"js/jq.page.js");
$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/googlemapapi.js");
$this->layout->appendFile('javascript',"js/jquery.blockUI.js");
//datepicker
$this->layout->appendFile('javascript',"js/datepicker/jquery.simple-dtpicker.js");
$this->layout->appendFile('css',"js/datepicker/jquery.simple-dtpicker.css");

//echo '<pre>';
//print_r($this->session->userdata());
?>

<script>
 window.onload = function() {
//  document.getElementById('school').value='';
  searchAll();
};


function searchAll()
{

var a=document.getElementById('country').value;
if(a==2)
{
$('select#province').show();
}
}
window.perPage = 20;
window.searchData = [];
var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
var profileImgNull = '<?php echo profile_image("");?>';
var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
var createClassPath = '<?php echo base_url("user/calendar/uid/");?>';
var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';
var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';

var _data = window.searchData;
var _uid = '<?php echo $this->session->userdata('uid'); ?>';
var lastClickedOnBook = false;

//alert vpl(_data['page']);
$(function(){
$('select#province').hide();
	$('#country').change(function(){
	
		var _cid = $(this).val();
		
		if(_cid == 2){
			$('select#province').show();
		}else{
			$('select#province').hide();
		}
		
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
	//$('#country').trigger('change');
	/*$('input[placeholder]').placeholder();
	$('textarea[placeholder]').placeholder();*/
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
function bookNow(tid,username,schoolId)
{
	
	//prevent multiple clicks
	/*if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	alert(lastClickedOnBook);*/
	if(_uid == '')
	{
		alert('Login First!');
		return false;
	}
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	//window.returnvar = true;
	
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
		// alert(msg);
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(!json.enough){
	//	alert('not enough');
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
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
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
			}else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = 'Insufficient credits to buy a session.  Please <a href="'+rechargeURL+'" >recharge</a> account.';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({
				//modal: true
				close: function() {
                 window.location.href = "<?php echo base_url(); ?>user/account/";
  }
				});
				//return false;
			}
		}else{
			if(window.firstBookNow == false){
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			}else{
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session.";
			}
			//var message = "You are booking a class with "+username+" right now. If they confirm this booking then you will automatically be launched into the Vee-session. If they haven뭪 entered your classroom within the 3minute countdown timer, then feel free to exit the session and your account will be credited.";
			//var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			
			var conf = confirm(message);
			if(conf == true)
			{
				// send message to tutor
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid},function(msg){
				
						//redirect to student dashboard page
						document.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			}else{
				return false;
			}
			lastClickedOnBook = false;
		}
		
		
	},2500);
	//lastClickedOnBook = false;
}
</script>
<style>
#searchPopup
{
	z-index:9999;
	position:absolute;
	border: 1px solid #AAAAAA; margin:0% 27%; width:400px;
}	

 #searchPopup .header-pop{  background: url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") repeat-x scroll 50% 50% #CCCCCC;
    border: 1px solid #AAAAAA;
    color: #222222;
    font-weight: bold;   border-radius: 4px; padding:5px 7px;}
	.sr-pop-cnt{ padding:10px;}
.search_mail {
	float:left;
}
.sendMessageView{
	margin: 0 auto;
	position: fixed;
	top:15%;
	width: 76%;
	z-index: 1028;
}
.btn_blue_bg{
	background: url("../images/btn2.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	margin-right: 148px;
	width: 57%;
	margin-top: 17px;
}
.btn_blue_bg_crap{
	background: url("../images/btn2.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	float: right;
    padding: 0px 13px 6px 10px;
	
}
.search_mail a:hover{color: #FFFFFF !important;}
</style>
<div id="searchPopup" style="display:none;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
<?php if($this->session->userdata('userFrom') == 'landing' AND $this->session->userdata('new') == 1): ?>
<!-- Naver conversion code -->
 <script type="text/javascript" src="http://wcs.naver.net/wcslog.js"> </script> 
 <script type="text/javascript">
var _nasa={};
 _nasa["cnv"] = wcs.cnv("2","10"); // 전환유형, 전환가치 설정해야함. 설치매뉴얼 참고
</script>
<?php 

endif; ?>
<div class="header-pop">Thank You<a href="javascript:closepopwin();" class="dclose" style="float:right;margin-top:3px;"><img src="<?php echo base_url('images/cm_cross.png');?>" alt="close"></a></div>
<div class="sr-pop-cnt">
	<?php if($this->session->userdata('roleId') == 0 ): ?>
	Thank you for registering with TheTalkList. Now you have hundreds of wonderful tutors to choose from.
	<br/>Have fun learning to speak English!
	<?php else: ?>
	Thank you for registering with TheTalkList. Now you can make yourself known to millions of English learners around the world.
	<br/>Have fun being a conversational English partner!
	<?php endif; ?>	
</div>		
</div>
<?php
if($this->session->userdata('userFrom') == 'landing' || $this->session->userdata('ancode') == 'y' AND $this->session->userdata('new') == 1):
//$this->session->unset_userdata('userFrom');
$this->session->unset_userdata('ancode');
//echo '<script>$("#searchPopup").show();</script>';
endif;
?>
<script>
function closepopwin()
{
	$('#searchPopup').hide();
}
function sendBeepBoxMessage(uid)
{//alert(uid);
	if(_uid == '')
	{
		alert('Login First!');
		return false;
	}
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}
function div_show()
{
//alert(a);
document.getElementById("static_map_canvas").style.display = 'block';
document.getElementById("imgshow").style.visibility = 'visible';
document.getElementById("imghid").style.visibility = 'hidden';
}

function div_hide()
{
//alert(a);
document.getElementById("static_map_canvas").style.display = 'none';
document.getElementById("imgshow").style.visibility = 'hidden';
document.getElementById("imghid").style.visibility = 'visible';
}
</script>
	<div class="search">
	<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
    <div class="search_mid">
		<div class="search_lf">
			<div class="search_lf_top">
				<span class="left-ttl"><?php echo $lbuildatutor;
				//echo $nowtalk;
				?>
				
				</span>
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
					<dt><span class="icon_1"><?php echo $llanguages;?></span>
					
					</dt>
					<dd>
						<div class="select-box-marg">                        
							<?php 
								//echo $sessionSearchData["langInput1Selected"];
								echo form_dropdown('langInput1',$langsAll,@$sessionSearchData["langInput1Selected"],' id="langInput1" class="raduisSelect w78" ');?>
						</div>
					</dd>
					<dt><span class="icon_1"><?php echo $secondlang; ?> <?php echo $llanguages;?></span></dt>
					<dd>
						<div>
							<?php							
							echo form_dropdown('langInput2',$langsAll2,@$sessionSearchData["langInput2Selected"],' id="langInput2" class="raduisSelect w78" ');?>	
						</div>
					</dd>
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
								$hRateEndSelected = '50000';
							}
							//echo $hRateEndSelected;exit;
						?>
						<?php echo form_dropdown('hourRateEnd',$price,$hRateEndSelected,' id="hourRateEnd" class="raduisSelect w78"  ');?>
					</dd>
				</dl>
					<dl>
					<dt><span class="icon_2"><?php echo $lgender;?></span>
					
					</dt>
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
						<!--<select class="raduisSelect w78" id="province"></select>-->
					</dd>
				</dl>
				<dl>
					<?php 
					//get default selected 
					$defaultAny = "checked='checked'";
					
					
					
					
					if(@$sessionSearchData["datetimeSelected"] != 'true')
					{
						$defaultAny = "checked='checked'";
					}else
					{
						$defaultAny = "";
					}
					if(@$sessionSearchData["readytotalknowSelected"] != 'true')
					{
						$defaultAny = "checked='checked'";
					}else{
						$defaultAny = "";
					}
					
					if(@$sessionSearchData["anytutorSelected"] != 'true')
					{
						$defaultAny = "checked='checked'";
					}else{
						$defaultAny = "";
					}
					
					?>
					<dt>
					<!--<span class="icon_none"><?php //echo $lavailability;?></span>-->
					<span class="icon_none"><?php echo "Open TimeSlots(local time)";?></span>
					</dt>
					<dd>
						<span class="nobg check">
							<!--<input id="online" name="online" value="1" <?php if(@$sessionSearchData["onlineSelected"] == 'true'){echo "checked='checked'";} ?>  type="radio" onMouseDown="this.__chk = this.checked" onClick="if (this.__chk) this.checked = false">-->
							<input id="anytutor" name="anytutor" value="1" <?php if(@$sessionSearchData["anytutorSelected"] == 'true'){echo "checked='checked'";} if($nowtalk!=1)echo $defaultAny; ?>  type="radio" onMouseDown="this.__chk = this.checked" >
							<label for="female" class="radio-btn"><span class="searchat"><?php echo $lanytutor;?></span></label>
						</span> 
						<!--
						<span style="float:right">
							<img src="<?php echo base_url('images/arrow.png');?>" alt="ed" title="Show members that are currently online so you may communicate in real time with instant messaging or Beepbox messages" />
						</span>-->
					</dd>
					
					<dd>
						<script>
						$(function(){
							/*$('#datepickerimg').hover(function(){
								$('#today').trigger('click');
							});*/

							$("span.searchrt").hover(function () {
								$(this).append('<div class="tooltip"><p><?php echo $lAVAILIBILITY_NOW;?></p></div>');
							}, function () {
								$("div.tooltip").remove();
							});
							$("span.searchdt").hover(function () {
								$(this).append('<div class="tooltipdt"><p><?php echo $lAVAILIBILITY_TIME;?></p></div>');
							}, function () {
								$("div.tooltipdt").remove();
							});
							$("span.searchat").hover(function () {
								
								$(this).append('<div class="tooltipat"><p><?php echo $lAVAILIBILITY_ANY;?></p></div>');
							}, function () {
								$("div.tooltipat").remove();
							});
							
							
							$("span.timg").hover(function () {
								
								$(this).append('<div class="tooltipat"><p><?php echo $lAVAILIBILITY_ANY;?></p></div>');
							}, function () {
								$("div.tooltipat").remove();
							});
							
							
							
							$('#datepickerimg').click(function(){
								$('#today').trigger('click');
								
							});
							
							$('#today').appendDtpicker({
								"inline": false,
								"futureOnly": true,
								"dateOnly": true,
								//"dateFormat": "DD-MM-YYYY",
								"todayButton": false,
								"closeOnSelected": true
							});
							$("body").click(function (e) {
								if (e.target.nodeName != "INPUT" && e.target.className!= "datepicker" ) {
									if(e.target['id'] != 'datepickerimg')
									{
										$(".datepicker").hide();
									}
								}
							});
						});
						</script>
						<span class="nobg check">
							<input id="datetime" name="datetime" value="1" <?php if(@$sessionSearchData["datetimeSelected"] == 'true'){echo "checked='checked'";} ?>  type="radio" onMouseDown="this.__chk = this.checked">
							<label for="female" class="radio-btn"><span class="searchdt"><?php echo $ldatetimelocal; ?></span></label>
						</span>
						<?php 
							if(@$sessionSearchData["datetimeSelected"] == 'true'){
								$dtStyle = 'style="display:block;"';
							}else{
								$dtStyle = 'style="display:none;"';
							}
						?>
						<div id="datefilterDiv" <?php echo $dtStyle; ?> >
						<span id="openc">
							<input type="text" name="today" id="today" value="<?php echo @$sessionSearchData["todaySelected"]; ?>" class="raduisSelect">
							<img id="datepickerimg" src="<?php echo base_url('images/datepicker.png');?>" alt="celender"/>
							
						</span>
						<span class="nobg check slect1">
							<label for="female" class="radio-btn"><?php echo 'FROM'; ?></label>
							<select name="fromTime" id="fromTime" class="raduisSelect" style="text-transform:lowercase;">
								<option value="0:00">12:00 am</option>
								<option value="0:30">12:30 am</option>
								<option value="1:00">1:00 am</option>
								<option value="1:30">1:30 am</option>
								<option value="2:00">2:00 am</option>
								<option value="2:30">2:30 am</option>
								<option value="3:00">3:00 am</option>
								<option value="3:30">3:30 am</option>
								<option value="4:00">4:00 am</option>
								<option value="4:30">4:30 am</option>
								<option value="5:00">5:00 am</option>
								<option value="5:30">5:30 am</option>
								<option value="6:00">6:00 am</option>
								<option value="6:30">6:30 am</option>
								<option value="7:00">7:00 am</option>
								<option value="7:30">7:30 am</option>
								<option value="8:00">8:00 am</option>
								<option value="8:30">8:30 am</option>
								<option value="9:00">9:00 am</option>
								<option value="9:30">9:30 am</option>
								<option value="10:00">10:00 am</option>
								<option value="10:30">10:30 am</option>
								<option value="11:00">11:00 am</option>
								<option value="11:30">11:30 am</option>
								<option value="12:00">12:00 pm</option>
								<option value="12:30">12:30 pm</option>
								<option value="13:00">1:00 pm</option>
								<option value="13:30">1:30 pm</option>
								<option value="14:00">2:00 pm</option>
								<option value="14:30">2:30 pm</option>
								<option value="15:00">3:00 pm</option>
								<option value="15:30">3:30 pm</option>
								<option value="16:00">4:00 pm</option>
								<option value="16:30">4:30 pm</option>
								<option value="17:00">5:00 pm</option>
								<option value="17:30">5:30 pm</option>
								<option value="18:00">6:00 pm</option>
								<option value="18:30">6:30 pm</option>
								<option value="19:00">7:00 pm</option>
								<option value="19:30">7:30 pm</option>
								<option value="20:00">8:00 pm</option>
								<option value="20:30">8:30 pm</option>
								<option value="21:00">9:00 pm</option>
								<option value="21:30">9:30 pm</option>
								<option value="22:00">10:00 pm</option>
								<option value="22:30">10:30 pm</option>
								<option value="23:00">11:00 pm</option>
								<option value="23:30">11:30 pm</option>
							</select>
						</span>
						<span class="slect1"> 
							<label for="female" class="radio-btn"><?php echo 'TO'; ?></label>
							<select name="toTime" id="toTime" class="raduisSelect">
								<option value="23:30">11:30 pm</option>
								<option value="0:00">12:00 am</option>
								<option value="0:30">12:30 am</option>
								<option value="1:00">1:00 am</option>
								<option value="1:30">1:30 am</option>
								<option value="2:00">2:00 am</option>
								<option value="2:30">2:30 am</option>
								<option value="3:00">3:00 am</option>
								<option value="3:30">3:30 am</option>
								<option value="4:00">4:00 am</option>
								<option value="4:30">4:30 am</option> 
								<option value="5:00">5:00 am</option>
								<option value="5:30">5:30 am</option>
								<option value="6:00">6:00 am</option>
								<option value="6:30">6:30 am</option>
								<option value="7:00">7:00 am</option>
								<option value="7:30">7:30 am</option>
								<option value="8:00">8:00 am</option>
								<option value="8:30">8:30 am</option>
								<option value="9:00">9:00 am</option>
								<option value="9:30">9:30 am</option>
								<option value="10:00">10:00 am</option>
								<option value="10:30">10:30 am</option>
								<option value="11:00">11:00 am</option>
								<option value="11:30">11:30 am</option>
								<option value="12:00">12:00 pm</option>
								<option value="12:30">12:30 pm</option>
								<option value="13:00">1:00 pm</option>
								<option value="13:30">1:30 pm</option>
								<option value="14:00">2:00 pm</option>
								<option value="14:30">2:30 pm</option>
								<option value="15:00">3:00 pm</option>
								<option value="15:30">3:30 pm</option>
								<option value="16:00">4:00 pm</option>
								<option value="16:30">4:30 pm</option>
								<option value="17:00">5:00 pm</option>
								<option value="17:30">5:30 pm</option>
								<option value="18:00">6:00 pm</option>
								<option value="18:30">6:30 pm</option>
								<option value="19:00">7:00 pm</option>
								<option value="19:30">7:30 pm</option>
								<option value="20:00">8:00 pm</option>
								<option value="20:30">8:30 pm</option>
								<option value="21:00">9:00 pm</option>
								<option value="21:30">9:30 pm</option>
								<option value="22:00">10:00 pm</option>
								<option value="22:30">10:30 pm</option>
								<option value="23:00">11:00 pm</option>
								<option value="23:30">11:30 pm</option>
							</select>
						</span>
						</div>
					</dd>
					<dd>
						
					</dd>
					<dd>
						<span class="nobg check">
							<input id="readytotalknow" name="readytotalknow" value="1" <?php if(@$sessionSearchData["readytotalknowSelected"] == 'true'){echo "checked='checked'";} if($nowtalk==1){echo $defaultAny;}?>  type="radio" onMouseDown="this.__chk = this.checked">
							<label for="female" class="radio-btn"><span class="searchrt"><?php echo $lreadytotalk; ?></span></label>
						</span> 
					</dd>
				</dl>
				
				<dl>
					<dt><span class="c133e5f icon_8"><?php echo $lkeyword;?></span></dt>
					<dd>
						<input name="keywords" id="keywords" type="text" class="raduisSelect" style="width:170px; height:21px;"  value="<?php if(@$sessionSearchData["keywordSelected"]){echo $sessionSearchData["keywordSelected"];}else{echo 'Example: John UCLA TOEFL';}; ?>" onblur="if(this.value == '') this.value = 'Example: John UCLA TOEFL'" onfocus="if(this.value == 'Example: John UCLA TOEFL') this.value = ''">
						 
					</dd>
				</dl>
				
				
				<dl>
					<dt><span class="c133e5f icon_8"><?php echo "School";?></span></dt>
					<dd>
						<input name="school" id="school" value="<?php echo $this->session->userdata['sname'];?>" type="text" class="raduisSelect" style="width:170px; height:21px;" >
						
						<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" />
						<div class="autosug" id="ajax_response">
										<div class="wrapper systemError" id="nameErrorBox" style="display: none;">
										</div>
						</div>	
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
        
        <div class="search_rt" style="float:right; margin-left:20px;">
        
        <div class="src-hd" style="margin-bottom:30px;">
				<h4><?php echo $lmapoftutor;?></h4>
				<!--<span><?php echo $lzoomin;?></span>-->
				<!--<div class="serch-btn top-sh-btn">
            		<a class="icon3 serch-pop" href="#">&nbsp;<span class="classic">Mute Video</span></a>
        		</div>-->
			</div> 
			<div style="clear:both;" ></div>
			<input type="button" id="deactivateMap" class="blu-btn" value="<?php echo $lDE_ACTIVATE_MAP;?>" style="cursor:pointer;margin-left: 632px;margin-top: -70px;position: absolute;width: 112px;display:none;">
			<div class="search_rt_top" id="map_canvas" style="height:500px;"></div>
			<!--R&D@Nov-29-2013 : Set Static Map-->
				<!--<span style="float:right"><img id="imghid" title="View map of tutors" src="<?php echo site_url('images/map.png')?>" onclick="div_show();"/></span>-->
                
                <span style="float:right" class="icon-map serch-pop"><img id="imghid" src="<?php echo site_url('images/map.png')?>" onclick="div_show();"/> <span class="classic"><?php echo $viewmap;?></span></span>
                
                <!--<div class="serch-btn map-srch">
		   			<a class="icon-map serch-pop">&nbsp;<span class="classic">View Map of Tutors</span></a>
        		</div>-->
                	
						<span style="float:right" class="icon-map serch-pop hide-map"><img id="imgshow" style="visibility:hidden" src="<?php echo site_url('images/map.png')?>" onclick="div_hide();"/> <span class="classic"><?php echo $viewmap;?></span></span> 
                       
                        
                        
                        
			<div class="search_rt_top" id="static_map_canvas"   style="height:500px;display:none"><img id="static_map_canvas_image" src="<?php echo base_url("images");?>/tutors/tutor_search_activate.png"></div>			
			<!--R&D@Nov-29-2013 : Set Static Map-->
			<!--<div class="showZoomInText">Zoom in and select tutor off the map.</div>-->
			<div class="search_rt_mid">
				<div class="search_rt_mid_t">
					<div style=" float: left; width: 245px;">
						<span class="search_rt_mid_t_lf lh30"><?php echo $lshowing;?> <font class="number nowShow">1-20</font> <?php echo $loutof; ?> <font class="number count">20</font> <?php echo $lresults;?></span><span id="keydisplay" style="line-height: 30px;margin-left: 5px;"></span>
					</div>
					<div class="search_rt_mid_t_rt">
						<div class="v_ajax_page"></div>
					</div>
					<select class="raduisSelect w78 search_rt_mid_t_rt mr30 sortKeys">
					    <option value="select_0"><?php echo $selectoption;?></option>
						<option value="avgRate_0"><?php echo $lrating;?></option>
						<option value="firstName_1"><?php echo $lname;?></option>
						<option value="hRate_1"><?php echo $lprice;?></option>
						
					</select>
					<span class="search_rt_mid_t_rt lh30 mr10"><?php echo $lsortby;?></span>
					<span class="search_rt_mid_t_rt mr30 lh30" style="float:right; margin-left:300px;">
						<a href="#" class="viewCount"><?php echo $lview;?> <font class="number">20</font></a>  |  <a href="#" class="viewCount"><?php echo $lview;?> <font class="number"><?php echo $lall;?></font></a> 
					</span>
				</div>
				<div class="result_title"><?php echo $lfuturedtutor;?></div>
				<div class="result_list featured">

				</div>
				<div class="result_title"><?php echo $lmoreresult;?></div>
				<div class="result_list result" id="tst1">

				</div>
				<div class="fr pt20"><div class="v_ajax_page"><a class="first" href="#">&lt;&lt;</a><a class="prev" href="#">&lt;</a><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a class="next" href="#">&gt;</a><a class="last" href="#">&gt;&gt;</a></div></div>
			</div>
			<div class="search_rt_mid_noresult" style="padding-top: 35px;">
				No Records Found
			</div>
		</div>
    </div>
	</div>
<?php 
$roleIdn = $this->session->userdata('roleId');

if($roleIdn == 0)
{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}else{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}

//$createApBtnRedDn = '<a class="btn_red_big crapp" title="'.$lCREATE_APPOINTMENT_TIP.'" style="display:none;" onclick="crappclk(\'{createClassUrl($T.uid)}\');">'.$apointmentbutton.'</a>';
//$createApBtnRedDbLink = '<a class="btn_red_big crapp" title="'.$lCREATE_APPOINTMENT_TIP.'"  onclick="crappclk(\'{createClassUrl($T.uid)}\');">'.$apointmentbutton.'</a>';
//$createApBtnRedDbfunc = '<a class="btn_gray_big crapp"  title="'.$lCREATE_APPOINTMENT_TIP.'" onclick="addToapointment({$T.uid})">'.$apointmentbutton.'</a>';
$createApBtnBlueDbLink = '<a class="btn_blue_big crapp" title="'.$lREQUEST_APPOINTMENT_TIP.'"  onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span">'.$lrequestappointment.'</span></a>';
//$freeCreateAptBtn = '<a class="btn_red_big" onclick="crappclk(\'{createClassUrl($T.uid)}\');">'.$apointmentbutton.'</a>';
$FreeSession = '<a class="btn_red_big_session crapp" onclick="crappclk(\'{createClassUrl($T.uid)}\');">'.$lFREE_SESSION.'</a>';

//echo 'free-session-- '.$this->session->userdata('free_session');
if($this->session->userdata('free_session') == 'y'  AND $roleIdn == 0):?>
<textarea id="resultListTemplate" style="display:none">

<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163"/></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
		<h1><font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<h1><font>
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>" src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $lsilver; ?>">	{($T.roleId == 2) ? '<img title="<?php echo $lsilver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold"  title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>" src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
</font></h1>
			{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch serch-pop"><a><?php echo $free_session; ?></a> 
            <span class="classic free-sec-open"><img title="tooltip-tutorSearch" src="<?php echo base_url('images/tooltip-tutorSearch.png')?>"></span>
            </span>' : ''}
            
            <br><br>

            <div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/><font size="2px;">Logged In</font></div>
			</div></div>
			
		
			
		<div class="select-bx-nw">
			{#if $T.hsrate>=0 || $T.school_id >0}			
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
						<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
				
				{#/if}
				{#/if}
			<div>
            
			
	 
	     
			
			
		</div>
		<div class="dd_rt">
		<!--- {($T.hasSession == "Yes") ? '<span class="free-sesn-srch"><a>FREE SESSION</a></span>' : ''}--->
			<div class="search_mail">
				<!---<a class="search_mail-bnt" title="<?php //echo $lMESSAGE_THIS_TUTOR;?>"  onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span"><img src="<?php //echo Base_url('images/beepbox.png'); ?>" alt="01" /></span></a> -->
			</div>
			
            <div class="srch-price">
			{#if $T.hsrate>=0}
		<span id='dy{$T.srate}{$T.uid}'>	{($T.hsrate > 0) ? $T.hsrate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#else}
			
			<span id='dy{$T.tutor_markup}{$T.uid}'>	{($T.hRate > 0) ? $T.hRate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#/if}	
            </div>
            
            </div>
	</div>
	<div class="dd_bot" style="width:500px;">
		<div class="stars"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></div>
		<div class="serch-btn">

		<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>
		
			{#if $T.readytotalk[0].readytotalk == 1 }
			
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id})">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#else}
          		 
			 <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#/if}
		    <?php }?>		 
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
           
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
		  
        <div class="btn_group">
        <?php /*<a class="btn_red_big" href="{createClassUrl($T.uid)}">Book Free Session</a>*/?>
           <?php 	//if(($this->session->userdata('user_type')== 'Landding') ) { ?>
		<?php if(@$sessionSearchData["readytotalknowSelected"] == 'true'): ?>
		<!--<a class="btn_red_big bknow"  onclick="bookNow({$T.uid},'{$T.firstName}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo "Book Now Free"; ?></a>---->
		<!---<a class="btn_red_big_session crapp" style="display:none;" href="{createClassUrl($T.uid)}">Free Session </a>	--->
		<?php else: ?>
		<!--<a class="btn_red_big bknow" style="display:none;"  onclick="bookNow({$T.uid},'{$T.firstName}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo $lBOOK_NOW;?></a>-->
		<!--<span class="free-sesn">FREE SESSION</span>-->
		<?php //echo $FreeSession; ?>
		<?php endif; ?>
	   <?php //}?>
        </div>
		
		
		
	</div>
</dd>

-->
</textarea>
<textarea id="resultListFeatureTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
		<h1><font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<h1><font> 
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title=<?php echo $lbronze; ?> src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $lsilver; ?>">	{($T.roleId == 2) ? '<img title=<?php echo $lsilver; ?> src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title=<?php echo $lgold; ?>src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
			</font></h1>
			{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch serch-pop"><a><?php echo $free_session; ?></a> <span class="classic free-sec-open"><img title="tooltip-tutorSearch" src="<?php echo base_url('images/tooltip-tutorSearch.png')?>"></span></span>' : ''}
            <br><br>
            <div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/><font size="2px;">Logged In</font></div>
		
				{#if $T.hsrate>=0 || $T.school_id >0}
		
			
		<div class="select-bx-nw">
						
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
			<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
						<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
				
				{#/if}
			{#/if}	
			<div>
            

 
		
		  	
			
		
		</div>
		<div class="dd_rt">
		<!----{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch"><a>FREE SESSION</a></span>' : ''}---->
			<div class="search_mail">
				<!-- <a class="search_mail-bnt" title="<?php //echo $lMESSAGE_THIS_TUTOR;?>"  onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span"><img src="<?php //echo Base_url('images/beepbox.png'); ?>" alt="01" /></span></a> --->
			</div>
			
            <div class="srch-price">
			{#if $T.hsrate>=0}
		<span id='dy{$T.srate}{$T.uid}'>	{($T.hsrate > 0) ? $T.hsrate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#else}
			
			<span id='dy{$T.tutor_markup}{$T.uid}'>	{($T.hRate > 0) ? $T.hRate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#/if}	
            </div>
            </div>
	</div>
	<div class="dd_bot" style="width:500px;">
		<div class="stars"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></div>
		<div class="serch-btn">
          
		<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk[0].readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id})">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#/if}
		    <?php }?>

			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
        </div>
        <div class="btn_group">
       <?php 	//if( (!$this->session->userdata('user_type')== 'Landding') ) { ?>	   
	   <?php if($roleIdn == 0){ ?>
        <!-- <a class="btn_blue_big"  onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a> ----->
		<?php }else{ ?>
		<!--<a class="btn_gray_big"  onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a>		 ----->
		<?php } ?>
          <?php //}?>
        
		
			<?php if($roleIdn == 0){ ?>
			<?php echo $freeCreateAptBtn; ?>
			<!--<a class="btn_red_big" style="display:none;"  onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id})" title="<?php echo $lBOOK_NOW;?>"><?php echo $lBOOK_NOW;?></a>-->
			<?php }else{ ?>
			<!----<a class="btn_gray_big"  onclick="addToapointment({$T.uid})" title="<?php echo $apointmentbutton; ?>"><?php echo $apointmentbutton; ?></a>----->
			<?php } ?>
		
        </div>
		
		
		
	</div>
</dd>

-->
</textarea>
<?php else:  ?>
 
<textarea id="resultListTemplate" style="display:none">

<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1><font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
            
			<h1><font> 
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>" src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $lsilver; ?>">	{($T.roleId == 2) ? '<img title="<?php echo $lsilver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>"  src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
			</font></h1>
 {($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch serch-pop"><a>FREE SESSION</a> <span class="classic free-sec-open"><img title="tooltip-tutorSearch" src="<?php echo base_url('images/tooltip-tutorSearch.png')?>"></span></span>' : ''}
			<br><br>
			<div class="" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online" style="padding-right:5px;"/><font size="2px;">Logged In</font></div>
		
			{#if $T.hsrate>=0 || $T.school_id >0}
		
			</div></div>
		<div class="select-bx-nw">
				
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
			<span class="timg"><img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/></span>
				{#else}
				
					<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
				
				{#/if}
				
			<div>
            {#/if}
				
			
				
		</div>
		<div class="dd_rt">
		 <!--{($T.hasSession == "Yes") ? '<span class="free-sesn-srch"><a><?php echo $free_session; ?></a></span>' : ''}--->
			<div class="search_mail">
				<!--- <a class="search_mail-bnt" title="<?php //echo $lMESSAGE_THIS_TUTOR;?>" onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span" id="search_mail_span_{$T.uid}"><img src="<?php //echo Base_url('images/beepbox.png'); ?>" alt="01" /></span></a> ----->
			</div>

			
			<div class="srch-price">
			{#if $T.hsrate >=0}
		<span id='dy{$T.srate}{$T.uid}'>	{($T.hsrate > 0) ? $T.hsrate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#else}
			
			<span id='dy{$T.tutor_markup}{$T.uid}'>	{($T.hRate > 0) ? $T.hRate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#/if}	
            </div>

		</div>
	</div>
	<div class="dd_bot" style="width:500px;">
		<div class="stars"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></div>
		<div class="serch-btn">
            
			
			 <?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk[0].readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id})">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#/if}
		    <?php }?>

		
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
        </div>
        <div class="btn_group">
       <?php
	   if($roleId== 0){
	   ?>
        <!---<a class="btn_blue_big" onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a> ----->
		<?php }else{ ?>
		<!---<a class="btn_gray_big" onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a> ----->
		<?php
		}
		?>
          
        
		<?php if(@$sessionSearchData["readytotalknowSelected"] == 'true'): ?>
			<!--<a class="btn_red_big bknow"  onclick="bookNow({$T.uid},'{$T.firstName}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo $lBOOK_NOW;?></a>-->
			<?php if($roleIdn == 0){ ?>
			<?php echo $createApBtnRedDn; ?>
			<?php } ?>
			
		<?php else: ?>
			<?php if($roleIdn == 0){ ?>
			{#if $T.hasSession == "Yes"}
			   <?php //echo $createApBtnRedDbLink; ?>        
			{#else}
			   <?php //echo $createApBtnBlueDbLink; ?>
			{#/if}
			
			 <!-- <a class="btn_red_big bknow" style="display:none;"  onclick="bookNow({$T.uid},'{$T.firstName}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo $lBOOK_NOW;?></a> ------>
			<?php }else{ ?>
			<?php echo $createApBtnRedDbfunc; ?>
			<?php } ?>
		<?php endif; ?>
        </div>		
		
	</div>
</dd>

-->
</textarea>
<textarea id="resultListFeatureTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1><font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<h1><font> 
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>"  src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $silver; ?>">	{($T.roleId == 2) ? '<img title="<?php echo $silver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>"   src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
			</font></h1>	
{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch serch-pop"><a><?php echo $free_session; ?></a><span class="classic free-sec-open"><img title="tooltip-tutorSearch" src="<?php echo base_url('images/tooltip-tutorSearch.png')?>"></span></span>' : ''}	
        <br><br>	
        <div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/><font size="2px;">Logged In</font></div>	
		
		{#if $T.hsrate>=0 || $T.school_id >0}
		
			
		<div style="position:relative; top:-67px; left:290px;width:273px" class="select-bx-nw">
						
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
					<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id});">
							<option value='{$T.school_id}'>Curriculm</option>
							<option value="0" selected>Conversation</option>

						</select>
				
				{#/if}
				
			<div>
            {#/if}

			
		
		</div>
		<div class="dd_rt">
		
      <!----{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch"><a>FREE SESSION</a></span>' : ''}{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch"><a><?php echo $free_session; ?></a></span>' : ''}--->
			<div class="search_mail">
				<!---<a class="search_mail-bnt" title="<?php //echo $lMESSAGE_THIS_TUTOR;?>" onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span" id="search_mail_span_{$T.uid}"><img src="<?php //echo Base_url('images/beepbox.png'); ?>" alt="01" /></span></a>--->
			</div>
			<!--<div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/>Logged In</div>-->
            <div class="srch-price">
			{#if $T.hsrate>=0}
		<span id='dy{$T.srate}{$T.uid}'>	{($T.hsrate > 0) ? $T.hsrate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#else}
			
			<span id='dy{$T.tutor_markup}{$T.uid}'>	{($T.hRate > 0) ? $T.hRate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#/if}	
            </div>
            </div>
	</div>
	<div class="dd_bot" style="width:500px;">
		<div class="stars"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></div>
		<div class="serch-btn">
        
			<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk[0].readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id})">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#/if}
		    <?php }?>
		  
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
        </div>
        
        <div class="btn_group">
       <?php 	//if( (!$this->session->userdata('user_type')== 'Landding') ) { ?>
	   <?php if($roleIdn == 0){ ?>
        <!---<a class="btn_blue_big" onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a> --->
		<?php }else{ ?>
		<!---<a class="btn_gray_big" onclick="addToPotential({$T.uid})" title="<?php //echo $potentialbutton;?>"><?php //echo $potentialbutton; ?></a> --->
		<?php } ?>
          <?php //}?>
        
		
			<?php if($roleIdn == 0){ ?>
			
			{#if $T.hasSession == "Yes"}
			   <?php echo $createApBtnRedDbLink; ?>        
			{#else}
			   <?php //echo $createApBtnBlueDbLink; ?>
			{#/if}
			
			<!--<a class="btn_red_big" style="display:none;" onclick="bookNow({$T.uid},'{$T.firstName}')" title="<?php echo $lBOOK_NOW;?>"><?php echo $lBOOK_NOW;?></a>-->
			<?php }else{ ?>
			<!---<a class="btn_gray_big" onclick="addToapointment({$T.uid})" title="<?php echo $apointmentbutton; ?>"><?php echo $apointmentbutton; ?></a>--->
			<?php } ?>
		
        </div>
		
		
		
	</div>
</dd>

-->
</textarea>
<?php endif; ?>
<script>
//result_list result
$(document).ready(function(){  
  $("span.mytool").hover(function () {
  
 					$(this).append('<div class="tooltipmy"><p><?php echo
						"Bronze Tutor : currently Teacher and is assumed for any registering tutor";?></p></div>');
							}, function () {
								$("div.tooltipmy").remove();
							});
							
});


</script>


<script>

var attempts = 0;
function addToPotential(id){
//alert(id);
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

function addToapointment(id){
	alert('Bookings are reserved for student accounts');
	return false;
}
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
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		
		return profileImgNull + '';
	}
	//return timthumbUrl + profileImgPath+'/'+src+ '&h=163&w=163&zc=0';
	return profileImgPath+'/'+src+ '';
	//return timthumbUrl + profileImgPath+'/'+src+ '&w=163&zc=0';
}
function profileImgResultThumbMap(src){
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		
		return profileImgNull + '&h=50&w=50&zc=0';
	}
	return profileImgPath+'/'+src+ '&h=50&w=50&zc=0';
}
function createClassUrl(uid){
	
	//return createClassPath+'/'+uid;
	return createClassPath+'/'+uid+'/'+0;
}
window.configs = <?php echo json_encode($config);?>;
$(function(){
	// function for free search
	/*$("#free_search").click(function(){		
		
		$("#free_session").val('y');
		$("#sortBy").hide();
		
		window.open('<?php echo base_url("search/freeSearch");?>');
	});*/
	
	
	
	$('a[href=#]').attr('href','javascript:void(0)');
	//initialize();
	$('#search').click(function(){
	//alert('here');
		var _data = {};
		_data['langs'] = $.trim($('#langs').val());
		_hRateStart = $('#hourRateStart').val();
		_hRateEnd = $('#hourRateEnd').val();
		if(parseInt(_hRateEnd)<parseInt(_hRateStart)){
			$('#dialog').html('COST PER CLASS "To" field must be larger than "From".');
			$('#dialog').dialog({modal:true});
			return;
		}
		//$("#free_session").val('');
		_data['freeSes'] = $('#free_session').val();
		//alert(_data['freeSes'])
		_data['langInput1'] = $('#langInput1').val();	
		_data['langInput2'] = $('#langInput2').val();	
		
		_data['hRateStart'] = _hRateStart;
		_data['hRateEnd'] = _hRateEnd;
		_data['availableTobook'] = false;
		
		//_data['online'] = $('#online').is(":checked");
		_data['online'] = false;
		_data['anytutor'] = $('#anytutor').is(":checked");
		
		_data['readytotalk'] = $('#readytotalknow').is(":checked");
		
		
		_data['datetime'] = $('#datetime').is(":checked");
		_data['today'] = $('#today').val();
		//alert(_data['today'])
		_data['fromTime'] = $('#fromTime').val();
		_data['toTime'] = $('#toTime').val();
		
		
		//alert(_data['readytotalk']);
		_data['gender'] = $('#gender').val();
		
		_data['last_toefl_score'] = $('#discussiontopic1').is(":checked");
		_data['last_toiec_score'] = $('#discussiontopic2').is(":checked");
		_data['fltr_business'] = $('#discussiontopic3').is(":checked");
		_data['fltr_medical'] = $('#discussiontopic4').is(":checked");
		_data['fltr_finance'] = $('#discussiontopic5').is(":checked");
		_data['fltr_software'] = $('#discussiontopic6').is(":checked");
		
		_data['country'] = $('#country').val();
		_data['province'] = $('#province').val();
		_data['keyword'] = $.trim($('#keywords').val());
		_data['school'] = $.trim($('#school').val());
		_data['sch'] = $.trim($('#myuid').val());
		
		
		if(_data['sch']=='' && _data['school'] !='')
		{_data['sch']='15000000'; _data['school']=''}
		
		if(_data['keyword'] != '' && _data['keyword'] != 'Example: John UCLA TOEFL')
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
		 
		 //alert(_data['sort']);
		var src = getSearch(_data);
		//alert(src);

		if(src == 'searchresulttrue')
		{
			 //alert('test');
			getSearchMap(_data);
		}else{
			 //alert('test1');
			getSearch(_data);
		}
	});
	
	$('#datetime').click(function(){
		if(this.checked == true)
		{
			$('#datefilterDiv').show();
			$('#readytotalknow').attr('checked',false);
			$('#anytutor').attr('checked',false);
			
		}else{
			$('#datefilterDiv').hide();
		}
	})
	$('#anytutor').click(function(){
		if(this.checked == true)
		{
			$('#readytotalknow').attr('checked',false);
			$('#datetime').attr('checked',false);
			$('#datefilterDiv').hide();
		}
	});
	$('#readytotalknow').click(function(){
		if(this.checked == true)
		{
			$('#anytutor').attr('checked',false);
			$('#datetime').attr('checked',false);
			$('#datefilterDiv').hide();
		}
	});
	
	$('.crappclk').click(function(){
		alert('hi');
		return false;
	});
	
	$('.sortKeys').change(function(){
	
		$('#search').trigger('click');
	})
	$('#search').trigger('click');
	
	$('#keywords').on('keyup', function (event) {
         if(event.which == '13'){
		 
		 
			$('#search').trigger('click');
         }
    });
	$('#school').on('keyup', function (event) {
         if(event.which == '13'){	

         var a=$(".selected").find('.myuid').val();
		 document.getElementById("myuid").value=a;

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
		
		var src = getSearch(_data);
		/*if(src == 'searchresulttrue')
		{
			getSearchMap(_data);
		}*/
		if(src == 'searchresulttrue')
		{
			//alert('test');
			getSearchMap(_data);
		}else{
//alert('test');
			getSearch(_data);
		}
	})
})

function getSearch(data){
 
	window.searchData = data;
	//$.blockUI();
	//alert('now');
	$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
	//--R&D@Nov-29-2013 :  Dialog
	/*$('#dialog').html('loading.').attr('buttontype','doing');
	$('#dialog').dialog({modal: true});*/
	//--R&D@Nov-29-2013 : Dialog
	
	var cookiepage = getCookieValue("page");
	if(cookiepage){
		//alert('hi-'+cookiepage);
		data.page = cookiepage;
	}

	
	var sType = $('#free_session').val();
	//alert(window.searchData);
	$.ajax({
		url: "<?php echo base_url("search/doSearch");?>",
		type: 'GET',
		data: window.searchData,
		dataType: 'html',
		cache: false,
		success: function (msg){
				$.unblockUI();
		/*alert(msg);
		return false;*/
					if (String == msg.constructor)
					{
						var result;
						//result = eval('(' + msg + ')');
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					//alert(msg)
					var cookiepage = getCookieValue("page");
					if(cookiepage)
					{
						result.page = cookiepage;
					}
					
					if(result.count != '' || result.count !=0)
					{
						$('.search_rt_mid').show();
						$('.search_rt_mid_noresult').hide();
						
						
						$('.number.nowShow').html(((result.page-1)*result.perPage +1 )+'-'+((result.page-1)*result.perPage + result.count));
						$('.number.count').html(result.totalCount);
						$('.search_rt_mid_t_rt').show();
						$('.v_ajax_page').show();
						
					}
					else{
						$('.search_rt_mid').hide();
						$('.search_rt_mid_noresult').show();
						
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
									
									var dt = new Date(), expiryTime = dt.setTime( dt.getTime() + 1800000 );
									document.cookie="page="+_data['page']+"; expires=" + dt.toGMTString();
									
									getSearch(_data);
								}
					});
					
					$('.result_list.featured').empty();
					$.each(result.rows['feature'],function(k,v){
						//alert(v['online'])
						var temp = $("<dl></dl>");
						if(sType == 'y')
						{
							temp.setTemplateElement('freeResultListTemplate');
							//temp.setTemplateElement('freeResultListTemplate');
							
						}else{
							temp.setTemplateElement('resultListFeatureTemplate');
							//temp.setTemplateElement('resultListTemplate');
						}	
						v['hRate'] = v['hRate'] * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
								
						v['hRate'] = Math.round(parseInt(v['hRate'] *10000) /100)  /100;
						v['hRate'] = v['hRate'].toFixed(2);
						temp.processTemplate(v);
						temp.appendTo('.result_list.featured').show(1000);
					})
					$('.result_list.result').empty();
					
					$.each(result.rows['result'],function(k,v){
						//alert(v);
						//alert(v['online'])
						var temp = $('<dl class="none"></dl>');
						if(sType == 'y')
							temp.setTemplateElement('freeResultListTemplate');
						else
							temp.setTemplateElement('resultListTemplate');
						v['hRate'] = v['hRate'] * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
								
						v['hRate'] = Math.round(parseInt(v['hRate'] *10000) /100)  /100;
						v['hRate'] = v['hRate'].toFixed(2);
						temp.processTemplate(v);
						temp.appendTo('.result_list.result').show(1000);
					})
					
					// get attempts if search data is not found
					
					if(attempts < 3)
					{
						if(result.rows['result'].length == 0 || result.rows['result'].length == '')
						{
							attempts = attempts + 1;
							var _data = window.searchData;
							getSearch(_data);
						}else{
							attempts = 0;
						}
					}
					
					
					$('#dialog').attr('buttontype','done');
					$( "#dialog:ui-dialog" ).dialog( "destroy" );
					data.page = 1;
					
					if(data.readytotalk == true)
					{
						//alert('hi')
						$('.crapp').hide();
						$('.bknow').show();
					}else{
						$('.bknow').hide();
						$('.crapp').show();
						
					}
					
					getSearchMap(data);
					
		}
		
	 });
				return 'searchresulttrue'; 
	
	
}


//----------------------------------Get Map Data---


		function getSearchMap(data){
			console.log(data);
			window.searchData 	= data;
			data['perPageMap'] 	= 5000;

			 $.ajax({
                    url: "<?php echo base_url("search/doSearchMap");?>",
                    type: 'GET',
                    data: window.searchData,
                    dataType: 'html',
                    cache: false,
                    success: function (msg){
					//alert(msg);
							if (String == msg.constructor) {
								var result;
								//result = eval('(' + msg + ')');
								eval('result = ' + msg);
								//eval ('var result = ' + msg);
									
							} else {
								var result = msg;
								//alert(result);
							}
							//alert(result.length);
							
							mapDataJson = result.rows['result'];
							mapDataJsonFeature = result.rows['feature'];
							//alert(mapDataJson.length)
							
							//--R&D@Nov-29-2013 : call to intialize
							initialize();
							//--R&D@Nov-29-2013 : call to intialize
					}
                 });
		}


//----------------------------------------------
var mapDataJson = [];
var geocoder = new google.maps.Geocoder();
var iniCenter = 0;
var map;
var set = 0;
var noworry = 0;
var tmpnumlat = 0;
var tmpnumlng = 0;
var generated = 0;	
var prev_infowindow =false; 
var iconBase = '<?php echo base_url("images");?>/';
function setMapOnCenterLatLong()
{
	var s= document.getElementById("country").value;
		
	if(s  != 0  && set==0){
		var text = $("#country option[value="+s+"]").text();
		geocoder.geocode( { 'address': text}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			//map.setCenter();
			set  = 1;
			return results[0].geometry.location;
			 
		}
		
		})
		
	}
}

function initialize() {
			//alert(mapDataJson.length);
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
					
					$.each(mapDataJsonFeature,function(k,v){
						pinOnMap(v, k);
					})
					
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
				
			}else{
				//alert('No Data');
				$("#map_canvas").css("text-align","center").css("background","#ebebeb").html("<span style='font-size:24px; font-weight:bold; color:#999999; position:relative; top:112px;'>No Tutors Found</span>");
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
						
						/*
						
						$.get('<?php echo base_url("search/storeL");?>',udata,function(msg){	
								//alert(msg);
						})*/
						
						 $.ajax({
							url: "<?php echo base_url("search/getL");?>",
							type: 'GET',
							data: udata,
							dataType: 'html',
							cache: false,
							success: function (msg){
									var j 		= msg;
									myArray = msg.split('[');
									myArray = myArray[1].split(']');

									var rs = JSON.parse(myArray[0]);
							}
						 });
		               
						var iconBase = '<?php echo base_url("images");?>/';
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
									
									infoHtml += "<img src='<?php echo base_url();?>/timthumb.php?src=" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' />";
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
					var iconBase = 'http://thetalklist.com/images/';
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
							
							infoHtml += "<img src='<?php echo base_url();?>/timthumb.php?src=" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' />";
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

			function goProfile(userid)
		    {
		    	document.cookie="userID=" + userid;
		    }
			
			// map on single start
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
								data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
								data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
								var infoHtml = "";
								infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
								infoHtml += "<img src='<?php echo base_url();?>/timthumb.php?src=" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' />";
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
								infoHtml += "credits/session</span></p>";
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
					if (true || data.simple == "0")
					{
						data.hRate = data.hRate * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
						data.hRate = Math.round(parseInt(data.hRate *10000) /100)  /100;
						var infoHtml = "";
						infoHtml += "<div style='width:300px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'>";
						infoHtml += "<img src='<?php echo base_url();?>/timthumb.php?src=" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' />";
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
						infoHtml += "credits/session</span></p>";
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
			// map on single end
			$('#dialog').attr('buttontype','done');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
</script>
<script>
$(function(){
	//alert('hi');
	
	$(".search_mail_span").hover(function () {
		$(this).append('<div class="tooltip"><p><?php echo $lMESSAGE_THIS_TUTOR;?></p></div>');
	}, function () {
		$("div.tooltip").remove();
	});
	
	$('#keywords').click(function(){
		$(this).focus();
	});
	
	var _dis_back_key = true;
	$(window).load(function() {
        _dis_back_key = false;
    });
	$(document).keydown(function(e) {
		if (e.keyCode === 8 && _dis_back_key == true) {
			return false;
		}
	});
	
});
//skvirja 31 Oct - checks for profile is complete
function crappclk(lnk)
{
	var profileCompletion;
	var pUrl = '<?php echo base_url(); ?>user/checkProfileIsComplete';
	$.ajax({
		type:'GET',
		async:false,
		url: pUrl,
		success: function(msg){
			if (String == msg.constructor)
			{
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			profileCompletion = result.profileCompletion;
		}
	});
	if(!profileCompletion){
		alert('Please complete your personal profile before your booking');
		window.location.href = "<?php echo base_url(); ?>user/registeredit/";
		return false;
	}else{
		window.location.href = lnk;
	}
	//return false;
}
</script>

<!--R&D@Nov-29-2013 : Script for static map toggle-->
<script type="text/javascript">
 $(document).ready(function () {
            $('#tst').live('keypress', function (e) {
			alert("k");
			            });
        });
function getuid(a)
{
//alert(a);
var uid=a;
document.getElementById("myuid").value=a;
}
$( document ).ready(function() {

/*$("#search").click(function() {
        var fid = $('input[type="hidden"]', this).val();
        document.getElementById("myuid").value=fid;
    });*/
	
	

	$( '#map_canvas').hide();
	$( '#static_map_canvas').css('cursor', 'pointer');
	$( '#static_map_canvas' ).hover(function(){ $( '#static_map_canvas_image' ).attr("src", '<?php echo base_url("images");?>/tutors/tutor_search.png');});
	$( '#static_map_canvas' ).mouseout(function(){ $( '#static_map_canvas_image' ).attr("src", '<?php echo base_url("images");?>/tutors/tutor_search_activate.png');});
	$( '#static_map_canvas' ).click(function(){
	   
		$( '#static_map_canvas').hide();
		$( '#deactivateMap').css('display', 'block');
		$( '#deactivateMap').css('z-index', '1');
		$( '#imgshow').css('display', 'none');
		$( '#imghid').css('display', 'none');
		
		$( '#map_canvas').show();
		initialize();
	});
	$( '#deactivateMap' ).click(function(){
	    $( '#imgshow').css('display', 'block');
		$( '#imghid').css('display', 'block');
		
		$( '#static_map_canvas').show();
		$( '#map_canvas').hide();
		$( '#deactivateMap').css('display', 'none');
		$( '#deactivateMap').css('z-index', '0');
		document.getElementById("static_map_canvas").style.display = 'none';
	});
});
</script>
<!--R&D@Nov-29-2013 : Script for static map toggle-->


<style>
	span.searchrt {
	  cursor: pointer;
	  display: inline-block;
	  color: White;
	  border-radius: 8px;
	  position: relative;
	}
	span.searchdt {
	  cursor: pointer;
	  display: inline-block;
	  color: White;
	  border-radius: 8px;
	  position: relative;
	}
	
	span.timg {
	  cursor: pointer;
	  display: inline-block;
	  color: White;
	  
	  position: relative;
	}
	
	span.searchat {
	  cursor: pointer;
	  display: inline-block;
	  color: White;
	  border-radius: 8px;
	  position: relative;
	}
	span.mytool {
	  
	  display: inline-block;
	 
	  border-radius: 8px;
	  position: relative;
	}
	
	div.tooltip {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: 103px;
	  top: -27px;
	  z-index: 1000000;
	  width: 250px !important;
	  border-radius: 5px; 
	  word-wrap:break-word;
	}
	div.tooltip:before {
	  border-color: transparent #037898 transparent transparent;
	  border-right: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 6px 6px 0px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  left: -6px;
	}
	div.tooltip p {
	  margin: 10px;
	  color: White; 
	  word-wrap:break-word;
	  text-transform:none;
	  font-size:14px;
	  line-height:16px;
	}
	.search_lf_mid dd .check{ white-space:normal !important; line-height:14px; font-weight:normal;}
	.baseBoxBg{  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: block;
    margin: 0 auto;
    width: 758px;}
	.content_main{ float:left;}
	
	div.tooltipat {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: 60px;
	  top: -27px;
	  z-index: 1000000;
	  width: 250px !important;
	  border-radius: 5px; 
	  word-wrap:break-word;
	  font-size:14px;
	}
	div.tooltipat:before {
	  border-color: transparent #037898 transparent transparent;
	  border-right: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 6px 6px 0px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  left: -6px;
	}
	div.tooltipat p {
	  margin: 10px;
	  color: White; 
	  word-wrap:break-word;
	  text-transform:none;
	  font-size:14px;
	  line-height:16px;
	}
	
	div.tooltipmy {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: 60px;
	  top: -27px;
	  z-index: 1000000;
	  width: 250px !important;
	  border-radius: 5px; 
	  word-wrap:break-word;
	  font-size:14px;
	}
	div.tooltipmy:before {
	  border-color: transparent #037898 transparent transparent;
	  border-right: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 6px 6px 0px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  left: -6px;
	}
	div.tooltipmy p {
	  margin: 10px;
	  color: White; 
	  word-wrap:break-word;
	  text-transform:none;
	  font-size:14px;
	  line-height:16px;
	}
	
	div.tooltipdt {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: 96px;
	  top: -25px;
	  z-index: 1000000;
	  width: 250px !important;
	  border-radius: 5px; 
	  word-wrap:break-word;
	  font-size:14px;
	}
	div.tooltipdt:before {
	  border-color: transparent #037898 transparent transparent;
	  border-right: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 6px 6px 0px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  left: -6px;
	}
	div.tooltipdt p {
	  margin: 10px;
	  color: White; 
	  word-wrap:break-word;
	  text-transform:none;
	  font-size:14px;
	  line-height:16px;
	}
	#imghid
	{
	margin-top:-75px;
	}
	#imgshow
	{
	margin-top:-75px;
	}
	
	.list li a{
	text-align : left;
	padding:2px;
	cursor:pointer;
	display:block;
	text-decoration : none;
	color:#000000;
	width:170px;
	height:40px;
}


.free-sesn{ float:left; width:140px; height:88px; margin:0 25px 0 0;background:url(../images/free-ses.png) 0 0 no-repeat;}
.free-sesn { width:133px; height:75px; text-align:center; color:#fff; font-size:15px; font-weight:bold; text-transform:uppercase; line-height:75px; float:left;}
	 
	 
.search #sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}
	</style>
<?php $this->layout->appendFile('css',"css/auto.css");?>
<?php $this->layout->appendFile('javascript',"js/autosearch.js");?>
<script>
function check(a,uid,hrate,srate,schoolid)
{
var abx="dy"+hrate+uid;
hrate=parseFloat(Math.round(hrate * 100) / 100).toFixed(2);
srate=parseFloat(Math.round(srate * 100) / 100).toFixed(2);

if(a == 0)
{
document.getElementById(abx).innerHTML = srate+" Credits/session" ;

}
else
{
 
document.getElementById(abx).innerHTML = hrate+" Credits/session" ;
}
document.getElementById(uid).href=createClassPath+'/'+uid+'/'+a+'/'+schoolid; 
}

</script>