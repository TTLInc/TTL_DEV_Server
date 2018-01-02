<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media {

	var $obj;
	public $error = '';
	var $data;
	var $level,$datePath,$sqlAddress;
	function __construct() {
		$this->obj =& get_instance();
		$this->obj->load->library(array('upload','image_lib'));
	}

	public function upload($config,$fileName = 'userfile'){
		$this->datePath = date('Y').'/'.date('m').'/'.date('d').'/';
		$config['upload_path'] .= $this->datePath; 
		$this->checkDir($config['upload_path']);
		$this->obj->upload->initialize($config);
		if ( ! $this->obj->upload->do_upload($fileName)) {
			$this->error = array('error' => $this->obj->upload->display_errors());
		} 
		else {
			$this->data = array('upload_data' => $this->obj->upload->data());
			$this->sqlAddress = $this->datePath.$this->data['upload_data']['raw_name'].$this->data['upload_data']['file_ext'];
			//$this->sqlAddress = $this->datePath.$this->data['upload_data']['orig_name'];
			//$this->sqlAddress = $this->data['upload_data']['orig_name'];
		}
		return $this;
	}
	
	public function resource_upload($config,$fileName = 'userfile'){
		$this->datePath = '';
		$config['upload_path'] .= $this->datePath; 
		$this->checkDir($config['upload_path']);
		$this->obj->upload->initialize($config);
		if ( ! $this->obj->upload->do_upload($fileName)) {
			$this->error = array('error' => $this->obj->upload->display_errors());
		} 
		else {
			$this->data = array('upload_data' => $this->obj->upload->data());
			$this->sqlAddress = $this->data['upload_data']['raw_name'].$this->data['upload_data']['file_ext'];
			//$this->sqlAddress = $this->datePath.$this->data['upload_data']['orig_name'];
			//$this->sqlAddress = $this->data['upload_data']['orig_name'];
		}
		return $this;
	}

	public function resize($resizeConfig) {
		if(!$this->error && $this->data['upload_data']['is_image']) {
			if(!isset($resizeConfig['source_image'])) {
				$resizeConfig['source_image'] = $this->data['upload_data']['full_path'];
				$this->checkDir($resizeConfig['new_image'].$this->datePath);
				$resizeConfig['new_image'] = $resizeConfig['new_image'] . $this->sqlAddress;
			}
			$this->obj->image_lib->initialize($resizeConfig);
			if(!$this->obj->image_lib->resize()){
				$this->error .= $this->obj->image_lib->display_errors();
			}
			$this->obj->image_lib->clear();
		}
		return $this;
	}
/*
	public function translate($translateConfig) {
		if(!$this->error && !$this->data['upload_data']['is_image']) {
			if(!isset($translateConfig['source_image'])) {
				$translateConfig['source_image'] = $this->data['upload_data']['full_path'];
			}
			$this->checkDir($translateConfig['image'].$this->datePath);
			$this->checkDir($translateConfig['path'].$this->datePath);
			$translateConfig['image'] = $translateConfig['image'] . $this->sqlAddress;
			$translateConfig['vedio_name'] = $translateConfig['path'] . $this->sqlAddress;
			if(!isset($translateConfig['screen'])){
				$translateConfig['screen'] = "{$translateConfig['width']}*{$translateConfig['height']}";
			}
            
			// TECHNO-SANJAY Change 24 may 2013
			//$image = "ffmpeg  -i {$translateConfig['source_image']}  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 2 {$translateConfig['image']}.jpg";
			$image = "ffmpeg  -i {$translateConfig['source_image']}  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
			//echo $mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
			//$mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
            $fs = filesize($translateConfig['path'] . $this->sqlAddress);
			
			//print_r($fs);
			//exit;
			//if (strrchr($translateConfig['vedio_name'], '.') == '.mp4' && $fs<=554528 ) {
			if (strrchr($translateConfig['vedio_name'], '.') == '.mp4' ) {
				
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21 -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				//unlink($translateConfig['path'] . $this->sqlAddress);
				$vd = explode('.',$translateConfig['vedio_name']);
				$vdo = $vd[0];
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre hq -vpre baseline -acodec libfaac -ar 44100 {$vdo}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
			} else if (strrchr($translateConfig['vedio_name'], '.') == '.avi') {
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']}  {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec mpeg4 -r 25  -acodec libfaac -b 128 -ar 44100 {$translateConfig['vedio_name']}.mp4";
			}
			else if (strrchr($translateConfig['vedio_name'], '.') == '.wmv') {
				
				$mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -c:v libx264 -crf 23 -profile:v high -r 21 -c:a libfaac -q:a 100 -ar 44100  {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
			}
			//echo strrchr($translateConfig['vedio_name'], '.');exit;
			// skvirja changes for create mp4 video when upload 3gp video
			if (strrchr($translateConfig['vedio_name'], '.') == '.3gp') {
				//echo 'rrrrrr';exit;
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 25 -s 180x150  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 25 -s 180x150  -vpre hq -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -acodec libfaac -ab 128k -vcodec libx264 -vpre hq -crf 24 -threads 0 {$translateConfig['vedio_name']}.mp4";
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
			} else if (strrchr($translateConfig['vedio_name'], '.') == '.avi') {
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']}  {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec mpeg4 -r 25  -acodec libfaac -b 128 -ar 44100 {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec mpeg4 -r 25  -acodec libfaac -b 128 -ar 44100 {$translateConfig['vedio_name']}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -vpre medium_firstpass -b 416k -threads 0 -pass 1 -an -f mp4 -y /dev/null && ffmpeg -i input -vcodec libx264 -vpre medium -b 416k -threads 0 -pass 2 -acodec libfaac -ab 128k {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -acodec libfaac -vcodec libx264 -r 21  -ar 44100 -vpre medium  {$translateConfig['vedio_name']}.mp4";
			  
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
			}
			
			if (strrchr($translateConfig['vedio_name'], '.') == '.mov'  || strrchr($translateConfig['vedio_name'], '.') == '.MOV') {
				$upd = str_replace('.mov','',$translateConfig['vedio_name']);
				$mp4 = "ffmpeg -i {$translateConfig['source_image']} -ar 22050 -ab 32 -f mp4 -s 320x240 {$upd}.mp4";
				//$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -acodec libfaac -ab 128k -vcodec libx264 -vpre hq -crf 24 -threads 0 {$translateConfig['vedio_name']}.mp4";
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
			}
			

			//$ogg = "ffmpeg -y -i {$translateConfig['source_image']} -sameq  -qscale 4   -acodec libfaac -r 21  -ar 44100 {$translateConfig['vedio_name']}.ogg";
			//$ogg = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec theora -r 21 -vpre medium -vpre baseline  -acodec vorbis  -ar 44100  -f ogg {$translateConfig['vedio_name']}.ogg";
			$ogg = "ffmpeg -y -i {$translateConfig['source_image']} -sameq  -qscale 4   -acodec libvorbis -r 21  -ar 44100 {$translateConfig['vedio_name']}.ogg";
			
			system($image);
			system($ogg.' > '.FCPATH.'/uploads/null &');
			//system($mp4 .' > '.FCPATH.'/uploads/null &');
			//system($mp4);
			system($ogg);
			//if (strrchr($translateConfig['vedio_name'], '.') == '.mp4' && $fs<554528) {
			if (strrchr($translateConfig['vedio_name'], '.') == '.mp4') {
				//unlink($translateConfig['path'] . $this->sqlAddress);
				//rename($translateConfig['path'] . $this->sqlAddress.'.mp4',$translateConfig['path'] . $this->sqlAddress);
			}
		}
		
		if ( ! @copy($_FILES['vfile']['tmp_name'], $translateConfig['vedio_name']))
		{
			@move_uploaded_file($_FILES['vfile']['tmp_name'], $translateConfig['vedio_name']);
		}
		return $this;
	}
*/

//----------RD---//
	public function translate($translateConfig) {
		if(!$this->error && !$this->data['upload_data']['is_image']) {
			if(!isset($translateConfig['source_image'])) {
				$translateConfig['source_image'] = $this->data['upload_data']['full_path'];
			}
			$this->checkDir($translateConfig['image'].$this->datePath);
			$this->checkDir($translateConfig['path'].$this->datePath);
			$translateConfig['image'] = $translateConfig['image'] . $this->sqlAddress;
			$translateConfig['vedio_name'] = $translateConfig['path'] . $this->sqlAddress;
			if(!isset($translateConfig['screen'])){
				$translateConfig['screen'] = "{$translateConfig['width']}*{$translateConfig['height']}";
			}
            
			$fs = filesize($translateConfig['path'] . $this->sqlAddress);
			if (strrchr($translateConfig['vedio_name'], '.') == '.mp4' ) {
				$vd = explode('.',$translateConfig['vedio_name']);
				$vdo = $vd[0];
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				system($image);
			} else if (strrchr($translateConfig['vedio_name'], '.') == '.avi') {
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				system($image);
			}
			else if (strrchr($translateConfig['vedio_name'], '.') == '.wmv') {
				
				$mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 21  -vpre medium -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				system($image);
			}
			if (strrchr($translateConfig['vedio_name'], '.') == '.3gp') {
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -vcodec libx264 -r 25 -s 180x150  -vpre hq -vpre baseline -acodec libfaac -ar 44100 {$translateConfig['vedio_name']}.mp4";
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				system($image);
			} else if (strrchr($translateConfig['vedio_name'], '.') == '.avi') {
				$mp4 = "ffmpeg  -i {$translateConfig['source_image']} -sameq  {$translateConfig['vedio_name']}.mp4";
				$mp4 = "ffmpeg -y -i {$translateConfig['source_image']} -acodec libfaac -vcodec libx264 -r 21  -ar 44100 -vpre medium  {$translateConfig['vedio_name']}.mp4";			  
				system($mp4 .' > '.FCPATH.'/uploads/null &');
				system($mp4);
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				system($image);
			}
			if (strrchr($translateConfig['vedio_name'], '.') == '.mov') {
				$upd = str_replace('.mov','',$translateConfig['vedio_name']);
				$mp4 = "ffmpeg -i {$translateConfig['source_image']} -ar 22050 -ab 32 -f mp4 -s 320x240 {$upd}.mp4";
				//system($mp4 .' > '.FCPATH.'/uploads/null &');
				//system($mp4);
				$image = "ffmpeg  -i {$translateConfig['vedio_name']}.mp4  -f image2  -s {$translateConfig['screen']} -vframes 1 -ss 0 {$translateConfig['image']}.jpg";
				//system($image);
			
			
			}
		}

		if ( ! @copy($_FILES['vfile']['tmp_name'], $translateConfig['vedio_name']))
		{
			@move_uploaded_file($_FILES['vfile']['tmp_name'], $translateConfig['vedio_name']);
		}
		return $this;
	}
	
	public function getInfo() {
		$file = $this->data['upload_data']['full_path'];
		$ffmpegPath = 'ffmpeg -i "%s" 2>&1';
		ob_start();
		passthru(sprintf($ffmpegPath, $file));
		$info = ob_get_contents();
		ob_end_clean();
	  // 通过使用输出缓冲，获取到ffmpeg所有输出的内容。
	   $ret = array();
		// Duration: 01:24:12.73, start: 0.000000, bitrate: 456 kb/s
		if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
			$ret['duration'] = $match[1]; // 提取出播放时间
			$da = explode(':', $match[1]); 
			$ret['seconds'] = $da[0] * 3600 + $da[1] * 60 + $da[2]; // 转换为秒
			$ret['start'] = $match[2]; // 开始时间
			$ret['bitrate'] = $match[3]; // bitrate 码率 单位 kb
		}

		// Stream #0.1: Video: rv40, yuv420p, 512x384, 355 kb/s, 12.05 fps, 12 tbr, 1k tbn, 12 tbc
		if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
			$ret['vcodec'] = $match[1]; // 编码格式
			$ret['vformat'] = $match[2]; // 视频格式 
			$ret['resolution'] = $match[3]; // 分辨率
			$a = explode('x', $match[3]);
			$ret['width'] = $a[0];
			$ret['height'] = $a[1];
		}

		// Stream #0.0: Audio: cook, 44100 Hz, stereo, s16, 96 kb/s
		if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
			$ret['acodec'] = $match[1];       // 音频编码
			$ret['asamplerate'] = $match[2];  // 音频采样频率
		}

		if (isset($ret['seconds']) && isset($ret['start'])) {
			$ret['play_time'] = $ret['seconds'] + $ret['start']; // 实际播放时间
		}

		$ret['size'] = filesize($file); // 文件大小
		return $ret;
	}
	public function checkDir($dir){
		$step = 20;
		$dirTemp = $dir;
		while($step > 0 )  {
			if(is_dir($dir) || is_file($dir)){
				return true;
			}
			$dirTempParent = dirname($dirTemp);
			if(is_dir($dirTempParent)) {
				mkdir($dirTemp);
				$dirTemp = $dir;
			}
			else {
				$dirTemp = $dirTempParent;
			}
			$step--;
		}
		return false;
	}

	public function checkDi2r($file_name) {
		//static $level = 1;
		$this->level = 1;
		$file_name = str_replace("\\", "/", $file_name);
		$path = dirname($file_name);
		var_dump(dirname($path),$file_name);
		if(!is_dir($path)) {
			$paths = explode('/', $path);
			$curdir = $paths[0];
			for($n = 1; $n <= $this->level; $n++) {
				echo $curdir .= '/' . $paths[$n];
			}
			if(!is_dir($curdir)) {
				//echo $curdir;
				mkdir($curdir);
			}
			$this->level++;
			return $this->checkDir($file_name);
			//}
		}
		return true;
	}
}
function getSizeFile($url) {
    if (substr($url,0,4)=='http') {
        $x = array_change_key_case(get_headers($url, 1),CASE_LOWER);
        if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { $x = $x['content-length'][1]; }
        else { $x = $x['content-length']; }
    }
    else { $x = @filesize($url); }

    return $x;
} 

/*
ffmpeg -an -deinterlace  -r 20.00 -i TheTalkListShort.mp4 -vcodec rawvideo -pix_fmt yuv420p -f rawvideo – |  ffmpeg -an -f rawvideo  -r 20.00 -i – -f yuv4mpegpipe – |  libtheora-1.0/lt-encoder_example –video-rate-target 512k – -o tmp.ogv

ffmpeg  -i TheTalkListShort.mp4 -sameq  audio.ogg


oggz-comment audio.ogg -o audio2.ogg TITLE="Cape Cod Marsh" ARTIST="Tracey Jaquith" LICENSE="http://creativecommons.org/licenses/publicdomain/" DATE="2004″ ORGANIZATION="Dumb Bunny Productions" LOCATION=http://www.archive.org/details/CapeCodMarsh


 ./configure --prefix=/usr --libdir=/usr/lib --shlibdir=/usr/lib --mandir=/usr/share/man --incdir=/usr/include --disable-avisynth --extra-cflags='-O2 -g -pipe -Wall -Wp,-D_FORTIFY_SOURCE=2 -fexceptions -fstack-protector --param=ssp-buffer-size=4 -m32 -march=i686 -mtune=atom -fasynchronous-unwind-tables' --enable-avfilter  --enable-libdc1394 --enable-libdirac --enable-libfaac   --enable-libgsm --enable-libmp3lame --enable-libopencore-amrnb --enable-libopencore-amrwb --enable-librtmp --enable-libschroedinger --enable-libtheora --enable-libx264 --enable-gpl --enable-nonfree --enable-postproc --enable-pthreads --enable-shared --enable-swscale --enable-vdpau --enable-version3 --enable-x11grab  --disable-yasm
 
 for i in `ls *.mp4`;do tar zxvf $i; done;
ffmpeg  -y -i 614247c05c00e3e358684a6aa07197dc.mp4 -sameq   -acodec libvorbis 614247c05c00e3e358684a6aa07197dc.mp4.ogg
ffmpeg  -y  -i 614247c05c00e3e358684a6aa07197de.mp4 -sameq   -acodec libvorbis 614247c05c00e3e358684a6aa07197de.mp4.ogg

ffmpeg  -i 614247c05c00e3e358684a6aa07197de.mp4  -f image2  -s 706*399 -vframes 9 614247c05c00e3e358684a6aa07197de.jpg
151

How TheTalkList Works 

ffmpeg  -y  -i c1e0613d1dbd418fd2608b94dcec9164.mp4.mp4 -sameq   -acodec libvorbis c1e0613d1dbd418fd2608b94dcec9164.mp4.ogg
 614247c05c00e3e358684a6aa07197dc.mp4      614247c05c00e3e358684a6aa07197de.mp4      c1e0613d1dbd418fd2608b94dcec9164.mp4
 */
