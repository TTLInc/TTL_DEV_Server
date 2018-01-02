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
$arrVal 	= $this->lookup_model->getValue('964', $multi_lang);
$Chngpass	= $arrVal[$multi_lang];
$arrVal 	 = $this->lookup_model->getValue('965', $multi_lang);
$enternewpass = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('966', $multi_lang);
$newpass = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('967', $multi_lang);
$confpass = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('968', $multi_lang);
$change = $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
<script>
function changePassword(){
	var _password = $('#password').val();
	if(_password == ''){
		alert('The password can`t be empty.');
		return false;
	}
	/*if(_password.length <6 || if(_password > 15)){
		alert('The password can`t be more than 15 charactor or less than 6.');
		return false;
	}*/
	var _cpassword = $('#cpassword').val();
	if(_password != _cpassword){
		alert('The confirm password is not the same to password.');
		return false;
	}
	return true;
}
</script>
<div class="contact_us">
	<div class="contact_us_top"><?php echo $Chngpass;?></div>
	<div class="contact_us_mid">
		<p><?php echo $enternewpass;?></p>
		<p style="color:Red"><?php if(isset($error)) echo $error;?></p>
		<?php if(isset($errorMsg)){ ?>
		<p style="color:green"><?php if(isset($error));echo $errorMsg;?></p>
		<?php } ?>
		<form method="post" action="">
		<p>
			<label style="width:160px;display: inline-block;"><?php echo $newpass; ?></label><input type="password" name="password" value="" id="password" />
		</p>
		<p>
			<label style="width:160px;display: inline-block;"><?php echo $confpass;?></label><input type="password" name="cpassword" value="" id="cpassword" />
			<?php if(isset($infoStatus)):?>
			<input id="email"  name="email" type="hidden" value="<?php echo $infoStatus['email'];?>" class="box_01" />
            <input id="username"  name="username" type="hidden" value="<?php echo $infoStatus['username'];?>" class="box_01" />
            <input id="fid"  name="fid" type="hidden" value="<?php echo $infoStatus['id'];?>" class="box_01" />
			<?php endif;?>
		</p>

		<p>
		<label style="width:160px;display: inline-block;"></label><input type="submit" value="<?php echo $change;?>" name="submit" id="register"/>

		
		
        </p>
        <!--<p>Input your new password for change password.</p>-->
		</form>
		
	</div>
</div>
<style>
#register
{ background: url("<?php echo base_url();?>images/main/signin_btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
    border: 0 none !important;
    color: #fff;
    font-size: 18px;
    height: 43px;
    padding-bottom: 7px !important;
    text-align: center;
    width: 88px;}
</style>