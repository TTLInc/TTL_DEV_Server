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
$arrVal = $this->lookup_model->getValue('326', $multi_lang);
$lmsgsettings = $arrVal[$multi_lang];
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
?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");
?>
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
			alert('Message settings have been saved.');
			window.location.href="<?php echo base_url();?>user/inbox";
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
 <div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr">
        	<div class="main_inner">
                
                <?php echo profile_menu($linkType,'i_prof');?>
               <?php
					$sendType1 = $profile['alertType'][0];
					$sendType2 = $profile['alertType'][1];
				?>
                <!--/student_prof-->
				<div id="student_prof_Wp">
                    <div class="mod">
                        
                            <div class="content tle"><h2><?php echo $lmsgsettings;?></h2></div>
                       
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
								<tr><td style="background:none;" colspan="3"><a class="save-btn msg-st-btn" href="javascript:;" id="settextAlert"><?php echo $vsave;?></a></td></tr>
							</table>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<div id="dialog1" title="Confirm" style="display:none">
		<p>Are you sure you want to delete it?</p>
	</div>
    <style>
	.read0 td a{color:#000;}
    .redRadiusBtn2 { padding:0 10px;}
	
    </style>
