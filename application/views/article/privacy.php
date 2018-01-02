<?php $this->layout->appendFile('css',"css/privacy.css");?>
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

$arrVal 		= $this->lookup_model->getValue('37', $multi_lang);
$lprivacy_title		= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('36', $multi_lang);
$lprivacy_content	= $arrVal[$multi_lang];
?>

<div class="privacy">
	<!--<div class="privacy_top"><?php echo $lprivacy_title;?></div>-->
	<div class="privacy_mid"><?php echo $lprivacy_content; //$article['desc'];?></div>
</div>