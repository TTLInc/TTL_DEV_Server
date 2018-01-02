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
$arrVal 	= $this->lookup_model->getValue('362', $multi_lang);
$vlogout = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('728', $multi_lang);
$freesession = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('729', $multi_lang);
$welcometo = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('434', $multi_lang);
$lNOW  = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('730', $multi_lang);
$lstart  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang);        $lsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('731', $multi_lang);        $lschedule	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('732', $multi_lang);        $ltalk	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('733', $multi_lang);        $lchose	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('734', $multi_lang);        $lselect= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('735', $multi_lang);        $usecustom= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('736', $multi_lang);        $lvtutor= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('809', $multi_lang);        $lstartnow= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('811', $multi_lang);        $bmore= $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
<style>.wrap{ width:1065px !important;}</style>
<!-- Facebook Conversion Code for Registrations Start -->
<!--<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6013973703563', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6013973703563&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>-->
<!-- Facebook Conversion Code for Registrations End -->

<!-- Yahoo Home page Analytics Code start-->
<!--<script type="text/javascript">
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
</noscript>-->
<div class="new-register stude-rgt2">
	<!--<div class="contact_us_mid">
		<p style="float:left;">
			<span class="logout-msg"><a href="<?php echo Base_url('search/search' ); ?>">Tutor Search</a></span>
            </span>
		</p>
	</div>-->
    <div class="stud-reg-div">
        <div class="reg-txt stud-res-nw">
            <span class="free-sesn"><a href="<?php echo Base_url('user/tutorsearch' ); ?>"><?php echo $freesession;?></a></span>
            <div class="sesn-text"><p><?php echo $welcometo; ?></p></div>
        </div>
        <div class="top-icon-row">
            <div class="tutr-icon icon-hist">
                <h1><?php echo $lNOW?></h1>
                <div class="icn-lnk"><a href="<?php echo Base_url('search/nowtalksearch' ); ?>"><span>History</span></a></div>
                <p><?php //echo $join; ?> Join a tutor in 5 minutes</p>
            </div>
            <div class="tutr-icon icon-celn">
                <h1><?php echo $lschedule; ?></h1>
                <div class="icn-lnk"><a href="<?php echo Base_url('search/search' ); ?>"><span>Calendar</span></a></div>
                <p><?php //echo $book; ?>Book or request a future timeslot</p>
            </div>
        </div>
    </div>
    <div class="tutor-result">
	<div class="mor-lnk" style="float:left;"><a  href="<?php echo Base_url('search/search' ); ?>"><?php echo $bmore; ?></a><br><br></div>
    	<ul>
		 
		 <?php  
for($i=1;$i<=10;$i++)
{
   if($i==5 or $i==10)
   {
   //$class = 'last';
   $li = '<li class="last">';
   }
   else
   {
    $li = '<li>'; 
   }
?>
		
        	<?php echo $li ;?>
            	<h2><?php echo ucwords(strtolower($criteria[$i]['firstName']));?></h2>
                <p><?php //echo ucfirst(strtolower($criteria[$i]['city']));
				$cityname = ucwords(strtolower($criteria[$i]['city']));				
				if($cityname == 'Click To Edit'){ echo ""; }else{ echo $cityname; }?></p>
				<?php  if($criteria[$i]["pic"] !=""){
				?>
                <a href="<?php echo base_url('/user/profile/uid/'.$criteria[$i]['uid']); ?>"><span class="tut-img"><img src="<?php echo base_url('uploads/images/thumb/'.$criteria[$i]["pic"]); ?>"   alt="tutor-img" /></span></a>
            <?php }else{ ?>
			   <span class="tut-img"><a href="<?php echo base_url('/user/profile/uid/'.$criteria[$i]['uid']); ?>"><img src="<?php  echo base_url('images/header.jpg'); ?>"  alt="tutor-img" /></a></span> 
			<?php }?>
			</li>
            <?php 
			 
			} ?>
        </ul>
       <!-- <div class="mor-lnk"><a  href="<?php echo Base_url('search/search' ); ?>"><?php //echo $more; ?></a></div>-->
    </div>
    
   <!-- <div class="how_it_works clearfix">
    		<h2> <span>  <?php echo $lstartnow;?></span></h2>
            <div class="hiw_col">
            	<div class="search">
	            	<h3 style="height:53px;"><?php echo $lsearch;?></h3>
                    <div class="hiw_txt"><p><?php echo $lchose;?></p></div>
                </div>
            </div>
            <div class="hiw_col">
            	<div class="schedule">
	            	<h3><!--Schedule<?php echo $lschedule; ?></h3>
                    <div class="hiw_txt"><p><?php echo $lselect; ?></p></div>
                </div>
            </div>
            <div class="hiw_col hiw_col_last">
            	<div class="talk">
	            	<h3><!--Talk<?php echo $ltalk; ?></h3>
                    <div class="hiw_txt"><p><?php echo $usecustom; ?></p></div>
                </div>
            </div>
    	</div>
    <div class="view-tor-btn"><a href="<?php echo Base_url('user/tutorsearch' ); ?>"><?php echo $lvtutor; ?></a></div>-->
    
    
</div>
<!--<style>
.contact_us{ padding:0px;}
.contact_us_mid p{ padding:0px; line-height:10px;}
.fb-btn{ margin:-42px 0 0 315px; /*position:absolute;*/ float:left;}
.fb-btn .fb{ margin:0 208px 0 0;}
.footer{ margin-top:50px !important; padding-bottom:40px;}
.logout-msg{  color: #193E5F;    float: left;    font-family: Arial,Helvetica,sans-serif;    font-size: 18pt;    font-weight: bold;
    margin: 20px auto -41px 0;    position: relative;    text-align: center;    width: 100%;    z-index: 998;}
</style>-->
