<?php
if ($this->uri->segment(1)=="br") {
	$multi_lang = 'pt';
} else {
	$multi_lang = 'en';
}
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
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

$arrVal = $this->lookup_model->getValue('740', $multi_lang); $send_message = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('731', $multi_lang); $schedule	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('741', $multi_lang); $talk	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('925', $multi_lang); $talknotavail 	= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('282', $multi_lang);  $lngRate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1256', $multi_lang); $lngfirstfree = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1255', $multi_lang); $lngWeHelp = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1257', $multi_lang); $lngMocInt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1258', $multi_lang); $lngPrgBenifit = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1259', $multi_lang); $lngBenifit1 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1260', $multi_lang); $lngBenifit2 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1261', $multi_lang); $lngBenifit3 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1262', $multi_lang); $lngVeeExp = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1263', $multi_lang); $lngInterviewers = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1264', $multi_lang); $lnghiw1 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1265', $multi_lang); $lnghiw2 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1266', $multi_lang); $lnghiw3 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1267', $multi_lang); $lnghiw31 = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1268', $multi_lang); $lngaround = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1269', $multi_lang); $lngbrowse = $arrVal[$multi_lang];
?>
<script src="<?php echo base_url('js/jQueryRotate.js');?>" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
 
  $('#text1').rotate(-19);
  $('#text2').rotate(15);
  $('#text3').rotate(-19);
});
</script>
<!--CSS END -->
<script src="<?php echo base_url('js/home/html5.js');?>"></script>
<!--HTML 6 VIDEO START -->
<script src="http://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="http://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.2/video.js"></script>
<script src="http://api.html5media.info/1.1.6/html5media.min.js"></script>
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
				$('#myfreegroup').css('background-color', '#D7BC4D'); 
				$('#chkPopup').css('background-color', '#D7BC4D'); 
				$('#textNext').text('<?php echo $InProgress;?>');
			}
			else
			{	
				 
				$("#myfreegroup").attr("href", "<?php echo base_url('multi?id='.$nextSession['gropsessionId']); ?>");
				$('#myfreegroup').css('background-color', '#D7BC4D'); 
				$('#chkPopup').css('background-color', '#D7BC4D'); 
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
$(".chk-tooltip").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span><?php echo $Previewour;?></span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});

$(".JoinSess").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span><?php echo $Previewour;?></span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});


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
  <div class="ratelist"> <span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo "Please check your email to confirm your registration and jump into our site.";?></span> </div>
  <br>
  <br>
  <br>
  <p>
    <input type="button" value="<?php echo $Ohk;?>" onclick="closeConfirm();" id="buttonOk" class="blu-btn"/>
  </p>
</div>
<!--HOMEPAGE BANNER START -->
<div class="interviewpg brazilpage main_banner">
    	<div class="wrapper">
            <div class="left-text">
                <h1><?php echo $lHELPING_U . " ".$lSPEAK_ENGLISH;?><br><?php echo $lLIKE_A_NATIVE;;?></h1>
                <h2><?php echo $through?></h2>
                <h2><?php echo $lngaround;?></h2>
				<?php if(!$login):?>
				<div class="signup-btn">	
					<a href="<?php echo Base_url("user/register");?>" class="register_btn" id="register_btn"><?php echo $supnow;?></a>
				</div>
				<?php endif;?>
                <div class="forfreescs"><?php echo $forfreesession;?></div>
            </div>
            <div class="right-video-cnt">
                <div class="right-photo-div">
                	<a href="<?php echo Base_url("search/search");?>"><img src="<?php echo Base_url("images/br-gride-img.jpg");?>" alt="" /></a>
					<!--<ul>
						<?php
						foreach($tutors as $tutor)
						{
							$src = base_url().'images/header.jpg';
							if($tutor["pic"] != ''): 
								$src = base_url().'uploads/images/thumb/'.$tutor["pic"];
							endif;
						?>
                    	<li><a href="<?php echo Base_url("search/search");?>"><img src="<?php echo $src;?>" width="66" height="66" alt="" /></a></li>
						<?php }?>
                    </ul>-->
                </div>
                <div class="brows-btn"><?php echo $lngbrowse;?></div>
            </div>
            
            <div class="how_it_works clearfix">
    			<h2><?php echo $lHOW_IT." ".$lWORKS;?></h2>
            	<div class="hw-lft">
                <div class="hiw_col">
                    <div class="search">
                        <a href="<?php echo Base_url("search/search");?>"><h3><?php echo $lsearch;?></h3></a>
                        <div class="hiw_txt"><p><?php echo $lchoose_tutor;?></p></div>
                    </div>
                </div>
                <div class="hiw_col">
                    <div class="schedule">
                        <a href="<?php echo Base_url("search/search");?>"><h3><?php echo $lschedule;?></h3></a>
                        <div class="hiw_txt"><p><?php echo $llook_tutor;?></p></div>
                    </div>
                </div>
                <div class="hiw_col hiw_col_last">
                    <div class="talk">
                        <a href="<?php echo base_url('testveesession/testVeeSession'); ?>"><h3><!--Talk--><?php echo $ltalk;?></h3></a>
                        <div class="hiw_txt"><p><?php echo $lcustom_video;?></p></div>
                    </div>
                </div>
            </div>
                <div class="hw-rgt">
                    <div class="hw-wrks"><?php echo $howitworks; ?> <br><?php echo $Videos;?></div>
                    <div class="video-js"><?php
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if((stripos($ua,'android') !== false) or (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))) { // && stripos($ua,'mobile') !== false) {?>
			<iframe width="100%" height="319" src="https://www.youtube.com/embed/YpJvvE1NPiA" frameborder="0" allowfullscreen></iframe>
		<?php }
		else 
		{?>
		<video style="cursor:pointer;" id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" width="538" height="319" controls preload="auto"  poster="<?php echo Base_url("images/main/rgt-video-img.jpg");?>" data-setup="{}">
			 <source src="http://www.thetalklist.com/vedio/how_it_works.ogg" type='video/ogg' />
			 
	  </video> 
	  <?php }?></div>
                </div>
    		</div>
        </div>
    </div>
<!--HOMEPAGE BANNER END -->
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
<div class="baseBox baseBoxBg clearfix">
<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
</div>
<style>
.regpopup2 {
    top:
	250px !important;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url('css/mockinterview/bjqs.css');?>">
<script src="<?php echo base_url('js/bjqs-1.3.min.js');?>"></script>
<script class="secret-source">
jQuery(document).ready(function($) {
  
  $('#banner-slide').bjqs({
	animtype      : 'slide',
	height        : 300,
	width         : 270,
	responsive    : true,
	//randomstart   : true
  });
  
});
</script>
<script>
function sendBeepBoxMessage(uid)
{ //alert(uid);
	if(uid == '')
	{
		alert('Login First!');
		return false;
	}
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}
</script>
<style>
  #sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}
</style>