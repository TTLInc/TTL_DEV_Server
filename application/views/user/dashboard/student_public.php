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
$arrVal = $this->lookup_model->getValue('181', $multi_lang);
$lstudent_no_calendar = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
 <div class="baseBox baseBoxBg clearfix">
    
	<?php include dirname(__FILE__).'/../leftSide.php';?>	
	<div class="content_main fr">
		<div class="main_inner">
			<ul class="student_prof">
				<?php echo profile_menu('s_public','c_prof',$profile['uid']);?>
			</ul>
			<div id="teacher_prof_Wp">
				<div class="mod">
					<?php echo $lstudent_no_calendar;?>!!
				</div>                
			</div>
			<!--/student_prof_Wp-->
		</div>
	</div>
</div>