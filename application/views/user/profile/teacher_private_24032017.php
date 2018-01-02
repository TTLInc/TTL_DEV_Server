<!-- expand collapse functionality -->
<script>
function div_hide()
{
    //alert(a);
    document.getElementById("bdid").style.display = 'none';
    document.getElementById("imgshow").style.display = 'block';
    document.getElementById("imghid").style.display = 'none';
}
function div_show()
{
    //alert(a);
    document.getElementById("bdid").style.display = 'block';
    document.getElementById("imgshow").style.display = 'none';
    document.getElementById("imghid").style.display = 'block';
}
function divcalendar_hide()
{
    //alert(a);
    document.getElementById("technocalendar").style.display = 'none';
    document.getElementById("calendarimgshow").style.visibility = 'visible';
    document.getElementById("calendarimghid").style.visibility = 'hidden';
}
function divcalendar_show()
{
    //alert(a);
    document.getElementById("technocalendar").style.display = 'block';
    document.getElementById("calendarimgshow").style.visibility = 'hidden';
    document.getElementById("calendarimghid").style.visibility = 'visible';
}
function rate_hide()
{
    document.getElementById("ratid").style.display = 'none';
    document.getElementById("imgcol").style.visibility = 'visible';
    document.getElementById("imgexp").style.visibility = 'hidden';
}
function rate_show()
{
    document.getElementById("ratid").style.display = 'block';
    document.getElementById("imgcol").style.visibility = 'hidden';
    document.getElementById("imgexp").style.visibility = 'visible';
}



</script>
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
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('40', $multi_lang);
$lratings = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('49', $multi_lang);
$lbiography = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('54', $multi_lang);
$lsessions = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('55', $multi_lang);
$loverallrating = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('281', $multi_lang);
$lmp4avi = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('50', $multi_lang);
$lskiing = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('51', $multi_lang);
$lbackpacking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('52', $multi_lang);
$lreading = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('373', $multi_lang);
$vvideosize = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('374', $multi_lang);
$vitementry = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('375', $multi_lang);
$vdesc = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('767', $multi_lang);
$thank = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('768', $multi_lang);
$visible = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('769', $multi_lang);
$upload = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('770', $multi_lang);
$y_video = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('771', $multi_lang);
$enter = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('772', $multi_lang);
$set = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('773', $multi_lang);
$haveFun = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('442', $multi_lang);	$lUPLOAD_VIDEO   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('443', $multi_lang);	$lUPLOAD_VIDEO_TIP   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('702', $multi_lang);	$personal   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('921', $multi_lang);	$Update   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);	$cancel   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('974', $multi_lang);    $morning            = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('975', $multi_lang);    $afternoon          = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('976', $multi_lang);    $night              = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('978', $multi_lang);    $sun                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('979', $multi_lang);    $mon                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('980', $multi_lang);    $tue                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('981', $multi_lang);    $web                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('982', $multi_lang);    $thu                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('983', $multi_lang);    $fri                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('984', $multi_lang);    $sat                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('986', $multi_lang);    $closed             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('799', $multi_lang);    $close              = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('458', $multi_lang);    $open               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('468', $multi_lang);    $opened             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('469', $multi_lang);    $booked             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('987', $multi_lang);    $book               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('804', $multi_lang);    $request               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('985', $multi_lang);    $requested               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('988', $multi_lang);    $confirm               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('989', $multi_lang);    $selecttopic               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('990', $multi_lang);    $bookslot               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1004', $multi_lang);    $confirmsession               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('993', $multi_lang);    $bookopentimeslotsadvance   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('992', $multi_lang);    $tutoravailable     = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1002', $multi_lang);    $selecttopictext   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1003', $multi_lang);    $requestslot               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('998', $multi_lang);    $freesession               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('997', $multi_lang);    $successrequest               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('996', $multi_lang);    $successbooking               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1001', $multi_lang);    $nopermission               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1000', $multi_lang);    $firstlogin               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('999', $multi_lang);    $enoughmoney               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1224', $multi_lang);    $GsessionRating               = $arrVal[$multi_lang];
$languageArray = array(
        "morning"=>$morning,"afternoon"=>$afternoon,'night'=>$night,
        'sun'=>$sun,'mon'=>$mon,'tue'=>$tue,'web'=>$web,'thu'=>$thu,'fri'=>$fri,'sat'=>$sat,
        'closed'=>$close,'closed'=>$close,'open'=>$open,'opened'=>$opened,
        'book'=>$book,'booked'=>$booked,'request'=>$request,'requested'=>$requested,'confirm'=>$confirm,
        'selecttopic'=>$selecttopic,'bookslot'=>$bookslot,'confirmsession'=>$confirmsession,'selecttopictext'=>$selecttopictext,'requestslot'=>$requestslot,
        'bookopentimeslotsadvance'=>$bookopentimeslotsadvance,'requestslot'=>$requestslot,'freesession'=>$freesession,'successrequest'=>$successrequest,
        'successbooking'=>$successbooking,'nopermission'=>$nopermission,'firstlogin'=>$firstlogin,'enoughmoney'=>$enoughmoney
        );
?>
<?php /*$this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");*/?>
<?php $this->layout->appendFile('javascript',"js/mycalendar/mycalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.blockUI.js"); ?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/mycalendar/mycalendar.css");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>

<?php $this->layout->appendFile('javascript',"js/jwplayer/jwplayer.js"); ?>

<?php $this->layout->appendFile('javascript',"js/json2.js");?>

<?php $this->layout->appendFile('javascript',"js/player1/osmplayer.compressed.js"); ?>
<?php $this->layout->appendFile('css',"js/player1/jquery-ui.css"); ?>
<?php $this->layout->appendFile('css',"js/player1/osmplayer_default.css"); ?>
<?php $this->layout->appendFile('javascript',"js/player1/osmplayer.default.js"); ?>

<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<style>
.ui-widget-content{/*border: 4px solid #0087d0;    border-radius: 0 !important; */background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}

/*.ui-dialog{		height: 115px !important;    margin-left:0px;    margin-top:0px;    width: 250px !important; background: none !important; top:563px !important; left:129px  !important}*/
.popup-step {    margin-top: -10px !important;}
.user_info .blog-hight-light{z-index:999999 !important; position:relative;}


</style>
<!--<script language="Javascript" type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';
        var languageArray = '<?php echo json_encode($languageArray); ?>';
        var uid = '<?php echo $this->session->userdata['uid']; ?>';
        var coded = Project.modules.customcalendar.mycalendersetting('technocalendar','',base_url,'tutor',0,languageArray,1,uid);
        });
</script>-->
<div id="customcalendar"></div>
<style>
.blog_title input{width:150px}
</style>
 <div class="baseBox baseBoxBg clearfix">
    	
		<?php include dirname(__FILE__).'/../leftSide.php';?>
        <div class="content_main fr">
        	<div class="main_inner">
                <?php /*<ul class="student_prof teacher_prof">
                    <?php echo profile_menu('t_private','p_prof',$profile['uid']);?>
                </ul>
				*/?>
                <!--/student_prof-->
                <div id="teacher_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="content" id="testUpload"><h2><?php echo $lprofile;?></h2></div>
                        </div>
						
                        <div class="bd" id="player_b">
							<!--
                          	<div class="video_Wp posR projekktor"  id="player_a">
                                <a class="upload_hdpic upload_videopic" id="profile_vedio_upload" href="javascript:void(0)" >   </a>
                          	</div> -->
                        
						
						<?php 
						/*
						echo "<pre>";
						print_r($_SERVER);*/
						$agent = $_SERVER['HTTP_USER_AGENT'];
						$pos = strpos($agent, "Firefox");
						if($profile["vedio"] !='')
						{
							$extarray = explode('.',$profile["vedio"]);
						 
						  $videopath = base_url("uploads/video")."/".$profile["vedio"];
							$imagepath = base_url("uploads/video")."/".$profile["vedio"].".jpg";
						}
						else						
						{
							$videopath = base_url("vedio/profile.mp4");
							$imagepath = base_url("images/profile.png");
						}
						 ?>
						<?php if(@$extarray['1'] == 'mov' OR @$extarray['1'] == 'MOV' OR  @$extarray['2'] == 'mov' OR @$extarray['2'] == 'MOV'){
							
								?>
								
								<!--<video style="cursor:pointer;" id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" width="719" height="397" controls preload="auto"  poster="<?php echo $imagepath; ?>" data-setup='{}'>
	 <source src="<?php echo $videopath; ?>" type='video/mp4' />
	 <source src="<?php echo $videopath; ?>" type='video/mov' />
</video> 

<script type="text/javascript">
  $(function() {
    $("video").osmplayer({
      width: '719px',
      height: '397px'
    });
  });
</script>
<video src="<?php echo $videopath; ?>" poster="<?php echo $imagepath;?>"></video>-->

						<?php 
						}
						else { ?>
						
							<div class="vid_box clearfix">
						
							<div id="vid">Loading the player...</div>
						</div>
						<script type="text/javascript">
							var video = "vid";
							jwplayer(video).setup({
								file: "<?php echo $videopath;?>"
								,image: "<?php echo $imagepath;?>"
								,rtmp: {
									bufferlength: 0.1
								}
								,width: "719"
								,height: "397"
								,autostart:"false"
								,events:{
									onTime: function(object) {
										if(object.duration>100){var deduaction = 0.40;}else{var deduaction = 0.25;}
										if(object.position > object.duration - deduaction) {this.pause();}
									}
								}
							});
						</script>
						<?php }?>
			
			 </div>
                        <!--
						<div class="upload-nw" id="profile_vedio_upload_true_1" style="margin-top:5px;">
							<?php
							$arrVal = $this->lookup_model->getValue('48', $multi_lang);
							echo $arrVal[$multi_lang];
							?>
						</div>-->
						<div class="video-upload-ttl">
						<input type="button" value="<?php echo $lUPLOAD_VIDEO;?>" class="blue aqua_btn" id="new_upload_video_lnk" style="position:relative;" />
						</div>
						<a href="javascript:void(0)" id="new_upload_video_lnk_true" style="display:none;" ><?php echo $lUPLOAD_VIDEO;?></a>
						
                    </div><!--/mod-->
                    <div class="mod">
                       
                            <div class="content"><h2><?php echo $lbiography;?>

							<span style="float:right"><img id="imghid" style="margin-right:0px;" src="<?php echo site_url('images/decrease.jpg')?>" onclick="div_hide();"/> <img id="imgshow" style=" display:none;margin-right:0px;" src="<?php echo site_url('images/expand.jpg')?>" onclick="div_show();"/></span>

							</h2></div>

                        <div class="bd" id="bdid">
                        	<dl class="biog_info">
                            	<!--<dt><span class="u_edit_ic"></span>1.  Skiing</dt>-->
           						<dd ><p id="skill"><?php echo nl2br($profile['personal']);?> </p><span class="u_edit_ic1" style="visibility:visible"></span></dd>
								<!--<dt><span class="u_edit_ic" ></span>2.  Backpacking</dt>-->
           						<dd><p id="academic"><?php echo nl2br($profile['academic']);?></p><span class="u_edit_ic1"></span></dd>
								<!--<dt><span class="u_edit_ic"></span>3.  Reading</dt>-->
           						<dd><p id="professional"><?php echo nl2br($profile['professional']);?> </p><span class="u_edit_ic1"></span></dd>
                            </dl>
                        </div>
                    </div> 
                    <div class="mod">
                        <div class="hd">
						
                            <div class="content rating">
                            	<h2><?php echo $lratings;?><span style="float:right"><img id="imgexp" style="margin-left:5px;" src="<?php echo site_url('images/decrease.jpg')?>" onclick="rate_hide();"/></span> 
						<span style="float:right"><img id="imgcol" style="visibility:hidden; margin-right:-46px !important;margin-left:5px;" src="<?php echo site_url('images/expand.jpg')?>" onclick="rate_show();"/></span> 

                            		 <div class="fr"><span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $sessionCount;?></span><span><?php echo $loverallrating;?>:</span><div class="ratings_score_b fr" id="" style="margin-top: 5px; margin-right: 10px;"><s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>"></s>
									 
									 </div>
									 
									 </div>
									 
                            	</h2>
						
                            </div>
							
                        </div>
                          <div class="bd" id="ratid">
                          	<ul class="ratings_list">
                                <?php foreach ($ratings as $k=>$rate):?>
								<li>
                                	<div class="header_pic_L fl">
                                    	<div class="header_pic">
                                        	<img src="<?php echo profile_image($rate['pic']);?>" width="78" height="80" />
                                        </div>
                                        <div class="hd_pic_name"><?php echo $rate['firstName'],' ',$rate['lastName'];?></div>
                                    </div>
                                    <div class="rating_ct">
										<?php
											$rateScore = intval( ($rate['onTime']+$rate['clearReception'])/2 );
										?>
                                    	<div class="ratings_score" id=""><s class="ratings_score_yellow star<?php echo $rateScore;?>"></s></div>
                                		<div class="ratings_txt"><?php echo $rate['msg'];?></div>
                                        <div class="rating_date">
                                        	<em> <?php echo date( 'h:i a, M d, Y' , outTime($rate['create_at']));?></em>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                                
                          	</ul>
                        </div>
                    </div><!--/mod-->
                    
                    <!-- added by haren to dispaly group session rating *** -->
					 	
					
					     <div class="mod">
                        <div class="hd">
						
                            <div class="content rating">
                            	<h2><?php echo $GsessionRating;?><span style="float:right"><img id="imgexp1" style="margin-left:5px;" src="<?php echo site_url('images/decrease.jpg')?>" onclick="grouprate_hide();"/></span> 
						<span style="float:right"><img id="imgcol1" style="visibility:hidden; margin-right:-46px !important;margin-left:5px;" src="<?php echo site_url('images/expand.jpg')?>" onclick="grouprate_show();"/></span> 

                            		 <div class="fr"><span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $GroupsessionCount;?></span><span><?php echo $loverallrating;?>:</span><div class="ratings_score_b fr" id="" style="margin-top: 5px; margin-right: 10px;"><s class="ratings_score_yellow star<?php echo $GetGroupRating;?>"></s>
									 
									 </div>
									 
									 </div>
									 
                            	</h2>
						
                            </div>
							
                        </div>
                          <div class="bd" id="groupRateId">
                          	<ul class="ratings_list">
                                <?php foreach ($GroupRating as $k=>$rate):?>
								<li>
                                	<div class="header_pic_L fl">
                                    	<div class="header_pic">
                                        	<img src="<?php echo profile_image($rate['pic']);?>" width="78" height="80" />
                                        </div>
                                        <div class="hd_pic_name"><?php echo $rate['firstName'],' ',$rate['lastName'];?></div>
                                    </div>
                                    <div class="rating_ct">
										<?php
											$rateScore = intval( ($rate['onTime']+$rate['clearReception'])/2 );
										?>
                                    	<div class="ratings_score" id=""><s class="ratings_score_yellow star<?php echo $rateScore;?>"></s></div>
                                		<div class="ratings_txt"><?php echo $rate['msg'];?></div>
                                        <div class="rating_date">
                                        	<em> <?php echo date( 'h:i a, M d, Y' , outTime($rate['create_at']));?></em>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                                
                          	</ul>
                        </div>
                    </div>
					
				<!-- haren code end -->
                </div>
            </div>
        </div>
		 <!--/content_main-->
		</div>

	<textarea id="biog_info_template" style="display:none">
<a style="cursor:pointer"><span class='myedit'>  		
<!--<dt class="disp"><span class="u_edit_ic1" id="{}"></span><span class="blog_title changeme input" index="{$T.keyIndex-1}" style="width:150px;" id="{$T.title}">{$T.title}</span>
</dt>-->


		<dd id="{$T.keyIndex-1}">
		
		<span id="skill" class="blog_desc changeme textarea" style="text-align:left;" index="{$T.keyIndex-1}">
		
		<?php echo $T;?>
		{$T.desc.replace(/\r\n|\r|\n/g, "<br />");}
		</span> <span class="u_edit_ic" style="visibility:visible; float: right;"></span>
		</span></dd></a>
	</textarea>
	
	
	<?php if(($this->session->userdata('userFrom') == 'landing' OR $this->session->userdata('ancode') == 'y') AND $this->session->userdata('new') == 1):?>
		<script>
			$('#dialog3').dialog({
					modal:true,
					width:'430px'
			});
			$('.firstok').click(function(){
				$( "#dialog3:ui-dialog" ).dialog( "destroy" );
			})
		</script>
	<?php 
	$this->session->unset_userdata('userFrom');
	$this->session->unset_userdata('ancode');
	endif; ?>
<script>
	function processBiogInfo(data){ 
     
	 
		$('.biog_info').html('');
		
		$.each(data,function(k,v){
        

		 if(k==0 && v.desc =='')
		  {
		  
		     v.desc="My teaching philosophy is...\nMy favorite sport is...\nMy favorite thing to do is..\nMy favorite movie is";
		  }
		  if(k==1 && v.desc =='')
		  {
		  
		     v.desc="I went to school at...";
		  }
		  if(k==2 && v.desc =='')
		  {
		  
		     v.desc="I have worked at...";
		  }
			var _tempDiv = $('<div></div>');
			v.keyIndex = parseInt(k)+1;
			_tempDiv.setTemplateElement('biog_info_template').processTemplate(v);
		
			$('.biog_info').append(_tempDiv.html());
		})	
		// create three dynamic div with index of description- Haren
		if(data.length <3)
		{
		
		    var a="My teaching philosophy is...\nMy favorite sport is...\nMy favorite thing to do is..\nMy favorite movie is";
			var _tempDiv = $('<div id="data.length"></div>');
			_tempDiv.setTemplateElement('biog_info_template').processTemplate({title:'<?php echo $personal."ff";?>',desc:'',keyIndex:1});
			a=a.replace(/\n/g, '<br />');

 
			$('.biog_info').append(_tempDiv);
            document.getElementById("skill").innerHTML=a;
			
			
			var _tempDiv = $('<div id="data.length"></div>');
			_tempDiv.setTemplateElement('biog_info_template').processTemplate({title:'<?php echo "Educational";?>',desc:'<?php echo "I went to school at...";?>.',keyIndex:2});
			$('.biog_info').append(_tempDiv);
            
			var _tempDiv = $('<div id="data.length"></div>');
			_tempDiv.setTemplateElement('biog_info_template').processTemplate({title:'<?php echo "Professional";?>',desc:'<?php echo "I have worked at...";?>.',keyIndex:3});
			$('.biog_info').append(_tempDiv);
		}
       
		$(".textarea").editable("<?php echo Base_url('user/editpsingle');?>", { 
			
			indicator : "saving..",
				//tooltip   : "Doubleclick to edit...",
				
				submit : "<?php echo $Update;?>",
				cancel:'<?php echo $cancel; ?>',
				type:'textarea',
				rows:'4',	
				cols:'90',
				input:'',
				event     : "click",
				submitdata : function(data,ss,dd) {
				
					var _data = [];
                     $('.blog_title.changeme').each(function(){
						var _thisObj  = $(this);
						var _index = parseInt(_thisObj.attr('index'));
						_data[_index] = {};
						_data[_index]['title'] = _thisObj.html();
					})
					$('.blog_desc.changeme').each(function(){
					
						var _thisObj  = $(this);
						var _index = parseInt(_thisObj.attr('index'));
						
						if( typeof($('textarea,input',_thisObj).get(0)) !='undefined'){
							_data[_index]['desc'] = $('textarea,input',_thisObj).val();
							_data[_index]['desc']=_data[_index]['desc'].replace(/(<br\s*\/?>)+/g, '\n');
							
							
						}else{
							_data[_index]['desc'] = _thisObj.html();
							_data[_index]['desc']=_data[_index]['desc'].replace(/(<br\s*\/?>)+/g, '\n');	
						}
						
					})
					var dataTemp = [];
					$.each(_data,function(k,v){
					
						if((v.title.trim()!='<?php echo $vitementry;?>' && v.title.trim()!='')  || (v.desc.trim()!='<?php echo $vdesc;?>.' && v.desc.trim()!='') ){
							
							dataTemp.push(v);
							
						}
					})
					_data = dataTemp;
					
					return {value:_data,id:'skill'};
				},
				callback:function(val,setting){
				//alert(val);
				
					if (String == val.constructor) {      
					eval ('var result = ' + val);
				
					
					} else {
						var result = val;
					}
					//alert(result.length);
					processBiogInfo(result)
				}
		});
		
		$('dd .u_edit_ic','.biog_info').click(function(){
        
		 $(this).prev('a .myedit .blog_desc').trigger('click');
		 
		});
		$('a .myedit','.biog_info').click(function(){
          
				jQuery(this).find('dd .blog_desc').trigger('click');
		
		 
		});
		
	}
	proje = '';
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
			title: "<?php echo $profile['username'];?> Guest Member�s Video",
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
	}
	$(function(){
		try{
       
	    
		<?php
	$psn = addcslashes($profile['personal'],"\\\'\"\n\r");
	$edu = addcslashes($profile['academic'],"\\\'\"\n\r");
	$prof = addcslashes($profile['professional'],"\\\'\"\n\r");
      ?>
	  
        //_blogInfo = [{"title":"Personal","desc":""},{"title":"Educational","desc":""},{"title":"Professional","desc":""}];		 
		_blogInfo = [{"title":"Personal","desc":"<?php echo ($psn);?>"},{"title":"Educational","desc":"<?php echo $edu;?>"},{"title":"Professional","desc":"<?php echo $prof;?>"}];
			if(typeof(_blogInfo) == 'undefined' || _blogInfo =='' || _blogInfo==null){
				_blogInfo = [];
			}
		}catch(e){
			_blogInfo = [];
		}
		
		processBiogInfo(_blogInfo);
		var button12 = $('#new_upload_video_lnk_true'), interval1;
		new AjaxUpload(button12,{
			action: '<?php echo Base_url('user/profile_video');?>',
			enable:true,
			name: 'userfile',
			id: 'videouploadid',
			type:'video/*',
			onSubmit : function(file, ext){
				if(typeof(this._input.files)!='undefined'){
					if(typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined' && this._input.files[0].size != ''){
						if(this._input.files[0].size > 20971520){
							alert('Filesize too large, please use a video less than 20mb.  Converting to MP4 can reduce filesize considerably.');
							return false;
						}
					}
				}
				if(ext == 'mp4'|| ext == 'MOV' || ext == 'avi' || ext == 'flv'|| ext == 'rm'|| ext == 'wma'|| ext == 'rmvb'|| ext == '3gp'|| ext == 'wmv'){
				}else{
					$( "#dialog p").html('The file can not be supported.');
						$( "#dialog" ).dialog({
							modal: true
						});
						return false;
				}
				$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading26.gif" />' });
				/*$( "#dialog p").html('Uploading.');
				$( "#dialog" ).dialog({
					modal: true
				});*/
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				//this.disable();
				interval1 = window.setInterval(function(){
					var text = $( "#dialog p").html();
					if (text.length < 13){
						$( "#dialog p").html(text + '.');
					} else {
						$( "#dialog p").html('Uploading');				
					}
				}, 200);
			},
			onComplete: function(file, response){
				$.unblockUI();
				$( "#dialog p").html('Uploaded');
				$( "#dialog").dialog('close');			
				window.clearInterval(interval1);
				this.enable();
				 
				if (String == response.constructor) {
					eval ('var jsonres = ' + response);
				} else {
					var jsonres = response;
				} 
				location.reload();
				createVideo(jsonres.image+'.jpg',jsonres.video);
				$('.ppbuffering').hide();
				
			}
		});
		//createVideo('<?php echo profile_video($profile["vedio"]);?>','<?php echo profile_video($profile["vedio"],"");?>');
		createVideo('<?php echo myprofile_video($profile["vedio"]);?>','<?php echo myprofile_video($profile["vedio"],"");?>');
		$("#skill,#backpack,#read").editable("<?php echo Base_url('user/editpsingle');?>", { 
				indicator : "saving..",
				//tooltip   : "Doubleclick to edit...",
				submit : "OK",
				cancel:'CANCEL',
				type:'text',
				event     : "click",
			//	style  : "inherit",
				callback:function(val,setting){
				
				 
				}
		});
		$("div.video-upload-ttl").hover(function () {
			$(this).append('<div class="video-upload-tooltip"><p><?php echo $lUPLOAD_VIDEO_TIP;?> </p></div>');
		}, function () {
			$("div.video-upload-tooltip").remove();
		});
	})
	$(".ppstart").click(function() {
		$('.ppbuffering').hide();
	});
	$( document ).ready(function() {
		$('#new_upload_video_lnk').click(function(){
			$('input[type=file]').css('display','block')
			$('#videouploadid').trigger('click');
		});
	});
	
	$( document ).ready(function() {
		$('#vupld').click(function(){
			//alert("ok");
			$('input[type=file]').css('display','block')
			$('#videouploadid').trigger('click');
		});
	});
</script>
<style>
.ppbuffering {display:none !important;}
button{
margin-left:2px;margin-top:6px;width:110px;
background: url(<?php echo base_url(); ?>images/btn.png) no-repeat 0 0;
	border: 0 none;
	color: #FFFFFF;
	cursor: pointer;
	font-size: 14px;
	font-weight: bold;
	height:34px;
  text-align: center;
	text-decoration: none;
	}
#profile_vedio_upload_true_1{ height:55px; margin-top:-10px; padding-top:7px;}
#Educational
{
background:url(<?php echo base_url();?>images/main/step_2.png) 0 4px no-repeat;
padding:13px 0 9px 87px;
font-size:1.5em;;
font-weight:300;
color:#E8B800;
}
#Personal
{
background:url(<?php echo base_url();?>images/main/step_1.png) 0 4px no-repeat;
padding:13px 0 9px 87px; 
font-size:1.5em;;
font-weight:300;
color:#84C022;
}
#pessoal
{
background:url(<?php echo base_url();?>images/main/step_1.png) 0 4px no-repeat;
padding:13px 0 9px 87px; 
font-size:1.5em;;
font-weight:300;
color:#84C022;
}

#Professional
{
background:url(<?php echo base_url();?>images/main/step_3.png) 0 4px no-repeat;; 
padding:13px 0 9px 87px; 
font-size:1.5em;;
font-weight:300;
color:#3399CC;
}
.u_edit_ic
{
cursor:pointer;
}

</style>


<?php
if(isset($_GET['chng']) and $_GET['chng']=="br") {?>
<script type="text/javascript">
$(document).ready(function(){
   $('#changeTour').dialog({
		modal:true,
		width:350,
		resizable:false
	});
    $('.blog-hight-light').addClass('hight-light' );
	$('.ui-dialog').wrap('<div class="main_popupdivchng"></span>' );
	$(".ui-dialog-titlebar-close").click(function(){
		$('#changeTour').dialog("close");
	});
});
</script>
<style>
.ui-widget-content{background:none;}
</style>
<div id="changeTour" title="" style="display:none;">
	<div class="popup-step margin-top tutoe-step1">
        <div class="step-div-bg txtblue" style="overflow: auto;margin-top:0px;line-height:1.6em;">
            <?php
            $arrVal 	= $this->lookup_model->getValue('1246', $multi_lang);
            $cmpltBronzeProfile	= $arrVal[$multi_lang];
            echo $cmpltBronzeProfile;
			?>
        </div>
    </div>
</div>
<?php }?>
<div id="firstTour" title="" style="display:none;">
 	<div class="popup-step margin-top tutoe-step1">
		<div class="step-div-bg">
			<h1 class="poupttl">
				<?php
				$arrVal = $this->lookup_model->getValue('1347', $multi_lang); $lngCoolProf = $arrVal[$multi_lang];
				echo $lngCoolProf;
				?>
			</h1>
			<span class="popup-no step1 posi-abl">1</span>
			<p style="margin:0 0 0px !important;padding:0px;"><span class="title" style="float:left;line-height:15px;">
			<?php 
			$arrVal 	= $this->lookup_model->getValue('1155', $multi_lang);	$CompleteEach 	= $arrVal[$multi_lang];
			echo $CompleteEach; ?><br/><br/></span>			
			</p>
			<div class="pop-pagin">
				<ul>
					<li class="active"><span><a href="<?php echo base_url('user/dashboard?step=1');?>">1</a></span></li>
					<li><span><a href="<?php echo base_url('user/calendar/uid/'.$this->session->userdata('uid').'?step=2');?>">2</a></span></li>
					<li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=3');?>">3</a></span></li>
					<li><span><a href="<?php echo base_url('user/account?step=4');?>">4</a></span></li>
					<!--<li><span><a href="<?php echo base_url('user/changeInfo?step=5');?>">5</a></span></li>-->
				</ul>
			</div>
			<a href="<?php echo base_url('user/calendar/uid/'.$this->session->userdata('uid').'?step=2');?>"> Next  </a>
		</div>
	</div>
</div>
<script>
$(window).load(function() {
var step="<?php echo $_GET["step"];?>";
if(step==1)
{
firstTourTutor();
}
});
function firstTourTutor()
{
$( "#dialog3:ui-dialog" ).dialog( "destroy" );
var a='<?php echo $this->session->userdata('firstTimeRegister'); ?>'; 
var x='<?php echo $this->session->userdata('Continue');?>';

var rollId='<?php echo $this->session->userdata('roleId'); ?>'; 

var step="<?php echo $_GET["step"];?>";
if(a =='yes' && rollId >=1 && rollId <=3 && (x =='' || step ==1))
{
<?php echo $this->session->set_userdata('Continue','yes');?>
 $('#firstTour').dialog({
					modal:true,
					width:340,
					resizable:false,
			});
			
 $('.blog-hight-light').addClass('hight-light' );	
 
 //$('.blog-hight-light').append('<span class="popup-no step1">1</span>' ); 
 $('.ui-dialog').wrap('<div class="main_popupdiv"></span>' );
 }
}
</script>