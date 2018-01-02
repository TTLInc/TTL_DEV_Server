<?php 
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
$this->layout->appendFile('css',"css/terms.css");
$this->layout->appendFile('css',"css/forum.css");

$arrVal 	= $this->lookup_model->getValue('1174', $multi_lang);	$LanguageApp 	= $arrVal[$multi_lang];
?>
 
<div class="terms cmspg">
    <div class="faqs-ttl content" style="font-size:12px;"><h2><?php echo $LanguageApp;?></h2></div>
	 
	
	<div class="terms_mid" id="terms_mid">
	<?php
	if($app){
		foreach($app as $apps){   ?>
        <div class="app-cnt">
		<h1><a  target="_blank" href="<?php echo 'http://'.$apps['Link']; ?>"><?php echo $apps['Title']; ?></a></h1>
		<p><a  target="_blank" href="<?php echo 'http://'.$apps['Link']; ?>"><img src="<?php echo base_url().'LanuageApp/'.$apps['Source']; ?>" width="150" height="150" alt="02" /></a></p>
		<p><?php echo $apps['Desc']; ?></p>
        </div>
		<hr/>
		<?php } 
	}else{
		echo '<h1>'.$lNO_RECORDS.'</h1>';
	}
	?>
	</div>
</div>
 
 

