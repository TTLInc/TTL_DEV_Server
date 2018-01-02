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
$arrVal = $this->lookup_model->getValue('6', $multi_lang);
$forget_password = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('35', $multi_lang);
$lemail = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('34', $multi_lang);
$lsend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('45', $multi_lang);
$lforget_text = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
<div class="contact_us">
	<div class="contact_us_top"><?php echo $forget_password;?></div>
	<div class="contact_us_mid">
		<p style="color:Red"><?php if(isset($error)) print_R($error);?></p>
		<?php if(isset($errorMsg)){ ?>
		<p style="color:green"><?php if(isset($error));echo $errorMsg;?></p>
		<?php } ?>
		
		<form method="post" action="">
		<!-- remove username BY TECHNO-SANJAY -->
		<!--<p><label style="width:100px;display: inline-block;">Username:</label><input type="text" name="username" value="" id="username" /></p>-->
		<p><label style="width:100px;display: inline-block;"><?php echo $lemail;?>:</label><input type="text" name="email" value="" id="email" /></p>

		<p>
			<label style="width:100px;display: inline-block;"></label>
			<input type="submit" value="<?php echo $lsend;?>" name="submit" class="login-btn"/>	
		
        </p>
        <p style="clear:both;"><?php echo $lforget_text;?></p>
		</form>
		
	</div>
</div>
