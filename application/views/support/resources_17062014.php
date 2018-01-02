<?php 
//--R&D@Oct-29-2013
$multi_lang = 'en';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('386', $multi_lang);
$lSUPPORT   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);
$lFORUM   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('388', $multi_lang);
$lTUTOR_RESOURCES   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('417', $multi_lang);
$lSTUDENT_RESOURCES   = @$arrVal[$multi_lang];

$this->layout->appendFile('css',"css/how_works.css");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
<div class="how_works">
	<a name="top"></a>	
		<!--<div class="terms_top">
	<ul class="c3e6f8b" id="nav" style="top:180px;float:left;left:15%;">
	<li><a href="<?php echo base_url('/support/faqs');?>">FAQs</a></li>
	<li><a href="<?php echo base_url('/forum');?>">Instant Messaging</a></li>
	<li class="nav_sel"><a href="<?php echo base_url('/support/resources');?>"><?php if($this->session->userdata['roleId'] == 0){ echo 'Student ';}else { echo 'Tutor ';}?>Resources</a></li>
	</ul>
	</div>-->
	 <div class="faqs-ttl content" style="font-size:12px;">
		<h2>
		<?php if($this->session->userdata('roleId') == 0): ?>
		<?php echo $lSTUDENT_RESOURCES;?>
		<?php else: ?>
		<?php echo $lTUTOR_RESOURCES;?>
		<?php endif;?>
		</h2>
	</div>
	<div class="how_works_mid">
		<div class="mgauto paly_box"><div class="video_Wp posR "  id="player_b"><div class="projekktor" id="player_a"></div></div></div>

		<h1 class="nowTitle"></h1>
		<div class="description"></div>
		
		
		<?php //echo '<pre>';print_r($resources);exit;?>

		<div class="list">
		<?php $j = 0;foreach($resources as $k=>$resource):?> 
			
			<?php if($resource['type'] == 'v'):?>
			<dl source="<?php echo base_url('__PATH__'.$resource['vfile']);?>" class="showVideo <?php if($j%2 == 1){echo "even";}$j++;?> ">
			<dt class="play_box_small">
				<span href="#">
					<span class="layer"></span>
					<span class="icon_play"></span>
					<img class="img" src="<?php echo base_url('vedio/support/images/'.$resource['vfile']);?>.jpg">
				</span>
			</dt>
			
			<dd>
				<p class="h1 sTitle" href="#"><?php echo @$resource['vtitle'];?> </p>
				<p class="h2"><?php //echo $llength; ?> - <?php //echo sec2min($howItwork['length']);?></p>
				<p class="intr sDesc">Description:  <?php echo $resource['vdescription'];?></p>
				<p class="tr"></p>
			</dd>
			</dl>
			<?php endif;?>
			<?php endforeach;?>

			<?php $jk = 0;foreach($resources as $k=>$resource):?> 
			<?php if($resource['type'] == 'l'):?>
			<?php //echo '<pre>';print_r($resources);exit;?>
			<dl  source="<?php echo $resource['link'];?>" class="showVideo1 <?php if($jk%2 == 1){echo "even";}$jk++;?> ">
			<dt class="play_box_small pdfarticle">
			<p href="#">
				<span class="layer"></span>
				<img src="http://www.thetalklist.com/uploads/video/images/pdf.jpg" class="img">
			</p>
			</dt>
			<dd>
			<p class="h1 sTitle pdfarticle">
			<a target="_blank" href="<?php echo base_url('uploads/source/'.$resource['link']);?>"><?php echo @$resource['ltitle'];?></a> </p>
			<p class="intr sDesc">Description:<?php echo $resource['ldescription'];?></p>
			<p class="tr"><a target="_blank" href="<?php echo base_url('uploads/source/'.$resource['link']);?>">DOWNLOAD</a></p>
			</dd>
			</dl>
			<?php endif;?>
			<?php endforeach;?>
			
			<?php $jk = 0;foreach($resources as $k=>$resource):
			?> 
			<?php if($resource['type'] == 'p'):?>
			<?php //echo '<pre>';print_r($resources);exit;?>
			<dl  source="<?php echo $resource['ptitle'];?>" class="showVideo1 <?php if($jk%2 == 1){echo "even";}$jk++;?> ">
			<dt class="play_box_small pdfarticle">
			<p href="#">
				<span class="layer"></span>
				<img src="http://www.thetalklist.com/uploads/video/images/pdf.jpg" class="img">
			</p>
			</dt>
			<dd>
			<p class="h1 sTitle pdfarticle">
			<a target="_blank" href="<?php echo base_url('vedio/support/'.$resource['vfile']);?>"><?php echo @$resource['ptitle'];?></a> </p>
			<p class="intr sDesc">Description:<?php echo $resource['pdescription'];?></p>
			<p class="tr"><a target="_blank" href="<?php echo base_url('vedio/support/'.$resource['vfile']);?>">DOWNLOAD</a></p>
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
	var proje = '';
	function createVideo(poster,videoPath,title){
	
		if(videoPath.search(".3gp")>0){ videoPath = videoPath + '.mp4'; }
		if(videoPath.search(".avi")>0){ videoPath = videoPath + '.mp4'; }
		if(videoPath.search(".wmv")>0){ videoPath = videoPath + '.mp4'; }

		//alert(videoPath);
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
			controls: true,
			playlist: [ { 0: {src:videoPath+'', type:'video/mp4'} }] 
		});
		
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		var _firstLesson 		= $('.list dl:first');
		if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){
			createVideo('<?php echo base_url('vedio/support/sample_video.mp4.jpg');?>','<?php echo base_url('vedio/support/sample_video.mp4');?>','Default vedio');
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}else {
			var _source = _firstLesson.attr('source');
			createVideo('<?php echo base_url('vedio/support/sample_video.mp4.jpg');?>',_source.replace('__PATH__','vedio/support/'),_firstLesson.find('.lname').html());
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			$('#howUpTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}
		$('.showVideo').click(function(){
			var _clickEl 	= $(this);
			var _li 		= _clickEl;
			var _source 	=  _li.attr('source');

			createVideo(_source.replace('images')+'.jpg',_source.replace('__PATH__','vedio/support/'),_li.find('.lname').html());
			$('.nowTitle').html($('.sTitle',_li).html());
			$('#howUpTitle').html($('.sTitle',_li).html());
			$('.description').html($('.sDesc',_li).html());
			document.location.href = '#top';
		})
	})
</script>


<!--Form to update user's activity status : Starts-->
<form name="userIdleStatus" id="userIdleStatus" method="post" action="admin/userpdatectivitytatus"><input type="hidden" id="userIdleStatusValue" value="" name="userIdleStatusValue"></form>
<!--Form to update user's activity status : Starts-->

<!--JavaScripts to detect user's activity status : Starts-->
<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/idle/idle-timer.js');?>"></script>
<script type="text/javascript">
	/*
	function updateUserActivityStatus(status){
		//alert(status);
		$('input[name=userIdleStatusValue]').val(status);
		var dataString = 'status='+status;
			$.ajax({
			type	: "POST",
			url 	: "admin/getuserpdatectivitytatus",
			data	: dataString,
			cache	: false,
			success: function(html){ alert(html)}
		});
	}

	YUI().use("*", function(Y){
		Y.IdleTimer.subscribe("idle", function(){
			//Y.get("#status").set("innerHTML", "User is idle :(").set("style.backgroundColor", "silver");
			//updateUserActivityStatus('FALSE');
			//alert('idle');
		});  
		Y.IdleTimer.subscribe("active", function(){
		//Y.get("#status").set("innerHTML", "User is active :D").set("style.backgroundColor", "yellow");
		//alert('active');
		//updateUserActivityStatus('TRUE');
		});
		Y.IdleTimer.start(10000);
	});
	*/
</script>
<!--JavaScripts to detect user's activity status: Ends-->