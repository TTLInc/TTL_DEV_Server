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
$arrVal 		= $this->lookup_model->getValue('200', $multi_lang);
$lpurchasedlesson	= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('201', $multi_lang);
$lremovevideo		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('202', $multi_lang);
$lrecorded		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('203', $multi_lang);
$llength		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('87', $multi_lang);
$ldescription 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('325', $multi_lang);
$plessonstxt 		= $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
 <div class="baseBox baseBoxBg clearfix">
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
                    <?php echo profile_menu('s_private','a_prof',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                 <div id="student_prof_Wp">
                	<div class="bd" id="player_b">
                          	<div class="video_Wp posR projekktor"  id="player_a">
                                <a class="upload_hdpic upload_videopic" id="profile_vedio_upload" href="javascript:void(0)" >   </a>
                          	</div>
                        </div>
					<!--<div class="video_Wp posR "  id="player_b">
						<div class="projekktor" id="player_a"></div>
					</div>-->
                	
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle"><h2><?php echo $lpurchasedlesson;?></h2>
                            <span style="font-size:14px;"><?php echo $plessonstxt; ?></span>
                            </div>
                        </div>
                        <div class="bd">
                            <ul class="archivedList">
								<?php foreach($lessons as $k=>$lesson):?> 
                            	<li source="<?php echo base_url('__PATH__'.$lesson['source']);?>" class="lesson">
                                	<div class="video_pic_163x90 posR fl">
                                    	<a href="javascript:void(0)" class="showVideo"><img src="<?php echo profile_video($lesson['source']);?>" width="163" height="90" /><span class="video_ic video_ic_s"></span></a>
                                    </div>
                                    <div class="video_pic_intro c666">
                                    	<div class="video_hd clearfix">
                                        	<h3 class="c424242 f14 fl">
                                            	<a href="javascript:void(0)" class="lname"><?php echo $lesson['name'];?></a> - 
												<span class="c047d9e">
													<a href="<?php echo tl_url('user/profile',$lesson['uid']);?>"><?php echo $lesson['firstName'],' ',$lesson['lastName'];?></a>
												</span>
                                            </h3>
                                            <span class="fr c939393"><a href="javascript:void(0)" class="delClass"><em class="ico_op ico_del2 "></em><?php echo $lremovevideo;?></a></span>
                                        </div>
                                        <div class="archived_desc"><strong><?php echo $ldescription;?>: </strong> <?php echo $lesson['desc'];?></div>

                                        <div class="archived_info clearfix">
                                        	<span class="fl"><?php echo $lrecorded;?>: <?php echo date( 'M d, Y' , outTime($lesson['creat_at']));?></span>
                                        	<span class="fr"><?php echo $llength;?>: <?php echo sec2min($lesson['length']);?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/../leftSide.php';?>
    </div>
	<script>
	function createVideo(poster,videoPath){
		if(videoPath.search(".3gp")>0){
			videoPath = videoPath + '.mp4';
		}
		if(videoPath.search(".avi")>0){
			videoPath = videoPath + '.mp4';
		}
		if(videoPath.search(".wmv")>0){
			videoPath = videoPath + '.mp4';
		}
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>'));
		proje = '';
		proje = projekktor('#player_a', {
			title: "Guest Member’s Video",
			debug: false,
			poster: poster,
			width: 719,
			height: 397,
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			controls: true,
			playlist: [
				{
					0: {src:videoPath, type:'video/mp4'}/*,
					2: {src:videoPath+'.ogv', type:'video/ogv'},
					1: {src:videoPath+'.ogg', type:'video/ogg'}*/
				}
			] 
		});
	}/*
	function createVideo(poster,videoPath,title){
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: title,
			debug: false,
			poster: poster,//'<?php echo profile_video($profile["vedio"]);?>',//'<?php echo Base_url("images/intro.png");?>',
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
					0: {src:videoPath+'.ogv', type:'video/ogv'},
					1: {src:videoPath+'.ogg', type:'video/ogg'},
					2: {src:videoPath+'.mp4', type:'video/mp4'}
				}
			] 
		});
	}*/
	$(function(){
		
		$('.delClass').hide();
		$('.archivedList li').hover(function(){
			$('.delClass',this).show();
		},function(){
			$('.delClass',this).hide();
		})
		var _firstLesson = $('.archivedList li:first');
		if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){
			createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default vedio');
		}
		else {
			var _source = _firstLesson.attr('source');
			createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_firstLesson.find('.lname').html());
		}


		$('.showVideo').click(function(){
			var _clickEl = $(this);
			var _li = _clickEl.parents('li.lesson');
			var _source =  _li.attr('source');
			createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_li.find('.lname').html());
		})
	})
	</script>
    <style>
	.prof_on{ background-position:-309px -333px;}
	</style>
