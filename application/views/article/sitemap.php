<?php $this->layout->appendFile('css',"css/terms.css");?>
<style>
.terms_mid p {padding:5px 5px 0 ;}
</style>
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
$arrVal 	= $this->lookup_model->getValue('316', $multi_lang);
$lsite_map	= $arrVal[$multi_lang];
?>
<div class="terms">
	<!--<div class="terms_top"><?php echo $lsite_map;?></div>-->
	<div class="terms_mid sit-lnk">
		<?php echo $article['desc'];?>
	</div>
</div>
<script>
$(function(){
	$.get('<?php echo base_url('article/makeSiteMap');?>',function(){

	})
})
</script>