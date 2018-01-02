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

$arrVal = $this->lookup_model->getValue('517', $multi_lang);  		$ratetool = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('518', $multi_lang);  		$contacttool = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('138', $multi_lang);  		$lconfirmpassword = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('121', $multi_lang);  		$lcity = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRST_NAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('533', $multi_lang);	$lLAST_NAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('534', $multi_lang);	$lAGE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('535', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('536', $multi_lang);	$lCEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('537', $multi_lang);	$lPASSWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('677', $multi_lang);	$lEDIT_PROFILE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('516', $multi_lang);	$ratemin = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('125', $multi_lang);	$lSOCIAL_PAGE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('135', $multi_lang);	$lSAVE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('727', $multi_lang);	$schoolname   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('252', $multi_lang);	$pay_email   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('817', $multi_lang);	$p_contact   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('818', $multi_lang);	$address   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('819', $multi_lang);	$zipcode   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('820', $multi_lang);	$smarkup   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('821', $multi_lang);	$paytip   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('822', $multi_lang);	$schooltip   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('823', $multi_lang);	$affiname   		= $arrVal[$multi_lang];		

$arrVal 	= $this->lookup_model->getValue('1026', $multi_lang);	$Registration   		= $arrVal[$multi_lang];		

$arrVal 	= $this->lookup_model->getValue('1065', $multi_lang);	$EntryError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1066', $multi_lang);	$cityError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1067', $multi_lang);	$termError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1068', $multi_lang);	$privacyError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1069', $multi_lang);	$RateError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1070', $multi_lang);	$ageError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1071', $multi_lang);	$usenameError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1072', $multi_lang);	$zipError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1073', $multi_lang);	$validpaypalError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1074', $multi_lang);	$papaltaken   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1075', $multi_lang);	$markuperror   		= $arrVal[$multi_lang];		

$arrVal 	= $this->lookup_model->getValue('1076', $multi_lang);	$validDecimal   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$passError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$passlenError   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmismatch   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$emailerror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1077', $multi_lang);	$emailmismatcherror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1078', $multi_lang);	$lessAge   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$fnameerror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1079', $multi_lang);	$lnameerror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1080', $multi_lang);	$areaerror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1081', $multi_lang);	$pnameerror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1082', $multi_lang);	$adderror   		= $arrVal[$multi_lang];		
$arrVal 	= $this->lookup_model->getValue('1083', $multi_lang);	$ziperr   		= $arrVal[$multi_lang];		
?>
<?php $this->layout->appendFile('javascript',"js/jquery.placeholder.js");?>
<?php $this->layout->appendFile('css','css/registration.css');?>

<script>
var _startDate = new Date();
var _endDate = '';
var canSubmit = false;
var checkUsername,checkPassword,checkCity,checkEmail,checkTerms,checkPrivacy;

function checkUsernameF(ifpost,recheck){
	if(typeof(ifpost)=='undefined'){
		ifpost = true;
	}
	if(typeof(recheck)=='undefined'){
		recheck = true;
	}
	var _name = $('#username').val();
	if(_name == null){
		checkUsername = false;
		//$("#showInfo").append("<div class='uname'>The username can not be empty!</div>");
		showInfo('uname','<?php echo $usenameError;?>');
		return false;
	}
	if(checkUsername==true && ifpost){
		hideInfo("uname");
		return true;
	}
	$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'username',value:_name},function(msg){
		if(msg.success){
			checkUsername = true;
			if(recheck){
				checkAll();
			}
			hideInfo("uname");
		}
		else {
			cyue   = false;
			if(typeof(msg.code)!="undefined" && msg.code=="100"){
				showInfo('uname',msg.message+'<br/>If you have an account, you can choose  <a href="forget">Forgot Password </a> .');
			}
			else{
				showInfo('uname',msg.message);
			}
			//$("#showInfo").append("<div class='uname'>"+msg.message+"</div>");
		}
	});
	return true;

}
// function added by haren

function chkzip()
{
var zipcode =document.getElementById("zipcode").value;
if(isNaN(zipcode))
{
showInfo('zipcode','<?php echo $zipError;?>');
document.getElementById("zipcode").value='';
}
else
{
hideInfo("zipcode");
return true;
}
}
function chkpayemail()
{
var pmail =document.getElementById("payment_account").value;
hideInfo("payment_account");
var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(! re.test(pmail))
    {
	 document.getElementById("payment_account").value='';
	showInfo('payment_account','<?php echo $validpaypalError;?>');
	return false;
	}
	else
	{
           hideInfo("payment_account");	
			$.getJSON('<?php echo Base_url("user/paypalcheck");?>',{id:'email',value:pmail},function(msg){
			//alert(msg.success)
			//alert(msg.success)
			if(msg.success){
						hideInfo("payment_account");
						return true;
			}
			else {
    document.getElementById("payment_account").value='';
	showInfo('payment_account','<?php echo $papaltaken;?>');
	return false;
			}
		});

	return false;
	
	}
}


function chkschoolcode()
{
var code = document.getElementById("UniqueId").value;
	$.getJSON('<?php echo Base_url("user/checkSchoolcode");?>',{id:'code',value:code},function(msg){
			
			if(msg.success)
			{
						hideInfo("schoolcode");
						return true;
			}
			else 
			{
					//document.getElementById("UniqueId").value='';
					showInfo('schoolcode','Unique code already taken.');
					document.getElementById("UniqueId").value='';
					return false;
			}
		});

	return false;
	
	
}

function chkmarkup()
{
	var cmark =document.getElementById("tutor_markup").value;
	if(cmark == '')
	{
		showInfo('tutor_markup','<?php echo $markuperror;?>');
		return false;  
	}
	else
	{
		hideInfo("tutor_markup");
		return true;
	}
	var decimal=  /^[-+]?[0-9]+\.[0-9]+$/;   
	if(cmark.match(decimal))   
	{   
		hideInfo("tutor_markup");
		return true;
	}  
	else  
	{   
		document.getElementById("tutor_markup").value='';
		showInfo('tutor_markup','<?php echo $validDecimal; ?>');
	   return false;  
	} 


	return false;
}





function checkPasswordF(){
	var _password = $('#password').val();
	var _cpassword = $('#confirmPassword').val();
	if(_password == null){
		checkPassword = false;
		showInfo('passwd','<?php echo $passError;?>');
		return false;
	}
	else if(_password.length<5 || _password.length>16){
		checkPassword = false;
		showInfo('passwd','<?php echo $passlenError;?>');
		//$("#showInfo").append("<div class='passwd'>The password must be between 5-16 characters containing any combination of letters and numbers.</div>");
		return false;
	}
	else if(_cpassword != _password) {
		checkPassword = false;
		showInfo('passwd','<?php echo $passmismatch;?>');
		return false;
	}
	else {
		checkPassword = true;
		hideInfo("passwd");
		return true;
	}
}

function checkCityF(){
	var _city = $('#city').val();
	if(_city == ''){
		checkCity = false;
		showInfo('city','<?php echo $cityError;?>');
		//$("#showInfo").append("<div class='city'>The city can not be empty!</div>");
		return false;
	}
	else {
		checkCity = true;
		hideInfo("city");
		return true;
	}
}


function checkRateF()
{
	var _rate = $('#hRate').val();
	var pattrn = /^\d+(\.\d{1,2})?$/;

	if (!pattrn.exec(_rate)){

		$('#hRate').focus();
		$('#hRate').val('');
		showInfo('hRate','<?php echo $RateError; ?>');
		return false;
	}
	else{
		var dotPos = _rate.indexOf(".");

		if(dotPos == -1)
			$('#hRate').val(_rate+'.00');
		else
		{
			var part2 = _rate.split(".");

			if(part2[1].length == 1)
				$('#hRate').val(_rate+'0');
		}
		return true;
	}
}

function checkEmailF(){
	var _email = $('#email').val();
	if(_email == ''){
		checkEmail = false;
		showInfo('email','<?php echo $emailerror;?>');
		return false;
	}
	else if(_email != $('#confirmEmail').val() ){
		checkEmail = false;
		showInfo('email','<?php echo $emailmismatcherror;?>');
		return false;
	}
	else {
		hideInfo("email");
		checkEmail = true;
	}
	return true;
	
}
// added a new function for check email exists by TECHNO-SANJAY
function checkEmailExists(){
	var _email = $('#email').val();
	
	// populate email as username
	$('#username').val(_email);
	
	if(_email == ''){
		checkEmail = false;
		showInfo('email','<?php echo $emailerror;?>');
		return false;
	}
	else {
		hideInfo("email");
		checkEmail = true;
	}
	if(checkEmail == true) {
		$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:_email},function(msg){
			if(msg.success){
				checkEmail = true;
				$(".email","#showInfo").empty();
			}
			else {
				checkEmail = false;
				showInfo('email',msg.message);
			}
		});
		return true;
	}else {
		return false;
	}
}
function checkAll(){
	
	checkCityF() && checkRateF();

	var role = $('#roleId').val();
	if(role == 1)
	{
		if( $('#hRate').val() == ''	){
			checkRate = false;
			showInfo('hRate','<?php echo $RateError; ?>');
			return;
		}
		else{
			checkRate = true;
			hideInfo('hRate');
		}
	}
	else
	{
		hideInfo('hRate');
		checkRate = true;
	}
	
	
	if( typeof( $('#checkbox_terms:checked').get(0) ) == 'undefined' ){
		checkTerms = false;
		showInfo('terms','<?php echo $termError;?>');
		return;
	}
	else {
		checkTerms = true;
		hideInfo("terms");
	}
	if( typeof( $('#checkbox_privacy:checked').get(0) ) == 'undefined' ){
		checkPrivacy = false;
		showInfo('privacy','<?php echo $privacyError;?>');
		return;
	}
	else {
		checkPrivacy = true;
		hideInfo("privacy");
	}
	if($('#age').val()==''){
		showInfo('age','<?php echo $ageError;?>');
		return;
	}
	else if($('#age').val() < 13){
		showInfo('age','<?php echo $lessAge;?>');
		return;
	}
	else{
		hideInfo('age');
	}
	if( $('#firstName').val() == ''	){
		showInfo('firstName','<?php echo $fnameerror;?>');
		return;
	}
	else{
		hideInfo('firstName');
	}
	if( $('#lastName').val() == ''	){
		showInfo('lastName','<?php echo $lnameerror;?>');
		return;
	}
	else{
		hideInfo('firstName');
	}
	
	if($.trim( $('#changeCh').val() ) != ''){
		var patrn=/^([0-9]{2,3})(\-[0-9]+)?$/;
		if (!patrn.exec($.trim( $('#changeCh').val() ) ) ){
			showInfo('areaCode','<?php echo $areaerror;?>');
			return false;
		}
		else{
			hideInfo('areaCode');
		}
	}
	if(chkschoolcode && checkCity && checkRate){
	submitData();
	}
	else {
		$('#errorsTitle').click();
	}
}
function hideInfo(className){
	$('.'+className,'#showInfo').remove();
	if($('#showInfo').children().length <= 1){
		$('#showInfo').empty();
	}
}
function showInfo(className,msg){
	if($('#showInfo').children().length <= 1){
		$('#showInfo').append($('<div class="errorInfo" style="font-size:24px"><a href="#errorsTitle" id="errorsTitle"><?php echo $EntryError;?></a></div>'));
	}
	if( typeof($('.'+className,'#showInfo').get(0)) == 'undefined' ){
		$('#showInfo').append($('<div class="'+className+'"></div>'));
	}
	$('.'+className,'#showInfo').html(msg);
	document.location.href="#errorsTitle";
}
function submitData() {
 var role = $('#roleId').val();
 //alert(role);
 //return false;
 if(role==4 || role==5)
 {
		if( $('#principle_name').val() == ''	)
		{
			showInfo('principle_name','<?php echo $pnameerror;?>');
			return false;
		}
		else
		{
			hideInfo('principle_name');
		}
		if( $('#address').val() == ''	)
		{
			showInfo('address','<?php echo $adderror;?>');
			return false;
		}
		else
		{
			hideInfo('address');
		}
		if( $('#zipcode').val() == '')
		{
			showInfo('zipcode','<?php echo $ziperr ;?>');
			return false;
		}
		else
		{
			hideInfo('zipcode');
		}
		var zipcode =document.getElementById("zipcode").value;
	   if(isNaN(zipcode))
		{
			showInfo('zipcode','<?php echo $zipError; ?>');
			document.getElementById("zipcode").value='';
			return false;
		}
		else
		{
			hideInfo('zipcode');
		}
		 
		if( $('#payment_account').val() == ''	)
		{
			showInfo('payment_account','<?php echo $validpaypalError; ?>');
			return false;
		}
		else
		{
			hideInfo('payment_account');
		}
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var pmail=$('#payment_account').val();
		if(! re.test(pmail))
		{
			document.getElementById("payment_account").value='';
			showInfo('payment_account','<?php echo $validpaypalError; ?>');
			return false;
		}
		else
		{
			hideInfo('payment_account');
		}

		
 }
 

	var _data = {};
	$('input:text,input:password,input:hidden','.regist_mid_2').each(function(){
		var _obj = $(this);
		var _id = _obj.attr('id');
		if(_id == 'confirmEmail' || _id == 'confirmPassword' || _id=='changeC' || _id=='changeCh'){

		}
		else {
			var _val = _obj.val();
			_data[_id] = _val;
			_obj = null;
		}
	})
	$('input:radio:checked','.regist_mid_2').each(function(){
		var _obj = $(this);
		var _id = _obj.attr('name');
		var _val = _obj.val();
		_data[_id] = _val;
		_obj = null;
	})
	$('select','.regist_mid_2').each(function(){
		var _obj = $(this);
		var _id = _obj.attr('id');
		var _vals = _obj.val();
		var _val = '';
		//console.info(typeof(_vals))
		if( (typeof(_vals) == 'object' || typeof(_vals) == 'array' ) && _vals != null) {

			$.each(_vals,function(k,v){
				_val += v + ',';
			})
			if( _val != null && typeof(_val.length) != 'undefined' ){
				_val = _val.substr(0,_val.length - 1);
			}
		}
		else{
			_val = _vals;
		}
		_data[_id] = _val;
		_obj = null;
	})
	$('#register').val('<?php echo $lSAVE?>'+'...');
	$.post('<?php echo Base_url("user/registereditDo");?>',_data,function(msg){
	
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.success){
			document.location.href = json.redirect;
			//document.location.href = '<?php echo Base_url("user/dashboard");?>';
		}
		else {
			$('#register').val('Register');
			showInfo('error',json.message);
		}
	});

}
function isTel(str) {
	var patrn = /^[0-9]+$/;
	if (!patrn.exec(str)){
		return false;
	}
	return true
}
$(function(){
	$('#networkPage').blur(function(){
		if($(this).val().trim() == 'http://www.'){
			$(this).val('');
		}
	})
	$('#networkPage').focus(function(){
		if($(this).val().trim() == ''){
			$(this).val('http://www.');
		}
	})
	$('#roleId').change(function(){
		var role = $('#roleId').val();
		if(role == 1){
			$('#tutRateF').show('slow');
			$('#lngInfId').show('slow');
		} else {
			$('#tutRateF').hide('slow');
			//$('#lngInfId').hide('slow');
			$('#showInfo').empty();
		}
	});
	$('#country').change(function(){
		var _cid = $(this).val();
		$.getJSON('<?php echo Base_url("user/getProvices");?>',{cid:_cid},function(provices){
			if (String == provices.constructor) {
				eval ('var provices = ' + provices);
			}
			$('select#province').empty();
			for (var key in provices) {
				if (!provices.hasOwnProperty(key)) {
					continue;
				}
				var option = $('<option />').val(key).attr('ccode',1).append(provices[key]);
				$('select#province').append(option);
			}
			
			//--R&D@Dec-05 : Toggle State
			if(_cid == 2){
				$('select#province').show();
			}else{
				$('select#province').hide();
			}
			//--R&D@Dec-05 : Toggle State
			
			
			
		});

		$.get('<?php echo Base_url("user/ajaxCountryCode");?>',{cid:_cid},function(data){
			$('#changeC').val(data);
		});
	});
	$('#province').change(function(){
		var _pid = $(this).val();
		$.get('<?php echo Base_url("user/ajaxAreaCode");?>',{pid:_pid},function(data){
			$('#changeCh').val(data);
		});
	});  

	$('#country').trigger('change');
	$('#hRate').blur(function(){checkRateF();});
	$('#email').change(function(){checkEmailExists();});
	$('#confirmEmail').blur(function(){checkEmailF();});
	$('#city').blur(function(){checkCityF();});
	$('#confirmPassword').blur(function(){checkPasswordF();});
	$('#register').click(function(){checkAll();});
	
	
});
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));
window.fbAsyncInit = function() {
	FB.init({
		appId      : '407861685969553', // App ID
		channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true  // parse XFBML
	});
	FB.getLoginStatus(function(msg){
		if(msg.status == 'connected'){
			getInfo();
		}
		else{
			$('.btn_facebook').click(function(){
				FB.login(function(){
					getInfo();
				},{scope: 'email,user_likes,user_location,user_religion_politics,publish_stream'});
			})
		}
	})
};

function getInfo(){
	FB.api('/me', {access_token:FB.getAccessToken(),fields:'email,first_name,last_name,gender,username,timezone,religion,location,age_range,link'},function(user) {
		if (user) {
			console.info(user);
			$('#firstName').val(user.first_name);
			$('#lastName').val(user.last_name);
			$('#age').val(user.age_range.min);
			var _location = user.location.name;
			_location = _location.split(',');
			$('#city').val(_location[0]);
			$('#province option').each(function(){
				if($(this).html() == _location[1].trim()) {
					$(this).attr('selected','selected');
				}

			})
			var _timezone = 'UTC';
			if(user.timezone > 0 ){
				_timezone = 'UP'+ user.timezone;
			}
			else if(user.timezone < 0){
				_timezone = 'UM'+ (-user.timezone);
			}

			if(user.gender == 'female'){
				$('#gender1').attr('checked','checked');
			}
			else{
				$('#gender2').attr('checked','checked');
			}
			$('#timezone').val();
			$('#networkPage').val(user.link);
			$('#email').val(user.email);
			$('#confirmEmail').val(user.email);
			FB.api('me/feed','post',{message:user.username +' is logged into www.TheTalkList.com. Teaching and learning English online.'})
		}
	});
}

$(document).ready(function(){
	
	if($("#roleId").val() == 1){
		$(".cell_phone_dl").show('slow');
		$("#regciid").addClass('regci');
	} else {
		$(".cell_phone_dl").hide('slow');
		$("#regciid").removeClass('regci');
	}
		
	$("#roleId").change(function(){
		if($("#roleId").val() == 1){
			$(".cell_phone_dl").show('slow');
		} else {
			$(".cell_phone_dl").hide('slow');
		}
	});
	
	$("dt.regrt").hover(function () {
		$(this).append('<div class="tooltip"><p><?php echo $ratetool; ?></p></div>');
	}, function () {
		$("div.tooltip").remove();
	});
	
	$("dt.tmkp").hover(function () {
	
	<?php $markup1="Enter the amount the school makes on each tutoring session<br> Typical school fee is $2-$3 TheTalkList will add its administration fee onto the resulting fee.";?>  
    <?php // $markup= "Tutor rate is"; ?>
		$(this).append('<div class="tooltipci"><p><?php echo $schooltip;?></p></div>');
	}, function () {
	$("div.tooltipci").remove();
	});
	
	
	$("dt.ucode").hover(function () {
	
	<?php $markup1="This is a prefix to your unique ID number<BR>It can only contain letters and can be up to 6 characters.";?>  
    <?php // $markup= "Tutor rate is"; ?>
		$(this).append('<div class="tooltipci"><p><?php echo $markup;?></p></div>');
	}, function () {
		$("div.tooltipci").remove();
	});
	
	$("dt.pemail").hover(function () {
	
	<?php $markup1="This is the email account where you will be paid on a monthly basis.";?>  
    <?php // $markup= "Tutor rate is"; ?>
		$(this).append('<div class="tooltipci"><p><?php echo $paytip;?></p></div>');
	}, function () {
		$("div.tooltipci").remove();
	});
	
	$("dt.regci").hover(function () {
		$(this).append('<div class="tooltip"><p><?php echo $contacttool;?></p></div>');
	}, function () {
		$("div.tooltip").remove();
	});

});
</script>
<?php
$arrVal = $this->lookup_model->getValue('112', $multi_lang);
//echo $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('111', $multi_lang);
$student =  $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('110', $multi_lang);
$tutor = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('726', $multi_lang);
$school = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('816', $multi_lang);
$affiliate = $arrVal[$multi_lang];
?>
<div class="regist">
	<div class="regist_mid_1">
		
		
		<div class="banner">
			<img height="200px" src="<?php echo Base_url('/images/graphicbanners/graphicbanner.jpg' ); ?>" alt="Graphic Banner" />
		</div>
	</div>
	<div class="regist_mid_2 rig-struct">
		<dl id="showInfo" style="color:red">
		</dl>
		
		<dl class="content">
			<dd>
				<select class="raduisSelect" id="roleId" hidden>
					<option value="0" <?php if($this->session->userdata('roleId') == 0) {?>selected<?php }?>><?php echo $student;?></option>
					<option value="1" <?php if($this->session->userdata('roleId') == 1 || $this->session->userdata('roleId') == 2) {?>selected<?php }?>><?php echo $tutor;?></option>
					<option value="4" <?php if($this->session->userdata('roleId') == 4) {?>selected<?php }?>><?php echo "School";?></option>
					<option value="5" <?php if($this->session->userdata('roleId') == 5) {?>selected<?php }?>><?php echo "Affiliate";?></option>
				</select>
				<?php if($this->session->userdata('roleId') == 0){$rl=$student;} 
					   if($this->session->userdata('roleId') == 1){$rl=$tutor;}
					if($this->session->userdata('roleId') == 4){$rl=$school;}
					if($this->session->userdata('roleId') == 5){$rl=$affiliate;}	
				?>
				<input type="hidden" class="raduisSelect"  id="roleId" value="<?php echo $rl; ?>" disabled/>
				<div><h2 style="width:900px !important"><?php echo $rl."  ".$Registration; ?></h2></div>
			</dd>
		</dl>
		
		<dl style="clear:both;">
			<dt><?php
	$arrVal = $this->lookup_model->getValue('113', $multi_lang);
	if($this->session->userdata('roleId') ==4)
	{
		echo $schoolname;
	}
	else if($this->session->userdata('roleId') ==5)
	{
		echo $affiname ; 
	}
	else  
	{
		echo $arrVal[$multi_lang];
	}
	?>:</dt>
	
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lFIRST_NAME;?>:" id="firstName" value="<?php echo @$profile['firstName'];?>"/><span class="icnred">*</span></dd>
			<?php if($this->session->userdata('roleId') < 4 ) {?>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lLAST_NAME;?>:" id="lastName" value="<?php echo @$profile['lastName'];?>"/><span class="icnred">*</span></dd>
			<dd><input type="text" class="raduisSelect w100" placeholder="<?php echo $lAGE;?>:" id="age" value="<?php echo @$profile['age'];?>"/><span class="icnred">*</span></dd>
			<?php }?>
            </dl>
			
			
<?php if($this->session->userdata('roleId') ==4 || $this->session->userdata('roleId') ==5 ) {?>
<dl style="clear:both;" class="clearfix" id="tutRateF">
			<dt style="" class="pemail"><?php echo $pay_email ?>:<img src="<?php echo Base_url('images/arrow.png') ?>" /></dt>
	
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $pay_email;?>" id="payment_account" value="<?php echo @$profile['payment_account'];?>" onblur="return chkpayemail();" /><span class="icnred">*</span>
			
			</dd>
			
            </dl>
			<hr>
		<?php }?>	

			
			<?php if($this->session->userdata('roleId') < 4) {?>
            <dl style="clear:both;">
			<dd class="gender"><?php
	$arrVal = $this->lookup_model->getValue('114', $multi_lang);
	echo $arrVal[$multi_lang];
	?>:</dd>
	
			<dd><span class="male"><input type="radio" name="gender" id="gender1" value="0" <?php if($profile['gender'] == 0){echo 'checked';} ?>/>&nbsp;
			<?php
			$arrVal = $this->lookup_model->getValue('115', $multi_lang);
			echo $arrVal[$multi_lang];
			?></span><br />
			<span class="male"><input type="radio" name="gender" id="gender2" value="1" <?php if($profile['gender'] == 1){echo 'checked';} ?>/>&nbsp;
			<?php
			$arrVal = $this->lookup_model->getValue('116', $multi_lang);
			echo $arrVal[$multi_lang];
			?></span></dd>
		</dl>
		
		
		<?php }?>
		
	   <?php if($this->session->userdata('roleId') ==4 || $this->session->userdata('roleId') ==5 ) {?>
	
	<!--	<dl style="clear:both;" class="clearfix" id="tutRateF">
		<?php if($this->session->userdata('roleId') ==4){?>
			<dt class="ucode">School Code:<img src="<?php echo Base_url('images/arrow.png') ?>"  /></dt>
	  <?php }else{?>
	  <dt class="ucode" >Affiliate Code:<img src="<?php echo Base_url('images/arrow.png') ?>"  />
	 
	  </dt>	
	  <?php }?>
 
	<dd><input type="text" class="raduisSelect" placeholder="xxxxxx" id="UniqueId" value="<?php echo @$profile['UniqueId'];?>" maxlength='6' onblur="return chkschoolcode();"/>&nbsp;*</dd>
			
            </dl>-->
	   <dl>

	<dl style="clear:both;">
			<dt><?php echo $p_contact;?>:</dt>
	
			<dd ><input type="text" class="raduisSelect" placeholder="<?php echo $lFIRST_NAME. "/". $lLAST_NAME;?>" id="principle_name" value="<?php echo @$profile['principle_name'];?>" maxlength='20'/>&nbsp;<span class="icnred">*</span></dd>
			
            </dl>
	   <dl>
			<dt>
			<?php echo $lEMAIL;?>:</dt>
			<dd><input type="text" class="raduisSelect" disabled placeholder="E-mail:" id="email" value="<?php echo @$userInfo['email'];?>" maxlength='30'/><span class="icnred">*</span></dd>
			<!--<dd><input type="text" class="raduisSelect" placeholder="Confirm E-mail:" id="confirmEmail" value="<?php echo @$get['confirmEmail'];?>"/></dd>-->
		</dl>
	   
	   <dl style="clear:both;">
			<dt><?php echo $address;?>:</dt>
	
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $address;?>" id="address" value="<?php echo @$profile['address'];?>"/><span class="icnred">*</span></dd>
			
            </dl><br><br>
	   
	   
	   <?php }?>
		<?php
		$arrVal = $this->lookup_model->getValue('117', $multi_lang);
		$location = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('120', $multi_lang);
		$region = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('119', $multi_lang);
		$state = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('118', $multi_lang);
		$country = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('121', $multi_lang);
		$city = $arrVal[$multi_lang];
		?>
		<dl class="mt0">
			<dt class="lines">
					<?php echo $location;?>: <br />
					<span>(<?php echo $country;?>, <?php echo $state."/".$region;?>, <?php echo $city?>)</span></dt>
			<dd>

				<select name="country" id="country" class="raduisSelect">
				<?php foreach ($countries as $key => $val){?>
     				<optgroup label="<?php echo $key;?>">

					<?php foreach ($val as $k => $v){?>
						<option value="<?php echo $k;?>" 
								<?php if($k==2):?>selected<?php endif; ?>><?php echo $v;?></option>

					<?php }?>
					</optgroup>
				<?php }?>
				</select>
			</dd>
			<?php
			//if($profile['country'] == '2'){
			?>
			<dd>
				<select class="raduisSelect" id="province">
					<option>Region</option>
				</select>
			</dd>
			<?php //} ?>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lcity; ?>" id="city" value="<?php echo $profile['city']; ?>" /> <span class="icnred">*</span></dd>
		</dl>
		
		
		<!-- update language information code BY TECHNO-SANJAY -->
		<!--<dl id="lngInfId" <?php echo $lngStyle; ?>>
			<dt><?php
			$arrVal = $this->lookup_model->getValue('126', $multi_lang);
			echo $arrVal[$multi_lang];
			?>: </dt>
			<dd>
				<div class="langTitle"><?php
			$arrVal = $this->lookup_model->getValue('127', $multi_lang);
			echo $arrVal[$multi_lang];
			?> *</div>
				<?php echo form_dropdown('nativeLanguage',$langs,$profile["nativeLanguage"],' id="nativeLanguage" class="textarea_box" multiple="multiple" ');?>
				
				<div class="langInfo"><?php
			$arrVal = $this->lookup_model->getValue('128', $multi_lang);
			echo $arrVal[$multi_lang];
			?></div>
			</dd>
			
	    </dl>-->
<?php if($this->session->userdata('roleId') ==4 || $this->session->userdata('roleId') ==5 ) {?>
	   <dl style="clear:both;">
			<dt><?php echo $zipcode; ?>:</dt>
	
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $zipcode; ?>" id="zipcode" value="<?php echo @$profile[''];?>" onblur="return chkzip();" maxlength='8'/>&nbsp;<span class="icnred">*</span></dd>
			
            </dl>
	   <dl>
	    
<?php if($this->session->userdata('roleId') ==4) {?>
	   <dl style="clear:both; height:120px;" class="clearfix" id="tutRateF">

		<dt class="tmkp"><?php echo $smarkup;?>:<img src="<?php echo Base_url('images/arrow.png') ?>"  /></dt>
			
			<dd><input type="text" class="raduisSelect" placeholder="$00.00" id="tutor_markup" onblur="return chkmarkup();"  value="<?php echo @$profile[''];?>" maxlength='6'/> &nbsp;<span class="icnred">*</span></dd>
			
            </dl>
		 
<?php }?>
	   <?php }?>
	</div>
	<?php if($this->session->userdata('roleId') < 4) {?>
	<div class="regist_mid_2 regist_mid_3">
		<dl class="tooltip-nw" id="tooltip-nw-id">
			<dt class="regci">
			<span style="float:left;font-weight: bold;color: #0D5782;font-size: 14px;">
			<?php $arrVal = $this->lookup_model->getValue('122', $multi_lang);
			 echo $arrVal[$multi_lang];
			?>
			:</span>
			<img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" />
			</dt>
			<dd class="cell_phone_dl" style="display:none;">
				<input type="text" style="width:80px;" class="raduisSelect" value="" id="areacode" placeholder="XXX"/> <!-- id="changeCh" -->
			</dd>
			<dd class="cell_phone_dl" style="display:none;">
				<input type="text" maxlength="8" class="raduisSelect" placeholder="XXX-XXXX"id="cell" value="<?php echo $profile['cell']; ?>" /><em class="ajayhifen">-</em>
			</dd>
			<dd>
				<input type="text" class="raduisSelect" value="<?php echo $profile['networkPage']; ?>" placeholder="<?php echo $lSOCIAL_PAGE;?>" id="networkPage" />
			</dd>
		</dl>
		<dl style="clear:both;">
			<dt> </dt>
			<!--<dd>
				<div style="width:95px;margin-left: 15px;">Country Code</div >
			</dd>-->
			<dd class="cell_phone_dl" style="display:none;">
				<div style="width:90px;margin-left:25px;"><?php
			$arrVal = $this->lookup_model->getValue('123', $multi_lang);
			echo $arrVal[$multi_lang];
			?></div>
			</dd>
			<dd class="cell_phone_dl" style="display:none;">
				<div style="width:200px;margin-left: 25px;"><?php
			$arrVal = $this->lookup_model->getValue('124', $multi_lang);
			echo $arrVal[$multi_lang];
			?></div>
			</dd>
			<dd>
			<div style="width:194px;margin-left: 25px;display:none;"><?php
			$arrVal = $this->lookup_model->getValue('125', $multi_lang);
			echo $arrVal[$multi_lang];
			?></div >
			</dd>
		</dl>
		<dl>
			<dt><!--<?php
			$arrVal = $this->lookup_model->getValue('129', $multi_lang);
			//echo $arrVal[$multi_lang];
			?>:</dt>
			<dd><input type="text" class="raduisSelect" disabled placeholder="E-mail:" id="email" value="<?php echo @$userInfo['email'];?>"/> *</dd>
			<!--<dd><input type="text" class="raduisSelect" placeholder="Confirm E-mail:" id="confirmEmail" value="<?php echo @$get['confirmEmail'];?>"/></dd>-->
		</dl>
		
		
		<?php 
		if($this->session->userdata('roleId') == 1 || $this->session->userdata('roleId') == 2){
		
		if($this->session->userdata('roleId') == 1 || $this->session->userdata('roleId') == 2){
			$tutStyle = "";
			$lngStyle = "";
		}else{
			$tutStyle = 'style="display: none"';
			$lngStyle = 'style="display: none"';
		}
		?>
		
		<dl id="tutRateF" <?php echo $tutStyle; ?>>
			<dt class="regrt"><span style="float:left;font-weight: bold;color: #0D5782;font-size: 14px;"><?php echo $ratemin; ?>:</span> <img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" /></dt>
			<dd><input type="text" class="raduisSelect" placeholder="$__.__" id="hRate" value="<?php echo $profile['hRate'] ?>"/></dd>
		</dl><br><br> 
		<?php }?>
		
		
		<!--
		<dl>
			<dt>&nbsp;</dt>
			<dd><input type="password" class="raduisSelect" placeholder="Create Password:" id="password" value="<?php echo @$get['password'];?>"/> *</dd>
			<dd><input type="password" class="raduisSelect" value="" id="confirmPassword" value=""/> *</dd>
		</dl>
		-->
		<input type="hidden" value="<?php echo @$_SERVER['HTTP_REFERER']; ?>" name="httpref" id="httpref" />
	</div>
	<?php }?>
	<?php
	$arrVal = $this->lookup_model->getValue('131', $multi_lang);
	$ihaveread = $arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('378', $multi_lang);
	$terms = $arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('377', $multi_lang);
	$privacy = $arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('243', $multi_lang);
	$andagree = @$arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('244', $multi_lang);
	$andagreeit = @$arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('371', $multi_lang);
	$vregister = @$arrVal[$multi_lang];
	
	$arrVal = $this->lookup_model->getValue('429', $multi_lang);
	$bsubmit = @$arrVal[$multi_lang];
	?>
	
	<div class="regist_mid_2 regist_mid_4">
		<div class="checkbox"><input type="checkbox" name="checkbox_terms" id="checkbox_terms" />&nbsp;
			<a href="<?php echo Base_Url('article/terms');?>"><?php echo $terms;?></a><?php /*&nbsp;<?php echo $andagree;?>.*/?>
		</div>
		<div class="checkbox"><input type="checkbox" name="checkbox_privacy" id="checkbox_privacy"  />&nbsp;
			<a href="<?php echo Base_Url('article/privacy');?>"><?php echo $privacy;?></a><?php /*&nbsp;<?php echo $andagreeit;?>*/?>
		</div>
	</div>
	
	<div class="tr regist_mid_2" ><input type="button" class="btn_red" value="<?php echo $bsubmit;?>" id="register" /></div>
</div>
<style>

.clr
{
color:red;
}
dt.regrt {
  cursor: pointer;
  position: relative;
  display: inline-block;
}
dt.tmkp {
  cursor: pointer;
  position: relative;
  display: inline-block;
}

dt.ucode {
  cursor: pointer;
  position:relative;
  display: inline-block;
}

dt.pemail {
  cursor: pointer;
  position: relative;
  display: inline-block;
}

dt.regci{
  cursor: pointer;
  position: relative;
  display: inline-block;
}
div.tooltip {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 135px;
  top: -15px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
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
  padding-bottom:10px;
  display:block;
}
div.tooltip {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 135px;
  top: -15px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
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
  padding-bottom:10px;
  display:block;
}	
div.tooltipci {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 125px;
  top: 0px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
  font-size:11px;
}
div.tooltipci:before {
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
div.tooltipci p {
  margin: 10px;
  color: White;
  font-size:14px;
  font-weight:normal;
  line-height:16px;
  
}
.icnred
{
color:red;
font-size:17px;
}

</style>