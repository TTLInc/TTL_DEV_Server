<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
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
                            <div class="content tle"><h2>Trining Requirements</h2></div>
                        </div>
                        <div class="bd">
							<form name="takingtest" id="takingtest" method="post">
							<table class="history_table f14" border=0>							
								<tr>
									<th>
										
										<h2><?php echo $document['title']; ?></h2>
										
									</th>
								</tr>
								<tr>
									
									
									
									<td>
										<div id="docfile">
										<?php
											$documentfile = FCPATH.'uploads/LMS/'.$document['document_file'];
											$documentfileURL = base_url().'uploads/LMS/'.$document['document_file'];
											$documentfileURLFim = base_url().'uploads/LMS/images/'.$document['document_file'].'jpg';
											
											
											if(file_exists($documentfile))
											{
												$pathinfo = pathinfo($documentfile);
												//$pdf = pdf_new();
												
												if($pathinfo['extension'] == 'pdf')
												{
													$filename = 'trainingrequirements.pdf'; 
													header('Content-type: application/pdf');
													header('Content-Disposition: inline; filename="' . $filename . '"');
													header('Content-Transfer-Encoding: binary');
													header('Content-Length: ' . filesize($documentfile));
													header('Accept-Ranges: bytes');

													@readfile($documentfile);
												}else if($pathinfo['extension'] == 'txt')
												{
													$handle = @fopen($documentfile, "r");
													if ($handle) {
														while (($buffer = fgets($handle, 4096)) !== false) {
															echo $buffer;
														}
														if (!feof($handle)) {
															echo "Error: unexpected fgets() fail\n";
														}
														fclose($handle);
													}
												}else if($pathinfo['extension'] == 'mp4')
												{
													?>
													<div class="video" height="385px" width="314px">
													<div  id="player_b">
														<div class="video_Wp posR projekktor"  id="player_a"></div>
													</div>
													</div>
													<script type="text/javascript">
														$(function(){
															createVideo1('<?php echo $documentfileURLFim; ?>','<?php echo $documentfileURL; ?>');
														});
														
													</script>
													<?php
													
													
												}else if($pathinfo['extension'] == 'jpg' || $pathinfo['extension'] == 'gif' ||  $pathinfo['extension'] == 'png' )
												{
													echo '<img src="'.$documentfileURL.'" alt="No Image" />';
												}else if ($pathinfo['extension'] == 'doc')
												{
													if ( ($fh = fopen($documentfile, 'r')) !== false ) {
														$headers = fread($fh, 0xA00);
														$n1 = ( ord($headers[0x21C]) - 1 );
														$n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );
														$n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );
														$n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );
														$textLength = ($n1 + $n2 + $n3 + $n4);
														$extracted_plaintext = fread($fh, $textLength);
														//echo $extracted_plaintext;
														echo nl2br($extracted_plaintext);
													}
												}else
												{
													echo 'File format is not supported';
												}
																								
											}
										?>
										</div>
									</td>
									
									
								</tr>
										
									
								
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
	
    <style>
	.read0 td a{color:#000;}
    .redRadiusBtn2 { padding:0 10px;}
	
    </style>
	<script>
		function createVideo1(poster,videoPath){
			//alert('hi');
			//alert(videoPath);
			$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
			proje = '';
			proje = projekktor('#player_a', {
				title: "<?php //echo $profile['username'];?>'Guest Member’s video",
				debug: false,
				poster: poster,
				width: 719,
				height: 397,
				playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
				playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
				controls: true,
				playlist: [
					{
						0: {src:videoPath, type:'video/mp4'}
						
					}
				] 
			});
		}
	</script>
