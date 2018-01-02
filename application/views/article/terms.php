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

$arrVal 	= $this->lookup_model->getValue('133', $multi_lang);
$lterms_title	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('188', $multi_lang);
$lterms_content	= $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('css',"css/terms.css");?>
<div class="terms">
	<!--<div class="terms_top"><?php echo $lterms_title;//$article['title'];?></div>-->
	<div class="terms_mid">
		<?php echo $lterms_content; //$article['desc'];?>
	</div>
</div>