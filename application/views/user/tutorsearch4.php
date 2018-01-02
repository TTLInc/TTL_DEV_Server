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

?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
	<script type="text/javascript" src="<?php echo base_url().'js/jsapi.js' ?>" ></script>
<script src="<?php echo base_url();?>js/bjqs-1.3.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/bjqs.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/demo.css">
<div class="new-register">
	<!--<div class="contact_us_top">Come see us on Facebook Page</div>-->
	<!--<div class="contact_us_mid">
		<p style="float:left;">
			<span class="logout-msg"><a href="<?php //echo Base_url('search/search' ); ?>">Any Tutor Search</a></span>
            
		</p>
		<p style="float:right;">
			<span class="logout-msg"><a href="<?php //echo Base_url('search/nowtalksearch' ); ?>">Ready talk now Tutor Search</a></span>
 
		</p>
		
	</div>-->
    
    <div class="top-icon-row">
    	<div class="tutr-icon icon-hist">
        	<h1>Now</h1>
            <div class="icn-lnk"><a href="<?php echo Base_url('search/nowtalksearch' ); ?>"><span>History</span></a></div>
            <p>Join a tutor in 5 minutes</p>
        </div>
        <div class="tutr-icon icon-celn">
        	<h1>Schedule</h1>
            <div class="icn-lnk"><a href="<?php echo Base_url('search/search' ); ?>"><span>Calendar</span></a></div>
            <p>Book or request a future timeslot</p>
        </div>
    </div>
    <div class="tutor-result">
    	<ul>
		
 
		
        	<li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li class="last">
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
             <li>
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
            <li class="last">
            	<h2>Molly McFatridge</h2>
                <p>St.Louis, USA, Missouri</p>
                <span class="tut-img"><img src="<?php echo base_url('images/tutor-img.jpg');?>" alt="tutor-img" /></span>
            </li>
        </ul>
        <div class="mor-lnk"><a href="#">more...</a></div>
    </div>
</div>

  <?php  
for($i=1;$i<=6;$i++)
{
?>
<!--<div class="imageBox">
 <?php if(file_exists(base_url('uploads/images/'.$criteria[$i]["pic"]))): ?>
																<a href="<?php echo base_url('/user/profile/uid/'.$criteria[$i]['uid']); ?>"><img src="<?php echo base_url('uploads/images/'.$criteria[$i]["pic"]); ?>" width="150" height="150" alt="02" /></a>
																<?php else: ?>
																<a href="<?php echo base_url('/user/profile/uid/'.$criteria[$i]['uid']); ?>"><img src="<?php echo base_url('images/header.jpg');?>" width="150" height="150" alt="021" /></a>
																<?php endif; ?>
   <?php echo $criteria[$i]['firstName'];?>
</div>-->
<?php 
if ($i==3) {
    echo  "</br>";
}
}

//print_r($criteria);
											 // exit;

?>
 
    
										
<style>
.contact_us{ padding:0px;}
.contact_us_mid p{ padding:0px; line-height:10px;}
.fb-btn{ margin:-42px 0 0 315px; /*position:absolute;*/ float:left;}
.fb-btn .fb{ margin:0 208px 0 0;}
.footer{ margin-top:50px !important; padding-bottom:40px;}
.logout-msg{  color: #193E5F;    float: left;    font-family: Arial,Helvetica,sans-serif;    font-size: 18pt;    font-weight: bold;
    margin: 20px auto -41px 0;    position: relative;    text-align: center;    width: 100%;    z-index: 998;}

	
	
	
	<style>
img {width: 100px; height: 100px;}

.imageBox {display: inline-block;   padding: 4px; text-align: center; font-size: 10px;}

</style>
	</style>
