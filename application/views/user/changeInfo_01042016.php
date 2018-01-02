<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang'])){
	$multi_lang = $_SESSION['multi_lang'];
}else{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal 		= $this->lookup_model->getValue('46', $multi_lang);				$lchangecontactinfo				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('35', $multi_lang);				$lemail							= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('124', $multi_lang);			$lcellnumber					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('708', $multi_lang);			$lpaymentaccount				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('139', $multi_lang);			$lnetworkpage					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('136', $multi_lang);			$lcurrentpwd					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('137', $multi_lang);			$lnewpwd						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('138', $multi_lang);			$lconfirmpwd					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('135', $multi_lang);			$lsave   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('46', $multi_lang);				$change_contact_info 			= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('56', $multi_lang);				$lname  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('57', $multi_lang);				$lage  							= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('58', $multi_lang);				$lsex							= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('59', $multi_lang);				$llocation 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('303', $multi_lang);			$lfree_session 					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('47', $multi_lang);				$lprice   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('53', $multi_lang);				$lrating 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('39', $multi_lang);				$first_language 				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('63', $multi_lang);				$second_language 				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('254', $multi_lang);			$llanguage 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('64', $multi_lang);				$laccount 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('255', $multi_lang);			$ltestscore 					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('256', $multi_lang);			$lscore 						= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('257', $multi_lang);			$lfirst 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('258', $multi_lang);			$lcurrent 						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('333', $multi_lang);			$hidemyaccount 					= $arrVal[$multi_lang];$arrVal 		= $this->lookup_model->getValue('451', $multi_lang);	$lSPEAKING_SCORE   		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('434', $multi_lang);			$lNOW   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('435', $multi_lang);			$lNOW_TIP   					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('436', $multi_lang);			$lTRAINING_REQUIREMENTS 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('437', $multi_lang);			$lRE_TEST   					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('456', $multi_lang);			$lCLICK_TO_EDIT   				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('529', $multi_lang);			$lDOUBLECLICK_TO_EDIT   		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('656', $multi_lang);			$l1ST   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('657', $multi_lang);			$l2ND   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('447', $multi_lang);			$lUPLOAD_PICTURE   				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('651', $multi_lang);			$lREQ_APP   					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('650', $multi_lang);			$lCRE_APP   					= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('667', $multi_lang);			$lREQUEST_APPOINTMENT_TIP   	= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('668', $multi_lang);			$lCREATE_APPOINTMENT_TIP   		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('669', $multi_lang);			$lBEEP_BOX_TIP   				= $arrVal[$multi_lang];


$arrVal 		= $this->lookup_model->getValue('483', $multi_lang);			$lP_YES   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('484', $multi_lang);			$lP_NO   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('116', $multi_lang);			$lP_MALE   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('115', $multi_lang);			$lP_FEMALE   					= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('412', $multi_lang);			$lCANCEL   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('702', $multi_lang);			$lPERSONAL   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('64', $multi_lang);				$lACCOUNT   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('703', $multi_lang);			$lCONTACT   						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('704', $multi_lang);			$lFINANCIAL  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('705', $multi_lang);			$lTUTORING  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('121', $multi_lang);			$lCITY  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('119', $multi_lang);			$lSTATE  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('118', $multi_lang);			$lCOUNTRY  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('656', $multi_lang);			$l1ST  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('657', $multi_lang);			$l2ND  						= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('706', $multi_lang);			$lCELL_NUMBER  				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('707', $multi_lang);			$lALINK  				= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('709', $multi_lang); 
$laccountsettings = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('471', $multi_lang); 
$lpassword = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('712', $multi_lang); 
$lfacebooklink = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('726', $multi_lang); 
$lsch = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('896', $multi_lang); 
$pmode = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('897', $multi_lang); 
$moneytransfer = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('898', $multi_lang); 
$creditgrater = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('917', $multi_lang); 
$nolonger = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('918', $multi_lang); 
$rusure = $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('1027', $multi_lang);			$thisEmail  				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('1028', $multi_lang);			$sendlinkto  				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('1029', $multi_lang);			$foreachstu  				= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('1152', $multi_lang);			$AffiEarning  				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('1153', $multi_lang);			$ShareYour  				= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('799', $multi_lang);			$Close  				= $arrVal[$multi_lang];


/* january scope*/

$arrVal = $this->lookup_model->getValue('368', $multi_lang);
$vforwardemail = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('369', $multi_lang);
$vreceiveemailalert = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('370', $multi_lang);
$vreceivesmsalert = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('70', $multi_lang);
$vfminsprior = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('71', $multi_lang);
$vtminsprior = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('72', $multi_lang);
$vsminsprior = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('135', $multi_lang);
$vsave = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1195', $multi_lang);
$messanging = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1196', $multi_lang);
$MessageSaved = $arrVal[$multi_lang];


/* march enh */
$arrVal = $this->lookup_model->getValue('194', $multi_lang);
$Removes = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1223', $multi_lang);
$extschool = $arrVal[$multi_lang];

/* added  31-3-2015 */
$arrVal = $this->lookup_model->getValue('1296', $multi_lang);
$Enterage = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1295', $multi_lang);
$EnteCity = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('252', $multi_lang);
$PayAccount = $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php //print_r($email);





  ?>
<!-- january scope added by haren -->
<script>
jQuery(document).ready(function($) {
        <?php if($profile['alertType'][0] == 0){ ?>
		$("#emailalerttime").attr('disabled', '');
		<?php }
		if($profile['alertType'][1] == 0){ ?>
		$("#textalerttime").attr('disabled', '');
		<?php } ?>
});
		
$(function(){
	
	$('#checkemail').click(function(){		
		var _type = '';
		$('[name=send_type]').each(function(){
			if($(this).is(':checked')){
				_type += '1' ;
			}
			else{
				_type += '0' ;
			}
		})
		if(_type == '00'){
			$("#emailalerttime").attr('disabled', '');
			$("#textalerttime").attr('disabled', '');
		}else if(_type == '01'){
			$("#emailalerttime").attr('disabled', '');
			$("#textalerttime").removeAttr('disabled');
		}else if(_type == '10'){
			$("#emailalerttime").removeAttr("disabled");
			$("#textalerttime").attr('disabled', 'disabled');
		}else if(_type == '11'){
			$("#emailalerttime").removeAttr("disabled");
			$("#textalerttime").removeAttr("disabled");
		}
	})

	$('#checktext').click(function(){		
		var _type = '';
		$('[name=send_type]').each(function(){
			if($(this).is(':checked')){
				_type += '1' ;
			}
			else{
				_type += '0' ;
			}
		})
		if(_type == '00'){
			$("#emailalerttime").attr('disabled', '');
			$("#textalerttime").attr('disabled', '');
		}else if(_type == '01'){
			$("#emailalerttime").attr('disabled', '');
			$("#textalerttime").removeAttr('disabled');
		}else if(_type == '10'){
			$("#emailalerttime").removeAttr("disabled");
			$("#textalerttime").attr('disabled', '');
		}else if(_type == '11'){
			$("#emailalerttime").removeAttr("disabled");
			$("#textalerttime").removeAttr("disabled");
		}
	})

	$('.setAlert').click(function(){
		var _minute = $('.alMin').val();
		var _type = '';
		$('[name=send_type]').each(function(){
			if($(this).is(':checked')){
				_type += '1' ;
			}
			else{
				_type += '0' ;
			}
		})
		if(_type == '0'){
			alert('Please select on type.');
			return;
		}
		$.post('<?php echo base_url('user/editProfile');?>',{alerts:_minute,alertType:_type},function(){
			alert('Email alert confirmed.');
		})
	})
	
	$('#settextAlert').click(function(){
		var _minute = $('.alMin').val();
		var _textminute = $('.alMintext').val();

		var _type = '';
		$('[name=send_type]').each(function(){
			if($(this).is(':checked')){
				_type += '1' ;
			}
			else{
				_type += '0' ;
			}
		})
		if(_type == '0'){
			alert('Please select on type.');
			return;
		}
		$.post('<?php echo base_url('user/editProfile');?>',{alerts:_minute,textalert:_textminute,alertType:_type},function(msg){
			alert('<?php echo $MessageSaved;?>');
			window.location.href="<?php echo base_url();?>user/changeInfo";
		})
	})
	
	$('#forwardpemail').click(function(){
		$('#forwardpemail').each(function(){
			var forwardpemail = 0;
			if(this.checked){forwardpemail = 1;}
			var ddataStringChecked = "forwardpemail="+forwardpemail;
			
			$.ajax({
				url: "<?php echo base_url();?>user/forwardpemailUpdate",
				type: 'POST',
				data: ddataStringChecked,
				dataType: 'json',
				cache: false,
				success: function (msg){
				//alert(msg);
					if(msg.status == 'success')
					{
						//alert(hiddenRole);
						if(forwardpemail == 1){
							alert('Forward beepbox message to personal email is enabled.');
						}else{
							alert('Forward beepbox message to personal email is disabled.');
						}
					}					
				}
			});
		})
	})
});
</script>
<script>
window.onload = function() {

var a="<?php echo $_GET["step"];?>";
var rollId='<?php echo $this->session->userdata('roleId'); ?>'; 
var x='<?php echo $this->session->userdata('firstTimeRegister'); ?>'; 

if(a==6 && a!='' && rollId==0 && x !='')
{
 $('#payment_account').val('Name@mail.com');
 $('#alinks').val('http://www.thetalklist.com/12345');
	
window.scrollTo(0,400);
$('#StudentTour').dialog({
					modal:true,
					width:'300px'
				});
				$('.ui-dialog').wrap('<div class="main_student-popupdiv6"></div>' );
				$('.student-hight6').addClass('highlight6');	
				
				$('#DynamicCall').click();

}



 

if(a ==5 && rollId >=1 && rollId <=3 && x !='')
{
 $('#alinks').val('www.thetalklist.com/12345');
window.scrollTo(0,300);			
$('#firstTour').dialog({
					modal:true,
					width:500,
					resizable:false
					
			});
			$('.ui-dialog').wrap('<div class="main_popupdiv5"></span>' );
			$('.hight-cnt5').hide();
			//$('.cinfo').addClass('highlight6');
			
			$('#DynamicCall').click();
			}
};
function CloseMe()
{
	$('#firstTour').dialog('close');
	
	window.location.href="<?php echo base_url('user/dashboard?step=final');?>";
}

function closestudentTour()
{
	
	window.location.href="<?php echo base_url('user/dashboard?step=final');?>";
}
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<style>
.ui-widget-content{/*border: 4px solid #0087d0;    border-radius: 0 !important;*/ background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}
.closeMe{background: url("<?php echo base_url();?>images/search-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #fff;
    cursor: pointer;
    float: left;
    height: 34px;
    margin-right: 15px;
    text-align: center;
    width: 83px;
	padding-top:10px;
}
</style>
 <div class="baseBox baseBoxBg clearfix">

        <div class="content_main fr">
        	<div class="main_inner">
                <?php //echo profile_menu($linkType,'');?>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle" style="padding-top:0px;"><h2><?php //echo $lchangecontactinfo;?><?php echo $laccountsettings; ?> </h2> </div>
							<?php if(isset($error)):?>
							<div class="info"><?php echo $error;?></div>
							<?php endif;?>
                            <!--raxa 16-01-14 strat-->
                            <div class="pro-settg">
                            	<div class="tab-nav">
                                	<ul>
                                    	<li onClick="showHide('personal');" class="<?php if($currentTab == "personal"){ echo 'active';}?>"><?php echo $lPERSONAL;?></li>
                                        <!--<li onClick="showHide('con2'); hide();"><?php echo $lACCOUNT;?></li>-->
                                        <li onClick="showHide('contact');" class="<?php if($currentTab == "contact"){ echo 'active';}?>"><?php echo $lCONTACT;?></li>
                                        <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2 || $profile['roleId'] == 3 || $profile['roleId'] == 0 )) :?>
										<li id="DynamicCall" onClick="showHide('financial');" class="<?php if($currentTab == "financial"){ echo 'active';}?>"><?php echo $lFINANCIAL;?></li>
                                        <?php endif;?>
										<?php if($profile['roleId'] == 0):?>
										<li onClick="showHide('language');" class="<?php if($currentTab == "language"){ echo 'active';}?>"><?php echo $llanguage;?></li>
										<?php else:?>
										<li onClick="showHide('language');" class="<?php if($currentTab == "language"){ echo 'active';}?>"><?php echo $lTUTORING;?></li>
										<?php endif;?>
                                        <li onClick="showHide('password');" class="<?php if($currentTab == "password"){ echo 'active';}?>"><?php echo $lpassword; ?></li>
										
										 <li onClick="showHide('messaging');" class="<?php if($currentTab == "messaging"){ echo 'active';}?>"><?php echo $messanging; ?></li>
                                         <!-- Added by Ilyas -->
										 <?php if($this->session->userdata('roleId')==0){?>
                                         <li onClick="showHide('role');" class="<?php if($currentTab == "role"){ echo 'active';}?>"><?php 
										 $arrVal = $this->lookup_model->getValue('1247', $multi_lang);
										 $lblRole=$arrVal[$multi_lang];
										 echo $lblRole; ?></li>
										 <?php }?>
                                         <!-- End -->
                                    </ul>
                                </div>
                                <div class="tab-cnt">
								
<form name="cancelInfoFrm" id="cancelInfoFrm" action="<?php echo Base_url('user/changeInfo');?>" method="POST">
</form>								
								
								
								<?php //echo $currentTab;?>
								
								
                                	<div class="sub-cnt" id="personal" style="display:<?php if($currentTab == "personal"){ echo 'block';}else{ echo 'none';}?>;">
									<form action="<?php echo Base_url('user/changeInfo');?>" method="POST" onsubmit="return validateFormCon1();">
                                    	<div class="cnt-rw">
                                        	<label><?php echo $lname;?>:</label>
                                            <input autocomplete="off"  name="name" id="name" type="text" value="<?php echo $profile['firstName'];?> <?php echo $profile['lastName'];?>"/>
                                        </div>
                                        <div class="cnt-rw">
                                        	<label><?php echo $lage;?>:</label>
                                            <input autocomplete="off"  placeholder="<?php echo $Enterage;?>" name="age" id="age" type="text" value="<?php echo $profile['age'];?>"/>
                                        </div>
                                        <div class="cnt-rw">
                                        	<label><?php echo $lsex;?>:</label>
                                            <!--<input type="text" value="Female"/>-->
											<select name="gender"  id="gender01">
											<option value="1" <?php if($profile['gender'] == 1){ echo 'SELECTED="SELECTED"';}?>><?php echo $lP_MALE;?></option>
											<option value="0" <?php if($profile['gender'] == 0){ echo 'SELECTED="SELECTED"';}?>><?php echo $lP_FEMALE;?></option>
											</select>
                                        </div>
                                        <!--<div class="cnt-rw">
                                        	<label><?php echo $llocation;?>:</label>
                                            <input name="address" type="text" value="<?php echo $profile['address'];?>"/>
                                        </div>-->
										<div class="cnt-rw">
                                        	<label><?php echo $lCOUNTRY;?>:</label>
                                            <!--<input name="country" type="text" value="<?php 	echo @$countries[$profile['country']];?>"/>-->
											<select name="country" id="country">
												<option value="0" <?php echo ($profile['country']=="0") ? 'selected' : '';?>> </option>
											<?php foreach ($countries as $key => $val){?>
											<option value="<?php echo $key;?>" <?php echo ($profile['country']==$key) ? 'selected' : '';?>><?php echo $val;?></option>
											<?php }?>
											</select>
									   </div>
										
                                        <div class="cnt-rw" style="disaply:<?php if($profile['country'] ==2 ){ echo 'block;';}else{ echo 'none;';}?>" id="proDropDown">
                                        	<label><?php echo $lSTATE;?>:</label>
                                            <!--<input name="province"  id="province" type="text" value="<?php echo @$province[$profile['country']][$profile['province']];?>"/>-->
											<select  id="province" name="province">
												<option>Region</option>
											</select>
										</div>
										<input type="hidden" name="provinceid" id="provinceid" value="">
										<div class="cnt-rw">
                                        	<label><?php echo $lCITY;?>:</label>
                                            <input autocomplete="off"   name="city"  placeholder="<?php echo $EnteCity;?>" id="city" type="text" value="<?php echo @$profile['city'];?>"/>
                                        </div>

										<div class="cnt-rw">
                                        	<label><?php echo "TimeZone :";?></label>
                                           
											<select name="timezone" id="timezone">
											 
											<?php for($i=0;$i<count($timezone);$i++) { ?>
												
											<option value="<?php echo $timezone[$i]['timezone'];?>" <?php if($profile['timezone'] == $timezone[$i]['timezone']){?>  selected <?php } ?>>   <?php echo "(GMT".$timezone[$i]['diff'].") ".$timezone[$i]['name']." (".$timezone[$i]['timezone'].")" ;?></option>
											<?php } ?>
											</select>
									   </div>
										<div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="personal">
									</form>
                                    </div>
                                    <!--<div class="sub-cnt" id="con2">
									<form action="<?php echo Base_url('user/changeInfo');?>" method="POST" onsubmit="return validateFormCon2();">
                                    	<div class="cnt-rw">
                                        	<label><?php echo $lcellnumber;?>:</label>
                                            <input autocomplete="off"   name="cell_number" id="cell_number" type="text" value="<?php echo $profile['cell'];?>"/>
                                        </div>
                                        <div class="cnt-rw">
                                        	<label><?php echo $lcurrentpwd;?>:</label>
                                            <input autocomplete="off"   name="password" type="password" value="" id="password"  placeholder="******" />
                                        </div>   
										<div class="cnt-rw">
                                        	<label><?php echo $lnewpwd;?>:</label>
                                            <input autocomplete="off"   name="new_password" type="password" value="" id="new_password"  placeholder="******" />
                                        </div>

                                        <div class="cnt-rw">
                                        	<label>	<?php echo $lconfirmpwd;?>:</label>
                                            <input autocomplete="off"   name="new_password2" type="password" value="" id="new_repassword2"  placeholder="******" /> 
                                        </div>
                                        <div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="col2">
									</form>
									</div>-->
                                    
                                    <div class="sub-cnt" id="contact" style="display:<?php if($currentTab == "contact"){ echo 'block';}else{ echo 'none';}?>;">
									<form action="<?php echo Base_url('user/changeInfo');?>" method="POST"  onsubmit="return validateFormCon3();">
                                    	<div class="cnt-rw">
                                        	<label><?php echo $lemail;?>:</label>
                                            <input autocomplete="off"   type="text" value="<?php echo $profile['email'];?>" id="email1" name="email1" disabled="disabled"/> 
                                        </div>
                                        <div class="cnt-rw">
                                        	<label><?php echo $lCELL_NUMBER;?>:</label>
											
                                            <input autocomplete="off"   type="text" value="<?php echo $profile['cell'];?>" id="cell" name="cell" placeholder="+xx xxxx xxxxx" />  
                                        </div>
                                        <div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="contact">
									</form>
									</div>
                                    <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2   || $profile['roleId'] == 3 || $profile['roleId'] == 0) ) :?>
									<div class="sub-cnt" id="financial" style="display:<?php if($currentTab == "financial"){ echo 'block';}else{ echo 'none';}?>;">
									<form action="<?php echo Base_url('user/changeInfo');?>" method="POST"  onsubmit="	">
                                    	<?php if($profile['roleId'] !=0){?>
										<div class="cnt-rw">
                                        	<label><?php echo $lsch;?>:</label>
                                            <input disabled="disabled" autocomplete="off" name="school"  id="school" type="text" value="<?php echo $sname;?>"/>
											<?php if($sname !=''){?>
											<a id="exitschool" class="exitschool"   href="#" style="cursor:pointer;" onclick="deltutor(<?php echo $profile['uid']; ?>);">
												<input type="button" value="<?php echo $Removes;?>" style="float:right;margin-top:-24px;" class="st-btn"> 
											</a>
											<?php }?>
                                        </div>
										
                                        <div class="cnt-rw">
                                        	<label><?php echo $lfree_session;?>:</label>
                                            <select name="free_session" id="free_session">
											<option value="y" <?php if($profile['free_session'] == 'y'){ echo 'selected="SELECTED"';};?>><?php echo $lP_YES;?></option>
											<option value="n" <?php if($profile['free_session'] == 'n'){ echo 'selected="SELECTED"';};?>><?php echo $lP_NO;?></option>
											</select>
											<!--<input autocomplete="off"   name="free_session" type="text" value="<?php echo (@$free_session[$profile['free_session']]=='y'?$lP_YES:$lP_NO);?>"/>--> 
                                        </div>
										
                                        <div class="cnt-rw">
                                        	<label><?php echo $lprice;?>  ( US $/25min ):</label>
                                            <input autocomplete="off"   name="hRate"  id="hRate" type="text" value="<?php echo  $profile['hRate'];?>"/>
                                       </div>
									   <?php }?>
                                       <div class="student-hight6">
                                        <div class="cnt-rw">
                                        	<label class="payment_account"><?php echo $lpaymentaccount;?>:</label>
                                            <input type="text" value="<?php echo $profile['payment_account'];?>" id="payment_account" placeholder="<?php echo $PayAccount;?>" name="payment_account" /> 
                                        </div>
										<div class="cinfo">
                                        <div class="cnt-rw high-cnt-chin">
                                        	<label class="fbspanshare"><?php echo $lALINK;?>:</label>
											
                                            <input id="alinks" autocomplete="off" disabled="disabled"  name="a_link" type="text" value="<?php  echo str_replace(" ","-",$encode);?>"/> 
                                        </div></div>
                                        </div>
										 <?php if($profile['roleId'] ==0){?>
										<!--<div class="cnt-rw">
                                        	<label class="payment-mode"><?php echo $pmode;?>:</label>
											<div class="payinput"><p><input class="sm-input" type="radio" checked  name="payment_type" <?php if($profile['payment_type'] == 'paypal'){ echo "checked";}?> value="paypal" ><?php echo $moneytransfer;?></p><br>
                                           <p> <input   class="sm-input" type="radio" name="payment_type"  <?php if($profile['payment_type'] == 'credits' || $profile['payment_type']==''){ echo "checked";}?> value="credits"><?php echo $creditgrater;?></p></div>
                                        </div>-->
										<?php }?>
                                        <div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="financial">
									</form>
								   </div>
								   <?php endif;?>
                                    <div class="sub-cnt" id="language" style="display:<?php if($currentTab == "language"){ echo 'block';}else{ echo 'none';}?>;">
									<form action="<?php echo Base_url('user/changeInfo');?>" method="POST"  onsubmit="return validateFormCon5();">
                                    	<?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) :?>
										<div class="cnt-rw">
                                        	<label><?php echo $lrating;?>:</label>
                                            <div class="ratings_score_b" id=""><s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>"></s></div>
                                        </div>
										<?php endif;?>
										
                                        <div class="cnt-rw">
                                        	<label><?php echo $l1ST;?> <?php echo $first_language;?>:</label>
                                            <!--<input autocomplete="off"   id="nativeLanguage" name="nativeLanguage" type="text" value="<?php echo $profile['nativeLanguage'];?>">-->
											<?php echo form_dropdown('nativeLanguage',$langs,$profile["nativeLanguage"],' id="nativeLanguage" class="textarea_box" " ');?>

										
										</div>
                                        <div class="cnt-rw">
                                        	<label><?php echo $l2ND;?> <?php echo $first_language;?>:</label>
                                            <!--<input autocomplete="off"   id="otherLanguage" name="otherLanguage" type="text" value="<?php echo $profile['otherLanguage'];?>">-->
											<?php echo form_dropdown('otherLanguage',$langs,$profile["otherLanguage"],' id="otherLanguage" class="textarea_box" " ');?>
                                        </div>
                                        <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) :?>
                                        <div class="cnt-rw">
                                        	<label><?php echo $hidemyaccount;?>:</label>
                                            <input autocomplete="off"   name="hiddenRole" id="hiddenRole" type="checkbox" class="chek-bx" value="1" <?php if(@$profile['hiddenRole']=='1'){echo 'checked';} ?>>
                                        </div>
										<?php endif;?>
                                        <div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="language">
									</form>
								   </div>
                                   <div class="sub-cnt" id="password" style="display:<?php if($currentTab == "password"){ echo 'block';}else{ echo 'none';}?>;">
										<form action="<?php echo Base_url('user/changeInfo');?>" method="POST" onsubmit="return validateFormCon2();">
										<div class="cnt-rw">
                                        	<label><?php echo $lnewpwd;?>:</label>
                                            <input autocomplete="off"   name="new_password" type="password" value="" id="new_password"  placeholder="******" />
                                        </div>

                                        <div class="cnt-rw">
                                        	<label>	<?php echo $lconfirmpwd;?>:</label>
                                            <input autocomplete="off"   name="new_password2" type="password" value="" id="new_repassword2"  placeholder="******" /> 
                                        </div>
                                        <div class="cnt-rw no-brd">
                                        	<label>&nbsp;</label>
                                            <input type="submit" value="<?php echo $lsave;?>" class="st-btn"> <input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();">
                                        </div>
									<input type="hidden" name="profile_tab" value="password">
									</form>
									</div>
									
									 <?php
					$sendType1 = $profile['alertType'][0];
					$sendType2 = $profile['alertType'][1];
				?>
							   <div class="sub-cnt" id="messaging" style="display:<?php if($currentTab == "messaging"){ echo 'block';}else{ echo 'none';}?>;">
			  <div class="bd">							
							<table class="history_table f14" border=0>							
								<tr>
                                <td align="right" width="10px;">
								<input style="margin-top:6px;" type="checkbox" name="forwardpemail" id="forwardpemail" value="1" <?php if(@$profile['forwardemail']=='1'){echo 'checked';} ?> /></td>
                                <td><?php echo $vforwardemail; ?></td>
                                <td>&nbsp;</td>
                                </tr>
								<tr>
									<td align="right" width="10px;">
										<input type="checkbox" name="send_type" <?php if($sendType1==1) {echo 'checked';}?> class="vAgn_m" id="checkemail" value="1"/>
									</td>
									<td><?php echo $vreceiveemailalert; ?></td>
									<td>
										<div class="addBtn_Wp" >
										<select class="raduisSelect w160 noMg fb alMin" id="emailalerttime">
											<option value="15" <?php if($profile['alerts'] == '15') {echo "selected";}?> ><?php echo $vfminsprior; ?></option>
											<option value="30" <?php if($profile['alerts'] == '30') {echo "selected";}?> ><?php echo $vtminsprior; ?></option>
											<option value="60" <?php if($profile['alerts'] == '60') {echo "selected";}?> ><?php echo $vsminsprior; ?></option>
										</select>
										<!--<a class="norBtn blackRadiusBtn w55 setAlert" href="javascript:;">Set</a>-->
										</div>
									</td>
								</tr>
								<tr>
									<td align="right" width="10px;">
										<input type="checkbox" name="send_type" <?php if($sendType2==1) {echo 'checked';}?> class="vAgn_m" id="checktext" value="2"/>
									</td>
									<td><?php echo $vreceivesmsalert; ?></td>
									<td>
										<div class="addBtn_Wp">
										<select class="raduisSelect w160 noMg fb alMintext" id="textalerttime">
											<option value="15" <?php if($profile['textalert'] == '15') {echo "selected";}?> ><?php echo $vfminsprior; ?></option>
											<option value="30" <?php if($profile['textalert'] == '30') {echo "selected";}?> ><?php echo $vtminsprior; ?></option>
											<option value="60" <?php if($profile['textalert'] == '60') {echo "selected";}?> ><?php echo $vsminsprior; ?></option>
										</select>
										<!--<a class="norBtn blackRadiusBtn w55 settextAlert" href="javascript:;">Set</a>-->
										</div>
									</td>
								</tr>
								<tr>
								<td style="background:none;" colspan="3"><a class="save-btn msg-st-btn"  style="cursor:pointer;margin-right:20px !important;" onclick="cancelInfo();"><?php echo $lCANCEL;?></a>
								<a class="save-btn msg-st-btn"   style="cursor:pointer;margin-right:20px !important;" href="javascript:;" id="settextAlert"><?php echo $vsave;?></a></td>
								 
								</tr>
							</table>
                        </div>
									</div>
                       <!-- Added by Ilyas -->
                       <?php 
					   if($this->session->userdata('roleId')==0)
					   {
						   $arrVal = $this->lookup_model->getValue('1233', $multi_lang);$MEMBERSHIP_TYPE = $arrVal[$multi_lang];
						   $arrVal = $this->lookup_model->getValue('1234', $multi_lang);$MEMBERSHIP_TYPE_BRONZE = $arrVal[$multi_lang];
						   $arrVal = $this->lookup_model->getValue('1235', $multi_lang);$MEMBERSHIP_TYPE_STUDENT = $arrVal[$multi_lang];
						   ?>
						   <div class="sub-cnt" id="role" style="display:<?php if($currentTab == "role"){ echo 'block';}else{ echo 'none';}?>;">
							<div class="bd">
								<form action="<?php echo Base_url('user/changeInfo');?>" method="post">
								<table class="history_table f14" border=0>
									<tr>
										<td align="left">
											<label><?php echo $MEMBERSHIP_TYPE;?>:</label>
										</td>
										<td style="padding:0px;"><input type="radio" name="universal_roleId" <?php echo ($profile['universal_roleId']==0) ? "checked" : "";?> class="vAgn_m" id="universal_roleId2" value="0"/>&nbsp;<label for="universal_roleId2"><?php echo $MEMBERSHIP_TYPE_STUDENT;?></label></td>
									</tr>
									<tr>
										<td align="left">&nbsp;
											
										</td>
										<td style="padding-left:0px;padding-right:0px;"><input type="radio" name="universal_roleId" <?php echo ($profile['universal_roleId']==1) ? "checked" : "";?> class="vAgn_m" id="universal_roleId1" value="1"/>&nbsp;<label for="universal_roleId1"><?php echo $MEMBERSHIP_TYPE_BRONZE;?></label></td>
									</tr>
								</table>
								<div class="cnt-rw no-brd">
									<input type="hidden" name="profile_tab" value="role">
									<label>&nbsp;</label>
									<input type="submit" value="<?php echo $lsave;?>" class="st-btn" />
									<input type="button" value="<?php echo $lCANCEL;?>" class="st-btn" onclick="cancelInfo();" />
								</div>
                            </form>
                         </div>
						</div>
					   <?php }?>	
                        <!-- End By Ilyas -->
									
                                </div>
                            </div>
                            <!--raxa 16-01-14 end-->
                            
							<!--<form method="post" id="changeForm">
                            <div class="inbox_mod">

                                <div class="inbox_list inbox_tle">
                                    <label style="width:200px"><?php echo $lemail;?>:</label>
                                    <input style="width:450px" type="text" class="inbox_ipt_text c037898" value="<?php echo $email;?>" id="email1" name="email1" placeholder="Email"/> 
									
                                    <span></span>
                                </div>
                            	<div class="inbox_list inbox_tle">
                                	<label style="width:200px"><?php echo $lcellnumber;?>:</label>
                                    <input style="width:450px" type="text" class="inbox_ipt_text c037898" value="<?php echo $profileOwn['cell'];?>" id="cell" name="cell" placeholder="XXX-XXX-XXXX" /> 
									<span></span>
                                </div>
								<?php if(($roleid == 1 || $roleid == 2) ) {?>
								<div class="inbox_list inbox_tle">
									<label style="width:200px">Paypal Email:</label>
									<input style="width:450px" type="text" class="inbox_ipt_text c037898" value="<?php echo $profileOwn['payment_account'];?>" id="payment_account" name="payment_account" />
									<span></span>
								</div>
								<?php }?>
                                <div class="inbox_list inbox_subject">
                                	<label style="width:200px"><?php echo $lnetworkpage;?>:</label>
                                    <input style="width:450px" type="text" class="inbox_ipt_text c037898" name="networkPage" value="<?php echo $profileOwn['networkPage'];?>" id="networkPage" placeholder="Network Page like:http://www.facebook.com/talklist" /> 
                                </div>
                              
                                <div class=" inbox_subject">
                                	<label style="width:200px"><?php echo $lnewpwd;?>:</label>
                                    <input style="width:450px" type="password" class="inbox_ipt_text c037898" value="" id="password" name="password" placeholder="******" /> 
                                </div>
								<div class=" inbox_subject">
                                	<label style="width:200px"><?php echo $lconfirmpwd;?>:</label>
                                    <input style="width:450px" type="password" class="inbox_ipt_text c037898" value="" id="repassword" name="repassword" placeholder="******" /> 
                                </div>
                                
                            </div>
							<div class="agnR">
                                    <a href="#" class="norBtn blackRadiusBtn w96 aqua_btn" id="send"><?php echo $lsave;?></a>
                            </div>
							</form>-->
							
							
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<div id="firstTour" title="" style="display:None;">
			 <div class="popup-step tutoe-step5">
            	<div class="step-div-bg" style="">
                <span class="popup-no">5</span>
                	<div class="ratelist popup-row" >
				<p style="margin: 0 !important;"><span class="title" style="float:left"><?php echo $ShareYour;?></span>  </p>
 				<p class="clearer" style="margin:0 0 0px !important"></p>
			</div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('user/dashboard?step=1');?>">1</a></span></li>
                            <li><span><a href="<?php echo base_url('user/calendar/uid/'.$this->session->userdata('uid').'?step=2');?>">2</a></span></li>
                           <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=3');?>">3</a></span></li>
                            <li><span><a href="<?php echo base_url('user/account?step=4');?>">4</a></span></li>
                            <li class="active"><span><a href="">5</a></span></li>
                        </ul>
                    </div>
            		<a  class="closeMe" style="color:white;" onclick="CloseMe();"><?php //echo $Close;?>Next</a>
                </div>
            </div>
            <div class="hight-cnt5" style="width:700px;height:45px;margin:90px 0 !important">&nbsp;</div>
		</div>
		
		
		<div id="StudentTour" title="" style="display:None;">
            <div class="popup-step student-step6">
            	<div class="step-div-bg">
                	<span class="popup-no">6</span>
                    <div class="ratelist popup-row">
                        <span class="title" style="float:left"><?php echo $AffiLearning;?></span>  
                    </div>
                    <div class="ratelist popup-row">
                        <p><span class="title" style="float:left;line-height:16px;"><?php echo $ShareYour;?></span>  </p>
                        <p class="clearer"></p>
                    </div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('search/search?step=1');?>">1</a></span></li>
                            <li><span><a href="<?php echo base_url('user/profile/uid/12512?step=2');?>">2</a></span></li>
                            <li><span><a href="<?php echo base_url('user/profile/uid/12512?step=3');?>">3</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=4');?>">4</a></span></li>
                            <li><span><a href="<?php echo base_url('user/account?step=5');?>">5</a></span></li>
                            <li class="active"><span><a href="<?php echo base_url('user/changeInfo?step=6');?>">6</a></span></li>
                        </ul>
                    </div>
            		<a onclick="closestudentTour();"> <?php //echo $StepSix;?>Next</a>
                </div>
            </div>
		</div>
		
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#provinceid').val(<?php echo $profile['province']; ?>);
	});

function showHide(d){
	
	self.location.href = "<?php echo base_url("/user/changeInfo?tab=");?>"+d;
 /*var div = document.getElementById(d);
 
 if (showHide.div&&div!=showHide.div){
  //showHide.div.style.display='none';
  var rx = '#'+showHide.div.id;
	$(rx).hide('');
 }
  if(div.style.display == 'block')
  {
	  var divid = '#'+d;
	  $(divid).show('');
  }else
  {
	  var divid = '#'+d;
	  $(divid).show('');	
  }
 //div.style.display = div.style.display != 'block'?'block':'none';
 showHide.div=div;
 */
}
function hide(){
		$('#personal').hide();
}
</script>

	<script>
	function checkPassword(){
		var _password = $('#password').val();
		if(_password==''){
			return true;
		}
		if(_password.length<5 || _password.length>16){
			alert('The password length can not be less than 5 or more than 16!');
			return false;
		}
		if(_password != $('#repassword').val()){
			alert('The Confirm Password is not same as password.');
			return false;
		}
		return true;
	}
	function checkEmail(){
		var patrn = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i;
		var payment_account = $("#email1").val();
		if(!patrn.exec($.trim(payment_account))){
			alert('Invalid E-mail address');
			return false;
		}
		return true;
	}
	function isValidPhone(val){
		/*if(val != ""){
			var phone = val;
		}else{
			var phone = $("#cell").val();
		}
		var phone = $("#cell").val();
		var regex = /^\d{3}-?\d{3}-?\d{4}$/g
		//var regex = /^\d{3}-?\d{3}-?\d{6}$/g
		if(regex.test(phone)){
			return true;
		}else{
			alert('Invalid Cell Number');
			return false;
		}*/
	}

	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		$('#send').click(function(){
			if(checkPassword() && checkEmail() && isValidPhone()){
			//if(checkPassword()){
				$('#changeForm').submit();
			}
		});
        
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
		
		
		  $('#cell').focus(function(){
            
				$(this).val('<?php echo $profile['cell'];?>');
			 
        })
	})
	
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
				//$('#provinceid').html(key);
				if(key == "<?php echo $profile['province'];?>"){
					var option = $('<option />').attr('selected','selected').append(provices[key]);
				}
				var currCountry = "<?php echo $profile['province'];?>";
				$('select#province').append(option);
			}
			
			//--R&D@Dec-05 : Toggle State
			if(_cid == 2){
				$('select#province').show();
				$('#proDropDown').show();
			}else{
				$('select#province').hide();
				$('#proDropDown').hide();
				
			}
			//--R&D@Dec-05 : Toggle State
		});
		$.get('<?php echo Base_url("user/ajaxCountryCode");?>',{cid:_cid},function(data){
			$('#changeC').val(data);
		});
	});
	
	$('#country').trigger('change');
	$('#province').change(function(){
		var _pid = $(this).val();
		$('#provinceid').val(_pid);
		$.get('<?php echo Base_url("user/ajaxAreaCode");?>',{pid:_pid},function(data){
		/*alert(data);
			$('#provinceid').val(data);*/
		});
	}); 
	function cancelInfo(){
	 window.location.href="<?php echo base_url('user/dashboard');?>";
		//$('#cancelInfoFrm').submit();
	}
	function validateFormCon1(){
		var FC1name 				= $("#name").val();
		var FC1age 					= $("#age").val();
		var FC1gender 				= $("#gender01").val();
		var FC1city 				= $("#city").val();
		var FC1province 			= $("#province").val();
		var FC1country 				= $("#country").val();
		
		var alpha = /^[A-Za-z\s]+$/; 
		var numbers = /^[-+]?[0-9]+$/;  
		if(FC1age != ""){
			if(!FC1age.match(numbers)){
				alert('Please enter number only');
				window.location.href = window.location.href;
			}
		}
		
		if(FC1age < 13){
			alert('Age cannot be less than 13. Use of TheTalkList requires permission of an adult.');
			window.location.href = window.location.href;
			return false;
		}
		if(FC1age > 100){
			alert('Age cannot be greater than 100.');
			window.location.href = window.location.href;
			return false;
		}
		if(!FC1city.match(alpha)){
			alert('Enter alphabetical characters only.');
			window.location.href = window.location.href;
			return false;
		}
		
		
		
		
		return true;
	}
	function validateFormCon2(){
		//var FC2cell_number 			= $("#cell_number").val();
		var FC2password 			= $("#password").val();
		var FC2new_password 		= $("#new_password").val();
		var FC2new_repassword2 		= $("#new_repassword2").val();
		//if(isValidPhone(FC2cell_number) == false){ return false;}
		return true;
	}
	function validateFormCon3(){
		var FC3email1 				= $("#email1").val();
		var FC3cell 				= $("#cell").val();
		var FC3networkPage 			= $("#networkPage").val();
		if(isValidPhone(FC3cell) == false){ return false;}
		return true;
	}
	function validateFormCon4(){
		var FC4hRate 				= $("#hRate").val();
		var FC4payment_account 		= $("#payment_account").val();		
		return true;
	}
	function validateFormCon5(){
		var FC5nativeLanguage 		= $("#nativeLanguage").val();
		var FC5otherLanguage 		= $("#otherLanguage").val();
		return true;
	}
	
	
		$("label.fbspanshare").hover(function () {
			$(this).append('<span class="tooltip"><p><?php echo $sendlinkto;?> </p></span>');
		}, function () {
			$("span.tooltip").remove();
		});
		
		$("a.exitschool").hover(function () { 
			$(this).append('<span class="tooltip"><p><?php echo $extschool;?> </p></span>');
		}, function () {
			$("span.tooltip").remove();
		});
		
		$("label.payment-mode").hover(function () {
			$(this).append('<span class="tooltip"><p><?php echo $foreachstu;?> </p></span>');
		}, function () {
			$("span.tooltip").remove();
		});

		$("label.payment_account").hover(function () {
			$(this).append('<span class="tooltip-pay"><p><?php echo $thisEmail;?></p></span>');
		}, function () {
			$("span.tooltip-pay").remove();
		});
	</script>
	
	<script>
	
function deltutor(uid,sid)
{

var a= confirm("<?php echo $rusure; ?>");
if(a)
{
   var cupdate = uid;
   

			cupdate ='uid='+cupdate;
				$.ajax({
					  type:'POST',
					  data:cupdate,
					  url:'<?php echo base_url('user/exitschool/');?>',
					  success:function(msg){
					  
					  if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
					  if(json.success){
					  
    
// $('#hdivadd').hide('slow');
 alert('<?php echo $nolonger;?>');
 location.reload(); 
         // var url = '<?php echo base_url('user/account/');?>';  
	        //$('#test').load(url); 
					  }
					  else
					  {
					  alert('Problem with deleting from school');
					  }
					  
					  } 
				});
}
}
	
	</script>
   <style>
   label.fbspanshare {
  cursor: pointer;
  display: inline-block;
  color: White;
  border-radius: 0px;
  position: relative; margin-left:0px;
}
label.fbspanshare img {
  vertical-align : middle;
}
a.exitschool
{
  cursor: pointer;
  display:  block;
  color: White;
  border-radius: 0px;
  position: relative; margin-left:0px;
}
a.exitschool img {
  vertical-align : middle;
}
label.payment-mode {
  cursor: pointer;
  display: inline-block;
  color: White;
  border-radius: 0px;
  position: relative; margin-left:0px;
}
label.payment-mode img {
  vertical-align : middle;
}

span.tooltip {
  background-color: #3399cc;
  color: White;
  position: absolute;
  right:99px;
  top: -33px;
  z-index: 1000000;
  width: 150px;
  border-radius: 5px;
}
span.tooltip:before {
  border-color: transparent #3399cc transparent transparent;
  /*border-left: 6px solid #037898;*/
 /* border-style: solid;*/
  border-width: 6px 6px 6px 0px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
  position: absolute;
  top: 40%;
  left:-6px;
}
span.tooltip p {
  margin: 10px;
  color: White; font-size:12px; text-shadow:none; line-height:16px; font-weight:bold;
}

label.payment_account {
  cursor: pointer;
  display: inline-block;
  color: White;
  border-radius: 0px;
  position: relative; margin-left:0px;
}
label.payment-mode img {
  vertical-align : middle;
}
span.tooltip-pay {
  background-color: #037898;
  color: White;
  position: absolute;
  left:130px;
  top: -24px;
  z-index: 1000000;
  width: 150px;
  border-radius: 5px;
}
span.tooltip-pay:before {
  border-color: transparent #037898 transparent transparent;
 /* border-left: 6px solid #037898;*/
  border-style: solid;
   border-width: 6px 6px 6px 0px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
  position: absolute;
  top: 40%;
  left:-6px;
}
span.tooltip-pay p {
  margin: 10px;
  color: White; font-size:12px; text-shadow:none; line-height:16px; font-weight:bold;
}

.sm-input{ width:50px !important;}
</style>