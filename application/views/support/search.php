<?php 
//--R&D@Oct-29-2013
$multi_lang = 'en';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('414', $multi_lang);
$lFAQ   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('389', $multi_lang);
$lENTER_KEYWORD   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('415', $multi_lang);
$lFAQ_ERROR   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('418', $multi_lang);
$lNO_RECORDS   = @$arrVal[$multi_lang];

//--R&D@Oct-29-2013



$this->layout->appendFile('css',"css/terms.css");?>
<div class="terms">
	<div class="terms_top"><?php echo $lFAQ;?></div>
	<div class="terms_top" style="float:right;">
	<form name="faqSearch" method="POST" action="search">
	<input type="text" name="search" value="<?php echo $query;?>">
	<input type="submit" name="submit" value="Search">
	</form>
	</div>
	<br />
	<div class="terms_mid">
	<?php
	if($faqs){
		foreach($faqs as $faq){   ?>
		<h1><?php echo $faq['question']; ?></h1>
		<p><?php echo $faq['answer']; ?></p>
		<hr/>
		<?php } 
	
	}else{
		echo '<h1>'.$lNO_RECORDS.'</h1>';
	}

	?>
	</div>
</div>
	<!--Form to update user's activity status : Starts-->
	<form name="userIdleStatus" id="userIdleStatus" method="post" action="admin/userpdatectivitytatus">
	<input type="hidden" id="userIdleStatusValue" value="" name="userIdleStatusValue">
	</form>
	<!--Form to update user's activity status : Starts-->
	<!--JavaScripts to detect user's activity status : Starts-->
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('js/idle/idle-timer.js');?>"></script>
    <script type="text/javascript">
    function updateUserActivityStatus(status){
		//alert(status);
		$('input[name=userIdleStatusValue]').val(status);
		var dataString = 'status='+status;
				$.ajax({
					type	: "POST",
					url 	: "admin/getuserpdatectivitytatus",
					data	: dataString,
					cache	: false,
					success: function(html){ alert(html)}
				});
	}
	YUI().use("*", function(Y){
        Y.IdleTimer.subscribe("idle", function(){
            //Y.get("#status").set("innerHTML", "User is idle :(").set("style.backgroundColor", "silver");
			//updateUserActivityStatus('FALSE');
			//alert('idle');
		});  
        Y.IdleTimer.subscribe("active", function(){
             //Y.get("#status").set("innerHTML", "User is active :D").set("style.backgroundColor", "yellow");
			//alert('active');
			//updateUserActivityStatus('TRUE');
		});
        Y.IdleTimer.start(10000);
    });
    </script>
	<!--JavaScripts to detect user's activity status: Ends-->