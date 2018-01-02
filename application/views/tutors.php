<?php $this->layout->appendFile('css',"css/tutors.css");?>
<script>
$(function(){
	$('.baseBox.clearfix').removeClass('baseBox').removeClass('clearfix');
})
</script>

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

$arrVal = $this->lookup_model->getValue('175', $multi_lang);
$instruction_to_apply = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('163', $multi_lang);
$how_our_system_works = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('164', $multi_lang);
$click_home_page_to_register = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('165', $multi_lang);
$fill_out_personal_profile = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('176', $multi_lang);
$get_started = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('304', $multi_lang);
$we_are_marketing = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('305', $multi_lang);
$over_200million = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('306', $multi_lang);
$potential_english = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('307', $multi_lang);
$you_will_be_sent_an_email = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('308', $multi_lang);
$view_tutor_preparation = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('309', $multi_lang);
$in_order_to_pass = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('310', $multi_lang);
$with_passing_score = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('311', $multi_lang);
$contact_our_tutor_support = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('312', $multi_lang);
$you_will_be_creating = $arrVal[$multi_lang];

?>
	
<div class="wrap">
	<div class="tutors_banner">
		<img src="images/tutors/banner.png" />
	</div>
	
	<div class="tutors_box clearfix">
		<!-- tutors_box_l BEGIN -->
		<div class="tutors_box_l">
			<h3><?php echo $instruction_to_apply;?>:</h3>
			<ul class="tutors_text">
				<li><em>1</em><?php echo $how_our_system_works;?>:  <a href="<?php echo base_url('training/howItWorks');?>"><?php echo base_url('training/howItWorks');?></a></li>
				<li><em>2</em><?php echo $click_home_page_to_register;?>:  <a href="http://www.thetalklist.com">www.thetalklist.com.</a></li>
				<li><em>3</em><?php echo $fill_out_personal_profile;?>.</li>
				<li><em>4</em><?php echo $you_will_be_sent_an_email;?>.</li>
				<li><em>5</em><?php echo $view_tutor_preparation;?></li>
				<li><em>6</em><?php echo $with_passing_score;?>.</li>     
				<li><em>7</em><?php echo $contact_our_tutor_support;?>:  support@thetalklist.com, 619-354-2505 x707.</li>
			</ul>
		</div>
		<!-- tutors_box_l END -->
		
		<!-- get_STARTED BEGIN -->
		<div class="get_STARTED">
			<h3><?php echo $get_started;?></h3>
			<div class="start_bd">
				<p><?php echo $we_are_marketing;?> <strong><?php //echo $over_200million;?></strong> <?php //echo $potential_english;?>.</p>  

				<p><?php echo $you_will_be_creating;?></p>
			</div>
		</div>
		<!-- get_STARTED END -->
		
	</div>
	
</div>