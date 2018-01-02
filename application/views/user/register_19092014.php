<?php
$multi_lang = 'en';
if(!isset($_SESSION)) { @session_start(); }
if(isset($_SESSION['multi_lang'])){
	$multi_lang = $_SESSION['multi_lang'];
}else{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$this->load->helper('cookie');
?>
<?php
//--Weibo Data
if($multi_lang != "ch"){
//echo '====>'.$_SESSION['screen_name'].'<====';exit;
//echo '<pre>';print_r($_COOKIE);
//echo '<pre>';print_r($_SESSION);exit;
}
?>
<?php

$arrVal = $this->lookup_model->getValue('517', $multi_lang);  $ratetool 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('518', $multi_lang);  $contacttool 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('138', $multi_lang);  $lconfirmpassword = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('121', $multi_lang);  $lcity 			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRST_NAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('533', $multi_lang);	$lLAST_NAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('534', $multi_lang);	$lAGE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('535', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('536', $multi_lang);	$lCEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('537', $multi_lang);	$lPASSWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('125', $multi_lang);	$lSOCIAL_PAGE   		= $arrVal[$multi_lang];



?>
<?php $this->layout->appendFile('javascript',"js/jquery.placeholder.js");?>
<?php $this->layout->appendFile('css','css/registration.css');?>

<script>
var _startDate = new Date();
var _endDate = '';
var canSubmit = false;
var checkUsername,checkPassword,checkCity,checkEmail,checkTerms,checkPrivacy;
// remove testSpeed function BY TECHNO-SANJAY
/*
function testSpeed(){
	if( $('#testSpeedButton').attr('doing') == 1 ){
		return false;
	}
	else {
		$('#testSpeedButton').attr('doing',1);
	}
	$('#speed').html('<img src="<?php echo base_url("images/base/loading.gif");?>" height="25px" width="25px"/>Testing');
	_startDate = new Date();
	$('#testSpeed').attr('src',"<?php echo Base_url('images/test.jpg');?>"+'?a='+Math.random() );
	$('#testSpeed').load(function(){
		_endDate = new Date();
		var _time = _endDate - _startDate;
		var _totalSize = 579916;
		var _speed = _totalSize / (_time /1000);
		_speed = Math.ceil(_speed / 1024)
		$('#speed').html(_speed);
		$('#testSpeedButton').attr('doing',0);
		if(_speed < 4){
			$('.regist_mid_2').hide();
		}
		else {
			$('.regist_mid_2').show();
		}
	});
	$('.regist_mid_2').show();
}
*/
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
		showInfo('uname','Username cannot be empty.');
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

function checkPasswordF(){
	var _password = $('#password').val();
	var _cpassword = $('#confirmPassword').val();
	if(_password == null){
		checkPassword = false;
		showInfo('passwd','The password cannot be empty.');
		return false;
	}
	else if(_password.length<5 || _password.length>16){
		checkPassword = false;
		showInfo('passwd','Password length must be between 5-16 characters.');
		//$("#showInfo").append("<div class='passwd'>The password must be between 5-16 characters containing any combination of letters and numbers.</div>");
		return false;
	}
	else if(_cpassword != _password) {
		checkPassword = false;
		showInfo('passwd','Ensure that your confirmed password matches your password.');
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
		showInfo('city','City cannot be empty.');
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
		showInfo('hRate','Rate cannot be empty.');
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
	
	var e = $('#email').attr('placeholder'); 
	var ce = $('#confirmEmail').attr('placeholder'); 
	var e = $('#email').val();
	var cev = $('#confirmEmail').val();
	var ev  = $('#email').val();
	

	if(ce =='Confirm Email'){
	 
		checkEmail = false;
		showInfo('email','Confirm Email cannot be empty.');
		return false;
	}
	else if( e == 'Email'){
	 
		checkEmail = false;
		showInfo('email','Email cannot be empty.');
		return false;
	}
	
	
	//if(_email == ''){
		//checkEmail = false;
		//showInfo('email','Email cannot be empty.');
		//return false;
	//}
	//else if(_email != $('#confirmEmail').val() ){
		//checkEmail = false;
		//showInfo('email','Ensure that your confirmed email matches your email.');
		//return false;
	//}
	else {
		hideInfo("email");
		checkEmail = true;
	}
	return true;
	/*$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:_email},function(msg){
		if(msg.success){
			checkEmail = true;
			$(".email","#showInfo").empty();
		}
		else {
			checkEmail = false;
			showInfo('email',msg.message);
		}
	});*/
	return true;
}
// added a new function for check email exists by TECHNO-SANJAY
function checkEmailExists(){
	var _email = $('#email').val();
	
	// populate email as username
	$('#username').val(_email);
	
	if(_email == ''){
		checkEmail = false;
		showInfo('email','Email cannot be empty.');
		return false;
	}
	else {
		hideInfo("email");
		checkEmail = true;
	}
	if(checkEmail == true) {
		$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:_email},function(msg){
			//alert(msg.success)
			//alert(msg.success)
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

//function added by  haren

function ckmail(){
	var _email = document.getElementsByName("myemail")[0].value;
	var cev = $('#confirmEmail').val();

	if(_email==''){
	 showInfo('email','Email cannot be empty.');
		return false;
	}
	else
	{
	hideInfo("email");
	}
	
  if(cev ==''){
		showInfo('femail','Confirm Email cannot be empty.');
		return false;
	}
   else
   {
   hideInfo("femail");
   }
    if(_email != cev)
   {
    showInfo('cemail','Email and confirm email not matched.');
	return false;
   }
   else
   {
   hideInfo("cemail");
   }   
   
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(! re.test(_email))
    {
	 
	showInfo('vemail','Enter valid email.');
	return false;
	}
   else
   {
   hideInfo("vemail");
   }
   
   
   		$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:_email},function(msg){
			
			if(msg.success){
				
				hideInfo("eemail");
			}
			else {
				document.getElementsByName("myemail")[0].value='';
				showInfo('eemail','email already taken');
			}
		});
   
		return true;
}
function chkmarkup()
{
var cmark =document.getElementById("tutor_markup").value;
if(cmark == '')
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
	showInfo('tutor_markup','Enter valid decimal for tutor markup');
   return false;  
} 


return true;
}
function chkpayemail()
{
var pmail =document.getElementById("payment_account").value;
if(pmail == '')
{
hideInfo("payment_account");	
return true;
}
var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(! re.test(pmail))
    {
	 document.getElementById("payment_account").value='';
	showInfo('payment_account','Enter valid paypal email.');
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
	showInfo('payment_account','paypal-Email already taken.');
	return false;
			}
		});

	return true;
	
	}
} 
function chkzip()
{
var zipcode =document.getElementById("zipcode").value;
if(zipcode == '')
{
hideInfo("zipcode");
return true;
}
if(isNaN(zipcode))
{
showInfo('zipcode','Enter valid zipcode.');
document.getElementById("zipcode").value='';
}
else
{
hideInfo("zipcode");
return true;
}
return true;
}
function  cktermpolicy()
{
if(typeof( $('#checkbox_terms:checked').get(0) ) == 'undefined' ){
		
		showInfo('terms','Check the Terms and Conditions to agree.');
		return false;
	}
	else {
		
		hideInfo("terms");
	}
	if( typeof( $('#checkbox_privacy:checked').get(0) ) == 'undefined' ){
		
		showInfo('privacy','Check the Privacy Policy to agree.');
		return false;;
	}
	else {
		
		hideInfo("privacy");
	}
return true;
}
$(document).ready(function(){
	$("#cell").keyup(function () {
		i = $(this).val().length;
		if (i == 4) {
			if ($(this).val().search('-')==-1){
			 var cellValue =  $("#cell").val().substring(0,3)+ "-"+$("#cell").val().substring(3);
			$("#cell").val(cellValue);
			}
		} 
	});
});
// function added by haren for organization validation 25/3/2014


function myfunction()
{
//&& chkschoolcode()
if(ckfname() && chkucode()&& ckmail() && checkPasswordF() && chkmarkup() && chkpayemail() && chkzip() && cktermpolicy())
{
RegOrganization();
}
}
function chkucode()
{
if( $('#UniqueId').val() == '')
		{
			showInfo('schoolcode','Unique code cannot be empty.');
			return false;
		}
		else
		{
			hideInfo('schoolcode');
			return true;
		}
}
function chkschoolcode()
{
var code = $('#UniqueId').val();

	$.getJSON('<?php echo Base_url("user/checkSchoolcode");?>',{id:'code',value:code},function(msg){
			
			if(msg.success)
			{
						hideInfo("schoolcode");
						return true;
			}
			else 
			{
					//document.getElementById("UniqueId").value='';
					showInfo('schoolcode','School code already taken.');
					document.getElementById("UniqueId").value='';
					return false;
			}
		});

	return false;
}
function ckfname()
{
var a= document.getElementsByName("sname")[0].value;

if(a == ''	){
		showInfo('firstName','Name cannot be empty.');
		return false;
	}
	else{
	$('#firstName').val() == a;
		hideInfo('firstName');
		return true;
	}
}
function checkAll(){
	
	//checkUsernameF() && checkPasswordF() && checkCityF() && checkEmailF() && checkRateF();
	// remove checkUsernameF() by TECHNO-SANJAY
	checkPasswordF() && checkCityF() && checkEmailF() && checkRateF();

	var role = $('#roleId').val();
	if(role == 1)
	{
		if( $('#hRate').val() == ''	){
			checkRate = false;
			showInfo('hRate','Rate cannot be empty.');
			return;
		}
		else{
			checkRate = true;
			hideInfo('hRate');
		}
		// add native language validation for tutor only.
		if( $('#nativeLanguage').val() == '' || $('#nativeLanguage').val() == null){
			showInfo('nativeLanguage','I Speak  cannot be empty.');
			return;
		}
		else{
			hideInfo('nativeLanguage');
		}
	}
	else
	{
		hideInfo('hRate');
		checkRate = true;
	}
if(role < 4)
{
	if( typeof( $('#checkbox_terms:checked').get(0) ) == 'undefined' ){
		checkTerms = false;
		showInfo('terms','Check the Terms and Conditions to agree.');
		return;
	}
	else {
		checkTerms = true;
		hideInfo("terms");
	}
	if( typeof( $('#checkbox_privacy:checked').get(0) ) == 'undefined' ){
		checkPrivacy = false;
		showInfo('privacy','Check the Privacy Policy to agree.');
		return;
	}
	else {
		checkPrivacy = true;
		hideInfo("privacy");
	}
	if($('#age').val()==''){
		showInfo('age','Age cannot be empty.');
		return;
	}
	else if($('#age').val() < 13){
		showInfo('age','Age cannot be less than 13.  Use of TheTalkList requires permission of an adult.');
		return;
	}
	else{
		hideInfo('age');
	}
	if( $('#firstName').val() == ''	){
		showInfo('firstName','First Name cannot be empty.');
		return;
	}
	else{
		hideInfo('firstName');
	}
	if( $('#lastName').val() == ''	){
		showInfo('lastName','Last Name cannot be empty.');
		return;
	}
	else{
		hideInfo('firstName');
	}
	// remove language validation BY TECHNO-SANJAY
	/*
	if( $('#nativeLanguage').val() == '' || $('#nativeLanguage').val() == null){
		showInfo('nativeLanguage','I Speak  cannot be empty.');
		return;
	}
	else{
		hideInfo('nativeLanguage');
	}
	if( $('#otherLanguage').val() == ''	|| $('#otherLanguage').val() == null){
		showInfo('otherLanguage','I want to Learn cannot be empty.');
		return;
	}
	else{
		hideInfo('otherLanguage');
	}
	*/
	if($.trim( $('#changeCh').val() ) != ''){
		var patrn=/^([0-9]{2,3})(\-[0-9]+)?$/;
		if (!patrn.exec($.trim( $('#changeCh').val() ) ) ){
			showInfo('areaCode','Check if the Area Code is correct.');
			return false;
		}
		else{
			hideInfo('areaCode');
		}
	}
	
	
	/*
	
	if($.trim($('#cell').val() ) != ''){
		var cellNumber 	 = $.trim($('#cell').val());
		var returnCellNo = (cellNumber.indexOf("-") !== -1);
		if(returnCellNo)
		{
			var arrCN = cellNumber.split('-');
			for (i=0;i<=1;i++) {
				
				if(isTel(parseInt(arrCN[i]))){
	
				}
				else{
					showInfo('cell','Check if the cell number is correct.');
					return;
				}
			}
		}
	}*/


	//if(checkUsername && checkPassword && checkCity && checkEmail && checkTerms && checkPrivacy && checkRate){
	// remove checkUsername By TECHNO-SANJAY
	if(checkPassword && checkCity && checkEmail && checkTerms && checkPrivacy && checkRate){
		submitData();
	}
	else {
		$('#errorsTitle').click();
	}
}
else
{
		
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
	
	 
		$('#showInfo').append($('<div class="errorInfo" style="font-size:24px"><a href="#errorsTitle" id="errorsTitle">Entry Errors</a></div>'));
	}
	if( typeof($('.'+className,'#showInfo').get(0)) == 'undefined' ){
		
 
		$('#showInfo').append($('<div class="'+className+'"></div>'));
	}
	
	//alert('here');
	
	$('.'+className,'#showInfo').html(msg);
	//$( "#dialog p").html(msg);
	/*$( "#dialog" ).dialog({
		modal: true,
		show: "blind",
		hide: "explode"
	});*/
	
	document.location.href="#errorsTitle";
	
	//window.location.href='<?php echo base_url('user/studentregister');?>';
	
	
}
function submitData() {
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
	$('#register').val('Registering...');
	$.post('<?php echo Base_url("user/registerDo");?>',_data,function(msg){
		//alert(msg)
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}

		if(json.success){
			document.location.href = json.redirect;
			//window.location.href='<?php echo base_url('user/studentregister');?>';
		}
		else {
		
			$('#register').val('Register');
		showInfo('error',json.message);
			//$('#showInfo').html(json.message);
			
		}
	});

}
// function for submit data

function RegOrganization() {
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
	$('#update').val('saving...');
	$.post('<?php echo Base_url("user/orgregister");?>',_data,function(msg){
	//console.log(msg);
		//alert(msg)
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}

		if(json.success){
			document.location.href = json.redirect;
//window.location.href='<?php echo base_url('user/organization');?>';
		}
		else {
		
			//$('#register').val('Register');
		showInfo('error',json.message);
			//$('#showInfo').html(json.message);
			
		}
	});

}

function isTel(str) {
	//var patrn=/^((\+?[0-9]{2,4}\-[0-9]{3,4}\-)|([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/;
	//var patrn=/^([0-9]{6,10})(\-[0-9]+)?$/;
	var patrn = /^[0-9]+$/;
	if (!patrn.exec(str)){
		return false;
	}
	return true
}
$(function(){
	// remove time zone BY TECHNO-SANJAY
	//$('select:[name=timezone]').attr('id','timezone');
	//$('.regist_mid_2').hide();
	
	//$('input[placeholder]').placeholder();
	
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

	//registration type start
	$('#roleId').change(function(){
	
		var role = $('#roleId').val();
		
		if(role == 1){
			$('#tutRateF').show('slow');
			$('#lngInfId').show('slow');
		   $('#personalInfo').show('slow');
		   $('#regender').show('slow');	
		   $('#loginfo').show('slow');
		   $('#legalinfo').show('slow');
		   $('#imgcont').show('slow');
		   $('#btn').show('slow');
		   
			$('#orgname').hide('slow');
			$('#scode').hide('slow');
		   $('#pcontact').hide('slow');
		   $('#address').hide('slow');
		  // $('#oemail').hide('slow');
		   $('#ozipcode').hide('slow');
		   $('#ophone').hide('slow');
		   $('#payemail').hide('slow');
		   $('#tmarkup').hide('slow');
	  	   $('#updt').hide('slow');	
		}
		if(role == 0)
		{
			$('#tutRateF').hide('slow');
			$('#lngInfId').hide('slow');
			 $('#personalInfo').show('slow');
		   $('#regender').show('slow');	
		   $('#loginfo').show('slow');
		   $('#legalinfo').show('slow');
		   $('#imgcont').show('slow');
			$('#btn').show('slow');
			
		    $('#orgname').hide('slow');
			$('#scode').hide('slow');
		   $('#pcontact').hide('slow');
		   $('#address').hide('slow');
		 //  $('#oemail').hide('slow');
		   $('#ozipcode').hide('slow');
		   $('#ophone').hide('slow');
		   $('#payemail').hide('slow');
		   $('#tmarkup').hide('slow');
		   $('#updt').hide('slow');
		   
			$('#showInfo').empty();
		}
		if(role == 4)
		{
		   $('#tutRateF').hide('slow');
			$('#lngInfId').hide('slow');
		   $('#personalInfo').hide('slow');
		   $('#regender').hide('slow');	
		   $('#loginfo').hide('slow');
		   $('#legalinfo').hide('slow');
		   $('#imgcont').hide('slow');
		   $('#btn').hide('slow');
		   
		   $('#orgname').show('slow');
		   $('#scode').show('slow');
		   $('#pcontact').show('slow');
		   $('#address').show('slow');
		//   $('#oemail').show('slow');
		   $('#ozipcode').show('slow');
		   $('#ophone').show('slow');
		   $('#payemail').show('slow');
		   
		   $('#tmarkup').show('slow');
		   
		   $('#loginfo').show('slow');
		   $('#updt').show('slow');
			$('#showInfo').empty();
		}
		
		if(role == 5)
		{
		
		   $('#tutRateF').hide('slow');
			$('#lngInfId').hide('slow');
		   $('#personalInfo').hide('slow');
		   $('#regender').hide('slow');	
		   $('#loginfo').hide('slow');
		   $('#legalinfo').hide('slow');
		   $('#imgcont').hide('slow');
		   $('#btn').hide('slow');
		   $('#tmarkup').hide('slow');
		   
		   $('#orgname').show('slow');
		   $('#scode').show('slow');
		   $('#pcontact').show('slow');
		   $('#address').show('slow');
		//   $('#oemail').show('slow');
		   $('#ozipcode').show('slow');
		   $('#ophone').show('slow');
		   $('#payemail').show('slow');
		   
		   
		   
		   $('#loginfo').show('slow');
		   $('#updt').show('slow');
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
	//$('#country').change(function(){console.info($(this).val())});//One to get an id; new add

	$('#province').change(function(){
		//$('#changeCh').val($('#province').val());
		var _pid = $(this).val();
		$.get('<?php echo Base_url("user/ajaxAreaCode");?>',{pid:_pid},function(data){
			$('#changeCh').val(data);
		});
	});  

	$('#country').trigger('change');
	$('#hRate').blur(function(){checkRateF();});
	//remove username code by TECHNO-SANJAY
	//$('#username').blur(function(){checkUsernameF(1,false);});
	$('#email').change(function(){checkEmailExists();});
	$('#confirmEmail').blur(function(){checkEmailF();});
	$('#city').blur(function(){checkCityF();});
	//$('#password').blur(function(){checkPasswordF();});
	$('#confirmPassword').blur(function(){checkPasswordF();});

 
	$('#register').click(function(){checkAll();});
	$('#update').click(function(){myfunction();});
     
	
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
			//remove username code by TECHNO-SANJAY
			//$('#username').val(user.username);
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
	} else {
		$(".cell_phone_dl").hide('slow');
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
	$("dt.regci").hover(function () {
		$(this).append('<div class="tooltipci"><p><?php echo $contacttool; ?></p></div>');
	}, function () {
		$("div.tooltipci").remove();
	});
	
	$("dt.tmkp").hover(function () {
	<?php $markup="Tutor Rate is $10.00<br>Organization tutor markup is $5.<br>Student pays $19.95 after TTL 33% uplift.";?>  
		$(this).append('<div class="tooltipm"><p><?php echo $markup; ?></p></div>');
	}, function () {
		$("div.tooltipm").remove();
	});
	
	
	$("dt.ucode").hover(function () {
	<?php $markup="This is a prefix to your unique ID number.";?>  
		$(this).append('<div class="tooltipm"><p><?php echo $markup; ?></p></div>');
	}, function () {
		$("div.tooltipm").remove();
	});

});
</script>


<div class="regist">
	<div class="regist_top">
	<?php
	$arrVal = $this->lookup_model->getValue('7', $multi_lang);
	echo $arrVal[$multi_lang];
	?>
	</div>
	<div class="regist_mid_1">
		
		<!-- remove connection speed test and add graphic banner BY TECHNO-SANJAY -->
		<!--
		<div class="speed">
			<div class="speed_lf">
				<div class="speed_txt_1">Detect Connection Speed</div>
				<div class="speed_txt_2" style="display:none">Click button below to detect your connection speed</div>
				<div class="speed_btn"  style="display:none"><a class="raduisSelect" href="javascript:void(0)"  id="testSpeedButton" doing=0><span class="icon_speed"></span></a></div>
				<div class="speed_txt_3">Your connection speed is <span id="speed"></span>Kbps</div>
				<img src="<?php echo ('images/base/c2_b.png');?>" id="testSpeed" style="display:none"/>
			</div>
			<div class="speed_rt"  style="display:none">
				<div class="speed_txt_1">Device Type</div>
				<select class="raduisSelect">
					<option>PC</option>
				</select>
			</div>
			<div class="speed_txt_note"><b>IMPORTANT: A reliable connection speed of at least 300 Kbps is required to use TheTalkList’s classroom in order to prevent disruption of Vee-sessions.</div>
		</div>
		-->
		<div class="banner">
			<img height="200px" src="<?php echo Base_url('/images/graphicbanners/graphicbanner.jpg' ); ?>" alt="Graphic Banner" />
		</div>
	</div>
	<div class="regist_mid_2" style="border-bottom: 0px solid #EBEBEB;">
		<dl id="showInfo" style="color:red">
		</dl>
		<!--<dl>
			<dt class="w370">Get Referred?  Enter your friend’s account number: </dt>
			<dd><input type="text" class="raduisSelect" placeholder="Account Number" /></dd>
		</dl>-->
		<dl>
			<dt>
			<?php
			$arrVal = $this->lookup_model->getValue('112', $multi_lang);
			echo $arrVal[$multi_lang];
			
			$arrVal = $this->lookup_model->getValue('111', $multi_lang);
			$student =  $arrVal[$multi_lang];
			
			$arrVal = $this->lookup_model->getValue('110', $multi_lang);
			$tutor = $arrVal[$multi_lang];
			?>:</dt>
			<dd> 
				
				<select class="raduisSelect" id="roleId">
					<option value="0" <?php if(@$get['roleId'] == 0 || @$_POST['roleId'] == 0 ) {?>selected<?php }?>><?php echo $student;?></option>
					<option value="1" <?php if(@$get['roleId'] == 1 || @$_POST['roleId'] == 1) {?>selected<?php }?>><?php echo $tutor;?></option>
					<option value="4" <?php if(@$get['roleId'] == 4 || @$_POST['roleId'] == 4) {?>selected<?php }?>><?php echo "School";?></option>
					<option value="5" <?php if(@$get['roleId'] == 5 || @$_POST['roleId'] == 5) {?>selected<?php }?>><?php echo "Affiliate";?></option>
				</select>
			</dd>
		</dl>
		<?php 
		
		if(@$get['roleId'] == 1){
			$tutStyle = "";
			$lngStyle = "";
			$personal='style="clear:both;"';
		}
		if(@$get['roleId'] == 0){
		
			$tutStyle = 'style="display: none"';
			$lngStyle = 'style="display: none"';
			$personal='style="clear:both;"';
		}
		if(@$get['roleId'] == 4){
		$personal = 'style="display: none"';
			
		}
		$arrVal = $this->lookup_model->getValue('516', $multi_lang);
		$ratemin = $arrVal[$multi_lang];
		?>

		<dl id="tutRateF" <?php echo $tutStyle; ?>>
			<dt class="regrt"><span style="float:left;font-weight: bold;color: #0D5782;font-size: 14px;"><?php echo $ratemin; ?>:</span> <img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" /></dt>
			<dd><input type="text" class="raduisSelect" placeholder="$7.50" id="hRate" value="$7.50"/></dd><br><br>
		</dl>
		<dl style="clear:both;">
		</dl>
		
		<dl <?php echo $personal;?> id="personalInfo">
			<dt><?php
	$arrVal = $this->lookup_model->getValue('113', $multi_lang);
	echo $arrVal[$multi_lang];
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lFIRST_NAME;?>:" id="firstName" value="<?php echo $_SESSION['first_name'];?>"/> *</dd>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lLAST_NAME;?>:" id="lastName" value="<?php echo $_SESSION['last_name'];?>"/> *</dd>
			<dd><input type="text" class="raduisSelect w100" placeholder="<?php echo $lAGE;?>:" id="age"/> *</dd>
            </dl>
			
			
			<dl  id="orgname" style="display:none">
			<dt><?php
		echo "Name";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "name";?>:" name="sname" id="firstName"/></dd>
			
            </dl>
			
			<dl style="display:none" id="scode">
			<dt class="ucode">Unique Code:</dt>
	
			<dd><input type="text" class="raduisSelect" placeholder="A123" id="UniqueId" value="<?php echo @$profile['UniqueId'];?>" maxlength='6' onblur="return chkschoolcode();"/></dd>
			
            </dl>
	   <dl>
			
			
			<dl  id="address" style="display:none">
			<dt><?php
		echo "Street Address";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "Street Address";?>:" id="address"/></dd>
			
            </dl>
			
			<dl  id="pcontact" style="display:none">
			<dt><?php
		echo "Principle contact";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "Principle contact";?>:" id="principle_name" maxlength=10/></dd>
			
            </dl>
		
			
			
			
            <dl style="clear:both;" id="regender">
			<dd class="gender"><?php
	$arrVal = $this->lookup_model->getValue('114', $multi_lang);
	echo $arrVal[$multi_lang];
	?>:</dd>
			<dd><span class="male"><input type="radio" name="gender" id="gender1" value="0" <?php if($_SESSION['gender']=='female'){echo 'checked';}?>/>&nbsp;
			<?php
			$arrVal = $this->lookup_model->getValue('115', $multi_lang);
			echo $arrVal[$multi_lang];
			?></span><br />
			<span class="male"><input type="radio" name="gender" id="gender2" value="1" <?php if($_SESSION['gender']=='male'){echo 'checked';}?>/>&nbsp;
			<?php
			$arrVal = $this->lookup_model->getValue('116', $multi_lang);
			echo $arrVal[$multi_lang];
			?></span></dd>
		</dl>
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
				<?php
					//echo form_dropdown('country',$countries,'2',' id="country" class="raduisSelect" ');
//					echo '<pre>';
//					print_r($countries);
//					echo '</pre>';
				?>
				<select name="country" id="country" class="raduisSelect">
				<?php foreach ($countries as $key => $val){?>
     				<optgroup label="<?php echo $key;?>">

					<?php foreach ($val as $k => $v){?>
						<option 
							value="<?php echo $k;?>" 
								<?php if($k==2):?>selected<?php endif; ?>><?php echo $v;?></option>

					<?php }?>
					</optgroup>
				<?php }?>
				</select>
			</dd>
			<dd>
				<select class="raduisSelect" id="province">
					<option>Region</option>
				</select>
			</dd>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lcity; ?>" id="city" /> *</dd>
		</dl>
		<!-- remove timezone pull down BY TECHNO-SANJAY -->
		<!--
		<dl>
			<dt>&nbsp;</dt>
			<dd>
				<!--<?php //echo form_dropdown('timezone',$timezones,'',' class="raduisSelect" id="timezone" ');?>-->
				<?php //echo timezone_menu('UTC',  "raduisSelect",'timezone');?>
				<!--<select class="raduisSelect"><option>Time Zone</option></select>-->
			<!--</dd>
		</dl>
		-->
		<dl  id="ozipcode" style="display:none">
			<dt><?php
		echo "Zipcode";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "Zipcode";?>:" id="zipcode" maxlength=8/> </dd>
			
            </dl>

			
			<dl  id="ophone" style="display:none">
			<dt><?php
		echo "Phone No.";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "Phone No";?>:" id="cell" maxlength=10/> </dd>
			
            </dl>
			
			<dl  id="payemail" style="display:none">
			<dt><?php
		echo "Paypal Email.";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "Paypal Email";?>:" id="payment_account"/> </dd>
			
            </dl>

		
			<dl  id="tmarkup" style="display:none">
			<dt class="tmkp"><?php
		echo "Tutor Markup";
	?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo "xx.xx";?>" id="tutor_markup"/> </dd>
			
            </dl>
		
		
		
		<dl class="tooltip-nw">
			<dt class="regci" id="imgcont">
			<span style="float:left;font-weight: bold;color: #0D5782;font-size: 14px;">
			<?php $arrVal = $this->lookup_model->getValue('122', $multi_lang);
			 echo $arrVal[$multi_lang];
			?>
			:</span>
			<img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" />
			</dt>
			
			<dd class="cell_phone_dl" style="display:none;">
				<input type="text" style="width:80px;" class="raduisSelect" placeholder="XXX" value="" /> <!-- id="changeCh" -->
			</dd>
			<dd class="cell_phone_dl" style="display:none;">
				<input type="text" maxlength="8" class="raduisSelect" placeholder="XXX-XXXX"id="cell" /><em class="ajayhifen">-</em>
			</dd>
			<dd id="legalinfo">
				<input type="text" class="raduisSelect" placeholder="<?php echo $lSOCIAL_PAGE;?>"id="networkPage" />
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
		<!-- update language information code BY TECHNO-SANJAY -->
		<dl id="lngInfId" <?php echo $lngStyle; ?>>
			<dt><?php
			$arrVal = $this->lookup_model->getValue('126', $multi_lang);
			echo $arrVal[$multi_lang];
			?>: </dt>
			<dd>
				<div class="langTitle"><?php
			$arrVal = $this->lookup_model->getValue('127', $multi_lang);
			echo $arrVal[$multi_lang];
			?> *</div>
				<?php echo form_dropdown('nativeLanguage',$langs,'',' id="nativeLanguage" class="textarea_box" multiple="multiple" ');?>
				
				<div class="langInfo"><?php
			$arrVal = $this->lookup_model->getValue('128', $multi_lang);
			echo $arrVal[$multi_lang];
			?></div>
			</dd>
			
	    </dl>
		
	</div>
	<div class="regist_mid_2 regist_mid_3" id="loginfo">
		<dl>
			<dt><?php
			$arrVal = $this->lookup_model->getValue('129', $multi_lang);
			echo $arrVal[$multi_lang];
			?>:</dt>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lEMAIL;?>:" id="email" name="myemail" value="<?php echo $_SESSION['email']?>"/> *</dd>
			<dd><input type="text" class="raduisSelect" placeholder="<?php echo $lCEMAIL;?>:" id="confirmEmail" value="<?php echo @$get['confirmEmail'];?>"/></dd>
		</dl>
		<!-- Remove username input and set to hidden by TECHNO-SANJAY -->
		<!--
		<dl>
			<dt>&nbsp;</dt>
			<dd><input type="text" class="raduisSelect" placeholder="Create Username:" id="username" value="<?php echo @$get['username'];?>"/> *</dd>
		</dl>
		-->
		<input type="hidden" class="raduisSelect" placeholder="Create Username:" id="username" value="<?php echo @$get['username'];?>"/>
		<dl>
			<dt>&nbsp;</dt>
			<dd><input type="password" class="raduisSelect" placeholder="<?php echo $lPASSWORD;?>:" id="password" value="<?php echo @$get['password'];?>"/> *</dd>
			<!--<dd><input type="password" class="raduisSelect" placeholder="Confirm Password:" id="confirmPassword" value="<?php echo @$get['confirmPassword'];?>"/></dd>-->
            <!--<dd><input type="text" class="raduisSelect" value="Confirm Password" onclick="if(this.value='Confirm Password') {this.value=''; this.type='password'};"  id="confirmPassword" value=""/> *</dd>-->
            <dd><input type="password" class="raduisSelect" placeholder="<?php echo $lconfirmpassword;?>:" value="" id="confirmPassword" value=""/> *</dd>
		</dl>
	</div>
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
	?>
	<div class="regist_mid_2 regist_mid_4">
		<div class="checkbox"><input type="checkbox" name="checkbox_terms" id="checkbox_terms" />&nbsp;
			<a href="<?php echo Base_Url('article/terms');?>"><?php echo $terms;?></a><?php /*&nbsp;<?php echo $andagree;?>.*/?>
		</div>
		<div class="checkbox"><input type="checkbox" name="checkbox_privacy" id="checkbox_privacy"  />&nbsp;
			<a href="<?php echo Base_Url('article/privacy');?>"><?php echo $privacy;?></a><?php /*&nbsp;<?php echo $andagreeit;?>*/?>
		</div>
	</div>
	<div class="tr regist_mid_2" style="border-bottom:0px;" id="btn"><input type="button" class="" value="<?php echo $vregister;?>" id="register" /></div>
	<div class="tr regist_mid_2" style="border-bottom:0px;display:none" id="updt"><input type="button" class="" value="<?php echo $vregister;?>" id="update" /></div>
</div>
<style>
dt.regrt {
  cursor: pointer;
  position: relative;
  display: inline-block;
}
div.tooltip {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 113px;
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
}

dt.regci{
  cursor: pointer;
  position: relative;
  display: inline-block;
}
dt.tmkp{
  cursor: pointer;
  position: relative;
  display: inline-block;
}
dt.ucode{
  cursor: pointer;
  position: relative;
  display: inline-block;
}
div.tooltipci {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 125px;
  top: -20px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
  font-size:12px;
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
div.tooltipm {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 125px;
  top: -20px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
  font-size:12px;
}
div.tooltipm:before {
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
div.tooltipm p {
  margin: 10px;
  color: White;
  font-size:14px;
  font-weight:normal;
  line-height:16px;
}

	
#update{background:url(<?php echo base_url();?>images/main/signin_btn.png) no-repeat !important; width:88px; height:43px; text-align:center; color:#FFF; border:0 none !important; padding-bottom:7px !important;font-size:18px;}
</style>