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
$arrVal = $this->lookup_model->getValue('1310', $multi_lang);	$lngCreateAcct = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1404', $multi_lang);	$freevideos = $arrVal[$multi_lang];
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
<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>

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

$(document).ready(function() {
    $("html,body").scrollTop(0);
});

$(window).load(function() {
 
  $(window).scrollTop(0);
  $("html,body").scrollTop(0);
  
  
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
				$('#myfreegroup').css('background-color', '#ff7029'); 
				  $('#chkPopup').css('background-color', '#ff7029'); 
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
.bx-controls{
	display:none;
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

	/*
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
	*/
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/school_homepage.css');?>">
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
<!--HOMEPAGE BANNER START -->
<?php
switch ($visitorstatus) {
	case "registered":
			$homeImgSrc = base_url("images/returning_unregistered.jpg");
			$getValueOfRealPpl = "1385";
			$getValueOfConv = "1386";
			break;
	case "unregistered":
			if($multi_lang == 'es' || $multi_lang == 'pt'){
				$homeImgSrc = base_url("images/es_returning_homepage_unregistered.jpg");
			}else{
				$homeImgSrc = base_url("images/es_homepage_first_banner.jpg");
			}
			$getValueOfRealPpl = "1387";
			$getValueOfConv = "1384";
			break;
	case "firsttime":
	default:
			if($multi_lang == 'es' || $multi_lang == 'pt'){
				$homeImgSrc = base_url("images/es_homepage_first_banner.jpg");
			}else{
				$homeImgSrc = base_url("images/es_homepage_first_banner.jpg");
			}
			$getValueOfRealPpl = "1277";
			$getValueOfConv = "1383";
			break;
}

?>
<div class="banner_main index-banner" style="">
	
	<div class="container" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_1.jpg"); ?>" width="100%" style="opacity:0.7">
        <div class="banner_content_main" style="right:0;left:inherit;">
			<h1 style=" position: absolute; top: 70%; left: 15%; color:#fff; font-size:42px;">We leverage the power of your school community.</h1>	
			<a href="<?php echo base_url("/user/schoolsignup"); ?>"><button style="color:#fff; cursor:pointer; background-color:#ff6633; outline:0; position: absolute; top: 85%; left: 40%; padding: 12px 25px; border: none; border-radius: 5px; font-size: 18px;">Contact Us</button></a>
	   </div>
    </div>
	<div style="font-size:24px; padding:25px; padding-left:150px; padding-right:150px; line-height:35px; text-align:justify;">Want students to choose your school? It's simple. Encourage interactions with your school community. Our online 1 to 1 interactions promote social relationships through tutoring and mentoring using an easy-access collaborative economy platform.
	</div>
	<div class="container" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_2.jpg"); ?>" width="100%" style="opacity:0.7">
		<h1 style="position: absolute; top: 80%; left: 30%; color:#fff; font-size:42px;">We impact the Bottom line.</h1>
    </div>
	<div style="font-size:24px; padding:25px; padding-left:150px; padding-right:150px; line-height:35px; text-align:justify;">Our open education platform attracts, prepares, and retains students. For iternational students, we offer the change to practice English fluency or acculturation. For domestic students, our interactions offer an inside look into campus life from current students or professional advice from alumni.
	</div>
	<div class="container" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_3.jpg"); ?>" width="100%" style="opacity:0.7">
		<h1 style="position: absolute; top: 70%; left: 18%; color:#fff; font-size:42px;">We manage your group of tutor ambassadors.</h1>
		<a href="<?php echo base_url("/search/search"); ?>"><button style="color:#fff; cursor:pointer; background-color:#ff6633; outline:0;  position: absolute; top: 85%; left: 40%; padding: 12px 25px; border: none; border-radius: 5px; font-size: 18px;">Search Tutors</button></a>
   </div>
	<div style="font-size:24px; padding:25px; padding-left:150px; padding-right:150px; line-height:35px; text-align:justify;">You can recruit a variety of tutor ambassadors into your collaborative economy school group. They may be domestic students, international students, teachers, or alumni. From your school's perspective: no employees, no overhead, just easy access to your community.
	</div>
	<div class="container" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_4.jpg"); ?>" width="100%" style="opacity:0.7">
        <h1 style="position: absolute; top:70%; left: 17%; color:#fff; font-size:42px;">We designed an easy access live video system.</h1>
		<a href="<?php echo base_url("/testveesession/testVeeSession"); ?>"><button style="color:#fff; cursor:pointer; background-color:#ff6633; outline:0;  position: absolute; top: 85%; left: 40%; padding: 12px 25px; border: none; border-radius: 5px; font-size: 18px;">Test Video System</button></a>
	</div>
	<div style="font-size:24px; padding:25px; padding-left:150px; padding-right:150px; line-height:35px; text-align:justify;">Bring the most flexible learning environment to your school community. Think about it. Why choose a school where you've never spoken to an existing student? People would rather attend a school where they've had questions answered by peers and are eager meet their new friends.
	</div>
</div>