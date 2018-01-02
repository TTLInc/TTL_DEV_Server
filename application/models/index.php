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
				var nxt="<?php if($nextSession=='None') echo 'none'; else echo hiaOutTime($nextSession['Time']);?>"
				
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
 span.NextGroup
 {
	color: #FFFFFF;
    display: inline-block;
    
    padding: 0 10px;
    text-align: center;
    text-shadow: none;
    vertical-align: middle;
 }
	div.tooltipusr p{ 
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
	div.tooltip p{ font-size:12px; line-height:14px; font-weight:normal; font-family:Arial, Helvetica, sans-serif;}
	 
.class_two
{
	border:1px solid red;
	border-radius: 10px;
}



p.tooltip-chkPopup {font-size:12px; 
		font-family:Arial, Helvetica, sans-serif; 
		line-height:14px; 
		font-weight:normal; 
		color: White;
		padding:8px; background:#3399cc;  width:250px; border-radius:7px;  margin:-40px 300px 0 -150px; float:left;}
p.tooltip-chkPopup:before { border-color: transparent #3399cc transparent transparent;
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
	  left: -6px !important;}
p.tooltip-chkPopup span {margin: 10px;color: White;   line-height:18px; font-size:13px; text-align:left; }
.regpopup{top:500px !important}
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
				<span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $sorrylate .$AdvanceSession; ?></span>  
			</div>
			<br><br><br>
			<p><input type="button" value="Ok" onclick="closeFullpopup();" id="buttonOk" class="blu-btn"/>
			
			</p>
		</div>

<div id="preventdialog" style="display:None;">
			<div class="ratelist">
				<span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $MustBewithin;?></span>  
			</div>
			<br><br><br>
			<p><input type="button" value="<?php echo $Ohk;?>" onclick="closePrevent();" id="buttonOk" class="blu-btn"/>
			
			</p>
		</div>
		
		
		<div id="confirmaccountDialog" style="display:None;">
			<div class="ratelist">
				<span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo "Please check your email to confirm your registration and jump into our site.";?></span>  
			</div>
			<br><br><br>
			<p><input type="button" value="<?php echo $Ohk;?>" onclick="closeConfirm();" id="buttonOk" class="blu-btn"/>
			
			</p>
		</div>

		<!--HOMEPAGE BANNER START -->
    <div class="main_banner">
    	<div class="wrapper clearfix">
            <!--<span style="color:red;font-size:16px;"><?php //echo $this->session->userdata('RegLink');$this->session->set_userdata('RegLink','') ?></span>-->
            <div class="banner_left">
            	
				<!-- Haren code start -->
				<?php if($SchoolInfo !=array() && $SchoolInfo['s_layout']==1) {?>
				<div class="schoollayout">
				<h2><?php echo $TalkwithWorld ;?><br><span><?php echo $Youcanhelp;?></span></h2>
							 
							<ul class="bnr-ul">
								<li>- <?php echo $OnetoOne;?> </li>
								<li>- <?php echo $SetPrice;?></li>
								<li>- <?php echo $SetSchedule;?></li>
								<li>- <?php echo $PaidToPaypal;?></li>
								
							</ul>
						<h4><?php echo $PerfectParttime;?>	</h4>
						</div>
				<?php }else{?>
							<h2><?php echo $lHELPING_U . " ".$lSPEAK_ENGLISH;?><br><?php echo $lLIKE_A_NATIVE;;?><span><?php echo $through?></span></h2>
							<a href="<?php echo Base_url("students/index");?>">
							<ul class="bnr-ul">
								<li>-<?php echo $americantutors;?>- <span><?php echo $lselection; ?></span></li>
								<li>-<?php echo $prices; ?>- <span><?php echo $satartat; ?></span></li>
								<li>-<?php echo $largeselection;?>- <span><?php echo $paygo;?></span></li>
								<li>-<?php echo $content?>- <span><?php echo $chosetopic; ?></span></li>
								<li>-<?php echo $gurantred;?>- <span><?php echo $everysession;?></span></li>
							</ul>
							</a>
                <?php } ?>
				<!--  Haren code end -->
				
				
				<?php if(!$login):?>
				<a href="<?php echo Base_url("user/register");?>" class="register_btn" id="register_btn"><?php //echo $lREGISTER_FREE;?><?php echo $supnow;?></a>
                <?php endif;?>
				
				<?php if($SchoolInfo !=array() && $SchoolInfo['s_layout']==1) {?>
				<?php }  else {?>
				<div class="risk_free"><!--Risk-Free Satisfaction Guaranteed--><?php //echo $lrisk_free;?><?php echo $forfreesession; ?><span><?php echo $nocard;?></span></div>
               
				
				<?php if(!$login):?>
				<div class="or_fb clearfix">
                	<!--<span class="or"><?php echo $lor;?></span>-->
                	<?php  if($multi_lang != 'ch'){?>
                    <a href="javascript:void(0);" class="fb_connect"><?php echo $cfacebook ;?></a>
                    <?php } else { ?>
                    <?php include_once("weibo/index.php");
					 ?>
                    <?php } ?>
                </div>
				<?php endif;?>
				 <?php }?>
            </div>
            <div class="banner-right">
            	<div class="bnr-slider">
				
          				<ul class="bxslider">
						<?php 
				for($i=0;$i<count($banners);$i++){
				?>
            				<li>
                				<img src="<?php echo Base_url('uploads/images/thumb/'.$banners[$i]['source']);?>" alt="TheTalkList" title="TheTalkList">
                            </li>
                            
							<?php }?>
                        </ul> 
                </div>
				
				<?php if($SchoolInfo !=array() && $SchoolInfo['s_layout']==1) {?>
	<?php } else {?>
                <div class="gro-btn">
                	<p><span>
					<?php echo $NextSession?>:&nbsp;&nbsp;</span>
					<span id="textNext"> <?php if($nextSession=='None') echo 'none'; else echo hiaOutTime($nextSession['Time']);?></span>
					</p>
                  
					 <?php if(!$login){?>
				 
				  <div   <?php if($nxt =='yes') {?> class="JoinSess" <?php } else {?> class="chk-tooltip"<?php }?>>
					
	
				 <a id="chkPopup"  style="cursor:pointer;"><?php echo $FreeGroup;?></a>
                   </div>
				   <?php } else {  ?>
				    <div   <?php if($nxt =='yes') {?> class="JoinSess" <?php } else {?> class="chk-tooltip"<?php }?>>
				 <span class="NextGroup">  <a   <?php if($nxt =='yes') {?> <?php } else { ?>  onclick="chktool();"<?php }?>id="myfreegroup"   class='myfreegroup' <?php if($nextSession !='None') {?> <?php } ?>style="cursor:pointer;"><?php echo $FreeGroup;?></a></span>
				 </div>
				   <?php }?>
                </div>
	<?php }?>
				
                <!--<div class="banr-pro1"> <a href="<?php echo Base_url('search/search');?>"><span class="brw-tutr"><?php echo $bhrowswtutor;?></span></a></div>-->
                <div class="banr-pro2"> <span class="brw-tutr"><?php echo $bhrowswtutor;?></span></div>
                <!--<div class="banr-pro2"><span class="fn-tutr" id="text3"><?php echo $findtutor;?></span> <span class="brw-tutr"><?php echo $bhrowswtutor;?></span><img src="<?php echo Base_url("images/main/banner-pro2.png");?>" alt="TheTalkList" title="TheTalkList" /></div>-->
            </div>
        </div>
    </div>
    <!--HOMEPAGE BANNER END -->
    <?php $current_uri1 = $this->uri->segment(2);?>
	<!--SIGNUP FORM START -->
    <div class="signup_form" id="signup_form" style="width:100%;">
		<?php if(!$login):?>
    	<div class="sf_padding" style="width: 970px; margin: 0 auto;">
    		<div class="sf_txt"><!--Sign Up--><?php echo $lsign_up; ?>:  </div>
            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerFormindx">
            	<div class="sf_select" id="rselect1">
<span class="select_box_holder sel_width_215">
	                    <select id="roleId" name="roleId" class="cu_dds">
	                        <option value="9"><?php echo $lIAMA;?></option> 
	                        <!--<option value="0"><?php echo $student;?></option>
                              <option value="1"><?php echo $tutor;?></option>-->
                              <option value="1"><?php echo $member;?></option>
							<option value="4"><?php echo $school;?></option>
							<option value="5"><?php echo $affiliate;?></option>
	                    </select>
	                </span>
					<span style="color:red;display:none;font-size:17px;margin-top:40px;" id="rid"><?php echo $selectuser; ?></span>
					<span id="roleId_required" style="color:#DFC964;font-size:17px;display:none;"><b><?php echo $selectuser; ?></b></span>					
				</div>
	            <div class="sf_input" id="redfname">
	            	 
	            	<input id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
					<span style="color:red;display:none;font-size:17px;padding-top:10px;" id="fname"><?php echo $enterfname;?></span>
					<span id="firstName_required" style="color:#DFC964;font-size:15px;display:none;"><b><?php echo $enterfname;?></b></span>
				</div>
	            <div class="sf_input" id="redmail">
	            	 
	            	<input id="mail" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:#DFC964;font-size:15px;font-size:15px;display:none;padding:1em"><b><?php echo $enteremail;?></b></span>
            		<span id="email_invalid" style="color:#DFC964;display:none;padding:1em"><b><?php echo $entervalidemail;?></b></span>
					<span style="color:red;display:none;font-size:17px;margin-top:10px;" id="remail"><?php echo $enteremail;?></span>
					<span style="color:red;display:none;font-size:17px;margin-top:10px;" id="vremail"><?php echo $entervalidemail;?></span>
					<span id="email_taken1" style="color:red;display:none;font-size:17px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span>
				</div>
	            <div class="sf_input sf_input_pass" id="rpass">
                  	<input type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
	            	 
	                <input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
					<span style="color:red;display:none;font-size:17px;margin-top:40px;" id="pass"><?php echo $enterpass;?></span>
					<span style="color:red;display:none;font-size:17px;margin-top:42px;" id="passlong1"><?php echo $sixmin;?></span>
				</div>
	            <div class="sf_input sf_input_pass" id="rcpass">
	            	<input autocomplete="off" type="password" value=""  id="confirm_password" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password12"/>
	            	 
	                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password12" style="display:none;">
					<span style="color:red;display:none;font-size:17px;margin-top:40px;" id="cpass12"><?php echo $confpass;?></span>
					<span style="color:red;display:none;font-size:17px;margin-top:33px;" id="cpass12d"><?php echo $passmissmatch;?></span>
			   </div>
	            
	            <input name="signup" type="button" onclick="return validateFrm();" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
				<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="refid"   value="<?php echo $current_uri1 ;?>">
				<input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">
			</form>
			 <a href="#" class="close_btn" id="close_btn"></a>
        </div>
		<?php endif;?>
    </div>
    <!--SIGNUP FORM END -->
    
	<!--CONTENT START -->
    <div class="wrapper">
	
		<div class="how_it_works clearfix">
    		<!--How it Works--><?php //echo $lhow_it_works;?>
            <h2><!--How It--><?php echo $HowItwork;?> <?php /*?><span class="hw-fnt">- (<?php echo $thebase ?>)</span><?php */?></h2>
            <div class="hw-lft">
                <div class="hiw_col">
                    <div class="search">
                        <a href="<?php echo base_url('search/search'); ?>"><h3><!--Search--><?php echo $lsearch;?></h3></a>
                        <div class="hiw_txt"><p><!--Choose the tutor of your choice, from a huge selection of American English Tutors--><?php echo $lchoose_tutor;?></p></div>
                    </div>
                </div>
                <div class="hiw_col">
                    <div class="schedule">
                        <a href="<?php echo base_url('search/search'); ?>"><h3><!--Schedule--><?php echo $lschedule;?></h3></a>
                        <div class="hiw_txt"><p><!--Look at any tutor's available calendar to book a session--><?php echo $llook_tutor;?></p></div>
                    </div>
                </div>
                <div class="hiw_col hiw_col_last">
                    <div class="talk">
                        <a href="<?php echo base_url('testveesession/testVeeSession'); ?>"><h3><!--Talk--><?php echo $ltalk;?></h3></a>
                        <div class="hiw_txt"><p><!--Use our custom Video Platform to speak online in a safe private setting--><?php echo $lcustom_video;?></p></div>
                    </div>
                </div>
            </div>
            <div class="hw-rgt">
            	<!--<h3>See How it Works</h3>-->
            	<!--<img src="<?php echo Base_url("images/main/rgt-video-img.jpg");?>" alt="TheTalkList" title="TheTalkList" >-->
                <div class="hw-wrks"> <?php echo $howitworks; ?> <br/><?php echo $Videos;?></div>
			 
				<?php
				$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
				if((stripos($ua,'android') !== false) or (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))) { // && stripos($ua,'mobile') !== false) {?>
					<iframe width="100%" height="319" src="https://www.youtube.com/embed/YpJvvE1NPiA" frameborder="0" allowfullscreen></iframe>
				<?php }
				else 
				{?>
				<video style="cursor:pointer;" id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" width="538" height="319" controls preload="auto"  poster="<?php echo Base_url("images/main/rgt-video-img.jpg");?>" data-setup="{}">
                     <source src="http://www.thetalklist.com/vedio/how_it_works.ogg" type='video/ogg' />
                     
			  </video> 
              <?php }?>
                <?php /*?><span><?php if(!$login):?>
				<a href="javascript:void(0)" class="register_btn2" ><?php //echo $lREGISTER_FREE;?><?php echo $lsign_up; ?> >></a>
                <?php endif;?></span><?php */?>
                
                <div class="hw-do-benefit">
                <h2><?php echo $ClickTOSee;?><br><?php echo $SogoBenifited;?> &nbsp;&nbsp;</h2>
                <div class="ben-img">
				<a style="cursor:pointer" target="_blank" href="http://www.arcgis.com/apps/MapTour/index.html?appid=0c97c66c2a854b668a9c9fbcfefb8cbb"> <img src="<?php echo base_url('images/vprogram.png');?>"></a> <!--<span><?php echo $yourVirtual;?></span>-->
                </div>
                        <a href="<?php echo Base_url("user/register");?>" class="register_btn" id="register_btn">
      <?php //echo $lREGISTER_FREE;?>
      <?php echo $supnow;?></a>
                </div>
			</div>
    	</div>
		
      <!-- <iframe width="720" height="600" frameborder="0" src="http://www.arcgis.com/apps/MapTour/index.html?appid=0c97c66c2a854b668a9c9fbcfefb8cbb" >  </iframe>-->
      
<?php if($SchoolInfo !=array() && $SchoolInfo['s_layout']==1) {?>
	<?php } else {?>
	  <div class="testimonials">
        	<div id="testimonials" >
            	<div class="bxslider">
        		<?php if(sizeof($arr_quotes) > 1){
		    		for($i=0;$i<sizeof($arr_quotes);$i++){
				 		$quotes  = stripslashes($arr_quotes[$i]['quote']);
			 			$quoteby = stripslashes($arr_quotes[$i]['quotedby']);?>
                  
			 	<div>
                    <p><?php echo $quotes;?></p>
                    <span>- <?php echo $quoteby;?></span>
                </div>
			 	<?php
		    		}	
        		}?>
                </div>
            </div>
            <div class="testimnl"><?php echo $lTESTIMONIALS;?></div>
        </div>
	
        <div class="why_talklist_vid clearfix">
        	<div class="why_talklist">
            	<h3><!--WhyThe TalkList--><?php echo $lwhy;?> <span><!--The TalkList?--><?php echo $lTHE_TALKLIST;?></span> <span><?php if(!$login):?>
				<!--<a href="javascript:void(0)" class="register_btn2"><?php //echo $lREGISTER_FREE;?><?php echo $lsign_up; ?> >></a>-->
                <?php endif;?></span></h3>
                
                <div class="why_talklist_row american_tutors clearfix">
                	<h4><!--American Tutors--><?php echo $lamerican_tutor;?></h4>
                    <p><!--You get a tutor from around the USA or around the world that's been tested in our instructional learning method.--><?php echo $lyou_get_tutor;?></p>
                </div>
                
                <div class="why_talklist_row no_contract clearfix">
                	<h4><!--No Contracts--><?php echo $lno_contracts;?></h4>
                    <p><!--You get flexible scheduling and flexible payment with no contracts--><?php echo $lyou_get_flexible;?></p>
                </div>
                
                <div class="why_talklist_row your_topic clearfix">
                	<h4><!--Your Topic--><?php echo $lyour_topic;?></h4>
                    <p><!--You get to customize each conversation tutorial around your interest : test, school, work, or travel--><?php echo $lyou_get_customize;?></p>
                </div>
            </div>
            
            <div class="talklist_vid">
			
            	<div class="vid_box">
                   <!-- <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="473" height="279" poster="<?php echo Base_url("images/main/video_cover.jpg");?>" data-setup='{}'>
                    <?php
					if($multi_lang == 'en'){
						$vFile = Base_Url('video/howItWorks.mp4');
					}elseif($multi_lang == 'kr'){
						$vFile = Base_Url('vedio/howItWorks-kr.mp4');
					}elseif($multi_lang == 'jp'){
						$vFile = Base_Url('vedio/howItWorks-jp.mp4');
					}elseif($multi_lang == 'ch'){
						$vFile = Base_Url('vedio/howItWorks-cn.mp4');
					}else{
						$vFile = Base_Url('video/howItWorks.mp4');
					}
					?>					
						 <source src="<?php echo $vFile;?>" type='video/mp4' />
                    </video>
                     
                     <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="465" height="264"
      poster="http://www.thetalklist.com/how.jpg" data-setup="{}">
						<source src="http://www.thetalklist.com/vedio/how_it_works.ogg" type='video/ogg' />
						<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track>
						<track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track>
  </video>-->	<!--<h3><?php echo $thenewwav;?></h3>-->
  					<div class="brws-btn2"><a href="<?php echo base_url('search/search')?>"><?php echo $bhrowswtutor;?></a></div>
  					<img src="<?php echo Base_url("images/main/we-welcome.png");?>" alt="TheTalkList" title="TheTalkList" >
					
                </div>
                <div class="welcome_tutors clearfix">
                	<span style="text-align:center;margin-left:150px;"> <?php echo $lwe_welcome;?></span>
				  <!--<span><?php if(!$login):?>		
				  <a href="javascript:void(0)" class="register_btn2"><?php //echo $lREGISTER_FREE;?><?php echo $lsign_up; ?> >></a>
				  <?php endif?>
                  </span>-->
				   <!--<a href="<?php echo Base_Url('tutor/index#overview');?>" ><?php echo $lDETAILS;?></a>-->
                   
                </div>
            </div>
        </div>
        <?php }?>
    </div>
	
	
	
    <!--CONTENT END -->


<?php /*?>
<div class="home_main">
    <div class="top_main">
      <div class="main_wrap">
        <div class="ragistration_sec">
          <div class="left_panel">
            <div class="network_top">
              <h3><!--Speak English like a native--><?php echo $lspeak_english;?><br />
	      <!--with your first FREE session--> <?php //echo $lfree_session ;?></h3>
              <ul>
                <li><!--Flexible Pricing--><?php echo $lflexible_pricing;?></li>
                <li><!--Always 1:1 tutoring--><?php echo $lalways;?></li>
                <li><!--Huge selection of American tutors--><?php echo $lhuge_selection;?></li>
                <li><!--Thousands of students around the world--><?php echo $lthousand_selection;?></li>
              </ul>
            </div>
	    <form action="<?php echo Base_url('user/register');?>" method="post" id="registerForm">
            <div class="social_registration">
              <div class="left_filed">
              	<h4><!--Register now for a FREE tutoring session--><?php echo trim($lregistration_now);?></h4>
                <p>
                  <input type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" />
		  <select class="select_frm roleId" name="roleId">
			<option value="0"><?php echo $lIM_STUDENT;?><?php //echo $li_am_student;?></option>
			<option value="1"><?php echo $lIM_TUTOR;?><?php //echo $li_am_tutor;?></option>
		  </select>
                </p>
                <p>
                  <input type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" />
                  <input type="password" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" />
                </p>
                <div class="btn_sec">
		<div class="registration_div">
			<p><span class="homett"><!--Risk-Free Satisfaction Guaranteed--><?php echo $lrisk_free;?></span></p>
			<p>
				<a class="main_button main_button3" id="registerButton" href="javascript:void(0)"><!--Sign Up--><?php echo $lsign_up;?></a>
			</p>
		</div>
		<span style="margin-top:25px;margin-left:-25px;"><!--OR--><?php echo $lor;?>
		</span>
<?php  if($multi_lang != 'en'){?>
<div class="fb_login_div">
	<p><img src="<?php echo Base_url("images/fb_icon.png");?>" width="161" height="38" alt="fb-icon" class="btn_facebook" /></p>
</div>	
<?php } else { ?>
<div class="fb_login_div" style="margin-top:26px;margin-left:18px;">
<?php include_once(Base_url("weibo/index.php")); ?>
</div>	
<?php } ?>	
              </div>
              </div>
              
            </div>
	    </form>
          </div>
	  <div class="right_panel">
            <div class="video_sec">
			
	      <h4><a href="javascript:void();" class="showVideo" id="showVideo2"><!--Play How it Works--><?php echo $lplay_how_it_works;?></a></h4>		
              <h4><a href="javascript:void();" class="showVideo" id="showVideo1"><!--Play Sample Tutorial--><?php echo $lplay_sample_video;?></a></h4>
              <div class="video_div">
                    <!--<iframe width="346" height="195" src="http://www.youtube.com/embed/-0JZtJDEWbk" frameborder="0" allowfullscreen></iframe>-->
                    <!--<video width="346" height="195" controls>
		      <source src="Funny videos.mp4" type="video/mp4">
		      <source src="movie.ogg" type="video/ogg">
                    </video>-->
		    <div class="video_Wp posR" id="player_b">
			<div class="projekktor" id="player_a"></div>
		    </div>
                </div>
              <p class="btn_video">
                <label><!--We welcome new tutors--><?php echo $lwe_welcome;?></label>
                <a class="main_button main_button2" href="<?php echo Base_Url('tutors');?>"><!--Tutors--><?php echo $ltutors;?></a> </p>
            </div>
          </div>
	  
	  <div class="btm_text">
	       
	       <div id="slider1" class="sliderwrapper slogan-line"> 
	       <?php
	       if(sizeof($arr_quotes) > 1)
	       {
		    for($i=0;$i<sizeof($arr_quotes);$i++)
		    {
			 $quotes  = stripslashes($arr_quotes[$i]['quote']);
			 $quoteby = stripslashes($arr_quotes[$i]['quotedby']);
			 
		    
	       ?>
		    <div class="contentdiv">
			 <div class="slogan">
			      "<?php echo $quotes;?>" - 
			      <span class="slogan-bold"><strong><?php echo $quoteby;?></strong></span>
			 </div>
		    </div>
	       
	       <?php
		    }
	       }
	       ?>
	       
		    <div id="paginate-slider1" class="pagination">  </div>
	       
	       </div>
	  </div>
	  
          <!--<div class="btm_text">
	       â€œI was really surprised at how comfortable the tutor made me feel during my session.  It really improved my confidence and I have been using TheTalkList regularly.â€?  -
	       <span style="font-weight: bold;">Li Ying, Bejing</span>
	  </div>-->
	  
	  
	</div>
      </div>
    </div>
    <?php /*?>
    <div class="how_it_sec">
   	  <div class="main_wrap">
       	<h4><!--How it Works--><?php echo $lhow_it_works;?></h4>
          <ul>
           	  <li>
              	<span class="arrow"><img src="<?php echo Base_url("images/big_arrow.png");?>" width="127" height="8" alt="arrow" /></span>
               	  <h5><!--Search--><?php echo $lsearch;?></h5>
                  <p><!--Choose the tutor of your choice, from a huge selection of American English Tutors--><?php echo $lchoose_tutor;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/home_icon1.jpg");?>" width="139" height="93" alt="icon1" /></p>
              </li>
              <li>
              	<span class="arrow"><img src="<?php echo Base_url("images/big_arrow.png");?>" width="127" height="8" alt="arrow" /></span>
               	  <h5><!--Schedule--><?php echo $lschedule;?></h5>
                  <p><!--Look at any tutor's available calendar to book a session--><?php echo $llook_tutor;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/home_icon2.jpg");?>" width="89" height="114" alt="icon2" /></p>
              </li>
              <li class="last_li_class">
              	<span class="arrow"><img src="<?php echo Base_url("images/big_arrow.png");?>" width="127" height="8" alt="arrow" /></span>
               	  <h5><!--Talk--><?php echo $ltalk;?></h5>
                  <p><!--Use our custom Video Platform to speak online in a safe private setting--><?php echo $lcustom_video;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/home_icon3.jpg");?>" width="99" height="94" alt="icon3" /></p>
              </li>
          </ul>
        </div>
    </div>
    <div class="how_it_sec talklist_sec">
   	  <div class="main_wrap">
       	<h4><span><!--WhyThe TalkList--><?php echo $lwhy;?></span></h4>
          <ul>
           	  <li>
               	  <h5><!--American Tutors--><?php echo $lamerican_tutor;?></h5>
                  <p><!--You get a tutor from around the USA or around the world that's been tested in our instructional learning method.--><?php echo $lyou_get_tutor;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/img1.jpg");?>" width="127" height="161" alt="img1" /></p>
              </li>
              <li>
               	  <h5><!--No Contracts--><?php echo $lno_contracts;?></h5>
                  <p><!--You get flexible scheduling and flexible payment with no contracts--><?php echo $lyou_get_flexible;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/img2.jpg");?>" width="173" height="250" alt="img2" /></p>
              </li>
              <li class="last_li_class">
               	  <h5><!--Your Topic--><?php echo $lyour_topic;?></h5>
                  <p><!--You get to customize each conversation tutorial around your interest : test, school, work, or travel--><?php echo $lyou_get_customize;?></p>
                  <p class="icon"><img src="<?php echo Base_url("images/img3.jpg");?>" width="220" height="168" alt="img" /></p>
              </li>
          </ul>
        </div>
    </div><?php */?>
  </div>
<script>
	/*function createVideo(poster,videoPath,title){ 
		//alert(poster);
		//alert(videoPath);
		//alert(title);
		
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: '',
			debug: false,
			poster: poster,
			width: 346, //719
			height: 195, //397
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			controls: true,
			playlist: [
				{
					0: {src:videoPath+'.ogv', type:'video/ogv'},
					1: {src:videoPath+'.ogg', type:'video/ogg'},
					2: {src:videoPath+'', type:'video/mp4'}
				}
			] 
		});
	}
	
	function createVideo1(poster,videoPath,title){ 
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: '',
			debug: false,
			poster: poster,
			width: 346, //719
			height: 195, //397
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			controls: true,
			playlist: [
				{
					0: {src:videoPath+'.mp4', type:'video/mp4'}
				}
			] 
		});
	}
	$(function(){
		//$('a@[href=#]').attr('href','javascript:void(0)');
		
		var _firstLesson = $('.list dl:first');
		if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){  
			//createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default vedio');
			
			//var poster = '<?php echo Base_url("images/how.png");?>';
			var poster = '<?php echo base_url(); ?>uploads/video/images/<?php echo $video[0]['video_file']?>.jpg';
			//var videoPath = '<?php echo Base_url("vedio/second");?>';
			var videoPath = '<?php echo base_url(); ?>uploads/video/<?php echo $video[0]['video_file']?>';
			var title = 'how';
			//alert('hi');
			createVideo(poster,videoPath,title);
		}
		else { 
			var _source = _firstLesson.attr('source');
			createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_firstLesson.find('.lname').html());
		}

		
		$('#showVideo1').click(function() {
//			var _poster = '<?php //echo Base_url("images/intro.png");?>';
//			var _videoPath = '<?php //echo Base_url("vedio/intro");?>';
			
			var _poster = '<?php echo Base_url("images/samplevideo.jpg");?>';
			var _videoPath = '<?php echo Base_url("vedio/sample_video");?>';
			var _title = 'test';
			createVideo1(_poster,_videoPath,_title);
			
		})
		
		$('#showVideo2').click(function() {
			var _poster = '<?php echo base_url(); ?>uploads/video/images/<?php echo $video[0]['video_file']?>.jpg';
			var _videoPath = '<?php echo base_url(); ?>uploads/video/<?php echo $video[0]['video_file']?>';
			var _title = 'how';
			createVideo(_poster,_videoPath,_title);
		})
		
		$("span.homett").hover(function () {
			$(this).append('<div class="hometooltip"><p>Each new member gets a free session.  In any future session, you get a 3 minute grace period to determine if you are satisfied with the tutor and video connection.  If not, you get a refund of your credits.</p></div>');
		  }, function () {
			$("div.hometooltip").remove();
		  });
		  
	})
*/
</script>
<script type="text/javascript">
/*
featuredcontentslider.init({
	id: "slider1",  //id of main slider DIV
	contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
	toc: "#increment",  //Valid values: "#increment", "markup", ["label1", "label2", etc]
	nextprev: ["Previous", "Next"],  //labels for "prev" and "next" links. Set to "" to hide.
	revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
	enablefade: [true, 0.3],  //[true/false, fadedegree]
	autorotate: [true, +9000],  //[true/false, pausetime]
	onChange: function(previndex, curindex, contentdivs){  //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (0=1st slide, 1=2nd etc)
		//curindex holds index of currently shown slide (0=1st slide, 1=2nd etc)
	}
})
*/
//$(document).ready(function(){
//     setTimeout(function(){
//	  $('.contentdiv').each(function() {
//	       alert($(this).attr('display'));
//	  });
//     },3000);
//     
//});

//$('#contentdiv')





</script>
 
<style>
.regpopup2 {
    top:
	250px !important;
	}
</style>


