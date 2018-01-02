<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>
<div id="videocontainer">
<a href="#" class="hidevideo videohide">Hide</a>
<br>
<div class="videotitle"><?php echo $fresult['name']; ?><br><br></div>
<div class="videosection">
<video style="cursor:pointer;background-color:#000;" id="example_video_top" class="video-js vjs-default-skin vjs-big-play-centered" width="99.9%" height="378px" controls preload="auto"  poster="<?php echo $poster;?>" data-setup="{}" >
	<source src="<?php echo "http://52.8.248.161/uploads/video/".$fresult['source'];?>" type="video/mp4"></source>
	<source src="<?php echo "http://52.8.248.161/uploads/video/".$fresult['source'];?>" type="video/ogg"></source>
	Your browser does not support video player.
</video>
</div>
</div>
<script>
$(function(){
	$('.hidevideo').click(function(){
		$('#videocontainer').hide();
	})
});
</script>