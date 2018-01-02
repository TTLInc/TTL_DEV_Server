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
$arrVal 	= $this->lookup_model->getValue('434', $multi_lang);
$lNOW  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('731', $multi_lang);        $lschedule	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('737', $multi_lang);        $join	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('738', $multi_lang);        $book	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('739', $multi_lang);        $more	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('811', $multi_lang);        $bmore	= $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
<style>.wrap{ width:1065px !important;}</style>
	<script type="text/javascript" src="<?php echo base_url().'js/jsapi.js' ?>" ></script>
<script src="<?php echo base_url();?>js/bjqs-1.3.min.js"></script>
    <link rel="stylesheet" href="<?php //echo base_url();?>css/bjqs.css">
<link rel="stylesheet" href="<?php //echo base_url();?>css/demo.css">
<div class="new-register stude-rgt2">
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
        	<h1><?php echo $lNOW?></h1>
            <div class="icn-lnk"><a href="<?php echo Base_url('search/nowtalksearch' ); ?>"><span>History</span></a></div>
            <p><?php echo $join; ?></p>
        </div>
        <div class="tutr-icon icon-celn">
        	<h1><?php echo $lschedule; ?></h1>
            <div class="icn-lnk"><a href="<?php echo Base_url('search/search' ); ?>"><span>Calendar</span></a></div>
            <p><?php echo $book; ?></p>
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
</div>

   
 
    
										
<!---<style>
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
	</style>-->
