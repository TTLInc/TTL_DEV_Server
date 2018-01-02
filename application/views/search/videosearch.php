<?php 
/*header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache'); */

$uid = $this->session->userdata('uid');
$request_uri = $_SERVER['REQUEST_URI'];
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
$arrVal 	= $this->lookup_model->getValue('3', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('153', $multi_lang);
$lshowing	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('152', $multi_lang);
$lsortby	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('38', $multi_lang);
$lquicksearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('143', $multi_lang);
$lfreesearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('39', $multi_lang);
$llanguages	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('40', $multi_lang);
$lratings	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('41', $multi_lang);
$lcostperclass	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('42', $multi_lang);
$lavailability	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('162', $multi_lang);
$lavailabilitytobook	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('145', $multi_lang);
$ladvsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('146', $multi_lang);
$lall		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('144', $multi_lang);
$lcurrentonline	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('43', $multi_lang);
$lnextavailsession		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('114', $multi_lang);
$lgender	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('116', $multi_lang);
$lmale		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('115', $multi_lang);
$lfemale	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('147', $multi_lang);
$lprofilekeyword= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('117', $multi_lang);
$llocation	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('56', $multi_lang);
$lname		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('148', $multi_lang);
$lfuturedtutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('149', $multi_lang);
$lmoreresult	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('161', $multi_lang);
$lstars		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('155', $multi_lang);
$loutof		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('154', $multi_lang);
$lresults	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('47', $multi_lang);
$lprice		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('53', $multi_lang);
$lrating	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('159', $multi_lang);
$lview		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('273', $multi_lang);
$lbuildatutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('274', $multi_lang);
$lmaxcostusd	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('275', $multi_lang);
$lonlinenow	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('276', $multi_lang);
$ldiscusstopics = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('277', $multi_lang);
$lbusiness	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('278', $multi_lang);
$lmedical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('279', $multi_lang);
$lfinance	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('280', $multi_lang);
$lsoftware	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('3', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('288', $multi_lang);
$lnopreference	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('287', $multi_lang);
$lmapoftutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('289', $multi_lang);
$lshowmember	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('160', $multi_lang);
$lzoomin	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('222', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('277', $multi_lang);
$lbusiness	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('278', $multi_lang);
$lmedical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('279', $multi_lang);
$lfinance	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('280', $multi_lang);
$lsoftware	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('323', $multi_lang); 
$videotext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('359', $multi_lang); 
$authortext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('360', $multi_lang); 
$vvideosearchresult = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('321', $multi_lang); 
$vcredits = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('331', $multi_lang);
$ltoeic	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('332', $multi_lang);
$ltoefl	= $arrVal[$multi_lang];
//$arrVal 	= $this->lookup_model->getValue('363', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('384', $multi_lang);
$vbuildlesson	= $arrVal[$multi_lang];
//$arrVal 	= $this->lookup_model->getValue('274', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('385', $multi_lang);
$maxicc	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('367', $multi_lang);
$ldiscusstopics = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('376', $multi_lang);
$vbuy = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);	$lSEARCH   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('319', $multi_lang);	$lkeyword   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('526', $multi_lang);	$lENTER_AUTHOR   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('527', $multi_lang);	$lVIDEO_KEYWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('528', $multi_lang);	$lNO_RESULTS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1411', $multi_lang);	$shareyourexperience   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1412', $multi_lang);	$interestingvideoon   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1413', $multi_lang);	$wordorphrase   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1414', $multi_lang);	$minutemax   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1408', $multi_lang);	$definition   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('94', $multi_lang);	$upload   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1409', $multi_lang);	$enterphrase   		= $arrVal[$multi_lang];


$this->load->model(array('lookup_model'));
$this->layout->appendFile('javascript',"js/chat.js");
$arrVal = $this->lookup_model->getValue('321', $multi_lang);
$creditstext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1393', $multi_lang);
$confirmyourbooking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1394', $multi_lang);
$tutorwillbesent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1395', $multi_lang);
$whentutorarrives = $arrVal[$multi_lang];

$this->layout->appendFile('css',"css/search.css");
$this->layout->appendFile('css',"css/video_search.css");

$this->layout->appendFile('javascript',"js/jquery.placeholder.js");
$this->layout->appendFile('javascript',"js/jq.page.js");
$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/jquery.blockUI.js");

if($this->session->userdata('userFrom') == 'landing'):
$this->session->unset_userdata('userFrom');
endif;
?>
<script>
window.perPage = 20;
window.searchData = [];
var profileImgPath = '<?php echo base_url("uploads/video/");?>';
var profileImgNull = '<?php echo base_url("images/no-img.jpg");?>';
var profileUrlPath = '<?php echo base_url("user/profile/uid/");?>';
var createClassPath = '<?php echo base_url("user/calendar/uid/");?>';
var createLessonPath = '<?php echo base_url("user/lessons/uid/");?>';
var potentialPath = '<?php echo base_url("user/add2teachers/uid/");?>';
var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';
var _data = window.searchData;
//alert(_data['page']);
$(function(){
	//if()
	if($('#country').val() == 0)
	{
		//alert('hi');
		//$('#country').trigger('change');
	}
	$('#country').change(function(){
		var _cid = $(this).val();
		//alert('cid----'+_cid);
		if(_cid == '' || _cid == 0)
		{
			_cid = 2;
		}
		$.getJSON('<?php echo Base_url("user/getProvices");?>',{cid:_cid},function(provices){
			if (String == provices.constructor) {
				eval ('var provices = ' + provices);
			}
			$('select#province').empty();
			provices[0] = 'All States';
			for (var key in provices) {
				if (!provices.hasOwnProperty(key)) {
					continue;
				}
				if(key == 0){
					var option = $('<option />').val(key).append(provices[key]).attr('selected','selected');
				}
				else{
					var option = $('<option />').val(key).append(provices[key]);
				}
				$('select#province').append(option);    
			}
		});
	});
	
});

function checkuncheck(obj)
{
	if (obj.__chk) obj.checked = false
	if(obj.__chk == false)
		document.getElementById('keywords').value = obj.value;
	else
		document.getElementById('keywords').value = '';
}
function writeScript(src) {
    document.write('<' + 'script src="' + src + '"' +
                   ' type="text/javascript"><' + '/script>');
  }
</script>
<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>

<div class="video_wrapper">
	<div class="language_keyword_search_main cf">
		<form name="frmSearch" id="frmSearch" action="" method="get">
			<div class="language_keyword_search_left01">
				<select class="" name="langInput1">
					<option value="1" <?php echo (@$sessionSearchData["langInput1"] === '1') ? 'selected': ''; ?>>English</option>
					<option value="2" <?php echo (@$sessionSearchData["langInput1"] === '2') ? 'selected': ''; ?>>Español</option>
					<option value="3" <?php echo (@$sessionSearchData["langInput1"] === '3') ? 'selected': ''; ?>>Français</option>
					<option value="4" <?php echo (@$sessionSearchData["langInput1"] === '4') ? 'selected': ''; ?>>简体中文</option>
					<option value="5" <?php echo (@$sessionSearchData["langInput1"] === '5') ? 'selected': ''; ?>>繁體中文</option>
					<option value="6" <?php echo (@$sessionSearchData["langInput1"] === '6') ? 'selected': ''; ?>>日本語</option>
					<option value="7" <?php echo (@$sessionSearchData["langInput1"] === '7') ? 'selected': ''; ?>>한국어</option>
					<option value="8" <?php echo (@$sessionSearchData["langInput1"] === '8') ? 'selected': ''; ?>>Português</option>
				</select>
			</div>
			<div class="language_keyword_search_left02">
				<input type="text" placeholder="<?php echo $enterphrase; ?>" name="keywords" id="keywords" value="<?php echo @$sessionSearchData["keywords"] ?>">
			</div>
			<div class="language_keyword_search_left03">
				<select class="sortKeys" id="sortKeys" name="sortKeys">
					<option value="select_0" <?php echo (@$sessionSearchData["sortKeys"] === 'select_0') ? 'selected': ''; ?>><?php echo $lsortby;?></option>
					<option value="latest_1" <?php echo (@$sessionSearchData["sortKeys"] === 'latest_1') ? 'selected': ''; ?>>Latest</option>
					<!--<option value="firstName_1"><?php echo $lname;?></option>-->
					<option value="popular_1" <?php echo (@$sessionSearchData["sortKeys"] === 'popular_1') ? 'selected': ''; ?>>Popular</option>
				</select>
			</div>
			<div class="language_keyword_search_left04">
				<input value="<?php echo $lSEARCH;?>" class="" id="search" type="submit">
			</div>
		</form>
    </div>
    <div class="upload_video_main cf">
    	<div class="upload_video_left"><a href="<?php echo base_url("user/lessons/?v=uploadVideo"); ?>"><?php echo $upload; ?></a></div>
        <div class="upload_video_right">
        	<?php echo $shareyourexperience;?> <br>
			<span>1</span> <?php echo $interestingvideoon; ?> <span>1</span> <?php echo $wordorphrase; ?> <span>1</span> <?php echo $minutemax; ?>
        </div>
    </div>
    <div class="video_viewer_main cf">
		<?php if(count($lessons) > 0){ ?>
    	<div class="video_viewer_left">
		
		<?php if($_GET['v'] != ''){
			$filename = "uploads/video/images/".$playlesson['source'].".jpg";
			$vfilename = "uploads/video/".$playlesson['source'].".jpg";
			
			if(file_exists($vfilename)){
				$poster = "http://52.8.248.161/".$vfilename;
			}else{
				if (file_exists($filename)) {
					$poster = "http://52.8.248.161/".$filename;
				}else{
					$poster = "http://52.8.248.161/uploads/video/".$playlesson['source'].".jpg";
				}
			}
		?>
			<video style="cursor:pointer;background-color:#000;" id="example_video_top" class="video-js vjs-default-skin vjs-big-play-centered" width="99.9%" height="378px" controls preload="auto"  poster="<?php echo $poster;?>" data-setup="{}">
				<source src="<?php echo "http://52.8.248.161/uploads/video/".$playlesson['source']; ?>" type="video/mp4">
				<source src="<?php echo "http://52.8.248.161/uploads/video/".$playlesson['source']; ?>" type="video/ogg">
			  Your browser does not support video player.
			</video>
		<?php }else{
			$filename = "uploads/video/".$lessons[0]['source'].".jpg";
			if (!file_exists($filename)) {
				$poster = "http://52.8.248.161/uploads/video/images/".$lessons[0]['source'].".jpg";
			}else{
				$poster = "http://52.8.248.161/".$filename;
			}
		?>
			<video style="cursor:pointer;background-color:#000;" id="example_video_top" class="video-js vjs-default-skin vjs-big-play-centered" width="99.9%" height="378px" controls preload="auto"  poster="<?php echo $poster;?>" data-setup="{}" >
				<?php
				if(count($lessons) > 0){
				?>
				<source src="<?php echo "http://52.8.248.161/uploads/video/".$lessons[0]['source']; ?>" type="video/mp4">
				<source src="<?php echo "http://52.8.248.161/uploads/video/".$lessons[0]['source']; ?>" type="video/ogg">
				<?php }else{ ?>
				<source src="<?php echo base_url("uploads/video/2016/01/04/48df9ee76fea789287b28a9a5526a553.mp4"); ?>" type="video/mp4">
				<source src="<?php echo base_url("uploads/video/2016/01/04/48df9ee76fea789287b28a9a5526a553.mp4"); ?>" type="video/ogg">
				<?php
				}
				?>
			  Your browser does not support video player.
			</video>
			<?php } ?>
            <div class="video_heading_main cf">
				<?php if($_GET['v'] != ''){ ?>
            	<div class="video_heading_left01">
					<?php echo $playlesson['name']; ?>
					<span><a href='<?php echo base_url("user/profile/uid/".$playlesson['uid']);?>'><?php echo $playlesson['firstName']." ".$playlesson['lastName'];?></a></span>
				</div>
				<?php }else{ ?>
				<div class="video_heading_left01">
					<?php echo $lessons[0]['name']; ?>
					<span><a href='<?php echo base_url("user/profile/uid/".$lessons[0]['uid']);?>'><?php echo $lessons[0]['firstName']." ".$lessons[0]['lastName'];?></a></span>
				</div>
				<?php } ?>
				<!--<div class="fb-share-div">
					<div class="fb-share-button" data-href="http://dev.thetalklist.com/en/search/videosearch/?v=12" data-layout="button"></div>
				</div>-->
                <div class="video_heading_left03">
					<ul>
                    	<li>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "https://www.thetalklist.com".$request_uri; ?>&title=<?php echo $playlesson['name'];?>&picture=<?php echo $poster;?>&description=<?php echo $playlesson['desc'];?>" target="_blank"><img src="<?php echo base_url("images/facebook_48.png")?>" alt=""/></a>
						</li>
						<?php if($_GET['v'] != ''){ ?>
                        <li>
						<a href="#" onclick="sendBeepBoxMessage(<?php echo $playlesson['uid'];?>)"><img src="<?php echo base_url("images/mail_48.png")?>" alt="Send Message" title="Send Message"/></a>
						</li>
						<?php }else{ ?>
						<li>
						<a href="#" onclick="sendBeepBoxMessage(<?php echo $lessons[0]['uid'];?>)"><img src="<?php echo base_url("images/mail_48.png")?>" alt="Send Message" title="Send Message"/></a>
						</li>
						<?php } ?>
                        <li>
						<?php if ($tutorprofile['readytotalk'] == 1 AND $tutorprofile['uid'] != $uid) {?>
						<a href="#" onclick="bookNow(<?php echo $lessons[0]['uid'] ;?>,'<?php echo $tutorprofile['firstName'];?>','<?php echo $tutorprofile['school_id'];?>','<?php echo $tutorprofile['hRate'];?>')"><img src="<?php echo base_url("images/video_48.png")?>" alt="Talknow Online" title="TalkNow online"/></a>
						<?php }else{ 
						$tutorprofile['readytotalk']
						?>
						<a href="#" onclick=""><img src="<?php echo base_url("images/video_48_grey.png")?>" alt="TalkNow offline" title="TalkNow offline"/></a>
						<?php } ?>
						</li>
                    </ul>
                </div>
                <div class="video_heading_left02">
					<?php if($_GET['v'] != ''){ ?>
						<div class="video_like_large01 cf">
						<?php
						if($this->session->userdata('uid') != ''){
							$sql = "SELECT id FROM video_likes WHERE vid = ".$playlesson['id']." AND uid = ".$uid;
							$query = $this->db->query($sql);
							$videoresult  = $query->result_array();
							$likecount = count($videoresult[0]);
						}else{
							$likecount = 0;
						}
						
						if($likecount == 0){
						?>
							<a href="#" onclick='increaselike(<?php echo $playlesson['id'];?>)'><img src="<?php echo base_url("images/thumb-up.png")?>" alt="" class="thumbupcls" id="thumbup"/></a>
						<?php }else{ ?>
							<a href="#"><img src="<?php echo base_url("images/thumb-up-blue.png")?>" alt=""/></a>
						<?php } ?>
							<span><?php if(count($lessons) > 0){ echo $playlesson['likes']; } else { echo "50"; }?></span>
						</div>
						<div class="video_like_large02 cf">
							<img src="<?php echo base_url("images/filesq-viewer-icon.png")?>" alt=""/>
							<span><?php if(count($lessons) > 0){ echo $playlesson['views']; } else { echo "50"; }?></span>
						</div>
					<?php } else { ?>
						<div class="video_like_large01 cf">
						<?php
						if($lessons[0]['id'] == ''){
							$lessons[0]['id'] = '0';
						}
						
						if($this->session->userdata('uid') != ''){
							$sql = "SELECT id FROM video_likes WHERE vid = ".$lessons[0]['id']." AND uid = ".$uid;
							$query = $this->db->query($sql);
							$videoresult  = $query->result_array();
							$likecount = count($videoresult[0]);
						}else{
							$likecount = 0;
						}
						
						if($likecount == 0){
						?>
							<a href="#" onclick='increaselike(<?php echo $lessons[0]['id'];?>)'><img src="<?php echo base_url("images/thumb-up.png")?>" alt="" class="thumbupcls" id="thumbup"/></a>
						<?php }else{ ?>
							<a href="#"><img src="<?php echo base_url("images/thumb-up-blue.png")?>" alt=""/></a>
						<?php } ?>
							<span><?php if(count($lessons) > 0){ echo $lessons[0]['likes']; } else { echo "50"; }?></span>
						</div>
						<div class="video_like_large02 cf">
							<img src="<?php echo base_url("images/filesq-viewer-icon.png")?>" alt=""/>
							<span><?php if(count($lessons) > 0){ echo $lessons[0]['views']; } else { echo "50"; }?></span>
						</div>
					<?php } ?>
                </div>
            </div>
			<div><hr width="100%" align="center"></div>
			<div>
				<span class="video_desc"><p><strong><?php echo $definition;?>: </strong><?php if($_GET['v'] != ''){ echo $playlesson['desc']; }else{ echo $lessons[0]['desc']; } ?></p></span>
			</div>
        </div>
		<?php
		}else{
			echo "<br><br>";
			echo "<center><b><font size='4px'>Keyword did not match any videos.</font></b></center>";
		}
		?>
        <div class="video_viewer_right">
			<?php
			if(count($lessons) < 5){
				for($i = 0; $i < count($lessons); $i++){
					//print_r($lessons[$i]);
					?>
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
							<img src='<?php echo "http://52.8.248.161/uploads/video/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'></a>
							<?php } else { ?>
							<img src='<?php echo "http://52.8.248.161/uploads/video/images/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
						<?php
							}
						?></a>
						</div>
						<div class="video_block11516_right01">
							<h2><a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'><?php echo $lessons[$i]['name']; ?></a><span><a href='<?php echo base_url("user/profile/uid/".$lessons[$i]['uid']);?>'><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></a></span></h2>
							<div class="video_like01 cf">
								<img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/>
								<span><?php echo $lessons[$i]['likes']; ?></span>
							</div>
							<div class="video_like01 cf">
								<img src="<?php echo base_url("images/filesq-viewer-icon.png")?>" alt=""/>
								<span><?php echo $lessons[$i]['views']; ?></span>
							</div>
						</div>
					</div>
					<?php
				}
			}
			else if(count($lessons) >= 5){
				for($i = 1; $i < 6; $i++){
					//print_r($lessons[$i]);
					$tutorial_id .= $lessons[$i]['id'];
					?>
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
					<?php }else{ ?>
					
					<img src='<?php echo "http://52.8.248.161/uploads/video/images/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
					<?php
					}
					?>
							
							</a>
						</div>
						<div class="video_block11516_right01">
							<h2><a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'><?php echo $lessons[$i]['name']; ?></a><span><a href='<?php echo base_url("user/profile/uid/".$lessons[$i]['uid']);?>'><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></a></span></h2>
							<div class="video_like01 cf">
								<img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/>
								<span><?php echo $lessons[$i]['likes']; ?></span>
							</div>
							<div class="video_like01 cf">
								<img src="<?php echo base_url("images/filesq-viewer-icon.png")?>" alt=""/>
								<span><?php echo $lessons[$i]['views']; ?></span>
							</div>
						</div>
					</div>
					<?php
				}
			}
			else{
				echo "Video not found";
			}
			?>			
        </div>
    </div>
	
    
    <div class="video_3colum_main cf">
	
    	<ul class="cf">
			<?php
			if(count($lessons > 0)){
				for($i = 6; $i < count($lessons); $i++){
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
					$filename = "uploads/video/images/".$lessons[$i]['source'].".jpg";
					if (file_exists($filename)) {
						?>
					<img src='<?php echo "http://52.8.248.161/uploads/video/images/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'></a>
					<?php } else { ?>
						<img src='<?php echo "http://52.8.248.161/uploads/video/".$lessons[$i]['source'].".jpg"; ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'></a>
						<?php
					}
					
					?>
				</div>
					<div class="video_block11516_right01">
						<h2><a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'><?php echo $lessons[$i]['name']; ?></a><span><a href='<?php echo base_url("user/profile/uid/".$lessons[$i]['uid']);?>'><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></a></span></h2>
						<div class="video_like01 cf">
							<img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/>
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
	
	<div class="video_3colum_main_more cf" style="display:none;">
	
    	<ul class="cf">
			<?php
			if(count($lessons > 0)){
				for($i = 15; $i < count($lessons); $i++){
			?>
        	<li>
				<div class="video_block11516_main01 cf">
            	<div class="video_block11516_left01">
					<a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'>
					<img src='<?php echo base_url("uploads/video/images/".$lessons[$i]['source'].".jpg"); ?>' width='200px' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'></a>
				</div>
					<div class="video_block11516_right01">
						<h2><a href='#' onclick='showvideo(<?php echo $lessons[$i]['id'];?>)'><?php echo $lessons[$i]['name']; ?></a><span><a href='<?php echo base_url("user/profile/uid/".$lessons[$i]['uid']);?>'><?php echo $lessons[$i]['firstName']." ".$lessons[$i]['lastName']; ?></a></span></h2>
						<div class="video_like01 cf">
							<img src="<?php echo base_url("images/thumb-up.png")?>" alt=""/>
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
				} ?>
				
			<?php 
			}else{
				echo "Video not found";
			}
			?>
        </ul>
    </div>
	<?php $lessonId = end($lessons); //echo $lessonId['id']; ?>
	<div class='show_more' id='<?php echo $lessonId['id']; ?>'><a href='#'>Show more..</a></div>
	<div class="nick_show_more" style="display:none"></div>
</div>
<?php
$roleIdn = $this->session->userdata('roleId');
//$uid = $this->session->userdata('id');

if($roleIdn == 0)
{
	$apointmentbutton = "../images/btn-srch-02.png";
	$potentialbutton  = "../images/btn-srch-01.png";
}else{
	$apointmentbutton = "../images/btn-srch-02-gray.png";
	$potentialbutton  = "../images/btn-srch-01-gray.png";
}
$buynowbutton = '../images/buy-now-btn.png';
?>
<textarea id="resultListTemplate" style="display:none">
<!--
<dt><img src="{profileImgResultThumb($T.source)}" width="163"/></dt>
<dd>
	<div class="dd_top">
		<div class="dd_lf">
			<h1>{$T.lesson_name}  <font><a href="{profileUrl($T.uid)}">{$T.firstName} {$T.lastName}</a></font></h1>
			<p>{($T.desc != null) ? $T.desc : ''}</p>
		</div>
		<div class="dd_rt">{($T.price > 0) ? $T.price : '0.00'} <?php echo $vcredits; ?></div>
	</div>
	<div class="dd_bot">
		<div class="btn_group">
			<a href="{createLessonUrl($T.uid)}"><input type="button" class="" value="<?php echo $vbuy; ?>" id="register" /></a>
		
        </div>
	</div>
</dd>

-->
</textarea>
<div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
<script>
function sendBeepBoxMessage(uid)
{
	if(uid == '')
	{
		alert('Login First!');
		return false;
	}
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}


var attempts = 0;

function profileUrl(uid){
	return profileUrlPath+'/'+uid;
}
function profileImg(src){
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		return profileImgNull;
	}
	return profileImgPath+'/'+src;
}
function profileImgResultThumb(src){
	//alert(src);
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
		
		//return timthumbUrl + profileImgNull + '&h=163&w=163&zc=0';
		return profileImgNull;
	}else{
		var imgurl = profileImgPath + '/' + src + '.jpg';
		if(fileExists(imgurl))
		{
			//return timthumbUrl + profileImgPath+'/'+src+ '.jpg'+ '&h=163&w=163&zc=0';
			//return timthumbUrl + profileImgPath+'/'+src+ '.jpg'+ '&w=163&zc=0';
			return profileImgPath+'/'+src+ '.jpg';
		}else{
			//return timthumbUrl + profileImgNull + '&h=163&w=163&zc=0';
			return profileImgNull;
		}
		
	}
	
}
function fileExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
function createLessonUrl(uid){
	return createLessonPath+'/'+uid;
}

function showvideo(uid){
	window.location.replace("https://www.thetalklist.com/en/search/videosearch/?v="+uid);
}

function increaselike(id){
	cupdate ='vid='+id;
	$.ajax({
		url:'<?php echo base_url('search/incVideoLike/');?>',
		type:'POST',
		data:cupdate,
		dataType: 'html',
		cache: false,
		success:function(msg){
			if(msg == 0){
				alert('Please login to like the Video.');
			}else{
				//alert('Video is successfully liked.');
				//$('.thumbupcls').hide();
				$(".thumbupcls").attr("src", "<?php echo base_url("images/thumb-up-blue.png")?>");
			}
		}
	});
}

window.configs = <?php echo json_encode($config);?>;
$(function(){
	$('.sortKeys').change(function(){	
		$('#search').trigger('click');
	});
	
	$('#search').click(function(){
		var searchdata = {};
		searchdata['keyword'] = $('#keyword').val();
		searchdata['sortKeys'] = $('#sortKeys').val();

		$.ajax({
			  type:'GET',
			  data: searchdata,
			  url:'<?php echo base_url('search/videosearch/');?>',
			  success:function(msg){
					
				  /*if(msg == 1){
					  alert('Please login to continue to like the video');
				  }*/
			  } 
		});
	});
	
	$(document).on('click','.show_more',function(){
		var ID = $(this).attr('id');
		//alert(ID);
		$('.show_more').hide();
		$('.nick_show_more').show();
		$('.nick_show_more').text('Please wait...');
		$('.loding').show();
		$.ajax({
			type:'GET',
			url:'<?php echo base_url('search/videosearchmore/');?>',
			data:'id='+ID,
			success:function(msg){
				/*alert(msg);
				return false;*/
				$('.nick_show_more').hide();
				$('#show_more_main'+ID).remove();
				$('.video_3colum_main').append(msg);
			}
		});
		
	});
	
	$(document).on('click','.show_more_more',function(){
		var ID = $(this).attr('id');
		//alert(ID);
		/*return false;*/
		$('.show_more_more').hide();
		$('.nick_show_more_more').show();
		$('.nick_show_more_more').text('Please wait...');
		$('.loding').show();
		$.ajax({
			type:'GET',
			url:'<?php echo base_url('search/videosearchmore/');?>',
			data:'id='+ID,
			success:function(msg){
				$('.nick_show_more_more').hide();
				$('.video_3colum_main_more').show();
				$('#show_more_main'+ID).remove();
				$('.video_3colum_main_more').append(msg);
				return false;
			}
		});
		
	});
	
	$('a.showmoremore').click(function(e)
	{
		// Special stuff to do when this link is clicked...

		// Cancel the default action
		e.preventDefault();
	});
	
	$('a[href=#]').attr('href','javascript:void(0)');
	$('#search').click(function(){
		var _data = {};
		_data['langs'] = $.trim($('#langs').val());
		_hRateStart = $('#hourRateStart').val();
		_hRateEnd = $('#hourRateEnd').val();
		if(parseInt(_hRateEnd)<parseInt(_hRateStart)){
			$('#dialog').html('COST PER CLASS "To" field must be larger than "From".');
			$('#dialog').dialog({modal:true});
			return;
		}
		
		_data['keyword'] = $.trim($('#keywords').val());
		_data['page'] = 1;
		_data['perPage'] = window.perPage;
		var _sort = $('.sortKeys').val().split('_');
		_data['sort'] = _sort[0];
		_data['sortAsc'] = _sort[1];
		//var src = getSearch(_data);
		getSearch(_data);
		
	});
	$('.sortKeys').change(function(){
		$('#search').trigger('click');
	})
	//$('#search').trigger('click');
	
	$('#keywords').on('keypress', function (event) {
         if(event.which == '13'){
			$('#search').trigger('click');
         }
    });
	$('#author').on('keypress', function (event) {
         if(event.which == '13'){
			$('#search').trigger('click');
         }
    });
	
	$('.viewCount').click(function(){
		var _perPage = $('.number',this).html();
		
		if(_perPage == 'All'){
			_perPage = 10000;
		}
		
		var _data = window.searchData;
		_data['page'] = 1;
		_data['perPage'] = _perPage;
		
		//var src = getSearch(_data);
		getSearch(_data);
		
	})
})

function getSearch(data){
	window.searchData = data;
	
	if(data.keyword == '<?php echo $lVIDEO_KEYWORD;?>'){  data.keyword = 'Example: John UCLA TOEFL'}
	
	/*$('#dialog').html('loading.').attr('buttontype','doing');
	$('#dialog').dialog({modal: true});*/
	$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });

	var sType = $('#free_session').val();
	$.ajax({
		url: "<?php echo base_url("search/doVideoSearch");?>",
		type: 'GET',
		data: window.searchData,
		dataType: 'html',
		cache: false,
		success: function (msg){
			$.unblockUI();
			if (String == msg.constructor)
			{
				var result;
				//result = eval('(' + msg + ')');
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			//alert(result.rows['result'])
			if(result.count != '' || result.count !=0)
			{
				$('.number.nowShow').html(((result.page-1)*result.perPage +1 )+'-'+((result.page-1)*result.perPage + result.count));
				$('.number.count').html(result.totalCount);
				$('.search_rt_mid_t_rt').show();
				$('.v_ajax_page').show();
			}
			else{
				$('.number.nowShow').html('0-0');
				$('.search_rt_mid_t_rt').attr('style','display:none');
				$('.v_ajax_page').attr('style','display:none');
				$('.number.count').html('0');
				$('.result_list .featured').html('No Tutors found');
			}
			$('.v_ajax_page').pagination(result.totalCount,{
						current_page:result.page-1,
						items_per_page:result.perPage,
						callback:function(page,perPage,el){
							var _data = window.searchData;
							_data['page'] = page+1;
							getSearch(_data);
						}
			});
			$('.result_list.result').empty();
			$.each(result.rows['result'],function(k,v){
				//alert(v);
				var temp = $('<dl class="none"></dl>');
				temp.setTemplateElement('resultListTemplate');

				temp.processTemplate(v);
				temp.appendTo('.result_list.result').show(1000);
			})
			if(result.count == '' || result.count ==0)
			{
				//alert('hi');
				$('.search_rt_mid_t').hide();
				$('.no_result_found').show();
			}else{
				//alert('hi-2');
				$('.search_rt_mid_t').show();
				$('.no_result_found').hide();
			}
			$('#dialog').attr('buttontype','done');
			$( "#dialog:ui-dialog" ).dialog( "destroy" );
		}
	 });
	 return 'searchresulttrue'; 
	
}
function goProfile(userid)
{
	document.cookie="userID=" + userid;
}
$('#dialog').attr('buttontype','done');
$( "#dialog:ui-dialog" ).dialog( "destroy" );


function bookNow(tid,username,schoolId,hrate)
{
	if($(".video-icon").hasClass("loadingBk")){
		return;
	}
	$(".video-icon").addClass('loadingBk');
	bookNow1(tid,username,schoolId);
}

function bookNow1(tid,username,school_id)
{
	var mu_uid = $("#uid").val();
 
	if(mu_uid=='')
	{
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$('#dialog').attr('buttonType','done');
	$('#dialog').html('<?php echo $YouMust;?>');
	$( ".floating_form" ).show();
	}
	else
	{
	var lastClickedOnBook = false;
	//prevent multiple clicks
	if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	var refid ="<?php echo $Refid; ?>";
	
	var sessiontype=$('input[name=amex]:checked').val();
	if (school_id > 0 )
	{
		_data['schoolid']=school_id;
	}
	else
	{
		_data['schoolid']=0;
	}
	/* if(sessiontype==1 && refid != school_id)
	 {
		alert('You are not associated with this Tutor School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
		return false;
	 }*/
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		window.cost = json.cost;
		$('#bookingamount').val(window.cost);

		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(json.enough == false || json.enough == 'false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = true;
			
		}else if(json.availabletobook==false || json.availabletobook=='false'){
			window.returnvar = false;
			window.avl = false;
			window.profileComplete = true;
			
		}else if(json.profileCompletion==false || json.profileCompletion=='false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = false;
			
		}else{
			window.returnvar = true;
		}
		if(json.firstBookNow == false || json.firstBookNow == 'false'){
			window.firstBookNow = false;
		}else{
			window.firstBookNow = true;
			window.profileComplete = false;
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
		}
		
		if(json.enough)
		{
		window.enough=true;
		}
		else
		{
		window.enough=false;
		}
		setTimeout();
	})
	function setTimeout(){
		$(".video-icon").removeClass("loadingBk");
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				<?php
				$arrVal = $this->lookup_model->getValue('1127', $multi_lang);
				$YouAreTryingTo = $arrVal[$multi_lang];
				?>
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}else{
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,title:" ",resizable:false,  close: function( event, ui ) {self.location = self.location.href;}});
				return false;
			}else if(window.profileComplete == false){
				alert('<?php 
				$arrVal 	= $this->lookup_model->getValue('1057', $multi_lang);	$PleaseComplete 	= $arrVal[$multi_lang];
				echo $PleaseComplete;?>');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
			else if(window.enough==true){
				 var message ="<?php 
				 $arrVal 	= $this->lookup_model->getValue('1006', $multi_lang);	$tutotwillsendnoamount 	= $arrVal[$multi_lang];
				 echo $tutotwillsendnoamount;?>";
				  var conf = confirm(message);
				  var classcost = window.cost;
					if(conf == true)
					{
					// send message to tutor
						$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
							
							//redirect to student dashboard page
								//window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});return;
					callback(false);
					}else{
						return;
					}
					callback(false);
			}
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = '<?php $arrVal 	= $this->lookup_model->getValue('1084', $multi_lang);	$insuuffi	= $arrVal[$multi_lang];echo $insuuffi;?>';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,  buttons: [
         
        {
            text: "Ok",
            "class": 'saveButtonClass',
            click: function() {
                window.location.href = rechargeURL;
            }
        }
    ],
    close: function() {
       
    }});
				return false;
			}
		}else{
			$('#dialog1').dialog({
					modal:true,
					width:'430px',
					resizable:false,
					buttons: {
						"Ok": function() {
							$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						/*alert(msg);
						return false;*/
						//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});
						return;callback(false);
						$(this).dialog("close");},
						"Cancel": function() { $(this).dialog("close");}
					}
			});
			/*
			var conf = confirm(message);
			var classcost = window.cost;
			if(conf == true)
			{	
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			return;callback(false);
			}else{
			  
				return false;
			}*/
			lastClickedOnBook = false;
		 
		}
		return false;
	}//,4000);return false;
}}


function closeFunc()
{
	$('#dialog1').dialog('destroy');
}
</script>

<div id="dialog1" title="" style="display:None;">
	<div class="ratelist">
		<span class="title" style="float:left"><?php echo $confirmyourbooking;?> <input type='text' align="center" name='bookingamount' id='bookingamount' value='0' style="color: #3399cc; font-size: 20px; font-weight: normal; margin-bottom: 3px; width:60px; border:0px;" readonly	> <?php echo $creditstext;?></span>
	</div>
	
	<div class="ratelist">
		<br><p><span class="title" style="float:left; color:black;"><?php echo $tutorwillbesent;?></span>  </p>
		<br>
		<p><span class="title" style="float:left; color:black;"><?php echo $whentutorarrives;?></span>  </p>
		<p class="clearer"></p>
	</div>
</div>



<script>	
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
window.fbAsyncInit = function(){
FB.init({
    appId: '564390540302547', status: true, cookie: true, xfbml: true }); 
};	
(function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if(d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; 
    js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
    ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
	
function postToFeed(title, desc, url, image){
	var obj = {method: 'feed',link: url, picture: ''+image,name: title,description: desc};
	function callback(response){}
	FB.ui(obj, callback);
}

$('.btnShare').click(function(){
	window.open("http://www.facebook.com/share.php?u='http://www.thetalklist.com'&title=[123456]");
});

</script>

