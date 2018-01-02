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

$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];




?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
	
<div class="contact_us">
	<!--<div class="contact_us_top">Come see us on Facebook Page</div>-->
	<div class="contact_us_mid">
		<p style="float:left;">
			<span class="logout-msg"><?php echo $vlogout; ?></span>
				<img src="<?php echo base_url('images/talk-facebook.png'); ?>" alt="facebook" style="float:left;"/>
            <span class="fb-btn">
            <?php if(!$login):?>
			<a href="<?php echo $fblogin_url; ?>" class="fb">
				<img src="<?php echo base_url("images/fb-btn.png");?>" id="facebook" style='cursor:pointer;' />
			</a>			
			<?php endif;?>
            <a href="http://www.weibo.com/u/2952211760" target="_blank" >
				<img src="<?php echo base_url('images/fb-lg-btn.png'); ?>" alt="facebook2" />
			</a>
            </span>
		</p>
	</div>
</div>
<style>
.contact_us{ padding:0px;}
.contact_us_mid p{ padding:0px; line-height:10px;}
.fb-btn{ margin:-42px 0 0 315px; /*position:absolute;*/ float:left;}
.fb-btn .fb{ margin:0 208px 0 0;}
.footer{ margin-top:50px !important; padding-bottom:40px;}
.logout-msg{  color: #193E5F;    float: left;    font-family: Arial,Helvetica,sans-serif;    font-size: 18pt;    font-weight: bold;
    margin: 20px auto -41px 0;    position: relative;    text-align: center;    width: 100%;    z-index: 998;}
</style>
