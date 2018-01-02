<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('error_reporting',		 '0');
		ini_set('display_errors', 		 'off');
class Videoconvert extends TL_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
	
	function index(){
		$qry = $this->db->query("select `id`,`uid`,`vedio` from `profile` where `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
		if($qry->num_rows()>0)
		{
			$result = $qry->result_array(); // Get Result in Array
			print_r($result);
			foreach($result as $key=>$value){
				$ext = explode(".",$value['vedio']);
				if(strtolower($ext[1]) != "mp4"){					
					//$response = $this->convertVideoProcess($value['vedio']); // pass video file name
					$video = $value['vedio'];
					$uploaddir	=	FCPATH."uploads/video/";	//'/home/wawoo/public_html/vedio/';
					@chmod($uploaddir, 0777);
					ini_set('error_reporting',		 '0');
					ini_set('display_errors', 		 'off');
					ini_set('max_execution_time', 	 '60000000');
					ini_set('max_file_uploads', 	 '60000000');
					ini_set('max_input_time', 		 '60000000');
					ini_set('upload_max_filesize', 	 '60000000');
					$ffmpegPath		=	'ffmpeg ';
					$uploaded_video	=	'';
					$uploaded2		=	"" . $uploaded_video .''.$video;
					$uploaded		= $uploaddir.$video;
					
					@chmod($uploaded2, 0777);
					@chmod($uploaded, 0777);
					
					$filerootpath =  str_replace(basename($video),'',$video);
					
					$file_name				=	$uploaded;
					$ext					=	$this->getExtension($file_name);
					$image 					=	$uploaddir.'black_background.jpg';
					$stamp 					=	0.001;
					$f_mpg 					=	$uploaddir.$filerootpath.mt_rand()."_temp1".".mpg";
					$actual_video 			=	$file_name;
					$temp1 					=	$uploaddir.$filerootpath.mt_rand()."_temp2.ts";
					$temp2 					=	$uploaddir.$filerootpath.mt_rand()."_temp3.ts";
					
					
					
					@chmod($temp1, 0777);
					@chmod($temp2, 0777);
					@chmod($image, 0777);
					@chmod($f_mpg, 0777);
					$fname				=	explode(".",$file_name);
					$final_video		=	$fname[0].".mp4";
					$final_video_name	=	$fname[0].".mp4";
					$filenameImage		=	$final_video_name.'.jpg';
					$ffmpegPath			=	'ffmpeg';
					$actual_video;
					
					$i					= 	$this->get_video_dimensions($actual_video);
					$or					=	$this->get_video_orientation($actual_video);
					$output_file_full	=	$final_video;
					
					if ($i) {
						
						//-----------------------********************----------------------//
						if (($ext=="flv") || ($ext=="3gp") || ($ext=="rmvb")) {
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							
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
							shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
						}
						//-----------------------********************----------------------//
						
						//-----------------------********************----------------------//
						if (($ext=="avi") || ($ext=="wmv") || ($ext=="vob")) {
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							$fname 				= explode(".",$file_name);
							$final_video 		= $fname[0].".mp4";
							$output_file_full	= $final_video;	
							$command			= $ffmpegPath.' -i '.$file_name.' -c:v libx264  -pix_fmt yuv420p   -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
							/*shell_exec($command);
											shell_exec($ffmpegPath.' -i '.$output_file_full.' -ss 1 -vframes 1 -s '.$i['dimension'].' '.$filenameImage);*/
											/*exec("$command");
											exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");*/
							exec("$ffmpegPath -i $file_name -c:v libx264 -crf 19 -preset slow -c:a aac -strict experimental -b:a 192k -ac 2 $final_video");
							exec("ffmpeg -i $file_name -acodec libfaac -b:a 128k -vcodec mpeg4 -b:v 1200k -flags +aic+mv4 $final_video");
											
						}
						//-----------------------********************----------------------//
										
						//-----------------------********************----------------------//
						//if (($ext=="mp4") || ($ext=="mov") || ($ext=="mkv")) {
						if (($ext=="mov") || ($ext=="mkv")) {
							
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							/*** convert video to flash ***/
							//chmod("/home/wawoo/public_html/uploads/","0777");
							//chmod("/home/wawoo/public_html/uploads/video.mp4","0777");
							exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");
							exec("$ffmpegPath -i $file_name -vcodec copy -acodec copy $final_video 2>&1", $output);
							
							
							
							 // to see the respond to your command
							
							/*$imgtoVideo = $ffmpegPath.' -loop 1 -i '.$image.' -c:v libx264 -bsf:v h264_mp4toannexb -pix_fmt yuv420p -t '.$stamp.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$f_mpg.' -vstats 2>&1';
							$output = shell_exec($imgtoVideo);
							
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


							shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);

							@unlink($f_mpg);
							@unlink($temp1);
							@unlink($temp2);*/
						}

						if (($ext=="mp4")) {
							$output_file_full 	= 	$file_name;
						}
						$data = array();
						$data['video']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$final_video_name);
						$data['image']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
						$data['video_file_name']	=	$video;
						$data['image_file_name']	=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
						$data['message']			=	'Your video has been uploaded successfully, After video reformat process, it will be ready in 20 minutes.';
						
						$mp4video =  explode(".",$value['vedio']);
						$mp4videoname = $mp4video[0].".mp4";
						$this->db->query("update `profile` set `vedio`= '".$mp4videoname."',`video_status` = '1' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
						return json_encode($data);
					}

					/*
					if($response)
					{	
						//$ary = json_decode($response);
						$mp4video =  explode(".",$value['vedio']);
						$mp4videoname = $mp4video[0].".mp4";
						$this->db->query("update `profile` set `vedio`= '".$mp4videoname."',`video_status` = '1' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
						
					}*/
				}
				else
				{
					$this->db->query("update `profile` set `video_status` = '1' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
					$this->generate_thumb();
				}
			}
		}
	}
	
	function videolesson(){
		$qry = $this->db->query("select `id`,`uid`,`source` from `lessons` where `upload_status` = '0'") or die(mysql_error());
		if($qry->num_rows()>0)
		{
			$result = $qry->result_array(); // Get Result in Array
			foreach($result as $key=>$value){
				$ext = explode(".",$value['source']);
				if(strtolower($ext[1]) != "mp4"){					
					//$response = $this->convertVideoProcess($value['vedio']); // pass video file name
					$video = $value['source'];
					$uploaddir	=	FCPATH."uploads/video/";	//'/home/wawoo/public_html/vedio/';
					@chmod($uploaddir, 0777);
					ini_set('error_reporting',		 '0');
					ini_set('display_errors', 		 'off');
					ini_set('max_execution_time', 	 '60000000');
					ini_set('max_file_uploads', 	 '60000000');
					ini_set('max_input_time', 		 '60000000');
					ini_set('upload_max_filesize', 	 '60000000');
					$ffmpegPath		=	'ffmpeg ';
					$uploaded_video	=	'';
					$uploaded2		=	"" . $uploaded_video .''.$video;
					$uploaded		= $uploaddir.$video;
					
					@chmod($uploaded2, 0777);
					@chmod($uploaded, 0777);
					
					$filerootpath =  str_replace(basename($video),'',$video);
					
					$file_name				=	$uploaded;
					$ext					=	$this->getExtension($file_name);
					
					$image 					=	$uploaddir.'black_background.jpg';
					$stamp 					=	0.001;
					$f_mpg 					=	$uploaddir.$filerootpath.mt_rand()."_temp1".".mpg";
					$actual_video 			=	$file_name;
					$temp1 					=	$uploaddir.$filerootpath.mt_rand()."_temp2.ts";
					$temp2 					=	$uploaddir.$filerootpath.mt_rand()."_temp3.ts";
					
					
					
					@chmod($temp1, 0777);
					@chmod($temp2, 0777);
					@chmod($image, 0777);
					@chmod($f_mpg, 0777);
					$fname				=	explode(".",$file_name);
					$final_video		=	$fname[0].".mp4";
					$final_video_name	=	$fname[0].".mp4";
					$filenameImage		=	$final_video_name.'.jpg';
					$ffmpegPath			=	'ffmpeg';
					$actual_video;
					
					$i					= 	$this->get_video_dimensions($actual_video);
					$or					=	$this->get_video_orientation($actual_video);
					$output_file_full	=	$final_video;
					
					if ($i) {
						//-----------------------********************----------------------//
						if (($ext=="flv") || ($ext=="3gp") || ($ext=="rmvb")) {
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							
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
							shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
						}
						//-----------------------********************----------------------//
						
						//-----------------------********************----------------------//
						if (($ext=="avi") || ($ext=="wmv") || ($ext=="vob")) {
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							$fname 				= explode(".",$file_name);
							$final_video 		= $fname[0].".mp4";
							$output_file_full	= $final_video;	
							$command			= $ffmpegPath.' -i '.$file_name.' -c:v libx264  -pix_fmt yuv420p   -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
							/*shell_exec($command);
											shell_exec($ffmpegPath.' -i '.$output_file_full.' -ss 1 -vframes 1 -s '.$i['dimension'].' '.$filenameImage);*/
											/*exec("$command");
											exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");*/
							exec("$ffmpegPath -i $file_name -c:v libx264 -crf 19 -preset slow -c:a aac -strict experimental -b:a 192k -ac 2 $final_video");
							exec("ffmpeg -i $file_name -acodec libfaac -b:a 128k -vcodec mpeg4 -b:v 1200k -flags +aic+mv4 $final_video");
											
						}
						//-----------------------********************----------------------//
										
						//-----------------------********************----------------------//
						//if (($ext=="mp4") || ($ext=="mov") || ($ext=="mkv")) {
						if (($ext=="mov") || ($ext=="mkv")) {
							
							chmod($f_mpg, 0777);
							chmod($temp1, 0777);
							chmod($temp2, 0777);
							chmod($image, 0777);
							/*** convert video to flash ***/
							//chmod("/home/wawoo/public_html/uploads/","0777");
							//chmod("/home/wawoo/public_html/uploads/video.mp4","0777");
							exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");
							exec("$ffmpegPath -i $file_name -vcodec copy -acodec copy $final_video 2>&1", $output);
							
							
							
							 // to see the respond to your command
							
							/*$imgtoVideo = $ffmpegPath.' -loop 1 -i '.$image.' -c:v libx264 -bsf:v h264_mp4toannexb -pix_fmt yuv420p -t '.$stamp.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$f_mpg.' -vstats 2>&1';
							$output = shell_exec($imgtoVideo);
							
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


							shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);

							@unlink($f_mpg);
							@unlink($temp1);
							@unlink($temp2);*/
						}

						if (($ext=="mp4")) {
							$output_file_full 	= 	$file_name;
						}
						$data = array();
						$data['video']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$final_video_name);
						$data['image']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
						$data['video_file_name']	=	$video;
						$data['image_file_name']	=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
						$data['message']			=	'Your video has been uploaded successfully, After video reformat process, it will be ready in 20 minutes.';
						
						$mp4video =  explode(".",$value['source']);
						$mp4videoname = $mp4video[0].".mp4";
						$this->db->query("update `lessons` set `source`= '".$mp4videoname."',`upload_status` = '2' where `id` = '".$value['id']."'") or die(mysql_error());
						return json_encode($data);
					}

					/*
					if($response)
					{	
						//$ary = json_decode($response);
						$mp4video =  explode(".",$value['vedio']);
						$mp4videoname = $mp4video[0].".mp4";
						$this->db->query("update `profile` set `vedio`= '".$mp4videoname."',`video_status` = '1' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
						
					}*/
				}
				else
				{
					$this->db->query("update `profile` set `video_status` = '1' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '100'") or die(mysql_error());
					$this->generate_thumb();
				}
			}
		}
	}
	
	function generate_thumb(){
		$qry = $this->db->query("select `id`,`uid`,`vedio` from `profile` where `vid_upload` = 1 and `video_status` = '1' ") or die(mysql_error());
		if($qry->num_rows()>0)
		{
			$result = $qry->result_array(); // Get Result in Array
			foreach($result as $key=>$value){
				$response = $this->videothumb($value['vedio']); // pass video file name 
				
				if($response)
				{
					$this->db->query("update `profile` set `video_status` = '2' where `id` = '".$value['id']."' and `vid_upload` = 1 and `video_status` = '1'") or die(mysql_error());
				}
			}
		}
	}
	/*function index(){
		$qry = $this->db->query("select `id`,`uid`,`vedio` from `profile` where `vid_upload` = 1 and `video_status` = '100' ") or die(mysql_error());
		if($qry->num_rows()>0)
		{
			$result = $qry->result_array(); // Get Result in Array
			foreach($result as $key=>$value){
				$this->convertVideoProcess($value['vedio']); // pass video file name 
			}
		}
	}*/
	
	/*public function convertVideoProcess()
	{
		$vjsurl	    		=	'http://dev.thetalklist.com/js/vjs/';
		$uploaddir	    	=	'/home/wawoo/public_html/vedio/';
		$uploadurl	    	=	'http://dev.thetalklist.com/vedio/';
	
			
		chmod($uploaddir, 0777);
		ini_set('error_reporting',		 '0');
		ini_set('display_errors', 		 'off');
		ini_set('max_execution_time', 	 '60000000');
		ini_set('max_file_uploads', 	 '60000000');
		ini_set('max_input_time', 		 '60000000');
		ini_set('upload_max_filesize', 	 '60000000');
	
	
		$ffmpegPath 		= 'ffmpeg ';
		
		$uploaded_video 		= '';
		$uploaded2 				= "" . $uploaded_video .''.$_POST['video'];
		$uploaded 				= $uploaddir."" . $uploaded_video .''.$_POST["video"];
	
	
		@chmod($uploaded2, 0777);
		@chmod($uploaded, 0777);
		
	
		
		$file_name					=	$uploaded;
		$ext						=	$this->getExtension($file_name);
		$image 						= 	$uploaddir.'black_background.jpg';
		$stamp 						= 0.001;
		$f_mpg 						= $uploaddir.''.mt_rand()."_temp1".".mpg";
		$actual_video 				= $file_name;
		$temp1 						= $uploaddir.''.mt_rand()."_temp2.ts";
		$temp2 						= $uploaddir.''.mt_rand()."_temp3.ts";
		@chmod($temp1, 0777);
		@chmod($temp2, 0777);
		@chmod($image, 0777);
		@chmod($f_mpg, 0777);
	
		$fname 						= explode(".",$file_name);
		$final_video 				= $fname[0].".mp4";
		$final_video_name 			= $fname[0].".mp4";
		$filenameImage 				= $final_video_name.'.jpg';
	
		$ffmpegPath 				= 'ffmpeg';
		$i 							= 	$this->get_video_dimensions($actual_video);
		$or							=	$this->get_video_orientation($actual_video);
		$output_file_full			= $final_video;	
		if($i){
								//-----------------------********************----------------------//
								if (($ext=="flv") || ($ext=="3gp") || ($ext=="rmvb")) {
									chmod($f_mpg, 0777);
									chmod($temp1, 0777);
									chmod($temp2, 0777);
									chmod($image, 0777);
									
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
	
	
									shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
								}
								//-----------------------********************----------------------//
								
								
								
								//-----------------------********************----------------------//
								if (($ext=="avi") || ($ext=="wmv") || ($ext=="vob")) {
									chmod($f_mpg, 0777);
									chmod($temp1, 0777);
									chmod($temp2, 0777);
									chmod($image, 0777);
									$fname 				= explode(".",$file_name);
									$final_video 		= $fname[0].".mp4";
									$output_file_full	= $final_video;	
									$command			= $ffmpegPath.' -i '.$file_name.' -c:v libx264  -pix_fmt yuv420p   -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
									shell_exec($command);
	
									shell_exec($ffmpegPath.' -i '.$output_file_full.' -ss 1 -vframes 1 -s '.$i['dimension'].' '.$filenameImage);
								}
								//-----------------------********************----------------------//
								
								//-----------------------********************----------------------//
								//if (($ext=="mp4") || ($ext=="mov") || ($ext=="mkv")) {
								if (($ext=="mov") || ($ext=="mkv")) {
									
									chmod($f_mpg, 0777);
									chmod($temp1, 0777);
									chmod($temp2, 0777);
									chmod($image, 0777);
									
									
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
	
	
									shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
	
									@unlink($f_mpg);
									@unlink($temp1);
									@unlink($temp2);
								}
	
								if (($ext=="mp4")) {
									$output_file_full 	= 	$file_name;
								}
								$data = array();
								$data['video']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$final_video_name);
								$data['image']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
								$data['video_file_name']	=	str_replace('/home/wawoo/public_html/vedio/' , '',$final_video_name);
								$data['image_file_name']	=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
								$data['message']			=	'Your video has been uploaded successfully, After video reformat process, it will be ready in 20 minutes.';
								echo json_encode($data);exit;
		}
	}*/
	function convertVideoProcess($video)
	{
		echo $_POST['vedio'];
		echo $video = $value['vedio'];
		exit;
		//$video = '2016/02/23/f28ff1e2cbee111de3b236d2c2a4e7ee.avi';
		//$vjsurl	=	'http://dev.thetalklist.com/js/vjs/';
		//$uploadurl=	'http://dev.thetalklist.com/vedio/';
		$uploaddir	=	FCPATH."uploads/video/";	//'/home/wawoo/public_html/vedio/';
		@chmod($uploaddir, 0777);
		ini_set('error_reporting',		 '0');
		ini_set('display_errors', 		 'off');
		ini_set('max_execution_time', 	 '60000000');
		ini_set('max_file_uploads', 	 '60000000');
		ini_set('max_input_time', 		 '60000000');
		ini_set('upload_max_filesize', 	 '60000000');
		$ffmpegPath		=	'ffmpeg ';
		$uploaded_video	=	'';
		$uploaded2		=	"" . $uploaded_video .''.$video;
		$uploaded		= $uploaddir.$video;
		
		@chmod($uploaded2, 0777);
		@chmod($uploaded, 0777);
		
		$filerootpath =  str_replace(basename($video),'',$video);
		
		$file_name				=	$uploaded;
		$ext					=	$this->getExtension($file_name);
		$image 					=	$uploaddir.'black_background.jpg';
		$stamp 					=	0.001;
		$f_mpg 					=	$uploaddir.$filerootpath.mt_rand()."_temp1".".mpg";
		$actual_video 			=	$file_name;
		$temp1 					=	$uploaddir.$filerootpath.mt_rand()."_temp2.ts";
		$temp2 					=	$uploaddir.$filerootpath.mt_rand()."_temp3.ts";
		
		
		
		@chmod($temp1, 0777);
		@chmod($temp2, 0777);
		@chmod($image, 0777);
		@chmod($f_mpg, 0777);
		$fname				=	explode(".",$file_name);
		$final_video		=	$fname[0].".mp4";
		$final_video_name	=	$fname[0].".mp4";
		$filenameImage		=	$final_video_name.'.jpg';
		$ffmpegPath			=	'ffmpeg';
		$actual_video;
		
		$i					= 	$this->get_video_dimensions($actual_video);
		$or					=	$this->get_video_orientation($actual_video);
		$output_file_full	=	$final_video;
		
		if ($i) {
			//-----------------------********************----------------------//
			if (($ext=="flv") || ($ext=="3gp") || ($ext=="rmvb")) {
				chmod($f_mpg, 0777);
				chmod($temp1, 0777);
				chmod($temp2, 0777);
				chmod($image, 0777);
				
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
				shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
			}
			//-----------------------********************----------------------//
			
			//-----------------------********************----------------------//
			if (($ext=="avi") || ($ext=="wmv") || ($ext=="vob")) {
				chmod($f_mpg, 0777);
				chmod($temp1, 0777);
				chmod($temp2, 0777);
				chmod($image, 0777);
				$fname 				= explode(".",$file_name);
				$final_video 		= $fname[0].".mp4";
				$output_file_full	= $final_video;	
				$command			= $ffmpegPath.' -i '.$file_name.' -c:v libx264  -pix_fmt yuv420p   -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$final_video;
				/*shell_exec($command);
                                shell_exec($ffmpegPath.' -i '.$output_file_full.' -ss 1 -vframes 1 -s '.$i['dimension'].' '.$filenameImage);*/
                                /*exec("$command");
                                exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");*/
				exec("$ffmpegPath -i $file_name -c:v libx264 -crf 19 -preset slow -c:a aac -strict experimental -b:a 192k -ac 2 $final_video");
				exec("ffmpeg -i $file_name -acodec libfaac -b:a 128k -vcodec mpeg4 -b:v 1200k -flags +aic+mv4 $final_video");
                                
            }
			//-----------------------********************----------------------//
							
			//-----------------------********************----------------------//
			//if (($ext=="mp4") || ($ext=="mov") || ($ext=="mkv")) {
			if (($ext=="mov") || ($ext=="mkv")) {
				
				chmod($f_mpg, 0777);
				chmod($temp1, 0777);
				chmod($temp2, 0777);
				chmod($image, 0777);
				/*** convert video to flash ***/
				//chmod("/home/wawoo/public_html/uploads/","0777");
				//chmod("/home/wawoo/public_html/uploads/video.mp4","0777");
				exec("ffmpeg -i $file_name -ss 00:00:14.435 -vframes 1 $final_video.jpg");
				exec("$ffmpegPath -i $file_name -vcodec copy -acodec copy $final_video 2>&1", $output);
				
				
				
				 // to see the respond to your command
				
				/*$imgtoVideo = $ffmpegPath.' -loop 1 -i '.$image.' -c:v libx264 -bsf:v h264_mp4toannexb -pix_fmt yuv420p -t '.$stamp.' -ab '.$i['audio_bit'].' -vb '.$i['video_bit'].' -s '.$i['dimension'].' '.$f_mpg.' -vstats 2>&1';
				$output = shell_exec($imgtoVideo);
				
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


				shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);

				@unlink($f_mpg);
				@unlink($temp1);
				@unlink($temp2);*/
			}

			if (($ext=="mp4")) {
				$output_file_full 	= 	$file_name;
			}
			$data = array();
			$data['video']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$final_video_name);
			$data['image']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
			$data['video_file_name']	=	$video;
			$data['image_file_name']	=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
			$data['message']			=	'Your video has been uploaded successfully, After video reformat process, it will be ready in 20 minutes.';
			return json_encode($data);
		}
	}
	
	// Get Video Extension
	public function getExtension($name) {
		$ext	=	$name;
		if (strpos($name,".")) {
			$ext	=	substr($name,strpos($name,".")+1,strlen($name)-strpos($name,".")-1);
			if (strpos($ext,".")) {
				return $this->getExtension($ext);
			}
		}
		return strtolower($ext);
	}
	
	// Get Video Dimenstion
	public function get_video_dimensions($video = false){
		
		$ffmpegPath 		= 'ffmpeg ';
		$data 				= array();
		if (file_exists ( $video )) {
			$command 			= $ffmpegPath . ' -i ' . $video . ' -vstats 2>&1';
			$output 			= shell_exec ( $command );

			$result 			= preg_match ( '/[0-9]?[0-9][0-9][0-9]x[0-9][0-9][0-9][0-9]?/', $output, $regs );
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
	public function get_video_dimensions1($video = false){
		$ffmpegPath 		= 'ffmpeg ';
		$data 				= array();
		if (file_exists ( $video )) {
			chmod($video, 0777);
			$command 			= $ffmpegPath . ' -i ' . $video . ' -vstats 2>&1';
			$output 			= shell_exec ( $command );
			
			$result 			= ereg ( '[0-9]?[0-9][0-9][0-9]x[0-9][0-9][0-9][0-9]?', $output, $regs );
			
			$data['dimension'] 	= $regs[0];

			preg_match('/bitrate:\s(?>bitrate>\d+)\skb\/s/', $output, $vid);
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
	
	
	public function videothumb($video) {
		//$vjsurl	    		=	'http://dev.thetalklist.com/js/vjs/';
		//$uploaddir	    	=	'/home/wawoo/public_html/vedio/';
		//$uploadurl	    	=	'http://dev.thetalklist.com/vedio/';
		//$uploadurl=	'http://dev.thetalklist.com/vedio/';
		$uploaddir	=	FCPATH."uploads/video/";	//'/home/wawoo/public_html/vedio/';
		$ffmpegPath 		= 'ffmpeg ';

		$uploaded_video 		= '';
		$uploaded2 				= $uploaded_video.$video;
		$uploaded 				= $uploaddir.$video;


		@chmod($uploaded2, 0777);
		@chmod($uploaded, 0777);
		
		$final_video_name			= 
		$file_name					=	$uploaded2;
		$filenameImage 				= 	$uploaddir.$file_name.'.jpg';

		@unlink($filenameImage);
		$actual_video = $uploaded;
		$ffmpegPath 				= 'ffmpeg';
		$ffmpeg 				= 'ffmpeg';
		$i 							= 	$this->get_video_dimensions($actual_video);

		$or							=	$this->get_video_orientation($actual_video);
		$output_file_full			= $uploaded;	
		if($i){
			$dataImage = shell_exec($ffmpeg . '  -itsoffset -2  -i '.$output_file_full.' -vcodec mjpeg -vframes 1 -an -f rawvideo -s '.$i['dimension'].' '.$filenameImage);
			$data = array();
			$data['image']				=	str_replace('/home/wawoo/public_html/vedio/' , '',$filenameImage);
			return json_encode($data);
		}
	}
	
	function get_video_orientation($video_path) {
		$ffmpegPath 			= 'ffmpeg ';
		$cmd 					= 'ffprobe  -i ' . $video_path . ' -show_streams 2>&1';
		$result 				= shell_exec($cmd);

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
}
