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

 
$arrVal = $this->lookup_model->getValue('767', $multi_lang);
$thank = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('768', $multi_lang);
$visible = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('769', $multi_lang);
$upload = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('770', $multi_lang);
$y_video = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('771', $multi_lang);
$enter = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('772', $multi_lang);
$set = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('773', $multi_lang);
$haveFun = $arrVal[$multi_lang];
?>
 <script>
 $( window ).load(function() {
var a="<?php echo $this->session->userdata('ancode')?>";
 
if(a=="y")
{ 

	$('#dialog32').dialog({
					modal:true,
					width:'400px'
			});
	<?php $this->session->unset_userdata('ancode'); ?>
 } else
 {
	window.location.href = "<?php echo base_url('user/dashboard')?>";
 }
});

function chkRedirect()
{
	window.location.href = "<?php echo base_url('user/dashboard?step=1')?>";
}
</script>

 
		
			<div id="dialog32" title="Registration Success" style="display:None;background-color: white;">
<?php echo $thank?> </br><br/>
			<?php echo $visible?></br><br>
			<?php echo $upload?><br/>
			<?php echo $y_video?><br/>
			<?php echo $enter?><br/>
			<?php echo $set?><br/><br/>
			<?php echo $haveFun?>
			<br/><br/>
			<div class="thanks" ><a   onclick="chkRedirect();"  style="color:white;cursor:pointer" id="firstok" >OK</a></div>
		</div>

<div style="height:350px;">

</div>
 	<style>
	 #dialog32
 {
	min-height:80px !important;
 }
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
    width: 110px; float:left;}
	
	#dialog32 { font-size: 15px;    line-height: 20px; padding-top: 20px;}
	#ui-dialog-title-dialog32{font-size: 15px;}
</style>