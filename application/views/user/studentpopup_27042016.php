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
$arrVal = $this->lookup_model->getValue('1173', $multi_lang);	$ThanksForCmp 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1315', $multi_lang);	$lngWelcome 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1316', $multi_lang);	$lngReady 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1317', $multi_lang);	$lngStudent 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1318', $multi_lang);	$lngTutor 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1349', $multi_lang);	$lngBoth 	= $arrVal[$multi_lang];
?>
<script>
$( window ).load(function() {
var a="<?php echo $this->session->userdata('sturegister')?>";
if(a=="yes")
{ 

	$('#dialog3').dialog({
					modal:true,
					width:450,
					resizable:false,
					close: CloseFunction,
			});
	
 } else
 {
	window.location.href = "<?php echo base_url('user/dashboard')?>";
 }
});
function CloseFunction(){
	window.location.href = "<?php echo base_url('user/dashboard')?>";
}

function chkRedirect()
{
	<?php $this->session->set_userdata('sturegister','no'); ?>
	window.location.href = "<?php echo base_url('search/search')?>";
}
</script>
<div id="dialog3" style="display:None;background-color:white;" class="welcome-popup">
	<h2><?php echo $lngWelcome;?></h2>
	<p><?php echo $lngReady;?></p>
	<div class="icon-rw">
		<a href="javascript:void(0);"  onclick="chkRedirect();" class="learn-icon"><span><?php echo $lngStudent;?></span></a>
		<a href="<?php echo base_url('user/tutorpopup')?>" class="tutor-icon"><span><?php echo $lngTutor;?></span></a>
	</div>
    <p class="might-link"><a href="<?php echo base_url('user/tutorpopup')?>"><?php echo $lngBoth;?></a></p>
	<!--<div class="thanks" ><a onclick="chkRedirect();"   style="color:white;cursor:pointer" id="firstok" >OK</a></div>-->
</div>
<div style="height:350px;">
<img src="<?php echo base_url('images/talk-facebook.png'); ?>" alt="facebook" style="float:left;"/>
</div>
<style>
.thanks a{background: url("<?php echo base_url();?>images/test-vs-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    box-shadow: none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 14px;
    height: 34px;
    line-height: 32px;
    margin-top: 4px !important;
    outline: medium none;
    text-align: center;
    text-decoration: none;
    width: 110px; float:left;
}
</style>

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T8WV8L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T8WV8L');</script>

<!-- End Google Tag Manager -->