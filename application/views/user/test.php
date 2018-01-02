<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");
?>
<script>
jQuery(document).ready(function($) {
        <?php if($profile['alertType'][0] == 0){ ?>
		$("#emailalerttime").attr('disabled', '');
		<?php }
		if($profile['alertType'][1] == 0){ ?>
		$("#textalerttime").attr('disabled', '');
		<?php } ?>
});
		
$(function(){
	$('#submitTest').click(function(){
		$('#takingtest').submit();
	})
});
</script>
 <div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr">
        	<div class="main_inner">
                
                <?php echo profile_menu($linkType,'p_prof');?>
               <?php
					$sendType1 = $profile['alertType'][0];
					$sendType2 = $profile['alertType'][1];
				?>
                <!--/student_prof-->
				<div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="pro_tle tle"><h3>Taking Test</h3></div>
                        </div>
                        <div class="bd">
							<form name="takingtest" id="takingtest" method="post">
							<table class="history_table f14" border=0>							
							<?php 
							// echo '<pre>';
							// print_r($questions);
							// exit;
							if($existingTest)
							{
								//exit;
								if(@$existingTest['retest'] == 1)
								{
									$nowDate = date('Y-m-d H:i:s',time());
									$existsDate = @$existingTest['date'];
									$nowstr = strtotime($nowDate);
									$disstr = strtotime($existsDate);
									
									$diff = round(($nowstr - $disstr)/60);
									//echo $diff;exit; 
									if($diff>1440 && $existingTest['retest']>2)
									{
										?><tr><td>You have attempts maximum tries for this Exam.<br/>You are not allowed to attempt this Exam.</td></tr><?php
									}else if($diff>1440)
									{
										if($questions)
										{
											$no = 1;
											foreach($questions as $questions)
											{
											?>
												<tr>
													<td align="right" width="5px;">
														<?php echo $no; ?>.
													</td>
													<td>
														<?php echo $questions['question']; ?>
													</td>
												</tr>
												<tr>
													<td width="5px;">&nbsp;</td>
													<td>
														<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_1" value="1"> <?php echo $questions['ans1']; ?><br/>
														<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_2" value="2"> <?php echo $questions['ans2']; ?><br/>
														<?php if($questions['ans3'] !=  ''){ ?>
														<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_3" value="3"> <?php echo $questions['ans3']; ?><br/>
														<?php } ?>
														<?php if($questions['ans4'] !=  ''){ ?>
														<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_4" value="4"> <?php echo $questions['ans4']; ?><br/>
														<?php } ?>
														
													</td>
												</tr>
											<?php
											$no++;
											}
											?>
											<tr><td style="background:none;" colspan="3"><a class="save-btn" href="javascript:;" id="submitTest">Submit</a></td></tr>
										<?php 
										}
									}else{
										?>
										<tr><td>You Re-Test session is disabled. It will be enabled after 24 hours of your given last test.</td></tr>
									<?php
									}
									
								}
							}else
							{
								if($questions)
								{
									$no = 1;
									foreach($questions as $questions)
									{
									?>
										<tr>
											<td align="right" width="5px;">
												<?php echo $no; ?>.
											</td>
											<td>
												<?php echo $questions['question']; ?>
											</td>
										</tr>
										<tr>
											<td width="5px;">&nbsp;</td>
											<td>
												<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_1" value="1"> <?php echo $questions['ans1']; ?><br/>
												<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_2" value="2"> <?php echo $questions['ans2']; ?><br/>
												<?php if($questions['ans3'] !=  ''){ ?>
												<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_3" value="3"> <?php echo $questions['ans3']; ?><br/>
												<?php } ?>
												<?php if($questions['ans4'] !=  ''){ ?>
												<input type="radio" name="ans_<?php echo $questions['id']; ?>" id="que_<?php echo $questions['id']; ?>_ans_4" value="4"> <?php echo $questions['ans4']; ?><br/>
												<?php } ?>
												
											</td>
										</tr>
									<?php
									$no++;
									}
									?>
									<tr><td style="background:none;" colspan="3"><a class="save-btn" href="javascript:;" id="submitTest">Submit</a></td></tr>
								<?php 
								}
							}
								?>	
								
								<?php 
								// display result here
								if($result)
								{
									?>
										<tr>
											<?php if(@$result['passed'] == 1): ?>
											<td>
												Congratulation you have passed the exam. Your score is <?php echo @$result['score']; ?> %<br/>
												Now your profile is viewable in tutor search page and booking system.
											</td>
											<?php else: ?>
											<td>
												You have failed in the exam. Your score is <?php echo @$result['score']; ?> %<br/>
												You can Re-Test this exam after 24 Hour. 
											</td>
											<?php endif; ?>
											
										</tr>
										
									<?php
								}
								
								?>
								
							</table>
							</form>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<div id="dialog1" title="Confirm" style="display:none">
		<p>Are you sure you want to delete it?</p>
	</div>
    <style>
	.read0 td a{color:#000;}
    .redRadiusBtn2 { padding:0 10px;}
	
    </style>
