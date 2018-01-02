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
            	<div class="video_block11516_left01">
					<a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
					<img src='<?php echo base_url("uploads/video/images/".$lessons[$i]['source'].".jpg"); ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'></a>
				</div>
					<div class="video_block11516_right01">
						<h2><?php echo $lessons[$i]['name']; ?><span><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></span></h2>
						<div class="video_like01 cf">
							<a href="#"><img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/></a>
							<span><?php echo $lessons[$i]['likes']; ?></span>
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
	<?php $lessonId = end($lessons); //echo $lessonId['id']; ?>
	<div class='show_more_more' id='<?php echo $lessonId['id']; ?>'><a href='#'>Show more..</a></div>
