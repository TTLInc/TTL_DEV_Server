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
$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);	$lSEARCH   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('523', $multi_lang);	$lfaqhead  				= $arrVal[$multi_lang];
//--R&D@Oct-29-2013
$this->layout->appendFile('css',"css/terms.css");
$this->layout->appendFile('css',"css/forum.css");
?>
 
<div class="terms cmspg">
    <div class="faqs-ttl content" style="font-size:12px;"><h2><?php echo $lFAQ;?></h2></div>
	<table width="100%">
	<tr>
	<td>
	<div class="terms_mid"  style="margin:-31px 0px 11px -29px !important;"><h1><?php echo $lfaqhead;?></h1></div>
	</td><td>
	<div class="terms_top" style="float:right;width:310px;border-radius: 10px 10px 10px 10px;border-bottom:0px;border-top:0px;">
	<form id= "faqSearch" name="faqSearch" method="POST" action="faqs">
	<input class="ipt_text_lg" type="text" name="search" id="searchTxt" placeholder="<?php echo $lENTER_KEYWORD;?>" style="height:25px;margin-top:5px;margin-right:5px;margin-left:5px;float:left;font-weight:none;font-style:italic;-moz-border-radius: 10px;border-radius: 10px;border:solid 0.1px black;-webkit-appearance: textfield">
	<input id="searchFaq" type="submit" name="submit" value="<?php echo $lSEARCH;?>" class="blu-btn aqua_btn" style="border:none;float:right; margin-top: 5px;margin-right:25px;cursor:pointer;">
	</form>
		<label id="searchQText" style="color:red;font-size:12px;width:200px;display:none;"><?php echo $lFAQ_ERROR;?></label>
	</div>
	
	</td></tr></table>
	
	<div class="terms_mid" id="terms_mid">
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
<script type="text/javascript">

$( "#faqSearch" ).submit(function( event ) {
	event.preventDefault();
	var $form = $( this ),
	term = $form.find( "input[name='search']" ).val(),

		url = $form.attr( "action" );
		if(term != ""){
			$( '#searchQText' ).css('display','none');
			var posting = $.post( url, { search: term } );
			posting.done(function( data ) {
				
				if(data =="<h1>No Records Found.</h1>"){
					//alert(data);
					data = '<h1><?php echo $lNO_RECORDS;?></h1>';
				}
				document.getElementById("terms_mid").innerHTML = "";
				document.getElementById("terms_mid").innerHTML = data;
								
			});
		}else{
			$( '#searchQText' ).css('display','block');
			document.getElementById("searchTxt").focus();
		}
});

</script>
   <script type="text/javascript">
    function updateUserActivityStatus(){
		var dataString = '';
				$.ajax({
					type	: "POST",
					url 	: "<?php echo base_url('/support/getuserpdatectivitytatus');?>",
					data	: dataString,
					cache	: false,
					success: function(html){ 
					//alert(html)
					if(html == "TRUE"){
						$('#imLink').html('Instant Messaging('+html+')');
					}else{
						$('#imLink').html('Instant Messaging('+html+')');
					}
					
					}
				});
	}
	setInterval(function(){ updateUserActivityStatus();},2000);
    </script>
	<!--JavaScripts to detect user's activity status: Ends-->

