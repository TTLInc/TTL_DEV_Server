<?php 
/*header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache'); */

?>
<?php
?>
    <div class="video_3colum_main cf">
    	<ul class="cf">
			<?php
			if(count($lessons > 0)){
				for($i = 0; $i < count($lessons); $i++){
			?>
        	<li>
				<div class="video_block11516_main01 cf">
				<?php
							$filename = "http://52.8.248.161/uploads/video/".$lessons[$i]['source'].".jpg";
							$size = getimagesize($filename);
							if($size[1] > $size[0]){
							?>
							<div class="video_block11516_left02">
							<?php
							}else{
							?>
							<div class="video_block11516_left01">
							<?php
							}
							?>
					<a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
					<?php
							$filename = "uploads/video/".$lessons[$i]['source'].".jpg";
					if (file_exists($filename)) {
						?>	
					<img src='<?php echo "http://52.8.248.161/uploads/video/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
					<?php } else { ?>
							<img src='<?php echo "http://52.8.248.161/uploads/video/images/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
						<?php
							}
						?>
					</a>
				</div>
					<div class="video_block11516_right01">
						<h2><a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'><?php echo $lessons[$i]['name']; ?></a><span><a href='<?php echo base_url("user/profile/uid/".$lessons[$i]['uid']);?>'><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></a></span></h2>
						<div class="video_like01 cf">
							<a href="#"><img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/></a>
							<span><?php echo $lessons[$i]['likes']; ?></span>
						</div>
						<div class="video_like01 cf">
							<img src="<?php echo base_url("images/filesq-viewer-icon.png")?>" alt=""/>
							<span><?php echo $lessons[$i]['views']; ?></span>
						</div>
					</div>
				</div>
			</li>
			<?php
				}
			}else{
				echo "Video not found";
			}
			?>
        </ul>
    </div>
	<?php $lessonId = end($lessons); //echo $lessonId['id']; 
	$showmore = count($lessons);
	
	if($showmore == 15){
	?>
	<div class='show_more_more' id='<?php echo $lessonId['id']; ?>'>Show more..</div>
	<?php
	}
	?>
	<div class="nick_show_more_more" style="display:none"></div>