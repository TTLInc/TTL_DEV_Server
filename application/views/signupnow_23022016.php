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
$this->load->helper('cookie');
$arrVal 	= $this->lookup_model->getValue('234', $multi_lang);
$lspeak_english = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('239', $multi_lang);
$lfree_session = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('211', $multi_lang);
$lflexible_pricing = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('212', $multi_lang);
$lalways = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('213', $multi_lang);
$lhuge_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('214', $multi_lang);
$lthousand_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('215', $multi_lang);
$lregistration_now = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('216', $multi_lang);
$lrisk_free = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('217', $multi_lang);
$lplay_sample_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('218', $multi_lang);
$lplay_how_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('219', $multi_lang);
$lwe_welcome = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('220', $multi_lang);
$ltutors = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lsign_up = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('222', $multi_lang);
$lsearch = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('223', $multi_lang);
$lschedule = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('224', $multi_lang);
$ltalk = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('225', $multi_lang);
$lchoose_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('226', $multi_lang);
$llook_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('227', $multi_lang);
$lcustom_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('228', $multi_lang);
$lamerican_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('229', $multi_lang);
$lyou_get_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('230', $multi_lang);
$lno_contracts = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('231', $multi_lang);
$lyou_get_flexible = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('233', $multi_lang);
$lyou_get_customize = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('240', $multi_lang);
$li_am_student = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('241', $multi_lang);
$li_am_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);
$lhow_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('237', $multi_lang);
$lwhy = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('242', $multi_lang);
$lor = $arrVal[$multi_lang];
//---R&D@Oct-31-2013 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('660', $multi_lang);	$lTESTIMONIALS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('661', $multi_lang);	$lDETAILS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('662', $multi_lang);	$lREGISTER_FREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('663', $multi_lang);	$lSIGN_UP   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1131', $multi_lang);	$yourVirtual   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('745', $multi_lang);	$NextSession   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1167', $multi_lang);	$FreeGroup   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1100', $multi_lang);	$Videos   	= $arrVal[$multi_lang];


//---R&D@Oct-31-2013 : Set Language Variables

/** added 25 Nov 13 */



/*$$lHELPING_U = "Helping You";
$lBOOK_YOUR_FIRST_FREE = "Book your first FREE session with the tutor of your choice";
$lSPEAK_EN_LIKE_NATIVE = "Speak English Like a Native";
$lTHE_TALKLIST = "The TalkList?";

lHOW_IT = "How It";
$lWORKS = "Works";
$lCPASSWORD = "Confirm Password";
$lIAMA ="I am a...";*/

$arrVal 	= $this->lookup_model->getValue('538', $multi_lang);	$lWORKS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('539', $multi_lang);	$lHOW_IT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('542', $multi_lang);	$lHELPING_U   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('543', $multi_lang);	$lBOOK_YOUR_FIRST_FREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);	$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('545', $multi_lang);	$lTHE_TALKLIST   	= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];


$arrVal = $this->lookup_model->getValue('665', $multi_lang);$lSPEAK_ENGLISH =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('666', $multi_lang);$lLIKE_A_NATIVE = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('726', $multi_lang);$school = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('727', $multi_lang);$schoolname = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('816', $multi_lang);$affiliate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('823', $multi_lang);$affiliatename = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('928', $multi_lang);$supnow = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('929', $multi_lang);$forfreesession = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('930', $multi_lang);$nocard = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('228', $multi_lang);$americantutors = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('932', $multi_lang);$largeselection = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('47', $multi_lang);$prices = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('933', $multi_lang);$satartat= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('934', $multi_lang);$paygo= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('935', $multi_lang);$content= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('936', $multi_lang);$chosetopic= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('937', $multi_lang);$gurantred= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('938', $multi_lang);$everysession= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('931', $multi_lang);	$through   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('940', $multi_lang);	$findtutor   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('941', $multi_lang);	$bhrowswtutor   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('942', $multi_lang);	$howitworks  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('943', $multi_lang);	$cfacebook 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('944', $multi_lang);	$thebase 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('945', $multi_lang);	$thenewwav 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('995', $multi_lang);	$lselection 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1016', $multi_lang);	$selectuser   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);	$Cancels   	= $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('1179', $multi_lang);	$ClickTOSee   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1180', $multi_lang);	$SogoBenifited   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);	$HowItwork   	= $arrVal[$multi_lang];

/* jan scope  */
$arrVal 	= $this->lookup_model->getValue('1200', $multi_lang);	$TalkwithWorld   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1201', $multi_lang);	$Youcanhelp   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1202', $multi_lang);	$OnetoOne   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1203', $multi_lang);	$SetPrice   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1204', $multi_lang);	$SetSchedule  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1205', $multi_lang);	$PaidToPaypal  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1206', $multi_lang);	$PerfectParttime  	= $arrVal[$multi_lang];
/* end jan scope */

$arrVal 	= $this->lookup_model->getValue('1208', $multi_lang);	$Previewour  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1209', $multi_lang);	$MustBewithin  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1210', $multi_lang);	$InProgress  	= $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('1217', $multi_lang);	$sorrylate  	= $arrVal[$multi_lang];
/* milestone2 */
$arrVal 	= $this->lookup_model->getValue('283', $multi_lang);	$Ohk  	= $arrVal[$multi_lang];

/* end milestone2 */
$arrVal = $this->lookup_model->getValue('1232', $multi_lang);$member = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1231', $multi_lang);	$lIM_MEMBER  	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('756', $multi_lang);	$lblNone= $arrVal[$multi_lang];
/* new layout*/
$arrVal = $this->lookup_model->getValue('1276', $multi_lang);	$lngConversion= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1277', $multi_lang);	$lngRealPpl= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1278', $multi_lang);	$lngletstalk= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1279', $multi_lang);	$lngOnlinelang= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1280', $multi_lang);	$lngGuaranted= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1281', $multi_lang);	$lngSelectTut= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1282', $multi_lang);	$lngBookTut= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1283', $multi_lang);	$lngEnjoyVideo= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1284', $multi_lang);	$lngLearnMore= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1285', $multi_lang);	$lngOurDiverse= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1286', $multi_lang);	$lngPurchaseCredit= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1287', $multi_lang);	$lngLessExp= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1288', $multi_lang);	$lngPerGrnt= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1289', $multi_lang);	$lngUnqSys= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1237', $multi_lang);	$Million= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1238', $multi_lang);	$UserChina= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1239', $multi_lang);	$Largest= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1240', $multi_lang);	$Soc= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1241', $multi_lang);	$Wlarge= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1242', $multi_lang);	$Org = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1243', $multi_lang);	$Partner = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1290', $multi_lang);	$lngBus = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1291', $multi_lang);	$lngAca = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1292', $multi_lang);	$lngTech = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1293', $multi_lang);	$lngTravel = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1294', $multi_lang);	$lngPop = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1306', $multi_lang);	$lngConfirmSignup = $arrVal[$multi_lang];
?>

<?php /*?><script type="text/javascript">
jQuery(document).ready(function($) {
 
  $('#text1').rotate(-19);
  $('#text2').rotate(15);
  $('#text3').rotate(-19);
});
</script><?php */?>
<!--CSS END -->
<script src="<?php echo base_url('js/home/html5.js');?>"></script>
<!--HTML 6 VIDEO START -->
<script src="http://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="http://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.2/video.js"></script>

<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
<script>
$(window).load(function() {
 
	 var isnewone="<?php echo $this->session->userdata('RegLink');?>";
	 if(isnewone !='')
		{
 			
			 $('#confirmaccountDialog').dialog({
					modal:true,
					width:'300px'
			});
			<?php $this->session->set_userdata('RegLink','') ?> 
			$(".ui-dialog").addClass("regpopup2");
			window.scrollTo(0,0);
	 	}	

})
function closeConfirm()
{
	$('#confirmaccountDialog').dialog('close');
}
</script>
<SCRIPT>

var _setintvalNextSession = setInterval(ChecknextGroup,1000);
function ChecknextGroup()
{

<?php if($nextSession !='None') {?>
 	/*var foo = new Date;
	var unixtime = parseInt(foo.getTime() / 1000);
	var unixtime_to_date = new Date(unixtime*1000);*/
 
var _cid = <?php echo $nextSession['gropsessionId'];?>;
 

	$.ajax({
         url: "<?php echo base_url();?>user/CheckDiffrence/cid/"+_cid,
        type: "post",
        success: function(msg){
		if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			 
		if(json.success == "true" || json.success ==true)
		{
		 
			if(json.NoofParticipant > 20)
			{
			
				 $("#myfreegroup").attr("onclick", "openfullDialog();",false);
				$('#myfreegroup').css('background-color', '#ff7029'); 
				$('#chkPopup').css('background-color', '#ff7029'); 
				$('#textNext').text('<?php echo $InProgress;?>');
			}
			else
			{	
				 
				$("#myfreegroup").attr("href", "<?php echo base_url('multi?id='.$nextSession['gropsessionId']); ?>");
				$('#myfreegroup').css('background-color', '#ff7029'); 
				$('#chkPopup').css('background-color', '#ff7029'); 
				if(json.diff > 0)
				{	
					var nxt="<?php echo hrstosecond($nextSession['Time']); ?>"+"(Sign in Now)";
					$('#textNext').text(nxt);
				}
				else				
				{  
					 $('#textNext').text('<?php echo $InProgress;?>');
				}
				
			} 
		}
		
		else
		{
			 
			$("#myfreegroup").attr("href", "javascript:void(0)");
			$('#myfreegroup').css('background-color', '#3399cc'); 
			  $('#chkPopup').css('background-color', '#3399cc'); 
				var nxt="<?php if($nextSession=='None') echo $lblNone; else echo hiaOutTime($nextSession['Time']);?>"
				
				$('#textNext').text(nxt);			  
				
				
		}
		 }
	});

	
<?php }?>
}
function openfullDialog()
{
		  $('#fullDialog').dialog({
					modal:true,
					width:'300px'
				}); 
}
function closeFullpopup()
{
		$('#fullDialog').dialog('close');
}	
 
</SCRIPT>
<script>
/*$(document).ready(function() {
	$("span.NextGroup").hover(function () { 
				 $(this).append('<div class="tooltipusr"><p><?php echo 'Must be within 15 min of session to join session and see a live preview of learning environment.'; ?></p> </div>');
				 }, function () {
					$("div.tooltipusr").remove();
				});
				});*/
</script>
<style>
span.NextGroup {
	color: #FFFFFF;
	display: inline-block;
	padding: 0 10px;
	text-align: center;
	text-shadow: none;
	vertical-align: middle;
}
div.tooltipusr p {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	line-height:14px;
	font-weight:normal;
	color: White;
	padding:8px;
}
div.tooltipusr:before {
	border-color: transparent #037898 transparent transparent;
	border-left: 6px solid #037898;
	border-style: solid;
	border-width: 6px 0px 6px 6px;
	content: "";
	display: block;
	height: 0;
	width: 0;
	line-height: 0;
	position: absolute;
	top: 40%;
	right: -6px !important;
}
div.tooltip p {
	font-size:12px;
	line-height:14px;
	font-weight:normal;
	font-family:Arial, Helvetica, sans-serif;
}
.class_two {
	border:1px solid red;
	border-radius: 10px;
}
p.tooltip-chkPopup {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	line-height:14px;
	font-weight:normal;
	color: White;
	padding:8px;
	background:#3399cc;
	width:250px;
	border-radius:7px;
	margin:-40px 300px 0 -150px;
	float:left;
}
p.tooltip-chkPopup:before {
	border-color: transparent #3399cc transparent transparent;
	border-right: 6px solid #3399cc;
	border-style: solid;
	border-width: 6px 6px 6px 0px;
	content: "";
	display: block;
	height: 0;
	width: 0;
	line-height: 0;
	position: absolute;
	top: 40%;
	left: -6px !important;
}
p.tooltip-chkPopup span {
	margin: 10px;
	color: White;
	line-height:18px;
	font-size:13px;
	text-align:left;
}
.regpopup {
	top:500px !important
}
</style>
<script>
$(document).ready(function () {
/*$(".chk-tooltip").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span><?php echo $Previewour;?></span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});

$(".JoinSess").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span><?php echo $Previewour;?></span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});
*/

$(".chk-tooltip").click(function(){ 
    $(".ui-dialog").addClass("regpopup");
	window.scrollTo(0,200);
}); 

$(".JoinSess").click(function(){ 
    $(".ui-dialog").addClass("regpopup");
	window.scrollTo(0,200);
}); 

});
</script>
<script>
function chngname(s)
{
if(s == 'roleId_input_4' || s == 'roleId1_input_4')
{
$('#firstName').attr("placeholder","<?php echo $schoolname;?>");
$('#firstName1').attr("placeholder","<?php echo $schoolname;?>");
}
else if(s == 'roleId_input_5' || s == 'roleId1_input_5')
{

$('#firstName').attr("placeholder","<?php echo $affiliatename;?>");
$('#firstName1').attr("placeholder","<?php echo $affiliatename;?>");
}
else
{
$('#firstName1').attr("placeholder","<?php echo $lFIRSTNAME;?>"); 
$('#firstName').attr("placeholder","<?php echo $lFIRSTNAME;?>");
 
}

}

function validateFrm()
{

	if( $('#roleId').val() == '9')
	{
			document.getElementById('rselect1').className += ' class_two';	
			document.getElementById('rid').style.display = 'block';
			return false;
	}
	else
	{
		document.getElementById("rselect1").style.border="none";
		document.getElementById('rid').style.display = 'none';
	}
	if( $('#firstName').val() == '')
	{
		document.getElementById('redfname').className += ' class_two';	
		document.getElementById('fname').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("redfname").style.border="none";
		document.getElementById('fname').style.display = 'none';
	}
	if( $('#mail').val() == '')
	{
		document.getElementById('redmail').className += ' class_two';		
		document.getElementById('email_taken1').style.display = 'none';
		document.getElementById('vremail').style.display = 'none';
		document.getElementById('remail').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('remail').style.display = 'none';
	}
	var mail=($('#mail').val());
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(! re.test(mail))
    {
	document.getElementById('redmail').className += ' class_two';	
	document.getElementById('email_taken1').style.display = 'none';	
	 document.getElementById('vremail').style.display = 'block';
	return false;
	}
	else
	{
	$.ajax({
				  type:     "GET",
				  url: '<?php echo Base_url("user/ajax_checkjp");?>',
				  //data: { multiLang: multiLang},
				  data: {name: mail},
				  dataType: "jsonp",
				   jsonp: 'callback',
					jsonpCallback: 'chekEmailTaken',
				  success: function(msg){
					  if(msg.success==false || msg.success=='false')
					{
						document.getElementById('vremail').style.display = 'none';
						document.getElementById('redmail').className += ' class_two';	
						document.getElementById('vremail1').style.display = 'none';
						document.getElementById('email_taken1').style.display = 'block';
					}
					else
					{
							chekEmailTaken(msg);
					}	
				 }
				});
			 return  ;
	}
}

function chekEmailTaken(data){ 
  if(data.success == true || data.success=='true')
  { 
						document.getElementById("ered").style.border="none";
						$('#redmail').removeClass('class_two');
						 
						document.getElementById('vremail1').style.display = 'none';
						document.getElementById('email_taken1').style.display = 'none';
						passCheck1();
  }
  else
  { 
				document.getElementById('vremail').style.display = 'none';
				document.getElementById('redmail').className += ' class_two';	
				document.getElementById('vremail1').style.display = 'none';
				document.getElementById('email_taken1').style.display = 'block';
  }
}
function passCheck1()
{  
	if( $('#password').val() == '')
	{
		document.getElementById('rpass').className += ' class_two';	
		document.getElementById('pass').style.display = 'block';
		document.getElementById('passlong1').style.display = 'none';
		return false;
	}
	else
	{
		//document.getElementById("rpass").style.border="none";	
		document.getElementById('pass').style.display = 'none';
	}
	var k=$('#password').val().length;
	if(k < 6)
	{
		document.getElementById('rpass').className += ' class_two';
		document.getElementById('passlong1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("rpass").style.border="none";	
		document.getElementById('passlong1').style.display = 'none';
	} 
	if( $('#confirm_password').val() == '')
	{
		document.getElementById('rcpass').className += ' class_two';	
		document.getElementById('cpass12').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('cpass12').style.display = 'none';
	}
	var a=$('#password').val();
	var b=$('#confirm_password').val();
	
	if(a != b)
	{
		document.getElementById('rcpass').className += ' class_two';
		document.getElementById('cpass12d').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("rcpass").style.border="1px solid red";	
		document.getElementById('cpass12d').style.display = 'none';
	}
	$('#registerFormindx').submit();
}

 
 
</script>
<!-- added by haren for firm submit on key -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css');?>">
<script type="text/javascript">
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
			validateFrm();
             
        }
    });
	$('#chkPopup').click(function() { 
	 //window.scrollTo(0,50);
	  $('#isgroup').val("yes");
			 $('#gsessionDialog').dialog({
					modal:true,
					width:'300px'
			});
	});
	
}); 

function chktool()
{
	 $('#preventdialog').dialog({
					modal:true,
					width:'300px'
			});
}
function closePrevent()
{
	$('#preventdialog').dialog('close');
	
}
/*raxa text wrap*/
jQuery(document).ready(function($) {
  $('.cercal1').rotate(-24);
});
/*raxa text wrap*/
</script>

<div id="fullDialog" style="display:None;">
  <div class="ratelist">
    <?php
				if($AdvanceSession=='None')
				{
					$AdvanceSession='none';
				} 
				else 
				{ 
					$AdvanceSession=hiaOutTime($AdvanceSession['Time']); 
				};
			?>
    <span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $sorrylate .$AdvanceSession; ?></span> </div>
  <br>
  <br>
  <br>
  <p>
    <input type="button" value="Ok" onclick="closeFullpopup();" id="buttonOk" class="blu-btn"/>
  </p>
</div>
<div id="preventdialog" style="display:None;">
  <div class="ratelist"> <span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $MustBewithin;?></span> </div>
  <br>
  <br>
  <br>
  <p>
    <input type="button" value="<?php echo $Ohk;?>" onclick="closePrevent();" id="buttonOk" class="blu-btn"/>
  </p>
</div>
<div id="confirmaccountDialog" style="display:None;">
  <div class="ratelist"> <span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $lngConfirmSignup;?></span> </div>
  <br>
  <br>
  <br>
  <p>
    <input type="button" value="<?php echo $Ohk;?>" onclick="closeConfirm();" id="buttonOk" class="blu-btn"/>
  </p>
</div>
<!--HOMEPAGE BANNER START -->
<?php $current_uri1 = $this->uri->segment(2);?>
<!--SIGNUP FORM START -->
<div class="signup_form" id="signup_form" style="width:100%;">
  <?php if(!$login):?>
  <div class="sf_padding" style="width: 970px; margin: 0 auto;">
    <div class="sf_txt">
      <!--Sign Up-->
      <?php echo $lsign_up; ?>: </div>
    <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerFormindx">
      <div class="sf_select" id="rselect1"> <span class="select_box_holder sel_width_215">
        <select id="roleId" name="roleId" class="cu_dds">
          <option value="9"><?php echo $lIAMA;?></option>
          <!--<option value="0"><?php echo $student;?></option>
          <option value="1"><?php echo $tutor;?></option>-->
          <option value="0"><?php echo $member;?></option>
          <option value="4"><?php echo $school;?></option>
          <option value="5"><?php echo $affiliate;?></option>
        </select>
        </span> <span style="color:red;display:none;font-size:17px;margin-top:40px;" id="rid"><?php echo $selectuser; ?></span> <span id="roleId_required" style="color:#DFC964;font-size:17px;display:none;"><b><?php echo $selectuser; ?></b></span> </div>
      <div class="sf_input" id="redfname">
        <input id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
        <span style="color:red;display:none;font-size:17px;padding-top:10px;" id="fname"><?php echo $enterfname;?></span> <span id="firstName_required" style="color:#DFC964;font-size:15px;display:none;"><b><?php echo $enterfname;?></b></span> </div>
      <div class="sf_input" id="redmail">
        <input id="mail" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
        <span id="email_required" style="color:#DFC964;font-size:15px;font-size:15px;display:none;padding:1em"><b><?php echo $enteremail;?></b></span> <span id="email_invalid" style="color:#DFC964;display:none;padding:1em"><b><?php echo $entervalidemail;?></b></span> <span style="color:red;display:none;font-size:17px;margin-top:10px;" id="remail"><?php echo $enteremail;?></span> <span style="color:red;display:none;font-size:17px;margin-top:10px;" id="vremail"><?php echo $entervalidemail;?></span> <span id="email_taken1" style="color:red;display:none;font-size:17px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span> </div>
      <div class="sf_input sf_input_pass" id="rpass">
        <input type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
        <input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
        <span style="color:red;display:none;font-size:17px;margin-top:40px;" id="pass"><?php echo $enterpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:42px;" id="passlong1"><?php echo $sixmin;?></span> </div>
      <div class="sf_input sf_input_pass" id="rcpass">
        <input autocomplete="off" type="password" value=""  id="confirm_password" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password12"/>
        <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password12" style="display:none;">
        <span style="color:red;display:none;font-size:17px;margin-top:40px;" id="cpass12"><?php echo $confpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:33px;" id="cpass12d"><?php echo $passmissmatch;?></span> </div>
      <input name="signup" type="button" onclick="return validateFrm();" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
      <input type="hidden" name="regPage"   value="ppc">
      <input type="hidden" name="refid"   value="<?php echo $current_uri1 ;?>">
      <input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">
    </form>
    <a href="#" class="close_btn" id="close_btn"></a> </div>
  <?php endif;?>
</div>
<!--SIGNUP FORM END -->
<div class="banner_main">
	<div class="video_cover"></div>
	<video class="bgvideo" autoplay loop muted>
		<!--<source src="<?php echo base_url("video/front-page.m4v");?>" type="video/m4v">
		<source src="<?php echo base_url("video/front-page.webm");?>" type="video/webm">-->
		<source src="<?php echo base_url("video/front-vid.mp4");?>" type="video/mp4" />
	</video>
	<div class="container">
        <div class="banner_content_main">
        	<h1><?php echo $lngRealPpl;?></h1>
            <h2><?php echo $lngConversion;?></h2>
            <h3><?php echo $lngletstalk;?></h3>
            <div class="banner_search_right">
				<?php if(!$login):?>
					<input name="SUBMIT" value="<?php echo $supnow;?>" type="button" class="register_btn" id="register_btn" />
				<?php endif;?>
            </div>
        </div>
    </div>
</div>
<div class="banner-main-mobile">
	<!--<h1>Real people teaching real Language</h1>
    <h2>Language Conversations that Matter</h2>
    <h3>Let's Talk</h3>-->
	<h1></h1>
    <h2></h2>
    <h3></h3>
    <input type="button" id="register_btn1" class="register_btn" value="Sign Up Now" name="SUBMIT" onclick="javascript:self.location='<?php echo base_url()."user/signup";?>'">
</div>
<div class="online_blue_box">
	<h1><?php echo $lngOnlinelang;?><br> <?php echo $lngGuaranted;?></h1>
</div>
<div class="how_it_works_main">
	<h1><?php echo $HowItwork;?></h1>
    <div class="container cf">
    	<div class="how_it_works_left01">
        	<h2 class="cf">
				<a href="<?php echo base_url('search/search'); ?>">
					<span><img src="<?php echo base_url("images/number01.jpg");?>" alt="01"></span><?php echo $lsearch;?>
				</a>
			</h2>
        	<img src="<?php echo base_url("images/search01_img.png");?>" alt="<?php echo $lsearch;?>">
            <h3><?php echo $lngSelectTut;?></h3>
        </div>
      <div class="how_it_works_left02">
       	<h2 class="cf">
			<a href="<?php echo base_url('search/search'); ?>">
				<span><img src="<?php echo base_url("images/number02.jpg");?>" alt="01"></span><?php echo $lschedule;?>
			</a>
		</h2>
        <img src="<?php echo base_url("images/search02_img.png");?>" alt="<?php echo $lschedule;?>">
        <h3><?php echo $lngBookTut;?></h3>
      </div>
      <div class="how_it_works_left03">
       	<h2 class="cf">
			<a href="<?php echo base_url('testveesession/testVeeSession'); ?>">
				<span><img src="<?php echo base_url("images/number03.jpg");?>" alt="01"></span><?php echo $ltalk;?>
			</a>
		</h2>
        <img src="<?php echo base_url("images/search03_img.png");?>" alt="">
        <h3><?php echo $lngEnjoyVideo;?></h3>
      </div>
    </div>
</div>
<div class="video_main">
	<?php
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if((stripos($ua,'android') !== false) or (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))) { // && stripos($ua,'mobile') !== false) {?>
			<iframe width="100%" height="319" src="https://www.youtube.com/embed/YpJvvE1NPiA" frameborder="0" allowfullscreen></iframe>
		<?php }
		else 
		{?>
		<video style="cursor:pointer;background-color:#FFF;" id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" width="100%" height="319" controls preload="auto"  poster="<?php echo Base_url("images/main/rgt-video-img.jpg");?>" data-setup="{}">
			 <source src="<?php echo base_url("vedio/how_it_works.ogg");?>" type='video/ogg' />
	  </video> 
	  <?php }?>
</div>
<div class="learn_more_btn"><a href="<?php echo base_url('students/index'); ?>"><?php echo $lngLearnMore;?></a></div>
<div class="our_grey_box">
	<h2><?php echo $lngOurDiverse;?></h2>
    <h2><?php echo $lngPurchaseCredit;?></h2>
    <h2><?php echo $lngLessExp;?> <span><?php echo $lngPerGrnt;?></span></h2>
</div>

<div class="browse_tutors">
<div class="container cercal-text">
  <h1><a href="<?php echo base_url('search/search'); ?>"><?php echo $bhrowswtutor;?></a></h1>
    <ul>
    	<li class="text1"><a href="<?php echo base_url('search/search?langInput1=English&keywords=business&langInput2=0'); ?>"><h2 id="demo1"><?php echo $lngBus;?></h2><img src="<?php echo base_url("images/business_img.png");?>" alt="<?php echo $lngBus;?>"></a></li>
        <li><a href="<?php echo base_url('search/search?langInput1=English&keywords=professor&langInput2=0'); ?>"><h2 id="demo2"><?php echo $lngAca;?></h2><img src="<?php echo base_url("images/academics_img.png");?>" alt="<?php echo $lngAca;?>"/></a></li>
        <li><a href="<?php echo base_url('search/search?langInput1=English&keywords=technology&langInput2=0'); ?>"><h2 id="demo3"><?php echo $lngTech;?></h2><img src="<?php echo base_url("images/technology_img.png");?>" alt="<?php echo $lngTech;?>"></a></li>
        <li><a href="<?php echo base_url('search/search?langInput1=English&keywords=travel&langInput2=0'); ?>"><h2 id="demo4"><?php echo $lngTravel;?></h2><img src="<?php echo base_url("images/travel_img.png");?>" alt="<?php echo $lngTravel;?>"></a></li>
        <li><a href="<?php echo base_url('search/search?langInput1=English&keywords=culture&langInput2=0'); ?>"><h2 id="demo5"><?php echo $lngPop;?></h2><img src="<?php echo base_url("images/pop_culture_img.png");?>" alt="<?php echo $lngPop;?>"></a></li>
    </ul>
	<?php if(!$login):?>        
		<div class="signup_btn">
			<a href="javascript:void(0);<?php //echo Base_url("user/register");?>" class="register_btn" id="register_btn">
				<?php echo $lsign_up;?>
			</a>
		</div>
	<?php endif;?>
</div>
</div>
<div class="free_grsession_main">
	<h1><?php echo $lngUnqSys;?></h1>
	<?php if($SchoolInfo !=array() && $SchoolInfo['s_layout']==1) {?>
    <?php } else {?>
		<div class="free_grsession_container cf">
			<div class="free_grsession_left <?php if($nxt =='yes') { echo "JoinSess"; } else { echo "chk-tooltip"; }?>" >
			<?php if(!$login){?>				
					<a id="chkPopup"  style="cursor:pointer;"><?php echo $FreeGroup;?></a>
			<?php } else {?>
					<span class="NextGroup">
						<a <?php if($nxt =='yes') {?> <?php } else { ?> onclick="chktool();"<?php }?> id="myfreegroup" class='myfreegroup' <?php if($nextSession !='None') {?> <?php } ?>style="cursor:pointer;"><?php echo $FreeGroup;?></a>
					</span>
			<?php }?>
			</div>
			<div class="free_grsession_right">
				<?php echo $NextSession?>: <span id="textNext">
					<?php if($nextSession=='None') echo $lblNone; else echo hiaOutTime($nextSession['Time']);?>
				</span>
			</div>
    </div>
	<?php }?>
</div>

<div class="">
	<div class="partner_section_main cf">
    	<div class="partner_section_left01">
   	    <img src="<?php echo base_url('images/partner-logo1.png');?>" alt="80 million education">
        <p><?php echo $Million;?><br><?php echo $UserChina;?></p>
        </div>        
        <div class="partner_section_left02">
   	    <img src="<?php echo base_url('images/partner-logo2.png');?>" alt="Largest honor">
        <p><?php echo $Largest;?><br><?php echo $Soc;?></p>
        </div>        
        <div class="partner_section_left03">
   	    <img src="<?php echo base_url('images/partner-logo3.png');?>" alt="World's largest">
        <p><?php echo $Wlarge;?><br><?php echo $Org;?></p>
        </div>        
        <h2><?php echo $Partner;?></h2>
    </div>
</div>        	
<div class="">
	<div class="testimonials_main cf">
    	<div class="testimonail_content">
        	<ul class="bxslider">
				<?php foreach($testimonials as $testimonial) {?>
            	<li>
                	<p><?php echo @$testimonial['description'];?></p>
					<span> - <?php echo @$testimonial['author'];?></span>
                </li>
				<?php }?>
            </ul>
        </div>
        <h2><?php echo $lTESTIMONIALS;?></h2>
    </div>
</div>
<style>
.regpopup2 {
    top:
	250px !important;
	}
</style>

<script src="<?php echo base_url('js/home/plugins.js');?>"></script>
<script src="<?php echo base_url('js/home/circletype.js');?>"></script>
<script src="<?php echo base_url('js/jQueryRotate.js');?>" type="text/javascript"></script>
<script>
$(document).ready(function(){
	//$('#title').circleType({radius: 400, fluid: true});
	
	
	$('#demo1').circleType({fitText:true, radius:180});
	$('#demo1').rotate(-47);
	
	$('#demo2').circleType({fitText:true, radius:180});
	$('#demo2').rotate(-45);
	
	$('#demo3').circleType({fitText:true, radius:180});
	$('#demo3').rotate(-42);
	
	$('#demo4').circleType({fitText:true, radius:180});
	$('#demo4').rotate(-47);
	
	$('#demo5').circleType({fitText:true, radius:180});
	$('#demo5').rotate(-43);
	
	/*$('#demo2').circleType({radius: 384, dir:-1});
	$('#demo3').circleType();
	$('#demo4').circleType({fluid:true});
	$('#demo5').circleType({fitText:true, radius: 180, dir:1})*/
});
$(document).ready(function(){
  $('.bxslider').bxSlider();
  <?php if(!$login):?>
  $("#signup_form_floating").show();
  <?php endif;?>
});
</script>
