
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


$arrVal 	= $this->lookup_model->getValue('1458', $multi_lang);	$weleverage   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('10', $multi_lang);	$contactus   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1445', $multi_lang);	$wantstudents   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1447', $multi_lang);	$weimpact   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1448', $multi_lang);	$ouropen   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1449', $multi_lang);	$wemanage   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1320', $multi_lang);	$searchtutors   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1450', $multi_lang);	$youcanrecruit   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1451', $multi_lang);	$wedesignan   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1459', $multi_lang);	$testvideosystem   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1452', $multi_lang);	$bringthe   	= $arrVal[$multi_lang];


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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_style.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_responsive.css');?>">
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
<div class="index-banner" style=""> <!-- class="banner_main" -->
	
	<div class="schcontainer" style="position:relative;">
		<img src="<?php echo base_url("images/school_banner_1.png"); ?>" width="100%" >
        
			<div class="banner_content_main" style=" position:absolute; top:70%; left:0%; margin:0 auto; width:100%;">
				<div class="banner_slogan_1"><?php echo $weleverage; ?></div>	
		    </div>	
			<a href="<?php echo base_url("/user/schoolsignup"); ?>"><button class="banner_links_btn_1"><?php echo $contactus; ?></button></a>
	   
    </div>
	<div class="school_content"><?php echo $wantstudents; ?>
	</div>
	<div class="schcontainer" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_2.png"); ?>" width="100%" >
		<div class="banner_content_main" style=" margin:0 auto; ">
				<div class="banner_slogan_2"><?php echo $weimpact; ?></div>
		</div>
    </div>
	<div class="school_content" ><?php echo $ouropen; ?>
	</div>
	<div class="schcontainer" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_3.png"); ?>" width="100%" >
		<div class="banner_content_main" style="margin:0 auto;">
			<div class="banner_slogan_3"><?php echo $wemanage; ?></div>
		</div>
		<a href="<?php echo base_url("/search/search"); ?>"><button class="banner_links_btn_2" ><?php echo $searchtutors; ?></button></a>
   </div>
	<div class="school_content"><?php echo $youcanrecruit; ?>
	</div>
	<div class="schcontainer" style="position:relative">
		<img src="<?php echo base_url("images/school_banner_4.jpg"); ?>" width="100%" >
        <div class="banner_content_main" style="margin:0 auto;">
			<div class="banner_slogan_4_sc"><?php echo $wedesignan; ?></div>
		</div>
		<a href="<?php echo base_url("/testveesession/testVeeSession"); ?>"><button class="banner_links_btn_3"><?php echo $testvideosystem; ?></button></a>
	</div>
	<div class="school_content" ><?php echo $bringthe; ?>
	</div>
</div>