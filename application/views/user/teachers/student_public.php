<?php
redirect('user/login');
exit;
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
$arrVal = $this->lookup_model->getValue('192', $multi_lang);
$lcurrenttutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('193', $multi_lang);
$lhourlyrate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('194', $multi_lang);
$lremove = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('196', $multi_lang);
$lappointment = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('197', $multi_lang);
$lpotentialtutor = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
 <div class="baseBox baseBoxBg clearfix">
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
					<?php echo profile_menu('s_public','t_prof',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                	<div class="mod">
                        
                            <div class="content tle"><h2><?php echo $lcurrenttutor;?></h2></div>
                       
                        <div class="bd">
                        	<ul class="teacher_list clearfix">
                                <?php foreach($teachers as $k=>$teacher):?>
								<?php if($teacher['type']==0):?>
								<li class="teacher_box">
                                    <div class="techer_box_t"></div>
                                    <div class="techer_box_c">
                                    	<div class="teacher_info fl">
                                        	<div><a href="javascript:void(0)" class="c939393 delTeacher"><em class="ico_op ico_del2"></em><?php echo $lremove;?></a></div>
                                            <p class="c437a86">Session Rate:</p>
											<p><?php echo number_format(round($teacher['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.','');?> credits</p>
                                        </div>
                                        <div class="teacher_header fr">
                                        	<p><a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" title=""><img src="<?php echo profile_image($teacher['pic']);?>" width="111"  alt="" style="max-height:125px"/></a></p>
                                           
                                        </div>
                                        <div class="spc10c"></div>
                                        <div class="teacher_name"><?php echo $teacher['firstName'],' ',$teacher['lastName'];?></div>
                                        <div class="agnC ">
                                        	<a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" class="norBtn grayRadiusBtn w96 f12"><?php echo $lprofile;?></a>
                                            <a href="#" class="norBtn redRadiusBtn2 w96 f12"><?php echo $lappointment;?></a>
                                        </div>
                                    </div>
                                </li>
								<?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mod">
                        
                            <div class="content tle"><h2><?php echo $lpotentialtutor;?></h2></div>
                        
                        <div class="bd">
                        	<ul class="teacher_list clearfix">
                                <?php foreach($teachers as $k=>$teacher):?>
								<?php if($teacher['type']==1):?>
								<li class="teacher_box">
                                    <div class="techer_box_t"></div>
                                    <div class="techer_box_c">
                                    	<div class="teacher_info fl">
                                        	<div><a href="javascript:void(0)" class="c939393 delTeacher"><em class="ico_op ico_del2"></em><?php echo $lremove;?></a></div>
                                            <p class="c437a86">Session Rate:</p>
											<p><?php echo @$teacher['hRate'];?> credits</p>
                                        </div>
                                        <div class="teacher_header fr">
                                        	<p><a href="javascript:void(0)" title=""><img src="<?php echo profile_image($teacher['pic']);?>" width="111"  alt="" style="max-height:125px"/></a></p>
                                           
                                        </div>
                                        <div class="spc10c"></div>
                                        <div class="teacher_name"><?php echo $teacher['firstName'],' ',$teacher['lastName'];?></div>
                                        <div class="agnC ">
                                        	<a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" class="norBtn grayRadiusBtn w96 f12"><?php echo $lprofile;?></a>
                                            <a href="#" class="norBtn redRadiusBtn2 w96 f12"><?php echo $lappointment;?></a>
                                        </div>
                                    </div>
                                </li>
								<?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/../leftSide.php';?>
    </div>
	<textarea id="calendarTemp" style="display:none"  rows="0" cols="0">
		<!--
		<table width="720px" height="500px" cellpadding="2" cellspacing="2" border="1">
			<thead>
				<th class="prev"> <a href="javascript:Calendar.getInstance().move(-1);"> < </a></th>
				<th colspan="5" class="month"> {$T.month} </th>
				<th class="next"> <a href="javascript:Calendar.getInstance().move(1);"> > </a> </th>
			</thead>
			{#foreach $T.rows as row}
			<tr>
				{#foreach $T.row as day}
				<td class="col {$T.day.thisMonth} {$T.day.today}">
					<div class="title day_{$T.day.month}_{$T.day.day}">
						<span class="weekday">{$T.day.weekDay}</span>
						<span class="event"></span>
					</div>
					<div class="day">{$T.day.day}</div>  
				</td>
				{#/for}
			</tr>
			{#/for}
		</table>
		-->
	</textarea>
	<script>
	$(function(){
		
		$('.delTeacher').hide();
		$('.teacher_box').hover(function(){
			$('.delTeacher',this).show();
		},function(){
			$('.delTeacher',this).hide();
		})

	})
	</script>