<?php
$baseurl	=	'http://plusaim.co.uk/video3/';
ini_set('error_reporting', 0);
ini_set('display_errors', 'off');
//----set ffmpeg path----//
$ffmpegPath 		= '/usr/local/bin/ffmpeg';

//----General Functions----//
function get_video_dimensions($video = false){
	global $ffmpegPath;
	$data 				= array();
	if (file_exists ( $video )) {
			$command 			= $ffmpegPath . ' -i ' . $video . ' -vstats 2>&1';
			$output 			= shell_exec ( $command );

			$result 			= ereg ( '[0-9]?[0-9][0-9][0-9]x[0-9][0-9][0-9][0-9]?', $output, $regs );
			$data['dimension'] 	= $regs[0];

			preg_match('/bitrate:\s(?<bitrate>\d+)\skb\/s/', $output, $vid);
			$data['video_bit'] = $vid['bitrate']."K";

			preg_match('/,\s(?<bitrate>\d+)\skb\/s/', $output, $aud);
			$data['audio_bit'] = ($aud['bitrate'] <= '111' ) ? '128k' : $aud['bitrate']."k";

			if ($data['dimension'] != '' && $data['video_bit'] != '' && $data['audio_bit']) {
				return $data;
			}else{
				return false;
			}
	}else{
			return false;
	}
}

function getExtension($name) {
	$ext	=		$name;
	if (strpos($name,".")) {
		$ext	=	substr($name,strpos($name,".")+1,strlen($name)-strpos($name,".")-1);
		if (strpos($ext,".")) {
			return getExtension($ext);
		}
	}
	return strtolower($ext);
}
function get_video_orientation($video_path) {
	global $ffmpegPath;
	define(FFMPEG_PATH ,$ffmpegPath );
	$cmd 			= '/usr/local/bin/ffprobe  -i ' . $video_path . ' -show_streams 2>&1';
	$result 		= shell_exec($cmd);
	
	$orientation 	= 0;
	if(strpos($result, 'TAG:rotate') !== FALSE) {
		$result = explode("\n", $result);
		foreach($result as $line) {
			if(strpos($line, 'TAG:rotate') !== FALSE) {
				$stream_info = explode("=", $line);
				$orientation = $stream_info[1];
			}
		}
	}
	return $orientation;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>The TalkList : Video Test</title>
<script id="jwplayer_script" type='text/javascript' src='<?php echo $baseurl;?>jwplayer/jwplayer.js'></script>
<link href="http://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script id="vjs_script" src="http://vjs.zencdn.net/4.2/video.js"></script>				
</head>
<body>
<style type="text/css">
* {margin: 0;padding: 0;}
body {font-size: 62.5%;font-family: Helvetica, sans-serif;background: url(images/stripe.png) repeat;}
p {font-size: 1.3em;margin-bottom: 15px;}
#page-wrap {width: 660px;background: white;padding: 20px 50px 20px 50px;margin: 20px auto;min-height: 500px;height: auto !important;height: 500px;}
#contact-area {width: 600px;margin-top: 25px;}
#contact-area input, #contact-area textarea {padding: 5px;width: 471px;font-family: Helvetica, sans-serif;font-size: 1.4em;margin: 0px 0px 10px 0px;border: 2px solid #ccc;}
#contact-area textarea {height: 90px;}
#contact-area textarea:focus, #contact-area input:focus {border: 2px solid #900;}
#contact-area input.submit-button {width: 100px;float: right;}
label {float: left;text-align: right;margin-right: 15px;width: 100px;padding-top: 5px;font-size: 1.4em;}
.vjs-default-skin .vjs-big-play-button {left: 37%!important;top: 36%!important;}
#contact-area h1{ margin-bottom:25px;}
#contact-area input[type="file"]{ padding:0px; height:35px; border:0 none;}
</style>
<?php 
	if(isset($_POST['submit'])){ ?>
		<div id="page-wrap">
			<div id="contact-area">
				<?php
						if ($_FILES["file"]["error"] > 0){
							echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
						}else{
							
							$uploaded_video 		= rand();
							$_FILES["file"]["name"] = strtolower(str_replace(' ', '_', $_FILES["file"]["name"]));
							move_uploaded_file($_FILES["file"]["tmp_name"], "" . $uploaded_video .''.$_FILES["file"]["name"]);
							$uploaded 				= "" . $uploaded_video .''.$_FILES["file"]["name"];
						}
					   //$uploaded = 'test.avi';
				?>
				<?php	if($uploaded != ""){	 ?>
				<?php
						$file_name					=	$uploaded;


						$ext						=	getExtension($file_name);
						$image 						= 	$baseurl.'black_background.jpg';

						$stamp 						= 0.001; //we are choosing random time frame.
						$f_mpg 						= mt_rand()."_temp1".".mpg";
						$actual_video 				= $file_name; //path of actual video
						$temp1 						= mt_rand()."_temp2.ts";
						$temp2 						= mt_rand()."_temp3.ts";
						//$concated_video 			= mt_rand()."_con".".mpg";
						//$final_video 				= mt_rand().".mp4";
						$fname 						= explode(".",$file_name);
						$final_video 				= $fname[0].".mp4";


						$ffmpegPath 				= '/usr/local/bin/ffmpeg';
						$i 							= 	get_video_dimensions($actual_video);
						$or							=	get_video_orientation($actual_video);

						if($i){
							
							//-----------------------********************----------------------//
							if (($ext=="flv") || ($ext=="3gp") || ($ext=="rmvb")) {
								$imgtoVideo = $ffmpegPath.' -loop 1 -i '.$image.' -c:v libx264 -bsf:v h264_mp4toannexb -pix_fmt yuv420p -t '.$stamp.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$f_mpg.' -vstats 2>&1';
								shell_exec($imgtoVideo);

								$command=$ffmpegPath.' -i '.$file_name.' -c copy -vcodec libx264 '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$temp1;
								shell_exec($command);

								$command=$ffmpegPath.' -i '.$f_mpg.' -c copy -vcodec libx264 -f mpegts '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$temp2;
								shell_exec($command);

								$command=$ffmpegPath.' -i "concat:'.$temp1.'|'.$temp2.'" -c copy -vcodec libx264 -bsf:a aac_adtstoasc '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
								shell_exec($command);
								$rotation			=   $or;
								$output_file_full 	= 	$final_video;
								$ffmpeg				=	$ffmpegPath;
								
								if ($rotation == "90"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}else if ($rotation == "180"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot2.mp4 2>&1") . "\n";
									shell_exec($ffmpeg . ' -i ' . $output_file_full . '.rot2.mp4 -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}else if ($rotation == "270"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=2" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}
								@unlink($f_mpg);
								@unlink($temp1);
								@unlink($temp2);

								$filenameImage = rand().'.jpg';
								shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
							}
							//-----------------------********************----------------------//
							
							
							
							//-----------------------********************----------------------//
							if (($ext=="avi") || ($ext=="wmv") || ($ext=="vob")) {
	
								$fname 				= explode(".",$file_name);
								$final_video 		= $fname[0].".mp4";
								$output_file_full	= $final_video;	
								$command			= $ffmpegPath.' -i '.$file_name.' -c:v libx264  -pix_fmt yuv420p   -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
								shell_exec($command);
								$filenameImage = rand().'.jpg';
								shell_exec($ffmpegPath.' -i '.$output_file_full.' -ss 1 -vframes 1 -s '.$i['dimension'].' '.$filenameImage);
							}
							//-----------------------********************----------------------//
							
							//-----------------------********************----------------------//
							//if (($ext=="mp4") || ($ext=="mov") || ($ext=="mkv")) {
							if (($ext=="mov") || ($ext=="mkv")) {
								$imgtoVideo = $ffmpegPath.' -loop 1 -i '.$image.' -c:v libx264 -bsf:v h264_mp4toannexb -pix_fmt yuv420p -t '.$stamp.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$f_mpg.' -vstats 2>&1';
								shell_exec($imgtoVideo);

								$command=$ffmpegPath.' -i '.$file_name.' -c copy -bsf:v h264_mp4toannexb -pix_fmt yuv420p -f mpegts '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$temp1;
								shell_exec($command);

								$command=$ffmpegPath.' -i '.$f_mpg.' -c copy -bsf:v h264_mp4toannexb -pix_fmt yuv420p -f mpegts '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$temp2;
								shell_exec($command);

								$command=$ffmpegPath.' -i "concat:'.$temp1.'|'.$temp2.'" -c copy -bsf:a aac_adtstoasc '.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
								shell_exec($command);			


								$rotation			=   $or;
								$output_file_full 	= 	$final_video;
								$ffmpeg				=	$ffmpegPath;
								if ($rotation == "90"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}else if ($rotation == "180"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot2.mp4 2>&1") . "\n";
									shell_exec($ffmpeg . ' -i ' . $output_file_full . '.rot2.mp4 -metadata:s:v:0 rotate=0 -vf "transpose=1" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}else if ($rotation == "270"){
									shell_exec($ffmpeg . ' -i ' . $output_file_full . ' -metadata:s:v:0 rotate=0 -vf "transpose=2" ' . $output_file_full . ".rot.mp4 2>&1") . "\n";
									shell_exec("mv $output_file_full.rot.mp4 $output_file_full") . "\n";
								}

								$filenameImage = rand().'.jpg';
								shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);

								@unlink($f_mpg);
								@unlink($temp1);
								@unlink($temp2);
							}

							if (($ext=="mp4")) {
								$output_file_full 	= 	$file_name;
							}
							//if (($ext=="3gp")) {
							//	$output_file_full 	= 	$file_name;
							//}
						}else{
						$output_file_full = $uploaded;
						}
						?>
						<?php //if($current_browser != 'msie'){ ?>
							<div id="vjs_div" style="display:none;">
								<video id="example_video_3" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="505" height="287"  data-setup='{}' poster='<?php echo $baseurl;?><?php echo $filenameImage;?>'>
								<source src="<?php echo $baseurl;?><?php echo $output_file_full;?>" type="video/mp4"/>
								</video>
							</div>
						<?php //} ?>
							<div id="jw_div" style="display:none;">
							<div id="container"></div>
							</div>

						<?php //if($current_browser == 'msie'){ ?>
							<?php //} ?>
							<br/>
							<br/>
							<?php
							echo "<p>Video: " . $_FILES["file"]["name"] . "</p>";
							echo "<p>Type: " . $_FILES["file"]["type"] . "</p>";
							echo "<p>Size: " . ($_FILES["file"]["size"] / 1024) . " Kb</p>";
							?>
<?php	}	?>
		<p style="float:right;font-size:17px;"><a href="<?php echo $baseurl;?>"> Go Back</a></p>
		<br/>
		<br/>
<?php }else{ ?>
<div id="page-wrap">
	<div id="contact-area">
	<h1 style="text-align:center;">The TalkList : Video Test</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="Name">Upload Video:</label>
		<input type="file" name="file" id="file" /> 
		<input type="submit" name="submit" value="Submit" class="submit-button" />
	</form>
	<div style="clear: both;"></div>
	</div>
</div>
<?php } ?>


<script type='text/javascript'>
	function checkBrowser(){
		c		=	navigator.userAgent.search("Chrome");
		f		=	navigator.userAgent.search("Firefox");
		m8		=	navigator.userAgent.search("MSIE 8.0");
		m9		=	navigator.userAgent.search("MSIE 9.0");
		var brwsr = '';
		if (c>-1){
			brwsr = "chrome";
		}else if(f>-1){
			brwsr = "firefox";
		}else if (m9>-1){
			brwsr ="msie";
		}else if (m8>-1){
			brwsr ="msie";
		}else{
			brwsr='msie';
		}
		return brwsr;
	}
	var userAgent 			= checkBrowser();
	var output_file_full 	= '<?php echo $output_file_full;?>';
	
	if(userAgent == 'msie'  && output_file_full != ''){
		document.getElementById("vjs_div").style.display 		= 'none';
		document.getElementById("jw_div").style.display 		= 'block';

		jwplayer('container').setup({
			flashplayer: '<?php echo $baseurl;?>jwplayer/player.swf',
			file:'<?php echo $baseurl;?><?php echo $output_file_full;?>',
			image:'<?php echo $baseurl;?><?php echo $filenameImage;?>',
			height: 400,
			width: 600,
			'playlist.position': 'right',
			'playlist.size': 80
		});
	}else{
		if(output_file_full != ''){
			document.getElementById("jwplayer_script").remove();
			videojs.options.flash.swf = "<?php echo $baseurl;?>video-js.swf";
			document.getElementById("vjs_div").style.display 		= 'block';
			document.getElementById("jw_div").style.display 		= 'none';
		}
	}
</script>	
</body>
</html>