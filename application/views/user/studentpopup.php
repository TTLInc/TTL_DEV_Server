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
$arrVal = $this->lookup_model->getValue('1315', $multi_lang);
$welcometotalk = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1396', $multi_lang);
$chooserole = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1317', $multi_lang);
$wanttobestu = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1318', $multi_lang);
$wanttobetut = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1349', $multi_lang);
$mightbeboth = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('643', $multi_lang);
$firstfree = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1132', $multi_lang);
$choosetutor = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1397', $multi_lang);
$clicktalknow = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1398', $multi_lang);
$practiceinlive = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1399', $multi_lang);
$enjoyfree = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1347', $multi_lang);
$createcoolprofile = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1400', $multi_lang);
$setyouravailability = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1401', $multi_lang);
$practice = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1402', $multi_lang);
$getpaid = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1322', $multi_lang);
$whatwould = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1319', $multi_lang);
$textchat = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1320', $multi_lang);
$searchtutors = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1321', $multi_lang);
$setupprofile = $arrVal[$multi_lang];

$this->layout->appendFile('css',"css/popup-style.css");?>
<script>
function chkRedirect()
{
	<?php $this->session->set_userdata('sturegister','no'); ?>
}

function updateuser(){
	var cupdate = 1;
	cupdate ='cid='+cupdate;
	$.ajax({
	  type:'POST',
	  data:cupdate,
	  url:'<?php echo base_url('user/tutorPopup/');?>',
	  success:function(msg){  
		} 
	})
}
/*
$( window ).load(function() {
var a="<?php echo $this->session->userdata('sturegister')?>";
if(a=="yes")
{
	$('#dialog31').dialog({
					modal:true,
					width:850,
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
}*/
</script>
	
<div style='min-height: 400px'>

</div>
<div class="popup19416_main01 cf" id="welcome">
	<div class="choseyourrole_main01 cf">
		<h1><?php echo $welcometotalk; ?></h1>
        <h2><?php echo $chooserole; ?></h2>
      <div class="choseyourrole_main02 cf">
        	<div class="choseyourrole_main02_left">
            <a href="#" class="welcome_close fadeandscale_student_open">
       	  		<img src="<?php echo base_url();?>images/icon190416_01.png" alt="" onclick="chkRedirect();"/>
                <h3><?php echo $wanttobestu; ?></h3>
            </a>
          	</div>
            <div class="choseyourrole_main02_right">
            <a href="#" class="welcome_close fadeandscale_tutor_open">
       	    	<img src="<?php echo base_url();?>images/icon190416_02.png" alt="" onclick="updateuser();"/>
                <h3><?php echo $wanttobetut; ?></h3>
            </a>
            </div>
        </div>
        <h4><a href="#" class="welcome_close fadeandscale_tutor_open" onclick="updateuser();"><?php echo $mightbeboth; ?></a></h4>
    </div>
</div>


<div class="popup19416_main01 cf" id="fadeandscale_student">
  <div class="popup_student190416_main cf">
   	<div class="popup_student190416_left01">
        <div class="number_190416">1</div>
        	
            <p><?php echo $choosetutor." ".$firstfree; ?></p>
            <img src="<?php echo base_url();?>images/student_190416_01.png" alt=""/>
            
        </div>
        
    <div class="popup_student190416_left01">
      <div class="number_190416">2</div>
        
        <p><?php echo $clicktalknow; ?></p>
        <img src="<?php echo base_url();?>images/student_190416_02.png" alt=""/>
        
      </div>
        
    <div class="popup_student190416_left01">
        <div class="number_190416">3</div>
        
        	<p><?php echo $practiceinlive; ?></p>
            <img src="<?php echo base_url();?>images/student_190416_03.png" alt=""/>
        
        </div>
        
    <div class="popup_student190416_left01">
        <div class="number_190416">4</div>
        
        	<p><?php echo $enjoyfree; ?></p>
            <img src="<?php echo base_url();?>images/student_190416_04.png" alt=""/>
        
        </div>
        
        <div class="next_button190416">
		<?php if($_GET['uid'] != ''){ ?>
			<a href="<?php echo base_url('user/profile/uid/'.$_GET['uid'].'?g=tutorpro');?>" class="">
        <img src="<?php echo base_url();?>images/next_button190416.png" alt=""/></a>
		<?php
		}else{
		?>
        <a href="#" class="fadeandscale_student_close whatwould03_student_open">
        <img src="<?php echo base_url();?>images/next_button190416.png" alt=""/>
        </a>
		<?php
		}
		?>
        </div>
        
  </div>
</div>

<div class="popup19416_main01 cf" id="fadeandscale_tutor">
  <div class="popup_student190416_main cf">
   	<div class="popup_student190416_left01">
        <div class="number_190416">1</div>
        	
            <p><?php echo $createcoolprofile; ?>.</p>
            <img src="<?php echo base_url();?>images/student_190416_01.png" alt=""/>
            
        </div>
        
    <div class="popup_student190416_left01">
      <div class="number_190416">2</div>
        
        <p><?php echo $setyouravailability; ?></p>
        <img src="<?php echo base_url();?>images/student_190416_05.png" alt=""/>
        
      </div>
        
    <div class="popup_student190416_left01">
        <div class="number_190416">3</div>
        
        	<p><?php echo $practice; ?></p>
            <img src="<?php echo base_url();?>images/student_190416_03.png" alt=""/>
        
        </div>
        
    <div class="popup_student190416_left01">
        <div class="number_190416">4</div>
        
        	<p><?php echo $getpaid; ?></p>
            <img src="<?php echo base_url();?>images/student_190416_06.png" alt=""/>
        
        </div>
        
        <div class="next_button190416">
		<?php if($_GET['uid'] != ''){ ?>
			<a href="<?php echo base_url('user/profile/uid/'.$_GET['uid'].'?g=tutorpro');?>" class="">
        <img src="<?php echo base_url();?>images/next_button190416.png" alt=""/></a>
		<?php
		}else{
		?>
        <a href="#" class="fadeandscale_tutor_close whatwould03_tutor_open">
        <img src="<?php echo base_url();?>images/next_button190416.png" alt=""/></a>
		<?php
		}
		?>
		</div>
        
  </div>
</div>


<div class="popup19416_main01 cf" id="whatwould03_student">
  <div class="what190416_main01 cf">
  	<h5><?php echo $whatwould; ?></h5>
    <div class="text_chat190416_main cf">
    	<div class="text_chat190416_left01">
       		<a href="<?php echo base_url();?>user/dashboard?c=hang">
            <img src="<?php echo base_url();?>images/what_icon190416_01.png" alt=""/>
            <p><?php echo $textchat;?></p>
            </a>
        </div>
      <div class="text_chat190416_left02">
      		<a href="<?php echo base_url();?>search/search">
        	<img src="<?php echo base_url();?>images/what_icon190416_02.png" alt=""/>
            <p><?php echo $searchtutors;?></p>
            </a>
        </div>
      <div class="text_chat190416_left03">
        	<a href="<?php echo base_url();?>user/account">
            <img src="<?php echo base_url();?>images/creditcard.png" alt=""/>
            <p><?php echo "Buy Credits";?></p>
            </a>
        </div>
    </div>
  </div>
</div>

<div class="popup19416_main01 cf" id="whatwould03_tutor">
  <div class="what190416_main01 cf">
  	<h5><?php echo $whatwould; ?></h5>
    <div class="text_chat190416_main cf">
    	<div class="text_chat190416_left01_tutor">
       		<a href="<?php echo base_url();?>user/dashboard?c=hang">
            <img src="<?php echo base_url();?>images/what_icon190416_01.png" alt=""/>
            <p><?php echo $textchat;?></p>
            </a>
        </div>
      <div class="text_chat190416_left03">
        	<a href="<?php echo base_url();?>user/registeredit">
            <img src="<?php echo base_url();?>images/what_icon190416_03.png" alt=""/>
            <p><?php echo $setupprofile;?></p>
            </a>
        </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.popupoverlay.js"></script>
<script>
$(document).ready(function () {
	$('#welcome').popup({
      transition: 'all 0.3s',
      scrolllock: true,
	  autoopen: true,
	  blur: false,
	  escape: false
    });
	
    $('#fadeandscale_student').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s',
		blur: false,
		escape: false
    });
	$('#fadeandscale_tutor').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s',
		blur: false,
		escape: false
    });
	$('#whatwould03_student').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s',
		blur: false,
		escape: false
    });
	$('#whatwould03_tutor').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s',
		blur: false,
		escape: false
    });
});
</script>
