<?php $this->layout->appendFile('css',"css/how_works.css");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
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

$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);
$lhow_it_works	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('87', $multi_lang);
$ldescription	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('89', $multi_lang);
$llength	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('313', $multi_lang);
$ldownload	= $arrVal[$multi_lang];
?>

<div class="how_works">
	<a name="top"></a>
	<!--<div class="how_works_top"><?php echo $lhow_it_works;?> <?php 
	$arrVal = $this->lookup_model->getValue('21', $multi_lang);
	echo $arrVal[$multi_lang];
	?></div>-->
	<div class="how_works_mid">
		<div class="mgauto paly_box">
			<div class="video_Wp posR "  id="player_b">
				<div class="projekktor" id="player_a"></div>
			</div>
		</div>
		<h1 class="nowTitle"></h1>
		<div class="description">
		
		</div>
		<div class="list">
			<?php $j = 0;foreach($howItworks as $k=>$howItwork):?> 
			<?php if($howItwork['source']):?>
			<dl  source="<?php echo base_url('__PATH__'.$howItwork['source']);?>" class="showVideo <?php if($j%2 == 1){echo "even";}$j++;?> ">
				<dt class="play_box_small">
					<span href="#">
						<span class="layer"></span>
						<span class="icon_play"></span>
						<img class="img" src="<?php echo profile_video($howItwork['source']);?>">
					</span>
				</dt>
				<dd>
					<p class="h1 sTitle" href="#"><?php echo @$howItwork['title'];?> </p>
					<p class="h2"><?php echo $llength; ?> - <?php echo sec2min($howItwork['length']);?></p>
					<p class="intr sDesc"><?php echo @$ldescription;?><!--Description-->:  <?php echo $howItwork['desc'];?></p>
					<p class="tr"><!--<a class="more" href="#">play to read more</a>--></p>
				</dd>
			</dl>
			<?php endif;?>
			<?php endforeach;?>

			<?php $j = 0;foreach($howItworks as $k=>$howItwork):?> 
			<?php if($howItwork['pdfs']):?>
			<dl  source="<?php echo base_url('__PATH__'.$howItwork['source']);?>" class="showVideo1 <?php if($j%2 == 1){echo "even";}$j++;?> ">
				<dt class="play_box_small pdfarticle">
					<p href="#">
						<span class="layer"></span>
						<img class="img" src="<?php echo base_url('uploads/video/images/pdf.jpg');?>">
					</p>
				</dt>
				<dd>
					<p class="h1 sTitle pdfarticle" href="#"><?php echo @$howItwork['title'];?> </p>
					<p class="intr sDesc"><?php echo @$ldescription;?><!--Description-->:  <?php echo $howItwork['desc'];?></p>
					<p class="tr"><a href="<?php echo base_url('uploads/source/'.$howItwork['pdfs']);?>"><?php echo @$ldownload;?><!--DOWNLOAD--></a></p>
				</dd>
			</dl>
			<?php endif;?>
			<?php endforeach;?>
		</div>
	</div>
</div>

<script>
	var mp4PlayList = "video/mp4";
	var ogvPlayList = "video/ogv";
	var oggPlayList = "video/ogg";
	
	function createVideo(videoType,poster,videoPath,title){
		if(videoType == 'mp4')
		{
			var plylst = mp4PlayList;
		}else if(videoType == 'ogg')
		{
			var plylst = oggPlayList;
		}else{
			var plylst = ogvPlayList;
		}
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: title,
			debug: false,
			poster: poster,
			width: 719,
			height: 397,
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			//plugin_display: {
			//	logoImage: '<?php echo Base_url("images/header.jpg");?>',
			//	logoDelay: 5
			//},
			controls: true,
			playlist: [
				{
					0: {src:videoPath, type:plylst}
				}
			] 
		});
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
		var _firstLesson = $('.list dl:first');
		if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){
			//alert('h1');
			createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default vedio');
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}
		else {
			//alert('h2');
			var _source = "<?php echo base_url(); ?>uploads/video/<?php echo $video[0]['video_file']?>";
			var img = _source.replace('uploads/video/','uploads/video/images/')+'.jpg';
			var vd = _source.replace('uploads/video/','uploads/video/');
			var videoType = '';
			if(vd.search(".mp4")>0)
			{
				videoType = 'mp4';
			}
			if(vd.search(".ogg")>0)
			{
				videoType = 'ogg';
			}
			if(vd.search(".ogv")>0)
			{
				videoType = 'ogv';
			}
			//vd = vd.replace('.ogg','');
			//vd = vd.replace('.mp4','');
			
			createVideo(videoType,img,vd,_firstLesson.find('.lname').html());
			
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			//console.info($('.sDesc',_firstLesson).html());
			$('#howUpTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}


		$('.showVideo').click(function(){
			var _clickEl = $(this);
			var _li = _clickEl;//.parents('li.lesson');
			var _source =  _li.attr('source');
			//console.info(_source.replace('__PATH__','uploads/video/images/')+'.jpg');
			
			var jpg = _source.replace('__PATH__','uploads/video/images/')+'.jpg';
			var vd = _source.replace('__PATH__','uploads/video/');
			
			//checks for video exists
			//alert(vd);
			//var E = fileExists(vd);
			var Exists = vd.fileExists();
			if(Exists == false)
			{
				vd = vd + '.mp4';
			}
			if(vd.search(".mp4")>0)
			{
				videoType = 'mp4';
			}
			if(vd.search(".ogg")>0)
			{
				videoType = 'ogg';
			}
			if(vd.search(".ogv")>0)
			{
				videoType = 'ogv';
			}
			
			//vd = vd.replace('.mp4','');
			//alert(vd);
			
			//createVideo(_source.replace('uploads/video/','uploads/video/images/')+'.jpg',_source.replace('uploads/video/','uploads/video/'),_li.find('.lname').html());
			createVideo(videoType,jpg,vd,_li.find('.lname').html());
			$('.nowTitle').html($('.sTitle',_li).html());
			$('#howUpTitle').html($('.sTitle',_li).html());
			$('.description').html($('.sDesc',_li).html());
			document.location.href = '#top';
		})
	})
	
	// function fileExists(url) {
		// var myObject;
        // myObject = new ActiveXObject("Scripting.FileSystemObject");
        // if(myObject.FileExists(url)){
           // alert("File Exists");
        // } else {
           // alert("File doesn't exist");
        // }
		
	// }
	
	String.prototype.fileExists = function() {
		filename = this.trim();
		var response = jQuery.ajax({
		url: filename,
		type: 'HEAD',
		async: false
		}).status;	
		return (response != "200") ? false : true;
	}
	
</script>