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
$arrVal = $this->lookup_model->getValue('46', $multi_lang);
$change_contact_info = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('56', $multi_lang);
$lname  = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('57', $multi_lang);
$lage  = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('58', $multi_lang);
$lsex	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('59', $multi_lang);
$llocation = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('303', $multi_lang);
$lfree_session = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('47', $multi_lang);
$lprice   = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('53', $multi_lang);
$lrating = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('39', $multi_lang);
$first_language = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('63', $multi_lang);
$second_language = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('254', $multi_lang);
$llanguage = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('64', $multi_lang);
$laccount = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('255', $multi_lang);
$ltestscore = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('256', $multi_lang);
$lscore = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('257', $multi_lang);
$lfirst = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('258', $multi_lang);
$lcurrent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('333', $multi_lang);
$hidemyaccount = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('451', $multi_lang);	$lSPEAKING_SCORE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('434', $multi_lang);	$lNOW   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('435', $multi_lang);	$lNOW_TIP   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('436', $multi_lang);	$lTRAINING_REQUIREMENTS = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('437', $multi_lang);	$lRE_TEST   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('456', $multi_lang);	$lCLICK_TO_EDIT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('529', $multi_lang);	$lDOUBLECLICK_TO_EDIT   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('656', $multi_lang);	$l1ST   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('657', $multi_lang);	$l2ND   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('447', $multi_lang);	$lUPLOAD_PICTURE   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('651', $multi_lang);	$lREQ_APP   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('650', $multi_lang);	$lCRE_APP   				= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('667', $multi_lang);	$lREQUEST_APPOINTMENT_TIP   = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('668', $multi_lang);	$lCREATE_APPOINTMENT_TIP   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('669', $multi_lang);	$lBEEP_BOX_TIP   			= $arrVal[$multi_lang];


$arrVal = $this->lookup_model->getValue('483', $multi_lang);	$lP_YES   			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('484', $multi_lang);	$lP_NO   			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('116', $multi_lang);	$lP_MALE   			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('115', $multi_lang);	$lP_FEMALE   		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('713', $multi_lang);	$lsettings   		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('710', $multi_lang);	$lstudenttalkist   = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('715', $multi_lang);	$lpremiumtutor   = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('716', $multi_lang);	$lstandardtutor   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('649', $multi_lang);	$laddtopotential  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('722', $multi_lang);	$lgoldtutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('723', $multi_lang);	$lsilvertutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('724', $multi_lang);	$lbronzetutor  	= $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"js/fileuploader.js");?>
<?php $this->layout->appendFile('javascript',"js/ajaxupload.3.6.js");?>
<?php $this->layout->appendFile('javascript',"js/jeditable.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.names.js?v=1");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.blockUI.js"); ?>
<?php $this->layout->appendFile('css',"css/fileuploader.css");?>
<?php $this->layout->appendScript('var provice = {};');?>
<?php $basePath =  substr(BASEPATH,0,-7);  ?>		

<!-- for slider -->

<script type="text/javascript" src="<?php echo base_url().'js/jsapi.js' ?>" ></script>
<script src="<?php echo base_url();?>js/bjqs-1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/bjqs.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/demo.css">
<?php //$this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"); ?>

<!-- end for slider -->

<script type="text/javascript" src="<?php echo base_url('js/highslide/highslide-with-html.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/highslide/highslide.css')?>" />
<script type="text/javascript">
hs.graphicsDir = '<?php echo base_url(); ?>js/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';
if (!String.prototype.trim) {
 String.prototype.trim = function() {
  return this.replace(/^\s+|\s+$/g,'');
 }
}


window.setInterval(function(){
  chkprofile();
}, 1000);

function  chkprofile()
{
$.ajax({
					  type:'POST',
					  
					  url:'<?php echo base_url('user/chkProfileAjax/');?>',
					 success:function(msg){
					  
					  if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		
			if(json.success){
			     alert('Congratulations your profile is complete.  Feel free to edit these items or your rate at any time.');
			}
		else {
			}
					  
					  } 
				});
}

</script>
<script>
   /* $(document).ready(function(){
        setInterval(function() {
           // alert("hi");
		   //var source=document.getElementById("addimage1");
		   //alert(source);
		   
        }, 10000);
    });*/
	
	/*$(document).ready(function() {
    setInterval("ajaxd()",10000);
});
*/
function ajaxd() {

/*$.ajax({
   type: "GET",
   url:'<?php echo base_url('user/RotateImage/');?>',
  // data: "user=success",
   success: function(msg){
   console.log(msg);
    // $(msg).appendTo("#edix");
	//window.location.href = window.location.href;
	//$("#addimage1").reload();
   }
   
 });*/
 /*$.ajax({
 //var a=document.getElementById("ad1");
dataType: 'html', 					 
					 url:'<?php echo base_url('user/RotateImage/');?>',
					  success:function(msg){
					  console.log(msg);
					  //$(#addimage1).append("hello");
					   //$('#ad1').append("hello");
//a.src = "hello";
					  } 
				});*/
 
}


</script>
<script class="secret-source">
       
		jQuery(document).ready(function($) {
          
          $('#myad1').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true,
		 
          });
          
        });

		jQuery(document).ready(function($) {
          
          $('#myad2').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true,

          });
          
        });

		jQuery(document).ready(function($) {
          
          $('#myad3').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true,
			
          });
          
        });

		</script>
<!-- for slider -->
<!-- end for slider -->
<script>
function sendBeepBoxMessage(uid)
{  
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}

function click_count(id)
{
var cupdate = id;


			cupdate ='cid='+cupdate;
				$.ajax({
					  type:'POST',
					  data:cupdate,
					  url:'<?php echo base_url('user/UpdateCounter/');?>',
					  success:function(msg){
					  
					  } 
				});
				//return false;
}
</script>
<style>
a.highslide-credits, a.highslide-credits i{ display:none !important;}
.highslide-container{ margin:0 0 !important;}
</style>
<script>
/* Blink Favicon code start */
	/*
	var i =1;
	$("#bsico").remove();
	$("#bico").remove();
	window.setInterval(function(){
		if(i%2==0){
			var src = '<?php echo base_url(); ?>images/test1.ico';
		}else{
			var src = '<?php echo base_url(); ?>images/test2.ico';
		}
		var aj_uid 			= '<?php echo @$profile['uid']; ?>';
		var dataStringinbAj = '';
		dataStringinbAj 	+='uid='+aj_uid;
		$.ajax({
	  type:'POST',
	  data:dataStringinbAj,
	  url:'<?php echo base_url('user/count_unread_messages_real/');?>',
	  success:function(msg){
	  		if (String == msg.constructor){
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			if(result.status == 'success'){
				var numberofmsg = result.numMessages;						
				if(numberofmsg > 0){
					document.head = document.head || document.getElementsByTagName('head')[0];
					var link = document.createElement('link'),
					 oldLink = document.getElementById('dynamic-favicon');
					 link.id = 'dynamic-favicon';
					 link.rel = 'shortcut icon';
					 link.href = src;
					 if (oldLink) {
					  document.head.removeChild(oldLink);
					 }
					 document.head.appendChild(link);
					 i++;

				}else{
					
				}
			}
		} 
});
}, 1000);
*/
/* Blink Favicon code end */

	var msgTimer;
	var _titleTimer = null;
	var uNameDisplay;
	var _newtitle;
	var _oldtitle = document.title;
	var _alerttitle;
	var _isActive;
	var _titleAlertIds;	
	
	function changeFavicon(src) {		
		/*	Blink Favicon previos working code start	*/
		var link 	= document.createElement('link'),
		oldLink 	= document.getElementById('dynamic-favicon');
		link.id 	= 'dynamic-favicon';
		link.type = 'image/x-icon';
		link.href 	= src;
		link.rel 	= 'shortcut icon';
		document.head.appendChild(link);
		/*	Blink Favicon previos working code start	*/
	}	

	function getUnreadMessagesReal(){
		var aj_uid = '<?php echo @$profile['uid']; ?>';
		var dataStringinbAj = '';
		dataStringinbAj +='uid='+aj_uid;;
		$.ajax({
			  type:'POST',
			  data:dataStringinbAj,
			  url:'<?php echo base_url('user/count_unread_messages_real/');?>',
			  success:function(msg){
					if (String == msg.constructor){
						var result;
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					if(result.status == 'success'){
						var numberofmsg = result.numMessages;
						_newtitle = result.username + ' messaged you';
						_titleAlertIds = result.titleAlertIds;
						// alert(numberofmsg);
						if(numberofmsg > 0){
							var currentClass = $('.i_prof').attr('class');
							var addClass = currentClass + ' i_yic';
							$('.i_prof').addClass(addClass);
							//var iconChange = '<?php echo base_url(); ?>images/beepfavicon.gif';
							
							/*var iconChange = '<?php echo base_url(); ?>images/ttl-ico.ico';
							var link = document.createElement('link');
							link.type = 'image/x-icon';
							link.rel = 'shortcut icon';
							link.href = iconChange;
							document.head.appendChild(link);*/
							
							/* Blink Favicon code start 20 DEC - commented below function */
							//changeFavicon('<?php echo base_url(); ?>images/ttl-ico.ico');
							/* Blink Favicon code end 20 DEC - - commented below function */
							
							if(result.balert == '1'){
							
								alertOnTitle();
								//beepplay();
								//---New Code Icon Change
								var i =1;
								$("#bsico").remove();
								$("#bico").remove();
								window.setInterval(function(){
									if(i%2==0){
										var src = '<?php echo base_url(); ?>images/talklist.ico';
									}else{	
										var src = '<?php echo base_url(); ?>images/talklist.ico';
									}
									var aj_uid 			= '<?php echo @$profile['uid']; ?>';
									var dataStringinbAj = '';
									dataStringinbAj 	+='uid='+aj_uid;
									document.head = document.head || document.getElementsByTagName('head')[0];
									var link = document.createElement('link'),
									oldLink = document.getElementById('dynamic-favicon');
									link.id = 'dynamic-favicon';
									link.rel = 'shortcut icon';
									link.href = src;
									if (oldLink) {
										document.head.removeChild(oldLink);
									}
									document.head.appendChild(link);
									i++;
								}, 1000);
								//---New Code Icon Change
								
							}
							
							//play beep message for new message
							//if(result.alert == '1'){
								//beepplay();
							//}
						}else{
							$('.i_prof').removeClass('i_yic');
							var iconChange = '<?php echo base_url(); ?>talklist.ico';
							$("#bsico").attr("href",iconChange);
							changeFavicon(iconChange);
						}
					}
				} 
		});
		msgTimer = setTimeout('getUnreadMessagesReal()',3000);
	}
	getUnreadMessagesReal();
	function flashTitle(pageTitle, newMessageTitle){
		if (document.title == pageTitle){
			document.title = newMessageTitle;
		}else{
			document.title = pageTitle;
		}
	}
	window.onfocus = function () { 
	  _isActive = true; 
	  clearTitleAlert();
	}; 
	window.onblur = function () {
	  _isActive = false; 
	};
	function alertOnTitle(){
		if(typeof _isActive != 'undefined' && _isActive == false){
			var oldTitle = document.title;
			var newtitle = _newtitle;
			if(!_titleTimer){
				_titleTimer = setInterval("flashTitle('"+oldTitle+"', '"+newtitle+"')", 1000);
			}
		}
	}
	function clearTitleAlert(){
		if(typeof _titleTimer != 'undefined'){
			clearInterval(_titleTimer);
			document.title = _oldtitle;
			_titleTimer = null;
			if(_titleAlertIds != ''){
				var aj_uid = '<?php echo @$profile['uid']; ?>';
				var dataTtUpdate = '';
				dataTtUpdate +='uid='+aj_uid+'&titleAlertIds='+_titleAlertIds;
				$.ajax({
					  type:'POST',
					  data:dataTtUpdate,
					  url:'<?php echo base_url('user/updateTitleAlertIds/');?>',
					  success:function(msg){
					  } 
				});
				_titleAlertIds = '';
			}
		}
	}
</script>
<style>
.tstatus{
color:#fff;
text-align:center;font:bold 18px/33px Arial, Helvetica, sans-serif;
padding:0 10px;
height:33px;
position:absolute;

 cursor:default;
}
</style>
<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
	<div class="content_side fl" style="float:left; width:320px;">
		<div class="slide_inner">
			
			
			<div class="user_header posR" style="background:none !important;" >
				<?php 
				//print_r($profile);die;
					if(!$profile['pic']){
						$iheight = '245';
					}else{
						$iheight = '245';
					}
					
					 
					
				?>
				<img height="<?php echo $iheight;  ?>" src="<?php echo $profile['pic']?Base_url('/uploads/images/thumb/'.$profile['pic']):Base_url('images/header.jpg');?>" width="245"  id="profile_image_show"/>
				<a href="#" class="upload_hdpic" id="profile_image_upload"><?php echo $lUPLOAD_PICTURE;?></a>
                <?php if($profile['roleId'] == 2  || $profile['roleId'] == 1  || $profile['roleId'] == 3): ?>
				<div class="ratings_score_b lft-img-rt" id="">
				<s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>">
				
				</s>
				
				</div>
				
				<?php endif; ?>
				<div class="tstatus" style="bottom:10px;width:8px;">
			<?php if($profile['roleId'] == 1) {?>
			<img class="himg" src="<?php echo base_url('images/bronze.png')?>"> 
			<?php }?>
				<?php if($profile['roleId'] == 2) {?>
			<img class="himg" src="<?php echo base_url('images/silver.png')?>"> 
			<?php }?>
				<?php if($profile['roleId'] == 3) {?>
			<img class="himg" src="<?php echo base_url('images/gold.png')?>"> 
			<?php }?>
				</span></div>
			</div>
			
			
			
			 
			
			
			<input type="hidden" name="profilehpic" id="profilehpic" value="<?php echo $profile['pic'] ?>" />
			<div class="user_info">
				<span  style="top:30px;font-size:20px;font-weight:bold;"><?php echo $profile['firstName'];?></span>
		
					<?php  if($profile['roleId'] == 5 || $profile['roleId'] == 4){?> <p style="font-size:11px; width:300px"><?php  echo $encode;?></p> <?php }?> 
					 
						<?php if($profile['roleId'] == 2): ?><br><span style="bottom:30px;font-size:20px;font-weight:300;"><?php echo $lsilvertutor;?></span><?php endif;?>
						<?php if($profile['roleId'] == 3): ?><br><span style="bottom:30px;font-size:20px;font-weight:300;"><?php echo $lgoldtutor; ?></span><?php endif;?>
						<?php if($profile['roleId'] == 0): ?><br><span style="bottom:30px;font-size:20px;font-weight:300;"><?php echo $lstudenttalkist; ?></span><?php endif;?>
						<?php if($profile['roleId'] == 1): ?><br><span style="bottom:30px;font-size:20px;font-weight:300;"><?php echo $lbronzetutor;?> </span><?php endif;?>
						<?php if($own):?>	
						<?php if($profile['roleId'] == 4) {?>
						<a class="owner-settings" style="margin-top:-45px;" href="<?php echo base_url('user/myInfo');?>"><?php echo $lsettings; ?></a>				
						<?php }
						elseif($profile['roleId'] == 5)
						{?>
						
						<a class="owner-settings" style="margin-top:-45px;" href="<?php echo base_url('user/AffiliateInfo');?>"><?php echo $lsettings; ?></a>
						<?php }else {?>
							<a class="owner-settings" href="<?php echo base_url('user/changeInfo');?>"><?php //echo $change_contact_info;?><?php echo $lsettings; ?></a>				
						<?php }?>	
							<?php if($profile['roleId'] == 1 || $profile['roleId'] == 2 || $profile['roleId'] == 3): ?>
							<span class="bknwhwr"><a href="javascript:void(0);" class="golden-btn bknw" style="cursor: default;" ><input type="checkbox" name="readytotalk" id="readytotalk" value="1" <?php if(@$profile['readytotalk']=='1'){echo 'checked';} ?> />&nbsp;&nbsp;&nbsp;<?php echo $lNOW;?></a></span>
							<?php endif; ?>
						<?php endif; ?>
                        <div class="V_line2" style="width:100%; margin-top:15px;"></div>
                        <div class="lft-add">&nbsp;</div>
					
					<!-- for rendom advertise1 -->
						<?php if($adcon): ?>

                                        <div class="" style="overflow:hidden; width:180px;height:150px; float:left;">
										<div id="myad1" class="stepcarousel brd1">
                                        	
                                            <ul class="bjqs">
                                                <?php 
												if($adcon): 
												
												foreach($adcon as $ad):
												//echo "<pre>";
													//print_r($ad);
												?>
												
                                                <li>
                                                <div class="belt">
                                                <div class="panel">
													<div class="box-cont over-hid">
														 
														
														 <?php if($ad['link'] != '') {?>
														<div class="">
															<a target="_blank" href="<?php echo 'http://'.$ad['link']; ?>">
																
																<img onclick='return click_count(<?php echo $ad['advertisementid'];?>)' style="width:180px;height:150px;padding-top:6px;"  src="<?php echo base_url('uploads/images/ad/'.$ad["source"]); ?>" alt="01"/>
															</a>
														</div>
														<?php } else { ?>
														<div class="">
															
															<img src="<?php echo base_url('uploads/images/ad/'.$ad["source"]); ?>" alt="01" style="width:180px;height:150px;padding-top:6px;"/>
														</div>
														<?php } ?>
													</div>
                                                </div>
                                                 </div>
                                                 </li>
                                                <?php
													endforeach;
													endif;
												?>
                                           </ul>
                                        </div>
										
										
                                   
								</div>	
					<?php
													
													endif;
												?>		
			
			                         <!-- end rendom advertise1 -->
									 
									 
						<!-- rendom advertisement 2 -->
						<?php if($adcon1): ?>
                         <div class="" style="overflow:hidden; width:180px;height:150px; margin-top:1px !important;float:left;">
										<div id="myad2" class="stepcarousel brd2">
                                        	
                                            <ul class="bjqs">
                                                <?php 
												if($adcon1): 
												
												foreach($adcon1 as $ad1):
												//echo "<pre>";
													//print_r($ad);
												?>
												
                                                <li>
                                                <div class="belt">
                                                <div class="panel">
													<div class="box-cont over-hid">
														 
														
														 <?php if($ad1['link'] != '') {?>
														<div class="">
															<a target="_blank" href="<?php echo 'http://'.$ad1['link']; ?>">
																
																<img onclick='return click_count(<?php echo $ad1['advertisementid'];?>)' style="width:180px;height:150px;padding-top:6px;"  src="<?php echo base_url('uploads/images/ad/'.$ad1["source"]); ?>" alt="01"/>
															</a>
														</div>
														<?php } else { ?>
														<div class="">
															
															<img style="width:180px;height:150px;padding-top:6px;" src="<?php echo base_url('uploads/images/ad/'.$ad1["source"]); ?>" alt="01"/>
														</div>
														<?php } ?>
													</div>
                                                </div>
                                                 </div>
                                                 </li>
                                                <?php
													endforeach;
													endif;
												?>
                                           </ul>
                                        </div>
										
										
                                   
								</div>	
                          <?php
													
													endif;
												?>	
						<!-- end rendom advertisement 2 -->		
									 
							
		<!-- for advertisement 3 -->
<?php if($adcon2): ?>
<div class="" style="overflow:hidden; width:180px;height:150px; margin-top:1px !important;float:left;">
										<div id="myad3" class="stepcarousel">
                                        	
                                            <ul class="bjqs">
                                                <?php 
												if($adcon2): 
												
												foreach($adcon2 as $ad2):
												//echo "<pre>";
													//print_r($ad);
												?>
												
                                                <li>
                                                <div class="belt">
                                                <div class="panel">
													<div class="box-cont over-hid">
														 
														
														 <?php if($ad2['link'] != '') {?>
														<div class="">
															<a target="_blank" href="<?php echo 'http://'.$ad2['link']; ?>">
																
																<img onclick='return click_count(<?php echo $ad2['advertisementid'];?>)' style="width:180px;height:150px;padding-top:6px;"  src="<?php echo base_url('uploads/images/ad/'.$ad2["source"]); ?>" alt="01"/>
															</a>
														</div>
														<?php } else { ?>
														<div class="">
															
															<img src="<?php echo base_url('uploads/images/ad/'.$ad1["source"]); ?>" style="width:180px;height:150px;padding-top:6px;" alt="01"/>
														</div>
														<?php } ?>
													</div>
                                                </div>
                                                 </div>
                                                 </li>
                                                <?php
													endforeach;
													endif;
												?>
                                           </ul>
                                        </div>
										
										
                                   
								</div>	
 <?php
													
													endif;
												?>	
		<!-- end advertisement -/>

							
			
						
				<!--<table width="100%" class="userInfo" border=0>
					
					<tr style="margin-bottom:10px;">
						<span  style="top:30px;font-size:20px;font-weight:bold;"><?php echo $profile['firstName'];?></span><br/>
						<?php if($profile['roleId'] == 2): ?><span style="bottom:30px;font-size:20px;font-weight:300;">Premium tutor</span><?php endif;?>
					
					
						<?php if($own):?>	
							<a class="owner-settings" href="<?php echo base_url('user/changeInfo');?>"><?php //echo $change_contact_info;?>Settings</a>
						
							<?php if($profile['roleId'] == 1 || $profile['roleId'] == 2): ?>
							<span class="bknwhwr"><a href="javascript:void(0);" class="golden-btn bknw" style="cursor: default;" ><input type="checkbox" name="readytotalk" id="readytotalk" value="1" <?php if(@$profile['readytotalk']=='1'){echo 'checked';} ?> />&nbsp;&nbsp;&nbsp;<?php echo $lNOW;?></a></span>
							<?php endif; ?>
						<?php endif; ?>
					
					</tr>
					
					
					<?php if($own):?>
							
					
					<?php if($profile['roleId'] == 1 || $profile['roleId'] == 2): ?>
						<?php
							if($documents){ ?>
							<tr><td colspan="3"><div class="V_line2"></div></td></tr>
							<tr><td colspan="3" align="center"><?php echo '<b>Training Requirements</b>';?></td></tr>
							<?php
								foreach($documents as $document)
								{
									$readDocument = base_url().'uploads/LMS/'.$document['document_file'];
									$dchecked = "";
									if (in_array($document['id'], $readDocIds)) {
										$dchecked = "checked";
									}
									?>
									<tr>
									<td colspan="3" >
										&nbsp;<input type="checkbox" value="<?php echo $document['id']?>" id="docchk_<?php echo $document['id']; ?>" <?php echo $dchecked; ?> />&nbsp;
										<a href="javascript:void(0);" onclick="updateDocument('<?php echo $document['id'] ?>','<?php echo $readDocument; ?>')" style="width:450px;"><?php echo $document['title']; ?></a>
									</td>
									</tr>
									<?
								}
							}
							if($re_test == 'Yes'){ ?>
								<tr><td colspan="3"><div class="V_line2"></div></td></tr>
								<tr><td colspan="3" align="center"><?php echo '<b>'.$lTRAINING_REQUIREMENTS.'</b>';?></td></tr>
								<tr>
									<td colspan="3" align="center">
										<a href="<?php echo base_url().'user/test' ?>"><?php echo $lRE_TEST;?></a>
									</td>
								</tr>
							<?php } ?>
						<script>
							function updateDocument(id,url){
								//update as document read
								var dataString = '';
								dataString +='docid='+id;
								$.ajax({
									  type:'POST',
									  data:dataString,
									  url:'<?php echo base_url('user/update_doc_as_read/');?>',
									  success:function(msg){
											if (String == msg.constructor){
												var result;
												eval('result = ' + msg);
											} else {
												var result = msg;
											}
											if(result.status == 'success'){
												var chkid = '#docchk_'+id;
												$(chkid).attr('checked','checked');
												window.open(url, '_blank');
												//below code for same page open document - redirect
												//var docurl = '<?php echo base_url(); ?>'+'user/trainingrequirements/docid/'+id; 
												//window.location.href = docurl;
											}
											if(result.completeAll == 1){
												setTimeout(function () {
													alert('Congratulations, your profile is now available to be seen by e-learners worldwide!  Click OK.');
													var testurl = '<?php echo base_url(); ?>'+'user/test'; 
													window.location.href = testurl;
												}, 5000);
												//location.reload(true);
												//window.open(testurl, '_blank');
											}
									   } 
								});
							}
						</script>
					<?php endif; ?>
					
					<tr><td colspan="3"><div class="V_line2"></div></td></tr>
					<?php endif;?>
					<tr>
					
						<th><?php echo trim($lname);?>:</th> 
						<td id="name"><?php echo $profile['firstName'],' ', $profile['lastName'];?></td>
						<td>
							<a href="javascript:void(0)" class="u_edit_ic"></a>
						</td>
					</tr>
					<tr><th><?php echo trim($lage);?>:</th>  <td id="age"><?php echo $profile['age'];?></td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>
					<tr><th><?php echo $lsex;?>:</th> 
						<td id="gender">
							<?php 
								if($profile['gender'] == '1'){
									//echo 'Male';
									echo $lP_MALE;
								}elseif($profile['gender'] == '0'){
									//echo 'Female';
									echo $lP_FEMALE;
								}else{
									echo $lCLICK_TO_EDIT;
								}
							?>
						</td> 
						<td><a href="javascript:void(0)" class="u_edit_ic"></a></td>
					</tr>
					<tr><th><?php echo trim($llocation);?>:</th> 
						<td id="location">
							<?php 
								if(@$countries[$profile['country']] == '' && @$province[$profile['country']][$profile['province']] == '' && $profile['city'] == ''){
									echo $lCLICK_TO_EDIT;
								}else{
									echo @$profile['city'] ,', ', @$province[$profile['country']][$profile['province']] , ', ',$countries[$profile['country']];
								}
							?> 
						</td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td>
					</tr>
					<?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) {?>
					<tr><td colspan="3"><div class="V_line_profile"></div></td></tr>
					<tr><th><?php echo trim($lfree_session);?><?php //echo $lfree_session;?>:</th> <td id="free_session"><?php echo (@$free_session[$profile['free_session']]=='y'?$lP_YES:$lP_NO);?>
					</td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>
					<?php } ?>
					<?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) :?>
					<?php if(!$own):?>
					<tr><th><?php echo $lprice;?>:</th> <td id="hRate" ><?php echo number_format(round($profile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.','');?> credits/25min</td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>
					<?php else:?>
					<tr><th><?php echo $lprice;?>:</th> <td id="hRate" >US $<?php echo  $profile['hRate'];?>/25min</td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>
					<?php endif;?>
                    <tr><td colspan="3"><div class="V_line_profile"></div></td></tr>
					<tr>
						<th><?php echo $lrating;?>:</th>
						<td colspan="2">
							<div class="ratings_score_b" id=""><s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>"></s></div>
						</td>
					</tr>
					<?php endif; ?>
					<tr><th><?php echo $l1ST." ";?> <?php echo trim($llanguage);?><?php //echo $llanguage;?>:</th> <td id="nativeLanguage"><?php echo $profile['nativeLanguage'] ;?></td> <td><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>					
					<tr><th><?php echo $l2ND." ";?>  <?php echo trim($llanguage);?><?php //echo $llanguage;?>:</th> <td id="otherLanguage">
					
					<?php 
					echo $lCLICK_TO_EDIT;
					?>
					
					
					
					
					
					</td> <td ><a href="javascript:void(0)" class="u_edit_ic"></a></td></tr>
					<tr><td colspan="3"><div class="V_line_profile"></div></td></tr>					
					<tr><th><?php echo $laccount;?>:</th> <td><?php echo $profile['uid'] ;?></td><td width="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
					<?php if($profile['roleId'] == 1 || $profile['roleId'] == 2): ?>
                    <?php if($own):?>
					<tr><th><div style="width:115px;"><?php echo $hidemyaccount; ?>:</div></th> <td><input style="margin-top:6px;" type="checkbox" name="hiddenRole" id="hiddenRole" value="1" <?php if(@$profile['hiddenRole']=='1'){echo 'checked';} ?> /></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
					<?php endif; ?>
					<?php endif; ?>
					<tr><td colspan="3"><div class="V_line_profile"></div></td></tr>					
                 <?php if($profile['roleId'] == 0  ) {?>   
					<tr>
						<td colspan=2>
							<b><?php echo $ltestscore;?>: </b><span class="question"><img src="<?php echo base_url('images/arrow.png');?>" alt="ed"></span>
						</td>
						<td align="right">
							<a href="javascript:void(0)" id="edit" style="padding-top:5px;">
								<img style="padding-top:5px;" src="<?php echo base_url('images/cm_pencil.png');?>" alt="ed">
							</a>
						</td>
					</tr>
					<script>
					$(function() {
						$('#livetestscore').load('<?php echo base_url('user/score_ajax/');?>');
					});
					$(document).ready(function(){
						$.get('<?php echo base_url('user/score_ajax/');?>', function(data) {
								$("div#data").hide();
								var id = data.split('<br/>');
								$("#fnames").val(id[0]);
								$("#ages").val(id[1]);
								$("#lnames").val(id[2]);
								$("#phoneno").val(id[3]);
								$("#mnames").val(id[4]);	
								$("#email").val(id[5]);
								$('#data').html(id[0]+'<br/>'+id[1]+'<br/>'+id[2]+'<br/>'+id[3]);
						});
							$("div#extralable").hide();
							$("a#edit").click(function(){
								var id = $("#fname").val();
								$("div#livetestscore").hide();
								$("div#data").hide();
								$("div#extralable").hide();
								$("div#liveextralable").hide();
								$("div#editdata").show();
							});
							$("#calcelscore").click(function(){
								$("div#liveextralable").hide();
							    $("div#extralable").show();
								$("div#editdata").hide();
								$("div#data").show();
							});
							$("#fnames").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#lnames").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#mnames").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#ages").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#phoneno").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#email").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("#id").keyup(function(event){
								if(event.keyCode == 13){
									$("#submit").click();
								}
							});
							$("input#submit").click(function(){
								var fname  = $("#fnames").val();
								var lname = $("#lnames").val();
								var mname  = $("#mnames").val();
								var age = $("#ages").val();
								var phoneno  = $("#phoneno").val();
								var email = $("#email").val();
								var id = $("#id").val();
								var ret = validatetoiec();
								if(ret == false){
									return false;
								}
								var dataString = '';
								dataString += 'send=1';
								if(fname != ''){dataString += '&fname='+fname;} else {dataString += '&fname='+fname;}
								if(lname != ''){dataString += '&lname='+lname;} else {dataString += '&lname='+lname;}
								if(mname != ''){dataString += '&mname='+mname;}
								if(age != ''){dataString += '&age='+age;} else {dataString += '&age='+age;}
								if(phoneno != ''){dataString += '&phoneno='+phoneno;}
								if(email != ''){dataString += '&email='+email;} else {dataString += '&email='+email;}
								if(id != ''){dataString += '&id='+id;}
								$.ajax({
									  type:'POST',
									  data:dataString,
									  url:'<?php echo base_url('user/score_ajax/');?>',
									  success:function(data){
										$("div#liveextralable").hide();
										$("div#extralable").show();
										$("div#editdata").hide();
										$("div#data").show();
									} 
								});  
								$.get('<?php echo base_url('user/score_ajax/');?>', function(data) {
								var id = data.split('<br/>');
								$("#fnames").val(fname);	
								$("#lnames").val(lname);	
								$("#ages").val(age);
								$("#phoneno").val(phoneno);
								$('#data').html(fname+'<br/>'+age+'<br/>'+lname+'<br/>'+phoneno);
								});
							});
					});	
					function numbersonly(val){
						var numbers = /^[-+]?[0-9]+$/;  
						if(val.match(numbers)){
							return true;
						}else{
							alert('Enter Number only');
							return false;
						}
					}
					function validatetoiec(){
						var fname  = $("#fnames").val();
						var lname = $("#lnames").val();
						var age = $("#ages").val();
						var phoneno  = $("#phoneno").val();
						var id = $("#id").val();
						var numbers = /^[-+]?[0-9]+$/;
						if(!fname.match(numbers) && fname != ''){
							alert('Enter number only');
							$("#fnames").focus();
							return false;
						}else if(fname<0 || fname >200){
							alert('Enter valid TOIEC Score');
							$("#fnames").focus();
							return false;
						}else if(!lname.match(numbers) && lname != ''){
							alert('Enter number only');
							$("#lnames").focus();
							return false;
						}else if(lname<0 || lname >30){
							alert('Enter valid TOEFL Score');
							$("#lnames").focus();
							return false;
						}else if(!age.match(numbers) && age != ''){
							alert('Enter number only');
							$("#ages").focus();
							return false;
						}else if(age<0 || age >200){
							alert('Enter valid TOIEC Score');
							$("#ages").focus();
							return false;
						}else if(!phoneno.match(numbers) && phoneno != ''){
							alert('Enter number only');
							$("#phoneno").focus();
							return false;
						}else if(phoneno<0 || phoneno >30){
							alert('Enter valid TOEFL Score');
							$("#phoneno").focus();
							return false;
						}else if(!id.match(numbers) && id != ''){
							alert('Enter number only');
							$("#id").focus();
							return false;
						}else{
							return true;
						}
					}					
					</script>
					<tr>
					</tr>
					<tr>
						<td colspan=2>
							<div id="editdata" style="display:none">
								<form name="test" id="test" action="" method="post" >
									  <?php echo $lfirst;?> TOIEC <?php echo $lscore;?>: <input type="text" name="fnames" id="fnames" value="123456" placeholder="Speaking Score"  /><br />
									  <?php echo $lcurrent;?> TOIEC <?php echo $lscore;?>: <input type="text" name="ages" id="ages" value="" placeholder="Speaking Score" /><br />
									  <?php echo $lfirst;?> TOEFL <?php echo $lscore;?>: <input type="text" name="lnames" id="lnames" value=""  placeholder="Speaking Score"/><br />
									  <?php echo $lcurrent;?> TOEFL <?php echo $lscore;?>: <input type="text" name="phoneno" id="phoneno" value="" placeholder="Speaking Score" /><br />
									  <input type="button" name="submit" id="submit" value="Submit"/>
									  <input type="button" name="calcelscore" id="calcelscore" value="Cancel"/>
									  <input type="hidden" name="id" id="id" value="<?php echo $profile['uid']?>"/>
								</form>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3">
						<table>
							<tr>
								<td>
									<div id="liveextralable">
										<?php echo $lfirst;?> TOIEC <?php echo $lscore;?>: <br>
										<?php echo $lcurrent;?> TOIEC <?php echo $lscore;?>: <br>
										<?php echo $lfirst;?> TOEFL <?php echo $lscore;?>: <br>
										<?php echo $lcurrent;?> TOEFL <?php echo $lscore;?>: <br>
									</div>
								</td>
								<td><div id="livetestscore"></div></td>
							</tr>
						</table>
						<table>
							<tr>
								<td>
									<div id="extralable">
										<?php echo $lfirst;?> TOIEC <?php echo $lscore;?>: <br>
										<?php echo $lcurrent;?> TOIEC <?php echo $lscore;?>: <br>
										<?php echo $lfirst;?> TOEFL <?php echo $lscore;?>: <br>
										<?php echo $lcurrent;?> TOEFL <?php echo $lscore;?>: <br>
									</div>
								</td>
								<td><div id="data"></div></td>
							</tr>
						</table>
						</td>
					</tr>
				<?php } ?>
				</table>-->
			</div>
		</div>
        <script>
		
		
		
		
		function testSpeed(){
			if( $('#testSpeedButton').attr('doing') == 1 ){
				return false;
			}else {
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
				$.post('<?php echo Base_url('user/editProfileSingle');?>',{id:'speed',value:_speed});
				$('#testSpeedButton').attr('doing',0);
			});
		}
		function getEvent(){
			if(document.all){
				return window.event;//ie
			}
			func=getEvent.caller;
			while(func!=null){
				var arg0=func.arguments[0];
				if(arg0){
					if((arg0.constructor==Event || arg0.constructor ==MouseEvent)||(typeof(arg0)=="object" && arg0.preventDefault && arg0.stopPropagation)){
						return arg0;
					}
				}
				func=func.caller;
			}
			return null;
		}
		window.configs = <?php echo json_encode($config);?>;
		$(function(){
			$('#hiddenRole').click(function(){
				$('#hiddenRole').each(function(){
					var hiddenRole = 0;
					if(this.checked){hiddenRole = 1;}
					var ddataStringChecked = "hiddenRole="+hiddenRole;
					$.ajax({
						url: "<?php echo base_url();?>user/hiddenRoleUpdate",
						type: 'POST',
						data: ddataStringChecked,
						dataType: 'json',
						cache: false,
						success: function (msg){
							if(msg.status == 'success'){	
								if(hiddenRole == 1){
									alert('Your account is now hidden from student searches.')
								}else{
									alert('Your account is now visible for student searches.')
								}
							}
						}
					});
				})
			})
			$('#readytotalk').click(function(){
					var cellnumber = '<?php echo $profile['cell']; ?>';
					if(cellnumber == ''){
						alert('Please enter cell number in Contact Info. This is required for SMS alerts when you get a NOW booking.');
						window.location.href = '<?php echo base_url().'user/changeInfo'; ?>';
						return false;
					}
					var readyt = $('#readytotalk').is(":checked");
					if(readyt == true){
						var readytotalk = 1;
					}else{
						var readytotalk = 0;
					}
					var ddataStringChecked = "readytotalk="+readytotalk;
					$.ajax({
						url: "<?php echo base_url();?>user/readytotalkUpdate",
						type: 'POST',
						data: ddataStringChecked,
						dataType: 'json',
						cache: false,
						success: function (msg){
							if(msg.status == 'success'){	
								window.location.href = window.location.href;
							}
						}
					});
			})
			$('#testSpeedButton').click(function(){
				testSpeed();
			})
			$('.u_edit_ic','.userInfo').css('visibility',' hidden');
			$('#profile_image_upload').hide();
						
			<?php if($own):?>
					 
			var button = $('#profile_image_upload'), interval;
					
			new AjaxUpload(button,{
				action: '<?php echo Base_url('user/profile_image');?>', 
				name: 'userfile',
				onSubmit : function(file, ext){
				
					/*$( "#dialog p").html('Uploading.');
					$( "#dialog" ).dialog({
						modal: true
					});*/
					$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading26.gif" />' });
					// If you want to allow uploading only 1 file at time,
					// you can disable upload button
					this.disable();
														
					interval = window.setInterval(function(){
						var text = $("#dialog p").html();
						// alert(text);
						if (text.length < 13){
							$( "#dialog p").html(text + '.');
						} else {
							$( "#dialog p").html('Uploading');				
						}
					}, 200);
				},
				onComplete: function(file, response){
					$.unblockUI();
					$('#dialog').attr('buttontype','done');
					$( "#dialog:ui-dialog" ).dialog( "destroy" );
					window.clearInterval(interval);
					this.enable();
					//alert(response);
					response = JSON.parse(response);
					var url = "<?php echo base_url('user/browse_image_view/image/')?>";
                    //alert(url);
					hs.htmlExpand(null, { objectType: 'iframe', width:'1200', height:'700' ,src:url } )
					var timer = setInterval(function() {   
						var cls = $('#hihid').val();
						//  alert(cls);
						if(cls == 1) {  
							clearInterval(timer);  
							$('#profile_image_show').attr('src',response.address);
							 //alert(response.address);
							var newthumburl = '<?php echo base_url()."timthumb.php?src=" ?>'+response.address+'&w=30&h=30&zc=0'
							 //alert(newthumburl);
							$('.vAgn_m').attr('src',newthumburl);
							$('#hihid').val('0');
						}  
					}, 500); 
				}
			});
			$(document).keyup(function(e){
        
		if (e.keyCode == 27) {
		closewinhs();
		}
		});
			
			$("#nativeLanguage").editable("<?php echo Base_url('user/editProfileSingle');?>", { 
				indicator : "saving..",
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				type:'select',
				onblur:'submit',
				submit : "OK",
				cancel : 'Cancel',
				data   : <?php echo $langs;?>,
				style  : "inherit"
			});
			$("#gender").editable("<?php echo Base_url('user/editProfileSingle');?>", { 
				indicator : "saving..",
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				type:'select',
				onblur:'submit',
				submit : "OK",
				cancel : 'Cancel',
				data   : {0:'Female',1:'Male'},
				style  : "inherit",
				callback:function(val,setting){
					$(this).html( setting.data[val])
				}
			});
			$("#free_session").editable("<?php echo Base_url('user/editProfileSingle');?>", { 
				indicator : "saving..",
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				type:'select',
				onblur:'submit',
				submit : "OK",
				cancel : 'Cancel',
				data   : {'Yes':'Yes','No':'No'},
				style  : "inherit",
				callback:function(val,setting){
				return false;
					$(this).html( setting.data[val])
				}
			});
			$("#otherLanguage").editable("<?php echo Base_url('user/editProfileSingle');?>", { 
				indicator : "saving..",
				type:'select',
				submit : "OK",
				cancel : 'Cancel',
				data   : <?php echo $langs;?>,
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				style  : "inherit"
			});
			$("#name").editable("<?php echo Base_url('user/editNames');?>", { 
				indicator : "saving..",
				type:'names',
				cancel : 'Cancel',
				onblur:'submit',
				submit : "OK",
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				style  : "inherit",
				callback:function(val,setting){
					var _data = val.split(' ');
					var newstr = '';
					if(_data[0] != 'First'){
						newstr = newstr + _data[0];
					}
					if(_data[1] != 'Last'){
						newstr = newstr + ' ' + _data[1];
					}
					if(newstr !=''){
						$(this).html(newstr);
					}
					if(val == 'First' || val == 'Last' || val == 'First Last'){	
						$(this).html('');
					}
				},
				submitdata : function(data,ss,dd) {
					return {value : $('.first',$(this)).val()+'-'+$('.last',$(this)).val()};
				}
			});
			$('#scoretest').click(function(){
				$("#scorelable").hide();
			});
			$("#age").editable("<?php echo Base_url('user/editProfileSingle');?>", { 
				indicator : "saving..",
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				onblur:'submit',
				submit : "OK",
				cancel : 'Cancel',
				event     : "dblclick",
				style  : "inherit",
				callback:function(val,setting){
					newval = _obj.val()
				},
				submitdata : function(data,ss,dd) {
					var _data={};
					$('input',$(this)).each(function(){
						var _obj = $(this);
						newval = _obj.val()
					})
					var numbers = /^[-+]?[0-9]+$/;  
					if(!newval.match(numbers)){
						alert('Please enter number only');
						window.location.href = window.location.href;
					}
					if(newval < 13){
						alert('Age cannot be less than 13. Use of TheTalkList requires permission of an adult.');
						window.location.href = window.location.href;
						return false;
					}
					if(newval > 100){
						alert('Age cannot be greater than 100.');
						window.location.href = window.location.href;
						return false;
					}
				}
			});
			$('#hRate').editable("<?php echo Base_url('user/editProfileSingle');?>",{
				indicator : "saving..",
				submit : "OK",
				cancel : 'Cancel',
				tooltip   : "Doubleclick to edit.",
				event     : "dblclick",
				style  : "inherit",
				onedit : function(editObj,el) {
					var data = $(el).html();
					var _price = data.substr(0,data.indexOf('\/25min') > -1 ?data.indexOf('\/25min'):data.length).substr(3);
					var onrval = _price;
					if (onrval.indexOf("$") >= 0){
						onrval = $.trim(onrval);
						onrval = onrval.substr(1,onrval.length);
					}
					$(el).html(onrval);
					return true;
				},
				onreset: function(editObj,el,ss){	
					el.revert = 'US$'+el.revert+'/25min';
					return true;
				},
				callback:function(val,setting){
					var onrval = val;
					if (onrval.indexOf("$") >= 0){
						onrval = $.trim(onrval);
						onrval = onrval.substr(1,onrval.length);
					}
					$(this).html('US$'+onrval+'/25min')
				}
			});
			$('#interests').editable("<?php echo Base_url('user/editProfileSingle');?>",{
				indicator : "saving..",
				submit : "OK",
				type:'aboutMe',
				cancel : 'Cancel',
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				style  : "inherit",
				onedit : function(editObj,el) {
					return true;
				},
				onreset: function(editObj,el,ss){
					return true;
				},
				submitdata : function(data,ss,dd) {
					var _data={};
					$('input',$(this)).each(function(){
						var _obj = $(this);
						_data[_obj.attr('class')] = _obj.val()
					})
					return {value : _data};
				},
				callback:function(val,setting){
					if (String == val.constructor) {      
						eval ('var result = ' + val);
					} else {
						var result = val;
					}
					var _str = '';
					$.each(result,function(k,v){
						_str += '<div><span class="'+k+'" title="'+v+'">'+k+'</span></div>';
					})
					$(this).empty();
					$(this).html(_str)
					return false;
				}
			});
			var roleUser = '<?php echo intval($roleId); ?>';
			$("#location").editable("<?php echo Base_url('user/editLocation');?>",{ 
				indicator : "saving..",
				type:'locations',
				onblur:'submit',
				submit : "OK",
				cancel : 'Cancel',
				tooltip   : "<?php echo $lDOUBLECLICK_TO_EDIT;?>",
				event     : "dblclick",
				style  : "inherit",
				datasCountries:<?php echo json_encode($countries);?>,
				provices:<?php echo json_encode($province);?>,
				proviceUrl:'<?php echo Base_url('user/getProvices');?>',
				userRole:'<?php echo intval($roleId); ?>',
				submitdata : function(data,ss,dd) {
					if(roleUser == '0'){
						return {value : $('.city',$(this)).val() +',provience,'+$('.country',$(this)).val()};
					}else{
						return {value : $('.city',$(this)).val() +','+$('.provice',$(this)).val()+','+$('.country',$(this)).val()};
					}
				},
				callback:function(val,setting){
					if(roleUser != '0'){
						var _data = val.split(',,');
					}else{
						var _data = val.split(',');
					}
					if(roleUser != '0'){
						var _str =  setting.datasCountries[_data[0]] + ' ';
					}else{
						var _str = _data[0] + ' ';
					}
					if(roleUser != '0'){
						_str += ' , ';
						_str += provice[_data[0]][_data[1]] + ' ';
					}
					if(_data[2] != 'City'){
						_str += ' , ';
						_str += _data[2];
					}
					$(this).html(_str)
				}
			});
			$('.userInfo tr').hover(function(){
				$('.u_edit_ic',this).css('visibility','inherit');
			},function(){
				$('.u_edit_ic',this).css('visibility','hidden');
			});
			$('.user_header.posR').mouseenter(function(){
				$('#profile_image_upload').css('z-index',10000);
				$('#profile_image_upload').show();
			});
			$('.user_header.posR').mouseleave(function(){
				var evt = getEvent();
				var element = evt.secElement||evt.target;
				var out =0;
				if(typeof(element) =='undefined' || element.id != 'profile_image_upload'){
					out = 1;
				}
				if(out==1){
					$('#profile_image_upload').hide();
				}
			})
			$('.u_edit_ic','.userInfo').click(function(){
				$(this).parent().prev().trigger('dblclick');
			});
			<?php endif;?>
			$('.user_header img').load(function(){
				$('.user_header').css('height',$('.user_header img').height() -1);
			})
		})
		$(document).ready(function () {
			  $("span.question").hover(function () {
				$(this).append('<div class="tooltip"><p><?php echo $lSPEAKING_SCORE;?></p></div>');
			  }, function () {
				$("div.tooltip").remove();
			  });
			  $("span.bknwhwr").hover(function () {
				$(this).append('<div class="tooltip3"><p><?php echo $lNOW_TIP; ?> </p></div>');
			  }, function () {
				$("div.tooltip3").remove();
			  });
			  
			 // if( $('#tutorReqAppBtn').length ){
     			//  $("#tutorReqAppBtn").html('<?php echo  $lREQ_APP;?>');
			 // }
			  
			  
			  if( $('#tutorReqAppBtn').length ){
     			  $("#tutorReqAppBtn").html('<?php echo  $laddtopotential;?>');
			  }
			  
			  
			  
			  
			  if( $('#tutorCreAppBtn').length ){
      			  $("#tutorCreAppBtn").html('<?php echo  $lCRE_APP;?>');
			  }
			  
			if( $('#tt_beep_tip').length ){
				$( "#tt_beep_tip" ).attr('title', '<?php echo  $lBEEP_BOX_TIP;?>');
			}

			if( $('#tt_cr_app').length ){
				$( "#tt_cr_app" ).attr('title', '<?php echo  $lCREATE_APPOINTMENT_TIP;?>');
			}
			if( $('#tt_rq_app').length ){
				$( "#tt_rq_app" ).attr('title', '<?php echo  $lREQUEST_APPOINTMENT_TIP;?>');
			}
		});
		function closehs(){
			$('#hihid').val('1');
		}
		function closewinhs(){
			parent.window.hs.close();
			var ppic = $('#profilehpic').val();
			var nimg = '<?php echo base_url()."uploads/images/thumb"; ?>/'+ppic;
			var ddataStringinvt = "img="+ppic;
			 
			$.ajax({
				url: "<?php echo base_url();?>user/revert_profile_image",
				type: 'POST',
				data: ddataStringinvt,
				dataType: 'json',
				cache: false,
				success: function (msg){
				//alert(msg);
					if(msg.result == 'success'){
						$('#profile_image_show').attr('src',nimg);
						$('.vAgn_m').attr('src',nimg);
					}
				}
			});
		}
		function stripspaces(input){
		  input.value = input.value.replace(/\s/gi,"");
		  return true;
		}
		function isNumeric(v) {
				 return v.length > 0 && !isNaN(v) && v.search(/[A-Z]|[#]/ig) == -1;
		};
		function checkNumber(value) {
			if ( value % 1 == 0 )
				return true;
			else
				return false;
		}
		</script>
        <input type="hidden" id="hihid" value="0" />
	</div>
	<!--/content_side-->
	<div id="jquery_jplayer_1" class="jp-audio" ></div>
	<!--audio player start-->
	<link href="<?php echo base_url('css/audioPlayer/jplayer.blue.monday.css');?>" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('js/audioPlayer/jquery.jplayer.min.js');?>"></script>
	<script type="text/javascript">
	function beepplay()
	{	
		$("#jquery_jplayer_1").jPlayer({
			ready: function () {
				$("#jquery_jplayer_1").jPlayer("setMedia", {
					mp3:"<?php echo base_url('css/audioPlayer/Blop.mp3');?>"
				}).jPlayer("play");
			},
			swfPath: "<?php echo base_url('js/audioPlayer/Jplayer.swf');?>",
			supplied: "mp3",
			wmode:"window",
			preload: "auto",
			errorAlerts: true,
			warningAlerts: false,
			solution: "html,flash",
			autoplay: false,
		});
		/*setTimeout(function(){
		$("#jquery_jplayer_1").jPlayer("play");
		}, 1500);*/
	}
	</script>
	
<style>
.hover{ display:block !important;}
span.question {cursor: pointer;display: inline-block;width: 16px;height: 16px;line-height: 16px;color: White;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: center;position: relative;}
span.question img {vertical-align : middle;}
span.bknwhwr{cursor: pointer;display: inline-block;width: 98px;height: 16px;line-height: 16px;color: White;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: center;position: relative;}
div.tooltip {background-color: #037898;color: White;position: absolute;left: 35px;top: -15px;z-index: 1000000;width: 250px;border-radius: 5px;}
div.tooltip:before {border-color: transparent #037898 transparent transparent;border-right: 6px solid #037898;border-style: solid;border-width: 6px 6px 6px 0px;content: "";display: block;height: 0;width: 0;line-height: 0;position: absolute;top: 40%;left: -6px;}
div.tooltip p {margin: 10px;color: White;}
.clickdisplay{width:147px !important;height:133px;}
.userInfo tr th{ width:125px;}
#location{width:125px !important;}
#location .country{ width:155px !important; overflow:hidden;}
#gender select{ clear:both; display:block;}
#free_session select{ clear:both; display:block;}
.bknw{ width:70px; padding:0px;}
span.bknwhwr{ height:34px;}
div.tooltip3 {background-color: #037898;color: White;position: absolute;left: 90px !important;top: -15px !important;z-index: 1000000;width: 250px;border-radius: 5px;}
div.tooltip3:before {border-color: transparent #037898 transparent transparent;border-right: 6px solid #037898;border-style: solid;border-width: 6px 6px 6px 0px;content: "";display: block;height: 0;width: 0;line-height: 0;position: absolute;top: 40%;left: -6px;}
div.tooltip3 p {margin: 10px;color: White; font-size:12px; text-align:left;}



</style>
