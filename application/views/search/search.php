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
$arrVal = $this->lookup_model->getValue('916', $multi_lang);
$exp = $arrVal[$multi_lang];
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
$arrVal 	= $this->lookup_model->getValue('152', $multi_lang);	$selectoption  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('418', $multi_lang);	$nrecordfound  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('900', $multi_lang);	$curriculum  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('901', $multi_lang);	$conversation  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('905', $multi_lang);	$OpenSlot 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('726', $multi_lang);	$SchoolNm 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('925', $multi_lang);	$talknotavail 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1005', $multi_lang);	$tutorwillsend 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1006', $multi_lang);	$tutotwillsendnoamount 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1057', $multi_lang);	$PleaseComplete 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('960', $multi_lang);	$thisOffer 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('930', $multi_lang);	$noCreditcard 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('961', $multi_lang);	$chooseeither 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1058', $multi_lang);	$FeatureAppoiment 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1059', $multi_lang);	$ifgreen	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1060', $multi_lang);	$infiveminute	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1063', $multi_lang);	$tutorresults	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1064', $multi_lang);	$vmap	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1084', $multi_lang);	$insuuffi	= $arrVal[$multi_lang];
//--R&D@Oct-30 : Set Language Variables

$arrVal = $this->lookup_model->getValue('1123', $multi_lang);
$ThisTutAffiliate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1124', $multi_lang);
$SelectToConfirm = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('901', $multi_lang);
$ConvesationS = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('900', $multi_lang);
$CUrriculams = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1125', $multi_lang);
$InformalSpeaking = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1126', $multi_lang);
$StructureLearning = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('321', $multi_lang);
$CreditsTut = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('482', $multi_lang);
$Oks = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('412', $multi_lang);
$Cancels = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1127', $multi_lang);
$YouAreTryingTo = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1135', $multi_lang);
$ViewProf = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1136', $multi_lang);
$ViewVideo= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1137', $multi_lang);
$secondStep= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1119', $multi_lang);	$NoSesssion 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1132', $multi_lang);	$ChooseTutor 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1133', $multi_lang);	$SetCriteria 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1134', $multi_lang);	$STep 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1393', $multi_lang);
$confirmyourbooking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1394', $multi_lang);
$tutorwillbesent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1395', $multi_lang);
$whentutorarrives = $arrVal[$multi_lang];
$this->layout->appendFile('css',"css/search.css");
$this->layout->appendFile('javascript',"js/jquery.placeholder.js");
$this->layout->appendFile('javascript',"js/jq.page.js");
$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/googlemapapi.js");
$this->layout->appendFile('javascript',"js/jquery.blockUI.js");
//datepicker
$this->layout->appendFile('javascript',"js/datepicker/jquery.simple-dtpicker.js");
$this->layout->appendFile('css',"js/datepicker/jquery.simple-dtpicker.css");

if (isset($_GET['frm'])) {
$arrVal = $this->lookup_model->getValue('1343', $multi_lang); $lngYourPerfect	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1344', $multi_lang); $lngExpOur	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1345', $multi_lang); $lngLession	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1346', $multi_lang); $lngCnv	= $arrVal[$multi_lang];
?>
<div class="search-popup" style="display:none;" id="searchnew2">
	<h1><?php echo $lngYourPerfect;?></h1>
    <?php 
	$url = "#";
	if(!empty($selcategory['pfile']) and file_exists(FCPATH.'uploads/categories/'.$selcategory['pfile'])){
		$url = base_url("/uploads/categories/".$selcategory['pfile']);
	}?>
	<a href="<?php echo $url;?>" target="_blank"><h2><?php echo $lngExpOur;?><br/><?php echo sprintf($lngLession,strtoupper($selcategory['category']));?></h2></a>
    <p><?php echo $lngCnv;?></p>
</div>
<script>
$(document).ready(function(){
$('#searchnew2').dialog({
		modal:true,
		width:'400px',
		resizable:false,
});
$('.ui-dialog').wrap('<div class="searchppnw-main"></div>' );
$('div.ui-dialog').addClass('searchppnw');
});
</script>
<?php }?>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript">
function reLoad()
{
	jQuery("#vidDialog video").get(0).pause();
	jquery.post();
}
jQuery(document).ready(function(){
	jQuery(".lnkHelp").click(function(){
		jQuery("#vidDialog video").get(0).currentTime = 0;
		jQuery("#vidDialog").dialog({
			dialogClass: "helpvideo",
			resizable: false,
			width:'auto',
			modal: true,
			close:function(){
				reLoad();
			}
		});
	});
	
	

});
</script>
<script>
 
 
 

$(window).load(function() {
searchAll();
var a='<?php echo $this->session->userdata('firstTimeRegister'); ?>'; 

var x='<?php echo $this->session->userdata('Continue');?>';
var step="<?php echo $_GET["step"];?>";
var rollId='<?php echo $this->session->userdata('roleId'); ?>'; 
/*
if(a =='yes' && rollId==0 && (x=='' || step==1))
	{
		<?php echo $this->session->set_userdata('Continue','yes');?>
		window.scrollTo(0,100);	
		$('#firstTour').dialog({
					modal:true,
					width:'430px',
					resizable:false,
			});
			$('.ui-dialog').wrap('<div class="main_student-popupdiv1"></span>' );
			//$( "div.result_list dl" ).first().addClass( "highlight1");
			$('div.featured').addClass('highlight1');
	}*/
});
 

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
var dg =0;
function bookNow(tid,username,schoolId,hrate)
{
	if($(".icon3").hasClass("loadingBk")){
		return; 
	} 
	$(".icon3").addClass('loadingBk');
	bookNow1(tid,username,schoolId);
}
function bookNow1(tid,username,school_id)
{
	var mu_uid = $("#uid").val();
 
if(mu_uid=='')
 {
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$('#dialog').attr('buttonType','done');
	$('#dialog').html('<?php echo $YouMust;?>');
	$( ".floating_form" ).show();
 }
 else
 {
 var lastClickedOnBook = false;
	//prevent multiple clicks
	if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	var refid ="<?php echo $Refid; ?>";
	
	var sessiontype=$('input[name=amex]:checked').val();
	if (school_id > 0 )
	{
		_data['schoolid']=school_id;
	}
	else
	{
		_data['schoolid']=0;
	}
	/* if(sessiontype==1 && refid != school_id)
	 {
		alert('You are not associated with this Tutor School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
		return false;
	 }*/
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
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
		$(".icon3").removeClass("loadingBk");  
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}else{
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,title:" ",resizable:false,  close: function( event, ui ) {self.location = self.location.href;}});
				return false;
			}else if(window.profileComplete == false){
				alert('<?php echo $PleaseComplete;?>');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
			else if(window.enough==true){
				//alert('test');
				 var message ="<?php echo $tutotwillsendnoamount;?>";
			      var conf = confirm(message);
				  var classcost = window.cost;
					if(conf == true)
					{
					// send message to tutor
						$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
							
							//redirect to student dashboard page
								window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});return;
					callback(false);
					}else{
						return;
					}
					callback(false);
			}
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = '<?php echo $insuuffi;?>';
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
							$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						/*alert(msg);
						return false;*/
						//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});
						return;callback(false);
						$(this).dialog("close");},
						"Cancel": function() { $(this).dialog("close");}
					}
			});
			/*var classcost = window.cost;
			if(conf == true)
			{	
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			return;callback(false);
			}else{
			  
				return false;
			}*/
			lastClickedOnBook = false;
		 
		}
		return false;
	}//,4000);return false;
}}
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<style>
.ui-button-text{background-color: #0089D1 !important;color:white}
#searchPopup
{
	z-index:9999;
	position:absolute;
	border: 1px solid #AAAAAA; margin:0% 27%; width:400px;
}	

 #searchPopup .header-pop{  background: url(images/ui-bg_highlight-soft_75_cccccc_1x100.png) repeat-x 50% 50% #CCCCCC;
    border: 1px solid #AAAAAA;
    color: #222222;
    font-weight: bold;   border-radius: 4px; padding:5px 7px;}
	.sr-pop-cnt{ padding:10px;}
.search_mail {
	float:left;
}
.sendMessageView{
	/*margin: 0 auto;
	position: fixed;
	top:15%;
	width: 76%;
	z-index: 1028;*/
	margin: 0 auto 0 15.3% !important;
	position: fixed;
	top:17%;
	width:600px !important;
	z-index: 99999; left:inherit !important;
}
.btn_blue_bg{
	background: url(../images/btn2.png) no-repeat 0 0 ;
	margin-right: 148px;
	width: 57%;
	margin-top: 17px;
}
.btn_blue_bg_crap{
	background: url(../images/btn2.png) no-repeat 0 0;
	float: right;
    padding: 0px 13px 6px 10px;
	
}
.search_mail a:hover{color: #FFFFFF !important;}
</style>
<div id="searchPopup" style="display:none;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
<?php
if($this->session->userdata('userFrom') == 'landing' AND $this->session->userdata('new') == 1): ?>
<!-- Naver conversion code -->
 <script type="text/javascript" src="https://wcs.naver.net/wcslog.js"> </script> 
 <script type="text/javascript">
var _nasa={};
 _nasa["cnv"] = wcs.cnv("2","10"); // ????, ???? ?????. ????? ??
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
endif; ?>
<script>
function closepopwin()
{
	$('#searchPopup').hide();
}
function sendBeepBoxMessage(uid)
{ //alert(uid);
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
document.getElementById("imgshow").style.display = 'block';
document.getElementById("imghid").style.display = 'none';
$('.session-icon').addClass('left-side-icon');
$('.map-div').addClass('map-showdiv');
}

function div_hide()
{
//alert(a);
document.getElementById("map_canvas").style.display = 'none';
document.getElementById("static_map_canvas").style.display = 'none';
document.getElementById("imgshow").style.display = 'none';
document.getElementById("imghid").style.display = 'block';
$('.session-icon').removeClass('left-side-icon');
$('.map-div').removeClass('map-showdiv');

}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('.criteria').click(function(){
		$('.criteria').toggleClass('active');
		$( ".left-sidebar" ).slideToggle( "slow");
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
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
	_data['langInput1'] = $('#langInput1').val();	
	_data['langInput2'] = $('#langInput2').val();	
	_data['hRateStart'] = _hRateStart;
	_data['hRateEnd']	= _hRateEnd;
	_data['availableTobook'] = false;
	_data['online'] = false;
	_data['anytutor'] = $('#anytutor').is(":checked");
	_data['readytotalk'] = $('#readytotalknow').is(":checked");
	_data['datetime'] = $('#datetime').is(":checked");
	_data['today'] = $('#today').val();
	_data['fromTime'] = $('#fromTime').val();
	_data['toTime'] = $('#toTime').val();
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
	_data['sch'] = $.trim($('#sch').val());
	if (_data['sch']=='' && _data['school'] !='') {
		_data['sch']='15000000';
		_data['school']='';
	}
	if (_data['keyword'] != '' && _data['keyword'] != 'Example: John UCLA TOEFL') {
		$('#keydisplay').html(' for ' + _data['keyword']);
	} else {
		$('#keydisplay').html('');
	}
	_data['page'] = 1;
	
	if(!document.location.search){
		document.cookie="page=1";
	} 
	_data['perPage'] = window.perPage;
	var _sort = $('.sortKeys').val().split('_');
	_data['sort'] = _sort[0];
	_data['sortAsc'] = _sort[1];
	
	//alert(_data['sort']);
	document.cookie="page=1";
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
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#search").click(function(){
		document.cookie="page=1";
		self.location = "<?php echo base_url(""); ?>";
	});
});
</script>
<div class="search">
	<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
    <div class="tutor-searchpg">
		<form name="frmSearch" id="frmSearch" action="" method="get">
    	<div class="top-header">
	    <?php $arrVal 	= $this->lookup_model->getValue('1248', $multi_lang);	$lblCriteria = $arrVal[$multi_lang];?>
            <div class="criteria"><span><?php echo $lblCriteria;?></span></div>
	    <div id="map" class="icon-map serch-pop hide-map">
                <span class="map-icon"><?php echo $vmap; ?></span><img id="imghid" src="<?php echo site_url('images/map.png')?>" onclick="div_show();" class="map-show"/> <span class="classic"><?php echo $viewmap;?></span>
                <img id="imgshow" style=" display:none;" class="map-show" src="<?php echo site_url('images/map.png')?>" onclick="div_hide();"/> <span class="classic"><?php echo $viewmap;?></span>
            </div>
            <div id="tutor-search" class="tutor-search">
            	<div id="language-search">
					<input type="hidden" value="" id="free_session"  name="freeSes" />
                    <?php 
					echo form_dropdown('langInput1',$langsAll,@$sessionSearchData["langInput1Selected"],' id="langInput1" class="raduisSelect w78" ');?>
                </div>
                <div id="keyword-search">
                    <input name="keywords" id="keywords" type="text" class="raduisSelect" value="<?php echo @$sessionSearchData["keywordSelected"] ?>" placeholder="<?php echo $lkeyword;?>">
                </div>
				<div id="filter-search" class="filter-search">
					 <select class="raduisSelect w78 search_rt_mid_t_rt mr30 sortKeys flt-rgt" id="sortKeys" name="sortKeys">
						<option value="select_0" <?php echo (@$sessionSearchData["sortKeys"] === 'select_0') ? 'selected': ''; ?>><?php echo $selectoption;?></option>
						<option value="avgRate_0" <?php echo (@$sessionSearchData["sortKeys"] === 'avgRate_0') ? 'selected': ''; ?>><?php echo $lrating;?></option>
						<!--<option value="firstName_1"><?php echo $lname;?></option>-->
						<option value="hRate_1" <?php echo (@$sessionSearchData["sortKeys"] === 'hRate_1') ? 'selected': ''; ?>><?php echo $lprice;?></option>
					</select>
                </div>

            </div>
                <div>
                    <input value="<?php echo $lSEARCH;?>" class="btn_red" id="search" type="submit">
                </div>
		</div>  
    	<div class="tutor-cnt">
        	<div class="left-sidebar" style="display:none;">
            	<div class="blank-dv">&nbsp;</div>
				<p>
                	<label><?php echo $secondlang; ?> <?php echo $llanguages;?></label>
                    <?php echo form_dropdown('langInput2',$langsAll2,@$sessionSearchData["langInput2Selected"],' id="langInput2" class="raduisSelect w78" ');?>	
                </p>
                <p>
                	<label><?php echo $lgender;?></label>
                    <select class="raduisSelect" name="gender" id="gender">
                        <option value="all" <?php if(@$sessionSearchData["genderSelected"] == 'all'){echo 'selected';} ?>><?php echo $lnopreference;?></option>
                        <option value="0" <?php if(@$sessionSearchData["genderSelected"] == '0'){echo 'selected';} ?>><?php echo $lfemale; ?></option>
                        <option value="1" <?php if(@$sessionSearchData["genderSelected"] == '1'){echo 'selected';} ?>><?php echo $lmale;?></option>
                    </select>
                </p>
                <p>
                	<label><?php echo $SchoolNm;?></label>
                    <input name="school" id="school" value="<?php echo $sessionSearchData['sname'];?>" type="text" class="raduisSelect">					
					<input type="hidden" name="sch" id="sch" value="<?php echo $sessionSearchData['sid'];?>" />
                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" disabled />
                    <div class="autosug" id="ajax_response">
                        <div class="wrapper systemError" id="nameErrorBox" style="display: none;"></div>
                    </div>
                </p>
                <p>
					<span class="icon_3"><?php echo $llocation;?></span>
					<?php 
					if (@$sessionSearchData["countrySelected"]) {
						$countrySelected = $sessionSearchData["countrySelected"];
					} else {
						$countrySelected = '0';
					}
					echo form_dropdown('country',$countries,$countrySelected,' id="country" class="raduisSelect w78 select-box-marg"  ');
					if (@$sessionSearchData["provinceSelected"]) {
						$provinceSelected = $sessionSearchData["provinceSelected"];
					} else {
						$provinceSelected = '0';
					}
					echo form_dropdown('province',$provinces, $provinceSelected,' id="province" class="raduisSelect w78"  ');?>					
				</p>
                <div class="blank-dv">&nbsp; </div>   
				<?php
				//get default selected
				$defaultAny = "checked='checked'";
				if (@$sessionSearchData["datetimeSelected"] != 'true') {
						$defaultAny = "checked='checked'";
				} else {
					$defaultAny = "";
				}
				
				if (@$sessionSearchData["readytotalknowSelected"] != 'true') {
					$defaultAny = "checked='checked'";
				} else {
					$defaultAny = "";
				}
				
				if (@$sessionSearchData["anytutorSelected"] != 'true') {
					$defaultAny = "checked='checked'";
				} else {
					$defaultAny = "";
				}
				?>
				<script>
				$(function(){
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
						$('#today').next('div').addClass('datpicernw');
					});
					
					$('#today').appendDtpicker({
						"inline": false,
						"futureOnly": true,
						"dateOnly": true,
						//"dateFormat": "DD-MM-YYYY",
						"todayButton": false,
						"closeOnSelected": true,
						"autodateOnStart": false
					});
					
					$("body").click(function (e) {
						if (e.target.nodeName != "INPUT" && e.target.className!= "datepicker" ) {
							if (e.target['id'] != 'datepickerimg') {
								$(".datepicker").hide();
							}
						}
					});
				});
				</script>
				
				<div id="datefilterDiv" <?php echo $dtStyle; ?> >
					<div class="dat-time">
						<label><?php echo $ldatetimelocal; ?></label>
						<span id="openc">
							<input type="text" name="today" id="today" value="<?php echo @$sessionSearchData["todaySelected"]; ?>" class="raduisSelect">
							<img id="datepickerimg" src="<?php echo base_url('images/datepicker.png');?>" alt="celender"/>
						</span>
					</div>
					<div class="frm-to">
						<span class="nobg check slect1">
							<?php
							$arrVal = $this->lookup_model->getValue('77', $multi_lang);$from = $arrVal[$multi_lang];?>
							<label for="female" class="radio-btn"><?php echo $from; ?></label>
							<select name="fromTime" id="fromTime" class="raduisSelect" style="text-transform:lowercase;">
								<option value="0:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"0:00") ? "selected=selected" : "";?>>12:00 am</option>
								<option value="0:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"0:30") ? "selected=selected" : "";?>>12:30 am</option>
								<option value="1:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"1:00") ? "selected=selected" : "";?>>1:00 am</option>
								<option value="1:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"1:30") ? "selected=selected" : "";?>>1:30 am</option>
								<option value="2:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"2:00") ? "selected=selected" : "";?>>2:00 am</option>
								<option value="2:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"2:30") ? "selected=selected" : "";?>>2:30 am</option>
								<option value="3:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"3:00") ? "selected=selected" : "";?>>3:00 am</option>
								<option value="3:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"3:30") ? "selected=selected" : "";?>>3:30 am</option>
								<option value="4:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"4:00") ? "selected=selected" : "";?>>4:00 am</option>
								<option value="4:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"4:30") ? "selected=selected" : "";?>>4:30 am</option>
								<option value="5:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"5:00") ? "selected=selected" : "";?>>5:00 am</option>
								<option value="5:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"5:30") ? "selected=selected" : "";?>>5:30 am</option>
								<option value="6:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"6:00") ? "selected=selected" : "";?>>6:00 am</option>
								<option value="6:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"6:30") ? "selected=selected" : "";?>>6:30 am</option>
								<option value="7:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"7:00") ? "selected=selected" : "";?>>7:00 am</option>
								<option value="7:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"7:30") ? "selected=selected" : "";?>>7:30 am</option>
								<option value="8:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"8:00") ? "selected=selected" : "";?>>8:00 am</option>
								<option value="8:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"8:30") ? "selected=selected" : "";?>>8:30 am</option>
								<option value="9:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"9:00") ? "selected=selected" : "";?>>9:00 am</option>
								<option value="9:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"9:30") ? "selected=selected" : "";?>>9:30 am</option>
								<option value="10:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"10:00") ? "selected=selected" : "";?>>10:00 am</option>
								<option value="10:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"10:30") ? "selected=selected" : "";?>>10:30 am</option>
								<option value="11:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"11:00") ? "selected=selected" : "";?>>11:00 am</option>
								<option value="11:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"11:30") ? "selected=selected" : "";?>>11:30 am</option>
								<option value="12:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"12:00") ? "selected=selected" : "";?>>12:00 pm</option>
								<option value="12:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"12:30") ? "selected=selected" : "";?>>12:30 pm</option>
								<option value="13:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"13:00") ? "selected=selected" : "";?>>1:00 pm</option>
								<option value="13:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"13:30") ? "selected=selected" : "";?>>1:30 pm</option>
								<option value="14:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"14:00") ? "selected=selected" : "";?>>2:00 pm</option>
								<option value="14:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"14:30") ? "selected=selected" : "";?>>2:30 pm</option>
								<option value="15:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"15:00") ? "selected=selected" : "";?>>3:00 pm</option>
								<option value="15:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"15:30") ? "selected=selected" : "";?>>3:30 pm</option>
								<option value="16:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"16:00") ? "selected=selected" : "";?>>4:00 pm</option>
								<option value="16:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"16:30") ? "selected=selected" : "";?>>4:30 pm</option>
								<option value="17:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"17:00") ? "selected=selected" : "";?>>5:00 pm</option>
								<option value="17:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"17:30") ? "selected=selected" : "";?>>5:30 pm</option>
								<option value="18:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"18:00") ? "selected=selected" : "";?>>6:00 pm</option>
								<option value="18:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"18:30") ? "selected=selected" : "";?>>6:30 pm</option>
								<option value="19:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"19:00") ? "selected=selected" : "";?>>7:00 pm</option>
								<option value="19:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"19:30") ? "selected=selected" : "";?>>7:30 pm</option>
								<option value="20:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"20:00") ? "selected=selected" : "";?>>8:00 pm</option>
								<option value="20:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"20:30") ? "selected=selected" : "";?>>8:30 pm</option>
								<option value="21:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"21:00") ? "selected=selected" : "";?>>9:00 pm</option>
								<option value="21:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"21:30") ? "selected=selected" : "";?>>9:30 pm</option>
								<option value="22:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"22:00") ? "selected=selected" : "";?>>10:00 pm</option>
								<option value="22:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"22:30") ? "selected=selected" : "";?>>10:30 pm</option>
								<option value="23:00" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"23:00") ? "selected=selected" : "";?>>11:00 pm</option>
								<option value="23:30" <?php echo (@$sessionSearchData["fromTimeSelected"]==
								"23:30") ? "selected=selected" : "";?>>11:30 pm</option>
							</select>
						</span>
						<span class="slect1"> 
							<?php $arrVal = $this->lookup_model->getValue('82', $multi_lang);$to = $arrVal[$multi_lang];?>
							<label for="female" class="radio-btn"><?php echo $to; ?></label>
							<select name="toTime" id="toTime" class="raduisSelect">
								<option value="23:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"23:30") ? "selected=selected" : "";?>>11:30 pm</option>
								<option value="0:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"0:00") ? "selected=selected" : "";?>>12:00 am</option>
								<option value="0:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"0:30") ? "selected=selected" : "";?>>12:30 am</option>
								<option value="1:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"1:00") ? "selected=selected" : "";?>>1:00 am</option>
								<option value="1:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"1:30") ? "selected=selected" : "";?>>1:30 am</option>
								<option value="2:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"2:00") ? "selected=selected" : "";?>>2:00 am</option>
								<option value="2:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"2:30") ? "selected=selected" : "";?>>2:30 am</option>
								<option value="3:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"3:00") ? "selected=selected" : "";?>>3:00 am</option>
								<option value="3:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"3:30") ? "selected=selected" : "";?>>3:30 am</option>
								<option value="4:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"4:00") ? "selected=selected" : "";?>>4:00 am</option>
								<option value="4:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"4:30") ? "selected=selected" : "";?>>4:30 am</option> 
								<option value="5:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"5:00") ? "selected=selected" : "";?>>5:00 am</option>
								<option value="5:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"5:30") ? "selected=selected" : "";?>>5:30 am</option>
								<option value="6:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"6:00") ? "selected=selected" : "";?>>6:00 am</option>
								<option value="6:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"6:30") ? "selected=selected" : "";?>>6:30 am</option>
								<option value="7:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"7:00") ? "selected=selected" : "";?>>7:00 am</option>
								<option value="7:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"7:30") ? "selected=selected" : "";?>>7:30 am</option>
								<option value="8:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"8:00") ? "selected=selected" : "";?>>8:00 am</option>
								<option value="8:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"8:30") ? "selected=selected" : "";?>>8:30 am</option>
								<option value="9:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"9:00") ? "selected=selected" : "";?>>9:00 am</option>
								<option value="9:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"9:30") ? "selected=selected" : "";?>>9:30 am</option>
								<option value="10:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"10:00") ? "selected=selected" : "";?>>10:00 am</option>
								<option value="10:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"10:30") ? "selected=selected" : "";?>>10:30 am</option>
								<option value="11:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"11:00") ? "selected=selected" : "";?>>11:00 am</option>
								<option value="11:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"11:30") ? "selected=selected" : "";?>>11:30 am</option>
								<option value="12:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"12:00") ? "selected=selected" : "";?>>12:00 pm</option>
								<option value="12:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"12:30") ? "selected=selected" : "";?>>12:30 pm</option>
								<option value="13:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"13:00") ? "selected=selected" : "";?>>1:00 pm</option>
								<option value="13:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"13:30") ? "selected=selected" : "";?>>1:30 pm</option>
								<option value="14:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"14:00") ? "selected=selected" : "";?>>2:00 pm</option>
								<option value="14:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"14:30") ? "selected=selected" : "";?>>2:30 pm</option>
								<option value="15:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"15:00") ? "selected=selected" : "";?>>3:00 pm</option>
								<option value="15:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"15:30") ? "selected=selected" : "";?>>3:30 pm</option>
								<option value="16:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"16:00") ? "selected=selected" : "";?>>4:00 pm</option>
								<option value="16:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"16:30") ? "selected=selected" : "";?>>4:30 pm</option>
								<option value="17:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"17:00") ? "selected=selected" : "";?>>5:00 pm</option>
								<option value="17:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"17:30") ? "selected=selected" : "";?>>5:30 pm</option>
								<option value="18:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"18:00") ? "selected=selected" : "";?>>6:00 pm</option>
								<option value="18:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"18:30") ? "selected=selected" : "";?>>6:30 pm</option>
								<option value="19:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"19:00") ? "selected=selected" : "";?>>7:00 pm</option>
								<option value="19:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"19:30") ? "selected=selected" : "";?>>7:30 pm</option>
								<option value="20:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"20:00") ? "selected=selected" : "";?>>8:00 pm</option>
								<option value="20:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"20:30") ? "selected=selected" : "";?>>8:30 pm</option>
								<option value="21:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"21:00") ? "selected=selected" : "";?>>9:00 pm</option>
								<option value="21:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"21:30") ? "selected=selected" : "";?>>9:30 pm</option>
								<option value="22:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"22:00") ? "selected=selected" : "";?>>10:00 pm</option>
								<option value="22:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"22:30") ? "selected=selected" : "";?>>10:30 pm</option>
								<option value="23:00" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"23:00") ? "selected=selected" : "";?>>11:00 pm</option>
								<option value="23:30" <?php echo (@$sessionSearchData["toTimeSelected"]==
								"23:30") ? "selected=selected" : "";?>>11:30 pm</option>
							</select>
						</span>
					</div>
					<div class="rest-btn-div">
						<label>&nbsp;</label>
						<?php 
						$arrVal = $this->lookup_model->getValue('1249', $multi_lang);
						$lblReset = $arrVal[$multi_lang];?>
						<input type="reset" value="<?php echo $lblReset;?>" class="resetbtn" onclick="javascript:self.location='<?php echo base_url("search/fnReset");?>'" />
					</div>
				</div>
			</div>
		</div>
		</form>
		<?php 
		$arrVal   = $this->lookup_model->getValue('1250', $multi_lang);$lblHead = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('1251', $multi_lang);$lblSubHead = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('688', $multi_lang);$lblHelp = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('777', $multi_lang);$lblHistory = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('737', $multi_lang);$lblJoin = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('738', $multi_lang);$lblBook = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('888', $multi_lang);$lblOR = $arrVal[$multi_lang];
		$arrVal   = $this->lookup_model->getValue('778', $multi_lang);$lblCal = $arrVal[$multi_lang];
		?>
		<div class="session-icon">
			<div class="top-icon-row">
				<div class="quiery-txt"><?php echo $lblHead;?></div>
				<div class="sha-note">
					<?php echo $lblSubHead;?>
					<p><a href="javascript:void(0);" class="lnkHelp"><?php echo $lblHelp;?><span></span></a></p>
				</div>
				<div class="tutr-icon icon-hist">
					<h1><?php echo $ltalknow;?></h1>
					<div class="icn-lnk"><a href="#"><span><?php echo $lblHistory;?></span></a></div>
					<p><?php echo $lblJoin;?></p>
				</div>
				<div class="shd-opt"><?php echo $lblOR;?></div>
				<div class="tutr-icon icon-celn">
					<h1><?php echo $lSchedule;?></h1>
					<div class="icn-lnk"><a href="#"><span><?php echo $lblCal;?></span></a></div>
					<p><?php echo $lblBook;?></p>
				</div>
			</div>
		</div>
		<input type="button" id="deactivateMap" class="blu-btn" value="<?php echo $lDE_ACTIVATE_MAP;?>" style="cursor:pointer;margin-left: 632px;margin-top: -70px;position: absolute;width: 112px;display:none;">
		<?php 
		if(USER_CNT == "CN")
		{?>            
		<div class="search_rt_top" id="bingmap_canvas" style="position:relative; height:500px;"></div>
		<?php }	else {?>
		<div class="search_rt_top" id="map_canvas" style="height:500px;"></div>
		<?php }?>
		<div id="static_map_canvas" class="map-div"><img id="static_map_canvas_image" src="<?php echo base_url("images");?>/tutors/tutor_search_activate.png"></div>
	</div>
</div>          
<div class="search_mid new-searchpage">
	<div class="search_rt_mid martop">
		<div class="result_title"><?php echo $lresults." from ".$school_name;?></div>
		<div class="result_list result" id="tst1"></div>
		<div class="fr pt20"><div class="v_ajax_page" style="display:none;"><a class="first" href="#">&lt;&lt;</a><a class="prev" href="#">&lt;</a><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a class="next" href="#">&gt;</a><a class="last" href="#">&gt;&gt;</a></div></div>
	</div>
	<div class="search_rt_mid_noresult" style="padding-top: 35px;display:none;">
		<?php echo $nrecordfound; ?>
	</div>
</div>
<?php 
$roleIdn = $this->session->userdata('roleId');
if ($roleIdn == 0) {
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
} else {
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}
$createApBtnBlueDbLink = '<a class="btn_blue_big crapp" title="'.$lREQUEST_APPOINTMENT_TIP.'"  onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span">'.$lrequestappointment.'</span></a>';
$FreeSession = '<a class="btn_red_big_session crapp" onclick="crappclk(\'{createClassUrl($T.uid)}\');">'.$lFREE_SESSION.'</a>';

if($this->session->userdata('free_session') == 'y'  AND $roleIdn == 0):?>
<textarea id="resultListTemplate" style="display:none">
	<dt>
		<a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163"/></a>
		{#if  $T.fbshare !='0'}			
			
			<div class="fb-share-div">
				<a href="https://www.facebook.com/sharer/sharer.php?u={profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}&title={$T.firstName}{$T.lastName}&picture={profileImgResultThumb($T.pic)}&description={$T.professional}" target="_blank"><img src="<?php echo base_url("images/fbshare.png")?>" alt=""/></a>
				
            </div>
		{#/if}
		<p style="font-size:12pt;">Book me for: {$T.nativeLanguage}{#if  $T.otherLanguage != '' && $T.nativeLanguage != $T.otherLanguage},{#/if}
		{#if  $T.nativeLanguage != $T.otherLanguage}{$T.otherLanguage}{#/if}
		</p>
	</dt>
	<dd>
		<div class="dd_top">
			<div class="dd_lf">
				<h1 class="result-pop"><a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}">{$T.firstName} {$T.lastName}</a> {#if $T.professional !=''}{#/if}</h1>
				<h1 class="icon-gold">
					<font>
						<span class="mytool bronze">	{($T.roleId == 1) ? '<img src="<?php echo base_url('images/bronze.png')?>">' : ''}
						<span class="icon-tooltip2">
						<?php
							$arrVal = $this->lookup_model->getValue('1374', $multi_lang);
							echo $arrVal[$multi_lang]; // Native Speaker
						?>
						</span></span>
						<span class="mytool silver">	{($T.roleId == 2) ? '<img src="<?php echo base_url('images/silver.png')?>">' : ''}<span class="icon-tooltip2">
						<?php
							$arrVal = $this->lookup_model->getValue('1375', $multi_lang);
							echo $arrVal[$multi_lang]; // Trained tutor
						?>
						</span></span>
						<span class="mytool gold">	{($T.roleId == 3) ? '<img src="<?php echo base_url('images/gold.png')?>">' : ''}<span class="icon-tooltip2">
						<?php
							$arrVal = $this->lookup_model->getValue('1376', $multi_lang);
							echo $arrVal[$multi_lang]; // Professional certificate
						?>
						</span></span>
					</font>
				</h1>
				<div class="stars"><a onclick="getfeedback({$T.uid});"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></a></div>
				{($T.chkfreesession == "Yes") ? "<div class='sr-div-show'><span class='free-sesn-srch serch-pop'><a><?php echo $free_session; ?></a>
				<span class='classic free-sec-open'>
					<p><?php echo $thisOffer;?><br>(<?php echo $noCreditcard;?>)</p>
					<p><?php echo $chooseeither; ?><span class='sec-arrow'><img title='tooltip-arrow' src='<?php echo base_url('images/free-session-arrow.png')?>'></span></p>
					<div class='scd-img one'>
						<img title='tooltip-tutorSearch' src='<?php echo base_url('images/pop-img-cal.png')?>'>
						 <h2><?php echo $lSchedule;?></h2>
						 <h3>(<?php echo $FeatureAppoiment;?>)</h3>
					</div>
					<div class='scd-img'>
						<img title='tooltip-tutorSearch' src='<?php echo base_url('images/tlk-nw-icon-hv.png')?>'>
						 <h2><?php echo $ltalknow;?></h2>
						 <h3>(<?php echo $ifgreen; ?><br><?php echo $infiveminute;?>)</h3>
					</div>
				</span></span></div>" : ""}
				
				{#if $T.professional !=''}<span class="result-show"><p>{$T.professional}...</p></span>{#/if}
            <br><br>
			<!--<div class="login-ac">
            <div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/><font size="2px;">Logged In</font></div>
            </div>-->
			</div></div>
			
		
			<div class="rgt-box">
		<div class="select-bx-nw">
			{#if $T.hsrate>=0 || $T.school_id >0}
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
						<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

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
	</div>
		<div class="dd_bot only-btn" >
		
		<div class="serch-btn"><?php //echo "okl".$this->session->userdata['uid'];?>
		 {#if $T.uid !=<?php echo $this->session->userdata['uid'];?> }<?php //echo "123";?>
		<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>
		
			{#if $T.readytotalk == 1 }
			
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id},{$T.hRate})">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>
			{#else}
          		 
			 <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo  $talknotavail; ?></span></a>
			{#/if}
		    <?php }?>		 
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo  $talknotavail; ?></span></a>
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
		<!--<a class="btn_red_big bknow"  onclick="bookNow({$T.uid},'{$T.firstName}','{$T.hRate}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo "Book Now Free"; ?></a>---->
		<!---<a class="btn_red_big_session crapp" style="display:none;" href="{createClassUrl($T.uid)}">Free Session </a>	--->
		<?php else: ?>
		<!--<a class="btn_red_big bknow" style="display:none;"  onclick="bookNow({$T.uid},'{$T.firstName}','{$T.hRate}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo $lBOOK_NOW;?></a>-->
		<!--<span class="free-sesn">FREE SESSION</span>-->
		<?php //echo $FreeSession; ?>
		<?php endif; ?>
	   <?php //}?>
        </div>
			{#/if}
		
		
	</div>
	 	
</dd>

</textarea>
<textarea id="resultListFeatureTemplate" style="display:none">
 
<!--
<dt><a href="{profileUrl($T.uid)}/0/0"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
		<h1 class="result-pop"><a href="{profileUrl($T.uid)}/0/0" onMouseOver="show_result();">{$T.firstName} {$T.lastName}</a> {#if $T.personal[0].personal !=''} {#/if}</h1>
			<h1  class="icon-gold"><font>
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>" src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $lsilver; ?>">{($T.roleId == 2) ? '<img title="<?php echo $lsilver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>"  src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
			</font> </h1>
            
            <div class="stars"><a onclick="getfeedback({$T.uid});"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></a></div>
            
			 	{($T.chkfreesession == "Yes") ? "<div class='sr-div-show'><span class='free-sesn-srch serch-pop'><a><?php echo $free_session; ?></a> 
            <span class='classic free-sec-open'>
            	<p><?php echo $thisOffer;?><br>(<?php echo $noCreditcard;?>)</p>
                <p><?php echo $chooseeither; ?><span class='sec-arrow'><img title='tooltip-arrow' src='<?php echo base_url('images/free-session-arrow.png')?>'></span></p>
                <div class='scd-img one'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url('images/pop-img-cal.png')?>'>
                     <h2><?php echo $lSchedule;?></h2>
                     <h3>(<?php echo $FeatureAppoiment;?>)</h3>
                </div>
                <div class='scd-img'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url('images/pop-img-hst.png')?>'>
                     <h2><?php echo $ltalknow;?></h2>
                     <h3>(<?php echo $ifgreen; ?><br><?php echo $infiveminute;?>)</h3>
                </div>
            </span>
            </span></div>" : ""}
              
                {#if $T.personal[0].personal !=''}<span class="result-show"><p>{$T.personal[0].personal}</p></span>{#/if}
            <br><br>
            <div class="login-ac">
            <div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/><font size="2px;">Logged In</font></div>
            </div>
		
				{#if $T.hsrate>=0 || $T.school_id >0}
		
			
		<div class="select-bx-nw">
						
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
			<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
						<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
				
				{#/if}
			{#/if}	
			</div>
            

 
		
		  	
			
		
		</div>

	</div>
    <div class="rgt-box">
	
			<div class="dd_rt">
	 
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
	<div class="dd_bot only-btn" >
		
		<div class="serch-btn"><?php //echo "okl".$this->session->userdata['uid'];?>
          {#if $T.uid !=<?php echo $this->session->userdata['uid'];?> }<?php //echo "123";?>
		<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id},'{$T.hRate}')">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo  $talknotavail; ?></span></a>
			{#/if}
		    <?php }?>

			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo  $talknotavail; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
		  {#/if}
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
			<!--<a class="btn_red_big" style="display:none;"  onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id},'{$T.hRate}')" title="<?php echo $lBOOK_NOW;?>"><?php echo $lBOOK_NOW;?></a>-->
			<?php }else{ ?>
			<!----<a class="btn_gray_big"  onclick="addToapointment({$T.uid})" title="<?php echo $apointmentbutton; ?>"><?php echo $apointmentbutton; ?></a>----->
			<?php } ?>
		
        </div>
		
		 	
		
	</div>
	</div>
</dd>

</textarea>
<?php else:  ?>
 
<textarea id="resultListTemplate" style="display:none">
 
<dt><a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a> <!--<div class="login-ac">
			<div class="" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online" style="padding-right:5px;"/><font size="2px;">Logged In</font></div>
            </div>-->

			{#if  $T.fbshare !='0'}
			<div class="fb-share-div">
				<a href="https://www.facebook.com/sharer/sharer.php?u={profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}&title={$T.firstName}{$T.lastName}&picture={profileImgResultThumb($T.pic)}&description={$T.professional}" target="_blank"><img src="<?php echo base_url("images/fbshare.png")?>" alt=""/></a>
			</div>
            
			{#/if}
			<p style="font-size:12pt;">Book me for: {$T.nativeLanguage}{#if  $T.otherLanguage != '' && $T.nativeLanguage != $T.otherLanguage},{#/if}
			{#if  $T.nativeLanguage != $T.otherLanguage}{$T.otherLanguage}{#/if}</p>
			</dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1 class="result-pop"><a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}" >{$T.firstName} {$T.lastName}</a>{#if  $T.professional !=''}{#/if}</h1>
            
			<h1  class="icon-gold"><font>
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>" src="<?php echo base_url('images/bronze.png')?>">' : ''}<span class="icon-tooltip2">
			<?php
				$arrVal = $this->lookup_model->getValue('1374', $multi_lang);
				echo $arrVal[$multi_lang]; // Native Speaker
			?>
			</span></span>
		<span class="mytool silver" title="<?php echo $lsilver; ?>">	{($T.roleId == 2) ? '<img title="<?php echo $lsilver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}<span class="icon-tooltip2">
			<?php
				$arrVal = $this->lookup_model->getValue('1375', $multi_lang);
				echo $arrVal[$multi_lang]; // Trained tutor
			?>
			</span></span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>"  src="<?php echo base_url('images/gold.png')?>">' : ''}<span class="icon-tooltip2">
			<?php
				$arrVal = $this->lookup_model->getValue('1376', $multi_lang);
				echo $arrVal[$multi_lang]; // Professional certificate
			?>
			</span></span>
			</font></h1>
            
            
            <div class="stars"><a onclick="getfeedback({$T.uid});"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></a></div>
             <?php
		   if($this->session->userdata('roleId') >= 0 and $this->session->userdata('roleId') <= 3 ){
		   ?>
 {($T.chkfreesession == "Yes") ? "<div class='sr-div-show'><span class='free-sesn-srch serch-pop'><a><?php echo $free_session; ?></a> 
 
<span class='classic free-sec-open'>
            	<p><?php echo $thisOffer;?><br>(<?php echo $noCreditcard;?>)</p>
                <p><?php echo $chooseeither; ?><span class='sec-arrow'><img title='tooltip-arrow' src='<?php echo base_url('images/free-session-arrow.png')?>'></span></p>
                <div class='scd-img one'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url("images/pop-img-cal.png");?>'>
                      <h2><?php echo $lSchedule;?></h2>
                     <h3>(<?php echo $FeatureAppoiment;?>)</h3>
                </div>
                <div class='scd-img'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url("images/tlk-nw-icon-hv.png");?>'>
                     <h2><?php echo $ltalknow;?></h2>
                     <h3>(<?php echo $ifgreen; ?><br><?php echo $infiveminute;?>)</h3>
                </div>
                
            </span>
 
 </span></div>" : ""}
			<?php } ?>
            
            <br><br>
            <!--<div class="login-ac">
			<div class="" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online" style="padding-right:5px;"/><font size="2px;">Logged In</font></div>
            </div>-->
		
			{#if $T.hsrate>=0 || $T.school_id >0}
		
			</div></div>
            <div class="rgt-box">
		<div class="select-bx-nw">
				
				
				{#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id},{$T.tutor_markup[0].tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
			<span class="timg"><img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/></span>
				{#else}
				
					<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

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
	</div>
	<div class="dd_bot only-btn" >
		
		<div class="serch-btn"><?php //echo "okl".$this->session->userdata['uid'];?>
            
			{#if $T.uid !=<?php echo $this->session->userdata['uid'];?> }
				
				<?php //echo "123";?>
			 <?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}',{$T.school_id},'{$T.hRate}')">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $talknotavail; ?></span></a>
			{#/if}
		    <?php }?>

		
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo  $talknotavail; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
		  {#/if}
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
			<!--<a class="btn_red_big bknow"  onclick="bookNow({$T.uid},'{$T.firstName}','{$T.hRate}')" title="<?php //echo $lBOOK_NOW;?>"><?php //echo $lBOOK_NOW;?></a>-->
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
	</div>
</dd>
{#if $T.professional !=''}<span class="result-show"><p>{$T.professional}...</p></span>{#/if}

</textarea>
<textarea id="resultListFeatureTemplate" style="display:none">
<!--
<dt><a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}"><img src="{profileImgResultThumb($T.pic)}" width="163" height="163" /></a></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1 class="result-pop"><a href="{profileUrl($T.uid)}/{$T.school_id}/{$T.school_id}">{$T.firstName} {$T.lastName}</a> {#if $T.personal[0].personal !=''}{#/if}</h1>
			<h1  class="icon-gold"><font> 
		<span class="mytool bronze" title="<?php echo $lbronze; ?>">	{($T.roleId == 1) ? '<img title="<?php echo $lbronze; ?>"  src="<?php echo base_url('images/bronze.png')?>">' : ''}</span>
		<span class="mytool silver" title="<?php echo $lsilver;?>">	{($T.roleId == 2) ? '<img title="<?php echo $lsilver; ?>" src="<?php echo base_url('images/silver.png')?>">' : ''}</span>
		<span class="mytool gold" title="<?php echo $lgold; ?>">	{($T.roleId == 3) ? '<img title="<?php echo $lgold; ?>"   src="<?php echo base_url('images/gold.png')?>">' : ''}</span>
			</font> </h1>
            
          <div class="stars"><a onclick="getfeedback({$T.uid});"><span class="current_rating" style="width:{$T.avgRate*30}px" ></span><span class="one-star" ></span><span class="two-stars"></span><span class="three-stars" ></span><span class="four-stars" ></span><span class="five-stars" ></span></a></div>
            	
{($T.chkfreesession == "Yes") ? "<div class='sr-div-show'><span class='free-sesn-srch serch-pop'><a><?php echo $free_session; ?></a>
<span class='classic free-sec-open'>
				<p><?php echo $thisOffer;?><br>(<?php echo $noCreditcard;?>)</p>
                <p><?php echo $chooseeither; ?><span class='sec-arrow'><img title='tooltip-arrow' src='<?php echo base_url('images/free-session-arrow.png')?>'></span></p>
                <div class='scd-img one'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url("images/pop-img-cal.png")?>'>
                     <h2><?php echo $lSchedule;?></h2>
                     <h3>(<?php echo $FeatureAppoiment;?>)</h3>
                </div>
                <div class='scd-img'>
                	<img title='tooltip-tutorSearch' src='<?php echo base_url("images/pop-img-hst.png")?>'>
                     <h2><?php echo $ltalknow;?></h2>
                     <h3>(<?php echo $ifgreen; ?><br><?php echo $infiveminute;?>)</h3>
                </div></span></span></div>" : ""}
                	
                  {#if $T.personal[0].personal !=''}<span class="result-show"><p>{$T.personal[0].personal}</p></span>{#/if}
        <br><br>	
<div class="login-ac">
		<div class="" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online" style="padding-right:5px;"/><font size="2px;">Logged In</font></div>
		</div>
		{#if $T.hsrate>=0 || $T.school_id >0}
		
			
		<div style="position:relative; top:-67px; left:290px;width:273px" class="select-bx-nw">
						
                {#if $T.hsrate>=0 }
				<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.srate},{$T.hsrate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
<img class="sdis" style="float:left;padding-top:5px;" title="{$T.s_disc}" src="{profileImgResultThumb($T.pimage)}" width="50" height="50"/>
				{#else}
				
					<select style="margin:0px 0px 0px 329px;" class="raduisSelect" id="schoolId" onChange="check(this.value,{$T.uid},{$T.tutor_markup},{$T.hRate},{$T.school_id},{$T.tutor_markup});">
							<option value='{$T.school_id}'><?php echo $curriculum; ?></option>
							<option value="0" selected><?php echo $conversation; ?></option>

						</select>
				
				{#/if}
				
			</div>
            {#/if}

			
		
		</div>
		<div class="dd_rt">
		
      <!----{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch"><a>FREE SESSION</a></span>' : ''}{($T.chkfreesession == "Yes") ? '<span class="free-sesn-srch"><a><?php echo $free_session; ?></a></span>' : ''}--->
			<div class="search_mail">
				<!---<a class="search_mail-bnt" title="<?php //echo $lMESSAGE_THIS_TUTOR;?>" onclick="sendBeepBoxMessage({$T.uid})"><span class="search_mail_span" id="search_mail_span_{$T.uid}"><img src="<?php //echo Base_url('images/beepbox.png'); ?>" alt="01" /></span></a>--->
			</div>
			<!--<div class="login-ac"><div class="tonline" style="{($T.online == 1) ? 'display:block;' : 'display:none'}" ><img src="<?php echo Base_url('images/active-login.png'); ?>" alt="online" title="online"/>Logged In</div></div>-->
            <div class="srch-price">
			{#if $T.hsrate>=0}
		<span id='dy{$T.srate}{$T.uid}'>	{($T.hsrate > 0) ? $T.hsrate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#else}
			
			<span id='dy{$T.tutor_markup}{$T.uid}'>	{($T.hRate > 0) ? $T.hRate : '0.00'} <?php echo $lcredits; ?>/<?php echo $vsession; ?> </span>
			{#/if}	
            </div>
            </div>
	</div>
	<div class="dd_bot" style="width:540px;">
		
		<div class="serch-btn"><?php //echo "okl".$this->session->userdata['uid'];?>

				{#if $T.uid !=<?php echo $this->session->userdata['uid'];?> }<?php //echo "123";?>
			<?php if($this->session->userdata['roleId'] >=0 && $this->session->userdata['roleId'] <4) {?>	
			
			{#if $T.readytotalk == 1 }
			<a class="icon3 serch-pop" onclick="bookNow({$T.uid},'{$T.firstName}','{$T.school_id}','{$T.hRate}')">&nbsp;<span class="classic"><?php echo $ltalknow; ?></span></a>        
			{#else}
			  <a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $talknotavail; ?></span></a>
			{#/if}
		    <?php }?>
		  
			<?php if($this->session->userdata['roleId'] ==4 || $this->session->userdata['roleId'] ==5){?>
			<a class="icon3 serch-pop icon3-gray">&nbsp;<span class="classic"><?php echo $talknotavail; ?></span></a>
			<a class="icon2 serch-pop icon2-gray" id='{$T.uid}'>&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>	
			
			<?php }else{?>
            <!--<a class="icon2 serch-pop" href="{createClassUrl($T.uid)}">&nbsp;<span class="classic">Appointment</span></a>--->
            <a class="icon2 serch-pop" id='{$T.uid}' href="{createClassUrl($T.uid)}">&nbsp;<span class="classic"><?php echo $lSchedule;?></span></a>
			<a class="icon1 serch-pop"  onclick="sendBeepBoxMessage({$T.uid})">&nbsp;<span class="classic"><?php echo $lSend_message; ?></span></a>
		  <?php }?>
		  {#/if}
		  
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
			
			<!--<a class="btn_red_big" style="display:none;" onclick="bookNow({$T.uid},'{$T.firstName}','{$T.hRate}')" title="<?php echo $lBOOK_NOW;?>"><?php echo $lBOOK_NOW;?></a>-->
			<?php }else{ ?>
			<!---<a class="btn_gray_big" onclick="addToapointment({$T.uid})" title="<?php echo $apointmentbutton; ?>"><?php echo $apointmentbutton; ?></a>--->
			<?php } ?>
		
        </div>
		
			
		
	</div>
	
</dd>

-->
</textarea>
<?php endif; ?>

		<div id="dialog1" title="" style="display:None;">
			<div class="ratelist">
				<span class="title" style="float:left"><?php echo $confirmyourbooking;?> <input type='text' align="center" name='bookingamount' id='bookingamount' value='0' style="color: #3399cc; font-size: 20px; font-weight: normal; margin-bottom: 3px; width:60px; border:0px;" readonly	> <?php echo $CreditsTut;?></span>
			</div>
			
			<div class="ratelist">
				<br><p><span class="title" style="float:left; color:black;"><?php echo $tutorwillbesent;?></span>  </p>
				<br>
				<p><span class="title" style="float:left; color:black;"><?php echo $whentutorarrives;?></span>  </p>
				<p class="clearer"></p>
			</div>
		</div>
		
       <div id="firstTour" title="" style="display:None;">
			<div class="popup-step student-step1">
            	<div class="step-div-bg">
                	<span class="popup-no">1</span>
                	<div class="ratelist popup-row">
                        <span class="title" style="float:left"><?php echo $ChooseTutor;?></span>  
                    </div>
                    <div class="ratelist popup-row">
                        <p><span class="title" style="float:left;line-height:15px;"><?php echo $SetCriteria;?></span>  </p>
                    </div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li class="active"><span><a href="<?php echo base_url('search/search?step=1');?>">1</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/profile/uid/405?step=2');?>">2</a></span></li>-->
                            <li><span><a href="<?php echo base_url('user/profile/uid/12512?step=3');?>">2</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=4');?>">4</a></span></li>
                            <li><span><a href="<?php echo base_url('user/account?step=5');?>">5</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/changeInfo?step=6');?>">6</a></span></li>-->
                        </ul>
                    </div>
            		<a href="<?php echo base_url('user/profile/uid/12512?step=3');?>"><?php //echo $secondStep;?>Next</a>
                </div>
            </div>
            <!--<div class="student-hight-cnt1">&nbsp;</div>-->
		</div>
		<style>
  #sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}
 .ui-widget-content{/*border: 4px solid #0087d0;    border-radius: 0 !important;*/ background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}
</style>

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
	//$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
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
		
		return profileImgNull;
	}
	return profileImgPath+'/'+src;
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
		return false;
	});
	
	$('.sortKeys').change(function(){
	
		$('#search').trigger('click');
	});
	$("#today").val("");
	//$('#search').trigger('click');
	
	$('#keywords').on('focus', function (event) {
         if(event.which == '13'){
		 
		 
			$('#search').trigger('click');
         }
    });
	
	$('#keywords').on('keyup', function (event) {
         if(event.which == '13'){
		 
		 
			$('#search').trigger('click');
         }
    });
	$('#school').on('keyup', function (event) {
         if(event.which == '13'){	

         var a=$(".selected").find('.myuid').val();
		 document.getElementById("sch").value=a;

			$('#search').trigger('click');
         }
    });
})

function getSearch(data){	
	data['perPage'] 	= 20;
	window.searchData = data;
	$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
	var cookiepage = getCookieValue("page");
	if(cookiepage){
		data.page = cookiepage;
	}
	var sType = $('#free_session').val();
	$.ajax({
		url: "<?php echo base_url("search/doSearch");?>",
		type: 'GET',
		data: window.searchData,
		dataType: 'html',
		cache: false,
		success: function (msg){
			$.unblockUI();
			if (String == msg.constructor) {
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			var cookiepage = getCookieValue("page");
			if (cookiepage) {
				result.page = cookiepage;
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
			$('.result_list.result').empty();
			if (result.rows['result'].length > 0) {				
				$('.search_rt_mid_noresult').hide();
				$(".v_ajax_page").show();
			} else {
				$('.search_rt_mid_noresult').show();
			}
			$.each(result.rows['result'],function(k,v){
				var temp = $('<dl class="none"></dl>');
				temp.setTemplateElement('resultListTemplate');
				v['hRate'] = v['hRate'] * (1-(-window.configs['VEE_PRICE_PERCENT']['value']) );
				v['hRate'] = Math.round(parseInt(v['hRate'] *10000) /100)  /100;
				v['hRate'] = v['hRate'].toFixed(2);
				temp.processTemplate(v);
				temp.appendTo('.result_list.result').show();
			});
			
			// get attempts if search data is not found
			if (attempts < 3) {
				if (result.rows['result'].length == 0 || result.rows['result'].length == '') {
					attempts = attempts + 1;
					var _data = window.searchData;
					//getSearch(_data);
				} else {
					attempts = 0;
				}
			}
			
			//$('#dialog').attr('buttontype','done');
			//$( "#dialog:ui-dialog" ).dialog( "destroy" );
			data.page = 1;
			if (data.readytotalk == true) {
				$('.crapp').hide();
				$('.bknow').show();
			} else {
				$('.bknow').hide();
				$('.crapp').show();
			}
			getSearchMap(data);
			//getSearchMap(result.rows['result']);
		}
	}).done(function(data){
		// do something 
		FB.XFBML.parse();
	});
	return 'searchresulttrue'; 
}


// Get Map Data
function getSearchMap(data){
	data['perPage'] 	= 5000;
	window.searchData 	= data;
	$.ajax({
		url: "<?php echo base_url("search/doSearch");?>",
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
				//console.log(result);*/
				mapDataJson = result.rows['result'];
				//mapDataJsonFeature = result.rows['feature'];
				//alert(mapDataJson.length)
				//mapDataJson = result;
				//--R&D@Nov-29-2013 : call to intialize
				<?php
				if (USER_CNT == "CN") {?>
					getMap();
				<?php }else {?>
					initialize();
				<?php }?>
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
				
			}else{
				//alert('No Data');
				$("#map_canvas").css("text-align","center").css("background","#ebebeb").html("<span style='font-size:24px; font-weight:bold; color:#999999; position:relative; top:112px;'>Loading.. Please wait.</span>");
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
									
									infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
									if(provice == '')
									{
										infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
									}
									else{
									infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
									
									}
									infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/session</span></p>";
									
									
									infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
									
									infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile1</a></span></div>";
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
					var iconBase = 'https://thetalklist.com/images/';
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
							infoHtml += "<div style='width:350px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'><table width='100%'><tr><td>";
							
							infoHtml += "<a class='small-grey-btn' href='"+profileUrl(data.uid) + "' onclick='goProfile("+data.uid+")'><img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='115px'/></a></td>";
							

							infoHtml += "<td style='vertical-align:top; text-align:left;padding-left:10px;'>";
							if(provice == '')
										{
											infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
										}
										else{
										infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
										
										}
							
							infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'><a class='small-grey-btn' href='"+profileUrl(data.uid) + "' onclick='goProfile("+data.uid+")'>" + data.firstName+' '+data.lastName + "</a></p>";
							
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
							
							infoHtml += "</td></tr></table></div>";

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
									infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
								}else{
									infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
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
								infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile3</a></span></div>";
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
						infoHtml += "<div style='width:350px; height:135px !important; overflow-y:auto; position:relative; top:0px; left:0px;'><table width='100%'><tr><td>";
						infoHtml += "<a class='small-grey-btn' href='"+profileUrl(data.uid) + "' onclick='goProfile("+data.uid+")'><img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='115px'/></a></td>";
						infoHtml += "<td style='vertical-align:top; text-align:left;padding-left:10px;'>";
						if(provice == ''){
							infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
						}else{
							infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
						}
						infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'><a class='small-grey-btn' href='"+profileUrl(data.uid) + "' onclick='goProfile("+data.uid+")'>" + data.firstName+' '+data.lastName + "</a></p>";
						infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate;
						if(data.hRate == '0'){
							infoHtml += ".00";
						}
						if(data.hRate == '13.3' || data.hRate == '26.6'){
							infoHtml += "0";
						}
						infoHtml += " credits/session</span></p>";						
						infoHtml += "</td></tr></table></div>";
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
		alert('<?php echo $PleaseComplete;?>');
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
			            });
        });
function getuid(a)
{
//alert(a);
var uid=a;
document.getElementById("sch").value=a;
}
$( document ).ready(function() {

/*$("#search").click(function() {
        var fid = $('input[type="hidden"]', this).val();
        document.getElementById("myuid").value=fid;
    });*/
	
	

	$( '#map_canvas, #bingmap_canvas').hide();
	$( '#static_map_canvas').css('cursor', 'pointer');
	$( '#static_map_canvas' ).hover(function(){ $( '#static_map_canvas_image' ).attr("src", '<?php echo base_url("images");?>/tutors/tutor_search.png');});
	$( '#static_map_canvas' ).mouseout(function(){ $( '#static_map_canvas_image' ).attr("src", '<?php echo base_url("images");?>/tutors/tutor_search_activate.png');});
	$( '#static_map_canvas' ).click(function(){
	   
		$( '#static_map_canvas').hide();
		//$( '#deactivateMap').css('display', 'block');
		//$( '#deactivateMap').css('z-index', '1');
		//$( '#imgshow').css('display', 'none');
		//$( '#imghid').css('display', 'none');
		
		$( '#map_canvas, #bingmap_canvas').show();
		<?php 
			if(USER_CNT == "CN")
			{?>getMap();
				<?php }else {?>			
				initialize();
				<?php }?>
	});
	$( '#deactivateMap' ).click(function(){
	    $( '#imgshow').css('display', 'block');
		$( '#imghid').css('display', 'block');
		
		$( '#static_map_canvas').show();
		$( '#map_canvas, #bingmap_canvas').hide();
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
	/*#imghid
	{
	margin-top:-75px;
	}
	#imgshow
	{
	margin-top:-75px;
	}*/
	
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

.page_title h1{ font-size:3.6em; color:#3399cc;}
#schoolId{ display:none;}

.ui-widget-overlay{ min-height:2000px;}
	</style>
<?php $this->layout->appendFile('css',"css/auto.css");?>
<?php $this->layout->appendFile('javascript',"js/autosearch.js");?>
<script>
function check(a,uid,hrate,srate,schoolid,tmarkup)
{
	if(tmarkup == null) 
	{
	tmarkup=0;
	}
	var abx="dy"+hrate+uid;

	hrate=parseFloat(Math.round(hrate * 100) / 100).toFixed(2);
	srate=parseFloat(Math.round(srate * 100) / 100).toFixed(2);

	if(a == 0)
	{

	document.getElementById(abx).innerHTML = srate+" Credits/session" ;
	}
	else
	{
	//($resultTeacher[$v['uid']]['hRate']+$result[0]['tutor_markup'])*(1+33/100);

	/*srate=((parseFloat(srate) + parseFloat(tmarkup))*(1.33));

	srate=parseFloat(Math.round(srate * 100) / 100).toFixed(2);*/
	//alert(srate);
	//srate=(srate-(srate*33/100));
	//alert(srate);
	if(tmarkup !='null')
	{
		if(srate > 0)
		{
			srate=(srate/1.33);
			var rate=(parseFloat(srate) + parseFloat(tmarkup));
			var allrate=((parseFloat(srate) + parseFloat(tmarkup))*(0.33));
			srate=(allrate+rate);
			srate=parseFloat(Math.round(srate * 100) / 100).toFixed(2);
		}
		if(tmarkup == 0)
		{
			srate='0.00';
		}
	document.getElementById(abx).innerHTML = srate+" Credits/session"; 
	}
	else
	{
	document.getElementById(abx).innerHTML = srate+" Credits/session"; 
	}


	}
	document.getElementById(uid).href=createClassPath+'/'+uid+'/'+a+'/'+schoolid; 
}

function getfeedback(uid)
{
var lodUrl = '<?php echo base_url(); ?>user/getFeedback/uid/'+ uid;

	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
/*pattern ='sdata='+uid;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('user/getFeedback');?>',
					  data:pattern,
					  success:function(msg){
					  if (String == msg.constructor)
					{
						var result;
						
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					//$('#dynamic').empty();
					} 
				});*/
//document.getElementById(uid).innerHTML="newtext";
//document.getElementById('result-show').style.display = 'block';
}
	function closeFunc()
{
	$('#dialog1').dialog('destroy');
}
</script>	
<script type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<script type="text/javascript">
var map = null;
var pinInfoBox;  //the pop up info box
var infoboxLayer = new Microsoft.Maps.EntityCollection();
var pinLayer = new Microsoft.Maps.EntityCollection();
var bingmapkey = "Au1Jki4Iyi13HSjmTuMeV89xzr-Vf5gAwuqfAW2FG-iDwMpd3umKenQIN4FmJ4Tv";
$(document).ready(function(){	
	getMap();
});
function getMap()
{
	map = new Microsoft.Maps.Map(document.getElementById('bingmap_canvas'), {
			credentials: 'Au1Jki4Iyi13HSjmTuMeV89xzr-Vf5gAwuqfAW2FG-iDwMpd3umKenQIN4FmJ4Tv',
			enableClickableLogo: false,
			enableSearchLogo:false,
			showDashboard:false,
			showScalebar:false,
			center: new Microsoft.Maps.Location(38, -120), 
			zoom: 2,
			//mapTypeId:Microsoft.Maps.MapTypeId.road
	});
	if (mapDataJson.length)
	{
		if(mapDataJson.length == 1)
		{
			//pinOnSingleMap(mapDataJson[0], 1);
		}else{
			$.each(mapDataJson,function(k,v){
				pinOnBingMap(v, k);				
			});
			$.each(mapDataJsonFeature,function(k,v){
				pinOnBingMap(v, k);
			});
		}
	}
	else
	{
		$("#bingmap_canvas").css("text-align","center").css("background","#ebebeb").html("<span style='font-size:24px; font-weight:bold; color:#999999; position:relative; top:112px;'>No Tutors Found</span>");
	}
	
}
function displayInfobox(e) {
	pinInfobox.setOptions({title: e.target.Title, description: e.target.Description, visible:true, offset: new Microsoft.Maps.Point(0,25)});
	pinInfobox.setLocation(e.target.getLocation());
}

function hideInfobox(e) {
	pinInfobox.setOptions({ visible: false });
}
function attachPushpinClickEvent()
{
	var pushpin= new Microsoft.Maps.Pushpin(map.getCenter(), null); 	
	var pushpinClick= Microsoft.Maps.Events.addHandler(pushpin, 'click', displayEventInfo);  
	map.entities.push(pushpin); 
	alert('Click on newly added pushpin to raise event');
}

displayEventInfo = function (e) {
	var obj = e.target;
	var info = "Events info - " + e.eventName + "\n";
	info += "Target  : " + obj.toString();
	alert(info);
}

function pinOnBingMap(data, i)
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
				//var ab= new google.maps.LatLng(a,b);
				
				var udata = {};
				udata['user_id'] 	= data.uid;
				udata['lat'] 		= a;
				udata['long'] 		= b;
										
				/*$.ajax({
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
				});*/	
				
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
					infoHtml += "<div style='width:300px; height:135px !important; overflow:auto; position:relative; top:0px; left:0px;'>";
					infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
					if(provice == '')
					{
						infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
					}
					else{
						infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
					}
					infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/session</span></p>";
					infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
					infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile5</a></span></div>";
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
				}else{}
			}
		}
	});
}

function CallRestService(request) 
{
	var script = document.createElement("script");
	script.setAttribute("type", "text/javascript");
	script.setAttribute("src", request);
	document.body.appendChild(script);
} 
function GeocodeCallback1(result,data) {var center = map.getCenter();
				
	pinInfobox = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0, 0), { visible: false });
	infoboxLayer.push(pinInfobox);
	for (var i = 0 ; i < 10; i++){
		//add pushpins
		var latLon = new Microsoft.Maps.Location(Math.random()*180-90, Math.random()*360-180);
		var pin = new Microsoft.Maps.Pushpin(latLon);
		pin.Title = name;//usually title of the infobox
		pin.Description = "blahblahblah, "+ i; //information you want to display in the infobox
		pinLayer.push(pin); //add pushpin to pinLayer
		Microsoft.Maps.Events.addHandler(pin, 'click', displayInfobox);
	}
	map.entities.push(pinLayer);
	map.entities.push(infoboxLayer);
}
function GeocodeCallback(result,data) 
 {

	if (result &&
		   result.resourceSets &&
		   result.resourceSets.length > 0 &&
		   result.resourceSets[0].resources &&
		   result.resourceSets[0].resources.length > 0) 
	{
		
		
		var center = map.getCenter();
	   // Set the map view using the returned bounding box
	   var bbox = result.resourceSets[0].resources[0].bbox;
	   var viewBoundaries = Microsoft.Maps.LocationRect.fromLocations(new Microsoft.Maps.Location(bbox[0], bbox[1]), new Microsoft.Maps.Location(bbox[2], bbox[3]));
	   map.setView({ bounds: viewBoundaries});

		var a = result.resourceSets[0].resources[0].point.coordinates[0];
		var b = result.resourceSets[0].resources[0].point.coordinates[1];
		//var ab= new google.maps.LatLng(a,b);
		
		var udata = {};
		udata['user_id'] 	= data.uid;
		udata['lat'] 		= a;
		udata['long'] 		= b;
								
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
	   // Add a pushpin at the found location
	   var location = new Microsoft.Maps.Location(result.resourceSets[0].resources[0].point.coordinates[0], result.resourceSets[0].resources[0].point.coordinates[1]);
	   var pushpin = new Microsoft.Maps.Pushpin(location,{icon:"<?php echo base_url("images")."/marker.png";?>",draggable: false});
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
			infoHtml += "<div style='width:300px; height:135px !important; overflow:auto; position:relative; top:0px; left:0px;'>";
			infoHtml += "<img src='" + profileImgResultThumbMap(data.pic) + "' style='margin:4px;border:solid;border-color:gray;' width='50px'/>";
			if(provice == '')
			{
				infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + data.country + "</p>";
			}
			else{
				infoHtml += "	<p><span style='font-weight:bold; color:#b47700;'><?php echo $llocation.":"; ?> </span>" + city + "&nbsp;" + provice + "&nbsp;" + data.country + "</p>";
			}
			infoHtml += "	<p><span style='color:red; font-weight:bold;'>Rate: " + data.hRate + " credits/session</span></p>";
			infoHtml += "	<p style='font-size:14px; font-weight:bold; color:#0080af;'>" + data.firstName+' '+data.lastName + "</p>";
			infoHtml += "	<div style='position:absolute; right:8px; top:0px;'><span class='small-grey-btn-wraper'><a class='small-grey-btn' href='"+profileUrl(data.uid) + ">View Profile6</a></span></div>";
			infoHtml += "</div>";
			 // Create the infobox for the pushpin
			pinInfobox = new Microsoft.Maps.Infobox(location , 
				{ title: data.username, 
				 description:infoHtml,
				 visible: false});
			// Add handler for the pushpin click event.
			Microsoft.Maps.Events.addHandler(pushpin, 'click', displayInfobox);
			
			// Hide the infobox when the map is moved.
			Microsoft.Maps.Events.addHandler(map, 'viewchange', hideInfobox);
			// Add the pushpin and infobox to the map
			map.entities.push(pushpin);	
			map.entities.push(pinInfobox);	
		}else{}
	   
	}
 }	
</script> 
<div id="vidDialog" style="display:none;">
<video width="800" controls>
  <source src="<?php echo base_url("/video/The_ABCs_of_Booking_Finalz_v2.mp4");?>"  type="video/mp4">
Your browser does not support the video tag.
</video> 
</div> 
<style>
.autosug{
	left:51% !important;
	top:32% !important;
}
</style>
<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>