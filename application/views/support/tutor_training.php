<?php 
$multi_lang = 'en';
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('721', $multi_lang);
$tutor_training   = @$arrVal[$multi_lang];
$this->layout->appendFile('css',"css/how_works.css");

$arrVal 	= $this->lookup_model->getValue('757', $multi_lang);
$earn   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('758', $multi_lang);
$we_are   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('759', $multi_lang);
$un_requirment   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('760', $multi_lang);
$tips   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('761', $multi_lang);
$prepare   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('762', $multi_lang);
$operate   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('763', $multi_lang);
$market   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('764', $multi_lang);
$click   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('765', $multi_lang);
$lead   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('766', $multi_lang);
$launch   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('810', $multi_lang);
$maytake   = @$arrVal[$multi_lang];

?>

<div class="">
		 <div class="faqs-ttl content" style="font-size:12px;">
		<h2>
		<?php echo  $tutor_training;?>
		</h2>
	</div>
	  <h1 class="earn"><?php echo $earn?></h1> <br>
		<h2><?php echo $we_are; ?>
		</h2>
		<div style="height:180px;">

		<div style="width:50%;float:left">
		
		
		<h2>
		<ul>
		<li class="hul"><?php echo $un_requirment;?></li>
		<li class="hul"><?php echo $tips;?></li>
		<li class="hul"><?php echo $prepare;?></li>
		<li class="hul"><?php echo $operate;?></li>
		<li class="hul"><?php echo $market;?></li>
		</ul>
		</h2>

</div>
<div style="width:50%;float:right;">
<img class="himg" src="<?php echo base_url('images/silver.png')?>" width="70px;"> 
</div>
</div>
<h2><?php echo $click; ?><br />
<?php echo $maytake; ?>
<br><?php echo $lead;?>
</h2>
<br>
<a href="<?php echo site_url('support/training'); ?>" target="_blank" class="blu-btn"><?php echo $launch;?></a>
</div>

<style>
.earn{
    color:#3399CC;
    font-size: 16px;
    font-weight: bold;
    padding-top: 10px;
	padding-left:20px;
	font-family: verdana;
	}
	h2
	{
	color:#585858;
    font-family:verdana;
    font-size: 13px;
	padding-top: 10px;
	padding-left:50px;
	line-height:20px;
	}
	.hul
	{
	color:#585858;
    font-family:verdana;
    font-size: 13px;
    padding-top: 10px;
	padding-left:50px;
	}
	
	.blu-btn
	{
    margin-top:40px;
	margin-left:50px;
	margin-bottom:40px;
	}
	.himg
	{
	padding-top:55px;
	}
</style>