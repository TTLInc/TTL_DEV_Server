<!doctype html>
<html lang="en">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php if(!defined('ALLOW_ALL_EXTERNAL_SITES') ) define ('ALLOW_ALL_EXTERNAL_SITES', TRUE);?>
<?php
$multi_lang = 'en';
if(isset($_SESSION['multi_lang'])){
	$multi_lang = $_SESSION['multi_lang'];
}else{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('37', $multi_lang);
$privacy_policy = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('133', $multi_lang);
$terms		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('10', $multi_lang);
$contact	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('17', $multi_lang);
$about		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('157', $multi_lang);
$site		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('158', $multi_lang);
$followus	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('290', $multi_lang);
$lcopyright = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('291', $multi_lang);
$lallrightreserve = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('292', $multi_lang);
$lanimated = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('316', $multi_lang);
$vsitemap = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('922', $multi_lang);	$TutorUnable   		= $arrVal[$multi_lang];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout;?></title>
<script src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery.placeholder.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/home/global.js');?>" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<link id="bico" type="image/x-icon" href="<?php echo base_url('talklist.ico');?>" rel="bookmark">
<link id="bsico" type="image/x-icon" href="<?php echo base_url('talklist.ico');?>" rel="shortcut icon">
<?php $this->layout->appendFile('css',"css/site.css");?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css" type="text/css" />
<!--links file -->
<?php if( isset($links) ):?>
	<?php foreach($links as $v):$str = '';?>
		<?php foreach($v as $kk=>$vv){
			$str .= " {$kk}='{$vv}' ";
		}?>
		<link rel="stylesheet" <?php echo $str;?> type="text/css" />
		<?php endforeach;?>
<?php endif;?>
<!-- links file end-->
<!-- script file -->
<?php if( isset($javascripts) ):?>
	<?php foreach($javascripts as $v):$str = '';?>
	<?php foreach($v as $kk=>$vv){
		$str .= " {$kk}='{$vv}' ";
	}?>
	<script <?php echo $str;?> type="text/javascript" ></script>
	<?php endforeach;?>
<?php endif;?>
<!-- script file end-->
<!-- scripts -->
<?php if( isset($scripts) ):?>
	<?php foreach($scripts as $v):?>
		<script><?php echo $v;?></script>
	<?php endforeach;?>
<?php endif;?>
<!-- scripts end-->
<!-- scripts -->
<?php if( isset($styles) ):?>
<?php foreach($styles as $v):?>
<script><?php echo $v;?></script>
<?php endforeach;?>
<?php endif;?>
<!-- scripts end-->
<!-- <link rel="stylesheet" href="<?php echo base_url('css/main.css');?>" type="text/css" />-->
<link rel="stylesheet" href="<?php echo base_url('css/base.css');?>" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('css/home/inner_pages.css');?>" type="text/css" />
<!--CSS START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/html5reset-1.6.1.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/tools.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/style.css');?>">
<!--CSS END -->
<!--[if lt IE 9]><script src="<?php echo base_url('js/home/html5.js');?>"></script><![endif]-->
<!--HTML 6 VIDEO START -->
<!--HTML 6 VIDEO END -->
<script src="<?php echo base_url('js/jquery.placeholder.js');?>" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,400italic,700,900' rel='stylesheet' type='text/css'>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35274394-1']);
_gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42821485-1', 'thetalklist.com');
ga('send', 'pageview');
$(document).ready(function(){

	$("#multi_lang_change").change(function(){
		var multiLang = $("#multi_lang_change").val();
		$.ajax({
			type: "POST",
			url: "<?php echo Base_url();?>user/ajaxLang/",
			data: { multiLang: multiLang}
		}).done(function( msg ) { 
			location.reload();
		});
	});
});
</script>

<script type="text/javascript">
/// viplove 30-1-2014
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
		//alert('hi');
            $(this).parents('form').submit();
            return false;
        }
    });
});

</script>
  <?php
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    //echo 'Internet explorer';
	$browser = 1;
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)
   // echo 'Internet explorer';
	$browser = 11;
   if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
   // echo 'Mozilla Firefox';
	$browser = 2;
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
   // echo 'Google Chrome';
	$browser = 3;
     
    ?>
	 
<script>
window.onbeforeunload = function() {
     window.location.href = '<?php echo base_url('user/logout');?>';   
};
</script>
 
<!-- Yahoo Home page Analytics Code start-->
<script type="text/javascript">
  (function () {
    var tagjs = document.createElement("script");
    var s = document.getElementsByTagName("script")[0];
    tagjs.async = true;
    tagjs.src = "//s.yjtag.jp/tag.js#site=x7PYvhZ";
    s.parentNode.insertBefore(tagjs, s);
  }());
</script>
<noscript>
  <iframe src="//b.yjtag.jp/iframe?c=x7PYvhZ" width="1" height="1" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</noscript>
<!-- Yahoo Home page Analytics Code End-->

<!-- Facebook tracking pixel code Start-->
<script>(function() { 
  var _fbq = window._fbq || (window._fbq = []); 
  if (!_fbq.loaded) { 
    var fbds = document.createElement('script'); 
    fbds.async = true; 
    fbds.src = '//connect.facebook.net/en_US/fbds.js'; 
    var s = document.getElementsByTagName('script')[0]; 
    s.parentNode.insertBefore(fbds, s); 
    _fbq.loaded = true; 
  } 
  _fbq.push(['addPixelId', '502193343213630']); 
})(); 
window._fbq = window._fbq || []; 
window._fbq.push(['track', 'PixelInitialized', {}]); 
</script> 
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=502193343213630&ev=NoScript" /></noscript>
<?php 
//print_r($this->session->userdata);
/*if($this->session->userdata('logout') == 'Yes'){
$this->session->set_userdata(array('logout'=>'No'));
echo '<script>window.location.href="'.base_url().'/user/logout"</script>';
}*/

?>

 
<!--[if lt IE 10]>
<script>$(document).ready(function(){ $('input[type="text"]').each(function(){var $this = $(this); $this.attr("value", $this.attr("placeholder"));}); });</script>
<![endif]-->
</head>
<body onLoad="wireUpEvents()">
<?php
$arrVal 	= $this->lookup_model->getValue('5', $multi_lang);
$llogin		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('238', $multi_lang);
$lforget	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('314', $multi_lang);		$lwelcome 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('315', $multi_lang);		$llogout 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('420', $multi_lang);		$lSUPPORT   		= @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);		$lFORUM   			= @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('388', $multi_lang);		$lTUTOR_RESOURCES   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('417', $multi_lang);		$lSTUDENT_RESOURCES = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('414', $multi_lang);		$lFAQ   			= @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);		$lEMAIL   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);		$lPASSWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);		$lFIRSTNAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);		$lIM_STUDENT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);		$lIM_TUTOR   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1', $multi_lang);			$home    			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('330', $multi_lang);		$profile    		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang); 		$search 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('323', $multi_lang); 		$videotext 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);			$howitworks    		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('546', $multi_lang);		$SIGN_IN   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('547', $multi_lang);		$lSIGN_IN   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('548', $multi_lang);		$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);		$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('549', $multi_lang);		$lCONNNECT_WITH_US  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('550', $multi_lang);		$lSITE_MAP   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('551', $multi_lang);		$lStudents   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('552', $multi_lang);		$lTutors   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('553', $multi_lang);		$lLang   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('554', $multi_lang);		$lSELECTING_TUTOR   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('555', $multi_lang);		$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('556', $multi_lang);		$lGUARANTEE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('557', $multi_lang);		$lOVERVIEW   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('558', $multi_lang);		$lBECOME_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('559', $multi_lang);		$lLEVELS   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('560', $multi_lang);		$lMAKE_MONEY   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('561', $multi_lang);		$lMARKET_YOURSELF   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('670', $multi_lang);		$lREG_SELECT_TYPE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('671', $multi_lang);		$lREG_FIRSTNAME_REQ   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('672', $multi_lang);		$lREG_FIRSTNAME_INVALID = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('673', $multi_lang);		$lREG_EMAIL_REQ   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('674', $multi_lang);		$lREG_EMAIL_INVALID   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('675', $multi_lang);		$lREG_PASSWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang);        $lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('721', $multi_lang);		$lteacher_learning = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('731', $multi_lang);		$schedule= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('740', $multi_lang);		$smessage= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('741', $multi_lang);		$talk= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('774', $multi_lang);		$tdetail = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('775', $multi_lang);		$rprofile = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('776', $multi_lang);		$vlession = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('777', $multi_lang);		$history = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('778', $multi_lang);		$calander = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('779', $multi_lang);		$favoutite= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('800', $multi_lang);		$loginagain= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('726', $multi_lang);	$school   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('840', $multi_lang);	$comunity   		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('889', $multi_lang);	$viewsite   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('816', $multi_lang);	$affiliate   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('900', $multi_lang);	$curriculum  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('901', $multi_lang);	$conversation  	= $arrVal[$multi_lang];
?>
<script>
function chngurl(id)
{

var uid = '<?php echo $this->uri->segment(4) ;?>';
var sid = '<?php echo $this->uri->segment(5) ;?>';
var sid1 = '<?php echo $this->uri->segment(6) ;?>';


if(id == 1)
{

document.getElementById("curl").href='<?php echo base_url("user/calendar/uid/");?>'+'/'+uid+'/'+sid;
}
else
{
	document.getElementById("curl").href='<?php echo base_url("user/calendar/uid/");?>'+'/'+uid+'/'+sid1;
}
}
</script>
	<?php if(!$login):?>
	
    <div class="header_login" id="header_login">
    	<div class="wrapper">
    		<form action="<?php echo Base_url("user/login");?>" method="post" id="formLogin" >
        	<div class="top_login clearfix">
            	<span class="log_text"><!--Sign In--><?php echo $SIGN_IN;?></span>
                <div class="log_input"><input name="email" placeholder="<?php echo $lEMAIL;?>" value="" type="text" size="25" id="email"></div>
                <div class="log_input">					
                	<input name="password" placeholder="<?php echo $lPASSWORD;?>" value="" type="password" size="25" class="iposition fake_password_1">
                </div>     
                <input type="submit" value="<?php echo $llogin;?>" name="login" class="signin">
                <a href="<?php echo base_url('user/forget');?>" class="forgot_pass"><!--Forgot password--><?php echo $lforget;?></a>
                <a href="#" class="close_btn" id="close_btn"></a>
            </div>
            </form>
        </div>
    </div>
    <?php endif;?>
    <?php

	 
   $current_uri4 = $this->uri->segment(4);

	if($this->session->userdata('roleId')==0 && $current_uri4 != $this->session->userdata('uid') &&   ($linkAttr == 'publicuser' || $linkAttr == 'videolessons' || $linkAttr == 'history' || $linkAttr == 'calender'))
		{?>
    <div class="fix-header">
    <?php }?>
<div class="header">
	<div class="wrapper clearfix">
		<a href="<?php echo Base_url();?>"><img class="logo" title="TheTalkList" alt="TheTalkList" src="<?php echo Base_url('images/main/logo.gif');?>" style="margin-left:5px;"></a>
		<?php    $current_uri1 = $this->uri->segment(1);
		  $current_uri2 = $this->uri->segment(2);
		  $this->session->userdata('roleId');
		?>
			<!--User-->
			<?php if($login):
			
			//if(  $current_uri1 =="user" and $current_uri2=="registeredit" )
			//{
			?>
			<div class="top_navi inner-navi">
			<?php
			if(!($this->session->userdata('roleId')!=0 AND $current_uri1 =="user" AND $current_uri2=="registeredit"))
			{
			?>
			
             <?php if($this->session->userdata('roleId')==4) {?>
			 <div class="navi_col navi_col2 top_link_hover"><ul id="top_navi"><li><a class="top_link2 my-pages" href="<?php echo Base_url("user/organization");?>"><?php echo $profile;?></a></li></ul></div>
			 
			 <?php } 
			 else if($this->session->userdata('roleId')==5)
			 { ?>
			 <div class="navi_col navi_col2 top_link_hover"><ul id="top_navi"><li><a class="top_link2 my-pages" href="<?php echo Base_url("user/Affiliate");?>"><?php echo $profile;?></a></li></ul></div>
			 <?php }
			 else
			 {?>
			<div class="navi_col navi_col2 top_link_hover"><ul id="top_navi"><li><a class="top_link2 my-pages" href="<?php echo Base_url("user/dashboard");?>"><?php echo $profile;?></a></li></ul></div>
			 <?php }?>
				<div class="navi_col navi_col2"><ul id="top_navi"><li><a class="top_link2 tutors-search" href="<?php echo Base_url("user/tutorsearch");?>"> <?php echo $search;?></a></li></ul></div>
				<div class="navi_col navi_col2"><ul id="top_navi"><li><a class="top_link2 video-search" href="<?php echo Base_url("search/videosearch");?>"><?php echo $videotext;?></a></li></ul></div>
		
				<div class="navi_col navi_col2">
					<ul id="top_navi" class="tpNav1">
						<li><a class="top_link2 support" href="<?php echo Base_url("support/faqs");?>"><?php echo $lSUPPORT;?></a>
							<ul style="display: none;">
								<li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
								<li><a href="<?php echo base_url('forum');?>"><?php echo $lFORUM;?></a></li>
								<?php if($this->session->userdata('roleId') <4) {?>
										<?php if($this->session->userdata('roleId') == '' || $this->session->userdata('roleId') == 0): ?>
												<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lSTUDENT_RESOURCES;?></a></li>
										<?php else: ?>
												<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lTUTOR_RESOURCES;?></a></li>
												<li><a href="<?php echo base_url('support/tutor_training');?>"><?php echo $lteacher_learning;?></a></li>
										<?php endif;?>
								<?php }?>
							</ul>
						</li>
					</ul>
				</div>
				<?php
				}
				?>
				<div class="signinbtn inr-lgut">
				<span><?php echo $lwelcome;?>, <?php echo ucfirst($this->session->userdata['welcomeuser']);?></span><br>
				<a id="xOutUser" href="<?php echo Base_url("user/logout");?>"><?php echo $llogout;?></a>
				</div>
			</div>
			<!--/User-->
			<?php 
			/*}else{
			if(!$login):*/
			else:?>
			<!--Guest-->
            <div class="top_navi">
            	<div class="navi_col top_link_hover">
                	<ul id="top_navi" class="tpNav2">
	                	<li><a href="<?php echo Base_url("students/index");?>" class="top_link students"><!--Students--><?php echo $lStudents;?></a>
                        	<ul>
                                <li><a href="<?php echo Base_url("students/index#select_tutor");?>"><!--Selecting a Tutor--><?php echo $lSELECTING_TUTOR;?></a></li>
                                <li><a href="<?php echo Base_url("students/index#buying_credit");?>"><!--Buying Credits--><?php echo $lBUYING_CREDITS;?></a></li>
                                <li><a href="<?php echo Base_url("students/index#guarantee");?>"><!--Guarantee--><?php echo $lGUARANTEE?></a></li>
                                <li><a href="<?php echo Base_url("search/search");?>"><!--Tutor Search--><?php echo $lsearch;?></a></li>
                                <li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            	<div class="navi_col">
                	<ul id="top_navi" class="tpNav3">
	                	<li><a href="<?php echo Base_url("tutor/index");?>" class="top_link tutors"><!--Tutors--><?php echo $lTutors;?></a>
                        	<ul>
                                <li><a href="<?php echo Base_url("tutor/index#overview");?>"><!--Overview--><?php echo $lOVERVIEW;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#become_trust");?>"><!--Become a Tutor--><?php echo $lBECOME_TUTOR;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#levels");?>"><!--Levels--><?php echo $lLEVELS;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#make_money");?>"><!--Make Money--><?php echo $lMAKE_MONEY;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#market_yourself");?>"><!--Market Yourself--><?php echo $lMARKET_YOURSELF;?></a></li>
                                <li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
				
				<!-- add new menu organization  haren -->
				
			<div class="navi_col">
                	<ul id="top_navi" class="tpNav3">
	                	<li><a href="<?php echo Base_url("school/index");?>" class="top_link school"><?php echo $school;?></a>
                        	<ul>
                                <li><a href="<?php echo Base_url("school/index");?>"><!--Overview--><?php echo $lOVERVIEW;?></a></li>
                                <li><a href="<?php echo Base_url("school/index#become_trust");?>" onclick="showContent('become_trust'); return false"><?php echo $comunity;?></a></li>                                
                                <li><a href="<?php echo Base_url("school/index#levels");?>" onclick="showContent('levels'); return false"><?php echo $lMAKE_MONEY;?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

				
				
				<!-- organization code end -->
				
				
				
				
				
				
				
				
            	<!--<div class="navi_col">
                	<ul id="top_navi" class="tpNav4">
	                	<li><a href="javascript:void(0)" class="top_link language"><?php //echo $lLang;?></a>
	                		<ul>
                                <li><a onClick="changeLanguage('en');" class="multi_lang_change">English</a></li>
                                <li><a onClick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
                                <li><a onClick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
                                <li><a onClick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
                                <li><a onClick="changeLanguage('jp');" class="multi_lang_change">日本語</a></li>
                                <li><a onClick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
                                <li><a onClick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
                        	</ul>
	                	</li>
                    </ul>
                </div>-->
                <div class="navi_col signinbtn">
                	<input name="signin" type="submit" value="<?php echo $lSIGN_IN;?>" class="signin" id="signin_btn">
                    <ul id="top_navi" class="tpNav3">
	                	<li><a style="margin-left:30px;color:#3399CC;"  class="viewsite"><?php echo $viewsite; ?></a>
	                		<ul style="font-size:1em; position:absolute; background:#666; width:100%; left:0; top:21px; display:none;">
                                <li><a onClick="changeLanguage('en');" class="multi_lang_change">English</a></li>
                                <li><a onClick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
                                <li><a onClick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
                                <li><a onClick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
                                <li><a onClick="changeLanguage('jp');" class="multi_lang_change">日本語</a></li>
                                <li><a onClick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
                                <li><a onClick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
                        	</ul>
	                	</li>
                    </ul>
                </div>
            </div>
			<!--/Guest-->
			<?php endif;?>
	</div>
	</div>
	
	<!--<div class="page_title">
    	<div class="wrapper">
			<h1 class="malft">
			<?php
			//echo $linkAttr;
			 $lagin = $this->uri->segment(2);
			if($linkAttr == 'user'){
				 echo $profile;
			}elseif($linkAttr == 'search'){
				echo $search;
			}elseif($linkAttr == 'videosearch'){
				echo $videotext;
			}elseif($linkAttr == 'article'){
				echo $howitworks;
			}elseif($linkAttr == 'support'){
				echo $lSUPPORT;
			}elseif($linkAttr == 'privacy'){
				echo $privacy_policy;
			}elseif($linkAttr == 'about'){
				echo $about;
			}elseif($linkAttr == 'terms'){
				echo $terms;
			}elseif($linkAttr == 'sitemap'){
				echo $vsitemap;
			}elseif($linkAttr == 'contact'){
				echo $contact;
			}elseif($linkAttr == 'publicuser'){
				echo $tdetail;
			}elseif($linkAttr == 'registeredit'){
				echo $rprofile;			
			}elseif($lagin == 'login'){
				echo $loginagain;
			}else{
				echo $profile;
			}
			?>
			</h1>
		</div>
    </div>	-->
	
    <div class="page_title">
    	<div class="wrapper">
			<h1 class="malft">
			<?php
			  //echo $linkAttr.  $this->uri->segment(4);;
			   $lagin = $this->uri->segment(2);
			if($linkAttr == 'user' and $lagin=='login'){
				 echo $loginagain;
			}elseif($linkAttr == 'user'){
				echo $profile;
			}elseif($linkAttr == 'search'){
				echo $search;
			}elseif($linkAttr == 'videosearch'){
				echo $videotext;
			}elseif($linkAttr == 'article'){
				echo $howitworks;
			}elseif($linkAttr == 'support'){
				echo $lSUPPORT;
			}elseif($linkAttr == 'privacy'){
				echo $privacy_policy;
			}elseif($linkAttr == 'about'){
				echo $about;
			}elseif($linkAttr == 'terms'){
				echo $terms;
			}elseif($linkAttr == 'sitemap'){
				echo $vsitemap;
			}elseif($linkAttr == 'contact'){
				echo $contact;
			}elseif($linkAttr == 'publicuser'){
				echo $tdetail;
				  $current_uri4 = $this->uri->segment(4);
				  	}
			elseif($linkAttr == 'videolessons'){
				echo $vlession;
				  $current_uri4 = $this->uri->segment(4);
					}
			elseif($linkAttr == 'history'){
				echo $history;
				  $current_uri4 = $this->uri->segment(4);
					}
			elseif($linkAttr == 'calender'){
				echo $calander;
				  $current_uri4 = $this->uri->segment(4);
					}
			elseif($linkAttr == 'registeredit'){
				echo $rprofile;
			}elseif($linkAttr == 'facebook'){
				echo $loginagain;
			}
			elseif($lagin == 'login'){
				echo $loginagain;
			}else{
				echo $profile;
			}
			?>
			</h1>
			<?php if($this->session->userdata('roleId')==0 && $current_uri4 != $this->session->userdata('uid') &&  ($linkAttr == 'publicuser' || $linkAttr == 'videolessons' || $linkAttr == 'history' || $linkAttr == 'calender'))
		{?>
		
		
			<div class="tutrpg-icon">
		
		
		<select  class="chngurl" onchange="chngurl(this.options[ this.selectedIndex ].value);">
		<option <?php if($this->uri->segment(5)>0){?> selected    <?php }?> value="0"><?php echo $curriculum;?></option>
		<option <?php if($this->uri->segment(5) <=0){?> selected    <?php }?> value="1"><?php echo $conversation;?></option>
		</select>
	  
		
		
		<a class="icon-msg icon-popup"  onclick="sendBeepBoxMessage(<?php echo $current_uri4 ;?>)">&nbsp;<span class="classic"><?php echo $smessage;?></span></a>
        <a class="icon-sedl icon-popup" id="curl" href="<?php echo base_url('/user/calendar/uid/'.@$current_uri4); ?>">&nbsp;<span class="classic"><?php echo $schedule; ?></span></a>
        <?php if($uid_readytalk[0]['readytotalk']==1){?>
		<a class="icon-tk-nw icon-popup" onClick="bookNow(<?php echo $current_uri4 ;?>,'<?php echo $uid['firstName'];?>')">&nbsp;<span class="classic"><?php echo $talk; ?></span></a>
        <?php } else {?>
		<a class="icon-tk-nw icon-popup icon3-gray"  >&nbsp;<span class="classic"><?php echo $talk; ?></span></a>
		<?php } ?>
		<a class="icon-fav icon-popup" onClick="addToPotential(<?php echo $current_uri4 ;?>)">&nbsp;<span class="classic"><?php echo $favoutite; ?></span></a>
     </div>
	 <?php }?>
		</div>
    </div>	
</div>	
	
<?php if($this->session->userdata('roleId')==0 && $current_uri4 != $this->session->userdata('uid') &&   ($linkAttr == 'publicuser' || $linkAttr == 'videolessons' || $linkAttr == 'history' || $linkAttr == 'calender'))
		{?>	
<div class="wrap" style="margin-top:222px;" >	
    <?php }else{?>
	<div class="wrap" style="margin-top:0px;" >	
	<?php }?>
    <div class="baseBox clearfix">
		
			
    	<?php echo $content_for_layout?>
    </div>
    <!--/baseBox-->
</div>
<!--/wrap-->


<!--footer start-->
<div class="footer">
	<div class="wrapper clearfix">
        	<div class="speak_like_native"><!--Speak English Like a Native--><?php echo $lSPEAK_EN_LIKE_NATIVE;?></div>
 
		<div class="socialize">
			<span><?php //echo $followus;?><?php echo $lCONNNECT_WITH_US;?> :</span> 
			<!--R&D@Oct-19-2013 : Chinese Social Icons-->
			<?php if($multi_lang == 'ch') { ?>
			<a href="http://weibo.com/3847933545/profile?rightmod=1&wvr=5&mod=personinfo"><img src="<?php echo Base_url("images/sina.png");?>" width="40" height="40" alt="social1" /></a>
			<a href="http://user.qzone.qq.com/2977798206"><img src="<?php echo Base_url("images/qq.png");?>" width="40" height="40" alt="social1" /></a>
			<?php } ?>
			<!--R&D@Oct-19-2013 : Chinese Social Icons-->
			<a href="http://www.linkedin.com/company/3126401?trk=tyah" class="ln" target="_blank"></a>
			<a href="http://www.facebook.com/TheTalkList" class="fb" target="_blank"></a>
			<a href="https://twitter.com/thetalklist" class="tw" target="_blank"></a>
			<a href="https://plus.google.com/117271187089694253468/posts" class="gp" target="_blank"></a>
			<a href="http://www.youtube.com/user/TheTalkList" class="yt" target="_blank"></a>
		</div>
		<div class="footer_links">
			<span><?php echo $lcopyright;?><?php echo date("Y") ?> &copy; TheTalkList. <!--All Rights Reserved-->&nbsp; &nbsp; <?php echo $lallrightreserve;?> </span>   
			<a href="<?php echo Base_Url('article/privacy');?>"><?php echo $privacy_policy;?></a>  
			<a href="<?php echo Base_Url('article/terms');?>"><?php echo $terms;?></a>    
			<a href="<?php echo Base_Url('article/contact');?>"><?php echo $contact;?></a> 
			<a href="<?php echo Base_Url('article/about');?>"><?php echo $about;?></a> 
			<a href="<?php echo Base_Url('affiliate/index');?>"><?php echo $affiliate;?></a> 
			<a href="<?php echo Base_Url('article/site_map');?>"><?php echo $site;?></a> 
		</div> 
	</div>
</div>

<!--footer end-->
<div id="dialog" title="Dialog" style="display:none">
	<p><?php echo $lanimated;?></p>
</div>
<?php
 //echo $permission;exit;
 if($this->session->userdata('roleId') == 0): 
 //if($permission == 'student_private'): 
 
 ?>
<script type="text/javascript">
// skvirja 01 Oct 2013 
// checks for tutors that confirm class
var mTimerClass;
//getStatusClassConfirm();
var _getStatusClassConfirm = setInterval(getStatusClassConfirm,3000);
function getStatusClassConfirm()
{
	$.get("<?php echo base_url();?>user/checkClassConfirmed",{
				chat: 1,
				last: 1
			}, function(msg) {
			
			//mTimerClass = setTimeout('getStatusClassConfirm();',1000);	
			if (String == msg.constructor)
			{
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			if(result.status == 'success' && result.cid != ''){
				if(result.redirect == true){
					$('#dialog').html('Your tutor has arrived and you will automatically be launched into your session in 10 seconds.');
					$('#dialog').dialog({modal:true});
					setTimeout(function(){window.location.href = '<?php echo base_url(); ?>'+'classroom/index/cid/'+result.cid;},10000);
				}else if(result.tutorNotConfirmed == true){
					//$('#dialog').html('<?php echo $TutorUnable; ?>');
					//$('#dialog').dialog({modal:true});
				}
				
			}
			
	});
}
</script>
<?php endif; ?>
<?php if($this->session->userdata('roleId') != 0): ?>
<script>
	var booknowexpiryTimer;
	<?php if($this->session->userdata('booknowexp')): ?>
	var booknowexpTime = <?php echo $this->session->userdata('booknowexp'); ?>;
	<?php else:?>
	var booknowexpTime = 0;
	<?php endif; ?>
	var attemptBookNowForm = 0;
	window.strtime = 0;
	if(booknowexpTime>0)
	{
		booknowexpiryCheck();
	}
	function booknowexpiryCheck()
	{
		var currentUTCBooknowStr = getCurrentTime();
		var timeout = booknowexpTime - currentUTCBooknowStr;
		//alert(timeout);
		//timeout	=	-310;
		if(timeout<=0 && attemptBookNowForm == 0)
		{
			attemptBookNowForm = 1;
			//--R&D@Jan-24	:	AutoUpdate BookNow status
			$('#booknowPopup').show();
			setTimeout(function(){ booknowno();},300000);
			window.location.href = '<?php echo base_url('user/logout');?>';
			//--R&D@Jan-24	:	AutoUpdate BookNow status
		}
		booknowexpiryTimer = setTimeout('booknowexpiryCheck()',5000);
	}
	function getCurrentTime()
	{
		var crtime = 0;
		$.ajax({
			url: "<?php echo base_url();?>user/getCurrentUTCtimeString",
			type: 'POST',
			dataType: 'json',
			cache: false,
			success: function (msg){
				window.strtime = msg.time;
			}
		});
		crtime = window.strtime;
		return crtime;
	}
	function booknowyes()
	{
		attemptBookNowForm = 0;
		booknowexpTime = getCurrentTime() + 2;
		//booknowexpTime = getCurrentTime() + 60;
		$('#booknowPopup').hide();
		var ddataStringChecked = "readytotalk=1";
		$.ajax({
			url: "<?php echo base_url();?>user/reopenReadyToTalkSession",
			type: 'POST',
			data: ddataStringChecked,
			dataType: 'json',
			cache: false,
			success: function (msg){
				booknowexpiryCheck();
			}
		});
		
	}
	function booknowno()
	{
		$('#booknowPopup').hide();
		$('#readytotalk').attr('checked',false);
		var ddataStringChecked = "readytotalk=0";
		$.ajax({
			url: "<?php echo base_url();?>user/readytotalkUpdate",
			type: 'POST',
			data: ddataStringChecked,
			dataType: 'json',
			cache: false,
			success: function (msg){
			}
		});
	}
</script>
<?php endif; ?>
<script>	
	//broser close event - logout
	var validNavigation = false;
	//var lgbycls = '<?php echo base_url();?>user/logoutByBroserClose';
	var atmptwindow = 1;
	function wireUpEvents(){
		//alert('Helllo');
		// Attach the event keypress to exclude the F5 refresh
		$(document).bind('keypress', function(e) {
			if (e.keyCode == 116 || e.keyCode == 112 || e.keyCode == 114){
			  validNavigation = true;
			}
		});
		document.onkeydown = checkKeycode;
		// Attach the event click for all links in the page
		$("a").bind("click", function() {
			var idm = $(this).attr('id');
			if(typeof(idm) != 'undefined')
			{
				if(idm == 'SocialPromoteNo' || idm == 'SocialPromoteYes')
				{
					validNavigation = false;
				}else{
					validNavigation = true;
				}
			}else{
				validNavigation = true;
			}
		});
		
		//alert(validNavigation);
		// Attach the event submit for all forms in the page
		$("form").bind("submit", function() {
			validNavigation = true;
		});
		// Attach the event click for all inputs in the page
		$("input[type=submit]").bind("click", function() {
			validNavigation = true;
		});

		window.addEventListener('beforeunload',function u(e){
		 if (!validNavigation) {
		 		$.get("<?php echo base_url();?>user/logoutByBroserClose");
				window.onbeforeunload = null;
				$.ajax({
					  dataType:'json',
					  type: 'GET',
					  url: "<?php echo base_url();?>user/logoutByBroserClose",
					  success: function(data, textStatus, jqXHR) {
						alert(data);
						// `data` contains parsed JSON
					  },
					  error: function(jqXHR, textStatus, errorThrown) {
						 // Handle any errors
					  }
				});
				//$.get(lgbycls,function(data, textStatus, jqXHR) {});
				 
				 window.removeEventListener('beforeunload',u,false);
				  //endSession();
				  setTimeout(function(){
					 window.dispatchEvent( new Event('beforeunload'));
				  },100)
				  
		  }
				//---R&D : JAN-22-2014
				/*
					var currentDomain = $('#xOutUser').attr('href');
					if(currentDomain == 'http://techno-sanjay/dev.thetalklist.com/user/logout'){

					}else if(currentDomain == 'http://dev.thetalklist.com/user/logout'){
						$.ajax({
							type: "POST",
							url: 'http://cdn-dev.thetalklist.com/user/logout',
							data: { }
						}).done(function( msg ) {
					});
					}else{
						$.ajax({
							type: "POST",
							url: 'http://dev.thetalklist.com/user/logout',
							data: { }
						}).done(function( msg ) {
						});
					}
				*/	
				//---R&D : JAN-22-2014
		},'fff');
	}
	// Wire up the events as soon as the DOM tree is ready
	$(document).ready(function() {
		//wireUpEvents(); 
		
	}); 
	
	$(window).load(function() {
		//wireUpEvents(); 
	}); 
	
	
	function checkKeycode(e) {
        var keycode;
        if (window.event)
            keycode = window.event.keyCode;
        else if (e)
            keycode = e.which;
        // Mozilla firefox
        if ($.browser.mozilla) {
            if (keycode == 116 ||(e.ctrlKey && keycode == 82)) {
                if (e.preventDefault)
                {
					//alert('f');
                    validNavigation = true;
					
                }
            }
        } 
        // IE
        else if ($.browser.msie) {
            if (keycode == 116 || (window.event.ctrlKey && keycode == 82)) {
               validNavigation = true;
            }
        }
    }
	// set system timeout and logout user
	var timer_logout;
	function timeHasElapsed1(tm) {
		self.location.href = "<?php echo base_url();?>user/logout";
	}
	$( "body" ).mousemove(function( event ) {
		if (!timer_logout)
		{
			clearTimeout(timer_logout);
			timer_logout=setTimeout(function(){
					timeHasElapsed1('12');
				},1000*7200);
		}
		else {			
			clearTimeout(timer_logout);
			timer_logout=setTimeout(function(){
				timeHasElapsed1();
				},1000*7200);
		}
	});
	
	
/* spp,change laguage start 02 Dec 13 */
$('.multi_lang_change').css('cursor', 'pointer');
function changeLanguage(lang){
	//var ajaxBaseUrl = document.baseURI;
	//var ajaxLangUrl = ajaxBaseUrl+'/user/ajaxLang/';
	//alert(ajaxLangUrl);
    if(lang==''){
    	return false;
    }
	multiLang = lang;
	$.ajax({
		type: "POST",
		url: '<?php echo Base_url("user/ajaxLang");?>',
		data: { multiLang: multiLang}
	}).done(function( msg ) {
		location.reload();
  	});
}
/* spp,change laguage end 02 Dec 13 */
	
	
	(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));
window.fbAsyncInit = function() {
    FB.init({
        appId      : '564390540302547', // App ID
        channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
    });
    $('.fb_connect').click(function(){
        FB.login(function(){
            document.location.href = '<?php echo base_url('user/register');?>';
        },{scope: 'email,user_likes,user_location,user_religion_politics'});
    })
        
};
	
</script>
<!-- Naver Analytics code --> 
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"> </script> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_15f3d51a6740";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
$(function() {
	$('.support-nav').hover(function() { 
		$('.support-drp').show(); 
	}, function() { 
		$('.support-drp').hide(); 
	});
});

//----xOutUser
$('#xOutUserq').click(function(){
var currentDomain = $('#xOutUser').attr('href');
if(currentDomain == 'http://techno-sanjay/dev.thetalklist.com/user/logout'){
}else if(currentDomain == 'http://dev.thetalklist.com/user/logout'){
	$.ajax({
		type: "POST",
		url: 'http://cdn-dev.thetalklist.com/user/logout',
		data: { }
	}).done(function( msg ) {
});
}else{
	$.ajax({
		type: "POST",
		url: 'http://dev.thetalklist.com/user/logout',
		data: { }
	}).done(function( msg ) {
  	});
}
});
//----xOutUser




//window.onbeforeunload = function()  {$.get("<?php echo base_url();?>user/logoutByBroserClose");return true;}

</script>
<!--footer end-->
<div id="booknowPopup" style="display:none;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
<div class="header-pop">Book Now Timeout</div>
<div class="sr-pop-cnt">
	Do you want to still be available NOW?
	<br/>
	<input type="button" value="Yes" onClick="return booknowyes();" id="booknow_yes" style="cursor:pointer;" class="blu-btn">
	<input type="button" value="No" onClick="return booknowno();" id="booknow_no" style="cursor:pointer;" class="blu-btn">
</div>		
</div>
<noscript>
    <div style="background: none repeat scroll 0 0 #CCCCCC;float: left;height: 100%;opacity: 0.5;position: fixed;top: 0;width: 100%;z-index: 999999;">&nbsp;</div>
	<div style="border: 1px solid #AAAAAA;margin: 0 36%;position: absolute;top: 300px;width: 400px;z-index: 9999999;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
		<div style="background: url('images/ui-bg_highlight-soft_75_cccccc_1x100.png') repeat-x scroll 50% 50% #CCCCCC;border: 1px solid #AAAAAA;border-radius: 4px;color: #222222;font-weight: bold;padding: 5px 7px;">Activate Javascript</div>
		<div style="padding: 10px;">
			This web site needs javascript activated to work properly. Please activate it. Thanks!
		</div>		
	</div>
</noscript>
</body>
</html>